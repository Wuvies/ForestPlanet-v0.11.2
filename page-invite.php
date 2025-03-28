<?php
/**
 * Template Name: Invite Us
 * 
 * The template for displaying the "Invite Us" page
 *
 * @package ForestPlanet
 */

get_header();

// Handle form submission if needed
$form_submitted = false;
if (isset($_POST['submit_invite'])) {
    // Process form submission here
    // You would typically use wp_mail() or a form plugin
    
    // For demonstration, we'll just set a flag to show confirmation
    $form_submitted = true;
    
    // Redirect to prevent form resubmission
    wp_redirect(add_query_arg('submitted', '1', get_permalink()));
    exit;
}

// Check if form was just submitted (for showing confirmation message)
$show_confirmation = isset($_GET['submitted']) && $_GET['submitted'] == '1';
?>

<div class="invite-us-desktop-all-breakpoints screen">
    <div class="main-content-1">
        <div class="invite-us-form-1">
            <div class="frame-374">
                <h1 class="title-1 heading-2"><?php echo esc_html(get_the_title()); ?></h1>
                
                <?php if ($show_confirmation) : ?>
                    <div class="confirmation-message">
                        <p>Thank you for your inquiry. We'll get back to you shortly.</p>
                    </div>
                <?php else : ?>
                
                <div class="frame-197-1">
                    <form class="frame-1-1 frame-1" method="post" action="">
                        <div class="input-field">
                            <div class="label-wrapper-1">
                                <div class="label inter-normal-romance-16px">Name</div>
                                <div class="required-wrapper-1">
                                    <div class="text-1 text-small">*</div>
                                </div>
                            </div>
                            <div class="input">
                                <div class="content-wrapper-romance">
                                    <div class="wrapper">
                                        <div class="content-wrapper-1">
                                            <input class="content-romance" name="name" placeholder="First and Last" type="text" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-field">
                            <div class="label-wrapper-1">
                                <div class="label inter-normal-romance-16px">Email</div>
                                <div class="required-wrapper-1">
                                    <div class="text-1 text-small">*</div>
                                </div>
                            </div>
                            <div class="input">
                                <div class="content-wrapper-romance">
                                    <div class="wrapper">
                                        <div class="content-wrapper-1">
                                            <input class="content-romance" name="email" placeholder="Enter your email" type="email" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="select-1">
                            <div class="label-wrapper-1">
                                <div class="label inter-normal-romance-16px">Where Are We Speaking?</div>
                                <div class="required-wrapper-1"><div class="text-1 text-small">*</div></div>
                            </div>
                            <div class="input-field">
                                <div class="content-wrapper-romance">
                                    <div class="wrapper custom-select-wrapper">
                                        <select class="content-romance" name="speaking_location" required>
                                            <option value="Local DMV Area">Local DMV Area</option>
                                            <option value="Online">Online</option>
                                        </select>
                                        <img class="arrow-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/down-arrow.svg" alt="arrow" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-field">
                            <div class="label-wrapper-1">
                                <div class="details-1 inter-normal-romance-16px">Details</div>
                                <div class="required-wrapper-1"><div class="text-1 text-small">*</div></div>
                            </div>
                            <div class="input">
                                <div class="content-wrapper-romance textarea-wrapper">
                                    <div class="wrapper">
                                        <div class="content-wrapper-1">
                                            <textarea
                                                class="content-romance"
                                                name="details"
                                                placeholder="Type your message"
                                                required
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="frame-19-2">
                            <label class="radio-label">
                                <input type="checkbox" class="radio-input" name="receive_updates" value="yes">
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/radio-button-romance-false.svg" alt="Unchecked" class="radio-icon radio-false">
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/radio-button-romance-true.svg" alt="Checked" class="radio-icon radio-true hidden">
                                <p class="i-want-to-receive-up-1 body-2-regular">I want to receive updates from ForestPlanet.</p>
                            </label>
                        </div>
                        
                        <button type="submit" name="submit_invite" class="primary-button-romance primary-button-2">
                            <div class="primary-button-fuchsia-blue-text body-2-regular">Send Inquiry</div>
                        </button>
                    </form>
                </div>
                
                <?php endif; ?>
            </div>
        </div>
        
        <div class="stories-podcasts-1">
            <div class="frame">
                <div class="where-weve-spoken-1 heading-2">Where We've Spoken</div>
                <div class="frame-1-2 frame-1">
                    <div class="frame-184">
                        <?php
                        // Query for speaking events (you might want to create a custom post type for events)
                        $args = array(
                            'post_type' => 'post', // Or 'event' if you have a custom post type
                            'posts_per_page' => 6,
                            'category_name' => 'speaking-events', // Adjust as needed
                        );
                        
                        $events_query = new WP_Query($args);
                        
                        if ($events_query->have_posts()) :
                            while ($events_query->have_posts()) : $events_query->the_post();
                                // Get post date
                                $event_date = get_the_date('M d Y');
                                
                                // Get featured image
                                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                                if (!$thumbnail) {
                                    $thumbnail = get_template_directory_uri() . '/img/rectangle-18-2@2x.png';
                                }
                        ?>
                        <article class="story-card">
                            <img class="story-card-image" src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>" />
                            <div class="story-card-content">
                                <div class="story-card-date subtitle-2"><?php echo esc_html($event_date); ?></div>
                                <p class="story-card-title body-1-semibold"><?php the_title(); ?></p>
                                <p class="story-card-description body-2-regular">
                                    <?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?>
                                </p>
                            </div>
                        </article>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            // If no posts, show sample cards
                            for ($i = 0; $i < 6; $i++) :
                        ?>
                        <article class="story-card">
                            <img class="story-card-image" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/rectangle-18-2@2x.png" alt="Rectangle 18" />
                            <div class="story-card-content">
                                <div class="story-card-date subtitle-2">FEB 16 2025</div>
                                <p class="story-card-title body-1-semibold">Title For Story Card Template</p>
                                <p class="story-card-description body-2-regular">
                                    Here would contain a brief introduction to the article like the first
                                </p>
                            </div>
                        </article>
                        <?php
                            endfor;
                        endif;
                        ?>
                    </div>
                    <div class="tertiary-button"><div class="default-14 default body-2-regular">Load More</div></div>
                </div>
            </div>
            
            <div class="frame">
                <div class="frame"><div class="podcasts-1 heading-2">Podcasts</div></div>
                <div class="frame-1-2 frame-1">
                    <div class="podcast-cards">
                        <?php
                        // Query for podcasts using the custom post type
                        $args = array(
                            'post_type' => 'podcast',
                            'posts_per_page' => 7,
                            'orderby' => 'date',
                            'order' => 'DESC',
                        );
                        
                        $podcasts_query = new WP_Query($args);
                        
                        if ($podcasts_query->have_posts()) :
                            while ($podcasts_query->have_posts()) : $podcasts_query->the_post();
                                // Use helper function to display podcast card
                                forestplanet_display_podcast_card(get_the_ID(), 'desktop');
                            endwhile;
                            wp_reset_postdata();
                        else :
                            // If no posts, show sample podcast entries
                            for ($i = 0; $i < 7; $i++) :
                        ?>
                        <article class="frame-183-item">
                            <div class="line-romance"></div>
                            <div class="frame-117">
                                <div class="frame-116-1">
                                    <img class="rectangle-19-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/rectangle-19-1@2x.png" alt="Rectangle 19" />
                                    <div class="frame-115">
                                        <div class="frame-112-4">
                                            <div class="frame-111">
                                                <div class="feb-16-2025-3 feb-16-2025 subtitle-2">FEB 16 2025</div>
                                                <p class="example-s2-e3-podcas-1 body-1-semibold">
                                                    Example S2E3: Podcast Title that involves Hank
                                                </p>
                                            </div>
                                            <div class="podcast-name-1 body-2-regular">Podcast name</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="secondary-button-romance secondary-button">
                                    <div class="secondary-button-romance-text body-2-regular">Listen</div>
                                    <img class="link-external" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/link-external.svg" alt="Link External" />
                                </div>
                            </div>
                        </article>
                        <?php
                            endfor;
                        endif;
                        ?>
                    </div>
                    <div class="tertiary-button"><div class="default-15 default body-2-regular">Load More</div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile version for responsive design -->
