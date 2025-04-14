/**
 * Mobile Menu Overlay - Handles the functionality for mobile menu
 * This script works with the PHP-based mobile menu implementation
 */

(function($) {
    'use strict';

    // Check if mobile menu is active
    function isMobileMenuActive() {
        const menuOverlay = document.getElementById('mobile-menu-overlay');
        return menuOverlay && getComputedStyle(menuOverlay).display !== 'none';
    }

    // Show mobile menu
    window.openMenuMobile = function() {
        // Get the menu overlay
        const menuOverlay = document.getElementById('mobile-menu-overlay');
        
        if (!menuOverlay) {
            console.error('Mobile menu overlay not found');
            return;
        }
        
        // Show the menu
        menuOverlay.style.display = 'block';
        
        // Get the menu content
        const menuContent = menuOverlay.querySelector('.menu-mobile');
        
        // Add appear animation
        menuContent.classList.remove('animate-disappear');
        menuContent.classList.add('animate-appear');
        
        // Lock scrolling
        if (window.lockScroll) {
            window.lockScroll();
        } else {
            document.body.style.overflow = 'hidden';
        }
    };

    // Close mobile menu
    window.closeMenuMobile = function() {
        // Get the menu overlay
        const menuOverlay = document.getElementById('mobile-menu-overlay');
        
        if (!menuOverlay) {
            console.error('Mobile menu overlay not found');
            return;
        }
        
        // Get the menu content
        const menuContent = menuOverlay.querySelector('.menu-mobile');
        
        // Add disappear animation
        menuContent.classList.remove('animate-appear');
        menuContent.classList.add('animate-disappear');
        
        // Check if contact form is open
        const contactForm = document.querySelector('.mobile-overlay');
        const isContactFormOpen = contactForm && contactForm.style.display !== 'none';
        
        // After animation completes
        setTimeout(function() {
            // Hide the menu
            menuOverlay.style.display = 'none';
            
            // Unlock scrolling only if contact form is not open
            if (!isContactFormOpen) {
                if (window.unlockScroll) {
                    window.unlockScroll();
                } else {
                    document.body.style.overflow = '';
                }
            }
        }, 300);
    };

    // For backwards compatibility
    window.ShowMobileContact = function() {
        // Check if the mobile menu is active
        const isMenuActive = isMobileMenuActive();
        
        // Call the new contact form function
        if (typeof window.showMobileContact === 'function') {
            window.showMobileContact(isMenuActive);
        } else {
            console.error('showMobileContact function not available');
        }
        
        return false;
    };

    // Initialize when DOM is loaded
    $(document).ready(function() {
        // Set up menu button click handlers
        $('.menu-button').on('click', function(e) {
            e.preventDefault();
            
            // Check if this is the open button or close button
            if ($(this).attr('id') === 'closeMenuButton') {
                closeMenuMobile();
            } else {
                openMenuMobile();
            }
            
            return false;
        });
    });

})(jQuery);

// Lock scrolling function - exposed to window object for global use
window.lockScroll = function() {
  // Save the current scroll position
  window.scrollPosition = {
    top: window.pageYOffset || document.documentElement.scrollTop,
    left: window.pageXOffset || document.documentElement.scrollLeft
  };

  // Apply the no-scroll class to prevent scrolling
  document.documentElement.classList.add('no-scroll');
  document.body.classList.add('no-scroll');

  // Add padding-right to account for scrollbar width
  const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
  document.body.style.overflow = 'hidden';
  document.body.style.paddingRight = scrollbarWidth + 'px';
};

// Unlock scrolling function - exposed to window object for global use
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

// Function to show an external overlay via AJAX
window.ShowExternalOverlay = function(overlayId, animationClass, htmlFile, isMobile = false) {
  // Create or get overlay container
  let overlayDiv = document.getElementById(overlayId + '-overlay');
  
  if (!overlayDiv) {
    overlayDiv = document.createElement('div');
    overlayDiv.id = overlayId + '-overlay';
    overlayDiv.className = isMobile ? 'mobile-overlay' : 'desktop-overlay';
    overlayDiv.style.position = 'fixed';
    overlayDiv.style.top = '0';
    overlayDiv.style.left = '0';
    overlayDiv.style.width = '100%';
    overlayDiv.style.height = '100%';
    overlayDiv.style.zIndex = '1100'; // Higher than the mobile menu
    overlayDiv.style.display = 'none';
    document.body.appendChild(overlayDiv);
  }
  
  // Show overlay
  overlayDiv.style.display = 'block';
  
  // Load content
  fetch(htmlFile)
    .then(response => response.text())
    .then(html => {
      // Extract just the needed content
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      const contactContent = doc.querySelector('.' + overlayId);
      
      if (contactContent) {
        // Set the content
        overlayDiv.innerHTML = contactContent.outerHTML;
        overlayDiv.classList.add(animationClass);
        
        // Set up event handlers for the close button
        const closeButton = overlayDiv.querySelector('#close' + overlayId.charAt(0).toUpperCase() + overlayId.slice(1) + 'Button');
        
        if (closeButton) {
          closeButton.addEventListener('click', function(e) {
            e.preventDefault();
            closeExternalOverlay(overlayId, overlayDiv);
          });
        }
      }
    })
    .catch(error => {
      console.error('Error loading overlay content:', error);
    });
};

