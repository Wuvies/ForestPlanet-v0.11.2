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

// Process form submission
$form_submitted = false;
if (isset($_POST['submit_partner'])) {
    // In a real implementation, you would process form data here
    // For example, send an email or store in database
    
    // Redirect to prevent form resubmission
    wp_redirect(add_query_arg('submitted', '1', get_permalink()));
    exit;
}

// Check if form was just submitted (for showing confirmation message)
$show_confirmation = isset($_GET['submitted']) && $_GET['submitted'] == '1';
?>

<form class="partner-mobile screen" name="form_partner_mobile" method="post">
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
            
            <div class="frame-197">
                <div class="frame-19">
                    <div class="input-field">
                        <div class="label-wrapper">
                            <div class="label inter-normal-salem-16px">Name</div>
                            <div class="required-wrapper"><div class="text-2 text-small">*</div></div>
                        </div>
                        <div class="input">
                            <div class="content-wrapper-romance">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content-romance"
                                            name="name"
                                            placeholder="First and last"
                                            type="text"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-field">
                        <div class="label-wrapper">
                            <div class="label-1 inter-normal-salem-16px">Work Email</div>
                            <div class="required-wrapper"><div class="text-2 text-small">*</div></div>
                        </div>
                        <div class="input">
                            <div class="content-wrapper-romance">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content-romance"
                                            name="email"
                                            placeholder="Enter your email"
                                            type="email"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-field">
                        <div class="label-wrapper">
                            <div class="label-2 inter-normal-salem-16px">Company</div>
                            <div class="required-wrapper"><div class="text-2 text-small">*</div></div>
                        </div>
                        <div class="input">
                            <div class="content-wrapper-romance">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content-romance"
                                            name="company"
                                            placeholder="Enter your company name"
                                            type="text"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="select">
                        <div class="label-wrapper"><div class="label-3 inter-normal-salem-16px">Role</div></div>
                        <div class="input-field">
                            <div class="content-wrapper-romance">
                                <div class="wrapper custom-select-wrapper">
                                    <select class="content-romance" name="role" required>
                                        <option value="" disabled selected>Enter Role</option>
                                        <option value="CEO">CEO</option>
                                        <option value="CSR Manager">CSR Manager</option>
                                        <option value="Sustainability Director">Sustainability Director</option>
                                        <option value="Marketing Director">Marketing Director</option>
                                        <option value="HR Manager">HR Manager</option>
                                        <option value="Operations Manager">Operations Manager</option>
                                        <option value="Executive Assistant">Executive Assistant</option>
                                        <option value="Public Relations">Public Relations</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <img class="arrow-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/down-arrow.svg" alt="arrow" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-field">
                        <div class="label-wrapper">
                            <div class="how-can-we-help inter-normal-salem-16px">How Can We Help?</div>
                            <div class="required-wrapper"><div class="text-2 text-small">*</div></div>
                        </div>
                        <div class="input">
                            <div class="content-wrapper-romance textarea-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <textarea
                                            class="content-romance"
                                            name="details"
                                            placeholder="Type your message"
                                            required
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="select">
                        <div class="label-wrapper"><p class="label-4 inter-normal-salem-16px">How Did You Find Us?</p></div>
                        <div class="input-field">
                            <div class="content-wrapper-romance">
                                <div class="wrapper custom-select-wrapper">
                                    <select class="content-romance" name="found_us" required>
                                        <option value="" disabled selected>Enter How You Found Us</option>
                                        <option value="Search Engine">Search Engine</option>
                                        <option value="Social Media">Social Media</option>
                                        <option value="Friend or Colleague">Friend or Colleague</option>
                                        <option value="Event or Conference">Event or Conference</option>
                                        <option value="News Article">News Article</option>
                                        <option value="Podcast">Podcast</option>
                                        <option value="Partner Organization">Partner Organization</option>
                                        <option value="Advertisement">Advertisement</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <img class="arrow-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/down-arrow.svg" alt="arrow" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="frame-19">
                    <div class="frame-19-1">
                        <label class="radio-label">
                            <input type="checkbox" class="radio-input" name="receive_updates" value="yes">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/radio-button-salem-false.svg" alt="Unchecked" class="radio-icon radio-false">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/radio-button-salem-true.svg" alt="Checked" class="radio-icon radio-true hidden">
                            <p class="i-want-to-receive-up body-2-regular">I want to receive updates from ForestPlanet.</p>
                        </label>
                    </div>
                </div>
                <button type="submit" name="submit_partner" class="primary-button-salem submit-button">
                    <div class="primary-button-romance-text body-2-regular">Send Inquiry</div>
                </button>
            </div>
            
            <?php endif; ?>
        </div>
    </div>
</form>

