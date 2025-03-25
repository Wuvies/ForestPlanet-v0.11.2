<?php
/**
 * Template Name: Invite Confirmation
 * 
 * The template for displaying the "Invite Us" confirmation page
 *
 * @package ForestPlanet
 */

// Set the header style to fuchsia-blue explicitly for this page
add_filter('forestplanet_header_style', function($style) {
    return 'fuchsia-blue';
});

get_header();
?>

<div class="invite-us-confirmation-desktop-all-breakpoints screen">
    <div class="main-content-1">
        <h1 class="thank-you-well-get-1 heading-2">Thank You! We'll Get Back to You Shortly</h1>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="secondary-button-romance secondary-button">
            <div class="secondary-button-romance secondary-button secondary-button-romance-text body-2-regular">Return to Homepage</div>
        </a>
    </div>
</div>

<!-- Mobile version for responsive design -->
<div class="invite-us-confirmation-mobile screen">
    <div class="main-content">
        <h1 class="thank-you-well-get heading-2-mobile">Thank You! We'll Get Back to You Shortly</h1>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="secondary-button-romance secondary-button">
            <div class="secondary-button-romance secondary-button secondary-button-romance-text body-2-regular">Return to Homepage</div>
        </a>
    </div>
</div>

<?php get_footer(); ?> 