// Function to close external overlay
function closeExternalOverlay(overlayId, overlayDiv) {
  overlayDiv.classList.add('animate-disappear');
  overlayDiv.classList.remove('animate-appear');
  
  // Check if this was opened from the mobile menu
  const isFromMenu = overlayDiv.getAttribute('data-from-menu') === 'true';
  
  setTimeout(() => {
    overlayDiv.style.display = 'none';
    overlayDiv.classList.remove('animate-disappear');
    
    // If opened from menu, restore the menu
    if (isFromMenu) {
      const menuElement = document.querySelector('.menu-mobile');
      if (menuElement) {
        menuElement.style.opacity = '1';
        menuElement.style.pointerEvents = 'auto';
      }
    } else {
      // Otherwise unlock scrolling
      window.unlockScroll();
    }
  }, 300);
}

// Create mobile menu overlay if it doesn't exist
function createMobileMenuOverlay() {
    if (document.getElementById('mobile-menu-overlay')) {
        return;
    }
    
    // Get current header style to match overlay styling
    const mobileHeader = document.getElementById('mobile-header');
    let headerStyle = 'romance'; // Default style
    
    if (mobileHeader) {
        if (mobileHeader.classList.contains('property-mobile-mirage')) {
            headerStyle = 'mirage';
        } else if (mobileHeader.classList.contains('property-mobile-fuchsia-blue')) {
            headerStyle = 'fuchsia-blue';
        }
    }
    
    // Create mobile menu overlay
    const overlay = document.createElement('div');
    overlay.id = 'mobile-menu-overlay';
    overlay.className = `mobile-menu-overlay mobile-menu-overlay-${headerStyle}`;
    
    // Create the inner HTML for the overlay
    overlay.innerHTML = `
        <div class="mobile-menu-content">
            <div class="mobile-menu-header">
                <a href="${siteSettings.homeUrl}" aria-label="Home">
                    <img src="${siteSettings.templateUrl}/assets/img/logos/FP-Logomark-RGB-${headerStyle === 'romance' ? '' : 'White'}.svg" class="rgb-logo" alt="Logo">
                </a>
                <button id="close-menu-button" aria-label="Close menu">
                    <img src="${siteSettings.templateUrl}/assets/img/close.svg" class="close-icon" alt="Close Menu">
                </button>
            </div>
            <nav class="mobile-menu-nav">
                ${getMobileMenuItems()}
            </nav>
            <div class="mobile-menu-buttons">
                <a href="${siteSettings.homeUrl}/partner" class="mobile-menu-button secondary">
                    <div class="button-text">Partner</div>
                </a>
                <a href="${siteSettings.homeUrl}/donate" class="mobile-menu-button primary">
                    <div class="button-text">Donate</div>
                </a>
            </div>
        </div>
    `;
    
    // Add to the DOM
    document.body.appendChild(overlay);
    
    // Add event listener to close button
    const closeButton = document.getElementById('close-menu-button');
    if (closeButton) {
        closeButton.addEventListener('click', closeMobileMenuOverlay);
    }
    
    // Prevent body scrolling when menu is open
    document.body.classList.add('mobile-menu-open');
}

// Get menu items from WordPress
function getMobileMenuItems() {
    // If menu data is available from WordPress, use it
    if (typeof siteSettings !== 'undefined' && siteSettings.mobileMenuItems) {
        return siteSettings.mobileMenuItems;
    }
    
    // Fallback static menu if WordPress data is not available
    return `
        <a href="${siteSettings.homeUrl}/about" class="mobile-menu-item">
            <div class="mobile-menu-item-text">About</div>
        </a>
        <a href="${siteSettings.homeUrl}/stories" class="mobile-menu-item">
            <div class="mobile-menu-item-text">Stories</div>
        </a>
        <a href="${siteSettings.homeUrl}/contact" class="mobile-menu-item">
            <div class="mobile-menu-item-text">Contact</div>
        </a>
        <a href="${siteSettings.homeUrl}/partners" class="mobile-menu-item">
            <div class="mobile-menu-item-text">Partners</div>
        </a>
    `;
}

// Load and show the mobile menu overlay
function loadMobileMenuOverlay() {
    createMobileMenuOverlay();
    
    // Add visible class to fade in the menu
    const overlay = document.getElementById('mobile-menu-overlay');
    if (overlay) {
        setTimeout(() => {
            overlay.classList.add('visible');
        }, 10); // Small delay to ensure the transition works
    }
}

// Close the mobile menu overlay
function closeMobileMenuOverlay() {
    const overlay = document.getElementById('mobile-menu-overlay');
    if (overlay) {
        overlay.classList.remove('visible');
        
        // Remove the overlay after transition completes
        setTimeout(() => {
            overlay.remove();
            document.body.classList.remove('mobile-menu-open');
        }, 300); // Match to transition duration in CSS
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Make loadMobileMenuOverlay globally available
    window.loadMobileMenuOverlay = loadMobileMenuOverlay;
}); 