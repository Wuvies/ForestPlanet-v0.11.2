<?php
/**
 * The template for displaying partner archives
 *
 * @package ForestPlanet
 */

get_header();
?>

<div class="partners-desktop-all-breakpoints screen">
    <div class="main-content">
        <div class="partners">
            <h1 class="title"><?php _e('Our Partners', 'forestplanet'); ?></h1>
            
            <?php
            // Output partner categories if they exist
            $terms = get_terms(array(
                'taxonomy' => 'partner_category',
                'hide_empty' => true,
            ));
            
            if (!empty($terms) && !is_wp_error($terms)) : ?>
                <div class="partner-categories">
                    <a href="<?php echo esc_url(get_post_type_archive_link('partner')); ?>" class="partner-category-link <?php echo is_post_type_archive('partner') && !isset($_GET['category']) ? 'active' : ''; ?>">
                        <?php _e('All', 'forestplanet'); ?>
                    </a>
                    <?php foreach ($terms as $term) : ?>
                        <a href="<?php echo esc_url(add_query_arg('category', $term->slug, get_post_type_archive_link('partner'))); ?>" class="partner-category-link <?php echo isset($_GET['category']) && $_GET['category'] === $term->slug ? 'active' : ''; ?>">
                            <?php echo esc_html($term->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <section class="partner-cards" aria-label="Partner logos">
                <?php
                // Set up the query for partners
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
                
                $args = array(
                    'post_type' => 'partner',
                    'posts_per_page' => 20,
                    'paged' => $paged,
                    'orderby' => 'title',
                    'order' => 'ASC',
                );
                
                // Add category filter if set
                if (!empty($category)) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'partner_category',
                            'field' => 'slug',
                            'terms' => $category,
                        ),
                    );
                }
                
                // Get foundation partners separately (for desktop only)
                $foundation_args = array(
                    'post_type' => 'partner',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'partner_is_foundation',
                            'value' => '1',
                            'compare' => '=',
                        ),
                    ),
                );
                
                // Filter out foundation partners from main query
                $args['meta_query'] = array(
                    array(
                        'key' => 'partner_is_foundation',
                        'value' => '1',
                        'compare' => '!=',
                    ),
                );
                
                $partners_query = new WP_Query($args);
                
                if ($partners_query->have_posts()) :
                    while ($partners_query->have_posts()) : $partners_query->the_post();
                        forestplanet_display_partner_card(get_the_ID());
                    endwhile;
                    
                    // Pagination
                    echo '<div class="partners-pagination">';
                    echo paginate_links(array(
                        'total' => $partners_query->max_num_pages,
                        'current' => max(1, get_query_var('paged')),
                        'prev_text' => __('&laquo; Previous', 'forestplanet'),
                        'next_text' => __('Next &raquo;', 'forestplanet'),
                    ));
                    echo '</div>';
                    
                    wp_reset_postdata();
                else :
                    echo '<p class="no-partners">' . __('No partners found.', 'forestplanet') . '</p>';
                endif;
                ?>
            </section>
        </div>
        
        <?php
        // Foundations section (desktop)
        $foundation_query = new WP_Query($foundation_args);
        
        if ($foundation_query->have_posts()) :
            // Desktop foundations section
            ?>
            <div class="palmer-foundation">
                <h2 class="foundation-title heading-2"><?php _e('Our Partnered Foundations', 'forestplanet'); ?></h2>
                
                <?php
                while ($foundation_query->have_posts()) : $foundation_query->the_post();
                    $post_id = get_the_ID();
                    $logo_url = has_post_thumbnail() ? get_the_post_thumbnail_url($post_id, 'medium') : '';
                    $description = get_field('partner_short_description', $post_id);
                    $quote = get_field('partner_foundation_quote', $post_id);
                    ?>
                    <div class="foundation-content">
                        <div class="foundation-image">
                            <?php if (!empty($logo_url)) : ?>
                                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?> logo" />
                            <?php endif; ?>
                        </div>
                        <div class="foundation-text">
                            <?php if (!empty($description)) : ?>
                                <p class="body-2-regular">
                                    <?php echo esc_html($description); ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php if (!empty($quote)) : ?>
                                <p class="body-2-regular foundation-quote">
                                    "<?php echo esc_html($quote); ?>"
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>
        
        <div class="make-an-impact">
            <p class="make-an-impact-with-forest-planet heading-2"><?php _e('Make an Impact with ForestPlanet', 'forestplanet'); ?></p>
            <div class="frame-240">
                <p class="empower-your-busines body-2-regular">
                    <?php _e('Empower your business to create lasting impact by partnering with ForestPlanet. Together, we can turn sustainability into action, restoring ecosystems and uplifting communities worldwide. Join our network of forward-thinking businesses and make a difference—one tree at a time.', 'forestplanet'); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/partner')); ?>">
                    <div class="primary-button-romance">
                        <div class="primary-button-mirage-text body-2-regular"><?php _e('Partner', 'forestplanet'); ?></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="partners-mobile screen">
    <div class="main-content-1">
        <div class="partners-1">
            <h1 class="title-1"><?php _e('Our Partners', 'forestplanet'); ?></h1>
            
            <?php
            // Output partner categories if they exist for mobile
            if (!empty($terms) && !is_wp_error($terms)) : ?>
                <div class="partner-categories">
                    <a href="<?php echo esc_url(get_post_type_archive_link('partner')); ?>" class="partner-category-link <?php echo is_post_type_archive('partner') && !isset($_GET['category']) ? 'active' : ''; ?>">
                        <?php _e('All', 'forestplanet'); ?>
                    </a>
                    <?php foreach ($terms as $term) : ?>
                        <a href="<?php echo esc_url(add_query_arg('category', $term->slug, get_post_type_archive_link('partner'))); ?>" class="partner-category-link <?php echo isset($_GET['category']) && $_GET['category'] === $term->slug ? 'active' : ''; ?>">
                            <?php echo esc_html($term->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <section class="partner-cards" aria-label="Partner logos">
                <?php
                // Reset the query for mobile display
                $partners_query = new WP_Query($args);
                
                if ($partners_query->have_posts()) :
                    while ($partners_query->have_posts()) : $partners_query->the_post();
                        forestplanet_display_partner_card(get_the_ID());
                    endwhile;
                    
                    // Pagination for mobile
                    echo '<div class="partners-pagination">';
                    echo paginate_links(array(
                        'total' => $partners_query->max_num_pages,
                        'current' => max(1, get_query_var('paged')),
                        'prev_text' => __('&laquo;', 'forestplanet'),
                        'next_text' => __('&raquo;', 'forestplanet'),
                    ));
                    echo '</div>';
                    
                    wp_reset_postdata();
                else :
                    echo '<p class="no-partners">' . __('No partners found.', 'forestplanet') . '</p>';
                endif;
                ?>
            </section>
        </div>
        
        <?php
        // Mobile foundations section
        $foundation_query = new WP_Query($foundation_args);
        
        if ($foundation_query->have_posts()) :
            ?>
            <div class="palmer-foundation-mobile">
                <h2 class="foundation-title-mobile heading-2-mobile"><?php _e('Our Partnered Foundations', 'forestplanet'); ?></h2>
                
                <?php
                while ($foundation_query->have_posts()) : $foundation_query->the_post();
                    $post_id = get_the_ID();
                    $logo_url = has_post_thumbnail() ? get_the_post_thumbnail_url($post_id, 'medium') : '';
                    $description = get_field('partner_short_description', $post_id);
                    $quote = get_field('partner_foundation_quote', $post_id);
                    ?>
                    <div class="foundation-content-mobile">
                        <div class="foundation-image-mobile">
                            <?php if (!empty($logo_url)) : ?>
                                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?> logo" />
                            <?php endif; ?>
                        </div>
                        <div class="foundation-text-mobile">
                            <?php if (!empty($description)) : ?>
                                <p class="body-2-regular">
                                    <?php echo esc_html($description); ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php if (!empty($quote)) : ?>
                                <p class="body-2-regular foundation-quote-mobile">
                                    "<?php echo esc_html($quote); ?>"
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>
        
        <div class="make-an-impact-1">
            <p class="make-an-impact-with-forest-planet-1 heading-2-mobile"><?php _e('Make an Impact with ForestPlanet', 'forestplanet'); ?></p>
            <div class="frame-240-1">
                <p class="empower-your-busines-1 body-2-regular">
                    <?php _e('Empower your business to create lasting impact by partnering with ForestPlanet. Together, we can turn sustainability into action, restoring ecosystems and uplifting communities worldwide. Join our network of forward-thinking businesses and make a difference—one tree at a time.', 'forestplanet'); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/partner')); ?>">
                    <div class="primary-button-romance">
                        <div class="primary-button-mirage-text body-2-regular"><?php _e('Partner', 'forestplanet'); ?></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Partner Modal Overlay -->
<div id="partner-modal-overlay" class="partner-modal-overlay">
    <div class="partner-modal-container">
        <div class="partner-modal-header">
            <button class="partner-modal-close" aria-label="Close modal"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/X.svg" alt="Close"></button>
            <h2 class="partner-modal-title heading-2"><?php _e('Partner Name', 'forestplanet'); ?></h2>
        </div>
        <div class="partner-modal-content">
            <div class="partner-modal-image">
                <img src="" alt="Partner logo" class="partner-modal-logo">
            </div>
            <div class="partner-modal-details">
                <p class="partner-modal-description body-2-regular"><?php _e('Partner description will appear here.', 'forestplanet'); ?></p>
                <div class="partner-modal-link tertiary-button">
                    <div class="secondary-button-mirage-text body-2-regular"><?php _e('Visit Partner Website', 'forestplanet'); ?></div>
                    <img class="link-external" src="<?php echo get_template_directory_uri(); ?>/assets/images/link-external.svg" alt="Link External" />
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer(); 