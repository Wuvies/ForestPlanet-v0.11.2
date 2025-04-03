<?php
/**
 * Template Name: Donate Billing
 * 
 * The template for displaying the donation billing information page
 *
 * @package ForestPlanet
 */

// Set the header style to romance explicitly for this page
add_filter('forestplanet_header_style', function($style) {
    return 'romance';
});

// Enqueue the specific CSS for this page
function enqueue_donate_billing_styles() {
    wp_enqueue_style('donate-billing-style', get_template_directory_uri() . '/assets/css/donate-billing.css');
}
add_action('wp_enqueue_scripts', 'enqueue_donate_billing_styles');

get_header();
?>

<form class="donate-checkout-mobile screen" name="billing_form_mobile" method="post">
    <div class="main-content">
        <div class="frame-362">
            <h1 class="title heading-2-mobile">
                <span class="span heading-2-mobile">Thank You for Your </span><span class="span1 heading-2-mobile">$0 </span>
                <span class="span heading-2-mobile">Donation</span>
            </h1>
            <div class="payment-form">
                <div class="frame-157">
                    <article class="payment-input">
                        <div class="label-wrapper">
                            <div class="label inter-normal-salem-16px">Email Address</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <input
                                        class="content inter-normal-mirage-18px"
                                        name="email"
                                        placeholder="youremail@example.com"
                                        type="email"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="payment-input">
                        <div class="label-wrapper">
                            <div class="label inter-normal-salem-16px">Phone Number</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <input
                                        class="content inter-normal-mirage-18px"
                                        name="phone"
                                        placeholder="(123) 456-7890"
                                        type="tel"
                                        inputmode="tel"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="payment-input">
                        <div class="label-wrapper">
                            <div class="label inter-normal-salem-16px">Street Address</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <input
                                        class="content inter-normal-mirage-18px"
                                        name="street_address"
                                        placeholder="123 Main St"
                                        type="text"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="payment-input">
                        <div class="label-wrapper">
                            <div class="label inter-normal-salem-16px">City</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <input
                                        class="content inter-normal-mirage-18px"
                                        name="city"
                                        placeholder="City"
                                        type="text"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="payment-input">
                        <div class="label-wrapper">
                            <div class="label inter-normal-salem-16px">State/Province</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <input
                                        class="content inter-normal-mirage-18px"
                                        name="state"
                                        placeholder="State/Province"
                                        type="text"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="payment-input">
                        <div class="label-wrapper">
                            <div class="label inter-normal-salem-16px">Zip/Postal Code</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <input
                                        class="content inter-normal-mirage-18px"
                                        name="zip_code"
                                        placeholder="00000"
                                        type="text"
                                        inputmode="numeric"
                                        pattern="[0-9]*"
                                        autocomplete="postal-code"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="payment-input">
                        <div class="label-wrapper">
                            <div class="label inter-normal-salem-16px">Country</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <input
                                        class="content inter-normal-mirage-18px"
                                        name="country"
                                        placeholder="Country"
                                        type="text"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <button type="submit" class="primary-button-salem button-width">
                    <div class="primary-button-romance-text body-2-regular">Continue to Payment</div>
                    <img class="chevron-right-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/chevron-right-romance.svg" alt="Chevron Right" />
                </button>
            </div>
        </div>
    </div>
</form>

