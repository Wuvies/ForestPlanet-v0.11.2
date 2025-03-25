<?php
/**
 * ForestPlanet Theme Functions
 *
 * @package ForestPlanet
 */

// Include required files
// Custom Menu Walker
require_once get_template_directory() . '/inc/class-forestplanet-menu-walker.php';
// Theme Customizer options 
require_once get_template_directory() . '/inc/theme-customizer.php';

/**
 * Enqueue styles
 */
function forestplanet_enqueue_styles() {
    // Required theme stylesheet (minimal)
    wp_enqueue_style('forestplanet-style', get_stylesheet_uri(), [], '1.0.0');
    
    // Design system/styleguide first (no dependencies)
    wp_enqueue_style('forestplanet-styleguide', get_template_directory_uri() . '/assets/css/styleguide.css', [], '1.0.0');
    
    // Main stylesheet depends on styleguide
    wp_enqueue_style('forestplanet-main', get_template_directory_uri() . '/assets/css/main.css', ['forestplanet-styleguide'], '1.0.0');
    
    // Component styles depend on main and styleguide
    wp_enqueue_style('forestplanet-header', get_template_directory_uri() . '/assets/css/header.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');
    
    // More CSS files...
    wp_enqueue_style('forestplanet-footer', get_template_directory_uri() . '/assets/css/footer.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');
    
    // Mobile menu styles
    wp_enqueue_style('forestplanet-mobile-menu', get_template_directory_uri() . '/assets/css/mobile-menu.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');

    // Home page styles - only on front page
    if (is_front_page()) {
        wp_enqueue_style('forestplanet-home', get_template_directory_uri() . '/assets/css/home.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');
    }
    
    // About page styles - only on about page template
    if (is_page_template('page-about.php')) {
        wp_enqueue_style('forestplanet-about', get_template_directory_uri() . '/assets/css/about.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');
    }
    
    // Invite Us page styles - only on invite us page template
    if (is_page_template('page-invite.php')) {
        wp_enqueue_style('forestplanet-invite', get_template_directory_uri() . '/assets/css/invite.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');
    }
    
    // Invite Confirmation page styles - only on invite confirmation page template
    if (is_page_template('page-invite-confirmation.php')) {
        wp_enqueue_style('forestplanet-invite-confirmation', get_template_directory_uri() . '/assets/css/invite-confirmation.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');
    }
    
    // Donate page styles - only on donate page template
    if (is_page_template('page-donate.php')) {
        wp_enqueue_style('forestplanet-donate', get_template_directory_uri() . '/assets/css/donate.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');
    }
    
    // Donate Checkout page styles - only on donate checkout page template
    if (is_page_template('page-donate-checkout.php')) {
        wp_enqueue_style('forestplanet-donate-checkout', get_template_directory_uri() . '/assets/css/donate-checkout.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');
    }
    
    // Partner page styles - only on partner page template
    if (is_page_template('page-partner.php')) {
        wp_enqueue_style('forestplanet-partner', get_template_directory_uri() . '/assets/css/partner.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');
    }
    
    // Partner Confirmation page styles - only on partner confirmation page template
    if (is_page_template('page-partner-confirmation.php')) {
        wp_enqueue_style('forestplanet-partner-confirmation', get_template_directory_uri() . '/assets/css/partner-confirmation.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');
    }
}
add_action('wp_enqueue_scripts', 'forestplanet_enqueue_styles');

/**
 * Enqueue scripts
 */
