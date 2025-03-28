<?php
/**
 * ACF Status Check and Fix
 *
 * Displays ACF status and applies fixes for field visibility
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Check and display ACF status
 */
function forestplanet_acf_status() {
    // Only for admin
    if (!is_admin() || !current_user_can('manage_options')) {
        return;
    }
    
    // Display diagnostic info
    echo '<div class="notice notice-info is-dismissible">';
    echo '<h3>ACF Status Check</h3>';
    
    if (!class_exists('ACF')) {
        echo '<p style="color:red;">❌ ACF is not installed or activated</p>';
        echo '</div>';
        return;
    }
    
    echo '<p style="color:green;">✓ ACF is installed and active</p>';
    
    // Check front page
    $front_page_id = get_option('page_on_front');
    if (!$front_page_id) {
        echo '<p style="color:orange;">⚠️ No front page is set in WordPress settings</p>';
        echo '<p>Go to Settings > Reading and set a static page as your homepage</p>';
    } else {
        $front_page = get_post($front_page_id);
        echo '<p style="color:green;">✓ Front page is set to: ' . esc_html($front_page->post_title) . ' (ID: ' . $front_page_id . ')</p>';
    }
    
    // Check if fields are going to show up
    if (function_exists('acf_get_field_groups')) {
        $front_page_id = get_option('page_on_front');
        if ($front_page_id) {
            // Simulate being on the front page
            $match_groups = acf_get_field_groups(['post_id' => $front_page_id]);
            echo '<p>ACF field groups that will show on the front page: ' . count($match_groups) . '</p>';
            if (count($match_groups) > 0) {
                echo '<ul>';
                foreach ($match_groups as $group) {
                    echo '<li>' . esc_html($group['title']) . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p style="color:orange;">⚠️ No field groups will display on your front page. Our fix will address this.</p>';
            }
        }
    }
    
    // Display link to edit front page
    if ($front_page_id) {
        echo '<p><a href="' . admin_url('post.php?post=' . $front_page_id . '&action=edit') . '" class="button">Edit Front Page</a></p>';
    }
    
    echo '</div>';
}
add_action('admin_notices', 'forestplanet_acf_status');

/**
 * Fix ACF field visibility for front page
 */
function forestplanet_fix_acf_fields() {
    // This fixes the issue where front page fields might not show up
    // by adding a filter to modify the location rules for front page field groups
    add_filter('acf/location/rule_match/page_type', 'forestplanet_fix_front_page_rule_match', 10, 4);
    
    // Add a direct filter to modify all front page field groups to also target the home page ID
    add_action('acf/init', 'forestplanet_update_frontpage_field_groups', 20);
}
add_action('acf/init', 'forestplanet_fix_acf_fields');

/**
 * Update all front page field groups to also target the page set as front page
 */
function forestplanet_update_frontpage_field_groups() {
    if (!function_exists('acf_get_field_groups') || !function_exists('acf_update_field_group')) {
        return;
    }
    
    // Get the page set as front page
    $front_page_id = get_option('page_on_front');
    if (!$front_page_id) {
        return;
    }
    
    // Get all field groups
    $field_groups = acf_get_field_groups();
    
    foreach ($field_groups as $field_group) {
        // Check if this is a front page field group
        $is_front_page_group = false;
        
        if (isset($field_group['location']) && is_array($field_group['location'])) {
            foreach ($field_group['location'] as $location_group) {
                foreach ($location_group as $location_rule) {
                    if (isset($location_rule['param']) && $location_rule['param'] === 'page_type' 
                        && isset($location_rule['value']) && $location_rule['value'] === 'front_page') {
                        $is_front_page_group = true;
                        break 2;
                    }
                }
            }
        }
        
        // If this is a front page group, add an OR condition for the specific page
        if ($is_front_page_group) {
            // Add a location rule for the specific page ID
            $field_group['location'][] = array(
                array(
                    'param' => 'page',
                    'operator' => '==',
                    'value' => $front_page_id,
                )
            );
            
            // Update the field group
            acf_update_field_group($field_group);
        }
    }
}

/**
 * Adjust rule matching for front page
 */
function forestplanet_fix_front_page_rule_match($match, $rule, $options, $field_group) {
    // If we're checking a front_page rule and we're on the edit screen
    if ($rule['value'] === 'front_page' && $rule['operator'] === '==') {
        // Get front page ID from settings
        $front_page_id = get_option('page_on_front');
        
        // If we have a front page set
        if ($front_page_id) {
            // Check if we're viewing that specific page in admin
            global $post;
            if (is_admin() && isset($post) && $post->ID == $front_page_id) {
                return true;
            }
        }
    }
    
    return $match;
} 