<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ForestPlanet
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
    <div class="post-card-image">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php the_post_thumbnail('medium_large', ['class' => 'featured-image']); ?>
            </a>
        <?php endif; ?>
    </div>

    <div class="post-card-content">
        <header class="entry-header">
            <?php
            if (is_sticky() && is_home() && !is_paged()) {
                echo '<span class="sticky-post">' . esc_html__('Featured', 'forestplanet') . '</span>';
            }
            
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            ?>

            <div class="entry-meta">
                <?php
                // Posted on date
                echo '<span class="posted-on">';
                echo '<time class="entry-date published" datetime="' . esc_attr(get_the_date('c')) . '">' . esc_html(get_the_date()) . '</time>';
                echo '</span>';
                
                // Author
                echo '<span class="byline">';
                echo esc_html__('By', 'forestplanet') . ' ';
                echo '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>';
                echo '</span>';
                ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
            the_excerpt();
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <a href="<?php the_permalink(); ?>" class="read-more-link">
                <?php echo esc_html__('Read More', 'forestplanet'); ?>
                <span class="screen-reader-text"><?php echo esc_html__('about', 'forestplanet') . ' ' . get_the_title(); ?></span>
            </a>
        </footer><!-- .entry-footer -->
    </div><!-- .post-card-content -->
</article><!-- #post-<?php the_ID(); ?> --> 