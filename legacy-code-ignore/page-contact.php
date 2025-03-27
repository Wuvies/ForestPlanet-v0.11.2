<?php
/**
 * Template Name: Contact Page
 *
 * @package ForestPlanet
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="contact-page-wrapper">
        <div class="contact-page-container">
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
                        <input type="hidden" name="action" value="forest_planet_contact_form">
                    </form>
                    
                    <?php
                    // Display success message if present
                    if (isset($_GET['contact']) && $_GET['contact'] === 'success') {
                        echo '<div class="contact-success-message">';
                        echo '<p class="body-1-regular">Your message has been sent successfully. We will get back to you as soon as possible.</p>';
                        echo '</div>';
                    }
                    
                    // Display error message if present
                    if (isset($_GET['contact']) && $_GET['contact'] === 'error') {
                        echo '<div class="contact-error-message">';
                        echo '<p class="body-1-regular">There was a problem sending your message. Please try again or contact us directly.</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.contact-page-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 80px 20px;
    min-height: 60vh;
}

.contact-page-container {
    max-width: 600px;
    width: 100%;
}

.contact-success-message,
.contact-error-message {
    margin-top: 20px;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
}

.contact-success-message {
    background-color: #e8f5e9;
    color: #2e7d32;
}

.contact-error-message {
    background-color: #ffebee;
    color: #c62828;
}

@media (max-width: 768px) {
    .contact-page-wrapper {
        padding: 40px 16px;
    }
    
    .contact-us .frame-197 {
        min-width: auto;
    }
}
</style>

<?php get_footer(); ?> 