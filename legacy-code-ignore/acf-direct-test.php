<?php
/**
 * ACF Direct Field Registration Test
 *
 * This file directly attempts to register the ACF fields for testing
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_notices', function() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    echo '<div class="notice notice-info is-dismissible">';
    echo '<h3>ACF Direct Registration Test Results</h3>';
    
    if (!class_exists('ACF')) {
        echo '<p style="color:red;">❌ ACF is not installed or activated</p>';
        echo '</div>';
        return;
    }
    
    echo '<p style="color:green;">✓ ACF is installed and activated</p>';
    
    if (!function_exists('acf_add_local_field_group')) {
        echo '<p style="color:red;">❌ acf_add_local_field_group() function not available</p>';
        echo '</div>';
        return;
    }
    
    echo '<p style="color:green;">✓ acf_add_local_field_group() function is available</p>';
    
    // Get the front page field groups registration file
    $fields_file = get_template_directory() . '/inc/acf-fields/acf-fields-front-page.php';
    
    if (!file_exists($fields_file)) {
        echo '<p style="color:red;">❌ Field definition file not found at: ' . esc_html($fields_file) . '</p>';
        echo '</div>';
        return;
    }
    
    echo '<p style="color:green;">✓ Field definition file exists at: ' . esc_html($fields_file) . '</p>';
    
    // Try to include the file directly (this will register the fields)
    try {
        // Get count before including
        $before_count = 0;
        if (function_exists('acf_get_local_field_groups')) {
            $before_count = count(acf_get_local_field_groups());
        }
        
        echo '<p>Number of field groups before include: ' . $before_count . '</p>';
        
        // Include the file
        include_once $fields_file;
        
        // Get count after including
        $after_count = 0;
        if (function_exists('acf_get_local_field_groups')) {
            $after_count = count(acf_get_local_field_groups());
            $groups = acf_get_local_field_groups();
        }
        
        echo '<p>Number of field groups after include: ' . $after_count . '</p>';
        
        if ($after_count > $before_count) {
            echo '<p style="color:green;">✓ Successfully registered ' . ($after_count - $before_count) . ' new field groups!</p>';
            
            // List the field groups
            echo '<p>Registered field groups:</p>';
            echo '<ul>';
            foreach ($groups as $group) {
                echo '<li>' . esc_html($group['title']) . ' (Key: ' . esc_html($group['key']) . ')</li>';
            }
            echo '</ul>';
        } else {
            echo '<p style="color:red;">❌ No new field groups were registered after including the file. Check the file content.</p>';
        }
    } catch (Exception $e) {
        echo '<p style="color:red;">❌ Error including field definition file: ' . esc_html($e->getMessage()) . '</p>';
    }
    
    echo '</div>';
});

// Also try registering one simple field group directly here
add_action('acf/init', function() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    // Register a test field group
    acf_add_local_field_group(array(
        'key' => 'group_test_direct_registration',
        'title' => 'Test Direct Registration',
        'fields' => array(
            array(
                'key' => 'field_test_text',
                'label' => 'Test Text Field',
                'name' => 'test_text_field',
                'type' => 'text',
                'instructions' => 'This is a test field',
                'required' => 0,
                'default_value' => 'Default test value',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));
}); 