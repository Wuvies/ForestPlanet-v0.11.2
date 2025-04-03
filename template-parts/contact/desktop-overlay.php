<?php
/**
 * Desktop Contact Form Overlay Template Part
 *
 * @package ForestPlanet
 */
?>
<div id="overlay-contact-us" style="display:none; opacity:0; visibility:hidden;">
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