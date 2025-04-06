# ForestPlanet WordPress Theme

## Description

ForestPlanet is a custom WordPress theme designed for the forestplanet.org website. It includes integration with Stripe for handling donations, custom content types for partners and stories, and various theme customizations.

## Requirements

*   WordPress (Latest stable version recommended)
*   PHP >= 7.2
*   Composer

## Installation

1.  **Clone the Repository:**
    ```bash
    git clone https://github.com/Wuvies/ForestPlanet-v0.11.2.git wp-content/themes/ForestPlanet
    ```
    Place the cloned directory within your WordPress installation's `wp-content/themes/` directory.

2.  **Install Dependencies:**
    Navigate to the theme directory in your terminal and run Composer:
    ```bash
    cd wp-content/themes/ForestPlanet
    composer install
    ```
    This will install the required PHP dependencies (like the Stripe PHP library).

3.  **Activate the Theme:**
    Log in to your WordPress admin dashboard, go to `Appearance -> Themes`, find the "ForestPlanet" theme, and click "Activate".

4.  **Configure Stripe:**
    Navigate to the Stripe settings page within the WordPress admin and enter your Stripe API keys (Publishable Key and Secret Key).

## Features

*   **Stripe Donation Integration:** Secure donation processing via Stripe Checkout. Includes pages for donation amount selection, billing information, confirmation, and handling failed payments.
*   **Custom Post Types & Taxonomies:**
    *   `partner`: Manages partner information.
    *   `story`: Manages stories, likely with categories (`story_category`).
*   **Advanced Custom Fields (ACF):** Utilizes ACF (free version) for managing custom fields (configuration loaded from `inc/acf-loader.php` and field groups likely in `inc/acf-fields/`).
*   **Custom Page Templates:** Specific templates for various pages like About, Invite, Partner application, Donation flow, etc.
*   **Theme Customizer Options:** Basic text and image customization options available via the WordPress Customizer (see `inc/theme-customizer.php`).
*   **Custom Menu Walker:** Provides custom navigation menu rendering (see `inc/class-forestplanet-menu-walker.php`).

## Theme Structure

*   **`/` (Root):** Contains standard WordPress template files (`index.php`, `style.css`, `header.php`, `footer.php`, `front-page.php`, `404.php`, etc.), page templates (`page-*.php`), archive templates (`archive-*.php`, `taxonomy-*.php`), and single post templates (`single-*.php`).
*   **`functions.php`:** Main theme functions file
*   **`inc/`:** Contains modular PHP code, including:
    *   `acf-loader.php`: Loads Advanced Custom Fields configurations.
    *   `acf-fields/`: Contains ACF JSON or PHP field group definitions.
    *   `donations-admin.php`: Admin-side functionality related to donations.
    *   `stripe-api.php`: Handles interactions with the Stripe API.
    *   `stripe-settings.php`: Manages Stripe settings within the WordPress admin.
    *   `theme-customizer.php`: Adds options to the WordPress Customizer.
    *   `class-forestplanet-menu-walker.php`: Custom menu walker class.
    *   *Note:* This directory uses PSR-4 autoloading for the `ForestPlanet` namespace.
*   **`template-parts/`:** Contains reusable template fragments used in main template files (e.g., content loops, headers).
*   **`assets/`:** Contains static assets like CSS, JavaScript, and images.
*   **`vendor/`:** Contains PHP dependencies managed by Composer (e.g., Stripe SDK). This directory is typically not committed to version control if `composer.lock` is present.

## Dependencies

*   **PHP:**
    *   `stripe/stripe-php`: Required for Stripe integration (managed via Composer).
*   **WordPress Plugins (Assumed):**
    *   **Advanced Custom Fields (ACF):** Required for custom field management. Ensure this plugin is installed and active.
    *   **Contact Form 7 (CF7):** Required for contact form functionality. Ensure this plugin is installed and active.
    *   **MailChimp for WordPress:** Required for newsletter and email marketing integration. Ensure this plugin is installed and active.
    *   **SVG Support:** Required for SVG file uploads and display. Ensure this plugin is installed and active.

## License

GPL-2.0-or-later
