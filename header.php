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
} elseif (is_post_type_archive('partner') || is_tax('partner_category')) {
    $header_style = 'mirage'; // Dark header for partner archive pages
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
            <a href="#" onclick="showContactForm(); return false;">
                <div class="tertiary-button">
                    <div class="tertiary-<?php echo $header_style === 'romance' ? 'mirage' : 'romance'; ?> body-2-regular">Contact</div>
                </div>
            </a>
            <a href="<?php echo esc_url(get_post_type_archive_link('partner')); ?>"> 
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
// Include the mobile menu template
get_template_part('template-parts/header/mobile-menu');
?>

<script>
// JavaScript to handle mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('menuButton');
    if (menuButton) {
        menuButton.addEventListener('click', function(e) {
            e.preventDefault();
            // Show mobile menu overlay
            showMobileMenuOverlay();
        });
    }
});

// Function to show the mobile menu overlay
function showMobileMenuOverlay() {
    const overlay = document.getElementById('mobile-menu-overlay');
    if (overlay) {
        overlay.style.display = 'flex';
        overlay.classList.add('animate-appear');
        
        // Set background color directly based on current header style
        <?php if ($header_style === 'mirage'): ?>
        overlay.style.backgroundColor = 'var(--mirage)';
        // Also set color for mobile menu
        const menuMobile = overlay.querySelector('.menu-mobile');
        if (menuMobile) {
            menuMobile.style.backgroundColor = 'var(--mirage)';
        }
        // Set color for nav menu
        const navMenu = overlay.querySelector('.nav-menu');
        if (navMenu) {
            navMenu.style.backgroundColor = 'var(--mirage)';
        }
        <?php elseif ($header_style === 'fuchsia-blue'): ?>
        overlay.style.backgroundColor = 'var(--fuchsia-blue)';
        // Also set color for mobile menu
        const menuMobile = overlay.querySelector('.menu-mobile');
        if (menuMobile) {
            menuMobile.style.backgroundColor = 'var(--fuchsia-blue)';
        }
        // Set color for nav menu
        const navMenu = overlay.querySelector('.nav-menu');
        if (navMenu) {
            navMenu.style.backgroundColor = 'var(--fuchsia-blue)';
        }
        <?php else: ?>
        overlay.style.backgroundColor = 'var(--romance)';
        <?php endif; ?>
        
        // Lock scrolling
        if (window.lockScroll) {
            window.lockScroll();
        } else {
            document.body.style.overflow = 'hidden';
        }
    }
}

// Function to close the mobile menu overlay
function closeMenuMobile() {
    const overlay = document.getElementById('mobile-menu-overlay');
    const menuElement = overlay.querySelector('.menu-mobile');
    
    if (menuElement) {
        menuElement.classList.add('animate-disappear');
    }
    
    // Unlock scrolling
    if (window.unlockScroll) {
        window.unlockScroll();
    } else {
        document.body.style.overflow = '';
    }
    
    // Hide overlay after animation completes
    setTimeout(function() {
        if (overlay) {
            overlay.style.display = 'none';
            
            if (menuElement) {
                menuElement.classList.remove('animate-disappear');
            }
        }
    }, 300);
}

// Function to show overlay based on ID
function ShowOverlay(overlayId, animationClass) {
    // If it's the contact form, use the dedicated function
    if (overlayId === 'contact-us') {
        console.log('Redirecting to showContactForm()');
        showContactForm();
        return;
    }
    
    // For other overlays, proceed normally
    const overlay = document.getElementById(overlayId);
    if (overlay) {
        overlay.style.display = 'flex';
        overlay.classList.add(animationClass);
        document.body.style.overflow = 'hidden'; // Prevent scrolling when overlay is open
    }
}

// Function to show mobile contact form
function ShowMobileContact() {
    // Reduce opacity of menu to make it visible in background
    const menuElement = document.querySelector('.menu-mobile');
    if (menuElement) {
        menuElement.style.opacity = '0.3';
        menuElement.style.pointerEvents = 'none';
    }
    
    // Show contact form overlay
    setTimeout(function() {
        ShowExternalOverlay('contact-us', 'animate-appear', 'contact-us.html', true);
        
        // Add custom data attribute to contact form
        setTimeout(() => {
            const contactForm = document.querySelector('.mobile-overlay');
            if (contactForm) {
                contactForm.setAttribute('data-from-menu', 'true');
            }
        }, 100);
    }, 100);
}
</script>

<!-- Main content starts here -->
<div id="content" class="site-content"> 