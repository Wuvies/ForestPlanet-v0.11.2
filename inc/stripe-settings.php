<?php
/**
 * ForestPlanet Stripe Settings
 *
 * @package ForestPlanet
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register the Stripe settings page in the WordPress admin
 */
function forestplanet_stripe_settings_menu() {
    add_menu_page(
        __('Stripe Settings', 'forestplanet'),
        __('Stripe Settings', 'forestplanet'),
        'manage_options',
        'forestplanet-stripe-settings',
        'forestplanet_stripe_settings_page',
        'dashicons-money-alt',
        30
    );
}
add_action('admin_menu', 'forestplanet_stripe_settings_menu');

/**
 * Register Stripe settings
 */
function forestplanet_register_stripe_settings() {
    // Register settings
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_stripe_test_publishable_key');
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_stripe_test_secret_key');
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_stripe_live_publishable_key');
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_stripe_live_secret_key');
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_stripe_mode');
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_stripe_currency', array(
        'default' => 'usd'
    ));
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_stripe_webhook_secret');
    
    // Additional payment method settings
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_enable_paypal', array(
        'default' => 'yes'
    ));
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_enable_google_pay', array(
        'default' => 'yes'
    ));
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_enable_apple_pay', array(
        'default' => 'yes'
    ));
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_apple_pay_domain', array(
        'default' => ''
    ));
    
    // Donation text and appearance settings
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_donation_button_text', array(
        'default' => 'Complete Donation'
    ));
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_donation_processing_text', array(
        'default' => 'Processing your donation...'
    ));
    
    // Email and receipt settings
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_send_receipt_email', array(
        'default' => 'yes'
    ));
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_receipt_from_email', array(
        'default' => get_option('admin_email')
    ));
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_receipt_from_name', array(
        'default' => get_bloginfo('name')
    ));
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_receipt_subject', array(
        'default' => 'Thank you for your donation to ForestPlanet'
    ));
    
    // Confirmation page message settings
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_confirmation_title', array(
        'default' => 'Thank You for Your Donation!'
    ));
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_confirmation_message', array(
        'default' => 'Your generous contribution will help us plant more trees and restore our planet\'s forests.'
    ));
    
    // Tax receipt information
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_tax_receipt_info', array(
        'default' => 'Your donation may be tax-deductible. Please keep this receipt for your tax records.'
    ));
    register_setting('forestplanet_stripe_settings_group', 'forestplanet_tax_id', array(
        'default' => ''
    ));
}
add_action('admin_init', 'forestplanet_register_stripe_settings');

/**
 * Display the Stripe settings page
 */
