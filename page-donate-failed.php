<?php
/**
 * Template Name: Donate Failed
 * 
 * The template for displaying the donation failed page
 *
 * @package ForestPlanet
 */

// Set the header style to romance explicitly for this page
add_filter('forestplanet_header_style', function($style) {
    return 'romance';
});

// Enqueue the specific CSS for this page
function enqueue_donate_failed_styles() {
    wp_enqueue_style('donate-failed-style', get_template_directory_uri() . '/assets/css/donate-failed.css');
}
add_action('wp_enqueue_scripts', 'enqueue_donate_failed_styles');

get_header();
?>

<div class="donate-failed-desktop-all-breakpoints screen">
    <div class="main-content-1">
        <h1 class="failed-message heading-2">Payment Unsuccessful</h1>
        <p class="failed-text body-1-regular">We're sorry, but there was an issue processing your donation. Please try again or use a different payment method.</p>
        <div class="button-container">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('donate'))); ?>" class="primary-button-salem">
                <div class="primary-button-salem primary-button-romance-text body-2-regular">Try Again</div>
            </a>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="secondary-button-salem secondary-button">
                <div class="secondary-button-salem secondary-button secondary-button-salem-text body-2-regular">Return to Homepage</div>
            </a>
        </div>
    </div>
</div>

<!-- Mobile version for responsive design -->
<div class="donate-failed-mobile screen">
    <div class="main-content">
        <h1 class="failed-message heading-2-mobile">Payment Unsuccessful</h1>
        <p class="failed-text body-1-regular">We're sorry, but there was an issue processing your donation. Please try again or use a different payment method.</p>
        <div class="button-container">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('donate'))); ?>" class="primary-button-salem">
                <div class="primary-button-salem primary-button-romance-text body-2-regular">Try Again</div>
            </a>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="secondary-button-salem secondary-button">
                <div class="secondary-button-salem secondary-button secondary-button-salem-text body-2-regular">Return to Homepage</div>
            </a>
        </div>
    </div>
</div>

<?php get_footer(); ?> 