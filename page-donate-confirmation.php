<?php
/**
 * Template Name: Donate Confirmation
 * 
 * The template for displaying the donation confirmation page
 *
 * @package ForestPlanet
 */

// Set the header style to romance explicitly for this page
add_filter('forestplanet_header_style', function($style) {
    return 'romance';
});

// Enqueue the specific CSS for this page
function enqueue_donate_confirmation_styles() {
    wp_enqueue_style('donate-confirmation-style', get_template_directory_uri() . '/assets/css/donate-confirmation.css');
}
add_action('wp_enqueue_scripts', 'enqueue_donate_confirmation_styles');

get_header();
?>

<div class="donate-confirmation-desktop-all-breakpoints screen">
    <div class="main-content-1">
        <h1 class="thank-you-message heading-2"><?php echo esc_html(forestplanet_get_confirmation_title()); ?></h1>
        <p class="confirmation-text body-1-regular"><?php echo esc_html(forestplanet_get_confirmation_message()); ?></p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="secondary-button-salem secondary-button">
            <div class="secondary-button-salem secondary-button secondary-button-salem-text body-2-regular">Return to Homepage</div>
        </a>
    </div>
</div>

<!-- Mobile version for responsive design -->
<div class="donate-confirmation-mobile screen">
    <div class="main-content">
        <h1 class="thank-you-message heading-2-mobile"><?php echo esc_html(forestplanet_get_confirmation_title()); ?></h1>
        <p class="confirmation-text body-1-regular"><?php echo esc_html(forestplanet_get_confirmation_message()); ?></p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="secondary-button-salem secondary-button">
            <div class="secondary-button-salem secondary-button secondary-button-salem-text body-2-regular">Return to Homepage</div>
        </a>
    </div>
</div>

<?php get_footer(); ?> 