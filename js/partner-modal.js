/**
 * Partner Modal functionality
 * Handles opening and closing of partner information modals using FLIP animation
 */

document.addEventListener('DOMContentLoaded', function() {
  // Partner data - this would ideally come from a database or API
  const partnerData = {
    '5d-vision': {
      name: '5D Vision',
      description: "5D Vision is dedicated to sustainability and environmental responsibility. Through innovative approaches, they collaborate with ForestPlanet to promote ecological balance and conservation initiatives.",
      website: 'https://example.com/5d-vision',
      logoSrc: 'img/partner-logos/5d-vision-logo.svg'
    },
    'dov-jewelry': {
      name: 'DOV Jewelry',
      description: "DOV Jewelry crafts sustainable, ethically-sourced accessories while supporting reforestation efforts. With each purchase, they contribute to planting trees through their partnership with ForestPlanet.",
      website: 'https://example.com/dov-jewelry',
      logoSrc: 'img/partner-logos/dov-jewelry-logo.svg'
    },
    'full-sail-media': {
      name: 'Full Sail Media',
      description: "Full Sail Media integrates environmental consciousness into their digital storytelling. Through their partnership with ForestPlanet, they help restore forests while creating impactful media content.",
      website: 'https://example.com/full-sail-media',
      logoSrc: 'img/partner-logos/full-sail-media-logo.svg'
    },
    'holistic-spirits': {
      name: 'Holistic Spirits',
      description: "Holistic Spirits produces sustainably crafted beverages that celebrate nature's bounty. Their partnership with ForestPlanet ensures that each product sold supports global reforestation efforts.",
      website: 'https://example.com/holistic-spirits',
      logoSrc: 'img/partner-logos/holistic-spirits-logo.svg'
    },
    'magical-journeys-beyond': {
      name: 'Magical Journeys Beyond',
      description: "Magical Journeys Beyond offers eco-conscious travel experiences. Through their partnership with ForestPlanet, they offset their carbon footprint by contributing to reforestation projects worldwide.",
      website: 'https://example.com/magical-journeys-beyond',
      logoSrc: 'img/partner-logos/magical-journeys-beyond-logo.svg'
    },
    'neighborhood-sun': {
      name: 'Neighborhood Sun',
      description: "Neighborhood Sun promotes renewable energy solutions for communities. Their collaboration with ForestPlanet extends their environmental impact through strategic reforestation initiatives.",
      website: 'https://example.com/neighborhood-sun',
      logoSrc: 'img/partner-logos/neighborhood-sun-logo.svg'
    },
    'ohana': {
      name: 'Ohana',
      description: "Ohana creates eco-friendly products that support family well-being. For every purchase, they contribute to ForestPlanet's mission of planting trees and restoring ecosystems.",
      website: 'https://example.com/ohana',
      logoSrc: 'img/partner-logos/ohana-logo.svg'
    },
    'pepper-medical': {
      name: 'Pepper Medical',
      description: "Pepper Medical combines healthcare innovation with environmental stewardship. Their partnership with ForestPlanet demonstrates their commitment to healing both people and the planet.",
      website: 'https://example.com/pepper-medical',
      logoSrc: 'img/partner-logos/pepper-medical-logo.svg'
    },
    'sign-hero': {
      name: 'Sign Hero',
      description: "Sign Hero produces sustainable signage solutions. Through their collaboration with ForestPlanet, they balance their material use by supporting reforestation across the globe.",
      website: 'https://example.com/sign-hero',
      logoSrc: 'img/partner-logos/sign-hero-logo.svg'
    },
    'sustainable-you': {
      name: 'Sustainable You',
      description: "Sustainable You offers eco-conscious personal care products. Their partnership with ForestPlanet reinforces their mission of promoting individual and planetary wellness.",
      website: 'https://example.com/sustainable-you',
      logoSrc: 'img/partner-logos/sustainable-you-logo.svg'
    },
    'swarmbustin-honey': {
      name: 'Swarmbustin Honey',
      description: "Swarmbustin Honey produces responsibly harvested honey products while supporting bee habitats. Their work with ForestPlanet extends to broader ecosystem conservation through reforestation.",
      website: 'https://example.com/swarmbustin-honey',
      logoSrc: 'img/partner-logos/swarmbustin-honey-logo.svg'
    },
    'vizcaya-swimwear': {
      name: 'Vizcaya Swimwear',
      description: "Vizcaya Swimwear creates sustainable beachwear from recycled materials. Their partnership with ForestPlanet ensures that their environmental impact extends to restoring forests.",
      website: 'https://example.com/vizcaya-swimwear',
      logoSrc: 'img/partner-logos/vizcaya-swimwear-logo.svg'
    },
    'wyld-coffee': {
      name: 'Wyld Coffee',
      description: "Wyld Coffee sources ethically grown beans and promotes sustainable agriculture. Through their collaboration with ForestPlanet, they help restore forests in coffee-growing regions worldwide.",
      website: 'https://example.com/wyld-coffee',
      logoSrc: 'img/partner-logos/wyld-coffee-logo.svg'
    }
  };

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
  
  // Function to extract partner ID from image source
  function getPartnerIdFromImgSrc(imgSrc) {
    const srcParts = imgSrc.split('/');
    const filename = srcParts[srcParts.length - 1];
    return filename.replace('-logo.svg', '');
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
      isAnimating = false;
      return;
    }
    
    // FIRST: Get the position and size of the card
    cardRect = card.getBoundingClientRect();
    
    // Prepare modal content (pre-load images before starting animation)
    adjustModalTitleClass();
    
    // Create and preload the image to avoid content flashing
    const preloadImg = new Image();
    preloadImg.onload = () => {
      continueOpeningModal(card, partner);
    };
    preloadImg.onerror = () => {
      // If image fails to load, continue anyway
      continueOpeningModal(card, partner);
    };
    preloadImg.src = partner.logoSrc;
    
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
    modalLogo.src = partner.logoSrc;
    modalLogo.alt = partner.name + ' logo';
    modalDescription.textContent = partner.description;
    
    // Ensure logo is visible immediately when animation starts
    modalLogo.style.opacity = '1';
    
    // Update visit website link
    const linkText = modalLink.querySelector('.tertiary-romance-2-text');
    if (linkText) {
      linkText.textContent = 'Visit ' + partner.name + ' Website';
    }
    
    // Add click event to the link
    modalLink.onclick = function() {
      window.open(partner.website, '_blank');
    };
    
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
      const img = this.querySelector('img');
      if (!img) return;
      
      // Remove focus from the card after clicking
      this.blur();
      
      const partnerId = getPartnerIdFromImgSrc(img.src);
      openPartnerModal(this, partnerId);
    });
    
    // For accessibility, also handle keyboard navigation
    card.addEventListener('keydown', function(event) {
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        const img = this.querySelector('img');
        if (!img) return;
        
        const partnerId = getPartnerIdFromImgSrc(img.src);
        openPartnerModal(this, partnerId);
      }
    });
  });
  
  // Close modal when clicking the close button
  modalClose.addEventListener('click', function() {
    closeModal();
  });
  
  // Close modal when clicking outside the modal content
  modal.addEventListener('click', function(event) {
    if (event.target === modal) {
      closeModal();
    }
  });
  
  // Close modal when pressing ESC key
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && modal.classList.contains('active')) {
      closeModal();
    }
  });
  
  // Update modal sizing on window resize
  window.addEventListener('resize', function() {
    adjustModalTitleClass();
    
    // If modal is open and we have a selected card, make sure positions stay correct
    if (modal.classList.contains('active') && selectedCard && !isAnimating) {
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