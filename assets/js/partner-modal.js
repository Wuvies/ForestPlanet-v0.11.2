/**
 * Partner Modal functionality for ForestPlanet
 * Handles opening and closing of partner information modals using FLIP animation
 * Works with WordPress partner custom post type data
 */

document.addEventListener('DOMContentLoaded', function() {
  // Get partner data from WordPress (localized script)
  const partnerData = typeof forestPlanetPartners !== 'undefined' ? forestPlanetPartners.partnerData : {};
  
  // Fallback if no data is provided (for development/testing)
  if (Object.keys(partnerData).length === 0) {
    console.warn('No partner data found. Using placeholder data.');
  }

  // Variables for FLIP animation
  let selectedCard = null;
  let cardRect = null;
  let modalRect = null;
  let isAnimating = false;

  // Get DOM elements
  const partnerCards = document.querySelectorAll('.partner-card');
  const modal = document.getElementById('partner-modal-overlay');
  const modalContainer = document.querySelector('.partner-modal-container');
  const modalClose = document.querySelector('.partner-modal-close');
  const modalTitle = document.querySelector('.partner-modal-title');
  const modalLogo = document.querySelector('.partner-modal-logo');
  const modalDescription = document.querySelector('.partner-modal-description');
  const modalLink = document.querySelector('.partner-modal-link');
  
  // Function to extract partner ID from card's data attribute
  function getPartnerIdFromCard(card) {
    // First try to get from data attribute
    const partnerId = card.getAttribute('data-partner-id');
    if (partnerId) {
      return partnerId;
    }
    
    // Fallback to getting from image source
    const img = card.querySelector('img');
    if (!img) return null;
    
    const srcParts = img.src.split('/');
    const filename = srcParts[srcParts.length - 1];
    return filename.replace('-logo.svg', '').replace('.svg', '').replace('.png', '').replace('.jpg', '');
  }
  
  // Check if we're on mobile or desktop view
  function isMobileView() {
    return window.innerWidth <= 901;
  }
  
  // Adjust modal title class based on screen size
  function adjustModalTitleClass() {
    if (isMobileView()) {
      modalTitle.classList.remove('heading-2');
      modalTitle.classList.add('heading-2-mobile');
    } else {
      modalTitle.classList.remove('heading-2-mobile');
      modalTitle.classList.add('heading-2');
    }
  }
  
  // FLIP Animation Implementation
  function calculateTransform(fromRect, toRect) {
    // Calculate scale and translate differences
    const scaleX = fromRect.width / toRect.width;
    const scaleY = fromRect.height / toRect.height;
    const translateX = fromRect.left - toRect.left;
    const translateY = fromRect.top - toRect.top;
    
    return {
      scaleX,
      scaleY,
      translateX,
      translateY
    };
  }
  
  function applyTransform(element, { scaleX, scaleY, translateX, translateY }) {
    element.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scaleX}, ${scaleY})`;
  }
  
  function resetTransform(element) {
    element.style.transform = '';
  }
  
  // Function to open modal with partner data and FLIP animation
  function openPartnerModal(card, partnerId) {
    if (isAnimating) return;
    isAnimating = true;
    selectedCard = card;
    
    const partner = partnerData[partnerId];
    if (!partner) {
      console.error('Partner data not found for ID:', partnerId);
      isAnimating = false;
      return;
    }
    
    // FIRST: Get the position and size of the card
    cardRect = card.getBoundingClientRect();
    
    // Prepare modal content (pre-load images before starting animation)
    adjustModalTitleClass();
    
    // Create and preload the image to avoid content flashing
    if (partner.logoSrc) {
      const preloadImg = new Image();
      preloadImg.onload = () => {
        continueOpeningModal(card, partner);
      };
      preloadImg.onerror = () => {
        // If image fails to load, continue anyway
        continueOpeningModal(card, partner);
      };
      preloadImg.src = partner.logoSrc;
    }
    
    // If image is cached or takes too long, continue after a short delay
    setTimeout(() => {
      if (isAnimating && selectedCard === card) {
        continueOpeningModal(card, partner);
      }
    }, 50);
  }
  
  // Continue opening the modal after preloading content
  function continueOpeningModal(card, partner) {
    // Make sure we're not duplicating animations
    if (!isAnimating || selectedCard !== card) return;
    
    // Populate content
    modalTitle.textContent = partner.name;
    
    if (partner.logoSrc) {
      modalLogo.src = partner.logoSrc;
      modalLogo.alt = partner.name + ' logo';
      // Ensure logo is visible immediately when animation starts
      modalLogo.style.opacity = '1';
      modalLogo.style.display = 'block';
    } else {
      // Hide logo if none is provided
      modalLogo.style.display = 'none';
    }
    
    // Set description
    modalDescription.textContent = partner.description || '';
    
    // Update visit website link - show only if website is provided
    const linkText = modalLink.querySelector('.secondary-button-mirage-text');
    if (partner.website && linkText) {
      linkText.textContent = 'Visit ' + partner.name + ' Website';
      modalLink.style.display = 'flex';
      
      // Add click event to the link
      modalLink.onclick = function() {
        window.open(partner.website, '_blank');
      };
    } else {
      modalLink.style.display = 'none';
    }
    
    // Make modal visible but not yet animated
    modal.style.visibility = 'visible';
    modal.style.display = 'flex';
    modal.style.opacity = '1'; // Show the background immediately
    
    // Force layout calculation before animation
    forceReflow(modalContainer);
    
    // LAST: Get the final position and size of the modal container
    modalRect = modalContainer.getBoundingClientRect();
    
    // Add a starting style to ensure full opacity before transform
    modalContainer.style.opacity = '1';
    
    // INVERT: Apply transform to make the modal appear at the card's position
    const transformValues = calculateTransform(cardRect, modalRect);
    applyTransform(modalContainer, transformValues);
    
    // Mark the card as opening
    selectedCard.classList.add('card-opening');
    
    // Force another layout calculation to ensure the transform is applied
    forceReflow(modalContainer);
    
    // Add the transition class for animation
    modalContainer.classList.add('animate-transform');
    
    // PLAY: Start the animation by removing the transform
    // We'll add the active class almost immediately to make content appear faster
    setTimeout(() => {
      // Reset transform to animate to final position
      resetTransform(modalContainer);
      
      // Add active class very soon to make content appear quickly
      setTimeout(() => {
        modal.classList.add('active');
      }, 100);
      
      // Prevent scrolling
      document.body.style.overflow = 'hidden';
    }, 30);
    
    // Complete the animation
    modalContainer.addEventListener('transitionend', function onTransitionEnd(e) {
      // Only respond to transform transitions, not opacity
      if (e.propertyName === 'transform') {
        isAnimating = false;
        modalContainer.removeEventListener('transitionend', onTransitionEnd);
      }
    });
  }
  
  // Function to close the modal with FLIP animation
  function closeModal() {
    if (isAnimating || !selectedCard) return;
    isAnimating = true;
    
    // Remove active class
    modal.classList.remove('active');
    
    // Get the current positions
    modalRect = modalContainer.getBoundingClientRect();
    cardRect = selectedCard.getBoundingClientRect();
    
    // Calculate and apply transform to animate back to card
    const transformValues = calculateTransform(cardRect, modalRect);
    
    // Start transition
    requestAnimationFrame(() => {
      modalContainer.classList.add('animate-transform');
      applyTransform(modalContainer, transformValues);
      modal.style.opacity = '0';
      
      // Once animation completes, reset everything
      modalContainer.addEventListener('transitionend', function onTransitionEnd() {
        // Reset modal
        modal.style.visibility = 'hidden';
        modal.style.display = 'none';
        modalContainer.classList.remove('animate-transform');
        resetTransform(modalContainer);
        
        // Reset selected card
        selectedCard.classList.remove('card-opening');
        selectedCard = null;
        
        // Re-enable scrolling
        document.body.style.overflow = '';
        
        isAnimating = false;
        modalContainer.removeEventListener('transitionend', onTransitionEnd);
      }, { once: true });
    });
  }
  
  // Add click event listeners to partner cards
  partnerCards.forEach(card => {
    card.addEventListener('click', function() {
      // Remove focus from the card after clicking
      this.blur();
      
      const partnerId = getPartnerIdFromCard(this);
      if (partnerId) {
        openPartnerModal(this, partnerId);
      }
    });
    
    // For accessibility, also handle keyboard navigation
    card.addEventListener('keydown', function(event) {
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        
        const partnerId = getPartnerIdFromCard(this);
        if (partnerId) {
          openPartnerModal(this, partnerId);
        }
      }
    });
  });
  
  // Close modal when clicking the close button
  if (modalClose) {
    modalClose.addEventListener('click', function() {
      closeModal();
    });
  }
  
  // Close modal when clicking outside the modal content
  if (modal) {
    modal.addEventListener('click', function(event) {
      if (event.target === modal) {
        closeModal();
      }
    });
  }
  
  // Close modal when pressing ESC key
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && modal && modal.classList.contains('active')) {
      closeModal();
    }
  });
  
  // Update modal sizing on window resize
  window.addEventListener('resize', function() {
    adjustModalTitleClass();
    
    // If modal is open and we have a selected card, make sure positions stay correct
    if (modal && modal.classList.contains('active') && selectedCard && !isAnimating) {
      // If transitioning, wait for it to complete
      const rect = modalContainer.getBoundingClientRect();
      
      // If modal is smaller than viewport, center it
      if (rect.width < window.innerWidth * 0.6) {
        modalContainer.style.margin = 'auto';
      }
    }
  });
  
  // Helper function to ensure smooth animations by forcing layout recalculation
  function forceReflow(element) {
    // Reading offsetHeight will force a reflow
    return element.offsetHeight;
  }
}); 