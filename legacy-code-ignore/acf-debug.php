<?php
/**
 * ACF Debug Helper
 *
 * Helper file to debug ACF installation status
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display ACF Debug information on admin pages
 */
function forestplanet_acf_debug_info() {
    // Only show for admin users
    if (!current_user_can('manage_options')) {
        return;
    }
    
    echo '<div class="notice notice-info is-dismissible">';
    echo '<h3>ACF Debug Information</h3>';
    
    // Check if ACF is active
    if (class_exists('ACF')) {
        echo '<p>✅ ACF plugin is active</p>';
        
        // Get version using function instead of static method
        if (function_exists('acf_get_setting')) {
            echo '<p>ACF Version: ' . acf_get_setting('version') . '</p>';
        } else {
            echo '<p>❌ Cannot determine ACF version. acf_get_setting function not available.</p>';
        }
        
        // Check if we can register fields
        if (function_exists('acf_add_local_field_group')) {
            echo '<p>✅ acf_add_local_field_group function exists</p>';
            
            // Check if any field groups are registered
            if (function_exists('acf_get_local_field_groups')) {
                $groups = acf_get_local_field_groups();
                echo '<p>Number of registered local field groups: ' . count($groups) . '</p>';
                
                if (count($groups) > 0) {
                    echo '<ul>';
                    foreach ($groups as $group) {
                        echo '<li>' . esc_html($group['title']) . ' (Key: ' . esc_html($group['key']) . ')</li>';
                    }
                    echo '</ul>';
                }
                
                // Also check DB-saved field groups
                if (function_exists('acf_get_field_groups')) {
                    $db_groups = acf_get_field_groups();
                    echo '<p>Number of field groups in database: ' . count($db_groups) . '</p>';
                    
                    if (count($db_groups) > 0) {
                        echo '<ul>';
                        foreach ($db_groups as $group) {
                            echo '<li>' . esc_html($group['title']) . ' (Key: ' . esc_html($group['key']) . ')</li>';
                        }
                        echo '</ul>';
                    }
                }
            } else {
                echo '<p>❌ acf_get_local_field_groups function does not exist</p>';
            }
        } else {
            echo '<p>❌ acf_add_local_field_group function does not exist</p>';
        }
    } else {
        echo '<p>❌ ACF plugin is not active. Please activate the Advanced Custom Fields plugin.</p>';
    }
    
    // Check for our field files
    $front_page_field_file = get_template_directory() . '/inc/acf-fields/acf-fields-front-page.php';
    echo '<p>ACF Field Groups PHP File: ' . (file_exists($front_page_field_file) ? '✅ Exists' : '❌ Missing') . '</p>';
    
    // Check loader inclusion
    $loader_file = get_template_directory() . '/inc/acf-loader.php';
    echo '<p>ACF Loader PHP File: ' . (file_exists($loader_file) ? '✅ Exists' : '❌ Missing') . '</p>';
    
    // Check if loader is being included in functions.php
    if (has_action('init', 'forestplanet_register_acf_fields')) {
        echo '<p>✅ ACF loader function is hooked to init</p>';
    } else {
        echo '<p>❌ ACF loader function is NOT hooked to init</p>';
    }
    
    if (has_action('acf/init', 'forestplanet_register_acf_fields')) {
        echo '<p>✅ ACF loader function is hooked to acf/init</p>';
    } else {
        echo '<p>❌ ACF loader function is NOT hooked to acf/init</p>';
    }
    
    echo '</div>';
}
add_action('admin_notices', 'forestplanet_acf_debug_info'); 