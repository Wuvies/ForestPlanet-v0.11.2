<?php
/**
 * ACF Fields Loader
 *
 * Loads all ACF field groups defined in separate files
 *
 * @package ForestPlanet
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register all ACF fields for the theme
 * This function is called via the acf/init hook
 */
function forestplanet_register_acf_fields() {
    // Check if ACF is active and functions exist
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    // Include field definition files directly
    $acf_fields_dir = get_template_directory() . '/inc/acf-fields/';
    
    // Front page fields with page_type = front_page rule
    if (file_exists($acf_fields_dir . 'acf-fields-front-page.php')) {
        include_once $acf_fields_dir . 'acf-fields-front-page.php';
    }
    
    // Home page fields with direct page ID targeting
    if (file_exists($acf_fields_dir . 'acf-front-home.php')) {
        include_once $acf_fields_dir . 'acf-front-home.php';
    }
    
    // About page fields
    if (file_exists($acf_fields_dir . 'acf-fields-about-page.php')) {
        include_once $acf_fields_dir . 'acf-fields-about-page.php';
    }
    
    // This ensures that at least one field group is definitely registered for testing purposes
    acf_add_local_field_group(array(
        'key' => 'group_front_page_fallback',
        'title' => 'Front Page Fallback Fields',
        'fields' => array(
            array(
                'key' => 'field_fallback_title',
                'label' => 'Fallback Title',
                'name' => 'fallback_title',
                'type' => 'text',
                'instructions' => 'This is a fallback field that should always appear',
                'required' => 0,
                'default_value' => 'Fallback Title',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page',
                    'operator' => '==',
                    'value' => get_option('page_on_front'),
                ),
            ),
        ),
        'active' => true,
    ));
}

// Register only on ACF init, at normal priority to ensure ACF is fully loaded
add_action('acf/init', 'forestplanet_register_acf_fields');

/**
 * Helper function to retrieve ACF field with fallback
 *
 * @param string $field_name The name of the ACF field
 * @param mixed $post_id The post ID (optional, defaults to current post)
 * @param mixed $default Default value if field is empty
 * @return mixed The field value or default value
 */
function forestplanet_get_field($field_name, $post_id = null, $default = '') {
    // Check if ACF functions exist
    if (!function_exists('get_field')) {
        return $default;
    }
    
    $value = get_field($field_name, $post_id);
    
    if (empty($value) && $default !== '') {
        return $default;
    }
    
    return $value;
}

/**
 * Helper function to retrieve and display ACF image field
 *
 * @param string $field_name The name of the ACF field
 * @param string $size Image size to retrieve
 * @param mixed $post_id The post ID (optional, defaults to current post)
 * @param string $default_image Path to default image relative to theme
 * @param array $attr Additional attributes for the image
 * @return string The img HTML or empty string
 */
function forestplanet_get_image_field($field_name, $size = 'full', $post_id = null, $default_image = '', $attr = []) {
    // Check if ACF functions exist
    if (!function_exists('get_field')) {
        if (!empty($default_image)) {
            $default_url = get_template_directory_uri() . '/' . ltrim($default_image, '/');
            $alt = isset($attr['alt']) ? $attr['alt'] : '';
            
            $img_attr = '';
            foreach ($attr as $key => $value) {
                $img_attr .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
            }
            
            return '<img src="' . esc_url($default_url) . '"' . $img_attr . ' alt="' . esc_attr($alt) . '">';
        }
        return '';
    }
    
    $image = get_field($field_name, $post_id);
    
    // If image is empty and default_image is provided
    if (empty($image) && !empty($default_image)) {
        $default_url = get_template_directory_uri() . '/' . ltrim($default_image, '/');
        $alt = isset($attr['alt']) ? $attr['alt'] : '';
        
        $img_attr = '';
        foreach ($attr as $key => $value) {
            $img_attr .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
        }
        
        return '<img src="' . esc_url($default_url) . '"' . $img_attr . ' alt="' . esc_attr($alt) . '">';
    }
    
    // If we have an image from ACF
    if (!empty($image)) {
        // If the image is an array (standard ACF image field)
        if (is_array($image)) {
            if (isset($image['id'])) {
                $attr['alt'] = isset($attr['alt']) ? $attr['alt'] : $image['alt'];
                return wp_get_attachment_image($image['id'], $size, false, $attr);
            } elseif (isset($image['url'])) {
                $img_attr = '';
                foreach ($attr as $key => $value) {
                    $img_attr .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
                }
                
                return '<img src="' . esc_url($image['url']) . '"' . $img_attr . ' alt="' . esc_attr(isset($image['alt']) ? $image['alt'] : '') . '">';
            }
        } 
        // If the image is just an ID
        elseif (is_numeric($image)) {
            return wp_get_attachment_image($image, $size, false, $attr);
        }
        // If the image is a URL
        elseif (is_string($image)) {
            $img_attr = '';
            foreach ($attr as $key => $value) {
                $img_attr .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
            }
            
            return '<img src="' . esc_url($image) . '"' . $img_attr . ' alt="' . esc_attr(isset($attr['alt']) ? $attr['alt'] : '') . '">';
        }
    }
    
    return '';
} 