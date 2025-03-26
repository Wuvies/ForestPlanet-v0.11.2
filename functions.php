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
    
    // Stories page styles - only on stories page template
    if (is_page_template('page-stories.php')) {
        wp_enqueue_style('forestplanet-stories', get_template_directory_uri() . '/assets/css/stories.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');
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
    // Only enqueue on single story posts or story archives
    if (is_singular('story') || is_post_type_archive('story') || is_tax('story_category')) {
        wp_enqueue_style(
            'forestplanet-story-template', 
            get_template_directory_uri() . '/assets/css/story-template.css',
            array('forestplanet-styleguide', 'forestplanet-main'),
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

/**
 * Register custom post types
 */
function forestplanet_register_post_types() {
    // Register Story custom post type
    $labels = [
        'name'                  => _x('Stories', 'Post type general name', 'forestplanet'),
        'singular_name'         => _x('Story', 'Post type singular name', 'forestplanet'),
        'menu_name'             => _x('Stories', 'Admin Menu text', 'forestplanet'),
        'name_admin_bar'        => _x('Story', 'Add New on Toolbar', 'forestplanet'),
        'add_new'               => __('Add New', 'forestplanet'),
        'add_new_item'          => __('Add New Story', 'forestplanet'),
        'new_item'              => __('New Story', 'forestplanet'),
        'edit_item'             => __('Edit Story', 'forestplanet'),
        'view_item'             => __('View Story', 'forestplanet'),
        'all_items'             => __('All Stories', 'forestplanet'),
        'search_items'          => __('Search Stories', 'forestplanet'),
        'parent_item_colon'     => __('Parent Stories:', 'forestplanet'),
        'not_found'             => __('No stories found.', 'forestplanet'),
        'not_found_in_trash'    => __('No stories found in Trash.', 'forestplanet'),
        'featured_image'        => _x('Story Cover Image', 'Overrides the "Featured Image" phrase', 'forestplanet'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the "Set featured image" phrase', 'forestplanet'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the "Remove featured image" phrase', 'forestplanet'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the "Use as featured image" phrase', 'forestplanet'),
        'archives'              => _x('Story archives', 'The post type archive label used in nav menus', 'forestplanet'),
        'insert_into_item'      => _x('Insert into story', 'Overrides the "Insert into post" phrase', 'forestplanet'),
        'uploaded_to_this_item' => _x('Uploaded to this story', 'Overrides the "Uploaded to this post" phrase', 'forestplanet'),
        'filter_items_list'     => _x('Filter stories list', 'Screen reader text for the filter links', 'forestplanet'),
        'items_list_navigation' => _x('Stories list navigation', 'Screen reader text for the pagination', 'forestplanet'),
        'items_list'            => _x('Stories list', 'Screen reader text for the items list', 'forestplanet'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'stories'],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'],
        'show_in_rest'       => true,
    ];

    register_post_type('story', $args);
    
    // Register Story Category taxonomy
    $tax_labels = [
        'name'                       => _x('Story Categories', 'taxonomy general name', 'forestplanet'),
        'singular_name'              => _x('Story Category', 'taxonomy singular name', 'forestplanet'),
        'search_items'               => __('Search Story Categories', 'forestplanet'),
        'popular_items'              => __('Popular Story Categories', 'forestplanet'),
        'all_items'                  => __('All Story Categories', 'forestplanet'),
        'parent_item'                => __('Parent Story Category', 'forestplanet'),
        'parent_item_colon'          => __('Parent Story Category:', 'forestplanet'),
        'edit_item'                  => __('Edit Story Category', 'forestplanet'),
        'update_item'                => __('Update Story Category', 'forestplanet'),
        'add_new_item'               => __('Add New Story Category', 'forestplanet'),
        'new_item_name'              => __('New Story Category Name', 'forestplanet'),
        'separate_items_with_commas' => __('Separate story categories with commas', 'forestplanet'),
        'add_or_remove_items'        => __('Add or remove story categories', 'forestplanet'),
        'choose_from_most_used'      => __('Choose from the most used story categories', 'forestplanet'),
        'not_found'                  => __('No story categories found.', 'forestplanet'),
        'menu_name'                  => __('Story Categories', 'forestplanet'),
    ];

    $tax_args = [
        'hierarchical'      => true,
        'labels'            => $tax_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'story-category'],
        'show_in_rest'      => true,
    ];

    register_taxonomy('story_category', ['story'], $tax_args);
    
    // Register Podcast custom post type
    $podcast_labels = [
        'name'                  => _x('Podcasts', 'Post type general name', 'forestplanet'),
        'singular_name'         => _x('Podcast', 'Post type singular name', 'forestplanet'),
        'menu_name'             => _x('Podcasts', 'Admin Menu text', 'forestplanet'),
        'name_admin_bar'        => _x('Podcast', 'Add New on Toolbar', 'forestplanet'),
        'add_new'               => __('Add New', 'forestplanet'),
        'add_new_item'          => __('Add New Podcast', 'forestplanet'),
        'new_item'              => __('New Podcast', 'forestplanet'),
        'edit_item'             => __('Edit Podcast', 'forestplanet'),
        'view_item'             => __('View Podcast', 'forestplanet'),
        'all_items'             => __('All Podcasts', 'forestplanet'),
        'search_items'          => __('Search Podcasts', 'forestplanet'),
        'parent_item_colon'     => __('Parent Podcasts:', 'forestplanet'),
        'not_found'             => __('No podcasts found.', 'forestplanet'),
        'not_found_in_trash'    => __('No podcasts found in Trash.', 'forestplanet'),
        'featured_image'        => _x('Podcast Cover Image', 'Overrides the "Featured Image" phrase', 'forestplanet'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the "Set featured image" phrase', 'forestplanet'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the "Remove featured image" phrase', 'forestplanet'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the "Use as featured image" phrase', 'forestplanet'),
        'archives'              => _x('Podcast archives', 'The post type archive label used in nav menus', 'forestplanet'),
        'insert_into_item'      => _x('Insert into podcast', 'Overrides the "Insert into post" phrase', 'forestplanet'),
        'uploaded_to_this_item' => _x('Uploaded to this podcast', 'Overrides the "Uploaded to this post" phrase', 'forestplanet'),
        'filter_items_list'     => _x('Filter podcasts list', 'Screen reader text for the filter links', 'forestplanet'),
        'items_list_navigation' => _x('Podcasts list navigation', 'Screen reader text for the pagination', 'forestplanet'),
        'items_list'            => _x('Podcasts list', 'Screen reader text for the items list', 'forestplanet'),
    ];

    $podcast_args = [
        'labels'             => $podcast_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'podcasts'],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-microphone',
        'supports'           => ['title', 'editor', 'author', 'thumbnail', 'excerpt'],
        'show_in_rest'       => true,
    ];

    register_post_type('podcast', $podcast_args);
    
    // Register Podcast Category taxonomy
    $podcast_tax_labels = [
        'name'                       => _x('Podcast Categories', 'taxonomy general name', 'forestplanet'),
        'singular_name'              => _x('Podcast Category', 'taxonomy singular name', 'forestplanet'),
        'search_items'               => __('Search Podcast Categories', 'forestplanet'),
        'popular_items'              => __('Popular Podcast Categories', 'forestplanet'),
        'all_items'                  => __('All Podcast Categories', 'forestplanet'),
        'parent_item'                => __('Parent Podcast Category', 'forestplanet'),
        'parent_item_colon'          => __('Parent Podcast Category:', 'forestplanet'),
        'edit_item'                  => __('Edit Podcast Category', 'forestplanet'),
        'update_item'                => __('Update Podcast Category', 'forestplanet'),
        'add_new_item'               => __('Add New Podcast Category', 'forestplanet'),
        'new_item_name'              => __('New Podcast Category Name', 'forestplanet'),
        'separate_items_with_commas' => __('Separate podcast categories with commas', 'forestplanet'),
        'add_or_remove_items'        => __('Add or remove podcast categories', 'forestplanet'),
        'choose_from_most_used'      => __('Choose from the most used podcast categories', 'forestplanet'),
        'not_found'                  => __('No podcast categories found.', 'forestplanet'),
        'menu_name'                  => __('Podcast Categories', 'forestplanet'),
    ];

    $podcast_tax_args = [
        'hierarchical'      => true,
        'labels'            => $podcast_tax_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'podcast-category'],
        'show_in_rest'      => true,
    ];

    register_taxonomy('podcast_category', ['podcast'], $podcast_tax_args);
}
add_action('init', 'forestplanet_register_post_types');

/**
 * Register ACF fields for Podcast post type
 */
function forestplanet_register_podcast_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_podcast_details',
            'title' => 'Podcast Details',
            'fields' => array(
                array(
                    'key' => 'field_podcast_name',
                    'label' => 'Podcast Name',
                    'name' => 'podcast_name',
                    'type' => 'text',
                    'instructions' => 'Enter the name of the podcast show (not the episode title)',
                    'required' => 1,
                    'placeholder' => 'e.g. The Forest Planet Podcast',
                ),
                array(
                    'key' => 'field_podcast_url',
                    'label' => 'Listen URL',
                    'name' => 'podcast_url',
                    'type' => 'url',
                    'instructions' => 'Enter the URL where this podcast episode can be listened to',
                    'required' => 1,
                    'placeholder' => 'https://...',
                ),
                array(
                    'key' => 'field_podcast_episode_number',
                    'label' => 'Episode Number',
                    'name' => 'podcast_episode_number',
                    'type' => 'text',
                    'instructions' => 'Enter the episode number/code (e.g. S1E5, #42)',
                    'required' => 0,
                    'placeholder' => 'e.g. S2E3',
                ),
                array(
                    'key' => 'field_podcast_duration',
                    'label' => 'Duration',
                    'name' => 'podcast_duration',
                    'type' => 'text',
                    'instructions' => 'Enter the duration of the podcast episode',
                    'required' => 0,
                    'placeholder' => 'e.g. 45 min',
                ),
                array(
                    'key' => 'field_podcast_host',
                    'label' => 'Host',
                    'name' => 'podcast_host',
                    'type' => 'text',
                    'instructions' => 'Enter the name of the podcast host',
                    'required' => 0,
                    'placeholder' => 'e.g. John Smith',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'podcast',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 1,
        ));
    }
}
add_action('acf/init', 'forestplanet_register_podcast_acf_fields');

