<?php
/**
 * ForestPlanet Stripe API Integration
 *
 * @package ForestPlanet
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Initialize Stripe API
 */
function forestplanet_stripe_init() {
    // Check if Stripe is configured
    if (!forestplanet_is_stripe_configured()) {
        return;
    }
    
    // Include Stripe PHP SDK via Composer autoload if it exists
    if (file_exists(get_template_directory() . '/vendor/autoload.php')) {
        require_once get_template_directory() . '/vendor/autoload.php';
    } else {
        // Log error if Stripe PHP SDK is not installed
        error_log('Stripe PHP SDK not found. Please install via Composer.');
        return;
    }
    
    // Set Stripe API key
    \Stripe\Stripe::setApiKey(forestplanet_get_stripe_secret_key());
    
    // Set API version explicitly
    \Stripe\Stripe::setApiVersion('2023-10-16');
    
    // Set app info
    \Stripe\Stripe::setAppInfo(
        'ForestPlanet Donation System',
        '1.0.0',
        'https://forestplanet.org',
        'pp_partner_LEnyhDrRWKNKm1'
    );
}
add_action('init', 'forestplanet_stripe_init');

/**
 * Create a payment intent for donation
 * 
 * @param float $amount Amount to charge in dollars (will be converted to cents)
 * @param array $metadata Additional metadata for the payment
 * @return array|WP_Error Payment intent data or error
 */
function forestplanet_create_payment_intent($amount, $metadata = array()) {
    // Initialize Stripe
    forestplanet_stripe_init();
    
    // Validate amount
    if (!is_numeric($amount) || $amount < 1) {
        return new WP_Error('invalid_amount', __('Invalid donation amount', 'forestplanet'));
    }
    
    // Convert dollars to cents for Stripe
    $amount_in_cents = round($amount * 100);
    
    try {
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $amount_in_cents,
            'currency' => strtolower(forestplanet_get_stripe_currency()),
            'metadata' => array_merge([
                'donation_type' => 'onetime',
                'source' => 'forestplanet_website'
            ], $metadata),
            'description' => 'ForestPlanet Donation',
            'statement_descriptor' => 'FORESTPLANET',
            'statement_descriptor_suffix' => 'DONATION',
            'receipt_email' => isset($metadata['email']) ? $metadata['email'] : '',
        ]);
        
        return [
            'id' => $intent->id,
            'client_secret' => $intent->client_secret,
            'amount' => $amount_in_cents,
            'currency' => strtolower(forestplanet_get_stripe_currency()),
        ];
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Log the error
        error_log('Stripe API Error: ' . $e->getMessage());
        
        return new WP_Error(
            'stripe_error',
            $e->getMessage()
        );
    } catch (Exception $e) {
        // Log general errors
        error_log('General Error in Stripe Integration: ' . $e->getMessage());
        
        return new WP_Error(
            'general_error',
            __('An error occurred while processing your donation', 'forestplanet')
        );
    }
}

/**
 * Get a payment intent from Stripe
 * 
 * @param string $payment_intent_id Payment intent ID
 * @return \Stripe\PaymentIntent|WP_Error Payment intent object or error
 */
function forestplanet_get_payment_intent($payment_intent_id) {
    // Initialize Stripe
    forestplanet_stripe_init();
    
    try {
        return \Stripe\PaymentIntent::retrieve($payment_intent_id);
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Log the error
        error_log('Stripe API Error: ' . $e->getMessage());
        
        return new WP_Error(
            'stripe_error',
            $e->getMessage()
        );
    } catch (Exception $e) {
        // Log general errors
        error_log('General Error in Stripe Integration: ' . $e->getMessage());
        
        return new WP_Error(
            'general_error',
            __('An error occurred while retrieving payment information', 'forestplanet')
        );
    }
}

/**
 * Register REST API endpoint for Stripe webhook
 */
function forestplanet_register_stripe_webhook_endpoint() {
    register_rest_route('forestplanet/v1', '/stripe-webhook', array(
        'methods' => 'POST',
        'callback' => 'forestplanet_handle_stripe_webhook',
        'permission_callback' => '__return_true',
    ));
}
add_action('rest_api_init', 'forestplanet_register_stripe_webhook_endpoint');

/**
 * Handle Stripe webhook events
 *
 * @param WP_REST_Request $request Full data about the request
 * @return WP_REST_Response
 */
