// Initialize the last scroll position
let lastScrollTop = 0;
const header = document.querySelector('.property-mobile');
let ticking = false;

window.addEventListener('scroll', function() {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  if (!ticking) {
    window.requestAnimationFrame(function() {
      if (scrollTop > lastScrollTop && scrollTop > 100) {
        // Only add the 'hidden' class if it isn't already applied
        if (!header.classList.contains('hidden')) {
          header.classList.add('hidden');
        }
      } else {
        if (header.classList.contains('hidden')) {
          header.classList.remove('hidden');
        }
      }
      
      // Update lastScrollTop for next scroll event, preventing negative values
      lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
      ticking = false;
    });
    ticking = true;
  }
}); 