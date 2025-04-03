/**
 * ForestPlanet Stripe Checkout Integration
 * Handles Stripe integration for secure card processing
 */
document.addEventListener('DOMContentLoaded', function() {
    // Check if Stripe params exist
    if (typeof forestplanetStripeParams === 'undefined') {
        console.error('Stripe parameters not found');
        return;
    }

    // Initialize Stripe
    const stripe = Stripe(forestplanetStripeParams.publishableKey);

    // Get URL params for metadata (used by all payment methods)
    const urlParams = new URLSearchParams(window.location.search);
    const amount = urlParams.get('amount') || '0';
    const email = urlParams.get('email') || '';
    const phone = urlParams.get('phone') || '';
    const streetAddress = urlParams.get('street_address') || '';
    const city = urlParams.get('city') || '';
    const state = urlParams.get('state') || '';
    const zipCode = urlParams.get('zip_code') || '';
    const country = urlParams.get('country') || 'US';

    // Check if we're on desktop or mobile view
    const isMobile = window.innerWidth < 768;
    const formId = isMobile ? 'payment-form-mobile' : 'payment-form-desktop';
    const cardNumberId = isMobile ? 'card-number-mobile' : 'card-number-desktop';
    const cardCvvId = isMobile ? 'cvv-mobile' : 'cvv-desktop';
    const cardExpId = isMobile ? 'exp-date-mobile' : 'exp-date-desktop';
    const cardNameId = isMobile ? 'card-name-mobile' : 'card-name-desktop';
    const cardErrorsId = isMobile ? 'card-errors-mobile' : 'card-errors-desktop';
    const paymentIntentId = isMobile ? 'payment-intent-id-mobile' : 'payment-intent-id-desktop';
    const submitBtnId = isMobile ? 'submit-payment-mobile' : 'submit-payment-desktop';
    const processingDivId = isMobile ? 'payment-processing-mobile' : 'payment-processing-desktop';

    // Create PaymentRequest for Apple Pay and Google Pay
    const paymentRequest = stripe.paymentRequest({
        country: country,
        currency: 'usd',
        total: {
            label: 'ForestPlanet Donation',
            amount: Math.round(parseFloat(amount) * 100), // convert to cents
        },
        requestPayerName: true,
        requestPayerEmail: true,
    });

    // Handle regular credit card form submission
    const form = document.getElementById(formId);
    if (!form) {
        console.error(`Form #${formId} not found`);
        return;
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        handleCardPayment();
    });

    function handleCardPayment() {
        // Show processing state
        const submitBtn = document.getElementById(submitBtnId);
        const processingDiv = document.getElementById(processingDivId);
        
        if (submitBtn) submitBtn.classList.add('hidden');
        if (processingDiv) processingDiv.classList.remove('hidden');
        
        // Get the payment intent client secret
        const clientSecret = document.getElementById(paymentIntentId).value;
        
        if (!clientSecret) {
            showError('Payment configuration error. Please try again or contact support.');
            return;
        }
        
        // Get card details from form
        const cardName = document.getElementById(cardNameId).value;
        const cardNumber = document.getElementById(cardNumberId).value.replace(/\D/g, '');
        const expDate = document.getElementById(cardExpId).value;
        const cvv = document.getElementById(cardCvvId).value;
        const zipCode = form.querySelector('input[name="zip_code"]').value;
        
        // Parse expiration date
        const expParts = expDate.split('/');
        if (expParts.length !== 2) {
            showError('Invalid expiration date format. Please use MM/YY format.');
            return;
        }
        
        const expMonth = expParts[0];
        const expYear = expParts[1];
        
        // Create PaymentMethod manually
        stripe.createPaymentMethod({
            type: 'card',
            card: {
                number: cardNumber,
                exp_month: expMonth,
                exp_year: expYear,
                cvc: cvv
            },
            billing_details: {
                name: cardName,
                email: email,
                phone: phone,
                address: {
                    line1: streetAddress,
                    city: city,
                    state: state,
                    postal_code: zipCode,
                    country: country
                }
            }
        }).then(handlePaymentMethodResult);
    }

    function handlePaymentMethodResult(result) {
        if (result.error) {
            showError(result.error.message);
            return;
        }
        
        const clientSecret = document.getElementById(paymentIntentId).value;
        
        // Confirm the payment
        stripe.confirmCardPayment(clientSecret, {
            payment_method: result.paymentMethod.id
        }).then(handlePaymentResult);
    }

    function handlePaymentResult(result) {
        if (result.error) {
            showError(result.error.message);
        } else if (result.paymentIntent.status === 'succeeded') {
            window.location.href = forestplanetStripeParams.confirmationUrl;
        } else {
            showError('Payment processing error. Please try again.');
        }
    }
    
    // Set up PayPal
    const paypalBtns = document.querySelectorAll('img[alt="PayPal"]');
    paypalBtns.forEach(btn => {
        if (forestplanetStripeParams.enablePayPal === 'yes') {
            btn.style.cursor = 'pointer';
            btn.addEventListener('click', initiatePayPalCheckout);
        } else {
            disablePaymentMethod(btn, 'PayPal payments are not currently enabled');
        }
    });

    // Check if device supports payment request (Apple Pay / Google Pay)
    paymentRequest.canMakePayment().then(function(result) {
        const applePayBtn = document.querySelector('img[alt="Apple Pay"]');
        const googlePayBtn = document.querySelector('img[alt="Google Pay"]');
        
        if (result) {
            if (result.applePay && applePayBtn) {
                // Device supports Apple Pay
                if (forestplanetStripeParams.enableApplePay === 'yes') {
                    applePayBtn.style.cursor = 'pointer';
                    applePayBtn.addEventListener('click', () => paymentRequest.show());
                } else {
                    disablePaymentMethod(applePayBtn, 'Apple Pay payments are not currently enabled');
                }
            } else if (applePayBtn) {
                disablePaymentMethod(applePayBtn, 'Apple Pay not supported by your browser/device');
            }

            if (!result.applePay && googlePayBtn) {
                // Device supports Google Pay
                if (forestplanetStripeParams.enableGooglePay === 'yes') {
                    googlePayBtn.style.cursor = 'pointer';
                    googlePayBtn.addEventListener('click', () => paymentRequest.show());
                } else {
                    disablePaymentMethod(googlePayBtn, 'Google Pay payments are not currently enabled');
                }
            } else if (googlePayBtn) {
                disablePaymentMethod(googlePayBtn, 'Google Pay not supported by your browser/device');
            }
        } else {
            // Neither payment method is supported
            if (applePayBtn) disablePaymentMethod(applePayBtn, 'Apple Pay not supported by your browser/device');
            if (googlePayBtn) disablePaymentMethod(googlePayBtn, 'Google Pay not supported by your browser/device');
        }
    });

    // Handle payment request payments (Apple Pay / Google Pay)
    paymentRequest.on('paymentmethod', function(ev) {
        const clientSecret = document.getElementById(paymentIntentId).value;
        
        stripe.confirmCardPayment(
            clientSecret,
            {payment_method: ev.paymentMethod.id},
            {handleActions: false}
        ).then(function(confirmResult) {
            if (confirmResult.error) {
                ev.complete('fail');
                showError(confirmResult.error.message);
            } else {
                ev.complete('success');
                if (confirmResult.paymentIntent.status === 'succeeded') {
                    window.location.href = forestplanetStripeParams.confirmationUrl;
                } else {
                    showError('Payment processing error. Please try again.');
                }
            }
        });
    });
    
    // Initiate PayPal checkout
    function initiatePayPalCheckout() {
        const submitBtn = document.getElementById(submitBtnId);
        const processingDiv = document.getElementById(processingDivId);
        
        if (submitBtn) submitBtn.classList.add('hidden');
        if (processingDiv) processingDiv.classList.remove('hidden');
        
        const clientSecret = document.getElementById(paymentIntentId).value;
        
        if (!clientSecret) {
            showError('Payment configuration error. Please try again or contact support.');
            return;
        }
        
        stripe.confirmPayPalPayment(
            clientSecret,
            {
                return_url: forestplanetStripeParams.confirmationUrl,
                cancel_url: window.location.href,
            }
        ).then(function(result) {
            if (result.error) {
                showError(result.error.message);
                if (submitBtn) submitBtn.classList.remove('hidden');
                if (processingDiv) processingDiv.classList.add('hidden');
            }
            // Customer will be redirected to PayPal
        });
    }
    
    // Disable payment method that's not supported
    function disablePaymentMethod(button, reason) {
        button.style.opacity = '0.5';
        button.style.cursor = 'not-allowed';
        button.title = reason;
        button.addEventListener('click', function(e) {
            e.preventDefault();
            alert(reason);
        });
    }

    // Show error message and restore form
    function showError(errorMessage) {
        const displayError = document.getElementById(cardErrorsId);
        const submitBtn = document.getElementById(submitBtnId);
        const processingDiv = document.getElementById(processingDivId);
        
        if (displayError) displayError.textContent = errorMessage;
        if (submitBtn) submitBtn.classList.remove('hidden');
        if (processingDiv) processingDiv.classList.add('hidden');
    }
}); 