/**
 * Helper function to display a podcast card
 *
 * @param int|WP_Post $post_id Post ID or post object. Default is global $post.
 * @param string $view View type ('desktop' or 'mobile'). Default is 'desktop'.
 * @param bool $is_about_page Whether this is for the about page, which has different styling. Default is false.
 * @return void
 */
function forestplanet_display_podcast_card($post_id = null, $view = 'desktop', $is_about_page = false) {
    // If $post_id is not provided, use the current post
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    // Check if post exists and is a podcast
    $post = get_post($post_id);
    if (!$post || get_post_type($post) !== 'podcast') {
        return;
    }
    
    // Pass the arguments to the template part
    get_template_part('template-parts/podcasts/card', null, array(
        'post_id' => $post_id,
        'view' => $view,
        'is_about_page' => $is_about_page
    ));
}

/**
 * AJAX handler for loading more stories
 */
function forestplanet_load_more_stories() {
    // Verify nonce for security
    if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'load_more_stories_nonce')) {
        wp_send_json_error('Invalid security token');
        die();
    }

    // Get variables from request
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? intval($_POST['category']) : 0;
    
    // Set up quote content for interspersing
    $quotes = array(
        array(
            'text' => 'The best time to plant a tree is 20 years ago. The second best time is NOW.',
            'attribution' => 'African Proverb'
        ),
        array(
            'text' => 'He who plants a tree plants hope.',
            'attribution' => 'Lucy Larcom'
        ),
        array(
            'text' => 'The creation of a thousand forests is in one acorn.',
            'attribution' => 'Ralph Waldo Emerson'
        ),
        array(
            'text' => 'Trees are poems that the earth writes upon the sky.',
            'attribution' => 'Kahlil Gibran'
        )
    );
    
    // Query arguments
    $args = array(
        'post_type' => 'story',
        'posts_per_page' => 12,
        'paged' => $page,
        'offset' => ($page === 1) ? 1 : 0, // Skip featured post only on first page
    );
    
    // Add category if specified
    if ($category > 0) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'story_category',
                'field' => 'term_id',
                'terms' => $category
            )
        );
    }
    
    $stories_query = new WP_Query($args);
    $html = '';
    
    // Counter for inserting quotes
    $post_count = 0;
    $quote_index = 0;
    
    if ($stories_query->have_posts()) {
        ob_start(); // Start output buffering
        
        while ($stories_query->have_posts()) {
            $stories_query->the_post();
            
            // Get story categories for data attributes
            $story_categories = get_the_terms(get_the_ID(), 'story_category');
            $category_classes = '';
            $category_slugs = array();
            
            if(!empty($story_categories) && !is_wp_error($story_categories)) {
                foreach($story_categories as $cat) {
                    $category_classes .= ' category-' . $cat->slug;
                    $category_slugs[] = $cat->slug;
                }
            }
            
            // Display a story
            ?>
            <a href="<?php the_permalink(); ?>">
                <article class="story-card<?php echo esc_attr($category_classes); ?>" data-categories="<?php echo esc_attr(implode(',', $category_slugs)); ?>">
                    <?php if(has_post_thumbnail()): ?>
                        <img class="story-card-image" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                    <?php endif; ?>
                    <div class="story-card-content">
                        <div class="story-card-date subtitle-2"><?php echo esc_html(get_the_date('M d Y')); ?></div>
                        <p class="story-card-title body-1-semibold"><?php echo esc_html(get_the_title()); ?></p>
                        <p class="story-card-description body-2-regular">
                            <?php echo wp_trim_words(get_the_excerpt(), 12, '...'); ?>
                        </p>
                    </div>
                </article>
            </a>
            <?php
            
            $post_count++;
            
            // Insert a quote after every 3-4 posts (if we still have quotes)
            if($post_count % 3 == 0 && $quote_index < count($quotes)): ?>
                <article class="quote-card">
                    <div class="quote-card-content">
                        <p class="quote-text heading-3">
                            <?php echo esc_html($quotes[$quote_index]['text']); ?>
                        </p>
                        <div class="quote-attribution body-1-regular"><?php echo esc_html($quotes[$quote_index]['attribution']); ?></div>
                    </div>
                </article>
                <?php
                $quote_index++;
            endif;
        }
        
        wp_reset_postdata();
        $html = ob_get_clean(); // Get the buffered content
    }
    
    wp_send_json_success(array(
        'html' => $html,
        'found_posts' => $stories_query->found_posts,
        'max_pages' => $stories_query->max_num_pages
    ));
    
    die();
}
add_action('wp_ajax_load_more_stories', 'forestplanet_load_more_stories');
add_action('wp_ajax_nopriv_load_more_stories', 'forestplanet_load_more_stories');

