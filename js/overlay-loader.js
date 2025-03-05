// This file handles the dynamic loading of overlays
// It avoids having to embed the same HTML in multiple files

// Global functions for scroll locking/unlocking
window.lockScroll = function() {
  document.documentElement.classList.add('no-scroll');
  document.body.classList.add('no-scroll');
  
  // Optional: Store the locked state for persistence across page loads
  try {
    sessionStorage.setItem('scrollLocked', 'true');
  } catch (e) {
    console.log('Could not access sessionStorage', e);
  }
};

window.unlockScroll = function() {
  document.documentElement.classList.remove('no-scroll');
  document.body.classList.remove('no-scroll');
  
  // Clear the locked state
  try {
    sessionStorage.removeItem('scrollLocked');
  } catch (e) {
    console.log('Could not access sessionStorage', e);
  }
};

// Global function to handle contact form cancellation
window.cancelContactForm = function() {
  // Check if this was opened from the mobile menu
  const overlay = document.querySelector('.mobile-overlay');
  const isFromMenu = overlay && overlay.getAttribute('data-from-menu') === 'true';
  
  if (isFromMenu) {
    // Apply disappear animation to contact form
    overlay.classList.remove('animate-appear');
    overlay.classList.add('animate-disappear');
    
    // After animation, return to the menu
    setTimeout(function() {
      // Find and restore the menu
      const menuElement = document.querySelector('.menu-mobile');
      if (menuElement) {
        menuElement.classList.remove('animate-disappear'); // Remove any disappear animation
        menuElement.style.opacity = '1';
        menuElement.style.pointerEvents = 'auto';
      }
      
      // Remove the contact overlay
      if (overlay.parentNode) {
        overlay.parentNode.removeChild(overlay);
      }
    }, 250);
  } else {
    // Use the standard close function
    closeContactForm();
  }
};

// Global function to close the contact form
window.closeContactForm = function() {
  const overlay = document.querySelector('.mobile-overlay');
  if (!overlay) return;
  
  // Check if opened from menu
  const isFromMenu = overlay.getAttribute('data-from-menu') === 'true';
  
  // If from menu, apply disappear animation to both overlays simultaneously
  if (isFromMenu) {
    // Find and animate menu overlay first
    const menuOverlay = document.getElementById('mobile-menu-overlay');
    if (menuOverlay) {
      // Apply the same disappear animation to the menu
      const menuElement = menuOverlay.querySelector('.menu-mobile');
      if (menuElement) {
        menuElement.classList.add('animate-disappear');
      }
    }
  }
  
  // Then apply animation to contact form
  overlay.classList.remove('animate-appear');
  overlay.classList.add('animate-disappear');
  
  // Unlock scrolling
  unlockScroll();
  
  // Wait for animation to complete
  setTimeout(function() {
    // Hide both overlays at the same time
    if (isFromMenu) {
      const menuOverlay = document.getElementById('mobile-menu-overlay');
      if (menuOverlay) {
        menuOverlay.style.display = 'none';
      }
    }
    
    // Remove the contact overlay from the DOM
    if (overlay.parentNode) {
      overlay.parentNode.removeChild(overlay);
    }
    
    // Don't redirect anywhere - just stay on the current page
  }, 250);
};

