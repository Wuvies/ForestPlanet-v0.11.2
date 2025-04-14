<?php
/**
 * Contact Form Overlay Template Part
 *
 * @package ForestPlanet
 */

// Get the current header style for proper styling (if available)
global $header_style;
if (!isset($header_style)) {
    $header_style = 'romance'; // Default style
}

// Determine the correct logo class based on header style
$logo_class = ($header_style === 'mirage' || $header_style === 'fuchsia-blue') ? '-White' : '';
?>
<div class="mobile-overlay" style="display:none; opacity:0; visibility:hidden;">
  <header class="property-mobile">
    <div class="mobile-nav">
      <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="Home">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logos/FP-Logomark-RGB.svg" class="rgb-logo" alt="RGB Logo">
      </a>
      <button type="button" class="menu-button" aria-label="Close contact form" id="closeContactButton" onclick="handleCloseContact(event); return false;">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/X.svg" class="menu" alt="Close Icon">
      </button>
    </div>
  </header>
  <div class="contact-us">
    <div class="contact-us-1">
      <h1 class="title heading-2">Contact Us</h1>
      <?php echo do_shortcode('[contact-form-7 id="4eb19ec" title="Contact form"]'); ?>
      <div class="tertiary-button">
        <a href="#" onclick="cancelContactForm(); return false;" class="tertiary-mirage body-2-regular">Cancel</a>
      </div>
    </div>
  </div>
</div> 