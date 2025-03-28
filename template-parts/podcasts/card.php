<?php
/**
 * Template part for displaying podcast cards
 *
 * @package ForestPlanet
 */

// Set default values
$view = isset($args['view']) ? $args['view'] : 'desktop';
$post_id = isset($args['post_id']) ? $args['post_id'] : get_the_ID();
$is_about_page = isset($args['is_about_page']) ? $args['is_about_page'] : false;

// Store the current post
$current_post = $post;

// If post_id is provided and different from current post, switch to that post
if ($post_id && $post_id !== get_the_ID()) {
    $post = get_post($post_id);
    setup_postdata($post);
}

// Get post date
$podcast_date = get_the_date('M d Y');

// Get podcast image
$podcast_image = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
if (!$podcast_image) {
    $img_dir = $is_about_page ? 'assets/images/' : 'img/';
    $podcast_image = get_template_directory_uri() . '/' . $img_dir . ($view === 'desktop' ? 'rectangle-19-1@2x.png' : 'rectangle-19@2x.png');
}

// Get ACF fields
$podcast_name = get_field('podcast_name');
$podcast_url = get_field('podcast_url');
$podcast_episode = get_field('podcast_episode_number');

// Format title with episode number if available
$title = get_the_title();
if (!empty($podcast_episode)) {
    $title = $podcast_episode . ': ' . $title;
}

// Desktop view
if ($view === 'desktop') :
    // Special case for about page desktop view
    if ($is_about_page) :
    ?>
    <article class="frame-183-item">
        <div class="line-romance"></div>
        <div class="frame-117">
            <div class="frame-116-1">
                <img class="rectangle-19-1" src="<?php echo esc_url($podcast_image); ?>" alt="<?php the_title_attribute(); ?>" />
                <div class="frame-115">
                    <div class="frame-112-1">
                        <div class="frame-111">
                            <div class="feb-16-2025-3 feb-16-2025 subtitle-2"><?php echo esc_html($podcast_date); ?></div>
                            <p class="example-s2-e3-podcas-1 body-1-semibold">
                                <?php echo esc_html($title); ?>
                            </p>
                        </div>
                        <div class="podcast-name-1 body-2-regular"><?php echo esc_html($podcast_name); ?></div>
                    </div>
                </div>
            </div>
            <div class="secondary-button-romance secondary-button">
                <a href="<?php echo esc_url($podcast_url); ?>" target="_blank" class="button-link">
                    <div class="listen body-2-regular">Listen</div>
                    <img class="link-external" src="<?php echo esc_url(get_template_directory_uri()); ?>/<?php echo $is_about_page ? 'assets/images' : 'img'; ?>/link-external.svg" alt="Link External" />
                </a>
            </div>
        </div>
    </article>
    <?php
    // Regular desktop view (invite page, etc.)
    else :
    ?>
    <article class="frame-183-item">
        <div class="line-romance"></div>
        <div class="frame-117">
            <div class="frame-116-1">
                <img class="rectangle-19-1" src="<?php echo esc_url($podcast_image); ?>" alt="<?php the_title_attribute(); ?>" />
                <div class="frame-115">
                    <div class="frame-112-4">
                        <div class="frame-111">
                            <div class="feb-16-2025-3 feb-16-2025 subtitle-2"><?php echo esc_html($podcast_date); ?></div>
                            <p class="example-s2-e3-podcas-1 body-1-semibold">
                                <?php echo esc_html($title); ?>
                            </p>
                        </div>
                        <div class="podcast-name-1 body-2-regular"><?php echo esc_html($podcast_name); ?></div>
                    </div>
                </div>
            </div>
            <div class="secondary-button-romance secondary-button">
                <a href="<?php echo esc_url($podcast_url); ?>" target="_blank" class="button-link">
                    <div class="secondary-button-romance-text body-2-regular">Listen</div>
                    <img class="link-external" src="<?php echo esc_url(get_template_directory_uri()); ?>/<?php echo $is_about_page ? 'assets/images' : 'img'; ?>/link-external.svg" alt="Link External" />
                </a>
            </div>
        </div>
    </article>
    <?php
    endif;
// Mobile view
else :
?>
<article class="podcast-card">
    <div class="line-romance"></div>
    <div class="frame-116">
        <img class="rectangle-19" src="<?php echo esc_url($podcast_image); ?>" alt="<?php the_title_attribute(); ?>" />
        <div class="frame-291">
            <div class="frame-112">
                <div class="feb-16-2025-1 subtitle-2"><?php echo esc_html($podcast_date); ?></div>
                <p class="example-s2-e3-podcas body-1-semibold"><?php echo esc_html($title); ?></p>
                <div class="podcast-name body-2-regular"><?php echo esc_html($podcast_name); ?></div>
            </div>
            <div class="secondary-button-romance secondary-button">
                <a href="<?php echo esc_url($podcast_url); ?>" target="_blank" class="button-link">
                    <div class="secondary-button-romance-text body-2-regular">Listen</div>
                    <img class="link-external" src="<?php echo esc_url(get_template_directory_uri()); ?>/<?php echo $is_about_page ? 'assets/images' : 'img'; ?>/link-external.svg" alt="Link External" />
                </a>
            </div>
        </div>
    </div>
</article>
<?php
endif;

// Restore the original post if we switched
if ($post_id && $post_id !== $current_post->ID) {
    $post = $current_post;
    setup_postdata($post);
}
?> 