/**
 * Creates a loader element to be used for loading animations
 * @returns {HTMLElement} The loader container element
 */
function createLoader() {
  // Create the loader container
  const loaderContainer = document.createElement('div');
  loaderContainer.className = 'loader-container';
  
  // Create the SVG loader
  const svgNS = "http://www.w3.org/2000/svg";
  const svg = document.createElementNS(svgNS, "svg");
  svg.setAttribute("class", "loader");
  svg.setAttribute("viewBox", "0 0 384 384");
  svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
  
  // Create active circle
  const activeCircle = document.createElementNS(svgNS, "circle");
  activeCircle.setAttribute("class", "active");
  activeCircle.setAttribute("pathLength", "360");
  activeCircle.setAttribute("fill", "transparent");
  activeCircle.setAttribute("stroke-width", "32");
  activeCircle.setAttribute("cx", "192");
  activeCircle.setAttribute("cy", "192");
  activeCircle.setAttribute("r", "176");
  
  // Create track circle
  const trackCircle = document.createElementNS(svgNS, "circle");
  trackCircle.setAttribute("class", "track");
  trackCircle.setAttribute("pathLength", "360");
  trackCircle.setAttribute("fill", "transparent");
  trackCircle.setAttribute("stroke-width", "32");
  trackCircle.setAttribute("cx", "192");
  trackCircle.setAttribute("cy", "192");
  trackCircle.setAttribute("r", "176");
  
  // Append circles to SVG
  svg.appendChild(activeCircle);
  svg.appendChild(trackCircle);
  
  // Append SVG to container
  loaderContainer.appendChild(svg);
  
  return loaderContainer;
}

/**
 * Shows the loader by adding it to the DOM and setting it to visible
 * @param {HTMLElement} container - The container to append the loader to
 * @returns {HTMLElement} The created loader element
 */
function showLoader(container) {
  // Create loader if it doesn't exist
  let loader = document.querySelector('.loader-container');
  if (!loader) {
    loader = createLoader();
    container.appendChild(loader);
  }
  
  // Make loader visible after a short delay to ensure CSS transition works
  setTimeout(() => {
    loader.classList.add('visible');
  }, 10);
  
  return loader;
}

/**
 * Hides the loader by removing the visible class
 * @param {HTMLElement} loader - The loader element to hide
 */
function hideLoader(loader) {
  if (!loader) return;
  
  // Remove visible class to trigger fade out transition
  loader.classList.remove('visible');
} 