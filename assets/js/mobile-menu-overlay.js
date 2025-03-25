/**
 * Mobile Menu Overlay functionality for ForestPlanet Theme
 */

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