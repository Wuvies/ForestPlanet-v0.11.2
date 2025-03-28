<?php
/**
 * ACF Fields for Home Page
 *
 * Defines ACF field groups for the page that's set as the front page in Settings > Reading
 *
 * @package ForestPlanet
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Check if ACF function exists
if (!function_exists('acf_add_local_field_group')) {
    return;
}

// Get the front page ID from WordPress settings
$front_page_id = get_option('page_on_front');
if (!$front_page_id) {
    return;
}

/**
 * Hero Section for the Home Page
 */
acf_add_local_field_group(array(
    'key' => 'group_home_hero',
    'title' => 'Home Page - Hero Section',
    'fields' => array(
        array(
            'key' => 'field_home_hero_title',
            'label' => 'Hero Title',
            'name' => 'hero_title',
            'type' => 'text',
            'instructions' => 'Enter the main hero title',
            'required' => 1,
            'default_value' => 'Plant a Tree For Just 15¢',
        ),
        array(
            'key' => 'field_home_hero_description',
            'label' => 'Hero Description',
            'name' => 'hero_description',
            'type' => 'textarea',
            'instructions' => 'Enter the description text below the hero title',
            'required' => 1,
            'default_value' => 'Welcome to ForestPlanet, a growing organization making low-cost reforestation accessible and impactful.',
            'rows' => 4,
            'new_lines' => 'br',
        ),
        array(
            'key' => 'field_home_hero_image',
            'label' => 'Hero Image',
            'name' => 'hero_image',
            'type' => 'image',
            'instructions' => 'Upload the main hero image',
            'required' => 0,
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
            'mime_types' => 'jpg,jpeg,png,webp',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'page',
                'operator' => '==',
                'value' => $front_page_id,
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

/**
 * What We Do Section for the Home Page
 */
acf_add_local_field_group(array(
    'key' => 'group_home_what_we_do',
    'title' => 'Home Page - What We Do Section',
    'fields' => array(
        array(
            'key' => 'field_home_what_we_do_subtitle',
            'label' => 'What We Do Subtitle',
            'name' => 'what_we_do_subtitle',
            'type' => 'text',
            'default_value' => 'WHAT WE DO',
        ),
        array(
            'key' => 'field_home_what_we_do_title',
            'label' => 'What We Do Title',
            'name' => 'what_we_do_title',
            'type' => 'text',
            'default_value' => 'Plant Trees, Plant Hope',
        ),
        array(
            'key' => 'field_home_what_we_do_description',
            'label' => 'What We Do Description',
            'name' => 'what_we_do_description',
            'type' => 'textarea',
            'default_value' => 'We channel support from businesses, individuals, and foundations to cost-effective tree-planting projects.',
            'rows' => 8,
            'new_lines' => 'br',
        ),
        array(
            'key' => 'field_home_what_we_do_image',
            'label' => 'What We Do Image',
            'name' => 'what_we_do_image',
            'type' => 'image',
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'page',
                'operator' => '==',
                'value' => $front_page_id,
            ),
        ),
    ),
    'menu_order' => 10,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'active' => true,
)); 