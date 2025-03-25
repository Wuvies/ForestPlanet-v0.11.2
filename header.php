<?php
/**
 * Header template for ForestPlanet theme
 *
 * Displays all of the <head> section and site header with conditional styling.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// Determine which header style to use based on page template or other conditions
global $header_style;
$header_style = 'romance'; // Default style

// Check for page templates or conditionals to determine header style
if (is_page_template('template-donate.php') || is_page_template('donate-desktop-all-breakpoints.php')) {
    $header_style = 'romance'; // Light header for donation pages
} elseif (is_page_template('partner-confirmation.php') || is_page_template('template-partner.php')) {
    $header_style = 'mirage'; // Dark header for partner pages
} elseif (is_page_template('invite-us-confirmation.php') || is_page_template('template-invite.php') || is_page_template('page-invite.php') || is_page('invite-us') || is_page('invite')) {
    $header_style = 'fuchsia-blue'; // Purple header for invite pages
}

// Allow header style override using custom field
$custom_header_style = get_post_meta(get_the_ID(), 'header_style', true);
if (!empty($custom_header_style)) {
    $header_style = $custom_header_style;
}

// Filter to allow programmatic modification of header style
$header_style = apply_filters('forestplanet_header_style', $header_style);
?>

<!-- Desktop Header -->
<header class="header-<?php echo esc_attr($header_style); ?>" id="site-header">
    <div class="nav-bar">
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logos/FP-Wordmark-RGB<?php echo $header_style === 'mirage' || $header_style === 'fuchsia-blue' ? '-Inverse' : ''; ?>.svg" class="rgb-wordmark" alt="<?php bloginfo('name'); ?>">
        </a>
        <div class="menu">
            <!-- Add tertiary buttons directly like in the original code -->
            <a href="<?php echo esc_url(home_url('/about')); ?>">
                <div class="tertiary-button">
                    <div class="tertiary-<?php echo $header_style === 'romance' ? 'mirage' : 'romance'; ?> body-2-regular">About</div>
                </div>
            </a>
            <a href="<?php echo esc_url(home_url('/stories')); ?>">
                <div class="tertiary-button">
                    <div class="tertiary-<?php echo $header_style === 'romance' ? 'mirage' : 'romance'; ?> body-2-regular">Stories</div>
                </div>
            </a>
            <a href="#" onclick="ShowOverlay('contact-us', 'animate-appear');">
                <div class="tertiary-button">
                    <div class="tertiary-<?php echo $header_style === 'romance' ? 'mirage' : 'romance'; ?> body-2-regular">Contact</div>
                </div>
            </a>
            <a href="<?php echo esc_url(home_url('/partners')); ?>">
                <div class="tertiary-button">
                    <div class="tertiary-<?php echo $header_style === 'romance' ? 'mirage' : 'romance'; ?> body-2-regular">Partners</div>
                </div>
            </a>
            
            <a href="<?php echo esc_url(home_url('/partner')); ?>">
                <div class="secondary-button-<?php echo $header_style === 'romance' ? 'salem' : 'romance'; ?> secondary-button">
                    <div class="secondary-button-<?php echo $header_style === 'romance' ? 'salem' : 'romance'; ?>-text body-2-regular">Partner</div>
                </div>
            </a>
            
            <a href="<?php echo esc_url(home_url('/donate')); ?>">
                <div class="primary-button-<?php echo $header_style === 'romance' ? 'salem' : 'romance'; ?>">
                    <div class="primary-button-<?php echo $header_style === 'romance' ? 'romance' : 'mirage'; ?>-text body-2-regular">Donate</div>
                </div>
            </a>
        </div>
    </div>
</header>

<!-- Mobile Header -->
<header class="property-mobile<?php echo $header_style !== 'romance' ? '-' . esc_attr($header_style) : ''; ?>" id="mobile-header">
    <div class="mobile-nav">
        <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="Home">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logos/FP-Logomark-RGB<?php echo $header_style === 'mirage' || $header_style === 'fuchsia-blue' ? '-White' : ''; ?>.svg" class="rgb-logo" alt="Logo">
        </a>
        <a href="#" class="menu-button" aria-label="Open menu" id="menuButton">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/menu.svg" class="menu" alt="Menu Icon">
        </a>
    </div>
</header>

<?php
/**
 * Mobile menu overlay will be loaded via JavaScript
 * We'll create the mobile menu template in a separate file
 */
?>

<script>
// JavaScript to handle mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('menuButton');
    if (menuButton) {
        menuButton.addEventListener('click', function(e) {
            e.preventDefault();
            // Ajax load mobile menu or toggle visibility of an existing menu
            loadMobileMenuOverlay();
        });
    }
    
    // Header scroll behavior has been removed to keep headers fixed at all times
});

// Function to show overlay based on ID
function ShowOverlay(overlayId, animationClass) {
    const overlay = document.getElementById(overlayId);
    if (overlay) {
        overlay.style.display = 'flex';
        overlay.classList.add(animationClass);
        document.body.style.overflow = 'hidden'; // Prevent scrolling when overlay is open
    }
}

// This function will be implemented in a separate JS file
function loadMobileMenuOverlay() {
    // Implementation will be in js/mobile-menu-overlay.js
    console.log('Mobile menu toggle clicked');
}
</script>

<!-- Main content starts here -->
<div id="content" class="site-content"> 