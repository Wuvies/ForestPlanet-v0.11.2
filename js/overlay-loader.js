// This file handles the dynamic loading of overlays
// It avoids having to embed the same HTML in multiple files

// Make sure we have a global handler for contact form close
if (!window.handleCloseContact) {
  window.handleCloseContact = function(event) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    console.log("Global handleCloseContact called");
    
    // Find the overlay
    const overlay = document.querySelector('.mobile-overlay');
    if (!overlay) {
      console.log("No mobile overlay found to close");
      return false;
    }
    
    const isFromMenu = overlay.getAttribute('data-from-menu') === 'true';
    console.log("Is from menu:", isFromMenu);
    
    // If from menu, start the menu disappear animation immediately
    // This makes both animations run in parallel
    if (isFromMenu && window.closeMenuMobile) {
      console.log("Starting menu animation in parallel");
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
      
      // If from menu, hide the menu overlay (without animation since we started it earlier)
      if (isFromMenu) {
        // Hide the menu overlay
        const menuOverlay = document.getElementById('mobile-menu-overlay');
        if (menuOverlay) {
          menuOverlay.style.display = 'none';
        }
      }
      
      // Always unlock scrolling
      if (window.unlockScroll) {
        window.unlockScroll();
      } else {
        document.documentElement.classList.remove('no-scroll');
        document.body.classList.remove('no-scroll');
        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';
      }
    }, 300);
    
    return false;
  };
}

// Global functions for scroll locking/unlocking
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
  
  // Optional: Store the locked state for persistence across page loads
  try {
    sessionStorage.setItem('scrollLocked', 'true');
  } catch (e) {
    console.log('Could not access sessionStorage', e);
  }
};

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
  
  // Clear the locked state
  try {
    sessionStorage.removeItem('scrollLocked');
  } catch (e) {
    console.log('Could not access sessionStorage', e);
  }
};

// Global function to handle contact form cancellation
window.cancelContactForm = function() {
  console.log("cancelContactForm called");
  
  // First check for mobile overlay
  const mobileOverlay = document.querySelector('.mobile-overlay');
  const desktopOverlay = document.getElementById('overlay-contact-us');
  
  // Check if this is a mobile overlay from the menu
  const isFromMenu = mobileOverlay && mobileOverlay.getAttribute('data-from-menu') === 'true';
  
  // CASE 1: Mobile overlay from menu
  if (isFromMenu && mobileOverlay) {
    console.log("Handling mobile overlay from menu");
    // If from menu, start the menu animation in parallel
    const menuElement = document.querySelector('.menu-mobile');
    if (menuElement) {
      console.log("Starting menu animation in parallel for cancel");
      menuElement.classList.remove('animate-disappear'); // Remove any disappear animation
      menuElement.style.opacity = '1';
      menuElement.style.pointerEvents = 'auto';
    }

    // Apply disappear animation to contact form
    mobileOverlay.classList.remove('animate-appear');
    mobileOverlay.classList.add('animate-disappear');
    
    // After animation, clean up
    setTimeout(function() {
      // Remove the contact overlay
      if (mobileOverlay.parentNode) {
        mobileOverlay.parentNode.removeChild(mobileOverlay);
      }
      
      // Unlock scrolling
      if (window.unlockScroll) {
        window.unlockScroll();
      }
    }, 250);
  }
  // CASE 2: Desktop overlay
  else if (desktopOverlay && desktopOverlay.style.display !== 'none') {
    console.log("Handling desktop overlay");
    // Add disappear animation
    desktopOverlay.classList.remove('animate-appear');
    desktopOverlay.classList.add('animate-disappear');
    
    // After animation completes, hide the overlay
    setTimeout(function() {
      // Hide overlay but don't remove it
      desktopOverlay.style.display = 'none';
      
      // Unlock scrolling
      if (window.unlockScroll) {
        window.unlockScroll();
      }
    }, 300);
  }
  // CASE 3: Mobile overlay (not from menu)
  else if (mobileOverlay) {
    console.log("Handling standalone mobile overlay");
    // Use the mobile contact handler
    if (window.handleCloseContact) {
      window.handleCloseContact(new Event('click'));
    }
  }
  // CASE 4: Fallback to the original close function
  else {
    console.log("Fallback: using closeContactForm");
    closeContactForm();
  }
  
  return false;
};