function forestplanet_handle_stripe_webhook($request) {
    // Initialize Stripe
    forestplanet_stripe_init();
    
    $webhook_secret = forestplanet_get_stripe_webhook_secret();
    
    // Get the request body
    $payload = $request->get_body();
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    
    try {
        // Verify webhook signature
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $webhook_secret
        );
        
        // Handle specific events
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $payment_intent = $event->data->object;
                forestplanet_process_successful_payment($payment_intent);
                break;
                
            case 'payment_intent.payment_failed':
                $payment_intent = $event->data->object;
                forestplanet_process_failed_payment($payment_intent);
                break;
        }
        
        return new WP_REST_Response(['status' => 'success'], 200);
    } catch (\UnexpectedValueException $e) {
        // Invalid payload
        error_log('Stripe Webhook Error: ' . $e->getMessage());
        return new WP_REST_Response(['error' => 'Invalid payload'], 400);
    } catch (\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        error_log('Stripe Webhook Signature Error: ' . $e->getMessage());
        return new WP_REST_Response(['error' => 'Invalid signature'], 400);
    } catch (Exception $e) {
        // General error
        error_log('Stripe Webhook General Error: ' . $e->getMessage());
        return new WP_REST_Response(['error' => 'Webhook error'], 500);
    }
}

/**
 * Process successful payment
 * 
 * @param \Stripe\PaymentIntent $payment_intent Payment intent object
 */
function forestplanet_process_successful_payment($payment_intent) {
    // Get metadata
    $metadata = $payment_intent->metadata->toArray();
    
    // Create donation record
    $donation_data = array(
        'payment_id' => $payment_intent->id,
        'amount' => $payment_intent->amount / 100, // Convert from cents to dollars
        'currency' => strtoupper($payment_intent->currency),
        'email' => $payment_intent->receipt_email,
        'status' => 'completed',
        'date' => current_time('mysql'),
        'metadata' => $metadata
    );
    
    // Save donation data to WordPress database
    forestplanet_save_donation($donation_data);
    
    // Send admin notification
    forestplanet_send_admin_notification($donation_data);
    
    // Send donor receipt if enabled
    if (function_exists('forestplanet_should_send_receipt_email') && forestplanet_should_send_receipt_email()) {
        forestplanet_send_donor_receipt($donation_data);
    }
}

/**
 * Send admin notification about successful donation
 * 
 * @param array $donation_data Donation data
 */
function forestplanet_send_admin_notification($donation_data) {
    $admin_email = get_option('admin_email');
    $amount = number_format($donation_data['amount'], 2);
    $currency = $donation_data['currency'];
    
    $subject = sprintf(__('New donation of %s %s received', 'forestplanet'), $currency, $amount);
    $message = sprintf(
        __('A new donation of %s %s has been received. Payment ID: %s', 'forestplanet'), 
        $currency, 
        $amount, 
        $donation_data['payment_id']
    );
    
    // Add donor information if available
    if (!empty($donation_data['email'])) {
        $message .= "\n\n" . __('Donor Email: ', 'forestplanet') . $donation_data['email'];
    }
    
    // Add metadata if available
    if (!empty($donation_data['metadata'])) {
        $message .= "\n\n" . __('Additional Information:', 'forestplanet');
        
        foreach ($donation_data['metadata'] as $key => $value) {
            if (!empty($value)) {
                $message .= "\n" . ucfirst(str_replace('_', ' ', $key)) . ': ' . $value;
            }
        }
    }
    
    // Set the from name and email
    $headers = array();
    $from_name = get_bloginfo('name');
    $from_email = get_option('admin_email');
    $headers[] = "From: {$from_name} <{$from_email}>";
    $headers[] = "Content-Type: text/plain; charset=UTF-8";
    
    wp_mail($admin_email, $subject, $message, $headers);
}

/**
 * Send receipt email to donor
 * 
 * @param array $donation_data Donation data
 */
