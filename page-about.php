<?php
/**
 * Template Name: About Page
 * 
 * The template for displaying the About page
 *
 * @package ForestPlanet
 */

get_header();

// Get default values if ACF fields are empty
$subtitle = forestplanet_get_field('about_subtitle', null, 'WHAT WE DO');
$title = forestplanet_get_field('about_title', null, 'Plant Trees Plant Hope');
$main_content = forestplanet_get_field('about_main_content', null, 'We channel support from businesses, individuals, and foundations to cost-effective tree-planting projects. These efforts restore habitats, improve soil, capture carbon, and uplift communities.<br /><br />Through reforestation, we help secure income, food, and hope for many. Trees enrich soil, preserve water, and foster biodiversity.<br /><br />We proudly partner with visionary organizations to create lasting impact. Join us in transforming lives and ecosystems through trees.');
$plant_hope_image = forestplanet_get_field('about_plant_hope_image', null, get_template_directory_uri() . '/assets/images/plant-hope-hero-img.png');

// UNSDG section
$unsdg_subtitle = forestplanet_get_field('about_unsdg_subtitle', null, 'GOALS WE STAND BEHIND');
$unsdg_title = forestplanet_get_field('about_unsdg_title', null, 'United Nations Sustainable Development Goals');
$unsdg_iframe = forestplanet_get_field('about_unsdg_iframe', null, '/interactive-unsdg.html');

// Timeline section
$timeline_title = forestplanet_get_field('about_timeline_title', null, 'Our Timeline');
$timeline_default_content = forestplanet_get_field('about_timeline_default_content', null, 'Everywhere we travel we see underlying economic forces driving unsustainable behavior. Alternatively, when unsustainable behavior begins to deliver diminishing returns it\'s an opportunity to offer economically viable alternatives that also provide ecological benefits. Decision windows open and close quickly, so the right team with the right ideas and tools needs to be ready.');

// Invite Us section
$invite_title = forestplanet_get_field('about_invite_title', null, 'Invite Us');
$invite_content = forestplanet_get_field('about_invite_content', null, 'Invite us to your podcast or event to explore how reforestation combats climate change, revitalizes ecosystems, and empowers communities. Podcasts offer a unique platform for us to share in-depth insights, actionable strategies, and inspiring stories about the transformative power of trees. Whether you\'re hosting in the DMV area or virtually, our team is ready to engage and inspire your audience.');
$spoken_title = forestplanet_get_field('about_spoken_title', null, 'Where We\'ve Spoken');
$podcasts_title = forestplanet_get_field('about_podcasts_title', null, 'Podcasts');

// Team section
$team_title = forestplanet_get_field('about_team_title', null, 'Our Team');
$team_content = forestplanet_get_field('about_team_content', null, 'Our dedicated Board of Directors brings together a wealth of experience, vision, and passion for sustainability and global impact. With backgrounds spanning environmental science, business leadership, and community development, they guide our mission to restore ecosystems, empower communities, and drive meaningful change. Their commitment ensures transparency, innovation, and long-term success in all we do.');

// Team members
$team_member_1 = forestplanet_get_field('about_team_member_1', null, array(
    'image' => get_template_directory_uri() . '/assets/images/headshot-hank.png',
    'title' => 'EXECUTIVE DIRECTOR',
    'name' => 'Hank Dearden'
));
$team_member_2 = forestplanet_get_field('about_team_member_2', null, array(
    'image' => get_template_directory_uri() . '/assets/images/headshot-annie.png',
    'title' => 'COMMUNICATIONS MANAGER',
    'name' => 'Annie Acosta'
));
$team_member_3 = forestplanet_get_field('about_team_member_3', null, array());

// CTA section
$cta_subtitle = forestplanet_get_field('about_cta_subtitle', null, 'ACT NOW');
$cta_title_first = forestplanet_get_field('about_cta_title_first', null, 'Be The');
$cta_title_second = forestplanet_get_field('about_cta_title_second', null, 'Change');
$cta_content = forestplanet_get_field('about_cta_content', null, 'Your support is the root of transformation. Every donation, every action, and every partnership helps us plant more trees, restore more ecosystems, and uplift more lives.<br />Donate today to make an immediate impact, or join us as a volunteer or partner to grow a greener, brighter future. Together, we can heal the planet—one tree at a time.');
$cta_image = forestplanet_get_field('about_cta_image', null, get_template_directory_uri() . '/assets/images/be-the-change.png');

