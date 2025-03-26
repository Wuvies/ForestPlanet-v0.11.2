<?php
/**
 * The template for displaying story category archives
 *
 * @package ForestPlanet
 */

get_header();

// Get current category
$current_category = get_queried_object();

// Get all story categories for filtering
$categories = get_terms(array(
    'taxonomy' => 'story_category',
    'orderby' => 'name',
    'order'   => 'ASC',
    'hide_empty' => true
));

// Quote content - these could be moved to a custom post type or ACF field in the future
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
?>

<!-- Mobile Version -->
<div class="stories-mobile screen">
    <div class="main-content">
        <div class="hero">
            <div class="frame-301">
                <div class="heading">
                    <h1 class="title"><?php echo esc_html($current_category->name); ?></h1>
                    <?php if (!empty($current_category->description)) : ?>
                        <div class="category-description">
                            <?php echo wpautop(wp_kses_post($current_category->description)); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="catagories">
                    <a href="<?php echo esc_url(get_post_type_archive_link('story')); ?>" class="category-link">
                        <article class="secondary-button-mirage secondary-button">
                            <div class="secondary-button-mirage-text body-2-regular">All</div>
                        </article>
                    </a>
                    <?php foreach($categories as $category): 
                        $is_current = ($category->term_id === $current_category->term_id);
                    ?>
                        <a href="<?php echo esc_url(get_term_link($category)); ?>" class="category-link">
                            <article class="secondary-button-mirage secondary-button <?php echo $is_current ? 'active' : ''; ?>">
                                <div class="secondary-button-mirage-text body-2-regular"><?php echo esc_html($category->name); ?></div>
                            </article>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <?php 
            // Set up a custom query just for the featured post in this category
            $latest_args = array(
                'post_type' => 'story',
                'posts_per_page' => 1,
                'orderby' => 'date',
                'order' => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'story_category',
                        'field' => 'term_id',
                        'terms' => $current_category->term_id
                    )
                )
            );
            $latest_query = new WP_Query($latest_args);
            
            if($latest_query->have_posts()): 
                while($latest_query->have_posts()): $latest_query->the_post(); ?>
                <div class="latest-story-1">
                    <?php if(has_post_thumbnail()): ?>
                        <img class="rectangle-30" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                    <?php endif; ?>
                    <div class="frame-211">
                        <div class="frame-210">
                            <div class="feb-16-2025 subtitle-2"><?php echo esc_html(get_the_date('M d Y')); ?></div>
                            <p class="some-sort-of-story-t heading-3"><?php echo esc_html(get_the_title()); ?></p>
                        </div>
                        <p class="ransome-lorem-ipsum body-2-regular">
                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                        </p>
                        <a href="<?php the_permalink(); ?>">
                            <div class="secondary-button-salem secondary-button">
                                <div class="secondary-button-salem-text body-2-regular">Read</div>
                                <img class="chevron-right-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/chevron-right-salem.svg" alt="Chevron Right" />
                            </div>
                        </a>
                    </div>
                </div>
                <?php endwhile;
                wp_reset_postdata();
            else: 
                // If no featured post in category, try to get any story
                $any_story_args = array(
                    'post_type' => 'story',
                    'posts_per_page' => 1,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                $any_story_query = new WP_Query($any_story_args);
                
                if($any_story_query->have_posts()): 
                    while($any_story_query->have_posts()): $any_story_query->the_post(); ?>
                    <div class="latest-story-1">
                        <?php if(has_post_thumbnail()): ?>
                            <img class="rectangle-30" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                        <?php endif; ?>
                        <div class="frame-211">
                            <div class="frame-210">
                                <div class="feb-16-2025 subtitle-2"><?php echo esc_html(get_the_date('M d Y')); ?></div>
                                <p class="some-sort-of-story-t heading-3"><?php echo esc_html(get_the_title()); ?></p>
                            </div>
                            <p class="ransome-lorem-ipsum body-2-regular">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>">
                                <div class="secondary-button-salem secondary-button">
                                    <div class="secondary-button-salem-text body-2-regular">Read</div>
                                    <img class="chevron-right-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/chevron-right-salem.svg" alt="Chevron Right" />
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endwhile;
                    wp_reset_postdata();
                endif;
            endif; ?>
        </div>
        
        <div class="story-cards story">
            <div class="card-grid">
                <?php
                // Get current page number
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                
                // Get stories for the grid, excluding the latest one (for first page only)
                $offset = ($paged == 1 && $latest_query->have_posts()) ? 1 : 0;
                
                $grid_args = array(
                    'post_type' => 'story',
                    'posts_per_page' => 12,
                    'offset' => $offset,
                    'paged' => $paged,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'story_category',
                            'field' => 'term_id',
                            'terms' => $current_category->term_id
                        )
                    )
                );
                $grid_query = new WP_Query($grid_args);
                
                // Counter for inserting quotes
                $post_count = 0;
                $quote_index = 0;
                
                if($grid_query->have_posts()): 
                    while($grid_query->have_posts()): $grid_query->the_post();
                        // Get story categories for classes
                        $story_categories = get_the_terms(get_the_ID(), 'story_category');
                        $category_classes = '';
                        
                        if(!empty($story_categories) && !is_wp_error($story_categories)) {
                            foreach($story_categories as $cat) {
                                $category_classes .= ' category-' . $cat->slug;
                            }
                        }
                        
                        // Display a story
                        ?>
                        <a href="<?php the_permalink(); ?>">
                            <article class="story-card<?php echo esc_attr($category_classes); ?>">
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
                                    <p class="quote-text heading-2-mobile">
                                        <?php echo esc_html($quotes[$quote_index]['text']); ?>
                                    </p>
                                    <div class="quote-attribution body-1-regular"><?php echo esc_html($quotes[$quote_index]['attribution']); ?></div>
                                </div>
                            </article>
                            <?php
                            $quote_index++;
                        endif;
                    endwhile;
                    wp_reset_postdata();
                else: ?>
                    <p class="no-results"><?php esc_html_e('No stories found in this category.', 'forestplanet'); ?></p>
                <?php endif;
                
                // If we don't have many posts, add the remaining quotes
                while($quote_index < count($quotes)): ?>
                    <article class="quote-card">
                        <div class="quote-card-content">
                            <p class="quote-text heading-2-mobile">
                                <?php echo esc_html($quotes[$quote_index]['text']); ?>
                            </p>
                            <div class="quote-attribution body-1-regular"><?php echo esc_html($quotes[$quote_index]['attribution']); ?></div>
                        </div>
                    </article>
                    <?php
                    $quote_index++;
                endwhile;
                ?>
            </div>
            
            <?php if ($grid_query->max_num_pages > 1) : ?>
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $grid_query->max_num_pages,
                        'prev_text' => '&laquo; Previous',
                        'next_text' => 'Next &raquo;',
                        'type' => 'list',
                        'end_size' => 1,
                        'mid_size' => 2
                    ));
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Desktop Version -->
<div class="stories-desktop-all-breakpoints screen">
    <div class="main-content-1">
        <div class="hero-1">
            <div class="frame-1 frame">
                <h1 class="title-1"><?php echo esc_html($current_category->name); ?></h1>
                <?php if (!empty($current_category->description)) : ?>
                    <div class="category-description">
                        <?php echo wpautop(wp_kses_post($current_category->description)); ?>
                    </div>
                <?php endif; ?>
                <div class="catagories-1">
                    <a href="<?php echo esc_url(get_post_type_archive_link('story')); ?>" class="category-link">
                        <article class="secondary-button-mirage secondary-button">
                            <div class="secondary-button-mirage-text body-2-regular">All</div>
                        </article>
                    </a>
                    <?php foreach($categories as $category): 
                        $is_current = ($category->term_id === $current_category->term_id);
                    ?>
                        <a href="<?php echo esc_url(get_term_link($category)); ?>" class="category-link">
                            <article class="secondary-button-mirage secondary-button <?php echo $is_current ? 'active' : ''; ?>">
                                <div class="secondary-button-mirage-text body-2-regular"><?php echo esc_html($category->name); ?></div>
                            </article>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <?php 
            // Reset the latest query and use it again
            $latest_query->rewind_posts();
            if($latest_query->have_posts()): 
                while($latest_query->have_posts()): $latest_query->the_post(); ?>
                <div class="latest-story">
                    <?php if(has_post_thumbnail()): ?>
                        <img class="rectangle-30-1" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                    <?php endif; ?>
                    <div class="frame-211-1">
                        <div class="frame-210-1">
                            <div class="feb-16-2025-1 subtitle-2"><?php echo esc_html(get_the_date('M d Y')); ?></div>
                            <p class="some-sort-of-story-t-1 heading-3"><?php echo esc_html(get_the_title()); ?></p>
                        </div>
                        <p class="ransome-lorem-ipsum-1 body-2-regular">
                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                        </p>
                        <a href="<?php the_permalink(); ?>">
                            <div class="secondary-button-salem secondary-button">
                                <div class="secondary-button-salem-text body-2-regular">Read</div>
                                <img class="chevron-right-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/chevron-right-salem.svg" alt="Chevron Right" />
                            </div>
                        </a>
                    </div>
                </div>
                <?php endwhile;
                wp_reset_postdata();
            elseif(isset($any_story_query) && $any_story_query->have_posts()): 
                $any_story_query->rewind_posts();
                while($any_story_query->have_posts()): $any_story_query->the_post(); ?>
                <div class="latest-story">
                    <?php if(has_post_thumbnail()): ?>
                        <img class="rectangle-30-1" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                    <?php endif; ?>
                    <div class="frame-211-1">
                        <div class="frame-210-1">
                            <div class="feb-16-2025-1 subtitle-2"><?php echo esc_html(get_the_date('M d Y')); ?></div>
                            <p class="some-sort-of-story-t-1 heading-3"><?php echo esc_html(get_the_title()); ?></p>
                        </div>
                        <p class="ransome-lorem-ipsum-1 body-2-regular">
                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                        </p>
                        <a href="<?php the_permalink(); ?>">
                            <div class="secondary-button-salem secondary-button">
                                <div class="secondary-button-salem-text body-2-regular">Read</div>
                                <img class="chevron-right-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/chevron-right-salem.svg" alt="Chevron Right" />
                            </div>
                        </a>
                    </div>
                </div>
                <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>
        
        <div class="story-cards-1">
            <div class="card-grid">
                <?php
                // Reset grid query and use it again
                $grid_query->rewind_posts();
                
                // Reset counters
                $post_count = 0;
                $quote_index = 0;
                
                if($grid_query->have_posts()): 
                    while($grid_query->have_posts()): $grid_query->the_post();
                        // Get story categories for classes
                        $story_categories = get_the_terms(get_the_ID(), 'story_category');
                        $category_classes = '';
                        
                        if(!empty($story_categories) && !is_wp_error($story_categories)) {
                            foreach($story_categories as $cat) {
                                $category_classes .= ' category-' . $cat->slug;
                            }
                        }
                        
                        // Display a story
                        ?>
                        <a href="<?php the_permalink(); ?>">
                            <article class="story-card<?php echo esc_attr($category_classes); ?>">
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
                    endwhile;
                    wp_reset_postdata();
                else: ?>
                    <p class="no-results"><?php esc_html_e('No stories found in this category.', 'forestplanet'); ?></p>
                <?php endif;
                
                // If we don't have many posts, add the remaining quotes
                while($quote_index < count($quotes)): ?>
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
                endwhile;
                ?>
            </div>
            
            <?php if ($grid_query->max_num_pages > 1) : ?>
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $grid_query->max_num_pages,
                        'prev_text' => '&laquo; Previous',
                        'next_text' => 'Next &raquo;',
                        'type' => 'list',
                        'end_size' => 1,
                        'mid_size' => 2
                    ));
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    /* Handling Custom Quote Card Styling */
    const colorThemes = [
        'theme-fuchsia',
        'theme-salem',
        'theme-harp',
        'theme-soft-purple',
        'theme-soft-green'
    ];
    
    // Randomly apply themes to quote cards
    $('.quote-card').each(function(index) {
        // Remove any existing themes
        $(this).removeClass(colorThemes.join(' '));
        
        // Apply random theme
        let themeIndex = Math.floor(Math.random() * colorThemes.length);
        $(this).addClass(colorThemes[themeIndex]);
    });
});
</script>

<?php get_footer(); ?> 