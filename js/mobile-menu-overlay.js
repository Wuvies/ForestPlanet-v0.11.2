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
  document.documentElement.classList.add('no-scroll');
  document.body.classList.add('no-scroll');
  
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
          document.querySelector('.menu-mobile').classList.add('animate-disappear');
          
          // Unlock scrolling immediately
          if (window.unlockScroll) {
            window.unlockScroll();
          } else {
            document.documentElement.classList.remove('no-scroll');
            document.body.classList.remove('no-scroll');
          }
          
          // After animation completes, hide the overlay without navigating
          setTimeout(function() {
            // Just hide the menu overlay
            document.getElementById('mobile-menu-overlay').style.display = 'none';
          }, 500);
        };
        
        // Fix for showing the contact form from the menu overlay
        window.ShowMobileContact = function() {
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
                contactForm.setAttribute('data-from-menu', 'true');
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

// Lock scrolling function
function lockScroll() {
  document.documentElement.classList.add('no-scroll');
  document.body.classList.add('no-scroll');
}

// Unlock scrolling function
function unlockScroll() {
  document.documentElement.classList.remove('no-scroll');
  document.body.classList.remove('no-scroll');
} 