// Global function to close the contact form
window.closeContactForm = function() {
  console.log("closeContactForm called");
  
  // Try both selectors to ensure we find the active overlay regardless of device detection
  let overlay = document.querySelector('.mobile-overlay');
  let desktopOverlay = document.getElementById('overlay-contact-us');
  
  // Check if we have a visible desktop overlay
  const isDesktop = desktopOverlay && 
                    desktopOverlay.style.display !== 'none' && 
                    (desktopOverlay.classList.contains('animate-appear') || 
                     !desktopOverlay.classList.contains('animate-disappear'));
  
  // If we found a desktop overlay, use that
  if (isDesktop) {
    console.log("Closing desktop overlay");
    
    // Add disappear animation
    desktopOverlay.classList.remove('animate-appear');
    desktopOverlay.classList.add('animate-disappear');
    
    // After animation completes, hide the overlay
    setTimeout(function() {
      desktopOverlay.style.display = 'none';
      
      // Unlock scrolling
      if (window.unlockScroll) {
        window.unlockScroll();
      }
    }, 300);
    return;
  }
  
  // If no mobile overlay found or it's hidden, check if we should exit
  if (!overlay || overlay.style.display === 'none') {
    if (!isDesktop) {
      console.log("No visible overlay found to close");
      return;
    }
  }
  
  console.log("Closing mobile overlay");
  
  // Check if this was opened from the mobile menu
  const isFromMenu = overlay.getAttribute && overlay.getAttribute('data-from-menu') === 'true';
  const isStandaloneMenu = overlay.getAttribute && overlay.getAttribute('data-standalone-menu') === 'true';
  
  // If from menu, start the menu animation immediately in parallel
  if (isFromMenu && window.closeMenuMobile) {
    console.log("Starting menu animation in parallel");
    const menuElement = document.querySelector('.menu-mobile');
    if (menuElement) {
      menuElement.classList.add('animate-disappear');
    }
  }
  
  // Remove appear animation and add disappear for mobile overlay
  overlay.classList.remove('animate-appear');
  overlay.classList.add('animate-disappear');
  
  // After animation completes, hide the overlay
  setTimeout(function() {
    // Hide overlay but don't remove it (use display:none instead)
    overlay.style.display = 'none';
    
    // If menu overlay is active, handle it too
    if (isFromMenu) {
      // Hide the menu overlay (without animation since we started it earlier)
      const menuOverlay = document.getElementById('mobile-menu-overlay');
      if (menuOverlay) {
        menuOverlay.style.display = 'none';
      }
    }
    
    // Unlock scrolling
    window.unlockScroll();
  }, 300); // Match to animation duration
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
        
        // If mobile view is requested, add mobile-specific classes
        if (isMobile) {
          console.log("Adding mobile-specific styling");
          content.classList.add('mobile-view');
          
          // Check if it already has a mobile header
          const existingHeader = content.querySelector('.property-mobile');
          if (!existingHeader) {
            console.log("No existing header found, adding one");
            // Create and add mobile header with improved touch support
            const mobileHeader = document.createElement('header');
            mobileHeader.className = 'property-mobile';
            mobileHeader.innerHTML = `
              <div class="mobile-nav">
                <a href="/" aria-label="Home">
                  <img src="img/logos/FP-Logomark-RGB.svg" class="rgb-logo" alt="RGB Logo">
                </a>
                <button type="button" class="menu-button" aria-label="Close contact form" id="closeContactButton" onclick="handleCloseContact(event); return false;">
                  <img src="img/X.svg" class="menu" alt="Close Icon">
                </button>
              </div>
            `;
            
            // Add the header to the beginning of the content
            content.insertBefore(mobileHeader, content.firstChild);
          } else {
            console.log("Existing header found, not adding a new one");
          }
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
        
        // Add click outside to close functionality for desktop contact form
        if (overlayId === 'overlay-contact-us' && !isMobile) {
          console.log("Adding click-outside-to-close functionality for desktop");
          
          // Remove any existing listener first to avoid duplicates
          overlayContainer.removeEventListener('click', closeOnClickOutside);
          
          // Add the click listener that closes when clicking outside the form
          overlayContainer.addEventListener('click', closeOnClickOutside);
        }
        
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

// Function to close overlay when clicking outside the form
function closeOnClickOutside(event) {
  // Find the form container - the contact-us-1 div
  const formContainer = document.querySelector('#overlay-contact-us .contact-us-1');
  
  // If we have a form container and the click is outside it
  if (formContainer && !formContainer.contains(event.target)) {
    console.log("Click detected outside form - closing");
    
    // Stop the event from propagating further
    event.preventDefault();
    event.stopPropagation();
    
    // Close the form using the global function
    if (window.cancelContactForm) {
      window.cancelContactForm();
    } else if (window.closeContactForm) {
      window.closeContactForm();
    }
  }
}

// Initialize overlay scripts and event handlers
function initOverlayScripts() {
  // This function is called after the overlay content is loaded
  console.log("Initialize overlay scripts");
  
  // Add click-outside-to-close for desktop contact form if it exists
  const desktopOverlay = document.getElementById('overlay-contact-us');
  if (desktopOverlay && !desktopOverlay.classList.contains('mobile-view')) {
    console.log("Adding click-outside-to-close to existing desktop overlay");
    // Remove any existing listener first to avoid duplicates
    desktopOverlay.removeEventListener('click', closeOnClickOutside);
    // Add the click listener
    desktopOverlay.addEventListener('click', closeOnClickOutside);
  }
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
  window.lockScroll();
  
  // Function to apply animation
  const applyAnimation = () => {
    const overlayElement = document.getElementById(overlayId);
    if (overlayElement) {
      // Ensure the overlay is visible before animation
      if (isMobile) {
        overlayElement.style.display = 'flex'; // Use flex for better mobile layout
      } else {
        overlayElement.style.display = 'flex'; // Use flex for desktop too for centering
      }
      
      // Add animation class
      overlayElement.classList.remove('animate-disappear');
      overlayElement.classList.add(animationName);
      
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
  // Check window width first
  const isMobileWidth = window.innerWidth <= 768;
  
  // Check for mobile user agents - use Boolean() to ensure we return true/false 
  // rather than the regex match object
  const isAndroid = Boolean(navigator.userAgent.match(/Android/i));
  const isIOS = Boolean(navigator.userAgent.match(/iPhone|iPad|iPod/i));
  
  // Combine all checks
  const isMobile = isMobileWidth || isAndroid || isIOS;
  
  console.log("isMobileDevice:", isMobile, "width:", window.innerWidth, "Android:", isAndroid, "iOS:", isIOS);
  return isMobile;
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

// For backward compatibility - redirects to ShowExternalOverlay
function ShowOverlay(overlayName, animationName) {
  console.log(`ShowOverlay called (legacy function) for ${overlayName}`);
  // Default to contact-us.html if the filename is not provided
  const htmlFilePath = `${overlayName}.html`;
  ShowExternalOverlay(overlayName, animationName, htmlFilePath);
}

// For backward compatibility - provides overlay hiding functionality
function HideOverlay(overlayName, animationName) {
  console.log(`HideOverlay called (legacy function) for ${overlayName}`);
  const overlayId = `overlay-${overlayName}`;
  const overlayElement = document.getElementById(overlayId);
  
  if (overlayElement) {
    var cssClasses = overlayElement.className.split(" ");
    var last = cssClasses.slice(-1)[0];
    if (last.lastIndexOf("animate") != -1) {
      overlayElement.className = overlayElement.className.replace(
        cssClasses.slice(-1)[0],
        animationName
      );
    }
  }
  
  // Unlock scrolling
  window.unlockScroll();
}