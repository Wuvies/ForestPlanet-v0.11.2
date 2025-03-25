<?php
/**
 * Template Name: About Page
 * 
 * The template for displaying the About page
 *
 * @package ForestPlanet
 */

get_header();
?>

<!-- Begin About Page Content -->
<div class="about-mobile screen">
    <div class="main-content">
        <div class="hero"></div>
        <div class="main-content-item">
            <div class="frame-275">
                <div class="frame-274">
                    <div class="what-we-do subtitle-2">WHAT WE DO</div>
                    <h1 class="title librebaskerville-normal-mirage-48px">
                        <span class="span librebaskerville-normal-mirage-48px">Plant </span>
                        <span class="span librebaskerville-normal-mirage-48px-2">Trees </span>
                        <span class="span librebaskerville-normal-mirage-48px">Plant </span>
                        <span class="span librebaskerville-normal-mirage-48px-2">Hope</span>
                    </h1>
                </div>
                <img class="plant-hope-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/plant-hope-hero-img.png" alt="Plant Hope" />
                <p class="we-channel-support-f body-2-regular">
                    We channel support from businesses, individuals, and foundations to cost-effective tree-planting projects.
                    These efforts restore habitats, improve soil, capture carbon, and uplift communities.<br /><br />Through
                    reforestation, we help secure income, food, and hope for many. Trees enrich soil, preserve water, and
                    foster biodiversity.<br /><br />We proudly partner with visionary organizations to create lasting impact.
                    Join us in transforming lives and ecosystems through trees.
                </p>
                <div class="frame-113">
                    <a href="<?php echo esc_url(home_url('/donate')); ?>">
                        <div class="primary-button-salem">
                            <div class="primary-button-romance-text body-2-regular">Donate</div>
                        </div>
                    </a>
                    <a href="<?php echo esc_url(home_url('/partner')); ?>">
                        <div class="secondary-button-salem secondary-button">
                            <div class="secondary-button-salem-text body-2-regular">Partner</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="main-content-item-1">
            <div class="frame-274-1">
                <div class="goals-we-stand-behind subtitle-2">GOALS WE STAND BEHIND</div>
                <div class="united-nations-sustainable-development-goals librebaskerville-normal-mirage-48px">
                    <span class="librebaskerville-normal-mirage-48px">United Nations</span><br>
                    <span class="librebaskerville-normal-mirage-48px">Sustainable Development Goals</span>
                </div>
            </div>
            <iframe src="<?php echo get_template_directory_uri(); ?>/interactive-unsdg.html" class="unsdg-graphic-mobile" title="Interactive United Nations Sustainable Development Goals" style="border: none; width: 100%; height: 520px; min-height: 500px; overflow: hidden; filter: drop-shadow(var(--box-shadow-small));" scrolling="no" loading="lazy" onload="resizeIframe(this)"></iframe>
        </div>
        <div class="main-content-item-1">
            <div class="our-timeline our">Our Timeline</div>
            <div class="frame-294">
                <?php
                $timeline_years = array('2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024');
                
                foreach ($timeline_years as $index => $year) :
                    $class_num = $index === 0 ? 'number' : 'number-1';
                ?>
                <div class="frame-29">
                    <div class="frame">
                        <div class="<?php echo esc_attr($class_num); ?> heading-2-mobile"><?php echo esc_html($year); ?></div>
                        <hr class="line-mirage-2" />
                    </div>
                    <div class="frame-29">
                        <p class="everywhere-we-travel body-2-regular">
                            Everywhere we travel we see underlying economic forces driving unsustainable behavior. Alternatively,
                            when unsustainable behavior begins to deliver diminishing returns it's an opportunity to offer
                            economically viable alternatives that also provide ecological benefits. Decision windows open and
                            close quickly, so the right team with the right ideas and tools needs to be ready.
                        </p>
                        <?php if ($index === 0) : ?>
                        <div class="frame-216">
                            <img class="rectangle-31 rectangle" src="<?php echo get_template_directory_uri(); ?>/assets/images/planting-trees-in-morocco.jpg" alt="Planting trees in Morocco" />
                            <p class="planting-fig-trees-in-morocco body-2-regular">Planting fig trees in Morocco</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="invite-us">
            <div class="frame-1">
                <div class="invite-us-1 librebaskerville-normal-romance-48px">Invite Us</div>
                <p class="invite-us-to-your-po body-2-regular">
                    Invite us to your podcast or event to explore how reforestation combats climate change, revitalizes
                    ecosystems, and empowers communities. Podcasts offer a unique platform for us to share in-depth insights,
                    actionable strategies, and inspiring stories about the transformative power of trees. Whether you're
                    hosting in the DMV area or virtually, our team is ready to engage and inspire your audience.
                </p>
                <a href="<?php echo esc_url(home_url('/invite-us')); ?>">
                    <div class="primary-button-romance">
                        <div class="primary-button-fuchsia-blue-text body-2-regular">Invite Us</div>
                    </div>
                </a>
            </div>
            <div class="frame-199">
                <div class="frame-20">
                    <div class="where-weve-spoken heading-2-mobile">Where We've Spoken</div>
                    <div class="frame-1-1">
                        <div class="story-cards">
                            <?php
                            for ($i = 0; $i < 6; $i++) :
                            ?>
                            <article class="story-card">
                                <img class="story-card-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/rectangle-18-1@2x.png" alt="<?php echo $i > 1 ? 'Additional Story Card ' . ($i + 1) : 'Rectangle 18'; ?>" />
                                <div class="story-card-content">
                                    <div class="story-card-date subtitle-2">FEB 16 2025</div>
                                    <p class="story-card-title body-1-semibold"><?php echo $i > 1 ? 'Additional Story Card ' . ($i + 1) : 'Title For Story Card Template'; ?></p>
                                    <p class="story-card-description body-2-regular">
                                        <?php echo $i > 1 ? 'Additional content for story card ' . ($i + 1) . '.' : 'Here would contain a brief introduction to the article like the first'; ?>
                                    </p>
                                </div>
                            </article>
                            <?php endfor; ?>
                        </div>
                        <div class="tertiary-button"><div class="tertiary-romance-text body-2-regular">Load More</div></div>
                    </div>
                </div>
                <div class="frame-20">
                    <div class="podcasts heading-2-mobile">Podcasts</div>
                    <div class="frame-1-1">
                        <div class="podcast-cards">
                            <?php
                            for ($i = 0; $i < 7; $i++) :
                            ?>
                            <article class="podcast-card">
                                <hr class="line-romance" />
                                <div class="frame-116">
                                    <img class="rectangle-19" src="<?php echo get_template_directory_uri(); ?>/assets/images/rectangle-19@2x.png" alt="Rectangle 19" />
                                    <div class="frame-291">
                                        <div class="frame-112">
                                            <div class="feb-16-2025-1 subtitle-2">FEB 16 2025</div>
                                            <p class="example-s2-e3-podcas body-1-semibold">
                                                Example S2E3: Podcast Title that involves Hank
                                            </p>
                                            <div class="podcast-name body-2-regular">Podcast name</div>
                                        </div>
                                        <div class="secondary-button-romance secondary-button">
                                            <div class="listen body-2-regular">Listen</div>
                                            <img class="link-external" src="<?php echo get_template_directory_uri(); ?>/assets/images/link-external.svg" alt="Link External" />
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <?php endfor; ?>
                        </div>
                        <div class="tertiary-button"><div class="tertiary-romance-text body-2-regular">Load More</div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="our-team our">
            <div class="frame-1">
                <div class="our-team-1 librebaskerville-normal-mirage-48px">Our Team</div>
                <p class="our-dedicated-board body-2-regular">
                    Our dedicated Board of Directors brings together a wealth of experience, vision, and passion for
                    sustainability and global impact. With backgrounds spanning environmental science, business leadership,
                    and community development, they guide our mission to restore ecosystems, empower communities, and drive
                    meaningful change. Their commitment ensures transparency, innovation, and long-term success in all we do.
                </p>
            </div>
            <div class="team-avatars">
                <div class="frame-10">
                    <img class="image" src="<?php echo get_template_directory_uri(); ?>/assets/images/headshot-hank.png" alt="Hank Dearden" />
                    <div class="frame-101">
                        <div class="executive-director inter-semi-bold-salem-14px">EXECUTIVE DIRECTOR</div>
                        <div class="name inter-semi-bold-mirage-32px">Hank Dearden</div>
                    </div>
                </div>
                <div class="frame-10">
                    <img class="image" src="<?php echo get_template_directory_uri(); ?>/assets/images/headshot-annie.png" alt="Annie Acosta" />
                    <div class="frame-101">
                        <div class="communications-manager inter-semi-bold-salem-14px">COMMUNICATIONS MANAGER</div>
                        <div class="name inter-semi-bold-mirage-32px">Annie Acosta</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content-item">
            <div class="frame-35">
                <div class="frame-34">
                    <div class="act-now subtitle-2">ACT NOW</div>
                    <div class="frame-5">
                        <div class="be-the-change librebaskerville-normal-mirage-48px">
                            <span class="span librebaskerville-normal-mirage-48px">Be The </span>
                            <span class="span librebaskerville-normal-mirage-48px-2">Change</span>
                        </div>
                        <p class="your-support-is-the body-2-regular">
                            Your support is the root of transformation. Every donation, every action, and every partnership helps
                            us plant more trees, restore more ecosystems, and uplift more lives.<br />Donate today to make an
                            immediate impact, or join us as a volunteer or partner to grow a greener, brighter future. Together,
                            we can heal the planet—one tree at a time.
                        </p>
                    </div>
                </div>
                <div class="frame-113">
                    <a href="<?php echo esc_url(home_url('/donate')); ?>">
                        <div class="primary-button-salem">
                            <div class="primary-button-romance-text body-2-regular">Donate</div>
                        </div>
                    </a>
                    <a href="<?php echo esc_url(home_url('/partner')); ?>">
                        <div class="secondary-button-salem secondary-button">
                            <div class="secondary-button-salem-text body-2-regular">Partner</div>
                        </div>
                    </a>
                </div>
            </div>
            <img class="image-2" src="<?php echo get_template_directory_uri(); ?>/assets/images/be-the-change.png" alt="Be The Change" />
        </div>
    </div>