<div class="invite-us-mobile screen">
    <div class="main-content">
        <div class="invite-us-form">
            <h1 class="title heading-2-mobile"><?php echo esc_html(get_the_title()); ?></h1>
            
            <?php if ($show_confirmation) : ?>
                <div class="confirmation-message">
                    <p>Thank you for your inquiry. We'll get back to you shortly.</p>
                </div>
            <?php else : ?>
            
            <div class="frame-197">
                <form class="frame-1" method="post" action="">
                    <div class="input-field">
                        <div class="label-wrapper">
                            <div class="label inter-normal-romance-16px">Name</div>
                            <div class="required-wrapper">
                                <div class="text-1 text-small">*</div>
                            </div>
                        </div>
                        <div class="input">
                            <div class="content-wrapper-romance">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input class="content-romance" name="name" placeholder="First and Last" type="text" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-field">
                        <div class="label-wrapper">
                            <div class="label inter-normal-romance-16px">Email</div>
                            <div class="required-wrapper">
                                <div class="text-1 text-small">*</div>
                            </div>
                        </div>
                        <div class="input">
                            <div class="content-wrapper-romance">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <input class="content-romance" name="email" placeholder="Enter your email" type="email" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="select-1">
                        <div class="label-wrapper">
                            <div class="label inter-normal-romance-16px">Where Are We Speaking?</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="input-field">
                            <div class="content-wrapper-romance">
                                <div class="wrapper custom-select-wrapper">
                                    <select class="content-romance" name="speaking_location" required>
                                        <option value="Local DMV Area">Local DMV Area</option>
                                        <option value="Online">Online</option>
                                    </select>
                                    <img class="arrow-1" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/down-arrow.svg" alt="arrow" />
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-field">
                        <div class="label-wrapper">
                            <div class="details-1 inter-normal-romance-16px">Details</div>
                            <div class="required-wrapper"><div class="text-1 text-small">*</div></div>
                        </div>
                        <div class="input">
                            <div class="content-wrapper-romance textarea-wrapper">
                                <div class="wrapper">
                                    <div class="content-wrapper-1">
                                        <textarea
                                            class="content-romance"
                                            name="details"
                                            placeholder="Type your message"
                                            required
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="frame-19-1">
                        <label class="radio-label">
                            <input type="checkbox" class="radio-input" name="receive_updates" value="yes">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/radio-button-romance-false.svg" alt="Unchecked" class="radio-icon radio-false">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/radio-button-romance-true.svg" alt="Checked" class="radio-icon radio-true hidden">
                            <p class="i-want-to-receive-up body-2-regular">I want to receive updates from ForestPlanet.</p>
                        </label>
                    </div>
                    
                    <button type="submit" name="submit_invite" class="primary-button-romance primary-button-2">
                        <div class="primary-button-fuchsia-blue-text body-2-regular">Send Inquiry</div>
                    </button>
                </form>
            </div>
            
            <?php endif; ?>
        </div>
        
        <div class="stories-podcasts">
            <div class="frame-20">
                <div class="where-weve-spoken heading-2-mobile">Where We've Spoken</div>
                <div class="frame-1">
                    <div class="story-cards">
                        <?php
                        // Reset the query to use the same one from earlier
                        if ($events_query->have_posts()) :
                            $events_query->rewind_posts();
                            while ($events_query->have_posts()) : $events_query->the_post();
                                // Get post date
                                $event_date = get_the_date('M d Y');
                                
                                // Get featured image
                                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                                if (!$thumbnail) {
                                    $thumbnail = get_template_directory_uri() . '/img/rectangle-18-1@2x.png';
                                }
                        ?>
                        <article class="story-card">
                            <img class="rectangle-18" src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>" />
                            <div class="story-card-content">
                                <div class="story-card-date subtitle-2"><?php echo esc_html($event_date); ?></div>
                                <p class="story-card-title body-1-semibold"><?php the_title(); ?></p>
                                <p class="story-card-description body-2-regular">
                                    <?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?>
                                </p>
                            </div>
                        </article>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            // If no posts, show sample cards
                            for ($i = 0; $i < 4; $i++) :
                        ?>
                        <article class="story-card">
                            <img class="rectangle-18" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/rectangle-18-1@2x.png" alt="Rectangle 18" />
                            <div class="story-card-content">
                                <div class="story-card-date subtitle-2">FEB 16 2025</div>
                                <p class="story-card-title body-1-semibold">Title For Story Card Template</p>
                                <p class="story-card-description body-2-regular">
                                    Here would contain a brief introduction to the article like the first
                                </p>
                            </div>
                        </article>
                        <?php
                            endfor;
                        endif;
                        ?>
                    </div>
                    <div class="tertiary-button"><div class="default-13 body-2-regular">Load More</div></div>
                </div>
            </div>
            
            <div class="frame-20">
                <div class="podcasts heading-2-mobile">Podcasts</div>
                <div class="frame-1">
                    <div class="podcast-cards">
                        <?php
                        // Reset the query to use the same one from earlier
                        if ($podcasts_query->have_posts()) :
                            $podcasts_query->rewind_posts();
                            while ($podcasts_query->have_posts()) : $podcasts_query->the_post();
                                // Use helper function to display podcast card
                                forestplanet_display_podcast_card(get_the_ID(), 'mobile');
                            endwhile;
                            wp_reset_postdata();
                        else :
                            // If no posts, show sample podcast entries
                            for ($i = 0; $i < 4; $i++) :
                        ?>
                        <article class="podcast-card">
                            <div class="line-romance"></div>
                            <div class="frame-116">
                                <img class="rectangle-19" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/rectangle-19@2x.png" alt="Rectangle 19" />
                                <div class="frame-291">
                                    <div class="frame-112">
                                        <div class="feb-16-2025-1 subtitle-2">FEB 16 2025</div>
                                        <p class="example-s2-e3-podcas body-1-semibold">
                                            Example S2E3: Podcast Title that involves Hank
                                        </p>
                                        <div class="podcast-name body-2-regular">Podcast name</div>
                                    </div>
                                    <div class="secondary-button-romance secondary-button">
                                        <div class="secondary-button-romance-text body-2-regular">Listen</div>
                                        <img class="link-external" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/link-external.svg" alt="Link External" />
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php
                            endfor;
                        endif;
                        ?>
                    </div>
                    <div class="tertiary-button"><div class="default-13 body-2-regular">Load More</div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