function forestplanet_enqueue_scripts() {
    // Enqueue jQuery
    wp_enqueue_script('jquery');
    
    // Main JavaScript file
    wp_enqueue_script(
        'forestplanet-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        ['jquery'],
        '1.0.0',
        true
    );
    
    // Mobile menu functionality
    wp_enqueue_script(
        'forestplanet-mobile-menu', 
        get_template_directory_uri() . '/assets/js/mobile-menu-overlay.js',
        ['jquery', 'forestplanet-main-js'],
        '1.0.0',
        true
    );
    
    // Image comparison slider (only on front page)
    if (is_front_page()) {
        wp_enqueue_script(
            'forestplanet-image-comparison',
            get_template_directory_uri() . '/assets/js/image-comparison.js',
            ['jquery'],
            '1.0.0',
            true
        );
        
        // Google Maps implementation (must be loaded BEFORE the API)
        wp_enqueue_script(
            'forestplanet-google-maps',
            get_template_directory_uri() . '/assets/js/google-maps.js',
            ['jquery'],
            '1.0.0',
            true
        );
        
        // Google Maps API - make callback load after our maps script is loaded
        wp_enqueue_script(
            'google-maps-api',
            'https://maps.googleapis.com/maps/api/js?key=AIzaSyDSmeebBc_qKg-lMWboxtSLB9qYFVi2Fc4&callback=ForestPlanet.maps.initMap',
            ['forestplanet-google-maps'],
            null,
            true
        );
        
        // Make sure Google Maps loads after our implementation
        wp_script_add_data('google-maps-api', 'defer', true);
    }
    
    // Localize script with site data
    wp_localize_script('forestplanet-mobile-menu', 'siteSettings', [
        'homeUrl' => esc_url(home_url('/')),
        'templateUrl' => esc_url(get_template_directory_uri()),
        'mobileMenuItems' => forestplanet_get_mobile_menu_items(),
    ]);
    
    // Conditionally load other scripts as needed
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'forestplanet_enqueue_scripts');

/**
 * Generate mobile menu HTML from WordPress menus
 */
function forestplanet_get_mobile_menu_items() {
    // Get the primary menu items
    $locations = get_nav_menu_locations();
    
    // If no menu is set, return empty
    if (!isset($locations['primary'])) {
        return '';
    }
    
    $menu = wp_get_nav_menu_object($locations['primary']);
    
    if (!$menu) {
        return '';
    }
    
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    
    if (!$menu_items) {
        return '';
    }
    
    $html = '';
    
    foreach ($menu_items as $item) {
        $html .= '<a href="' . esc_url($item->url) . '" class="mobile-menu-item">';
        $html .= '<div class="mobile-menu-item-text">' . esc_html($item->title) . '</div>';
        $html .= '</a>';
    }
    
    return $html;
}

/**
 * Enqueue story template styles
 */
function forestplanet_enqueue_story_styles() {
    // Only enqueue on single post templates or story templates
    if (is_single() || is_page_template('single-story.php') || is_page_template('template-story.php')) {
        wp_enqueue_style(
            'forestplanet-story-template', 
            get_template_directory_uri() . '/assets/css/story-template.css',
            array(),
            wp_get_theme()->get('Version')
        );
    }
}
add_action('wp_enqueue_scripts', 'forestplanet_enqueue_story_styles');

/**
 * Theme setup function
 */
function forestplanet_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for full and wide align images
    add_theme_support('align-wide');
    
    // Add support for custom logo
    add_theme_support('custom-logo', [
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ]);
    
    // Add HTML5 support
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Register navigation menus
    register_nav_menus([
        'primary' => esc_html__('Primary Menu', 'forestplanet'),
        'footer'  => esc_html__('Footer Menu', 'forestplanet'),
        'social'  => esc_html__('Social Links Menu', 'forestplanet'),
    ]);
    
    // Add custom color palette for Gutenberg
    add_theme_support('editor-color-palette', [
        [
            'name'  => esc_html__('Primary', 'forestplanet'),
            'slug'  => 'primary',
            'color' => '#4CAF50',
        ],
        [
            'name'  => esc_html__('Secondary', 'forestplanet'),
            'slug'  => 'secondary',
            'color' => '#2E7D32',
        ],
        [
            'name'  => esc_html__('Accent', 'forestplanet'),
            'slug'  => 'accent',
            'color' => '#8BC34A',
        ],
    ]);
}
add_action('after_setup_theme', 'forestplanet_theme_setup');