// Function to load an overlay from an external HTML file
function loadOverlay(overlayId, htmlFilePath, isMobile = false) {
  console.log(`Loading overlay ${overlayId} from ${htmlFilePath}, isMobile: ${isMobile}`);
  
  // First check if the overlay container already exists
  let overlayContainer = document.getElementById(overlayId);
  
  // If it doesn't exist, create it
  if (!overlayContainer) {
    overlayContainer = document.createElement('div');
    overlayContainer.id = overlayId;
    overlayContainer.className = 'overlay-base';
    document.body.appendChild(overlayContainer);
    console.log(`Created new overlay container with id ${overlayId}`);
  } else {
    // Reset the display style if it exists
    overlayContainer.style.display = '';
  }
  
  // Fetch the HTML content
  return fetch(htmlFilePath)
    .then(response => {
      if (!response.ok) {
        throw new Error(`Failed to load overlay: ${response.statusText}`);
      }
      return response.text();
    })
    .then(html => {
      // Extract just the content we need (the inner part of the overlay)
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      
      // Get the main content from the contact-us.html
      const content = doc.querySelector('.contact-us');
      
      if (content) {
        console.log("Found contact-us content, processing");
        
        // Replace the overlay container's content
        overlayContainer.innerHTML = '';
        
        // If mobile view is requested, add mobile-specific classes and header
        if (isMobile) {
          console.log("Adding mobile-specific styling");
          content.classList.add('mobile-view');
          
          // Create and add mobile header
          const mobileHeader = document.createElement('header');
          mobileHeader.className = 'property-mobile';
          mobileHeader.innerHTML = `
            <div class="mobile-nav">
              <a href="/" aria-label="Home">
                <img src="img/logos/FP-Logomark-RGB.svg" class="rgb-logo" alt="RGB Logo">
              </a>
              <a href="#" onclick="closeContactForm(); return false;" class="menu-button" aria-label="Close contact form">
                <img src="img/close.svg" class="menu" alt="Close">
              </a>
            </div>
          `;
          
          // Add the header to the beginning of the content
          content.insertBefore(mobileHeader, content.firstChild);
        }
        
        overlayContainer.appendChild(content.cloneNode(true));
        
        // Ensure all links with closeContactForm use the global one
        const closeLinks = overlayContainer.querySelectorAll('a[href^="javascript:closeContactForm"]');
        closeLinks.forEach(link => {
          link.setAttribute('href', '#');
          link.setAttribute('onclick', 'closeContactForm(); return false;');
        });
        
        console.log("Overlay content loaded successfully");
        
        // Initialize any event listeners or scripts needed for the overlay
        initOverlayScripts();
        
        return true;
      } else {
        console.error('Could not find overlay content in the loaded HTML');
        return false;
      }
    })
    .catch(error => {
      console.error('Error loading overlay:', error);
      return false;
    });
}

// Initialize overlay scripts and event handlers
function initOverlayScripts() {
  // This function is called after the overlay content is loaded
  console.log("Initialize overlay scripts");
}

// Directly handle showing external overlays without causing recursion
function ShowExternalOverlay(overlayName, animationName, htmlFilePath, isMobile = false) {
  console.log(`ShowExternalOverlay called for ${overlayName}, isMobile: ${isMobile}`);
  
  // The ID of the overlay container
  const overlayId = `overlay-${overlayName}`;
  
  // Check if the overlay already exists with content
  const overlay = document.getElementById(overlayId);
  const needsLoading = !overlay || !overlay.hasChildNodes();
  
  console.log(`Overlay exists: ${!!overlay}, Needs loading: ${needsLoading}`);
  
  // Lock scrolling when showing overlay
  if (window.lockScroll) {
    window.lockScroll();
  } else {
    document.documentElement.classList.add('no-scroll');
    document.body.classList.add('no-scroll');
  }
  
  // Function to apply animation
  const applyAnimation = () => {
    const overlayElement = document.getElementById(overlayId);
    if (overlayElement) {
      var cssClasses = overlayElement.className.split(" ");
      var last = cssClasses.slice(-1)[0];
      if (last.lastIndexOf("animate") == -1) {
        overlayElement.className = overlayElement.className + " " + animationName;
      }
      
      // Add mobile class if needed
      if (isMobile && !overlayElement.classList.contains('mobile-overlay')) {
        overlayElement.classList.add('mobile-overlay');
      }
      
      console.log(`Applied animation ${animationName}, mobile class: ${isMobile}`);
    }
  };
  
  // Load the content if needed, then show it
  if (needsLoading) {
    loadOverlay(overlayId, htmlFilePath, isMobile)
      .then(() => {
        // Apply animation after content is loaded
        setTimeout(applyAnimation, 50);
      });
  } else {
    // Content already loaded, just show the overlay
    applyAnimation();
  }
}

// Detect if we're on mobile
function isMobileDevice() {
  const mobile = window.innerWidth <= 768 || 
         navigator.userAgent.match(/Android/i) || 
         navigator.userAgent.match(/iPhone|iPad|iPod/i);
  console.log("isMobileDevice:", mobile);
  return mobile;
}

// Initialize when the document is loaded
document.addEventListener('DOMContentLoaded', function() {
  console.log("Document loaded, initializing overlays");
  
  // Pre-load the contact form so it's ready when needed
  // Check if we're on mobile-menu page to pre-load with mobile styling
  const isMobileMenu = document.getElementById('anPageName') && 
                        document.getElementById('anPageName').value === 'menu-mobile';
  
  console.log("Is mobile menu page:", isMobileMenu);
  
  // Only preload on desktop or explicitly on mobile menu
  if (!isMobileDevice() || isMobileMenu) {
    loadOverlay('overlay-contact-us', 'contact-us.html', isMobileMenu);
  }

  // Check if scrolling was locked before page refresh and restore it if needed
  try {
    if (sessionStorage.getItem('scrollLocked') === 'true') {
      window.lockScroll();
    }
  } catch (e) {
    console.log('Could not access sessionStorage', e);
  }
}); 