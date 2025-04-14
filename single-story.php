<?php
/**
 * The template for displaying single story posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ForestPlanet
 */

get_header();

// Set a variable to track if we're viewing a single story
$is_single_story = true;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('fp-story'); ?>>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <div class="fp-story-hero" <?php if (has_post_thumbnail()) : ?>style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>');"<?php endif; ?>>
        <div class="fp-story-hero-content">
            <div class="fp-story-meta">
                <div class="fp-story-date subtitle-2"><?php echo get_the_date('M d Y'); ?></div>
                <?php
                // Display story categories
                $categories = get_the_terms(get_the_ID(), 'story_category');
                if ($categories && !is_wp_error($categories)) {
                    echo '<div class="fp-story-categories">';
                    foreach ($categories as $category) {
                        echo '<a href="' . esc_url(get_term_link($category)) . '" class="fp-story-category">' . esc_html($category->name) . '</a>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
            
            <h1 class="fp-story-title heading-2"><?php the_title(); ?></h1>
            
            <?php if (has_excerpt()) : ?>
                <div class="fp-story-subtitle body-2-regular"><?php echo wp_kses_post(get_the_excerpt()); ?></div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="fp-story-content">
        <div class="fp-story-text body-1-regular">
            <?php 
            // Get the content
            $content = get_the_content();
            
            // Process shortcodes and blocks
            $content = apply_filters('the_content', $content);
            
            // Look for image tags in the content
            $pattern = '/<figure.*?>(.*?)<\/figure>/is';
            
            // Split the content by image tags
            $parts = preg_split($pattern, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
            
            // Output the content with proper image containers
            foreach ($parts as $index => $part) {
                if ($index % 2 === 0) {
                    // This is text content
                    echo $part;
                } else {
                    // This is an image - wrap it in story-image-container
                    // Add story-image class to img tags
                    $image_part = preg_replace('/<img(.*?)class="(.*?)"(.*?)>/is', '<img$1class="$2 story-image"$3>', $part);
                    // If there was no class attribute, add one
                    $image_part = preg_replace('/<img(.*?)(?!class=)(.*?)>/is', '<img$1 class="story-image"$2>', $image_part);
                    
                    echo '<div class="story-image-container">' . $image_part . '</div>';
                }
            }
            ?>
        </div>
        
        <?php
        // If using ACF fields for additional content
        if (function_exists('get_field') && get_field('additional_content')) {
            echo '<div class="fp-story-text body-1-regular">';
            the_field('additional_content');
            echo '</div>';
        }
        ?>
    </div>
    
    <div class="story-footer">
        <div class="story-share">
            <button id="shareStoryButton" class="secondary-button secondary-button-salem">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/share.svg'); ?>" alt="Share" />
                <span class="secondary-button-salem-text body-2-regular">Share this story</span>
            </button>
            
            <!-- Share modal fallback (hidden by default) -->
            <div id="shareModal" class="share-modal">
                <div class="share-modal-content">
                    <div class="share-modal-header">
                        <h3 class="body-1-semibold">Share this story</h3>
                        <button class="share-modal-close">&times;</button>
                    </div>
                    <div class="share-modal-body">
                        <p>Copy this link to share:</p>
                        <div class="share-link-container">
                            <input type="text" id="shareLink" value="<?php echo esc_url(get_permalink()); ?>" readonly>
                            <button id="copyLinkButton" class="copy-link-button">Copy</button>
                        </div>
                        <div class="share-copy-message" id="copyMessage">Link copied!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php endwhile; endif; ?>
</article>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the share button and modal elements
    const shareButton = document.getElementById('shareStoryButton');
    const shareModal = document.getElementById('shareModal');
    const closeButton = document.querySelector('.share-modal-close');
    const copyButton = document.getElementById('copyLinkButton');
    const linkInput = document.getElementById('shareLink');
    const copyMessage = document.getElementById('copyMessage');
    
    // Function to show the modal
    function showModal() {
        shareModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    // Function to hide the modal
    function hideModal() {
        shareModal.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    // Handle share button click
    shareButton.addEventListener('click', function() {
        // Check if Web Share API is supported
        if (navigator.share) {
            navigator.share({
                title: '<?php echo esc_js(get_the_title()); ?>',
                url: '<?php echo esc_js(get_permalink()); ?>'
            })
            .catch(error => {
                console.log('Error sharing:', error);
                // Fallback if share fails
                showModal();
            });
        } else {
            // Fallback for browsers that don't support the Web Share API
            showModal();
        }
    });
    
    // Close modal when clicking the close button
    closeButton.addEventListener('click', hideModal);
    
    // Close modal when clicking outside the modal content
    shareModal.addEventListener('click', function(e) {
        if (e.target === shareModal) {
            hideModal();
        }
    });
    
    // Copy link functionality
    copyButton.addEventListener('click', function() {
        linkInput.select();
        document.execCommand('copy');
        
        // Show success message
        copyMessage.style.opacity = '1';
        
        // Hide message after 2 seconds
        setTimeout(function() {
            copyMessage.style.opacity = '0';
        }, 2000);
    });
    
    // Close with escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && shareModal.classList.contains('active')) {
            hideModal();
        }
    });
});
</script>

<?php get_footer(); ?> 