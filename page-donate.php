<?php
/**
 * Template Name: Donate
 * 
 * The template for displaying the donation page
 *
 * @package ForestPlanet
 */

// Set the header style to romance explicitly for this page
add_filter('forestplanet_header_style', function($style) {
    return 'romance';
});

get_header();
?>

<div class="donate-mobile screen">
    <div class="main-content">
        <div class="frame-359">
            <h1 class="title heading-2-mobile">Make A Difference Today!</h1>
            <div class="frame-152">
                <div class="frame-151">
                    <div class="frame-150">
                        <div class="primary-button-salem button-width donation-amount" data-amount="5" onclick="selectDonationAmount(this)">
                            <div class="primary-button-romance-text body-2-regular">$5</div>
                        </div>
                        <div class="secondary-button-salem secondary-button button-width donation-amount" data-amount="10" onclick="selectDonationAmount(this)">
                            <div class="secondary-button-salem-text body-2-regular">$10</div>
                        </div>
                        <div class="secondary-button-salem secondary-button button-width donation-amount" data-amount="50" onclick="selectDonationAmount(this)">
                            <div class="secondary-button-salem-text body-2-regular">$50</div>
                        </div>
                        <div class="secondary-button-salem secondary-button button-width donation-amount" data-amount="100" onclick="selectDonationAmount(this)">
                            <div class="secondary-button-salem-text body-2-regular">$100</div>
                        </div>
                    </div>
                    <div class="input">
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <div style="position: relative; width: 100%;">
                                        <span style="position: absolute; left: 6px; top: 50%; transform: translateY(-50%); color: var(--mirage);" class="body-2-regular">$</span>
                                        <input class="content" name="custom-amount" placeholder="Custom Amount" type="text" inputmode="numeric" pattern="[0-9\-]*" required oninput="handleCustomAmount(this)" style="padding-left: 24px;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('donate-checkout'))); ?>" id="continueLinkMobile">
                    <div class="primary-button-salem button-width">
                        <div class="primary-button-romance-text body-2-regular">Continue</div>
                        <img class="chevron-right" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/chevron-right-romance.svg" alt="Chevron Right" />
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="donate-desktop-all-breakpoints screen">
    <div class="main-content-1">
        <div class="frame-35">
            <h1 class="title-1 heading-2">Make A Difference Today!</h1>
            <div class="frame-152-1">
                <div class="frame-151-1">
                    <div class="frame-150-1">
                        <div class="primary-button-salem button-width donation-amount" data-amount="5" onclick="selectDonationAmount(this)">
                            <div class="primary-button-romance-text body-2-regular">$5</div>
                        </div>
                        <div class="secondary-button-salem secondary-button button-width donation-amount" data-amount="10" onclick="selectDonationAmount(this)">
                            <div class="secondary-button-salem-text body-2-regular">$10</div>
                        </div>
                        <div class="secondary-button-salem secondary-button button-width donation-amount" data-amount="50" onclick="selectDonationAmount(this)">
                            <div class="secondary-button-salem-text body-2-regular">$50</div>
                        </div>
                        <div class="secondary-button-salem secondary-button button-width donation-amount" data-amount="100" onclick="selectDonationAmount(this)">
                            <div class="secondary-button-salem-text body-2-regular">$100</div>
                        </div>
                    </div>
                    <div class="input">
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <div style="position: relative; width: 100%;">
                                        <span style="position: absolute; left: 6px; top: 50%; transform: translateY(-50%); color: var(--mirage);" class="body-2-regular">$</span>
                                        <input class="content" name="custom-amount" placeholder="Custom Amount" type="text" inputmode="numeric" pattern="[0-9\-]*" required oninput="handleCustomAmount(this)" style="padding-left: 24px;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('donate-checkout'))); ?>" id="continueLink">
                    <div class="primary-button-salem button-width">
                        <div class="primary-button-romance-text body-2-regular">Continue</div>
                        <img class="chevron-right-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/chevron-right-romance.svg" alt="Chevron Right" />
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    function selectDonationAmount(button) {
        // Get all donation amount buttons
        const allButtons = document.querySelectorAll('.donation-amount');
        
        // Reset all buttons to secondary style
        allButtons.forEach(btn => {
            btn.classList.remove('primary-button-salem');
            btn.classList.add('secondary-button-salem', 'secondary-button');
            const textDiv = btn.querySelector('div');
            textDiv.classList.remove('primary-button-romance-text');
            textDiv.classList.add('secondary-button-salem-text');
        });

        // Set selected button to primary style
        button.classList.remove('secondary-button-salem', 'secondary-button');
        button.classList.add('primary-button-salem');
        const textDiv = button.querySelector('div');
        textDiv.classList.remove('secondary-button-salem-text');
        textDiv.classList.add('primary-button-romance-text');

        // Clear custom amount input if it exists
        const customAmountInputs = document.querySelectorAll('input[name="custom-amount"]');
        customAmountInputs.forEach(input => {
            input.value = '';
        });
        
        // Update continue button href with selected amount
        updateContinueLink(button.getAttribute('data-amount'));
    }

    function handleCustomAmount(input) {
        // Remove any non-numeric characters except decimal point
        let value = input.value.replace(/[^\d.]/g, '');
        
        // Ensure only one decimal point
        const parts = value.split('.');
        if (parts.length > 2) {
            value = parts[0] + '.' + parts.slice(1).join('');
        }
        
        // Limit to 2 decimal places
        if (parts.length === 2) {
            value = parts[0] + '.' + parts[1].slice(0, 2);
        }
        
        // Update the input value
        input.value = value;
        
        // Get all donation amount buttons
        const allButtons = document.querySelectorAll('.donation-amount');
        
        // If there's a value in the custom amount input
        if (value.trim() !== '') {
            // Reset all buttons to secondary style
            allButtons.forEach(btn => {
                btn.classList.remove('primary-button-salem');
                btn.classList.add('secondary-button-salem', 'secondary-button');
                const textDiv = btn.querySelector('div');
                textDiv.classList.remove('primary-button-romance-text');
                textDiv.classList.add('secondary-button-salem-text');
            });
            
            // Update continue button href with custom amount
            updateContinueLink(value);
        } else {
            // If custom amount is cleared, select the $5 button by default
            const fiveDollarButton = document.querySelector('.donation-amount[data-amount="5"]');
            if (fiveDollarButton) {
                selectDonationAmount(fiveDollarButton);
            }
        }
    }
    
    function updateContinueLink(amount) {
        // WordPress checkout page URL
        const checkoutPage = '<?php echo esc_url(get_permalink(get_page_by_path('donate-checkout'))); ?>';
        
        // Update both desktop and mobile continue links
        const continueLink = document.getElementById('continueLink');
        const continueLinkMobile = document.getElementById('continueLinkMobile');
        
        if (continueLink) {
            continueLink.href = checkoutPage + "?amount=" + amount;
        }
        
        if (continueLinkMobile) {
            continueLinkMobile.href = checkoutPage + "?amount=" + amount;
        }
    }
    
    // Make the functions globally available
    window.selectDonationAmount = selectDonationAmount;
    window.handleCustomAmount = handleCustomAmount;
    
    // Initialize with default amount ($5)
    const fiveDollarButton = document.querySelector('.donation-amount[data-amount="5"]');
    if (fiveDollarButton) {
        updateContinueLink(5);
    }
});
</script>

<?php get_footer(); ?> 