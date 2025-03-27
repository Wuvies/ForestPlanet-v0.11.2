/**
 * Mobile Menu Overlay - Handles the functionality for displaying 
 * the mobile menu as an overlay without page reloads
 */

// Function to load the mobile menu as an overlay
function loadMobileMenuOverlay() {
  // Create overlay container if it doesn't exist
  if (!document.getElementById('mobile-menu-overlay')) {
    const overlayDiv = document.createElement('div');
    overlayDiv.id = 'mobile-menu-overlay';
    overlayDiv.style.position = 'fixed';
    overlayDiv.style.top = '0';
    overlayDiv.style.left = '0';
    overlayDiv.style.width = '100%';
    overlayDiv.style.height = '100%';
    overlayDiv.style.zIndex = '1000';
    overlayDiv.style.display = 'none';
    document.body.appendChild(overlayDiv);
  }
  
  // Show overlay and load content with animation
  const overlay = document.getElementById('mobile-menu-overlay');
  overlay.style.display = 'block';
  
  // Lock scrolling on main page
  window.lockScroll();
  
  // Load menu content
  fetch('menu-mobile.html')
    .then(response => response.text())
    .then(html => {
      // Extract just the menu-mobile div content
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      const menuContent = doc.querySelector('.menu-mobile');
      
      if (menuContent) {
        // Set the content
        overlay.innerHTML = menuContent.outerHTML;
        
        // Ensure proper styling by adding external CSS if not already present
        const requiredCssFiles = [
          'css/menu-mobile.css',
          'css/contact-us-mobile-overlay.css'
        ];
        
        requiredCssFiles.forEach(cssFile => {
          if (!document.querySelector(`link[href="${cssFile}"]`)) {
            const linkElement = document.createElement('link');
            linkElement.rel = 'stylesheet';
            linkElement.type = 'text/css';
            linkElement.href = cssFile;
            document.head.appendChild(linkElement);
          }
        });
        
        // Override the close function to work with our overlay
        window.closeMenuMobile = function() {
          // Add animation class
          const menuElement = document.querySelector('.menu-mobile');
          if (menuElement) {
            menuElement.classList.add('animate-disappear');
          }
          
          // Unlock scrolling immediately
          window.unlockScroll();
          
          // After animation completes, hide the overlay without navigating
          setTimeout(function() {
            // Just hide the menu overlay
            const menuOverlay = document.getElementById('mobile-menu-overlay');
            if (menuOverlay) {
              menuOverlay.style.display = 'none';
            }
            
            // Remove any leftover overlays
            const mobileOverlay = document.querySelector('.mobile-overlay');
            if (mobileOverlay) {
              mobileOverlay.style.display = 'none';
            }
          }, 500);
        };
        
        // Fix for showing the contact form from the menu overlay
        window.ShowMobileContact = function() {
          console.log("ShowMobileContact called");
          
          // Instead of hiding the menu, reduce its opacity to make it visible in background
          const menuElement = document.querySelector('.menu-mobile');
          if (menuElement) {
            menuElement.style.opacity = '0.3'; // Reduce opacity but keep it visible
            menuElement.style.pointerEvents = 'none'; // Prevent interactions with the menu while in background
          }
          
          // Then show the contact form with mobile styling
          setTimeout(function() {
            ShowExternalOverlay('contact-us', 'animate-appear', 'contact-us.html', true);
            
            // Add custom data attribute to contact form to indicate it was opened from menu
            setTimeout(() => {
              const contactForm = document.querySelector('.mobile-overlay');
              if (contactForm) {
                console.log("Setting data-from-menu attribute on contact form");
                contactForm.setAttribute('data-from-menu', 'true');
                
                // Verify the close button is properly set up
                const closeButton = contactForm.querySelector('#closeContactButton');
                if (closeButton) {
                  console.log("Found close button in contact form");
                } else {
                  console.log("WARNING: Close button not found in contact form!");
                }
              } else {
                console.log("WARNING: Contact form not found after ShowExternalOverlay");
              }
            }, 100);
          }, 100); // Small delay for better transition
        };
      }
    })
    .catch(error => {
      console.error('Error loading mobile menu:', error);
    });
}

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

  // Instead of setting body to fixed position which hides content,
  // we'll add a padding-right to account for scrollbar width
  // and keep the body positioned as is
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