<form class="donate-checkout-desktop-all-breakpoints screen" name="billing_form_desktop" method="post">
    <div class="main-content-1">
        <div class="frame-353">
            <h1 class="title-1 heading-2">
                <span class="span-2 heading-2">Thank You for Your </span><span class="span1-2 heading-2">$0 </span>
                <span class="span-2 heading-2">Donation</span>
            </h1>
            <div class="pyament-form">
                <div class="frame-160-1">
                    <div class="frame-157-1">
                        <article class="payment-input">
                            <div class="label-wrapper-1">
                                <div class="label-1 inter-normal-salem-16px">Email Address</div>
                                <div class="required-wrapper-1"><div class="text text-small">*</div></div>
                            </div>
                            <div class="content-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content"
                                            name="email"
                                            placeholder="youremail@example.com"
                                            type="email"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="payment-input">
                            <div class="label-wrapper-1">
                                <div class="label-1 inter-normal-salem-16px">Phone Number</div>
                                <div class="required-wrapper-1"><div class="text text-small">*</div></div>
                            </div>
                            <div class="content-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content"
                                            name="phone"
                                            placeholder="(123) 456-7890"
                                            type="tel"
                                            inputmode="tel"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="payment-input">
                            <div class="label-wrapper-1">
                                <div class="label-1 inter-normal-salem-16px">Street Address</div>
                                <div class="required-wrapper-1"><div class="text text-small">*</div></div>
                            </div>
                            <div class="content-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content"
                                            name="street_address"
                                            placeholder="123 Main St"
                                            type="text"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="payment-input">
                            <div class="label-wrapper-1">
                                <div class="label-1 inter-normal-salem-16px">City</div>
                                <div class="required-wrapper-1"><div class="text text-small">*</div></div>
                            </div>
                            <div class="content-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content"
                                            name="city"
                                            placeholder="City"
                                            type="text"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="payment-input">
                            <div class="label-wrapper-1">
                                <div class="label-1 inter-normal-salem-16px">State/Province</div>
                                <div class="required-wrapper-1"><div class="text text-small">*</div></div>
                            </div>
                            <div class="content-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content"
                                            name="state"
                                            placeholder="State/Province"
                                            type="text"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="payment-input">
                            <div class="label-wrapper-1">
                                <div class="label-1 inter-normal-salem-16px">Zip/Postal Code</div>
                                <div class="required-wrapper-1"><div class="text text-small">*</div></div>
                            </div>
                            <div class="content-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content"
                                            name="zip_code"
                                            placeholder="00000"
                                            type="text"
                                            inputmode="numeric"
                                            pattern="[0-9]*"
                                            autocomplete="postal-code"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="payment-input">
                            <div class="label-wrapper-1">
                                <div class="label-1 inter-normal-salem-16px">Country</div>
                                <div class="required-wrapper-1"><div class="text text-small">*</div></div>
                            </div>
                            <div class="content-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content"
                                            name="country"
                                            placeholder="Country"
                                            type="text"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <button type="submit" class="primary-button-salem button-width">
                    <div class="primary-button-romance-text body-2-regular">Continue to Payment</div>
                    <img class="chevron-right-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/chevron-right-romance.svg" alt="Chevron Right" />
                </button>
            </div>
        </div>
    </div>
</form>

<script>
jQuery(document).ready(function($) {
    // Get the donation amount from URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    let amount = urlParams.get('amount');
    
    // Format the amount with dollar sign and handle default
    if (amount) {
        // Format with 2 decimal places if it has cents
        if (amount.includes('.')) {
            const parts = amount.split('.');
            if (parts[1].length === 1) {
                amount = parseFloat(amount).toFixed(1);
            } else {
                amount = parseFloat(amount).toFixed(2);
            }
        }
        
        // Update the amount in the heading for both desktop and mobile
        const desktopAmountSpan = document.querySelector('.span1-2');
        const mobileAmountSpan = document.querySelector('.span1');
        
        if (desktopAmountSpan) {
            desktopAmountSpan.textContent = '$' + amount + ' ';
        }
        
        if (mobileAmountSpan) {
            mobileAmountSpan.textContent = '$' + amount + ' ';
        }
    }

    // Add input formatting for phone number fields
    const phoneInputs = document.querySelectorAll('input[name="phone"]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', formatPhoneNumber);
    });

    // Add input formatting for zip code fields
    const zipInputs = document.querySelectorAll('input[name="zip_code"]');
    zipInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Remove any non-digit characters
            this.value = this.value.replace(/\D/g, '');
            // Limit length to 5 digits for US or up to 10 for international
            if (this.value.length > 10) {
                this.value = this.value.slice(0, 10);
            }
        });
    });

    function formatPhoneNumber(e) {
        let value = e.target.value;
        
        // Remove all non-digit characters
        value = value.replace(/\D/g, '');
        
        // Format as (XXX) XXX-XXXX
        if (value.length > 0) {
            value = value.substring(0, 10); // Limit to 10 digits
            
            if (value.length > 6) {
                value = '(' + value.substring(0, 3) + ') ' + value.substring(3, 6) + '-' + value.substring(6);
            } else if (value.length > 3) {
                value = '(' + value.substring(0, 3) + ') ' + value.substring(3);
            } else if (value.length > 0) {
                value = '(' + value;
            }
        }
        
        e.target.value = value;
    }

    // Handle form submission
    $('form[name="billing_form_desktop"], form[name="billing_form_mobile"]').on('submit', function(e) {
        e.preventDefault();
        
        if (this.checkValidity()) {
            // Get all form data
            const formData = new FormData(this);
            
            // Create an object from form data to pass as query parameters
            const params = new URLSearchParams();
            
            // Add the donation amount to the parameters
            if (amount) {
                params.append('amount', amount);
            }
            
            // Add form field values to the parameters
            for (let pair of formData.entries()) {
                params.append(pair[0], pair[1]);
            }
            
            // Redirect to the payment checkout page with all parameters
            window.location.href = '<?php echo esc_url(get_permalink(get_page_by_path('donate-checkout'))); ?>?' + params.toString();
        } else {
            // Form validation will highlight the required fields
            this.reportValidity();
        }
    });
});
</script>

<?php get_footer(); ?> 