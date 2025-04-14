<?php
/**
 * Contact Form Confirmation Template Part
 *
 * @package ForestPlanet
 */

// Get the current header style for proper styling (if available)
global $header_style;
if (!isset($header_style)) {
    $header_style = 'romance'; // Default style
}
?>
<div class="mobile-overlay animate-appear">
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
      <h1 class="title heading-2">Thank You!</h1>
      <div class="frame-197 frame">
        <div class="frame-196 frame">
          <p class="body-1-regular">Your message has been sent successfully. We'll get back to you as soon as possible.</p>
        </div>
        <div class="tertiary-button">
          <a href="#" onclick="cancelContactForm(); return false;" class="tertiary-mirage body-2-regular">Close</a>
        </div>
      </div>
    </div>
  </div>
</div> 