// Get timeline data
$timeline_years = array();
for ($year = 2017; $year <= 2026; $year++) {
    $year_data = forestplanet_get_field("about_timeline_{$year}", null, array());
    
    if (empty($year_data) || empty($year_data['year'])) {
        // Skip years that don't have data and are optional (2025-2026)
        if ($year >= 2025) {
            continue;
        }
        
        // For required years (2017-2024), set default values
        $timeline_item = array(
            'year' => (string)$year,
            'content' => $timeline_default_content,
            'image' => $year == 2017 ? get_template_directory_uri() . '/assets/images/rectangle-31@2x.png' : '',
            'caption' => $year == 2017 ? 'Planting fig trees in Morocco' : '',
        );
    } else {
        $timeline_item = array(
            'year' => !empty($year_data['year']) ? $year_data['year'] : (string)$year,
            'content' => !empty($year_data['content']) ? $year_data['content'] : $timeline_default_content,
            'image' => !empty($year_data['image']) ? $year_data['image'] : ($year == 2017 ? get_template_directory_uri() . '/assets/images/rectangle-31@2x.png' : ''),
            'caption' => !empty($year_data['caption']) ? $year_data['caption'] : ($year == 2017 ? 'Planting fig trees in Morocco' : ''),
        );
    }
    
    $timeline_years[] = $timeline_item;
}

// Story Cards
$story_cards = array();
for ($i = 1; $i <= 6; $i++) {
    $card_field_name = "about_story_card_{$i}";
    $card_data = forestplanet_get_field($card_field_name, null, array());
    
    $story_card = array(
        'image' => !empty($card_data["story_card_{$i}_image"]) ? $card_data["story_card_{$i}_image"] : get_template_directory_uri() . '/assets/images/rectangle-18-2@2x.png',
        'date' => !empty($card_data["story_card_{$i}_date"]) ? $card_data["story_card_{$i}_date"] : 'FEB 16 2023',
        'title' => !empty($card_data["story_card_{$i}_title"]) ? $card_data["story_card_{$i}_title"] : ($i == 1 ? 'Title For Story Card Template' : "Additional Story Card " . ($i - 1)),
        'content' => !empty($card_data["story_card_{$i}_content"]) ? $card_data["story_card_{$i}_content"] : ($i == 1 ? 'Here would contain a brief introduction to the article like the first' : "Additional content for story card " . ($i - 1) . ".")
    );
    
    $story_cards[] = $story_card;
}
?>

