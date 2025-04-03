<?php
/**
 * Template Name: Donate Checkout
 * 
 * The template for displaying the donation checkout page
 *
 * @package ForestPlanet
 */

// Set the header style to romance explicitly for this page
add_filter('forestplanet_header_style', function($style) {
    return 'romance';
});

// Enqueue Stripe JS
function enqueue_stripe_scripts() {
    // Only enqueue if Stripe is configured
    if (function_exists('forestplanet_is_stripe_configured') && forestplanet_is_stripe_configured()) {
        // Enqueue Stripe JS from CDN
        wp_enqueue_script('stripe-js', 'https://js.stripe.com/v3/', array(), null, true);
        
        // Enqueue Google Pay API
        wp_enqueue_script('google-pay-api', 'https://pay.google.com/gp/p/js/pay.js', array(), null, true);
        
        // Enqueue our custom Stripe integration JS
        wp_enqueue_script(
            'forestplanet-stripe-checkout', 
            get_template_directory_uri() . '/assets/js/stripe-checkout.js', 
            array('jquery', 'stripe-js', 'google-pay-api'), 
            '1.0.0', 
            true
        );
        
        // Pass data to our script
        wp_localize_script(
            'forestplanet-stripe-checkout', 
            'forestplanetStripeParams', 
            array(
                'publishableKey' => forestplanet_get_stripe_publishable_key(),
                'confirmationUrl' => esc_url(get_permalink(get_page_by_path('donate-confirmation'))),
                'failedUrl' => esc_url(get_permalink(get_page_by_path('donate-failed'))),
                'mode' => forestplanet_get_stripe_mode(),
                'enablePayPal' => forestplanet_is_paypal_enabled(),
                'enableGooglePay' => forestplanet_is_google_pay_enabled(),
                'enableApplePay' => forestplanet_is_apple_pay_enabled(),
                'applePayDomain' => forestplanet_get_apple_pay_domain(),
            )
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_stripe_scripts');

// Create or get stripe payment intent
$amount = isset($_GET['amount']) ? floatval($_GET['amount']) : 0;
$payment_intent = null;
$client_secret = '';

if (function_exists('forestplanet_create_payment_intent') && $amount > 0) {
    // Get metadata from URL params
    $metadata = array();
    
    // Add fields that we want to save with the payment
    foreach ($_GET as $key => $value) {
        if (in_array($key, array('email', 'phone', 'street_address', 'city', 'state', 'zip_code', 'country'))) {
            $metadata[$key] = sanitize_text_field($value);
        }
    }
    
    // Create payment intent
    $payment_intent_data = forestplanet_create_payment_intent($amount, $metadata);
    
    // Check if we got a valid payment intent
    if (!is_wp_error($payment_intent_data) && isset($payment_intent_data['client_secret'])) {
        $client_secret = $payment_intent_data['client_secret'];
    }
}

get_header();
?>

<form class="donate-checkout-mobile screen" name="checkout_form_mobile" method="post" id="payment-form-mobile">
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
                            <div class="label inter-normal-salem-16px">Name On Card</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <input
                                        class="content inter-normal-mirage-18px"
                                        name="card_name"
                                        id="card-name-mobile"
                                        placeholder="Full Name"
                                        type="text"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </article>
                    
                    <!-- Card Number Field -->
                    <article class="payment-input">
                        <div class="label-wrapper">
                            <div class="label inter-normal-salem-16px">Card Number</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <input
                                        class="content inter-normal-mirage-18px"
                                        name="card_number"
                                        id="card-number-mobile"
                                        placeholder="0000-0000-0000-0000"
                                        type="text"
                                        inputmode="numeric"
                                        pattern="[0-9\-]*"
                                        autocomplete="cc-number"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </article>
                    
                    <!-- CVV Field -->
                    <article class="payment-input">
                        <div class="label-wrapper">
                            <div class="label inter-normal-salem-16px">CVV</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <input
                                        class="content inter-normal-mirage-18px"
                                        name="cvv"
                                        id="cvv-mobile"
                                        placeholder="123"
                                        type="text"
                                        inputmode="numeric"
                                        pattern="[0-9]*"
                                        autocomplete="cc-csc"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </article>
                    
                    <!-- Expiration Date Field -->
                    <article class="payment-input">
                        <div class="label-wrapper">
                            <div class="label inter-normal-salem-16px">Expiration Date</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <input
                                        class="content inter-normal-mirage-18px"
                                        name="exp_date"
                                        id="exp-date-mobile"
                                        placeholder="MM/YY"
                                        type="text"
                                        inputmode="numeric"
                                        pattern="[0-9/]*"
                                        autocomplete="cc-exp"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </article>
                    
                    <!-- Hidden Stripe Card Element (for Stripe processing) -->
                    <div id="card-element-mobile" class="stripe-card-element hidden"></div>
                    <div id="card-errors-mobile" class="stripe-error" role="alert"></div>
                    
                    <article class="payment-input">
                        <div class="label-wrapper">
                            <div class="label inter-normal-salem-16px">Zip Code</div>
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
                </div>
                <div class="frame-160">
                    <hr class="line-mirage" />
                    <div class="frame-162-1"><div class="body-2-regular">Or</div></div>
                    <hr class="line-mirage" />
                </div>
                <div class="frame-158">
                    <img
                        class="payment-methodsdark"
                        src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/paypal.svg"
                        alt="PayPal"
                    />
                    <img
                        class="payment-methodsdark-1"
                        src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/googlepay.svg"
                        alt="Google Pay"
                    />
                    <img
                        class="payment-methodsdark-1"
                        src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/applepay.svg"
                        alt="Apple Pay"
                    />
                </div>
                <div class="frame-194">
                    <div class="frame-19-1">
                        <label class="radio-label">
                            <input type="checkbox" class="radio-input" name="receive_updates" value="yes">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/radio-button-mirage-false.svg" alt="Unchecked" class="radio-icon radio-false">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/radio-button-mirage-true.svg" alt="Checked" class="radio-icon radio-true hidden">
                            <p class="i-want-to-receive-up body-2-regular">I want to receive updates from ForestPlanet.</p>
                        </label>
                    </div>
                </div>
                
                <!-- Hidden field for payment intent client secret -->
                <input type="hidden" id="payment-intent-id-mobile" name="payment_intent_id" value="<?php echo esc_attr($client_secret); ?>">
                
                <button type="submit" class="primary-button-salem button-width" id="submit-payment-mobile">
                    <div class="primary-button-romance-text body-2-regular"><?php echo esc_html(forestplanet_get_donation_button_text()); ?></div>
                    <img class="chevron-right-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/chevron-right-romance.svg" alt="Chevron Right" />
                </button>
                
                <div id="payment-processing-mobile" class="payment-processing hidden">
                    <div class="spinner"></div>
                    <p><?php echo esc_html(forestplanet_get_donation_processing_text()); ?></p>
                </div>
            </div>
        </div>
    </div>
</form>

<form class="donate-checkout-desktop-all-breakpoints screen" name="checkout_form_desktop" method="post" id="payment-form-desktop">
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
                                <div class="label-1 inter-normal-salem-16px">Name On Card</div>
                                <div class="required-wrapper-1"><div class="text text-small">*</div></div>
                            </div>
                            <div class="content-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content"
                                            name="card_name"
                                            id="card-name-desktop"
                                            placeholder="Full name"
                                            type="text"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </article>
                        
                        <!-- Card Number Field -->
                        <article class="payment-input">
                            <div class="label-wrapper-1">
                                <div class="label-1 inter-normal-salem-16px">Card Number</div>
                                <div class="required-wrapper-1"><div class="text text-small">*</div></div>
                            </div>
                            <div class="content-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content"
                                            name="card_number"
                                            id="card-number-desktop"
                                            placeholder="0000-0000-0000-0000"
                                            type="text"
                                            inputmode="numeric"
                                            pattern="[0-9\-]*"
                                            autocomplete="cc-number"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </article>
                        
                        <!-- CVV Field -->
                        <article class="payment-input">
                            <div class="label-wrapper-1">
                                <div class="label-1 inter-normal-salem-16px">CVV</div>
                                <div class="required-wrapper-1"><div class="text text-small">*</div></div>
                            </div>
                            <div class="content-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content"
                                            name="cvv"
                                            id="cvv-desktop"
                                            placeholder="123"
                                            type="text"
                                            inputmode="numeric"
                                            pattern="[0-9]*"
                                            autocomplete="cc-csc"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </article>
                        
                        <!-- Expiration Date Field -->
                        <article class="payment-input">
                            <div class="label-wrapper-1">
                                <div class="label-1 inter-normal-salem-16px">Expiration Date</div>
                                <div class="required-wrapper-1"><div class="text text-small">*</div></div>
                            </div>
                            <div class="content-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input
                                            class="content"
                                            name="exp_date"
                                            id="exp-date-desktop"
                                            placeholder="MM/YY"
                                            type="text"
                                            inputmode="numeric"
                                            pattern="[0-9/]*"
                                            autocomplete="cc-exp"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </article>
                        
                        <!-- Hidden Stripe Card Element (for Stripe processing) -->
                        <div id="card-element-desktop" class="stripe-card-element hidden"></div>
                        <div id="card-errors-desktop" class="stripe-error" role="alert"></div>
                        
                        <article class="payment-input">
                            <div class="label-wrapper-1">
                                <div class="label-1 inter-normal-salem-16px">Zip Code</div>
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
                    </div>
                    <div class="frame-160-2">
                        <hr class="line-mirage" />
                        <div class="frame-162-1"><div class="body-2-regular">Or</div></div>
                        <hr class="line-mirage" />
                    </div>
                    <div class="frame-158-1">
                        <img
                            class="payment-methodsdark"
                            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/paypal.svg"
                            alt="PayPal"
                        />
                        <img
                            class="payment-methodsdark-1"
                            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/googlepay.svg"
                            alt="Google Pay"
                        />
                        <img
                            class="payment-methodsdark-1"
                            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/applepay.svg"
                            alt="Apple Pay"
                        />
                    </div>
                </div>
                <div class="frame-1-1">
                    <div class="frame-19-1">
                        <label class="radio-label">
                            <input type="checkbox" class="radio-input" name="receive_updates" value="yes">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/radio-button-mirage-false.svg" alt="Unchecked" class="radio-icon radio-false">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/radio-button-mirage-true.svg" alt="Checked" class="radio-icon radio-true hidden">
                            <p class="i-want-to-receive-up-1 body-2-regular">I want to receive updates from ForestPlanet.</p>
                        </label>
                    </div>
                </div>
                
                <!-- Hidden field for payment intent client secret -->
                <input type="hidden" id="payment-intent-id-desktop" name="payment_intent_id" value="<?php echo esc_attr($client_secret); ?>">
                
                <button type="submit" class="primary-button-salem button-width" id="submit-payment-desktop">
                    <div class="primary-button-romance-text body-2-regular"><?php echo esc_html(forestplanet_get_donation_button_text()); ?></div>
                    <img class="chevron-right-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/chevron-right-romance.svg" alt="Chevron Right" />
                </button>
                
                <div id="payment-processing-desktop" class="payment-processing hidden">
                    <div class="spinner"></div>
                    <p><?php echo esc_html(forestplanet_get_donation_processing_text()); ?></p>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
.stripe-card-element {
    padding: 10px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    background-color: white;
}

.stripe-error {
    color: #fa755a;
    margin-top: 5px;
    font-size: 14px;
}

.payment-processing {
    text-align: center;
    padding: 20px 0;
}

.payment-processing .spinner {
    display: inline-block;
    width: 30px;
    height: 30px;
    border: 3px solid rgba(0, 158, 96, 0.3);
    border-radius: 50%;
    border-top-color: #009e60;
    animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.hidden {
    display: none !important;
}
</style>

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
    
    // Get parameters from URL
    const urlParams = new URLSearchParams(window.location.search);
    
    // Get the donation amount
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
    
    // Pre-fill zip code from billing information if available
    if (urlParams.has('zip_code')) {
        const zipCode = urlParams.get('zip_code');
        const zipInputs = document.querySelectorAll('input[name="zip_code"]');
        zipInputs.forEach(input => {
            input.value = zipCode;
        });
    }

    // Add input formatting for card number fields
    const cardNumberInputs = document.querySelectorAll('input[name="card_number"]');
    cardNumberInputs.forEach(input => {
        input.addEventListener('input', formatCardNumber);
        input.addEventListener('keydown', handleCardNumberBackspace);
    });

    // Add input formatting for expiration date fields
    const expirationDateInputs = document.querySelectorAll('input[name="exp_date"]');
    expirationDateInputs.forEach(input => {
        input.addEventListener('input', formatExpirationDate);
        input.addEventListener('keydown', handleExpirationDateBackspace);
    });

    // Add input formatting for CVV fields to limit to 3-4 digits
    const cvvInputs = document.querySelectorAll('input[name="cvv"]');
    cvvInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Remove any non-digit characters
            this.value = this.value.replace(/\D/g, '');
            // Limit length to 4 digits (for Amex cards)
            if (this.value.length > 4) {
                this.value = this.value.slice(0, 4);
            }
        });
    });

    // Add input formatting for zip code fields
    const zipInputs = document.querySelectorAll('input[name="zip_code"]');
    zipInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Remove any non-digit characters
            this.value = this.value.replace(/\D/g, '');
            // Limit length to 5 digits
            if (this.value.length > 5) {
                this.value = this.value.slice(0, 5);
            }
        });
    });
    
    function getCardType(cardNumber) {
        // Remove all non-digit characters
        const cleanNumber = cardNumber.replace(/\D/g, '');
        
        // Check for Amex (starts with 34 or 37)
        if (/^3[47]/.test(cleanNumber)) {
            return 'amex';
        }
        
        // For all other cards, return 'other'
        return 'other';
    }

    function formatCardNumber(e) {
        let value = e.target.value;
        
        // Remove all non-digit characters
        value = value.replace(/\D/g, '');
        
        const cardType = getCardType(value);
        
        if (cardType === 'amex') {
            // Format American Express: XXXX-XXXXXX-XXXXX
            if (value.length > 4 && value.length <= 10) {
                value = value.slice(0, 4) + '-' + value.slice(4);
            } else if (value.length > 10) {
                value = value.slice(0, 4) + '-' + value.slice(4, 10) + '-' + value.slice(10, 15);
            }
            // Limit to 15 digits for Amex
            if (value.length > 17) { // 15 digits + 2 dashes
                value = value.substring(0, 17);
            }
        } else {
            // Format other cards: XXXX-XXXX-XXXX-XXXX
            if (value.length > 4 && value.length <= 8) {
                value = value.slice(0, 4) + '-' + value.slice(4);
            } else if (value.length > 8 && value.length <= 12) {
                value = value.slice(0, 4) + '-' + value.slice(4, 8) + '-' + value.slice(8);
            } else if (value.length > 12) {
                value = value.slice(0, 4) + '-' + value.slice(4, 8) + '-' + value.slice(8, 12) + '-' + value.slice(12, 16);
            }
            // Limit to 16 digits for most cards
            if (value.length > 19) { // 16 digits + 3 dashes
                value = value.substring(0, 19);
            }
        }
        
        e.target.value = value;
    }

    function handleCardNumberBackspace(e) {
        if (e.key === 'Backspace' && (e.target.value.slice(-1) === '-' || e.target.selectionStart === e.target.selectionEnd)) {
            const caretPosition = e.target.selectionStart;
            if (caretPosition > 0 && e.target.value[caretPosition - 1] === '-') {
                e.preventDefault();
                e.target.value = e.target.value.slice(0, caretPosition - 2) + e.target.value.slice(caretPosition);
                e.target.setSelectionRange(caretPosition - 1, caretPosition - 1);
            }
        }
    }

    function formatExpirationDate(e) {
        let value = e.target.value;
        
        // Remove all non-digit characters except the slash
        value = value.replace(/[^\d/]/g, '');
        
        // Only allow one slash
        if ((value.match(/\//g) || []).length > 1) {
            value = value.replace(/\/.*\//, '/');
        }
        
        // Automatically add the slash after 2 digits if not already there
        if (value.length === 2 && !value.includes('/')) {
            value = value + '/';
        }
        
        // Handle case where user types slash manually
        if (value.length > 2 && value[2] !== '/' && !value.includes('/')) {
            value = value.slice(0, 2) + '/' + value.slice(2);
        }
        
        // Limit to MM/YY format (5 characters total)
        if (value.length > 5) {
            value = value.substring(0, 5);
        }
        
        // Validate month (01-12)
        if (value.length >= 2) {
            const month = parseInt(value.slice(0, 2), 10);
            if (month < 1) {
                value = '01' + value.slice(2);
            } else if (month > 12) {
                value = '12' + value.slice(2);
            }
        }
        
        // Validate year (prevent years before current)
        if (value.length === 5) {
            const currentYear = new Date().getFullYear() % 100; // Get last 2 digits of current year
            const month = parseInt(value.slice(0, 2), 10);
            const year = parseInt(value.slice(3, 5), 10);
            
            // If year is in the past, set to current year
            if (year < currentYear || (year === currentYear && month < new Date().getMonth() + 1)) {
                const currentMonth = new Date().getMonth() + 1; // January is 0, so add 1
                value = 
                    (currentMonth < 10 ? '0' + currentMonth : currentMonth) + 
                    '/' + 
                    currentYear;
            }
        }
        
        e.target.value = value;
    }

    function handleExpirationDateBackspace(e) {
        if (e.key === 'Backspace' && e.target.selectionStart === e.target.selectionEnd) {
            const caretPosition = e.target.selectionStart;
            if (caretPosition > 0 && e.target.value[caretPosition - 1] === '/') {
                e.preventDefault();
                e.target.value = e.target.value.slice(0, caretPosition - 1) + e.target.value.slice(caretPosition);
                e.target.setSelectionRange(caretPosition - 1, caretPosition - 1);
            }
        }
    }
});
</script>

<?php get_footer(); ?> 