<?php
/**
 * Mobile menu overlay template
 * 
 * @package ForestPlanet
 */

// Get the current header style for proper styling
global $header_style;
if (!isset($header_style)) {
    $header_style = 'romance'; // Default style
}

// Determine the correct logo class based on header style
$logo_class = ($header_style === 'mirage' || $header_style === 'fuchsia-blue') ? '-White' : '';
$button_tertiary_style = ($header_style === 'romance') ? 'mirage' : 'romance';
$overlay_bg_class = ($header_style !== 'romance') ? ' mobile-menu-overlay-' . $header_style : '';
?>
<div id="mobile-menu-overlay" class="mobile-menu-overlay<?php echo esc_attr($overlay_bg_class); ?>" style="display: none;">
    <div class="menu-mobile">
        <header class="property-mobile<?php echo $header_style !== 'romance' ? '-' . esc_attr($header_style) : ''; ?>">
            <div class="mobile-nav">
                <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="Home">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logos/FP-Logomark-RGB<?php echo esc_attr($logo_class); ?>.svg" class="rgb-logo" alt="Logo">
                </a>
                <a href="#" class="menu-button" aria-label="Close menu" id="closeMenuButton" onclick="closeMenuMobile(); return false;">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/X.svg" class="menu" alt="Close Icon">
                </a>
            </div>
        </header>
        <div class="nav-menu">
            <a href="<?php echo esc_url(home_url('/about')); ?>">
                <div class="tertiary-button">
                    <div class="tertiary-<?php echo $button_tertiary_style; ?> body-2-regular">About</div>
                </div>
            </a>
            <a href="<?php echo esc_url(home_url('/stories')); ?>">
                <div class="tertiary-button">
                    <div class="tertiary-<?php echo $button_tertiary_style; ?> body-2-regular">Stories</div>
                </div>
            </a>
            <a href="#" onclick="showMobileContact(true); return false;">
                <div class="tertiary-button">
                    <div class="tertiary-<?php echo $button_tertiary_style; ?> body-2-regular">Contact</div>
                </div>
            </a>
            <a href="<?php echo esc_url(get_post_type_archive_link('partner')); ?>">
                <div class="tertiary-button">
                    <div class="tertiary-<?php echo $button_tertiary_style; ?> body-2-regular">Partners</div>
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
        <img class="logo-mark-1-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logos/FP-Logomark-RGB<?php echo esc_attr($logo_class); ?>.svg" alt="Logo Mark 1" />
    </div>
</div> 