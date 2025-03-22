/**
 * ForestPlanet Image Modal
 * Creates an iOS-style expanding image modal when clicking on images with the "story-image" class.
 * 
 * This script implements a FLIP animation (First, Last, Invert, Play) for smooth transitions
 * between thumbnail images and a full-screen modal.
 */

document.addEventListener('DOMContentLoaded', function() {
  // Initialize the image modal
  initImageModal();
});

/**
 * Initializes the image modal functionality
 */
function initImageModal() {
  // Check if the modal HTML exists, if not create it
  if (!document.getElementById('imageModal')) {
    createModalElement();
  }

  // Get necessary elements
  const storyImages = document.querySelectorAll('.story-image');
  const modal = document.getElementById('imageModal');
  const modalImage = document.getElementById('modalImage');
  const modalCaption = document.getElementById('modalCaption');
  const closeModal = document.getElementById('closeModal');
  
  // State variables
  let originatingImage = null;
  let isAnimating = false;
  let originalScrollY = 0;
  
  // Preload common images to make animations smoother first time
  preloadImages(storyImages);
  
  // Attach click events to all story images
  attachImageClickEvents(storyImages, modal, modalImage, modalCaption);
  
  // Attach close events
  attachCloseEvents(modal, closeModal);
}

/**
 * Preloads all images to make animations smoother on first view
 * @param {NodeList} images - The images to preload
 */
function preloadImages(images) {
  images.forEach(img => {
    const preloader = new Image();
    preloader.src = img.src;
  });
}

/**
 * Creates the modal HTML if it doesn't exist
 */
function createModalElement() {
  const modalHTML = `
    <div class="image-modal" id="imageModal">
      <div class="modal-content">
        <img src="" alt="" class="modal-image" id="modalImage">
        <div class="modal-caption body-2-regular" id="modalCaption"></div>
        <div class="close-modal" id="closeModal">
          <img src="img/X.svg" alt="Close" width="24" height="24">
        </div>
      </div>
    </div>
  `;
  
  document.body.insertAdjacentHTML('beforeend', modalHTML);
}

/**
 * Attaches click events to all story images
 * @param {NodeList} storyImages - The story images
 * @param {HTMLElement} modal - The modal element
 * @param {HTMLImageElement} modalImage - The modal image
 * @param {HTMLElement} modalCaption - The modal caption
 */
