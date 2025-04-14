<?php
/**
 * ForestPlanet Mailchimp Integration Class
 * 
 * This class provides integration with Mailchimp Marketing API for Contact Form 7
 * to handle newsletter subscriptions.
 *
 * @package ForestPlanet
 */

declare(strict_types=1);

namespace ForestPlanet;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ForestPlanet Mailchimp handler class.
 */
class Mailchimp {

    /**
     * Mailchimp API client
     *
     * @var \MailchimpMarketing\ApiClient
     */
    private $client;

    /**
     * Default audience ID from settings
     *
     * @var string
     */
    private $audience_id;

    /**
     * Class constructor
     */
    public function __construct() {
        // Get credentials from WordPress options
        $api_key = get_option('forestplanet_mailchimp_api_key', '');
        $server = get_option('forestplanet_mailchimp_server', '');
        $this->audience_id = get_option('forestplanet_mailchimp_audience_id', '');

        // Initialize hooks
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
        
        // Hook into Contact Form 7 submission
        add_action('wpcf7_before_send_mail', [$this, 'process_cf7_submission']);
        
        // Only initialize client if we have required credentials
        if (!empty($api_key) && !empty($server)) {
            $this->init_client($api_key, $server);
        }
    }

    /**
     * Initialize the Mailchimp API client
     *
     * @param string $api_key The Mailchimp API key
     * @param string $server  The Mailchimp server (e.g., 'us1')
     */
    private function init_client(string $api_key, string $server): void {
        try {
            // Create an instance of the Mailchimp Marketing API client
            $this->client = new \MailchimpMarketing\ApiClient();
            $this->client->setConfig([
                'apiKey' => $api_key,
                'server' => $server,
            ]);
        } catch (\Exception $e) {
            // Log error for debugging
            error_log('Mailchimp API client initialization error: ' . $e->getMessage());
        }
    }

    /**
     * Add settings page under Settings menu
     */
    public function add_settings_page(): void {
        add_options_page(
            'ForestPlanet Mailchimp Settings',
            'Mailchimp Settings',
            'manage_options',
            'forestplanet-mailchimp',
            [$this, 'render_settings_page']
        );
    }

    /**
     * Register settings fields
     */
    public function register_settings(): void {
        register_setting('forestplanet_mailchimp_settings', 'forestplanet_mailchimp_api_key');
        register_setting('forestplanet_mailchimp_settings', 'forestplanet_mailchimp_server');
        register_setting('forestplanet_mailchimp_settings', 'forestplanet_mailchimp_audience_id');

        add_settings_section(
            'forestplanet_mailchimp_settings_section',
            'Mailchimp API Settings',
            [$this, 'settings_section_callback'],
            'forestplanet-mailchimp'
        );

        add_settings_field(
            'forestplanet_mailchimp_api_key',
            'API Key',
            [$this, 'api_key_field_callback'],
            'forestplanet-mailchimp',
            'forestplanet_mailchimp_settings_section'
        );

        add_settings_field(
            'forestplanet_mailchimp_server',
            'Server Prefix',
            [$this, 'server_field_callback'],
            'forestplanet-mailchimp',
            'forestplanet_mailchimp_settings_section'
        );

        add_settings_field(
            'forestplanet_mailchimp_audience_id',
            'Default Audience ID',
            [$this, 'audience_id_field_callback'],
            'forestplanet-mailchimp',
            'forestplanet_mailchimp_settings_section'
        );
    }

    /**
     * Settings section description
     */
    public function settings_section_callback(): void {
        echo '<p>Enter your Mailchimp API credentials below. These are required for newsletter subscriptions to work.</p>';
    }

    /**
     * API Key field callback
     */
    public function api_key_field_callback(): void {
        $api_key = get_option('forestplanet_mailchimp_api_key', '');
        echo '<input type="text" name="forestplanet_mailchimp_api_key" value="' . esc_attr($api_key) . '" class="regular-text" />';
        echo '<p class="description">Enter your Mailchimp API key. You can find this in your Mailchimp account under Account > API Keys.</p>';
    }

    /**
     * Server field callback
     */
    public function server_field_callback(): void {
        $server = get_option('forestplanet_mailchimp_server', '');
        echo '<input type="text" name="forestplanet_mailchimp_server" value="' . esc_attr($server) . '" class="regular-text" />';
        echo '<p class="description">Enter your Mailchimp server prefix (e.g., us1). This is the part that comes before ".api.mailchimp.com" in your API key.</p>';
    }

    /**
     * Audience ID field callback
     */
    public function audience_id_field_callback(): void {
        $audience_id = get_option('forestplanet_mailchimp_audience_id', '');
        echo '<input type="text" name="forestplanet_mailchimp_audience_id" value="' . esc_attr($audience_id) . '" class="regular-text" />';
        echo '<p class="description">Enter your default Mailchimp audience/list ID. You can find this in Mailchimp under Audience > Settings > Audience name and defaults.</p>';
    }