/* Load More functionality for Story Cards and Podcast Cards */
document.addEventListener('DOMContentLoaded', function() {
    // Desktop Story Cards Load More Functionality
    var currentVisibleRows = 1;
    function updateInviteStoryCardsLayout() {
        // Select the desktop story cards container
        var container = document.querySelector('.invite-us-desktop-all-breakpoints .frame-184');
        if (!container) return;
        
        // Get one card element
        var card = container.querySelector('.story-card');
        if (!card) return;
        
        var cardWidth = card.clientWidth;
        var containerWidth = container.clientWidth;
        // Calculate threshold: 3 cards + one 30px gap
        var threshold = cardWidth * 3 + 30;
        // Determine number of columns based on container width
        var columns = containerWidth < threshold ? 2 : 3;
        
        // Calculate how many cards to display (columns * number of visible rows)
        var visibleCount = columns * currentVisibleRows;
        
        // Iterate over all story cards and set display accordingly
        var cards = container.querySelectorAll('.story-card');
        cards.forEach(function(item, index) {
            item.style.display = index < visibleCount ? "flex" : "none";
        });
        
        // Center the cards inside the container
        container.style.justifyContent = "center";

        // Update the load more button text based on the current visible cards
        var loadMoreButton = container.parentElement.querySelector('.tertiary-button');
        if (loadMoreButton) {
            if (visibleCount >= cards.length) {
                loadMoreButton.querySelector('div').innerText = "Show Less";
            } else {
                loadMoreButton.querySelector('div').innerText = "Load More";
            }
        }
    }
    
    // Run on page load and window resize
    window.addEventListener("load", updateInviteStoryCardsLayout);
    window.addEventListener("resize", updateInviteStoryCardsLayout);
    
    // Add load more functionality for the story cards
    var desktopStoryLoadMoreButton = document.querySelector('.invite-us-desktop-all-breakpoints .frame-184')?.parentElement.querySelector('.tertiary-button');
    if (desktopStoryLoadMoreButton) {
        desktopStoryLoadMoreButton.addEventListener("click", function() {
            // Determine the current state based on button text
            if (desktopStoryLoadMoreButton.querySelector('div').innerText.trim() === "Load More") {
                // Increase the number of visible rows by 2
                currentVisibleRows += 2;
            } else {
                // If the button is showing "Show Less", collapse to the initial state (1 row)
                currentVisibleRows = 1;
            }
            updateInviteStoryCardsLayout();
        });
    }

    // Desktop Podcast Cards Load More Functionality
    var initialVisiblePodcasts = 4;
    var currentVisiblePodcasts = initialVisiblePodcasts;
    
    function updateInvitePodcastCards() {
        // Select the desktop podcast cards container
        var container = document.querySelector('.invite-us-desktop-all-breakpoints .frame-183');
        if (!container) return;
        
        // Get all podcast cards
        var cards = container.querySelectorAll('.frame-183-item');
        cards.forEach(function(card, index) {
            card.style.display = index < currentVisiblePodcasts ? "flex" : "none";
        });
        
        // Update the button text based on the visible count
        var button = container.parentElement.querySelector('.tertiary-button');
        if (button) {
            if (currentVisiblePodcasts >= cards.length) {
                button.querySelector('div').innerText = "Show Less";
            } else {
                button.querySelector('div').innerText = "Load More";
            }
        }
    }
    
    // Run the podcast layout update on load and resize
    window.addEventListener("load", updateInvitePodcastCards);
    window.addEventListener("resize", updateInvitePodcastCards);
    
    // Attach click handler for Load More/Show Less functionality for podcasts
    var podcastLoadButton = document.querySelector('.invite-us-desktop-all-breakpoints .frame-183')?.parentElement.querySelector('.tertiary-button');
    if (podcastLoadButton) {
        podcastLoadButton.addEventListener("click", function() {
            if (podcastLoadButton.querySelector('div').innerText.trim() === "Load More") {
                // Increase the visible podcast cards by 4
                currentVisiblePodcasts += 4;
            } else {
                // "Show Less": reset visible count to initial 4
                currentVisiblePodcasts = initialVisiblePodcasts;
            }
            updateInvitePodcastCards();
        });
    }

    // Mobile Story Cards Load More Functionality
    var currentMobileVisibleCount = 2;
    function updateMobileInviteStoryCardsLayout() {
        // Select the mobile story cards container
        var container = document.querySelector('.invite-us-mobile .story-cards');
        if (!container) return;
        
        // Get all mobile story cards
        var cards = container.querySelectorAll('.story-card');
        cards.forEach(function(item, index) {
            // Show only the first currentMobileVisibleCount cards; hide the rest
            item.style.display = index < currentMobileVisibleCount ? "flex" : "none";
        });
        
        // Center the mobile cards
        container.style.justifyContent = "center";
        
        // Update the mobile load more button text based on the visible cards
        var mobileLoadMoreButton = container.parentElement.querySelector('.tertiary-button');
        if (mobileLoadMoreButton) {
            if (currentMobileVisibleCount >= cards.length) {
                mobileLoadMoreButton.querySelector('div').innerText = "Show Less";
            } else {
                mobileLoadMoreButton.querySelector('div').innerText = "Load More";
            }
        }
    }
    
    // Run on page load and window resize for mobile story cards
    window.addEventListener("load", updateMobileInviteStoryCardsLayout);
    window.addEventListener("resize", updateMobileInviteStoryCardsLayout);
    
    // Add load more functionality for mobile story cards
    var mobileStoryLoadMoreButton = document.querySelector('.invite-us-mobile .story-cards')?.parentElement.querySelector('.tertiary-button');
    if (mobileStoryLoadMoreButton) {
        mobileStoryLoadMoreButton.addEventListener("click", function() {
            if (mobileStoryLoadMoreButton.querySelector('div').innerText.trim() === "Load More") {
                // Increase visible cards by 2
                currentMobileVisibleCount += 2;
            } else {
                // Collapse back to initial state (2 visible cards)
                currentMobileVisibleCount = 2;
            }
            updateMobileInviteStoryCardsLayout();
        });
    }

    // Mobile Podcast Cards Load More Functionality
    var initialMobileVisiblePodcasts = 2;
    var currentMobileVisiblePodcasts = initialMobileVisiblePodcasts;
    
    function updateMobileInvitePodcastCardsLayout() {
        // Select the mobile podcast cards container
        var container = document.querySelector('.invite-us-mobile .podcast-cards');
        if (!container) return;
        
        // Get all mobile podcast cards
        var cards = container.querySelectorAll('.podcast-card');
        cards.forEach(function(card, index) {
            card.style.display = index < currentMobileVisiblePodcasts ? "flex" : "none";
        });
        
        // Center the cards if needed
        container.style.justifyContent = "center";
        
        // Update the mobile load more button text
        var button = container.parentElement.querySelector('.tertiary-button');
        if (button) {
            if (currentMobileVisiblePodcasts >= cards.length) {
                button.querySelector('div').innerText = "Show Less";
            } else {
                button.querySelector('div').innerText = "Load More";
            }
        }
    }
    
    // Run the layout update on page load and resize
    window.addEventListener("load", updateMobileInvitePodcastCardsLayout);
    window.addEventListener("resize", updateMobileInvitePodcastCardsLayout);
    
    // Attach click handler for Load More/Show Less functionality
    var mobilePodcastButton = document.querySelector('.invite-us-mobile .podcast-cards')?.parentElement.querySelector('.tertiary-button');
    if (mobilePodcastButton) {
        mobilePodcastButton.addEventListener("click", function() {
            if (mobilePodcastButton.querySelector('div').innerText.trim() === "Load More") {
                // Reveal 2 more podcast cards
                currentMobileVisiblePodcasts += 2;
            } else {
                // Reset to initial 2 cards
                currentMobileVisiblePodcasts = initialMobileVisiblePodcasts;
            }
            updateMobileInvitePodcastCardsLayout();
        });
    }

    /* Handling Custom Radio Buttons */
    const radioInputs = document.querySelectorAll('.radio-input');
    
    radioInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Toggle the display of the SVG icons based on checked state
            const falseIcon = this.nextElementSibling;
            const trueIcon = falseIcon.nextElementSibling;
            
            if (this.checked) {
                falseIcon.classList.add('hidden');
                trueIcon.classList.remove('hidden');
            } else {
                falseIcon.classList.remove('hidden');
                trueIcon.classList.add('hidden');
            }
        });
    });
});
</script>

<?php
get_footer(); 