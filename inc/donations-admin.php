<?php
/**
 * ForestPlanet Donations Admin Page
 *
 * @package ForestPlanet
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add the Donations submenu page to the admin menu
 */
function forestplanet_donations_admin_menu() {
    add_submenu_page(
        'forestplanet-stripe-settings',
        __('Donations', 'forestplanet'),
        __('Donations', 'forestplanet'),
        'manage_options',
        'forestplanet-donations',
        'forestplanet_donations_admin_page'
    );
}
add_action('admin_menu', 'forestplanet_donations_admin_menu');

/**
 * Display the Donations admin page content
 */
function forestplanet_donations_admin_page() {
    global $wpdb;
    
    // Check if table exists
    $table_name = $wpdb->prefix . 'forestplanet_donations';
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        forestplanet_create_donations_table();
    }
    
    // Process actions
    if (isset($_GET['action']) && isset($_GET['id'])) {
        $action = sanitize_text_field($_GET['action']);
        $id = intval($_GET['id']);
        
        // View donation details
        if ($action === 'view' && $id > 0) {
            forestplanet_display_donation_details($id);
            return;
        }
        
        // Delete donation record
        if ($action === 'delete' && $id > 0 && isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'delete_donation_' . $id)) {
            $wpdb->delete($table_name, ['id' => $id], ['%d']);
            echo '<div class="notice notice-success"><p>' . __('Donation record deleted successfully.', 'forestplanet') . '</p></div>';
        }
    }
    
    // Get current page
    $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    $per_page = 20;
    $offset = ($current_page - 1) * $per_page;
    
    // Get filter values
    $status_filter = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';
    
    // Build the query
    $query = "SELECT * FROM $table_name";
    $count_query = "SELECT COUNT(*) FROM $table_name";
    
    // Add filters
    $where_clauses = array();
    if (!empty($status_filter)) {
        $where_clauses[] = $wpdb->prepare("status = %s", $status_filter);
    }
    
    if (!empty($where_clauses)) {
        $query .= " WHERE " . implode(' AND ', $where_clauses);
        $count_query .= " WHERE " . implode(' AND ', $where_clauses);
    }
    
    // Add order and limit
    $query .= " ORDER BY date DESC LIMIT $offset, $per_page";
    
    // Get donations
    $donations = $wpdb->get_results($query);
    $total_donations = $wpdb->get_var($count_query);
    
    // Calculate total pages
    $total_pages = ceil($total_donations / $per_page);
    
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Donations', 'forestplanet'); ?></h1>
        
        <div class="tablenav top">
            <form method="get">
                <input type="hidden" name="page" value="forestplanet-donations">
                
                <div class="alignleft actions">
                    <select name="status">
                        <option value=""><?php echo esc_html__('All statuses', 'forestplanet'); ?></option>
                        <option value="completed" <?php selected($status_filter, 'completed'); ?>><?php echo esc_html__('Completed', 'forestplanet'); ?></option>
                        <option value="failed" <?php selected($status_filter, 'failed'); ?>><?php echo esc_html__('Failed', 'forestplanet'); ?></option>
                    </select>
                    <?php submit_button(__('Filter', 'forestplanet'), 'action', '', false); ?>
                </div>
            </form>
            
            <div class="tablenav-pages">
                <?php
                echo paginate_links(array(
                    'base' => add_query_arg('paged', '%#%'),
                    'format' => '',
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                    'total' => $total_pages,
                    'current' => $current_page,
                ));
                ?>
            </div>
        </div>
        
        <table class="wp-list-table widefat fixed striped donations">
            <thead>
                <tr>
                    <th scope="col" class="manage-column column-id"><?php echo esc_html__('ID', 'forestplanet'); ?></th>
                    <th scope="col" class="manage-column column-date"><?php echo esc_html__('Date', 'forestplanet'); ?></th>
                    <th scope="col" class="manage-column column-email"><?php echo esc_html__('Email', 'forestplanet'); ?></th>
                    <th scope="col" class="manage-column column-amount"><?php echo esc_html__('Amount', 'forestplanet'); ?></th>
                    <th scope="col" class="manage-column column-status"><?php echo esc_html__('Status', 'forestplanet'); ?></th>
                    <th scope="col" class="manage-column column-payment-id"><?php echo esc_html__('Payment ID', 'forestplanet'); ?></th>
                    <th scope="col" class="manage-column column-actions"><?php echo esc_html__('Actions', 'forestplanet'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($donations)) : ?>
                    <tr>
                        <td colspan="7"><?php echo esc_html__('No donations found.', 'forestplanet'); ?></td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($donations as $donation) : ?>
                        <tr>
                            <td><?php echo esc_html($donation->id); ?></td>
                            <td><?php echo esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($donation->date))); ?></td>
                            <td><?php echo esc_html($donation->email); ?></td>
                            <td><?php echo esc_html($donation->currency . ' ' . number_format($donation->amount, 2)); ?></td>
                            <td>
                                <?php if ($donation->status === 'completed') : ?>
                                    <span class="status-completed"><?php echo esc_html__('Completed', 'forestplanet'); ?></span>
                                <?php elseif ($donation->status === 'failed') : ?>
                                    <span class="status-failed"><?php echo esc_html__('Failed', 'forestplanet'); ?></span>
                                <?php else : ?>
                                    <span class="status-other"><?php echo esc_html($donation->status); ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo esc_html($donation->payment_id); ?></td>
                            <td>
                                <a href="<?php echo esc_url(add_query_arg(['action' => 'view', 'id' => $donation->id])); ?>" class="button button-small"><?php echo esc_html__('View', 'forestplanet'); ?></a>
                                <?php
                                $delete_url = wp_nonce_url(
                                    add_query_arg(['action' => 'delete', 'id' => $donation->id]),
                                    'delete_donation_' . $donation->id
                                );
                                ?>
                                <a href="<?php echo esc_url($delete_url); ?>" class="button button-small" onclick="return confirm('<?php echo esc_js(__('Are you sure you want to delete this donation record?', 'forestplanet')); ?>');"><?php echo esc_html__('Delete', 'forestplanet'); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        
        <div class="tablenav bottom">
            <div class="tablenav-pages">
                <?php
                echo paginate_links(array(
                    'base' => add_query_arg('paged', '%#%'),
                    'format' => '',
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                    'total' => $total_pages,
                    'current' => $current_page,
                ));
                ?>
            </div>
        </div>
    </div>
    
    <style>
        .status-completed {
            color: green;
            font-weight: bold;
        }
        .status-failed {
            color: red;
            font-weight: bold;
        }
        .status-other {
            color: orange;
            font-weight: bold;
        }
    </style>
    <?php
}

