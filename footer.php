<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the content-area div and all content after.
 * The footer styling matches the header style used for the page.
 *
 * @package ForestPlanet
 */

// Get the current header style to match footer styling
$footer_style = 'romance'; // Default style

// Check if header_style was set in header.php
global $header_style;
if (isset($header_style) && !empty($header_style)) {
    $footer_style = $header_style;
}

// Logic for determining if we need dark text or light text
$dark_style = in_array($footer_style, ['mirage', 'fuchsia-blue']);

$bg_color = 'var(--romance)'; // Default
if ($footer_style === 'mirage') {
    $bg_color = 'var(--mirage)';
} elseif ($footer_style === 'fuchsia-blue') {
    $bg_color = 'var(--fuchsia-blue)';
}
?>

</div><!-- #content -->

<!-- Desktop Footer -->
<footer id="site-footer" class="footer footer-<?php echo esc_attr($footer_style); ?>" style="position: relative; z-index: 2; background-color: <?php echo $bg_color; ?>; width: 100%; overflow: visible;">
    <div class="full-footer-frame footer-display">
        <div class="top-footer-frame footer-display">
            <img class="logo-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logos/FP-Logomark-RGB-<?php echo $dark_style ? 'White' : 'Black'; ?>.svg" alt="<?php bloginfo('name'); ?> logo" />
            <div class="location">
                <p class="address<?php echo $dark_style ? '-romance' : ''; ?> body-2-regular">
                    <?php 
                    // Get address from theme settings or ACF field if available
                    $address = get_theme_mod('forestplanet_address', '5028 Wisconsin Avenue NW Suite 100<br />Washington, DC 20016');
                    echo wp_kses_post($address);
                    ?>
                </p>
            </div>
            <div class="social-media-icons">
                <?php
                // Social media links - can be managed through custom menu, ACF, or theme options
                $social_icons = [
                    'facebook' => ['url' => get_theme_mod('forestplanet_facebook', '#'), 'icon' => 'facebook.svg'],
                    'linkedin' => ['url' => get_theme_mod('forestplanet_linkedin', '#'), 'icon' => 'linkedin.svg'],
                    'instagram' => ['url' => get_theme_mod('forestplanet_instagram', '#'), 'icon' => 'instagram.svg'],
                    'youtube' => ['url' => get_theme_mod('forestplanet_youtube', '#'), 'icon' => 'youtube.svg'],
                ];
                
                foreach ($social_icons as $network => $data) :
                    if (!empty($data['url']) && $data['url'] !== '#') :
                ?>
                    <a href="<?php echo esc_url($data['url']); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr(ucfirst($network)); ?>">
                        <img class="<?php echo esc_attr($network . ($dark_style ? '-romance' : '')); ?>" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $data['icon']); ?>" alt="<?php echo esc_attr(ucfirst($network)); ?>" />
                    </a>
                <?php
                    else :
                ?>
                    <img class="<?php echo esc_attr($network . ($dark_style ? '-romance' : '')); ?>" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $data['icon']); ?>" alt="<?php echo esc_attr(ucfirst($network)); ?>" />
                <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
        
        <div class="footer-links">
            <div class="link-frame">
                <div class="t-in<?php echo $dark_style ? '-romance' : ''; ?> subtitle-2">NON-PROFIT INFORMATION</div>
                <div class="footer-non-profit-awards footer-display">
                    <img class="image-8" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image-8@2x.png" alt="Non-profit certification" />
                    <div class="footer-charity-nav-logo footer-display">
                        <div class="footer-charity-nav-logo-img footer-display">
                            <img class="charity-nav_-logo_-ver-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/charitynav-logo-ver-1.png" alt="CharityNav Logo" />
                        </div>
                    </div>
                </div>
                <a href="<?php echo esc_url(get_theme_mod('forestplanet_990_form', '#')); ?>" class="tertiary-<?php echo $dark_style ? 'romance-2' : 'mirage-2'; ?> tertiary-button">
                    <div class="tertiary-<?php echo $dark_style ? 'romance-2' : 'mirage-2'; ?>-text body-2-regular">IRS 990 Form</div>
                </a>
                <a href="<?php echo esc_url(get_theme_mod('forestplanet_determination_letter', '#')); ?>" class="tertiary-<?php echo $dark_style ? 'romance-2' : 'mirage-2'; ?> tertiary-button">
                    <div class="tertiary-<?php echo $dark_style ? 'romance-2' : 'mirage-2'; ?>-text body-2-regular">IRS Determination Letter</div>
                </a>
            </div>
            
            <div class="link-frame">
                <div class="t-in<?php echo $dark_style ? '-romance' : ''; ?> subtitle-2">CONTACT INFORMATION</div>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="tertiary-<?php echo $dark_style ? 'romance-2' : 'mirage-2'; ?> tertiary-button">
                    <div class="tertiary-<?php echo $dark_style ? 'romance-2' : 'mirage-2'; ?>-text body-2-regular">Contact Us</div>
                </a>
                <div class="tertiary-<?php echo $dark_style ? 'romance-2' : 'mirage-2'; ?>-text body-2-regular">
                    <?php echo esc_html(get_theme_mod('forestplanet_ein', 'EIN: 81-5025238')); ?>
                </div>
                <div class="tertiary-<?php echo $dark_style ? 'romance-2' : 'mirage-2'; ?>-text body-2-regular">
                    <?php echo esc_html(get_theme_mod('forestplanet_phone', '+1-202-792-8060')); ?>
                </div>
            </div>
            
            <div class="link-frame">
                <div class="t-in<?php echo $dark_style ? '-romance' : ''; ?> subtitle-2">GET INVOLVED</div>
                <?php
                // You can use wp_nav_menu() here if you prefer to manage these links in WP admin
                $get_involved_links = [
                    'Donate' => home_url('/donate'),
                    'Partner' => home_url('/partner'),
                    'Invite' => home_url('/invite'),
                    'Connect' => home_url('/connect'),
                ];
                
                foreach ($get_involved_links as $label => $url) :
                ?>
                <a href="<?php echo esc_url($url); ?>" class="tertiary-<?php echo $dark_style ? 'romance-2' : 'mirage-2'; ?> tertiary-button">
                    <div class="tertiary-<?php echo $dark_style ? 'romance-2' : 'mirage-2'; ?>-text body-2-regular"><?php echo esc_html($label); ?></div>
                </a>
                <?php endforeach; ?>
            </div>
            
            <div class="link-frame">
                <div class="t-in<?php echo $dark_style ? '-romance' : ''; ?> subtitle-2">RESOURCES</div>
                <?php
                // You can use wp_nav_menu() here if you prefer to manage these links in WP admin
                $resources_links = [
                    'Stories' => home_url('/stories'),
                    'Shop' => home_url('/shop'),
                    'About Us' => home_url('/about'),
                ];
                
                foreach ($resources_links as $label => $url) :
                ?>
                <a href="<?php echo esc_url($url); ?>" class="tertiary-<?php echo $dark_style ? 'romance-2' : 'mirage-2'; ?> tertiary-button">
                    <div class="tertiary-<?php echo $dark_style ? 'romance-2' : 'mirage-2'; ?>-text body-2-regular"><?php echo esc_html($label); ?></div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="newsletter">
            <div class="join-our-newsletter heading-3">Join Our Newsletter</div>
            <div class="newsletter-input-frame footer-display">
                <form name="newsletter-signup" action="<?php echo esc_url(home_url('/newsletter-confirmation')); ?>" method="post">
                    <div class="input">
                        <div class="content-wrapper">
                            <div class="wrapper">
                                <div class="content-wrapper-1">
                                    <input
                                        class="content"
                                        name="email"
                                        placeholder="Your Email Address"
                                        type="email"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="secondary-button-fuchsia-blue secondary-button">
                        <div class="secondary-button-fuchsia-blue-text body-2-regular">Subscribe</div>
                    </button>
                </form>
            </div>
        </div>
        
        <p class="forest-planet-2025<?php echo $dark_style ? '-romance' : ''; ?> body-2-regular">
            © ForestPlanet <?php echo date('Y'); ?>. All rights reserved.
        </p>
    </div>
</footer>

<!-- Mobile Footer appears only on mobile devices via CSS media queries -->

<?php wp_footer(); ?>

</body>
</html> 