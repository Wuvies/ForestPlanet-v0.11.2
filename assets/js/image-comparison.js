/**
 * Image comparison slider functionality 
 * Controls the before/after image slider on the homepage
 */

// Track if we're currently dragging
let isDragging = false;

// Slider functionality for both mouse and touch events
function moveDivisor(e, container) {
    // Get the divisor element
    const divisor = container.querySelector('.divisor');
    const comparisonWidth = container.clientWidth;
    
    // Calculate position based on event type
    let position;
    if (e.type === 'mousemove') {
        position = e.offsetX;
    } else if (e.type === 'touchmove' || e.type === 'touchstart') {
        // Prevent scrolling while sliding
        e.preventDefault();
        // Get touch position relative to container
        const rect = container.getBoundingClientRect();
        const touch = e.touches[0];
        position = touch.clientX - rect.left;
    }

    // Ensure position stays within bounds
    position = Math.max(0, Math.min(position, comparisonWidth));
    
    // Calculate percentage
    const percentage = (position * 100 / comparisonWidth);
    
    // Update divisor width
    divisor.style.width = percentage + "%";
    
    // Update handle position if on touch device - match the divisor width
    if (window.matchMedia('(hover: none) and (pointer: coarse)').matches) {
        container.style.setProperty('--handle-left', percentage + '%');
    }
}

// Initialize comparison sliders
function initComparisonSliders() {
    // Add touch event listeners to all comparison sliders
    document.querySelectorAll('.comparison').forEach(slider => {
        // Set initial handle position to match initial divisor width
        if (window.matchMedia('(hover: none) and (pointer: coarse)').matches) {
            const divisor = slider.querySelector('.divisor');
            slider.style.setProperty('--handle-left', '50%');
            divisor.style.width = '50%';
        }

        slider.addEventListener('touchstart', e => {
            const rect = slider.getBoundingClientRect();
            const touch = e.touches[0];
            const touchX = touch.clientX - rect.left;
            const divisor = slider.querySelector('.divisor');
            const divisorWidth = (divisor.offsetWidth / rect.width) * rect.width;
            const tolerance = 50; // Increased tolerance for better touch detection

            // Check if touch is near the divider line
            if (Math.abs(touchX - divisorWidth) <= tolerance) {
                isDragging = true;
                e.preventDefault();
                moveDivisor(e, slider);
            } else {
                // If not near the divider, move the divider to the touch position
                isDragging = true;
                moveDivisor(e, slider);
            }
        });

        slider.addEventListener('touchmove', e => {
            if (isDragging) {
                moveDivisor(e, slider);
            }
        });

        slider.addEventListener('touchend', () => {
            isDragging = false;
        });

        slider.addEventListener('touchcancel', () => {
            isDragging = false;
        });

        // Keep existing mouse event
        slider.addEventListener('mousemove', e => {
            moveDivisor(e, slider);
        });
    });
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', initComparisonSliders);

// Export for WordPress
window.ForestPlanet = window.ForestPlanet || {};
window.ForestPlanet.imageComparison = {
    moveDivisor: moveDivisor,
    initComparisonSliders: initComparisonSliders
}; 