function forestplanet_stripe_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Stripe Payment Gateway Settings', 'forestplanet'); ?></h1>
        
        <form method="post" action="options.php">
            <?php settings_fields('forestplanet_stripe_settings_group'); ?>
            <?php do_settings_sections('forestplanet_stripe_settings_group'); ?>
            
            <h2 class="nav-tab-wrapper">
                <a href="#api-settings" class="nav-tab nav-tab-active"><?php echo esc_html__('API Settings', 'forestplanet'); ?></a>
                <a href="#payment-methods" class="nav-tab"><?php echo esc_html__('Payment Methods', 'forestplanet'); ?></a>
                <a href="#donation-texts" class="nav-tab"><?php echo esc_html__('Donation Texts', 'forestplanet'); ?></a>
                <a href="#email-receipts" class="nav-tab"><?php echo esc_html__('Email Receipts', 'forestplanet'); ?></a>
            </h2>
            
            <div id="api-settings" class="tab-content active">
                <h3><?php echo esc_html__('Stripe API Configuration', 'forestplanet'); ?></h3>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Stripe Mode', 'forestplanet'); ?></th>
                        <td>
                            <select name="forestplanet_stripe_mode">
                                <option value="test" <?php selected(get_option('forestplanet_stripe_mode'), 'test'); ?>><?php echo esc_html__('Test Mode', 'forestplanet'); ?></option>
                                <option value="live" <?php selected(get_option('forestplanet_stripe_mode'), 'live'); ?>><?php echo esc_html__('Live Mode', 'forestplanet'); ?></option>
                            </select>
                            <p class="description"><?php echo esc_html__('Select whether to use Stripe in test mode or live mode.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Test Publishable Key', 'forestplanet'); ?></th>
                        <td>
                            <input type="text" name="forestplanet_stripe_test_publishable_key" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_stripe_test_publishable_key')); ?>" />
                            <p class="description"><?php echo esc_html__('Enter your Stripe test publishable key.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Test Secret Key', 'forestplanet'); ?></th>
                        <td>
                            <input type="password" name="forestplanet_stripe_test_secret_key" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_stripe_test_secret_key')); ?>" />
                            <p class="description"><?php echo esc_html__('Enter your Stripe test secret key.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Live Publishable Key', 'forestplanet'); ?></th>
                        <td>
                            <input type="text" name="forestplanet_stripe_live_publishable_key" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_stripe_live_publishable_key')); ?>" />
                            <p class="description"><?php echo esc_html__('Enter your Stripe live publishable key.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Live Secret Key', 'forestplanet'); ?></th>
                        <td>
                            <input type="password" name="forestplanet_stripe_live_secret_key" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_stripe_live_secret_key')); ?>" />
                            <p class="description"><?php echo esc_html__('Enter your Stripe live secret key.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Currency', 'forestplanet'); ?></th>
                        <td>
                            <select name="forestplanet_stripe_currency">
                                <option value="usd" <?php selected(get_option('forestplanet_stripe_currency', 'usd'), 'usd'); ?>>USD</option>
                                <option value="eur" <?php selected(get_option('forestplanet_stripe_currency', 'usd'), 'eur'); ?>>EUR</option>
                                <option value="gbp" <?php selected(get_option('forestplanet_stripe_currency', 'usd'), 'gbp'); ?>>GBP</option>
                                <option value="cad" <?php selected(get_option('forestplanet_stripe_currency', 'usd'), 'cad'); ?>>CAD</option>
                            </select>
                            <p class="description"><?php echo esc_html__('Select the currency for Stripe payments.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Webhook Secret', 'forestplanet'); ?></th>
                        <td>
                            <input type="password" name="forestplanet_stripe_webhook_secret" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_stripe_webhook_secret')); ?>" />
                            <p class="description"><?php echo esc_html__('Enter your Stripe webhook secret for handling payment events.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div id="payment-methods" class="tab-content">
                <h3><?php echo esc_html__('Payment Method Settings', 'forestplanet'); ?></h3>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Enable PayPal', 'forestplanet'); ?></th>
                        <td>
                            <select name="forestplanet_enable_paypal">
                                <option value="yes" <?php selected(get_option('forestplanet_enable_paypal', 'yes'), 'yes'); ?>><?php echo esc_html__('Yes', 'forestplanet'); ?></option>
                                <option value="no" <?php selected(get_option('forestplanet_enable_paypal', 'yes'), 'no'); ?>><?php echo esc_html__('No', 'forestplanet'); ?></option>
                            </select>
                            <p class="description"><?php echo esc_html__('Enable PayPal checkout option (requires Stripe PayPal integration).', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Enable Google Pay', 'forestplanet'); ?></th>
                        <td>
                            <select name="forestplanet_enable_google_pay">
                                <option value="yes" <?php selected(get_option('forestplanet_enable_google_pay', 'yes'), 'yes'); ?>><?php echo esc_html__('Yes', 'forestplanet'); ?></option>
                                <option value="no" <?php selected(get_option('forestplanet_enable_google_pay', 'yes'), 'no'); ?>><?php echo esc_html__('No', 'forestplanet'); ?></option>
                            </select>
                            <p class="description"><?php echo esc_html__('Enable Google Pay checkout option.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Enable Apple Pay', 'forestplanet'); ?></th>
                        <td>
                            <select name="forestplanet_enable_apple_pay">
                                <option value="yes" <?php selected(get_option('forestplanet_enable_apple_pay', 'yes'), 'yes'); ?>><?php echo esc_html__('Yes', 'forestplanet'); ?></option>
                                <option value="no" <?php selected(get_option('forestplanet_enable_apple_pay', 'yes'), 'no'); ?>><?php echo esc_html__('No', 'forestplanet'); ?></option>
                            </select>
                            <p class="description"><?php echo esc_html__('Enable Apple Pay checkout option.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Apple Pay Domain', 'forestplanet'); ?></th>
                        <td>
                            <input type="text" name="forestplanet_apple_pay_domain" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_apple_pay_domain')); ?>" />
                            <p class="description"><?php echo esc_html__('Enter your domain registered with Apple Pay. This should match your site domain.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div id="donation-texts" class="tab-content">
                <h3><?php echo esc_html__('Donation Page Text Settings', 'forestplanet'); ?></h3>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Donation Button Text', 'forestplanet'); ?></th>
                        <td>
                            <input type="text" name="forestplanet_donation_button_text" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_donation_button_text', 'Complete Donation')); ?>" />
                            <p class="description"><?php echo esc_html__('Text displayed on the donation button.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Processing Text', 'forestplanet'); ?></th>
                        <td>
                            <input type="text" name="forestplanet_donation_processing_text" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_donation_processing_text', 'Processing your donation...')); ?>" />
                            <p class="description"><?php echo esc_html__('Text displayed while processing the donation.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Confirmation Page Title', 'forestplanet'); ?></th>
                        <td>
                            <input type="text" name="forestplanet_confirmation_title" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_confirmation_title', 'Thank You for Your Donation!')); ?>" />
                            <p class="description"><?php echo esc_html__('Title displayed on the confirmation page.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Confirmation Message', 'forestplanet'); ?></th>
                        <td>
                            <textarea name="forestplanet_confirmation_message" class="large-text" rows="4"><?php echo esc_textarea(get_option('forestplanet_confirmation_message', 'Your generous contribution will help us plant more trees and restore our planet\'s forests.')); ?></textarea>
                            <p class="description"><?php echo esc_html__('Message displayed on the confirmation page.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div id="email-receipts" class="tab-content">
                <h3><?php echo esc_html__('Email Receipt Settings', 'forestplanet'); ?></h3>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Send Email Receipt', 'forestplanet'); ?></th>
                        <td>
                            <select name="forestplanet_send_receipt_email">
                                <option value="yes" <?php selected(get_option('forestplanet_send_receipt_email', 'yes'), 'yes'); ?>><?php echo esc_html__('Yes', 'forestplanet'); ?></option>
                                <option value="no" <?php selected(get_option('forestplanet_send_receipt_email', 'yes'), 'no'); ?>><?php echo esc_html__('No', 'forestplanet'); ?></option>
                            </select>
                            <p class="description"><?php echo esc_html__('Send an email receipt to donors after successful payment.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('From Email', 'forestplanet'); ?></th>
                        <td>
                            <input type="email" name="forestplanet_receipt_from_email" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_receipt_from_email', get_option('admin_email'))); ?>" />
                            <p class="description"><?php echo esc_html__('Email address receipts will be sent from.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('From Name', 'forestplanet'); ?></th>
                        <td>
                            <input type="text" name="forestplanet_receipt_from_name" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_receipt_from_name', get_bloginfo('name'))); ?>" />
                            <p class="description"><?php echo esc_html__('Name that will appear as the sender of receipts.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Email Subject', 'forestplanet'); ?></th>
                        <td>
                            <input type="text" name="forestplanet_receipt_subject" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_receipt_subject', 'Thank you for your donation to ForestPlanet')); ?>" />
                            <p class="description"><?php echo esc_html__('Subject line for receipt emails.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Tax Receipt Information', 'forestplanet'); ?></th>
                        <td>
                            <textarea name="forestplanet_tax_receipt_info" class="large-text" rows="4"><?php echo esc_textarea(get_option('forestplanet_tax_receipt_info', 'Your donation may be tax-deductible. Please keep this receipt for your tax records.')); ?></textarea>
                            <p class="description"><?php echo esc_html__('Tax receipt information to include in receipt emails.', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__('Tax ID Number', 'forestplanet'); ?></th>
                        <td>
                            <input type="text" name="forestplanet_tax_id" class="regular-text" value="<?php echo esc_attr(get_option('forestplanet_tax_id', '')); ?>" />
                            <p class="description"><?php echo esc_html__('Your organization\'s tax ID number (EIN).', 'forestplanet'); ?></p>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="settings-info">
                <h3><?php echo esc_html__('Setup Instructions', 'forestplanet'); ?></h3>
                <ol>
                    <li><?php echo esc_html__('Create a Stripe account at', 'forestplanet'); ?> <a href="https://stripe.com" target="_blank">stripe.com</a>.</li>
                    <li><?php echo esc_html__('Get your API keys from your Stripe Dashboard (both test and live keys).', 'forestplanet'); ?></li>
                    <li><?php echo esc_html__('For webhooks, create a new webhook endpoint in your Stripe Dashboard pointing to:', 'forestplanet'); ?> <code><?php echo esc_url(site_url('/wp-json/forestplanet/v1/stripe-webhook')); ?></code></li>
                    <li><?php echo esc_html__('Copy the webhook signing secret and paste it in the field above.', 'forestplanet'); ?></li>
                    <li><?php echo esc_html__('Select the appropriate Stripe mode (test/live) based on your environment.', 'forestplanet'); ?></li>
                </ol>
            </div>
            
            <?php submit_button(); ?>
        </form>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // Tabs functionality
        $('.nav-tab-wrapper a').on('click', function(e) {
            e.preventDefault();
            
            // Hide all tabs
            $('.tab-content').hide();
            
            // Remove active class from all tabs
            $('.nav-tab').removeClass('nav-tab-active');
            
            // Show the selected tab
            $($(this).attr('href')).show();
            
            // Add active class to selected tab
            $(this).addClass('nav-tab-active');
        });
        
        // Show the first tab by default
        $('.tab-content').hide();
        $('.tab-content:first').show();
    });
    </script>
    
    <style>
    .tab-content {
        margin-top: 20px;
    }
    </style>
    <?php
}

/**
 * Helper function to get Stripe publishable key
 */
function forestplanet_get_stripe_publishable_key() {
    $mode = get_option('forestplanet_stripe_mode', 'test');
    
    if ($mode === 'live') {
        return get_option('forestplanet_stripe_live_publishable_key');
    } else {
        return get_option('forestplanet_stripe_test_publishable_key');
    }
}

/**
 * Helper function to get Stripe secret key
 */
function forestplanet_get_stripe_secret_key() {
    $mode = get_option('forestplanet_stripe_mode', 'test');
    
    if ($mode === 'live') {
        return get_option('forestplanet_stripe_live_secret_key');
    } else {
        return get_option('forestplanet_stripe_test_secret_key');
    }
}

/**
 * Helper function to get Stripe currency
 */
function forestplanet_get_stripe_currency() {
    return strtoupper(get_option('forestplanet_stripe_currency', 'usd'));
}

/**
 * Helper function to get webhook secret
 */
function forestplanet_get_stripe_webhook_secret() {
    return get_option('forestplanet_stripe_webhook_secret');
}

/**
 * Add settings link to plugins page
 */
function forestplanet_stripe_add_settings_link($links) {
    $settings_link = '<a href="admin.php?page=forestplanet-stripe-settings">' . __('Settings', 'forestplanet') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}

/**
 * Check if Stripe is configured
 */
function forestplanet_is_stripe_configured() {
    $mode = get_option('forestplanet_stripe_mode', 'test');
    
    if ($mode === 'live') {
        return !empty(get_option('forestplanet_stripe_live_publishable_key')) && 
               !empty(get_option('forestplanet_stripe_live_secret_key'));
    } else {
        return !empty(get_option('forestplanet_stripe_test_publishable_key')) && 
               !empty(get_option('forestplanet_stripe_test_secret_key'));
    }
}

// Helper function to get stripe mode for client-side use
function forestplanet_get_stripe_mode() {
    return get_option('forestplanet_stripe_mode', 'test');
}

// Helper functions for payment method availability
function forestplanet_is_paypal_enabled() {
    return get_option('forestplanet_enable_paypal', 'yes') === 'yes';
}

function forestplanet_is_google_pay_enabled() {
    return get_option('forestplanet_enable_google_pay', 'yes') === 'yes';
}

function forestplanet_is_apple_pay_enabled() {
    return get_option('forestplanet_enable_apple_pay', 'yes') === 'yes';
}

function forestplanet_get_apple_pay_domain() {
    return get_option('forestplanet_apple_pay_domain', '');
}

/**
 * Helper function to get donation button text
 */
function forestplanet_get_donation_button_text() {
    return get_option('forestplanet_donation_button_text', 'Complete Donation');
}

/**
 * Helper function to get donation processing text
 */
function forestplanet_get_donation_processing_text() {
    return get_option('forestplanet_donation_processing_text', 'Processing your donation...');
}

/**
 * Helper function to check if receipt emails should be sent
 */
function forestplanet_should_send_receipt_email() {
    return get_option('forestplanet_send_receipt_email', 'yes') === 'yes';
}

/**
 * Helper function to get confirmation title
 */
function forestplanet_get_confirmation_title() {
    return get_option('forestplanet_confirmation_title', 'Thank You for Your Donation!');
}

/**
 * Helper function to get confirmation message
 */
function forestplanet_get_confirmation_message() {
    return get_option('forestplanet_confirmation_message', 'Your generous contribution will help us plant more trees and restore our planet\'s forests.');
}

/**
 * Helper function to get receipt from name
 */
function forestplanet_get_receipt_from_name() {
    return get_option('forestplanet_receipt_from_name', get_bloginfo('name'));
}

/**
 * Helper function to get receipt from email
 */
function forestplanet_get_receipt_from_email() {
    return get_option('forestplanet_receipt_from_email', get_option('admin_email'));
}

/**
 * Helper function to get receipt subject
 */
function forestplanet_receipt_subject() {
    return get_option('forestplanet_receipt_subject', 'Thank you for your donation to ForestPlanet');
}

/**
 * Helper function to get tax receipt info
 */
function forestplanet_get_tax_receipt_info() {
    return get_option('forestplanet_tax_receipt_info', 'Your donation may be tax-deductible. Please keep this receipt for your tax records.');
}

/**
 * Helper function to get tax ID
 */
function forestplanet_get_tax_id() {
    return get_option('forestplanet_tax_id', '');
} 