/**
 * Create default story categories on theme activation
 */
function forestplanet_create_default_categories() {
    // Define default story categories
    $default_categories = array(
        'agroforestry' => 'Agroforestry',
        'mangroves' => 'Mangroves',
        'tree-nursery' => 'Tree Nursery',
        'technology' => 'Technology',
        'partners' => 'Partners'
    );
    
    // Loop through each category and add it if it doesn't exist
    foreach ($default_categories as $slug => $name) {
        if (!term_exists($slug, 'story_category')) {
            wp_insert_term(
                $name,
                'story_category',
                array(
                    'slug' => $slug,
                    'description' => 'Stories about ' . strtolower($name)
                )
            );
        }
    }
    
    // Define default podcast categories
    $default_podcast_categories = array(
        'interviews' => 'Interviews',
        'events' => 'Events',
        'educational' => 'Educational',
        'partner-spotlights' => 'Partner Spotlights',
        'news' => 'News Updates'
    );
    
    // Loop through each podcast category and add it if it doesn't exist
    foreach ($default_podcast_categories as $slug => $name) {
        if (!term_exists($slug, 'podcast_category')) {
            wp_insert_term(
                $name,
                'podcast_category',
                array(
                    'slug' => $slug,
                    'description' => 'Podcasts featuring ' . strtolower($name)
                )
            );
        }
    }
}
add_action('after_switch_theme', 'forestplanet_create_default_categories');