</div>

<div class="about-desktop-all-breakpoints screen">
    <!-- Parallax banner image (hero-1) appears right below the header -->
    <div class="main-content-1">
        <!-- Parallax Hero begins -->
        <div class="hero-1"></div>
        
        <!-- Content (for example, the "what we do" section) follows and will overlap the banner -->
        <div class="plant-hope">
            <div class="frame-1-2 frame-1">
                <div class="who-are-we subtitle-2">WHO ARE WE</div>
                <h1 class="title-1 librebaskerville-normal-romance-64px">
                    <span class="span-1 librebaskerville-normal-romance-64px">Plant </span>
                    <span class="span-1 librebaskerville-normal-romance-64px-2">Trees </span>
                    <span class="span-1 librebaskerville-normal-romance-64px">Plant </span>
                    <span class="span-1 librebaskerville-normal-romance-64px-2">Hope</span>
                </h1>
            </div>
            <div class="frame-123">
                <img class="plant-hope-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/plant-hope-hero-img.png" alt="Plant Hope" />
                <div class="frame-122">
                    <p class="founded-in-2017-for body-2-regular">
                        Founded in 2017, ForestPlanet is driven by a deep passion for the healing power of trees. With a
                        streamlined, low-overhead approach, we support large-scale reforestation projects at a cost of under 15
                        cents per tree. Our efforts are powered by the support of businesses, individuals, and foundations,
                        enabling cost-effective tree planting that restores habitats, improves soil health, captures carbon, and
                        uplifts communities.<br /><br />Through reforestation, we help secure income, food, and hope for many.
                        Trees serve as nature's powerhouses—enriching soil, preserving water, and fostering biodiversity.
                        Partnering with visionary organizations, we strive to create a lasting impact. Join us in transforming
                        lives and ecosystems through the power of trees.
                    </p>
                    <div class="frame-113-1">
                        <a href="<?php echo esc_url(home_url('/donate')); ?>">
                            <div class="primary-button-salem">
                                <div class="primary-button-romance-text body-2-regular">Donate</div>
                            </div>
                        </a>
                        <a href="<?php echo esc_url(home_url('/partner')); ?>">
                            <div class="secondary-button-salem secondary-button">
                                <div class="secondary-button-salem-text body-2-regular">Partner</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="unsdg">
            <div class="frame-121">
                <div class="goals-we-stand-behind-1 subtitle-2">GOALS WE STAND BEHIND</div>
                <div class="united-nations-sustainable-development-goals librebaskerville-normal-mirage-64px">
                    <span class="librebaskerville-normal-mirage-64px">United Nations</span><br>
                    <span class="librebaskerville-normal-mirage-64px">Sustainable Development Goals</span>
                </div>
            </div>
            <iframe src="<?php echo get_template_directory_uri(); ?>/interactive-unsdg.html" class="unsdg-graphic" title="Interactive United Nations Sustainable Development Goals" style="border: none; width: 100%; height: 520px; max-height: 520px; overflow: hidden; margin: 0; filter: drop-shadow(var(--box-shadow-small));" scrolling="no" loading="lazy" onload="resizeIframe(this)"></iframe>
        </div>
        
        <div class="timeline">
            <div class="our-timeline-1 librebaskerville-normal-mirage-64px">Our Timeline</div>
            <div class="frame-171">
                <?php
                $timeline_years = array('2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024');
                
                foreach ($timeline_years as $year) :
                ?>
                <div class="frame-2">
                    <div class="frame-1-2 frame-1">
                        <div class="number-2 heading-2"><?php echo esc_html($year); ?></div>
                        <hr class="line-mirage-2" />
                    </div>
                    <div class="frame-291-1">
                        <p class="everywhere-we-travel-1 body-1-regular">
                            Everywhere we travel we see underlying economic forces driving unsustainable behavior. Alternatively,
                            when unsustainable behavior begins to deliver diminishing returns it's an opportunity to offer
                            economically viable alternatives that also provide ecological benefits. Decision windows open and
                            close quickly, so the right team with the right ideas and tools needs to be ready.
                        </p>
                        <?php if ($year === '2017') : ?>
                        <div class="frame-216-1">
                            <img class="rectangle-31-1" src="<?php echo get_template_directory_uri(); ?>/assets/images/planting-trees-in-morocco.jpg" alt="Planting trees in Morocco" />
                            <p class="planting-fig-trees-in-morocco-1 body-2-regular">Planting fig trees in Morocco</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="invite-us-2 invite-us">
            <div class="frame-179">
                <div class="invite-us-3 invite-us librebaskerville-normal-romance-64px">Invite Us</div>
                <p class="invite-us-to-your-po-1 body-2-regular">
                    Invite us to your podcast or event to explore how reforestation combats climate change, revitalizes
                    ecosystems, and empowers communities. Podcasts offer a unique platform for us to share in-depth insights,
                    actionable strategies, and inspiring stories about the transformative power of trees. Whether you're
                    hosting in the DMV area or virtually, our team is ready to engage and inspire your audience.
                </p>
                <a href="<?php echo esc_url(home_url('/invite-us')); ?>">
                    <div class="primary-button-romance">
                        <div class="primary-button-fuchsia-blue-text body-2-regular">Invite Us</div>
                    </div>
                </a>
            </div>
            <div class="frame-199-1">
                <div class="frame-2">
                    <div class="where-weve-spoken-1 heading-2">Where We've Spoken</div>
                    <div class="frame-1-3 frame-1">
                        <div class="story-cards-1">
                            <?php
                            for ($i = 0; $i < 6; $i++) :
                                $title = $i > 1 ? 'Additional Story Card ' . ($i - 1) : 'Title For Story Card Template';
                                $content = $i > 1 ? 'Additional content for story card ' . ($i - 1) . '.' : 'Here would contain a brief introduction to the article like the first';
                            ?>
                            <article class="story-card">
                                <img class="story-card-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/rectangle-18-2@2x.png" alt="Story Card Image" />
                                <div class="story-card-content">
                                    <div class="story-card-date subtitle-2">FEB 16 2025</div>
                                    <p class="story-card-title body-1-semibold"><?php echo esc_html($title); ?></p>
                                    <p class="story-card-description body-2-regular">
                                        <?php echo esc_html($content); ?>
                                    </p>
                                </div>
                            </article>
                            <?php endfor; ?>
                        </div>
                        <div class="tertiary-button">
                            <div class="tertiary-romance-text body-2-regular">Load More</div>
                        </div>
                    </div>
                </div>
                <div class="frame-2">
                    <div class="frame-2"><div class="podcasts-1 heading-2">Podcasts</div></div>
                    <div class="frame-1-3 frame-1">
                        <div class="podcast-cards-1">
                            <?php
                            for ($i = 0; $i < 8; $i++) :
                            ?>
                            <article class="podcast-card-1">
                                <hr class="line-romance" />
                                <div class="frame-117">
                                    <div class="frame-116-1">
                                        <img class="rectangle-19-1" src="<?php echo get_template_directory_uri(); ?>/assets/images/rectangle-19-1@2x.png" alt="Rectangle 19" />
                                        <div class="frame-115">
                                            <div class="frame-112-1">
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
                                        <div class="listen body-2-regular">Listen</div>
                                        <img class="link-external" src="<?php echo get_template_directory_uri(); ?>/assets/images/link-external.svg" alt="Link External" />
                                    </div>
                                </div>
                            </article>
                            <?php endfor; ?>
                        </div>
                        <div class="tertiary-button">
                            <div class="tertiary-romance-text body-2-regular">Load More</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="our-team-2 our-team">
            <div class="frame-135">
                <div class="our-team-3 our-team librebaskerville-normal-mirage-64px">Our Team</div>
                <p class="our-dedicated-board-1 body-2-regular">
                    Our dedicated Board of Directors brings together a wealth of experience, vision, and passion for
                    sustainability and global impact. With backgrounds spanning environmental science, business leadership,
                    and community development, they guide our mission to restore ecosystems, empower communities, and drive
                    meaningful change. Their commitment ensures transparency, innovation, and long-term success in all we do.
                </p>
            </div>
            <div class="team-avatars-1">
                <div class="frame-10-1">
                    <img class="image-3" src="<?php echo get_template_directory_uri(); ?>/assets/images/headshot-hank.png" alt="Hank Dearden" />
                    <div class="frame-101-1">
                        <div class="executive-director-1 inter-semi-bold-salem-14px">EXECUTIVE DIRECTOR</div>
                        <div class="name-1 inter-semi-bold-mirage-32px">Hank Dearden</div>
                    </div>
                </div>
                <div class="frame-10-1">
                    <img class="image-3" src="<?php echo get_template_directory_uri(); ?>/assets/images/headshot-annie.png" alt="Annie Acosta" />
                    <div class="frame-101-1">
                        <div class="communications-manager-1 inter-semi-bold-salem-14px">COMMUNICATIONS MANAGER</div>
                        <div class="name-1 inter-semi-bold-mirage-32px">Annie Acosta</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="act-now-1 act-now">
            <div class="frame-35-1">
                <div class="frame-34-1">
                    <div class="act-now-2 act-now subtitle-2">ACT NOW</div>
                    <div class="frame-5-1">
                        <div class="be-the-change-1 librebaskerville-normal-mirage-64px">
                            <span class="librebaskerville-normal-mirage-64px">Be The </span><span
                            class="librebaskerville-normal-mirage-64px-2">Change</span>
                        </div>
                        <p class="your-support-is-the-1 body-2-regular">
                            Your support is the root of transformation. Every donation, every action, and every partnership helps
                            us plant more trees, restore more ecosystems, and uplift more lives.<br />Donate today to make an
                            immediate impact, or join us as a volunteer or partner to grow a greener, brighter future. Together,
                            we can heal the planet—one tree at a time.
                        </p>
                    </div>
                </div>
                <div class="frame-113-1">
                    <a href="<?php echo esc_url(home_url('/donate')); ?>">
                        <div class="primary-button-salem">
                            <div class="primary-button-romance-text body-2-regular">Donate</div>
                        </div>
                    </a>
                    <a href="<?php echo esc_url(home_url('/partner')); ?>">
                        <div class="secondary-button-salem secondary-button">
                            <div class="secondary-button-salem-text body-2-regular">Partner</div>
                        </div>
                    </a>
                </div>
            </div>
            <img class="image-5" src="<?php echo get_template_directory_uri(); ?>/assets/images/be-the-change.png" alt="Be The Change" />
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    // Update background images with proper paths
    document.addEventListener('DOMContentLoaded', function() {
        // Set initial low-res hero backgrounds
        const mobileHero = document.querySelector('.about-mobile .hero');
        if (mobileHero) {
            mobileHero.style.backgroundImage = 'url(<?php echo get_template_directory_uri(); ?>/assets/images/hero-about-low.webp)';
        }
        
        const desktopHero = document.querySelector('.about-desktop-all-breakpoints .hero-1');
        if (desktopHero) {
            desktopHero.style.backgroundImage = 'url(<?php echo get_template_directory_uri(); ?>/assets/images/hero-about-low.webp)';
        }
        
        // Story Cards Load More Functionality
        var currentVisibleRows = 1;
        function updateStoryCardsLayout() {
            // Select the desktop story cards container
            var container = document.querySelector('.story-cards-1');
            if (!container) return;
            
            // Get one card element (assumed to be 350px wide per CSS)
            var card = container.querySelector('.story-card');
            if (!card) return;
            
            var cardWidth = card.clientWidth; // expected to be 350px
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
        window.addEventListener("load", updateStoryCardsLayout);
        window.addEventListener("resize", updateStoryCardsLayout);
        
        // Add load more functionality for the story cards
        var loadMoreButton = document.querySelector('.story-cards-1')?.parentElement.querySelector('.tertiary-button');
        if (loadMoreButton) {
            loadMoreButton.addEventListener("click", function() {
                // Determine the current state based on button text
                if (loadMoreButton.querySelector('div').innerText.trim() === "Load More") {
                    // Increase the number of visible rows by 2
                    currentVisibleRows += 2;
                } else {
                    // If the button is showing "Show Less", collapse to the initial state (1 row)
                    currentVisibleRows = 1;
                }
                updateStoryCardsLayout();
            });
        }

        // Mobile Story Cards Load More Functionality
        var currentMobileVisibleCount = 2;
        function updateMobileStoryCardsLayout() {
            // Select the mobile story cards container
            var container = document.querySelector('.about-mobile .story-cards');
            if (!container) return;
            
            // Get all mobile story cards
            var cards = container.querySelectorAll('.story-card');
            cards.forEach(function(item, index) {
                // Show only the first currentMobileVisibleCount cards; hide the rest
                item.style.display = index < currentMobileVisibleCount ? "flex" : "none";
            });
            
            // Center the mobile cards
            container.style.justifyContent = "center";
            
            // Update button text
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
        window.addEventListener("load", updateMobileStoryCardsLayout);
        window.addEventListener("resize", updateMobileStoryCardsLayout);
        
        // Add load more functionality for mobile story cards
        var mobileLoadMoreButton = document.querySelector('.about-mobile .story-cards')?.parentElement.querySelector('.tertiary-button');
        if (mobileLoadMoreButton) {
            mobileLoadMoreButton.addEventListener("click", function() {
                if (mobileLoadMoreButton.querySelector('div').innerText.trim() === "Load More") {
                    // Increase visible cards by 2
                    currentMobileVisibleCount += 2;
                } else {
                    // Collapse back to initial state
                    currentMobileVisibleCount = 2;
                }
                updateMobileStoryCardsLayout();
            });
        }

        // Desktop Podcast Cards Load More Functionality
        var initialVisiblePodcasts = 4;
        var currentVisiblePodcasts = initialVisiblePodcasts;
        
        function updateDesktopPodcastCards() {
            var container = document.querySelector('.podcast-cards-1');
            if (!container) return;
            
            var cards = container.querySelectorAll('.podcast-card-1');
            cards.forEach(function(card, index) {
                card.style.display = index < currentVisiblePodcasts ? "flex" : "none";
            });
            
            var button = container.parentElement.querySelector('.tertiary-button');
            if (button) {
                if (currentVisiblePodcasts >= cards.length) {
                    button.querySelector('div').innerText = "Show Less";
                } else {
                    button.querySelector('div').innerText = "Load More";
                }
            }
        }
        
        window.addEventListener("load", updateDesktopPodcastCards);
        window.addEventListener("resize", updateDesktopPodcastCards);
        
        var loadButton = document.querySelector('.podcast-cards-1')?.parentElement.querySelector('.tertiary-button');
        if (loadButton) {
            loadButton.addEventListener("click", function() {
                if (loadButton.querySelector('div').innerText.trim() === "Load More") {
                    currentVisiblePodcasts += 4;
                } else {
                    currentVisiblePodcasts = initialVisiblePodcasts;
                }
                updateDesktopPodcastCards();
            });
        }

        // Mobile Podcast Cards Load More Functionality
        var initialMobileVisiblePodcasts = 2;
        var currentMobileVisiblePodcasts = initialMobileVisiblePodcasts;
        
        function updateMobilePodcastCardsLayout() {
            var container = document.querySelector('.about-mobile .podcast-cards');
            if (!container) return;
            
            var cards = container.querySelectorAll('.podcast-card');
            cards.forEach(function(card, index) {
                card.style.display = index < currentMobileVisiblePodcasts ? "flex" : "none";
            });
            
            container.style.justifyContent = "center";
            
            var button = container.parentElement.querySelector('.tertiary-button');
            if (button) {
                if (currentMobileVisiblePodcasts >= cards.length) {
                    button.querySelector('div').innerText = "Show Less";
                } else {
                    button.querySelector('div').innerText = "Load More";
                }
            }
        }
        
        window.addEventListener("load", updateMobilePodcastCardsLayout);
        window.addEventListener("resize", updateMobilePodcastCardsLayout);
        
        var mobilePodcastButton = document.querySelector('.about-mobile .podcast-cards')?.parentElement.querySelector('.tertiary-button');
        if (mobilePodcastButton) {
            mobilePodcastButton.addEventListener("click", function() {
                if (mobilePodcastButton.querySelector('div').innerText.trim() === "Load More") {
                    currentMobileVisiblePodcasts += 2;
                } else {
                    currentMobileVisiblePodcasts = initialMobileVisiblePodcasts;
                }
                updateMobilePodcastCardsLayout();
            });
        }

        // Progressive Image Loading for Hero Banner
        function loadHighResHero() {
            // Preload the high-resolution image
            const highResImage = new Image();
            highResImage.src = '<?php echo get_template_directory_uri(); ?>/assets/images/hero-about.webp';
            
            // When the high-resolution image is loaded, update the hero banners
            highResImage.onload = function() {
                // Update desktop hero
                const desktopHero = document.querySelector('.about-desktop-all-breakpoints .hero-1');
                if (desktopHero) {
                    desktopHero.style.backgroundImage = 'url(<?php echo get_template_directory_uri(); ?>/assets/images/hero-about.webp)';
                }
                
                // Update mobile hero
                const mobileHero = document.querySelector('.about-mobile .hero');
                if (mobileHero) {
                    mobileHero.style.backgroundImage = 'url(<?php echo get_template_directory_uri(); ?>/assets/images/hero-about.webp)';
                }
            };
        }
        
        loadHighResHero();

        // Function to resize iframe dynamically
        function resizeIframe(iframe) {
            if (!iframe) return;
            
            // Function to handle messages from iframe
            function handleMessage(e) {
                if (e.source === iframe.contentWindow && e.data && e.data.height) {
                    const height = parseInt(e.data.height);
                    if (!isNaN(height)) {
                        // Calculate target height with padding
                        let targetHeight = height + 20;
                        
                        // For desktop (unsdg-graphic), enforce max height of 565px
                        if (iframe.classList.contains('unsdg-graphic')) {
                            targetHeight = Math.min(targetHeight, 565);
                        }
                        
                        // Set the iframe height
                        iframe.style.height = targetHeight + 'px';
                    }
                }
            }
            
            // Remove any existing event listeners to avoid duplicates
            window.removeEventListener('message', handleMessage);
            
            // Add event listener for messages
            window.addEventListener('message', handleMessage);
            
            // Initial height request
            setTimeout(function() {
                try {
                    iframe.contentWindow.postMessage('getHeight', '*');
                    
                    // Set a fallback height in case messaging fails
                    if (iframe.classList.contains('unsdg-graphic')) {
                        iframe.style.height = '600px';
                    } else {
                        iframe.style.height = '520px';
                    }
                } catch (e) {
                    console.error('Error resizing iframe:', e);
                }
            }, 300);
            
            // Request height again after images might have loaded
            setTimeout(function() {
                try {
                    iframe.contentWindow.postMessage('getHeight', '*');
                } catch (e) {
                    console.error('Error in delayed iframe resize:', e);
                }
            }, 1000);
        }

        // Initialize the iframe resize function for each iframe
        document.querySelectorAll('iframe').forEach(iframe => {
            if (iframe.hasAttribute('onload')) {
                iframe.onload = function() {
                    resizeIframe(this);
                };
            }
        });
    });
</script>

<?php
get_footer(); 