function attachImageClickEvents(storyImages, modal, modalImage, modalCaption) {
  // State variables
  let originatingImage = null;
  let isAnimating = false;
  let originalScrollY = 0;
  
  storyImages.forEach(image => {
    image.style.cursor = 'pointer';
    
    image.addEventListener('click', function() {
      if (isAnimating) return;
      isAnimating = true;
      originatingImage = this;
      
      // Store original scroll position
      originalScrollY = window.scrollY;
      
      // IMMEDIATELY hide the original image
      originatingImage.classList.add('modal-source-immediate');
      
      // Add class to the body to help with CSS selectors
      document.body.classList.add('modal-active');
      
      // Get image source and caption
      const imageSrc = this.src;
      let caption = '';
      
      // Find caption - look for the next sibling paragraph
      const container = this.closest('.story-image-container');
      if (container) {
        const captionEl = container.querySelector('p, div');
        if (captionEl) {
          caption = captionEl.textContent;
        }
      }
      
      // FIRST: Get the starting position of the clicked image
      const imageRect = this.getBoundingClientRect();
      
      // Prepare modal
      modal.style.visibility = 'visible';
      modal.style.display = 'flex';
      modal.style.opacity = '0';
      
      // Set content
      modalImage.src = imageSrc;
      modalCaption.textContent = caption;
      
      // Preload the image separately to ensure we have dimensions
      const preloadImg = new Image();
      preloadImg.src = imageSrc;
      
      // Wait for image to load to get proper dimensions
      function continueWithFlipAnimation() {
        // Now switch from immediate to regular hiding class
        if (originatingImage.classList.contains('modal-source-immediate')) {
          originatingImage.classList.remove('modal-source-immediate');
          originatingImage.classList.add('modal-source');
        }
        
        // Make sure image is hidden during setup
        modalImage.style.opacity = '0';
        
        // LAST: Get the final position of the modal image
        const modalImageRect = modalImage.getBoundingClientRect();
        
        // INVERT: Calculate transform to make modal image appear at original position
        const transformValues = calculateTransform(imageRect, modalImageRect);
        applyTransform(modalImage, transformValues);
        
        // CRITICAL: Force browser to recognize the transform before continuing
        forceReflow(modalImage);
        
        // Make the modal image visible in its initial position
        modalImage.style.opacity = '1';
        
        // PLAY: Begin the animation transition
        // First fade in the modal background slightly
        requestAnimationFrame(() => {
          modal.style.opacity = '1';
          
          // Then start the transform animation in the next frame
          requestAnimationFrame(() => {
            modalImage.classList.add('animate-transform');
            resetTransform(modalImage);
            
            // Add active class after animation starts
            setTimeout(() => {
              modal.classList.add('active');
              // Prevent scrolling
              document.body.style.overflow = 'hidden';
            }, 50);
          });
        });
        
        // Mark animation as complete when transition ends
        modalImage.addEventListener('transitionend', function onTransitionEnd(e) {
          if (e.propertyName === 'transform') {
            isAnimating = false;
            modalImage.removeEventListener('transitionend', onTransitionEnd);
          }
        });
      }
      
      // If the preloaded image or modal image is already loaded, proceed immediately
      if (preloadImg.complete || modalImage.complete) {
        // Short delay to ensure browser has processed everything
        requestAnimationFrame(() => {
          continueWithFlipAnimation();
        });
      } else {
        // Otherwise wait for it to load
        preloadImg.onload = continueWithFlipAnimation;
      }
    });
  });
  
  // Close modal when clicking the close button or outside the image
  function closeModalWithAnimation() {
    if (isAnimating || !originatingImage) return;
    isAnimating = true;
    
    // Ensure the image stays visible during closing animation
    modalImage.classList.add('animate-closing');
    
    // Remove active class (hides caption and close button)
    modal.classList.remove('active');
    
    // Calculate current positions
    const modalImageRect = modalImage.getBoundingClientRect();
    
    // Account for scrolling that may have occurred
    const scrollDiff = window.scrollY - originalScrollY;
    
    // Get the original image's current bounds
    const originalImageRect = originatingImage.getBoundingClientRect();
    
    // Create a rect that represents where the original image would be, accounting for scroll
    const adjustedRect = {
      width: originalImageRect.width,
      height: originalImageRect.height,
      left: originalImageRect.left,
      top: originalImageRect.top + scrollDiff
    };
    
    // Calculate transform to animate back to original position
    const transformValues = calculateTransform(adjustedRect, modalImageRect);
    
    // Apply the transform to begin the animation
    requestAnimationFrame(() => {
      modalImage.classList.add('animate-transform');
      applyTransform(modalImage, transformValues);
      
      // Fade out modal background
      modal.style.opacity = '0';
    });
    
    // Handle transition end
    modalImage.addEventListener('transitionend', function onTransitionEnd(e) {
      if (e.propertyName === 'transform') {
        // Prepare to show the original image
        if (originatingImage.classList.contains('modal-source')) {
          originatingImage.classList.remove('modal-source');
        }
        if (originatingImage.classList.contains('modal-source-immediate')) {
          originatingImage.classList.remove('modal-source-immediate');
        }
        
        // Make sure original image is visible
        originatingImage.style.visibility = 'visible';
        originatingImage.style.opacity = '1';
        
        // Small delay to ensure browser renders original image
        requestAnimationFrame(() => {
          // Now hide the modal
          modal.style.visibility = 'hidden';
          modal.style.display = 'none';
          
          // Reset transforms
          modalImage.classList.remove('animate-transform');
          modalImage.classList.remove('animate-closing');
          resetTransform(modalImage);
          
          // Remove modal active class
          document.body.classList.remove('modal-active');
          
          // Re-enable scrolling
          document.body.style.overflow = '';
          
          originatingImage = null;
          isAnimating = false;
        });
        
        modalImage.removeEventListener('transitionend', onTransitionEnd);
      }
    });
  }
  
  // Set up the shared closeModalWithAnimation function
  window.closeImageModal = closeModalWithAnimation;
}

/**
 * Attaches close events to the modal
 * @param {HTMLElement} modal - The modal element
 * @param {HTMLElement} closeButton - The close button element
 */
function attachCloseEvents(modal, closeButton) {
  // Close modal when clicking the close button
  closeButton.addEventListener('click', function() {
    window.closeImageModal();
  });
  
  // Close modal when clicking outside the image
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      window.closeImageModal();
    }
  });
  
  // Close modal with escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal.classList.contains('active')) {
      window.closeImageModal();
    }
  });
}

/**
 * Helper function to force layout recalculation
 * @param {HTMLElement} element - The element to force reflow on
 * @returns {HTMLElement} - The same element
 */
function forceReflow(element) {
  void element.offsetHeight;
  return element;
}

/**
 * Calculates the transform between two rectangles
 * @param {DOMRect} fromRect - The source rectangle
 * @param {DOMRect} toRect - The target rectangle
 * @returns {Object} - The transform values
 */
function calculateTransform(fromRect, toRect) {
  // Calculate scales correctly to ensure corners match up
  const scaleX = fromRect.width / toRect.width;
  const scaleY = fromRect.height / toRect.height;
  
  // Calculate the translation needed to align the top-left corners
  const translateX = fromRect.left - toRect.left;
  const translateY = fromRect.top - toRect.top;
  
  return {
    scaleX,
    scaleY,
    translateX,
    translateY
  };
}

/**
 * Applies transform to an element
 * @param {HTMLElement} element - The element to transform
 * @param {Object} transform - The transform values
 */
function applyTransform(element, { scaleX, scaleY, translateX, translateY }) {
  element.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scaleX}, ${scaleY})`;
}

/**
 * Resets transform on an element
 * @param {HTMLElement} element - The element to reset transform on
 */
function resetTransform(element) {
  element.style.transform = '';
} 