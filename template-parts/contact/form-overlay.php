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
      <form class="frame-197 frame" name="contactForm" id="contact-form" method="post">
        <?php wp_nonce_field('forest_planet_contact_form', 'contact_form_nonce'); ?>
        <div class="frame-196 frame">
          <div class="input-field">
            <div class="label-wrapper-1">
              <div class="label inter-normal-salem-16px">Email</div>
              <div class="required-wrapper-1"><div class="text-1 text-small">*</div></div>
            </div>
            <div class="input">
              <div class="content-wrapper">
                <div class="wrapper">
                  <div class="content-wrapper-1">
                    <input class="content" name="contact_email" placeholder="Enter your email" type="email" required />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="input-field">
            <div class="label-wrapper-1">
              <div class="label inter-normal-salem-16px">Subject</div>
              <div class="required-wrapper-1"><div class="text-1 text-small">*</div></div>
            </div>
            <div class="input">
              <div class="content-wrapper">
                <div class="wrapper">
                  <div class="content-wrapper-1">
                    <input class="content" name="contact_subject" placeholder="Enter subject" type="text" required />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="input-field">
            <div class="label-wrapper-1">
              <div class="label inter-normal-salem-16px">Message</div>
              <div class="required-wrapper-1"><div class="text-1 text-small">*</div></div>
            </div>
            <div class="input">
              <div class="content-wrapper textarea-wrapper">
                <div class="wrapper">
                  <div class="content-wrapper-1">
                    <textarea
                      class="content-mirage"
                      name="contact_message"
                      placeholder="Type your message"
                      required
                    ></textarea>
                  </div>
                </div>
              </div>
           </div>
          </div>
        </div>
        <button type="submit" class="primary-button-salem button">
          <div class="primary-button-romance-text body-2-regular">Submit</div>
        </button>
        <div class="tertiary-button">
          <a href="#" onclick="cancelContactForm(); return false;" class="tertiary-mirage body-2-regular">Cancel</a>
        </div>
        <input type="hidden" name="action" value="forest_planet_contact_form">
      </form>
    </div>
  </div>
</div> 