<form class="partner-desktop-all-breakpoints screen" name="form_partner_desktop" method="post">
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
            
            <div class="frame-197-1">
                <div class="partner-input-fields">
                    <div class="input-field">
                        <div class="label-wrapper-1">
                            <div class="label inter-normal-salem-16px">Name</div>
                            <div class="required-wrapper-1"><div class="text-2-1 text-small">*</div></div>
                        </div>
                        <div class="input">
                            <div class="content-wrapper-romance">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content-romance"
                                            name="name"
                                            placeholder="First and last"
                                            type="text"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-field">
                        <div class="label-wrapper-1">
                            <div class="label inter-normal-salem-16px">Work Email</div>
                            <div class="required-wrapper-1"><div class="text-2-1 text-small">*</div></div>
                        </div>
                        <div class="input">
                            <div class="content-wrapper-romance">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content-romance"
                                            name="email"
                                            placeholder="Enter your email"
                                            type="email"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-field">
                        <div class="label-wrapper-1">
                            <div class="label inter-normal-salem-16px">Company</div>
                            <div class="required-wrapper-1"><div class="text-2-1 text-small">*</div></div>
                        </div>
                        <div class="input">
                            <div class="content-wrapper-romance">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content-romance"
                                            name="company"
                                            placeholder="Enter your company name"
                                            type="text"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="select-1">
                        <div class="label-wrapper-1">
                            <div class="label inter-normal-salem-16px">Role</div>
                        </div>
                        <div class="input-field">
                            <div class="content-wrapper-romance">
                                <div class="wrapper custom-select-wrapper">
                                    <select class="content-romance" name="role" required>
                                        <option value="" disabled selected>Enter Role</option>
                                        <option value="CEO">CEO</option>
                                        <option value="CSR Manager">CSR Manager</option>
                                        <option value="Sustainability Director">Sustainability Director</option>
                                        <option value="Marketing Director">Marketing Director</option>
                                        <option value="HR Manager">HR Manager</option>
                                        <option value="Operations Manager">Operations Manager</option>
                                        <option value="Executive Assistant">Executive Assistant</option>
                                        <option value="Public Relations">Public Relations</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <img class="arrow-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/down-arrow.svg" alt="arrow" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-field">
                        <div class="label-wrapper-1">
                            <div class="how-can-we-help-1 inter-normal-salem-16px">How Can We Help?</div>
                            <div class="required-wrapper-1"><div class="text-2-1 text-small">*</div></div>
                        </div>
                        <div class="input">
                            <div class="content-wrapper-romance textarea-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <textarea
                                            class="content-romance"
                                            name="details"
                                            placeholder="Type your message"
                                            required
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="select-1">
                        <div class="label-wrapper-1"><p class="label inter-normal-salem-16px">How Did You Find Us?</p></div>
                        <div class="select-wrapper">
                            <div class="input-field">
                                <div class="content-wrapper-romance">
                                    <div class="wrapper custom-select-wrapper">
                                        <select class="content-romance" name="found_us" required>
                                            <option value="" disabled selected>Enter How You Found Us</option>
                                            <option value="Search Engine">Search Engine</option>
                                            <option value="Social Media">Social Media</option>
                                            <option value="Friend or Colleague">Friend or Colleague</option>
                                            <option value="Event or Conference">Event or Conference</option>
                                            <option value="News Article">News Article</option>
                                            <option value="Podcast">Podcast</option>
                                            <option value="Partner Organization">Partner Organization</option>
                                            <option value="Advertisement">Advertisement</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <img class="arrow-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/down-arrow.svg" alt="arrow" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="frame-1 frame-2">
                    <div class="frame-19-2">
                        <label class="radio-label">
                            <input type="checkbox" class="radio-input" name="receive_updates" value="yes">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/radio-button-salem-false.svg" alt="Unchecked" class="radio-icon radio-false">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/radio-button-salem-true.svg" alt="Checked" class="radio-icon radio-true hidden">
                            <p class="i-want-to-receive-up-1 body-2-regular">I want to receive updates from ForestPlanet.</p>
                        </label>
                    </div>
                </div>
                <button type="submit" name="submit_partner" class="primary-button-salem submit-button">
                    <div class="primary-button-romance-text body-2-regular">Send Inquiry</div>
                </button>
            </div>
            
            <?php endif; ?>
        </div>
    </div>
</form>

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
    
    // Form validation and submission
    $('form[name="form_partner_desktop"], form[name="form_partner_mobile"]').on('submit', function(e) {
        // The form will be processed by WordPress PHP on the server
        // This JavaScript is just for client-side validation if needed
        
        if (!this.checkValidity()) {
            e.preventDefault();
            // Show validation messages
            this.reportValidity();
        }
    });
});
</script>

<?php get_footer(); ?> 