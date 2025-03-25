<?php
/**
 * Custom menu walker for ForestPlanet theme
 * 
 * Handles menu items to match the design structure from the HTML files
 */

// Make sure Walker_Nav_Menu class exists
if (!class_exists('Walker_Nav_Menu')) {
    require_once ABSPATH . 'wp-includes/class-walker-nav-menu.php';
}

class ForestPlanet_Menu_Walker extends Walker_Nav_Menu {
    /**
     * Start the element output.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param WP_Post $item Menu item data object.
     * @param int $depth Depth of menu item.
     * @param stdClass $args An object of wp_nav_menu() arguments.
     * @param int $id Current item ID.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
        // Determine tertiary button style based on header_style
        $tertiary_style = 'mirage'; // Default for romance pages
        
        // Check if header_style is available in args
        if (isset($args->header_style) && ($args->header_style === 'mirage' || $args->header_style === 'fuchsia-blue')) {
            $tertiary_style = 'romance';
        }
        
        // Build menu item HTML for the link
        $output .= '<a href="' . esc_url($item->url) . '">';
        $output .= '<div class="tertiary-button">';
        $output .= '<div class="tertiary-' . $tertiary_style . ' body-2-regular">' . esc_html($item->title) . '</div>';
        $output .= '</div>';
        $output .= '</a>';
    }

    /**
     * Ends the element output.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param WP_Post $item Menu item data object.
     * @param int $depth Depth of menu item.
     * @param stdClass $args An object of wp_nav_menu() arguments.
     */
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        // No closing tags needed in this implementation
    }
    
    /**
     * Start the list wrapper
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        // We don't need list wrappers as we're using custom HTML structure
    }

    /**
     * End the list wrapper
     */
    public function end_lvl(&$output, $depth = 0, $args = null) {
        // We don't need list wrappers as we're using custom HTML structure
    }
} 
?> 