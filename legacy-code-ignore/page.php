<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ForestPlanet
 */

get_header();
?>

<div class="container">
    <main id="main" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php
                    the_content();

                    // If ACF is active, display any custom fields that might be registered for this page
                    if (function_exists('have_rows')) {
                        // Custom field display code can be added here
                    }
                    ?>
                </div>
            </article>
            <?php
        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- .container -->

<?php
get_footer(); 