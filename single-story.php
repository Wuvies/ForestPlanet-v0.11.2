<?php
/**
 * The template for displaying single story posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ForestPlanet
 */

get_header();

// Set a variable to track if we're viewing a single story
$is_single_story = true;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('fp-story'); ?>>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <div class="fp-story-hero" <?php if (has_post_thumbnail()) : ?>style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>');"<?php endif; ?>>
        <div class="fp-story-hero-content">
            <div class="fp-story-meta">
                <div class="fp-story-date subtitle-2"><?php echo get_the_date('M d Y'); ?></div>
                <?php
                // Display story categories
                $categories = get_the_terms(get_the_ID(), 'story_category');
                if ($categories && !is_wp_error($categories)) {
                    echo '<div class="fp-story-categories">';
                    foreach ($categories as $category) {
                        echo '<a href="' . esc_url(get_term_link($category)) . '" class="fp-story-category">' . esc_html($category->name) . '</a>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
            
            <h1 class="fp-story-title heading-2"><?php the_title(); ?></h1>
            
            <?php if (has_excerpt()) : ?>
                <div class="fp-story-subtitle body-2-regular"><?php echo wp_kses_post(get_the_excerpt()); ?></div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="fp-story-content">
        <div class="fp-story-text body-1-regular">
            <?php 
            // Get the content
            $content = get_the_content();
            
            // Process shortcodes and blocks
            $content = apply_filters('the_content', $content);
            
            // Look for image tags in the content
            $pattern = '/<figure.*?>(.*?)<\/figure>/is';
            
            // Split the content by image tags
            $parts = preg_split($pattern, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
            
            // Output the content with proper image containers
            foreach ($parts as $index => $part) {
                if ($index % 2 === 0) {
                    // This is text content
                    echo $part;
                } else {
                    // This is an image - wrap it in story-image-container
                    echo '<div class="story-image-container">' . $part . '</div>';
                }
            }
            ?>
        </div>
        
        <?php
        // If using ACF fields for additional content
        if (function_exists('get_field') && get_field('additional_content')) {
            echo '<div class="fp-story-text body-1-regular">';
            the_field('additional_content');
            echo '</div>';
        }
        ?>
    </div>
    
    <div class="story-footer">
        <div class="story-share">
            <h3 class="body-1-semibold">Share this story</h3>
            <div class="story-social-links">
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="social-link twitter">
                    <span class="screen-reader-text">Share on Twitter</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 4.01C21.9999 4.5016 21.7872 4.97316 21.41 5.3L12 14.71L2.59 5.3C2.21278 4.97316 2.00009 4.5016 2 4.01V4C2 3.46957 2.21071 2.96086 2.58579 2.58579C2.96086 2.21071 3.46957 2 4 2H20C20.5304 2 21.0391 2.21071 21.4142 2.58579C21.7893 2.96086 22 3.46957 22 4V4.01Z" fill="currentColor"/>
                    </svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="social-link facebook">
                    <span class="screen-reader-text">Share on Facebook</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 0C5.4 0 0 5.4 0 12C0 18.6 5.4 24 12 24C18.6 24 24 18.6 24 12C24 5.4 18.6 0 12 0ZM15.3 8.4H13.5C13.2 8.4 12.9 8.7 12.9 9.3V10.8H15.3V13.2H12.9V18H10.5V13.2H8.7V10.8H10.5V9.6C10.5 7.8 11.7 6.6 13.5 6.6H15.3V8.4Z" fill="currentColor"/>
                    </svg>
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="social-link linkedin">
                    <span class="screen-reader-text">Share on LinkedIn</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.25 0H3.75C1.6875 0 0 1.6875 0 3.75V20.25C0 22.3125 1.6875 24 3.75 24H20.25C22.3125 24 24 22.3125 24 20.25V3.75C24 1.6875 22.3125 0 20.25 0ZM7.5 20.25H3.75V9H7.5V20.25ZM5.625 7.5C4.5 7.5 3.75 6.75 3.75 5.625C3.75 4.5 4.5 3.75 5.625 3.75C6.75 3.75 7.5 4.5 7.5 5.625C7.5 6.75 6.75 7.5 5.625 7.5ZM20.25 20.25H16.5V14.25C16.5 13.1875 15.75 12.375 14.6875 12.375C13.625 12.375 12.75 13.125 12.75 14.25V20.25H9V9H12.75V10.5C13.5 9.5625 14.625 9 15.75 9C18.1875 9 20.25 11.0625 20.25 13.5V20.25Z" fill="currentColor"/>
                    </svg>
                </a>
                <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" class="social-link email">
                    <span class="screen-reader-text">Share by Email</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z" fill="currentColor"/>
                    </svg>
                </a>
            </div>
        </div>
        
        <div class="story-related">
            <h3 class="body-1-semibold">Related Stories</h3>
            <div class="related-stories">
                <?php
                // Get the current story categories
                $story_cats = wp_get_post_terms(get_the_ID(), 'story_category', array('fields' => 'ids'));
                
                // Query related stories based on categories
                $related_args = array(
                    'post_type' => 'story',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()), // Exclude current story
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'story_category',
                            'field' => 'term_id',
                            'terms' => $story_cats
                        )
                    )
                );
                
                $related_query = new WP_Query($related_args);
                
                if ($related_query->have_posts()) :
                    while ($related_query->have_posts()) : $related_query->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="related-story">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="related-story-image">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </div>
                    <?php endif; ?>
                    <div class="related-story-content">
                        <div class="related-story-date subtitle-2"><?php echo get_the_date('M d Y'); ?></div>
                        <h4 class="related-story-title body-1-semibold"><?php the_title(); ?></h4>
                    </div>
                </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    // If no related stories by category, get latest stories
                    $latest_args = array(
                        'post_type' => 'story',
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID())
                    );
                    
                    $latest_query = new WP_Query($latest_args);
                    
                    if ($latest_query->have_posts()) :
                        while ($latest_query->have_posts()) : $latest_query->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="related-story">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="related-story-image">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </div>
                    <?php endif; ?>
                    <div class="related-story-content">
                        <div class="related-story-date subtitle-2"><?php echo get_the_date('M d Y'); ?></div>
                        <h4 class="related-story-title body-1-semibold"><?php the_title(); ?></h4>
                    </div>
                </a>
                <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                endif;
                ?>
            </div>
        </div>
        
        <div class="story-navigation">
            <div class="story-navigation-previous">
                <?php previous_post_link('%link', '<span class="nav-direction">Previous Story</span><span class="nav-title">%title</span>'); ?>
            </div>
            <div class="story-navigation-next">
                <?php next_post_link('%link', '<span class="nav-direction">Next Story</span><span class="nav-title">%title</span>'); ?>
            </div>
        </div>
    </div>
    
    <?php endwhile; endif; ?>
</article>

<?php get_footer(); ?> 