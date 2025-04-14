<?php
/**
 * Template Name: Partner
 * 
 * The template for displaying the partner page
 *
 * @package ForestPlanet
 */

// Set the header style to mirage explicitly for this page
add_filter('forestplanet_header_style', function($style) {
    return 'mirage';
});

get_header();

// Process form submission (Legacy code - now handled by CF7)
$show_confirmation = isset($_GET['submitted']) && $_GET['submitted'] == '1';
?>

<!-- Mobile Version -->
<div class="partner-mobile screen">
    <div class="main-content">
        <div class="partner-form">
            <h1 class="title heading-2-mobile">
                <span class="span heading-2-mobile">Join Us in Creating a </span>
                <span class="span1 heading-2-mobile">Greener</span>
                <span class="span heading-2-mobile"> Future</span>
            </h1>
            
            <?php if ($show_confirmation) : ?>
                <div class="confirmation-message">
                    <p>Thank you for your inquiry. We'll get back to you shortly.</p>
                </div>
            <?php else : ?>
            
            <?php echo do_shortcode('[contact-form-7 id="5a07999" title="Partner"]'); ?>
            
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Desktop Version -->
<div class="partner-desktop-all-breakpoints screen">
    <div class="main-content-1">
        <div class="partner-form-1">
            <h1 class="title-1 heading-2">
                <span class="span-2 heading-2">Join Us in Creating a </span>
                <span class="span1-2 heading-2">Greener</span>
                <span class="span-2 heading-2"> Future</span>
            </h1>
            
            <?php if ($show_confirmation) : ?>
                <div class="confirmation-message">
                    <p>Thank you for your inquiry. We'll get back to you shortly.</p>
                </div>
            <?php else : ?>
            
            <?php echo do_shortcode('[contact-form-7 id="5a07999" title="Partner"]'); ?>
            
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    /* Handling Custom Radio Buttons */
    const radioInputs = document.querySelectorAll('.radio-input');
    
    radioInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Toggle the display of the SVG icons based on checked state
            const falseIcon = this.nextElementSibling;
            const trueIcon = falseIcon.nextElementSibling;
            
            if (this.checked) {
                falseIcon.classList.add('hidden');
                trueIcon.classList.remove('hidden');
            } else {
                falseIcon.classList.remove('hidden');
                trueIcon.classList.add('hidden');
            }
        });
    });
});
</script>

<?php get_footer(); ?> 