    /**
     * Render settings page
     */
    public function render_settings_page(): void {
        // Check if user has permissions
        if (!current_user_can('manage_options')) {
            wp_die('You do not have sufficient permissions to access this page.');
        }

        // Test connection if credentials are set
        $connection_status = $this->test_connection();
        
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <?php if ($connection_status['connected']) : ?>
                <div class="notice notice-success">
                    <p><?php echo esc_html($connection_status['message']); ?></p>
                </div>
            <?php elseif (!empty($connection_status['message'])) : ?>
                <div class="notice notice-error">
                    <p><?php echo esc_html($connection_status['message']); ?></p>
                </div>
            <?php endif; ?>
            
            <form method="post" action="options.php">
                <?php
                settings_fields('forestplanet_mailchimp_settings');
                do_settings_sections('forestplanet-mailchimp');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Test the Mailchimp API connection
     *
     * @return array Connection status information
     */
    private function test_connection(): array {
        $api_key = get_option('forestplanet_mailchimp_api_key', '');
        $server = get_option('forestplanet_mailchimp_server', '');

        if (empty($api_key) || empty($server)) {
            return [
                'connected' => false,
                'message' => 'API credentials not configured.'
            ];
        }

        try {
            // Initialize client if not already done
            if (!$this->client) {
                $this->init_client($api_key, $server);
            }

            // Make a test API call to ping endpoint
            $response = $this->client->ping->get();
            
            if (!empty($response) && isset($response->health_status) && $response->health_status === 'Everything\'s Chimpy!') {
                return [
                    'connected' => true,
                    'message' => 'Successfully connected to Mailchimp API!'
                ];
            }

            return [
                'connected' => false,
                'message' => 'Connection test failed.'
            ];
        } catch (\Exception $e) {
            return [
                'connected' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Process Contact Form 7 submission and subscribe user to Mailchimp
     *
     * @param \WPCF7_ContactForm $contact_form The CF7 form object
     */
    public function process_cf7_submission($contact_form): void {
        // Get submitted data
        $submission = \WPCF7_Submission::get_instance();
        if (!$submission) {
            return;
        }

        $form_data = $submission->get_posted_data();

        // Check if this is a newsletter subscription form
        // This can be customized based on your form IDs or other criteria
        if (!$this->is_newsletter_form($contact_form, $form_data)) {
            return;
        }

        // Extract email address
        $email = isset($form_data['email']) ? sanitize_email($form_data['email']) : '';
        if (empty($email)) {
            error_log('Mailchimp subscribe failed: No email address provided');
            return;
        }

        // Extract name if available (optional)
        $fname = isset($form_data['fname']) ? sanitize_text_field($form_data['fname']) : '';
        $lname = isset($form_data['lname']) ? sanitize_text_field($form_data['lname']) : '';
        $name = isset($form_data['name']) ? sanitize_text_field($form_data['name']) : '';

        // If name is not split but we have a full name, try to split it
        if (empty($fname) && empty($lname) && !empty($name)) {
            $name_parts = explode(' ', $name, 2);
            $fname = $name_parts[0];
            $lname = $name_parts[1] ?? '';
        }

        // Add subscriber to Mailchimp list
        $this->subscribe($email, $fname, $lname);
    }

    /**
     * Determine if the submitted form is a newsletter subscription form
     *
     * @param \WPCF7_ContactForm $contact_form The CF7 form object
     * @param array              $form_data    The submitted form data
     * 
     * @return bool Whether this is a newsletter form
     */
    private function is_newsletter_form($contact_form, array $form_data): bool {
        // Option 1: Check if a specific checkbox was checked
        if (isset($form_data['receive_updates']) && $form_data['receive_updates'] === 'yes') {
            return true;
        }

        // Option 2: Check form ID
        $form_id = $contact_form->id();
        $newsletter_form_ids = [
            // Add your newsletter form IDs here, for example:
            'newsletter-signup',   // Form ID
            4,                     // Form post ID
        ];

        if (in_array($form_id, $newsletter_form_ids)) {
            return true;
        }

        // Option 3: Check form title
        $form_title = $contact_form->title();
        $newsletter_form_titles = [
            'Newsletter Signup',
            'Subscribe Newsletter',
            // Add more newsletter form titles as needed
        ];
        
        if (in_array($form_title, $newsletter_form_titles)) {
            return true;
        }

        return false;
    }

    /**
     * Subscribe a user to the Mailchimp audience
     *
     * @param string $email Email address to subscribe
     * @param string $fname First name (optional)
     * @param string $lname Last name (optional)
     * 
     * @return bool Success or failure
     */
    public function subscribe(string $email, string $fname = '', string $lname = ''): bool {
        if (!$this->client || empty($this->audience_id)) {
            error_log('Mailchimp subscribe failed: Client not initialized or audience ID not set');
            return false;
        }

        try {
            // Create subscriber hash for idempotent operations
            $subscriber_hash = md5(strtolower($email));

            // Set up subscriber data
            $data = [
                'email_address' => $email,
                'status' => 'subscribed',
                'merge_fields' => []
            ];

            // Add name fields if provided
            if (!empty($fname)) {
                $data['merge_fields']['FNAME'] = $fname;
            }
            
            if (!empty($lname)) {
                $data['merge_fields']['LNAME'] = $lname;
            }

            // Try to update existing subscriber first to avoid duplicates
            try {
                $this->client->lists->updateListMember(
                    $this->audience_id,
                    $subscriber_hash,
                    $data
                );
                return true;
            } catch (\Exception $e) {
                // If subscriber doesn't exist, add them
                if (strpos($e->getMessage(), '404') !== false) {
                    $this->client->lists->addListMember(
                        $this->audience_id,
                        $data
                    );
                    return true;
                }
                
                // If other error, throw to be caught by outer try-catch
                throw $e;
            }
            
        } catch (\Exception $e) {
            error_log('Mailchimp API error: ' . $e->getMessage());
            return false;
        }
    }
}

// Initialize the class
$forestplanet_mailchimp = new Mailchimp(); 