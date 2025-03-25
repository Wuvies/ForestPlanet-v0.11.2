<?php
/**
 * ForestPlanet Theme Customizer
 *
 * @package ForestPlanet
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function forestplanet_customize_register($wp_customize) {
    // Add Contact Information Section
    $wp_customize->add_section('forestplanet_contact_info', array(
        'title'    => __('Contact Information', 'forestplanet'),
        'priority' => 120,
    ));
    
    // Address
    $wp_customize->add_setting('forestplanet_address', array(
        'default'           => '5028 Wisconsin Avenue NW Suite 100<br />Washington, DC 20016',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('forestplanet_address', array(
        'label'       => __('Office Address', 'forestplanet'),
        'description' => __('Enter the organization address (HTML allowed)', 'forestplanet'),
        'section'     => 'forestplanet_contact_info',
        'type'        => 'textarea',
    ));
    
    // Phone
    $wp_customize->add_setting('forestplanet_phone', array(
        'default'           => '+1-202-792-8060',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('forestplanet_phone', array(
        'label'   => __('Phone Number', 'forestplanet'),
        'section' => 'forestplanet_contact_info',
        'type'    => 'text',
    ));
    
    // EIN
    $wp_customize->add_setting('forestplanet_ein', array(
        'default'           => 'EIN: 81-5025238',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('forestplanet_ein', array(
        'label'   => __('EIN Number', 'forestplanet'),
        'section' => 'forestplanet_contact_info',
        'type'    => 'text',
    ));
    
    // Add Social Media Links Section
    $wp_customize->add_section('forestplanet_social_media', array(
        'title'    => __('Social Media Links', 'forestplanet'),
        'priority' => 130,
    ));
    
    // Facebook
    $wp_customize->add_setting('forestplanet_facebook', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('forestplanet_facebook', array(
        'label'   => __('Facebook URL', 'forestplanet'),
        'section' => 'forestplanet_social_media',
        'type'    => 'url',
    ));
    
    // LinkedIn
    $wp_customize->add_setting('forestplanet_linkedin', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('forestplanet_linkedin', array(
        'label'   => __('LinkedIn URL', 'forestplanet'),
        'section' => 'forestplanet_social_media',
        'type'    => 'url',
    ));
    
    // Instagram
    $wp_customize->add_setting('forestplanet_instagram', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('forestplanet_instagram', array(
        'label'   => __('Instagram URL', 'forestplanet'),
        'section' => 'forestplanet_social_media',
        'type'    => 'url',
    ));
    
    // YouTube
    $wp_customize->add_setting('forestplanet_youtube', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('forestplanet_youtube', array(
        'label'   => __('YouTube URL', 'forestplanet'),
        'section' => 'forestplanet_social_media',
        'type'    => 'url',
    ));
    
    // Add Non-Profit Information Section
    $wp_customize->add_section('forestplanet_nonprofit_info', array(
        'title'    => __('Non-Profit Information', 'forestplanet'),
        'priority' => 140,
    ));
    
    // IRS 990 Form
    $wp_customize->add_setting('forestplanet_990_form', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('forestplanet_990_form', array(
        'label'   => __('IRS 990 Form URL', 'forestplanet'),
        'section' => 'forestplanet_nonprofit_info',
        'type'    => 'url',
    ));
    
    // IRS Determination Letter
    $wp_customize->add_setting('forestplanet_determination_letter', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('forestplanet_determination_letter', array(
        'label'   => __('IRS Determination Letter URL', 'forestplanet'),
        'section' => 'forestplanet_nonprofit_info',
        'type'    => 'url',
    ));
}
add_action('customize_register', 'forestplanet_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function forestplanet_customize_preview_js() {
    wp_enqueue_script('forestplanet-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), '20230101', true);
}
add_action('customize_preview_init', 'forestplanet_customize_preview_js'); 