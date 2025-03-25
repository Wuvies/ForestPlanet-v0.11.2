/**
 * Google Maps integration for ForestPlanet theme
 * Displays project locations on an interactive map
 */

function initMap() {
    // Define locations where ForestPlanet has projects
    const locations = [
        { name: "Khenifra, Morocco", lat: 32.9394, lng: -5.6693 },
        { name: "Pangani Basin, Tanzania", lat: -5.4265, lng: 37.9745 },
        { name: "Mozambique Channel, Madagascar", lat: -20.0000, lng: 45.3000 }
    ];

    // Get theme color for markers
    const markerColor = getComputedStyle(document.documentElement).getPropertyValue('--fuchsia-blue').trim();
    
    // Initialize mobile map if element exists
    const mapMobileElement = document.getElementById("map-mobile");
    if (mapMobileElement) {
        const mapMobile = new google.maps.Map(mapMobileElement, {
            center: { lat: 0.0, lng: 20.0 },
            zoom: 2,
            mapId: "7b7c12e6a0a72324"
        });
        
        // Add markers to mobile map
        locations.forEach(location => {
            new google.maps.Marker({
                position: { lat: location.lat, lng: location.lng },
                map: mapMobile,
                title: location.name,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    fillColor: markerColor,
                    fillOpacity: 1,
                    strokeWeight: 0,
                    scale: 8
                }
            });
        });
    }

    // Initialize desktop map if element exists
    const mapDesktopElement = document.getElementById("map-desktop");
    if (mapDesktopElement) {
        const mapDesktop = new google.maps.Map(mapDesktopElement, {
            center: { lat: 0.0, lng: 20.0 },
            zoom: 2,
            mapId: "7b7c12e6a0a72324"
        });
        
        // Add markers to desktop map
        locations.forEach(location => {
            new google.maps.Marker({
                position: { lat: location.lat, lng: location.lng },
                map: mapDesktop,
                title: location.name,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    fillColor: markerColor,
                    fillOpacity: 1,
                    strokeWeight: 0,
                    scale: 8
                }
            });
        });
    }
}

// Export for WordPress
window.ForestPlanet = window.ForestPlanet || {};
window.ForestPlanet.maps = {
    initMap: initMap
}; 