/**
 * Display donation details
 *
 * @param int $id Donation ID
 */
function forestplanet_display_donation_details($id) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'forestplanet_donations';
    $donation = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));
    
    if (!$donation) {
        echo '<div class="notice notice-error"><p>' . __('Donation not found.', 'forestplanet') . '</p></div>';
        return;
    }
    
    // Parse metadata
    $metadata = json_decode($donation->metadata, true);
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Donation Details', 'forestplanet'); ?></h1>
        
        <p><a href="<?php echo esc_url(admin_url('admin.php?page=forestplanet-donations')); ?>" class="button">&larr; <?php echo esc_html__('Back to Donations', 'forestplanet'); ?></a></p>
        
        <table class="form-table">
            <tr>
                <th scope="row"><?php echo esc_html__('ID', 'forestplanet'); ?></th>
                <td><?php echo esc_html($donation->id); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo esc_html__('Date', 'forestplanet'); ?></th>
                <td><?php echo esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($donation->date))); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo esc_html__('Email', 'forestplanet'); ?></th>
                <td><?php echo esc_html($donation->email); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo esc_html__('Amount', 'forestplanet'); ?></th>
                <td><?php echo esc_html($donation->currency . ' ' . number_format($donation->amount, 2)); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo esc_html__('Status', 'forestplanet'); ?></th>
                <td>
                    <?php if ($donation->status === 'completed') : ?>
                        <span class="status-completed"><?php echo esc_html__('Completed', 'forestplanet'); ?></span>
                    <?php elseif ($donation->status === 'failed') : ?>
                        <span class="status-failed"><?php echo esc_html__('Failed', 'forestplanet'); ?></span>
                    <?php else : ?>
                        <span class="status-other"><?php echo esc_html($donation->status); ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php echo esc_html__('Payment ID', 'forestplanet'); ?></th>
                <td><?php echo esc_html($donation->payment_id); ?></td>
            </tr>
            <?php if (!empty($donation->error)) : ?>
                <tr>
                    <th scope="row"><?php echo esc_html__('Error', 'forestplanet'); ?></th>
                    <td><?php echo esc_html($donation->error); ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($metadata && is_array($metadata)) : ?>
                <tr>
                    <th scope="row"><?php echo esc_html__('Metadata', 'forestplanet'); ?></th>
                    <td>
                        <table class="widefat striped">
                            <?php foreach ($metadata as $key => $value) : ?>
                                <tr>
                                    <td><strong><?php echo esc_html($key); ?></strong></td>
                                    <td><?php echo esc_html($value); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
    <?php
} 