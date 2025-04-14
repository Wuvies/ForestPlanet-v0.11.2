<?php
/**
 * Template Name: Partner Confirmation
 * 
 * The template for displaying the partner confirmation page
 *
 * @package ForestPlanet
 */

// Set the header style to mirage explicitly for this page
add_filter('forestplanet_header_style', function($style) {
    return 'mirage';
});

get_header();
?>

<div class="partner-confirmation-mobile screen">
    <div class="main-content">
        <h1 class="thank-you-well-get heading-2-mobile">
            <span class="span0 heading-2-mobile">Thank You!</span>
            <span class="span1 heading-2-mobile"> We'll Get Back to You Shortly</span>
        </h1>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="secondary-button-romance secondary-button">
            <div class="secondary-button-romance secondary-button secondary-button-romance-text body-2-regular">Return to Homepage</div>
        </a>
    </div>
</div>

<div class="partner-confirmation-desktop-all-breakpoints screen">
    <div class="main-content-1">
        <h1 class="thank-you-well-get-1 heading-2">
            <span class="span0-1 heading-2">Thank You!</span>
            <span class="span1-1 heading-2"> We'll Get Back to You Shortly</span>
        </h1>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="secondary-button-romance secondary-button">
            <div class="secondary-button-romance secondary-button secondary-button-romance-text body-2-regular">Return to Homepage</div>
        </a>
    </div>
</div>

<?php get_footer(); ?> 