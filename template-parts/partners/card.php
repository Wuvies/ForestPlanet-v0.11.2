<?php
/**
 * Template part for displaying partner cards
 *
 * @package ForestPlanet
 */

// Get args or use global post
$args = wp_parse_args($args, array(
    'post_id' => get_the_ID()
));

// Get post ID
$post_id = $args['post_id'];

// Get partner data
$partner_logo_id = get_field('partner_logo_id', $post_id);
if (empty($partner_logo_id)) {
    // Create a slug from the title if no custom ID is set
    $partner_logo_id = sanitize_title(get_the_title($post_id));
}

// Get partner logo URL
$logo_url = '';
if (has_post_thumbnail($post_id)) {
    $logo_url = get_the_post_thumbnail_url($post_id, 'medium');
}
?>

<article class="partner-card" tabindex="0" aria-label="View <?php echo esc_attr(get_the_title($post_id)); ?> details" data-partner-id="<?php echo esc_attr($partner_logo_id); ?>">
    <?php if (!empty($logo_url)) : ?>
        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?> logo" />
    <?php else : ?>
        <div class="partner-card-no-logo">
            <?php echo esc_html(get_the_title($post_id)); ?>
        </div>
    <?php endif; ?>
</article> 