/**
 * Enqueue story archive styles
 */
function forestplanet_enqueue_story_archive_styles() {
    // Only enqueue on story archives or taxonomy pages
    if (is_post_type_archive('story') || is_tax('story_category')) {
        wp_enqueue_style('forestplanet-stories', get_template_directory_uri() . '/assets/css/stories.css', ['forestplanet-styleguide', 'forestplanet-main'], '1.0.0');
        
        // Add custom pagination styles
        wp_add_inline_style('forestplanet-stories', '
            .stories-mobile .pagination,
            .stories-desktop-all-breakpoints .pagination {
                margin-top: 2rem;
                text-align: center;
            }
            
            .pagination ul {
                display: flex;
                list-style: none;
                padding: 0;
                margin: 0;
                justify-content: center;
                flex-wrap: wrap;
                gap: 0.5rem;
            }
            
            .pagination li {
                margin: 0 0.25rem;
            }
            
            .pagination a,
            .pagination span {
                display: flex;
                align-items: center;
                justify-content: center;
                min-width: 2.5rem;
                height: 2.5rem;
                padding: 0 0.75rem;
                background-color: #f5f5f5;
                color: #333;
                text-decoration: none;
                border-radius: 4px;
                transition: all 0.3s ease;
            }
            
            .pagination a:hover,
            .pagination span.current {
                background-color: #4CAF50;
                color: white;
            }
            
            .pagination .prev,
            .pagination .next {
                padding: 0 1rem;
            }
        ');
    }
}
add_action('wp_enqueue_scripts', 'forestplanet_enqueue_story_archive_styles');