<!-- Begin About Page Content -->
<div class="about-mobile screen">
    <div class="main-content">
        <div class="hero"></div>
        <div class="main-content-item">
            <div class="frame-275">
                <div class="frame-274">
                    <div class="what-we-do subtitle-2"><?php echo esc_html($subtitle); ?></div>
                    <h1 class="title librebaskerville-normal-mirage-48px">
                        <span class="span librebaskerville-normal-mirage-48px"><?php echo esc_html($title); ?></span>
                    </h1>
                </div>
                <img class="plant-hope-hero-img" src="<?php echo esc_url($plant_hope_image); ?>" alt="Plant Hope" />
                <p class="we-channel-support-f body-2-regular">
                    <?php echo wp_kses_post($main_content); ?>
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
                <div class="goals-we-stand-behind subtitle-2"><?php echo esc_html($unsdg_subtitle); ?></div>
                <div class="united-nations-sustainable-development-goals librebaskerville-normal-mirage-48px">
                    <?php echo wp_kses_post(nl2br(esc_html($unsdg_title))); ?>
                </div>
            </div>
            <iframe src="<?php echo esc_url(get_template_directory_uri() . $unsdg_iframe); ?>" class="unsdg-graphic-mobile" title="Interactive United Nations Sustainable Development Goals" style="border: none; width: 100%; height: 520px; min-height: 500px; overflow: hidden; filter: drop-shadow(var(--box-shadow-small));" scrolling="no" loading="lazy" onload="resizeIframe(this)"></iframe>
        </div>
        <div class="main-content-item-1">
            <div class="our-timeline our"><?php echo esc_html($timeline_title); ?></div>
            <div class="frame-294">
                <?php
                foreach ($timeline_years as $index => $timeline_item) :
                    $class_num = $index === 0 ? 'number' : 'number-1';
                ?>
                <div class="frame-29">
                    <div class="frame">
                        <div class="<?php echo esc_attr($class_num); ?> heading-2-mobile"><?php echo esc_html($timeline_item['year']); ?></div>
                        <hr class="line-mirage-2" />
                    </div>
                    <div class="frame-29">
                        <p class="everywhere-we-travel body-2-regular">
                            <?php echo esc_html($timeline_item['content']); ?>
                        </p>
                        <?php if (!empty($timeline_item['image'])) : ?>
                        <div class="story-image-container">
                            <img class="rectangle story-image" src="<?php echo esc_url($timeline_item['image']); ?>" alt="<?php echo esc_attr($timeline_item['caption']); ?>" />
                            <p class="planting-fig-trees-in-morocco body-2-regular"><?php echo esc_html($timeline_item['caption']); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="invite-us">
            <div class="frame-1">
                <div class="invite-us-1 librebaskerville-normal-romance-48px"><?php echo esc_html($invite_title); ?></div>
                <p class="invite-us-to-your-po body-2-regular">
                    <?php echo wp_kses_post($invite_content); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/invite-us')); ?>">
                    <div class="primary-button-romance">
                        <div class="primary-button-fuchsia-blue-text body-2-regular">Invite Us</div>
                    </div>
                </a>
            </div>
            <div class="frame-199">
                <div class="frame-20">
                    <div class="where-weve-spoken heading-2-mobile"><?php echo esc_html($spoken_title); ?></div>
                    <div class="frame-1-1">
                        <div class="story-cards">
                            <?php
                            // Display story cards
                            foreach ($story_cards as $card) :
                            ?>
                            <article class="story-card">
                                <img class="story-card-image" src="<?php echo esc_url($card['image']); ?>" alt="<?php echo esc_attr($card['title']); ?>" />
                                <div class="story-card-content">
                                    <div class="story-card-date subtitle-2"><?php echo esc_html($card['date']); ?></div>
                                    <p class="story-card-title body-1-semibold"><?php echo esc_html($card['title']); ?></p>
                                    <p class="story-card-description body-2-regular">
                                        <?php echo esc_html($card['content']); ?>
                                    </p>
                                </div>
                            </article>
                            <?php endforeach; ?>
                        </div>
                        <div class="tertiary-button"><div class="tertiary-romance-text body-2-regular">Load More</div></div>
                    </div>
                </div>
                <div class="frame-20">
                    <div class="podcasts heading-2-mobile"><?php echo esc_html($podcasts_title); ?></div>
                    <div class="frame-1-1">
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
                                    forestplanet_display_podcast_card(get_the_ID(), 'mobile', true);
                                endwhile;
                                wp_reset_postdata();
                            else :
                                // If no posts, show sample podcast entries
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
                            <?php
                                endfor;
                            endif;
                            ?>
                        </div>
                        <div class="tertiary-button"><div class="tertiary-romance-text body-2-regular">Load More</div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="our-team our">
            <div class="frame-1">
                <div class="our-team-1 librebaskerville-normal-mirage-48px"><?php echo esc_html($team_title); ?></div>
                <p class="our-dedicated-board body-2-regular">
                    <?php echo wp_kses_post($team_content); ?>
                </p>
            </div>
            <div class="team-avatars">
                <?php if (!empty($team_member_1)) : ?>
                <div class="frame-10">
                    <img class="image" src="<?php echo esc_url($team_member_1['image']); ?>" alt="<?php echo esc_attr($team_member_1['name']); ?>" />
                    <div class="frame-101">
                        <div class="executive-director inter-semi-bold-salem-14px"><?php echo esc_html($team_member_1['title']); ?></div>
                        <div class="name inter-semi-bold-mirage-32px"><?php echo esc_html($team_member_1['name']); ?></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($team_member_2)) : ?>
                <div class="frame-10">
                    <img class="image" src="<?php echo esc_url($team_member_2['image']); ?>" alt="<?php echo esc_attr($team_member_2['name']); ?>" />
                    <div class="frame-101">
                        <div class="communications-manager inter-semi-bold-salem-14px"><?php echo esc_html($team_member_2['title']); ?></div>
                        <div class="name inter-semi-bold-mirage-32px"><?php echo esc_html($team_member_2['name']); ?></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($team_member_3) && !empty($team_member_3['name'])) : ?>
                <div class="frame-10">
                    <img class="image" src="<?php echo esc_url($team_member_3['image']); ?>" alt="<?php echo esc_attr($team_member_3['name']); ?>" />
                    <div class="frame-101">
                        <div class="team-member-title inter-semi-bold-salem-14px"><?php echo esc_html($team_member_3['title']); ?></div>
                        <div class="name inter-semi-bold-mirage-32px"><?php echo esc_html($team_member_3['name']); ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="main-content-item">
            <div class="frame-35">
                <div class="frame-34">
                    <div class="act-now subtitle-2"><?php echo esc_html($cta_subtitle); ?></div>
                    <div class="frame-5">
                        <div class="be-the-change librebaskerville-normal-mirage-48px">
                            <span class="span librebaskerville-normal-mirage-48px"><?php echo esc_html($cta_title_first); ?> </span>
                            <span class="span librebaskerville-normal-mirage-48px-2"><?php echo esc_html($cta_title_second); ?></span>
                        </div>
                        <p class="your-support-is-the body-2-regular">
                            <?php echo wp_kses_post($cta_content); ?>
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
            <img class="image-2" src="<?php echo esc_url($cta_image); ?>" alt="Be The Change" />
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
                <div class="who-are-we subtitle-2"><?php echo esc_html($subtitle); ?></div>
                <h1 class="title-1 librebaskerville-normal-romance-64px">
                    <span class="span-1 librebaskerville-normal-romance-64px"><?php echo esc_html($title); ?></span>
                </h1>
            </div>
            <div class="frame-123">
                <img class="plant-hope-hero-img" src="<?php echo esc_url($plant_hope_image); ?>" alt="Plant Hope" />
                <div class="frame-122">
                    <p class="founded-in-2017-for body-2-regular">
                        <?php echo wp_kses_post($main_content); ?>
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
                <div class="goals-we-stand-behind-1 subtitle-2"><?php echo esc_html($unsdg_subtitle); ?></div>
                <div class="united-nations-sustainable-development-goals librebaskerville-normal-mirage-64px">
                    <?php echo wp_kses_post(nl2br(esc_html($unsdg_title))); ?>
                </div>
            </div>
            <iframe src="<?php echo esc_url(get_template_directory_uri() . $unsdg_iframe); ?>" class="unsdg-graphic" title="Interactive United Nations Sustainable Development Goals" style="border: none; width: 100%; height: 520px; max-height: 520px; overflow: hidden; margin: 0; filter: drop-shadow(var(--box-shadow-small));" scrolling="no" loading="lazy" onload="resizeIframe(this)"></iframe>
        </div>
        
        <div class="timeline">
            <div class="our-timeline-1 librebaskerville-normal-mirage-64px"><?php echo esc_html($timeline_title); ?></div>
            <div class="frame-171">
                <?php
                foreach ($timeline_years as $timeline_item) :
                ?>
                <div class="frame-2">
                    <div class="frame-1-2 frame-1">
                        <div class="number-2 heading-2"><?php echo esc_html($timeline_item['year']); ?></div>
                        <hr class="line-mirage-2" />
                    </div>
                    <div class="frame-291-1">
                        <p class="everywhere-we-travel-1 body-1-regular">
                            <?php echo esc_html($timeline_item['content']); ?>
                        </p>
                        <?php if (!empty($timeline_item['image'])) : ?>
                        <div class="story-image-container">
                            <img class="story-image" src="<?php echo esc_url($timeline_item['image']); ?>" alt="<?php echo esc_attr($timeline_item['caption']); ?>" />
                            <p class="planting-fig-trees-in-morocco-1 body-2-regular"><?php echo esc_html($timeline_item['caption']); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="invite-us-2 invite-us">
            <div class="frame-179">
                <div class="invite-us-3 invite-us librebaskerville-normal-romance-64px"><?php echo esc_html($invite_title); ?></div>
                <p class="invite-us-to-your-po-1 body-2-regular">
                    <?php echo wp_kses_post($invite_content); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/invite-us')); ?>">
                    <div class="primary-button-romance">
                        <div class="primary-button-fuchsia-blue-text body-2-regular">Invite Us</div>
                    </div>
                </a>
            </div>
            <div class="frame-199-1">
                <div class="frame-2">
                    <div class="where-weve-spoken-1 heading-2"><?php echo esc_html($spoken_title); ?></div>
                    <div class="frame-1-3 frame-1">
                        <div class="story-cards-1">
                            <?php
                            // Display story cards
                            foreach ($story_cards as $card) :
                            ?>
                            <article class="story-card">
                                <img class="story-card-image" src="<?php echo esc_url($card['image']); ?>" alt="<?php echo esc_attr($card['title']); ?>" />
                                <div class="story-card-content">
                                    <div class="story-card-date subtitle-2"><?php echo esc_html($card['date']); ?></div>
                                    <p class="story-card-title body-1-semibold"><?php echo esc_html($card['title']); ?></p>
                                    <p class="story-card-description body-2-regular">
                                        <?php echo esc_html($card['content']); ?>
                                    </p>
                                </div>
                            </article>
                            <?php endforeach; ?>
                        </div>
                        <div class="tertiary-button">
                            <div class="tertiary-romance-text body-2-regular">Load More</div>
                        </div>
                    </div>
                </div>
                <div class="frame-2">
                    <div class="frame-2"><div class="podcasts-1 heading-2"><?php echo esc_html($podcasts_title); ?></div></div>
                    <div class="frame-1-3 frame-1">
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
                                for ($i = 0; $i < 8; $i++) :
                            ?>
                                <article class="frame-183-item">
                                    <div class="line-romance"></div>
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
                            <?php
                                endfor;
                            endif;
                            ?>
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
                <div class="our-team-3 our-team librebaskerville-normal-mirage-64px"><?php echo esc_html($team_title); ?></div>
                <p class="our-dedicated-board-1 body-2-regular">
                    <?php echo wp_kses_post($team_content); ?>
                </p>
            </div>
            <div class="team-avatars-1">
                <?php if (!empty($team_member_1)) : ?>
                <div class="frame-10-1">
                    <img class="image-3" src="<?php echo esc_url($team_member_1['image']); ?>" alt="<?php echo esc_attr($team_member_1['name']); ?>" />
                    <div class="frame-101-1">
                        <div class="executive-director-1 inter-semi-bold-salem-14px"><?php echo esc_html($team_member_1['title']); ?></div>
                        <div class="name-1 inter-semi-bold-mirage-32px"><?php echo esc_html($team_member_1['name']); ?></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($team_member_2)) : ?>
                <div class="frame-10-1">
                    <img class="image-3" src="<?php echo esc_url($team_member_2['image']); ?>" alt="<?php echo esc_attr($team_member_2['name']); ?>" />
                    <div class="frame-101-1">
                        <div class="communications-manager-1 inter-semi-bold-salem-14px"><?php echo esc_html($team_member_2['title']); ?></div>
                        <div class="name-1 inter-semi-bold-mirage-32px"><?php echo esc_html($team_member_2['name']); ?></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($team_member_3) && !empty($team_member_3['name'])) : ?>
                <div class="frame-10-1">
                    <img class="image-3" src="<?php echo esc_url($team_member_3['image']); ?>" alt="<?php echo esc_attr($team_member_3['name']); ?>" />
                    <div class="frame-101-1">
                        <div class="team-member-title-1 inter-semi-bold-salem-14px"><?php echo esc_html($team_member_3['title']); ?></div>
                        <div class="name-1 inter-semi-bold-mirage-32px"><?php echo esc_html($team_member_3['name']); ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="act-now-1 act-now">
            <div class="frame-35-1">
                <div class="frame-34-1">
                    <div class="act-now-2 act-now subtitle-2"><?php echo esc_html($cta_subtitle); ?></div>
                    <div class="frame-5-1">
                        <div class="be-the-change-1 librebaskerville-normal-mirage-64px">
                            <span class="librebaskerville-normal-mirage-64px"><?php echo esc_html($cta_title_first); ?> </span>
                            <span class="librebaskerville-normal-mirage-64px-2"><?php echo esc_html($cta_title_second); ?></span>
                        </div>
                        <p class="your-support-is-the-1 body-2-regular">
                            <?php echo wp_kses_post($cta_content); ?>
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
            <img class="image-5" src="<?php echo esc_url($cta_image); ?>" alt="Be The Change" />
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
            mobileHero.style.backgroundImage = 'url(<?php echo esc_url(forestplanet_get_field('about_hero_image', null, get_template_directory_uri() . '/assets/images/hero-about-low.webp')); ?>)';
        }
        
        const desktopHero = document.querySelector('.about-desktop-all-breakpoints .hero-1');
        if (desktopHero) {
            desktopHero.style.backgroundImage = 'url(<?php echo esc_url(forestplanet_get_field('about_hero_image', null, get_template_directory_uri() . '/assets/images/hero-about-low.webp')); ?>)';
        }
        
        // Initialize image modal for timeline images
        if (typeof window.initImageModal === 'function') {
            window.initImageModal();
        } else {
            // Fallback initialization if the global function isn't available
            const timelineImages = document.querySelectorAll('.story-image');
            if (timelineImages.length > 0) {
                // Make sure images have pointer cursor
                timelineImages.forEach(img => {
                    img.style.cursor = 'pointer';
                    
                    // Add click event to open image in a new tab as last resort fallback
                    img.addEventListener('click', function() {
                        // If modal script failed to load, at least make the image clickable
                        if (typeof window.initImageModal !== 'function') {
                            window.open(this.src, '_blank');
                        }
                    });
                });
                
                console.log('Timeline images found:', timelineImages.length);
            } else {
                console.log('No timeline images found with story-image class');
            }
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
            
            var cards = container.querySelectorAll('.frame-183-item');
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
            highResImage.src = '<?php echo esc_url(forestplanet_get_field('about_hero_image', null, get_template_directory_uri() . '/assets/images/hero-about.webp')); ?>';
            
            // When the high-resolution image is loaded, update the hero banners
            highResImage.onload = function() {
                // Update desktop hero
                const desktopHero = document.querySelector('.about-desktop-all-breakpoints .hero-1');
                if (desktopHero) {
                    desktopHero.style.backgroundImage = 'url(<?php echo esc_url(forestplanet_get_field('about_hero_image', null, get_template_directory_uri() . '/assets/images/hero-about.webp')); ?>)';
                }
                
                // Update mobile hero
                const mobileHero = document.querySelector('.about-mobile .hero');
                if (mobileHero) {
                    mobileHero.style.backgroundImage = 'url(<?php echo esc_url(forestplanet_get_field('about_hero_image', null, get_template_directory_uri() . '/assets/images/hero-about.webp')); ?>)';
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

<!-- Ensure image modal script is loaded -->
<script src="<?php echo esc_url(get_template_directory_uri() . '/assets/js/image-modal.js'); ?>"></script>

<!-- Custom script to initialize timeline images -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Special handling for timeline images
    function initTimelineImages() {
        // Wait a moment to ensure the main image modal script has loaded
        setTimeout(function() {
            console.log("Initializing timeline images");
            
            // Get all timeline images
            const timelineImages = document.querySelectorAll('.story-image, .story-image');
            
            if (timelineImages.length === 0) {
                console.log("No timeline images found with specific selectors");
                
                // Try with more general selectors
                const allStoryImages = document.querySelectorAll('.story-image');
                console.log("Found", allStoryImages.length, "story images in total");
                
                // If images are found but not initialized, initialize them manually
                if (allStoryImages.length > 0 && typeof window.initImageModal === 'function') {
                    console.log("Manually initializing all story images");
                    window.initImageModal();
                }
                
                return;
            }
            
            console.log("Found", timelineImages.length, "timeline images");
            
            // Ensure they have the pointer cursor and proper styling
            timelineImages.forEach(img => {
                img.style.cursor = 'pointer';
                
                // Add a direct click handler that invokes the image modal
                img.addEventListener('click', function(e) {
                    console.log("Timeline image clicked:", this.src);
                    
                    // Fallback if the modal script didn't load
                    if (typeof window.initImageModal !== 'function') {
                        console.log("Modal script not found, opening in new tab");
                        window.open(this.src, '_blank');
                        return;
                    }
                    
                    // If the modal exists but the click handler wasn't attached properly
                    const modal = document.getElementById('imageModal');
                    if (!modal) {
                        console.log("Creating modal element");
                        if (typeof createModalElement === 'function') {
                            createModalElement();
                        } else {
                            console.log("createModalElement not found");
                            window.open(this.src, '_blank');
                            return;
                        }
                    }
                    
                    // Try to manually trigger the modal functionality
                    e.stopPropagation();
                });
            });
        }, 500); // Wait 500ms to ensure scripts are loaded
    }
    
    // Run the function on page load
    initTimelineImages();
    
    // Also run it on window load event
    window.addEventListener('load', initTimelineImages);
});
</script>

<?php
get_footer(); 