function forestplanet_send_donor_receipt($donation_data) {
    // Only send if we have donor email
    if (empty($donation_data['email'])) {
        return;
    }
    
    $donor_email = $donation_data['email'];
    $amount = number_format($donation_data['amount'], 2);
    $currency = $donation_data['currency'];
    $payment_id = $donation_data['payment_id'];
    $date = date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($donation_data['date']));
    
    // Get receipt settings
    $subject = function_exists('forestplanet_receipt_subject') 
        ? forestplanet_receipt_subject() 
        : __('Thank you for your donation to ForestPlanet', 'forestplanet');
    
    $from_name = function_exists('forestplanet_get_receipt_from_name') 
        ? forestplanet_get_receipt_from_name() 
        : get_bloginfo('name');
    
    $from_email = function_exists('forestplanet_get_receipt_from_email') 
        ? forestplanet_get_receipt_from_email() 
        : get_option('admin_email');
    
    $tax_receipt_info = function_exists('forestplanet_get_tax_receipt_info') 
        ? forestplanet_get_tax_receipt_info() 
        : __('Your donation may be tax-deductible. Please keep this receipt for your tax records.', 'forestplanet');
    
    $tax_id = function_exists('forestplanet_get_tax_id') 
        ? forestplanet_get_tax_id() 
        : '';
    
    // Build the email message
    $message = sprintf(
        __('Dear supporter,

Thank you for your generous donation of %s %s to ForestPlanet. Your contribution will help us plant more trees and restore our planet\'s forests.

Donation Details:
- Amount: %s %s
- Date: %s
- Transaction ID: %s

%s
', 'forestplanet'),
        $currency,
        $amount,
        $currency,
        $amount,
        $date,
        $payment_id,
        $tax_receipt_info
    );
    
    // Add tax ID if available
    if (!empty($tax_id)) {
        $message .= sprintf(__('Organization Tax ID: %s', 'forestplanet'), $tax_id) . "\n\n";
    }
    
    // Add website info
    $message .= sprintf(
        __('Thank you again for your support.

%s
%s', 'forestplanet'),
        get_bloginfo('name'),
        home_url()
    );
    
    // Set the email headers
    $headers = array();
    $headers[] = "From: {$from_name} <{$from_email}>";
    $headers[] = "Content-Type: text/plain; charset=UTF-8";
    
    // Send the email
    wp_mail($donor_email, $subject, $message, $headers);
}

/**
 * Process failed payment
 * 
 * @param \Stripe\PaymentIntent $payment_intent Payment intent object
 */
function forestplanet_process_failed_payment($payment_intent) {
    // Get metadata
    $metadata = $payment_intent->metadata->toArray();
    
    // Create donation record with failed status
    $donation_data = array(
        'payment_id' => $payment_intent->id,
        'amount' => $payment_intent->amount / 100, // Convert from cents to dollars
        'currency' => strtoupper($payment_intent->currency),
        'email' => $payment_intent->receipt_email,
        'status' => 'failed',
        'date' => current_time('mysql'),
        'metadata' => $metadata,
        'error' => $payment_intent->last_payment_error ? $payment_intent->last_payment_error->message : 'Payment failed'
    );
    
    // Save donation data to WordPress database
    forestplanet_save_donation($donation_data);
    
    // Notify admin about failed payment
    $admin_email = get_option('admin_email');
    $subject = __('Donation payment failed', 'forestplanet');
    $message = sprintf(__('A donation payment of %s %s has failed. Payment ID: %s', 'forestplanet'), 
        strtoupper($payment_intent->currency), 
        number_format($payment_intent->amount / 100, 2), 
        $payment_intent->id);
    
    if ($payment_intent->last_payment_error) {
        $message .= "\n\nError: " . $payment_intent->last_payment_error->message;
    }
    
    wp_mail($admin_email, $subject, $message);
}

/**
 * Save donation data to WordPress database
 * 
 * @param array $donation_data Donation data
 */
function forestplanet_save_donation($donation_data) {
    global $wpdb;
    
    // Create table if it doesn't exist
    forestplanet_create_donations_table();
    
    // Format metadata as JSON
    if (isset($donation_data['metadata']) && is_array($donation_data['metadata'])) {
        $donation_data['metadata'] = json_encode($donation_data['metadata']);
    }
    
    // Insert donation data
    $wpdb->insert(
        $wpdb->prefix . 'forestplanet_donations',
        $donation_data,
        array(
            '%s', // payment_id
            '%f', // amount
            '%s', // currency
            '%s', // email
            '%s', // status
            '%s', // date
            '%s', // metadata
            '%s', // error (if present)
        )
    );
    
    return $wpdb->insert_id;
}

/**
 * Create donations table in WordPress database
 */
function forestplanet_create_donations_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'forestplanet_donations';
    
    // Check if table exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        // Table doesn't exist, create it
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            payment_id varchar(255) NOT NULL,
            amount decimal(10,2) NOT NULL,
            currency varchar(10) NOT NULL,
            email varchar(255) NOT NULL,
            status varchar(50) NOT NULL,
            date datetime NOT NULL,
            metadata text,
            error text,
            PRIMARY KEY  (id),
            KEY payment_id (payment_id),
            KEY email (email),
            KEY status (status)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
} 