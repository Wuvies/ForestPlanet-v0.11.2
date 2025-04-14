/**
 * ForestPlanet Contact Form JavaScript
 * Handles contact form interactions for desktop and mobile
 */

(function($) {
    'use strict';

    // Debug function
    function debugLog(message) {
        if (window.console && window.console.log) {
            console.log('[ContactForm] ' + message);
        }
    }

    // Detect if we're on mobile
    function isMobileDevice() {
        debugLog('Checking if mobile device...');
        
        // Check window width using the specified breakpoint (902px)
        const width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        const isMobileWidth = width <= 901; // Mobile for 901px and smaller
        
        // Log the width for debugging
        debugLog('Width: ' + width + ', Using mobile view: ' + isMobileWidth + ' (breakpoint: 901px)');
        
        // Check if we should force mobile mode (for testing/debugging)
        const forceMode = new URLSearchParams(window.location.search).get('contactView');
        
        if (forceMode === 'mobile') {
            debugLog('Forcing mobile view via URL parameter');
            return true;
        } else if (forceMode === 'desktop') {
            debugLog('Forcing desktop view via URL parameter');
            return false;
        }
        
        // Return based solely on width, ignoring user agent
        return isMobileWidth;
    }

    // Lock scrolling function
    window.lockScroll = function() {
        // Save the current scroll position
        window.scrollPosition = {
            top: window.pageYOffset || document.documentElement.scrollTop,
            left: window.pageXOffset || document.documentElement.scrollLeft
        };

        // Apply the no-scroll class to prevent scrolling
        document.documentElement.classList.add('no-scroll');
        document.body.classList.add('no-scroll');

        // Add padding to account for scrollbar width
        const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
        document.body.style.overflow = 'hidden';
        document.body.style.paddingRight = scrollbarWidth + 'px';
    };

    // Unlock scrolling function
    window.unlockScroll = function() {
        // Remove the no-scroll class
        document.documentElement.classList.remove('no-scroll');
        document.body.classList.remove('no-scroll');
        
        // Restore normal body styling
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
        
        // Restore the scroll position
        if (window.scrollPosition) {
            window.scrollTo(window.scrollPosition.left, window.scrollPosition.top);
        }
    };

    // Close contact form for mobile
    window.handleCloseContact = function(event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        debugLog('Close button clicked');
        
        // Find the overlay
        const overlay = document.querySelector('.mobile-overlay');
        if (!overlay) {
            debugLog('No mobile overlay found');
            return false;
        }
        
        const isFromMenu = overlay.getAttribute('data-from-menu') === 'true';
        debugLog('Is from menu: ' + isFromMenu);
        
        // If from menu, start the menu disappear animation immediately
        if (isFromMenu && window.closeMenuMobile) {
            debugLog('Starting menu animation in parallel');
            const menuElement = document.querySelector('.menu-mobile');
            if (menuElement) {
                menuElement.classList.add('animate-disappear');
            }
        }
        
        // Apply disappear animation to contact form
        overlay.classList.remove('animate-appear');
        overlay.classList.add('animate-disappear');
        
        // After animation completes
        setTimeout(function() {
            // Hide the overlay
            overlay.style.display = 'none';
            
            // If from menu, hide the menu overlay
            if (isFromMenu) {
                debugLog('Hiding menu overlay');
                const menuOverlay = document.getElementById('mobile-menu-overlay');
                if (menuOverlay) {
                    menuOverlay.style.display = 'none';
                }
            }
            
            // Always unlock scrolling
            window.unlockScroll();
        }, 300);
        
        return false;
    };

    // Cancel contact form function
    window.cancelContactForm = function() {
        debugLog('Cancel contact form called');
        
        // Check if this is desktop or mobile
        const mobileOverlay = document.querySelector('.mobile-overlay');
        const desktopOverlay = document.getElementById('overlay-contact-us');
        
        // More reliable checks for visibility
        const isMobileVisible = mobileOverlay && (mobileOverlay.style.display !== 'none' && getComputedStyle(mobileOverlay).display !== 'none');
        const isDesktopVisible = desktopOverlay && (desktopOverlay.style.display !== 'none' && getComputedStyle(desktopOverlay).display !== 'none');
        
        // Check if this is from the mobile menu
        const isFromMenu = mobileOverlay && mobileOverlay.getAttribute('data-from-menu') === 'true';
        
        debugLog('Overlay status: Mobile visible: ' + isMobileVisible + ', Desktop visible: ' + isDesktopVisible);
        
        // For mobile overlay from menu
        if (isFromMenu && isMobileVisible) {
            debugLog('Handling mobile overlay from menu');
            
            // If from menu, start the menu animation in parallel
            const menuElement = document.querySelector('.menu-mobile');
            if (menuElement) {
                menuElement.classList.remove('animate-disappear');
                menuElement.style.opacity = '1';
                menuElement.style.pointerEvents = 'auto';
            }

            // Apply disappear animation to contact form
            mobileOverlay.classList.remove('animate-appear');
            mobileOverlay.classList.add('animate-disappear');
            
            // After animation, clean up
            setTimeout(function() {
                mobileOverlay.style.display = 'none';
                window.unlockScroll();
            }, 300);
        }
        // For standalone mobile overlay (prioritize over desktop if both are visible)
        else if (isMobileVisible) {
            debugLog('Handling standalone mobile overlay');
            window.handleCloseContact(new Event('click'));
        }
        // For desktop overlay
        else if (isDesktopVisible) {
            debugLog('Handling desktop overlay');
            
            // Add disappear animation
            desktopOverlay.classList.remove('animate-appear');
            desktopOverlay.classList.add('animate-disappear');
            
            // After animation completes, hide the overlay
            setTimeout(function() {
                desktopOverlay.style.display = 'none';
                window.unlockScroll();
            }, 300);
        }
        
        return false;
    };

    // Function to show the contact form
    window.showContactForm = function(fromMenu = false) {
        debugLog('Show contact form called');
        
        // First, make sure any existing overlay is closed properly to avoid duplicates
        const existingMobileOverlay = document.querySelector('.mobile-overlay');
        const existingDesktopOverlay = document.getElementById('overlay-contact-us');
        
        if (existingMobileOverlay) {
            debugLog('Removing existing mobile overlay first');
            existingMobileOverlay.style.display = 'none';
            existingMobileOverlay.classList.remove('animate-appear');
            existingMobileOverlay.classList.remove('animate-disappear');
        }
        
        if (existingDesktopOverlay) {
            debugLog('Resetting existing desktop overlay first');
            existingDesktopOverlay.style.display = 'none';
            existingDesktopOverlay.classList.remove('animate-appear');
            existingDesktopOverlay.classList.remove('animate-disappear');
        }
        
        // Determine which view to show
        const useMobileView = isMobileDevice();
        
        if (useMobileView) {
            debugLog('Showing mobile contact form (width <= 901px)');
            showMobileContact(fromMenu);
        } else {
            debugLog('Showing desktop contact form (width > 901px)');
            showDesktopContact();
        }
    };

    // Show mobile contact form
    window.showMobileContact = function(fromMenu = false) {
        debugLog('Show mobile contact called, from menu: ' + fromMenu);
        
        // Make sure desktop overlay is hidden
        const desktopOverlay = document.getElementById('overlay-contact-us');
        if (desktopOverlay) {
            desktopOverlay.style.display = 'none';
            desktopOverlay.style.visibility = 'hidden';
            desktopOverlay.style.opacity = '0';
            desktopOverlay.classList.remove('animate-appear');
            desktopOverlay.classList.remove('animate-disappear');
        }
        
        // Lock scrolling
        window.lockScroll();
        
        // First check if there's an existing hidden mobile overlay already in the page
        let existingMobileOverlay = document.querySelector('.mobile-overlay');
        
        if (existingMobileOverlay) {
            debugLog('Using existing mobile overlay that was found in the page');
            
            // Set data attribute if from menu
            if (fromMenu) {
                existingMobileOverlay.setAttribute('data-from-menu', 'true');
            }
            
            // Reset animations
            existingMobileOverlay.classList.remove('animate-disappear');
            
            // Show with proper sequencing
            existingMobileOverlay.style.display = 'flex';
            existingMobileOverlay.style.visibility = 'visible';
            // Force a reflow before adding the appear animation
            void existingMobileOverlay.offsetWidth;
            existingMobileOverlay.classList.add('animate-appear');
            debugLog('Existing mobile overlay should now be visible');
            return;
        }
        
        // If we got here, there is no existing overlay, so we need to create one
        debugLog('No existing mobile overlay found, will create one');
        
        // Check if the mobile overlay is in a hidden container
        const mobileContainer = document.getElementById('mobile-contact-container');
        if (mobileContainer) {
            debugLog('Found mobile overlay in hidden container, extracting it');
            // Extract the mobile overlay from the container
            const mobileOverlayElement = mobileContainer.querySelector('.mobile-overlay');
            if (mobileOverlayElement) {
                // Remove it from the container
                mobileContainer.removeChild(mobileOverlayElement);
                // Add directly to body
                document.body.appendChild(mobileOverlayElement);
                
                // Set data attribute if from menu
                if (fromMenu) {
                    mobileOverlayElement.setAttribute('data-from-menu', 'true');
                }
                
                // Show with proper sequencing
                mobileOverlayElement.style.display = 'flex';
                mobileOverlayElement.style.visibility = 'visible';
                // Force a reflow before adding the appear animation
                void mobileOverlayElement.offsetWidth;
                mobileOverlayElement.classList.add('animate-appear');
                debugLog('Mobile overlay extracted from container and now visible');
                return;
            }
        }
        
        // Check for preloaded template as immediate fallback
        const preloadedTemplate = document.getElementById('mobile-contact-template-holder');
        if (preloadedTemplate && preloadedTemplate.innerHTML.includes('mobile-overlay')) {
            debugLog('Using preloaded mobile template');
            $('body').append(preloadedTemplate.innerHTML);
            
            const overlay = document.querySelector('.mobile-overlay');
            if (overlay) {
                // Set data attribute if from menu
                if (fromMenu) {
                    overlay.setAttribute('data-from-menu', 'true');
                }
                
                // Show the overlay with transition
                setTimeout(function() {
                    overlay.style.display = 'flex';
                    overlay.style.visibility = 'visible';
                    // Force a reflow before adding the appear animation
                    void overlay.offsetWidth;
                    overlay.classList.add('animate-appear');
                    debugLog('Mobile overlay from preloaded template now visible');
                }, 10);
                
                return; // Exit early, no need for AJAX call
            }
        }
        
        // Continue with AJAX if preloaded template wasn't available
        $.ajax({
            url: contactFormData.ajaxurl,
            type: 'POST',
            data: {
                action: 'forestplanet_load_contact_form',
                security: contactFormData.security,
                is_mobile: true
            },
            beforeSend: function() {
                debugLog('AJAX request sending with token: ' + contactFormData.security);
            },
            success: function(response) {
                debugLog('AJAX Response received: ' + JSON.stringify(response));
                if (response.success) {
                    // Append the form to the body
                    $('body').append(response.data.html);
                    debugLog('Mobile form appended to body');
                    
                    // Get the overlay
                    const overlay = document.querySelector('.mobile-overlay');
                    
                    // Set data attribute if from menu
                    if (fromMenu) {
                        overlay.setAttribute('data-from-menu', 'true');
                    }
                    
                    // Show the overlay with transition
                    setTimeout(function() {
                        overlay.style.display = 'flex';
                        overlay.style.visibility = 'visible';
                        // Force a reflow before adding the appear animation
                        void overlay.offsetWidth;
                        overlay.classList.add('animate-appear');
                        debugLog('Mobile overlay should now be visible');
                    }, 10);
                } else {
                    debugLog('Error loading contact form: ' + (response.data ? response.data.message : 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                debugLog('AJAX error loading contact form. Status: ' + status + ', Error: ' + error);
                debugLog('Response text: ' + xhr.responseText);
                
                // Try to fallback to default loading method
                try {
                    debugLog('Attempting fallback loading method');
                    $.get(contactFormData.templateUrl + '/template-parts/contact/form-overlay.php', function(html) {
                        $('body').append(html);
                        const overlay = document.querySelector('.mobile-overlay');
                        if (overlay) {
                            if (fromMenu) {
                                overlay.setAttribute('data-from-menu', 'true');
                            }
                            overlay.style.display = 'flex';
                            overlay.style.visibility = 'visible';
                            void overlay.offsetWidth;
                            overlay.classList.add('animate-appear');
                            debugLog('Fallback loading worked');
                        }
                    });
                } catch (e) {
                    debugLog('Fallback also failed: ' + e.message);
                }
            }
        });
    };

    // Show desktop contact form
    window.showDesktopContact = function() {
        debugLog('Show desktop contact called');
        
        // Make sure mobile overlay is hidden
        const mobileOverlay = document.querySelector('.mobile-overlay');
        if (mobileOverlay) {
            mobileOverlay.style.display = 'none';
            mobileOverlay.style.visibility = 'hidden';
            mobileOverlay.style.opacity = '0';
            mobileOverlay.classList.remove('animate-appear');
            mobileOverlay.classList.remove('animate-disappear');
        }
        
        // Lock scrolling
        window.lockScroll();
        
        // Get the overlay
        const overlay = document.getElementById('overlay-contact-us');
        debugLog('Desktop overlay element found: ' + (overlay ? 'YES' : 'NO'));
        
        if (!overlay) {
            debugLog('Loading desktop contact form via AJAX');
            
            $.ajax({
                url: contactFormData.ajaxurl,
                type: 'POST',
                data: {
                    action: 'forestplanet_load_contact_form',
                    security: contactFormData.security,
                    is_mobile: false
                },
                success: function(response) {
                    if (response.success) {
                        debugLog('AJAX loaded desktop form successfully');
                        // Append the form to the body
                        $('body').append(response.data.html);
                        
                        // Get the overlay
                        const newOverlay = document.getElementById('overlay-contact-us');
                        debugLog('New overlay found after AJAX: ' + (newOverlay ? 'YES' : 'NO'));
                        
                        if (newOverlay) {
                            // Add click outside to close
                            setupClickOutsideToClose();
                            
                            // Show the overlay with controlled sequence
                            setTimeout(function() {
                                // Show the overlay with explicit styles
                                newOverlay.style.display = 'flex';
                                newOverlay.style.visibility = 'visible';
                                
                                // Force a reflow to ensure styles are applied
                                void newOverlay.offsetWidth;
                                
                                newOverlay.classList.add('animate-appear');
                            }, 10);
                            
                            debugLog('Desktop overlay should now be visible');
                        } else {
                            debugLog('ERROR: Could not find overlay after AJAX load');
                        }
                    } else {
                        debugLog('Error loading contact form: ' + response.data.message);
                    }
                },
                error: function(xhr, status, error) {
                    debugLog('AJAX error loading contact form: ' + status + ' - ' + error);
                }
            });
        } else {
            debugLog('Using existing desktop overlay');
            
            // Reset classes first
            overlay.classList.remove('animate-disappear');
            
            // Show with proper sequencing
            overlay.style.display = 'flex';
            overlay.style.visibility = 'visible';
            // Force a reflow before adding the appear animation
            void overlay.offsetWidth;
            overlay.classList.add('animate-appear');
            
            debugLog('Desktop overlay should now be visible');
        }
    };
    
    // Close the desktop overlay when clicking outside
    function setupClickOutsideToClose() {
        const desktopOverlay = document.getElementById('overlay-contact-us');
        
        if (desktopOverlay) {
            // Remove any existing handler first
            $(desktopOverlay).off('click.closeOutside');
            
            // Add new handler
            $(desktopOverlay).on('click.closeOutside', function(e) {
                // Find the form container
                const formContainer = $(this).find('.contact-us-1');
                
                // If we clicked outside the form
                if (formContainer.length && !formContainer[0].contains(e.target)) {
                    window.cancelContactForm();
                }
            });
        }
    }

    // For backward compatibility - show mobile contact form
    window.ShowMobileContact = function() {
        debugLog('ShowMobileContact called (legacy)');
        showMobileContact(true);
        return false;
    };

    // For backward compatibility - provide compatibility with ShowOverlay
    window.ShowOverlay = function(overlayId, animationClass) {
        debugLog('ShowOverlay compatibility function called for: ' + overlayId);
        
        // If this is the contact form, use our newer methods
        if (overlayId === 'contact-us') {
            showContactForm();
        } else {
            // Fall back to original behavior for other overlays
            const overlay = document.getElementById(overlayId);
            if (overlay) {
                overlay.style.display = 'flex';
                overlay.classList.add(animationClass);
                
                // Lock scrolling
                if (window.lockScroll) {
                    window.lockScroll();
                } else {
                    document.body.style.overflow = 'hidden';
                }
            }
        }
    };

    // Initialize everything when document is ready
    $(document).ready(function() {
        debugLog('Document ready, initializing contact form');
        
        // Immediately hide any existing overlays to prevent flashing
        const existingMobileOverlay = document.querySelector('.mobile-overlay');
        const existingDesktopOverlay = document.getElementById('overlay-contact-us');
        
        if (existingMobileOverlay) {
            existingMobileOverlay.style.display = 'none';
            existingMobileOverlay.style.visibility = 'hidden';
            existingMobileOverlay.style.opacity = '0';
            existingMobileOverlay.classList.remove('animate-appear');
        }
        
        if (existingDesktopOverlay) {
            existingDesktopOverlay.style.display = 'none';
            existingDesktopOverlay.style.visibility = 'hidden';
            existingDesktopOverlay.style.opacity = '0';
            existingDesktopOverlay.classList.remove('animate-appear');
        }
        
        // Preload the mobile overlay template inline if it doesn't exist yet
        // This ensures it's available even if AJAX fails later
        if (!existingMobileOverlay && contactFormData && contactFormData.templateUrl) {
            debugLog('Preloading mobile contact form template');
            const templateHolder = document.createElement('div');
            templateHolder.id = 'mobile-contact-template-holder';
            templateHolder.style.display = 'none';
            document.body.appendChild(templateHolder);
            
            // Use fetch API for better compatibility
            fetch(contactFormData.templateUrl + '/template-parts/contact/form-overlay.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.text();
                })
                .then(html => {
                    templateHolder.innerHTML = html;
                    debugLog('Mobile template preloaded successfully');
                })
                .catch(error => {
                    debugLog('Could not preload mobile template: ' + error.message);
                });
        }
        
        // More comprehensive handler for contact links
        $(document).on('click', '.contact-button, .contact-link, a[href="#contact"], a[onclick*="showContactForm"], a[onclick*="ShowOverlay(\'contact-us"], a[data-action="contact"]', function(e) {
            e.preventDefault();
            e.stopPropagation();
            debugLog('Contact link clicked via global handler');
            showContactForm();
            return false;
        });
        
        // Handle close/cancel button clicks globally (in case event binding is missed elsewhere)
        $(document).on('click', '#closeContactButton, .tertiary-mirage[onclick*="cancelContactForm"]', function(e) {
            e.preventDefault();
            debugLog('Global close/cancel handler triggered');
            
            // Check if this is the close button or cancel link
            if (this.id === 'closeContactButton') {
                handleCloseContact(e);
            } else {
                cancelContactForm();
            }
            
            return false;
        });
        
        // Set up click outside to close for desktop
        if (!isMobileDevice()) {
            setupClickOutsideToClose();
        }
        
        // Listen for Contact Form 7 submission events
        $(document).on('wpcf7mailsent', function(event) {
            debugLog('Contact Form 7 mail sent event detected');
            // Get the current overlay
            const mobileOverlay = document.querySelector('.mobile-overlay');
            const desktopOverlay = document.getElementById('overlay-contact-us');
            
            if (mobileOverlay && (getComputedStyle(mobileOverlay).display !== 'none')) {
                // For mobile
                // Get confirmation template
                $.ajax({
                    url: contactFormData.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'forestplanet_load_contact_confirmation',
                        security: contactFormData.security,
                        is_mobile: true,
                        from_menu: mobileOverlay.getAttribute('data-from-menu') === 'true'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Replace the current overlay with the confirmation
                            $(mobileOverlay).replaceWith(response.data.html);
                        }
                    }
                });
            } else if (desktopOverlay && (getComputedStyle(desktopOverlay).display !== 'none')) {
                // For desktop
                $.ajax({
                    url: contactFormData.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'forestplanet_load_contact_confirmation',
                        security: contactFormData.security,
                        is_mobile: false
                    },
                    success: function(response) {
                        if (response.success) {
                            // Replace the current content with confirmation
                            $(desktopOverlay).find('.contact-us').html($(response.data.html).find('.contact-us').html());
                        }
                    }
                });
            }
        });
    });

})(jQuery); 