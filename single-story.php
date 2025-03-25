<?php
/**
 * Template Name: Story Template
 * Template Post Type: post
 * 
 * The template for displaying single story posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ForestPlanet
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('fp-story'); ?>>
    <?php
    // Get featured image URL for hero background
    $hero_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    if (!$hero_image_url) {
        $hero_image_url = get_template_directory_uri() . '/img/default-hero.jpg';
    }
    ?>
    
    <div class="fp-story-hero" style="background-image: url('<?php echo esc_url($hero_image_url); ?>');">
        <div class="fp-story-hero-content">
            <h1 class="fp-story-title"><?php the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
                <p class="fp-story-subtitle"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="fp-story-content">
        <div class="fp-story-text">
            <?php
            // Process content to wrap images in proper container divs
            $content = apply_filters('the_content', get_the_content());
            
            // Process images to add the proper classes and wrappers
            $content = preg_replace(
                '/<figure class="wp-block-image[^>]*>(.*?)<\/figure>/s',
                '<div class="fp-story-image-container">$1</div>',
                $content
            );
            
            // Replace image classes
            $content = str_replace('class="wp-image-', 'class="fp-story-image wp-image-', $content);
            
            // Replace figcaption with our styling
            $content = preg_replace(
                '/<figcaption>(.*?)<\/figcaption>/s',
                '<p class="fp-story-image-caption">$1</p>',
                $content
            );
            
            echo $content;
            ?>
        </div>
    </div>
</article>

<?php
get_footer(); 