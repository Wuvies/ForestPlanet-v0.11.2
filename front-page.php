<?php
/**
 * The front page template file
 *
 * This is the template for the site's home page when using a static front page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ForestPlanet
 */

get_header();
?>

<!-- Mobile view -->
<div class="landing-mobile screen">
    <div class="main-content">
        <div class="hero">
            <div class="frame-112">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/FP-Logomark-RGB.svg" class="rgb-logo-small" alt="Logo Mark 1">
                <div class="frame-1">
                    <h1 class="plant-a-tree-for-just-15 librebaskerville-normal-mirage-48px">Plant a Tree For Just 15¢</h1>
                    <p class="forest-pla body-2-regular">
                        Welcome to ForestPlanet, a growing organization making low-cost reforestation accessible and impactful.
                        We plant trees where they create the most benefit—restoring soil, revitalizing habitats, and uplifting
                        communities.
                    </p>
                </div>
                <div class="frame-113">
                    <a href="<?php echo esc_url(home_url('/donate')); ?>" class="primary-button-salem primary-button">
                        <div class="primary-button-romance-text body-2-regular">Donate</div>
                    </a>
                    <a href="<?php echo esc_url(home_url('/partner')); ?>" class="secondary-button-salem secondary-button">
                        <div class="secondary-button-salem secondary-button secondary-button-salem-text body-2-regular">Partner</div>
                    </a>
                </div>
            </div>
            <img class="hero-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-image.webp" alt="hero-image" />
        </div>
        <div class="main-content-item">
            <div class="frame-274">
                <div class="what-we-do subtitle-2">WHAT WE DO</div>
                <div class="plant-trees-plant-hope librebaskerville-normal-mirage-48px">
                    <span class="span librebaskerville-normal-mirage-48px">Plant </span>
                    <span class="span librebaskerville-normal-mirage-48px-2">Trees, </span>
                    <span class="span librebaskerville-normal-mirage-48px">Plant </span>
                    <span class="span librebaskerville-normal-mirage-48px-2">Hope</span>
                </div>
            </div>
            <div class="frame-275">
                <img class="tanzania-fp-sign" src="<?php echo get_template_directory_uri(); ?>/assets/images/Tanzania FP Sign.png" alt="Tanzania FP Sign" />
                <div class="frame">
                    <p class="we-channel-support-f body-2-regular">
                        We channel support from businesses, individuals, and foundations to cost-effective tree-planting
                        projects. These efforts restore habitats, improve soil, capture carbon, and uplift communities.<br /><br />Through
                        reforestation, we help secure income, food, and hope for many. Trees enrich soil, preserve water, and
                        foster biodiversity.<br /><br />We proudly partner with visionary organizations to create lasting
                        impact. Join us in transforming lives and ecosystems through trees.
                    </p>
                    <div class="frame-113">
                        <a href="<?php echo esc_url(home_url('/donate')); ?>" class="primary-button-salem primary-button">
                            <div class="primary-button-romance-text body-2-regular">Donate</div>
                        </a>
                        <a href="<?php echo esc_url(home_url('/partner')); ?>" class="secondary-button-salem secondary-button">
                            <div class="secondary-button-salem secondary-button secondary-button-salem-text body-2-regular">Partner</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="impact-metrics impact">
            <div class="our-impact subtitle-2">OUR IMPACT</div>
            <div class="frame-119">
                <?php
                // Impact metrics
                $impact_metrics = array(
                    array('number' => '1.4m', 'label' => 'Trees', 'class' => 'x14m'),
                    array('number' => '3', 'label' => 'Countries', 'class' => 'number-4'),
                    array('number' => '10', 'label' => 'Partners', 'class' => 'number-4'),
                    array('number' => '5', 'label' => 'Projects', 'class' => 'number-4')
                );

                foreach ($impact_metrics as $metric) :
                ?>
                <div class="frame-11">
                    <div class="<?php echo esc_attr($metric['class']); ?> heading-2"><?php echo esc_html($metric['number']); ?></div>
                    <div class="<?php echo esc_attr(strtolower($metric['label'])); ?> body-2-regular"><?php echo esc_html($metric['label']); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="map">
            <div class="frame-274">
                <div class="where-weve-been where-weve subtitle-2">WHERE WE'VE BEEN</div>
                <div class="where-weve-impacted where-weve librebaskerville-normal-mirage-48px">
                    <span class="span librebaskerville-normal-mirage-48px">Where We've </span>
                    <span class="span librebaskerville-normal-mirage-48px-2">Impacted</span>
                </div>
            </div>
            <div id="map-mobile"></div>
        </div>
        <div class="featured-posts">
            <div class="frame-127-1">
                <div class="join-the-conversation subtitle-2">JOIN THE CONVERSATION</div>
                <div class="featured-posts-1 librebaskerville-normal-mirage-48px">Featured Posts</div>
            </div>
            <div class="frame-420">
                <div class="x-embed">
                    <!-- Instagram embed - Updated embed code -->
                    <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DCU3zEMyHaM/" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:calc(100% - 2px);">
                        <div style="padding:16px;">
                            <a href="https://www.instagram.com/p/DCU3zEMyHaM/" style="background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank">
                                <div style="display: flex; flex-direction: row; align-items: center;">
                                    <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div>
                                    <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                                        <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div>
                                        <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div>
                                    </div>
                                </div>
                                <div style="padding: 19% 0;"></div>
                                <div style="display:block; height:50px; margin:0 auto 12px; width:50px;">
                                    <svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                                                <g>
                                                    <path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div style="padding-top: 8px;">
                                    <div style="color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div>
                                </div>
                                <div style="padding: 12.5% 0;"></div>
                                <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                                    <div>
                                        <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div>
                                        <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div>
                                        <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div>
                                    </div>
                                    <div style="margin-left: 8px;">
                                        <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div>
                                        <div style="width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div>
                                    </div>
                                    <div style="margin-left: auto;">
                                        <div style="width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div>
                                        <div style="background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div>
                                        <div style="width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div>
                                    </div>
                                </div>
                                <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                                    <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div>
                                    <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div>
                                </div>
                            </a>
                            <p style="color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">
                                <a href="https://www.instagram.com/p/DCU3zEMyHaM/" style="color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by ForestPlanet (@forestplanetorg)</a>
                            </p>
                        </div>
                    </blockquote>
                    <script async src="https://www.instagram.com/embed.js"></script>
                </div>
                <div class="x-embed-1">
                    <!-- YouTube embeds - Updated embed code -->
                    <div class="youtube-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/dBT04Iw3fy8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="youtube-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/S8fYxcD3RyU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="problem-solved">
            <div class="frame-87">
                <div class="frame-2">
                    <div class="see-the-difference subtitle-2">SEE THE DIFFERENCE</div>
                    <div class="problem-solved-1 librebaskerville-normal-romance-48px">
                        <span class="span librebaskerville-normal-romance-48px">Problem? </span>
                        <span class="span1">Solved.</span>
                    </div>
                </div>
                <p class="before-degraded-lan inter-bold-romance-18px">
                    <span class="inter-bold-romance-18px">Before:</span>
                    <span class="span-2 body-2-regular"> Degraded landscapes, barren soils, and disappearing wildlife.</span>
                    <span class="inter-bold-romance-18px">After:</span>
                    <span class="span-2 body-2-regular">
                        Flourishing forests, enriched soil, vibrant habitats, and cleaner air.<br /><br />Every tree planted
                        turns desolation into life, combating climate change and creating a healthier, greener planet for future
                        generations.
                    </span>
                </p>
            </div>
            <div class="before-after">
                <div class="comparison" onmousemove="moveDivisor(event, this)">
                    <figure>
                        <div class="divisor"></div>
                    </figure>
                </div>
            </div>
        </div>
        <div class="our-partners-section">
            <div class="partners-1">
                <div class="frame-323">
                    <div class="our-partners librebaskerville-normal-mirage-48px">Our Partners</div>
                </div>
            </div>
            <section class="scrolling-cards-wrapper" aria-label="Scrolling Partner Logos">
                <div class="scrolling-track">
                    <div class="scrolling-group">
                        <?php
                        // Query partners for carousel
                        $partner_args = array(
                            'post_type' => 'partner',
                            'posts_per_page' => 12,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'meta_query' => array(
                                array(
                                    'key' => 'partner_is_foundation',
                                    'value' => '1',
                                    'compare' => '!=',
                                ),
                            ),
                        );
                        
                        $partners_query = new WP_Query($partner_args);
                        
                        if ($partners_query->have_posts()) :
                            while ($partners_query->have_posts()) : $partners_query->the_post();
                                $partner_id = get_the_ID();
                                $partner_url = get_field('partner_website', $partner_id);
                                $logo_url = has_post_thumbnail($partner_id) ? get_the_post_thumbnail_url($partner_id, 'medium') : '';
                                $target = !empty($partner_url) ? ' target="_blank" rel="noopener noreferrer"' : '';
                                $href = !empty($partner_url) ? esc_url($partner_url) : esc_url(get_post_type_archive_link('partner'));
                                ?>
                                <a href="<?php echo $href; ?>"<?php echo $target; ?> class="partner-card" aria-label="Visit <?php echo esc_attr(get_the_title()); ?> website">
                                    <?php if (!empty($logo_url)) : ?>
                                        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?> logo" />
                                    <?php else : ?>
                                        <div class="partner-card-no-logo">
                                            <?php echo esc_html(get_the_title()); ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            // Fallback if no partners are found
                            $partner_logos = array(
                                '5d-vision-logo.svg',
                                'dov-jewelry-logo.svg',
                                'full-sail-media-logo.svg',
                                'holistic-spirits-logo.svg',
                                'magical-journeys-beyond-logo.svg',
                                'neighborhood-sun-logo.svg',
                                'ohana-logo.svg',
                                'pepper-medical-logo.svg',
                                'sign-hero-logo.svg',
                                'sustainable-you-logo.svg',
                                'swarmbustin-honey-logo.svg',
                                'vizcaya-swimwear-logo.svg',
                                'wyld-coffee-logo.svg'
                            );

                            foreach ($partner_logos as $logo) :
                            ?>
                            <article class="partner-card">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/partner-logos/<?php echo esc_attr($logo); ?>" alt="Partner logo" />
                            </article>
                            <?php endforeach;
                        endif; ?>
                    </div>
                    <div class="scrolling-group" aria-hidden="true">
                        <?php 
                        // Repeat the partners for infinite scrolling effect
                        if ($partners_query->have_posts()) :
                            $partners_query->rewind_posts();
                            while ($partners_query->have_posts()) : $partners_query->the_post();
                                $partner_id = get_the_ID();
                                $partner_url = get_field('partner_website', $partner_id);
                                $logo_url = has_post_thumbnail($partner_id) ? get_the_post_thumbnail_url($partner_id, 'medium') : '';
                                $target = !empty($partner_url) ? ' target="_blank" rel="noopener noreferrer"' : '';
                                $href = !empty($partner_url) ? esc_url($partner_url) : esc_url(get_post_type_archive_link('partner'));
                                ?>
                                <a href="<?php echo $href; ?>"<?php echo $target; ?> class="partner-card" aria-label="Visit <?php echo esc_attr(get_the_title()); ?> website">
                                    <?php if (!empty($logo_url)) : ?>
                                        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?> logo" />
                                    <?php else : ?>
                                        <div class="partner-card-no-logo">
                                            <?php echo esc_html(get_the_title()); ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            foreach ($partner_logos as $logo) : ?>
                            <article class="partner-card">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/partner-logos/<?php echo esc_attr($logo); ?>" alt="Partner logo" />
                            </article>
                            <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </section>
            <div class="partners-1">
                <a href="<?php echo esc_url(get_post_type_archive_link('partner')); ?>">
                    <div class="tertiary-button">
                        <div class="default-5 default-18 body-2-regular">See All</div>
                        <img class="icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/chevron-small.svg" alt="Icon" />
                    </div>
                </a>
            </div>
        </div>
        <div class="support-drives-impact">
            <div class="frame-416">
                <div class="our-1 librebaskerville-normal-mirage-48px">
                    <span class="span librebaskerville-normal-mirage-48px">How Your </span>
                    <span class="span librebaskerville-normal-mirage-48px-2">Support<br /></span>
                    <span class="span librebaskerville-normal-mirage-48px">Drives Impact</span>
                </div>
                <div class="impact-graphic impact">
                    <?php
                    // Impact steps
                    $impact_steps = array(
                        array(
                            'number' => '1',
                            'title' => 'Funding Tree Planting Projects',
                            'description' => 'Your donations directly fund large-scale tree planting initiatives with proven success across the globe.',
                            'image' => 'impact-img-1.jpg',
                            'img_class' => 'impact-img-1-1'
                        ),
                        array(
                            'number' => '2',
                            'title' => 'Supporting Local Communities',
                            'description' => 'Contributions create jobs, improve food security, and generate hope for communities living on the edge of poverty.',
                            'image' => 'impact-img-2.jpg',
                            'img_class' => 'impact-img-2-1'
                        ),
                        array(
                            'number' => '3',
                            'title' => 'Restoring Ecosystems',
                            'description' => 'Each tree planted helps restore wildlife habitats, enrich soils, and combat climate change through carbon sequestration.',
                            'image' => 'impact-img-3.jpg',
                            'img_class' => 'impact-img-3-1'
                        ),
                        array(
                            'number' => '4',
                            'title' => 'Long-Term Sustainability',
                            'description' => 'Your participation fuels ongoing projects that ensure long-lasting environmental and social benefits, making a lasting difference.',
                            'image' => 'impact-img-4.jpg',
                            'img_class' => 'impact-img-4-1'
                        )
                    );

                    foreach ($impact_steps as $index => $step) :
                        if ($index > 0) :
                            echo '<object class="vector' . ($index === 1 || $index === 3 ? '-2' : '') . '" data="' . get_template_directory_uri() . '/assets/images/impact-vector-mobile-1.svg" type="image/svg+xml" alt="Vector"></object>';
                        endif;
                    ?>
                    <div class="frame-28">
                        <img class="<?php echo esc_attr($step['img_class']); ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/<?php echo esc_attr($step['image']); ?>" alt="Rectangle 26" />
                        <div class="frame-2-1 frame-2-3">
                            <div class="number heading-2"><?php echo esc_html($step['number']); ?></div>
                            <div class="frame-19">
                                <div class="<?php echo sanitize_title($step['title']); ?> subtitle-1"><?php echo esc_html($step['title']); ?></div>
                                <p class="<?php echo sanitize_title($step['description'], '', 'save'); ?> body-2-regular">
                                    <?php echo esc_html($step['description']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="frame-113">
                    <a href="<?php echo esc_url(home_url('/donate')); ?>" class="primary-button-salem primary-button">
                        <div class="primary-button-romance-text body-2-regular">Donate</div>
                    </a>
                    <a href="<?php echo esc_url(home_url('/partner')); ?>" class="secondary-button-salem secondary-button">
                        <div class="secondary-button-salem secondary-button secondary-button-salem-text body-2-regular">Partner</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="main-content-item-1">
            <div class="frame-127">
                <div class="what-people-are-saying subtitle-2">WHAT PEOPLE ARE SAYING</div>
                <div class="testimonials librebaskerville-normal-mirage-48px">Testimonials</div>
            </div>
            <div class="frame-326">
                <?php
                // Testimonials
                $testimonials = array(
                    array(
                        'name' => 'Person Name - Partner',
                        'quote' => 'Partnering with this initiative has been incredible. Every tree planted is not just a step toward a greener planet, but a step toward hope for countless communities. It\'s rewarding to see tangible change.'
                    ),
                    array(
                        'name' => 'Person Name - Partner',
                        'quote' => 'Partnering with this initiative has been incredible. Every tree planted is not just a step toward a greener planet, but a step toward hope for countless communities. It\'s rewarding to see tangible change.'
                    )
                );

                foreach ($testimonials as $index => $testimonial) :
                ?>
                <div class="frame-<?php echo $index === 0 ? '468' : '469'; ?>">
                    <div class="testimonial-card">
                        <div class="frame-129">
                            <div class="frame-128">
                                <div class="avatar"></div>
                                <div class="person-name-partner body-2-semibold"><?php echo esc_html($testimonial['name']); ?></div>
                            </div>
                        </div>
                        <div class="frame-3">
                            <img class="quote-opening" src="<?php echo get_template_directory_uri(); ?>/assets/images/quote-opening.svg" alt="quote opening" />
                            <p class="partnering-with-this body-2-regular"><?php echo esc_html($testimonial['quote']); ?></p>
                            <img class="quote-closing" src="<?php echo get_template_directory_uri(); ?>/assets/images/quote-closing.svg" alt="quote closing" />
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="get-involved">
            <div class="get-involved-1 get-involved-3 librebaskerville-normal-romance-48px">Get Involved</div>
            <div class="frame-28-1">
                <?php
                // Get involved options
                $involvement_options = array(
                    array(
                        'for' => 'FOR BUSINESSES',
                        'title' => 'Partner',
                        'description' => 'Show your commitment to sustainability by partnering with us. Together, we can drive environmental restoration and social change.',
                        'link' => 'partner',
                        'button_text' => 'Partner'
                    ),
                    array(
                        'for' => 'FOR INDIVIDUALS',
                        'title' => 'Donate',
                        'description' => 'Every dollar plants trees, restores ecosystems, and supports communities in need. Your contribution makes an immediate and lasting impact.',
                        'link' => 'donate',
                        'button_text' => 'Donate'
                    ),
                    array(
                        'for' => 'FOR BUSINESSES',
                        'title' => 'Invite Us',
                        'description' => 'Invite us to your event to share insights on how reforestation combats climate change and uplifts communities.',
                        'link' => 'invite-us',
                        'button_text' => 'Invite'
                    )
                );

                foreach ($involvement_options as $index => $option) :
                    // Add line between items except before the first one
                    if ($index > 0) :
                        echo '<hr class="line-romance" />';
                    endif;
                ?>
                <div class="frame-2-2 frame-2-3">
                    <div class="frame-24">
                        <div class="for subtitle-2"><?php echo esc_html($option['for']); ?></div>
                        <div class="<?php echo sanitize_title($option['title']); ?> heading-3"><?php echo esc_html($option['title']); ?></div>
                        <p class="<?php echo sanitize_title($option['description'], '', 'save'); ?> body-2-regular">
                            <?php echo esc_html($option['description']); ?>
                        </p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/' . $option['link'])); ?>">
                        <div class="secondary-button-romance secondary-button">
                            <div class="secondary-button-romance-text body-2-regular"><?php echo esc_html($option['button_text']); ?></div>
                            <img class="chevron-right-7" src="<?php echo get_template_directory_uri(); ?>/assets/images/chevron-right-romance.svg" alt="Chevron Right" />
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="our-stories-section">
            <div class="our-stories">
                <div class="our librebaskerville-normal-mirage-48px">Our Stories</div>
            </div>
            <div class="story-cards">
                <?php
                // Get recent stories from the story custom post type
                $recent_stories = new WP_Query(array(
                    'post_type' => 'story',
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'post_status' => 'publish'
                ));

                if ($recent_stories->have_posts()) :
                    while ($recent_stories->have_posts()) : $recent_stories->the_post();
                        $post_date = get_the_date('M d Y');
                        $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: get_template_directory_uri() . '/assets/images/rectangle-18@2x.png';
                ?>
                <a href="<?php the_permalink(); ?>">
                    <article class="story-card">
                        <img class="story-card-image" src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                        <div class="story-card-content">
                            <div class="story-card-date subtitle-2"><?php echo esc_html(strtoupper($post_date)); ?></div>
                            <p class="story-card-title body-1-semibold"><?php echo esc_html(get_the_title()); ?></p>
                            <p class="story-card-description body-2-regular">
                                <?php echo esc_html(wp_trim_words(get_the_excerpt(), 12)); ?>
                            </p>
                        </div>
                    </article>
                </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback content if no stories are found
                    for ($i = 0; $i < 3; $i++) :
                ?>
                <article class="story-card">
                    <img class="story-card-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/rectangle-18@2x.png" alt="Story placeholder" />
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
            <div class="stories-button">
                <a href="<?php echo esc_url(get_post_type_archive_link('story')); ?>">
                    <div class="tertiary-button">
                        <div class="default-3 default-18 body-2-regular">See More</div>
                        <img class="icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/chevron-small.svg" alt="Icon" />
                    </div>
                </a>
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
                    <a href="<?php echo esc_url(home_url('/donate')); ?>" class="primary-button-salem primary-button">
                        <div class="primary-button-romance-text body-2-regular">Donate</div>
                    </a>
                    <a href="<?php echo esc_url(home_url('/partner')); ?>" class="secondary-button-salem secondary-button">
                        <div class="secondary-button-salem secondary-button secondary-button-salem-text body-2-regular">Partner</div>
                    </a>
                </div>
            </div>
            <img class="image-2" src="<?php echo get_template_directory_uri(); ?>/assets/images/be-the-change.png" alt="Be the change" />
        </div>
    </div>
</div>

<!-- Desktop view -->
<div class="landing-desktop-all-breakpoints screen">
    <div class="main-content-1">
        <div class="hero-1">
            <div class="frame-112-1">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/FP-Logomark-RGB.svg" class="rgb-logo-large" alt="Logo Mark 1">
                <div class="frame-114">
                    <h1 class="plant-a-tree-for-just-15-1">
                        <span class="span-3 librebaskerville-normal-mirage-64px">Plant a Tree For </span>
                        <span class="span-3 librebaskerville-normal-mirage-64px-2">Just 15¢</span>
                    </h1>
                    <p class="welcome-to-forest-pla body-2-regular">
                        Welcome to ForestPlanet, a growing organization making low-cost reforestation accessible and impactful.
                        We plant trees where they create the most benefit—restoring soil, revitalizing habitats, and uplifting
                        communities.
                    </p>
                </div>
                <div class="frame-113-2">
                    <a href="<?php echo esc_url(home_url('/donate')); ?>" class="primary-button-salem primary-button">
                        <div class="primary-button-salem primary-button primary-button-romance-text body-2-regular">Donate</div>
                    </a>
                    <a href="<?php echo esc_url(home_url('/partner')); ?>" class="secondary-button-salem secondary-button">
                        <div class="secondary-button-salem secondary-button secondary-button-salem-text body-2-regular">Partner</div>
                    </a>
                </div>
            </div>
            <img class="hero-image bp2-animate-enter" src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-image.webp" alt="hero image" />
        </div>
        
        <div class="plant-hope">
            <div class="frame-1-1">
                <div class="what-we-do-1 subtitle-2">WHAT WE DO</div>
                <div class="plant-trees-plant-hope-1 librebaskerville-normal-mirage-64px">
                    <span class="span-3 librebaskerville-normal-mirage-64px">Plant </span>
                    <span class="span-3 librebaskerville-normal-mirage-64px-2">Trees, </span>
                    <span class="span-3 librebaskerville-normal-mirage-64px">Plant </span>
                    <span class="span-3 librebaskerville-normal-mirage-64px-2">Hope</span>
                </div>
            </div>
            <div class="frame-123">
                <img class="tanzania-fp-sign bp2-animate-enter1" show-on-scroll src="<?php echo get_template_directory_uri(); ?>/assets/images/Tanzania FP Sign.png" alt="Tanzania FP Sign" />
                <div class="frame-122">
                    <p class="we-channel-support-f-1 body-2-regular">
                        We channel support from businesses, individuals, and foundations to cost-effective tree-planting
                        projects. These efforts restore habitats, improve soil, capture carbon, and uplift communities.<br /><br />Through
                        reforestation, we help secure income, food, and hope for many. Trees enrich soil, preserve water, and
                        foster biodiversity.<br /><br />We proudly partner with visionary organizations to create lasting
                        impact. Join us in transforming lives and ecosystems through trees.
                    </p>
                <div class="frame-113-2">
                    <a href="<?php echo esc_url(home_url('/donate')); ?>" class="primary-button-salem primary-button">
                        <div class="primary-button-salem primary-button primary-button-romance-text body-2-regular">Donate</div>
                    </a>
                    <a href="<?php echo esc_url(home_url('/partner')); ?>" class="secondary-button-salem secondary-button">
                        <div class="secondary-button-salem secondary-button secondary-button-salem-text body-2-regular">Partner</div>
                    </a>
                </div>
                </div>
            </div>
        </div>
        
        <div class="impact-metrics-1">
            <div class="our-impact-1 subtitle-2">OUR IMPACT</div>
            <div class="metric-cards metric">
                <?php foreach ($impact_metrics as $metric) : ?>
                <div class="metric-card metric">
                    <div class="<?php echo esc_attr($metric['class']); ?> heading-2"><?php echo esc_html($metric['number']); ?></div>
                    <div class="<?php echo esc_attr(strtolower($metric['label'])); ?>-1 body-2-regular"><?php echo esc_html($metric['label']); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="map-1">
            <div class="frame-121">
                <div class="where-weve-been-1 subtitle-2">WHERE WE'VE BEEN</div>
                <div class="where-weve-impacted-1 librebaskerville-normal-mirage-64px">
                    <span class="span-3 librebaskerville-normal-mirage-64px">Where We've </span>
                    <span class="span-3 librebaskerville-normal-mirage-64px-2">Impacted</span>
                </div>
            </div>
            <div id="map-desktop"></div>
        </div>
        
        <div class="featured-posts-2">
            <div class="featured-posts-heading">
                <div class="join-the-conversation-1 subtitle-2">JOIN THE CONVERSATION</div>
                <div class="featured-posts-3 librebaskerville-normal-mirage-64px">Featured Posts</div>
            </div>
            <div class="frame-418">
                <div class="x-embed">
                    <!-- Instagram embed - Updated embed code -->
                    <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DCU3zEMyHaM/" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:calc(100% - 2px);">
                        <div style="padding:16px;">
                            <a href="https://www.instagram.com/p/DCU3zEMyHaM/" style="background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank">
                                <div style="display: flex; flex-direction: row; align-items: center;">
                                    <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div>
                                    <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                                        <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div>
                                        <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div>
                                    </div>
                                </div>
                                <div style="padding: 19% 0;"></div>
                                <div style="display:block; height:50px; margin:0 auto 12px; width:50px;">
                                    <svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                                                <g>
                                                    <path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div style="padding-top: 8px;">
                                    <div style="color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div>
                                </div>
                                <div style="padding: 12.5% 0;"></div>
                                <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                                    <div>
                                        <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div>
                                        <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div>
                                        <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div>
                                    </div>
                                    <div style="margin-left: 8px;">
                                        <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div>
                                        <div style="width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div>
                                    </div>
                                    <div style="margin-left: auto;">
                                        <div style="width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div>
                                        <div style="background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div>
                                        <div style="width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div>
                                    </div>
                                </div>
                                <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                                    <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div>
                                    <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div>
                                </div>
                            </a>
                            <p style="color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">
                                <a href="https://www.instagram.com/p/DCU3zEMyHaM/" style="color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by ForestPlanet (@forestplanetorg)</a>
                            </p>
                        </div>
                    </blockquote>
                    <script async src="https://www.instagram.com/embed.js"></script>
                </div>
                <div class="x-embed-1">
                    <!-- YouTube embeds - Updated embed code -->
                    <div class="youtube-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/dBT04Iw3fy8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="youtube-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/S8fYxcD3RyU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="problem-solved-2">
            <div class="frame-87-1">
                <div class="frame-1-1">
                    <div class="see-the-difference-1 subtitle-2">SEE THE DIFFERENCE</div>
                    <div class="problem-solved-3 problem-solved librebaskerville-normal-romance-64px">
                        <span class="span-3 librebaskerville-normal-romance-64px">Problem? </span>
                        <span class="span1-1">Solved.</span>
                    </div>
                </div>
                <p class="before-degraded-lan-1 inter-bold-romance-18px">
                    <span class="inter-bold-romance-18px">Before:</span>
                    <span class="span-5 body-2-regular"> Degraded landscapes, barren soils, and disappearing wildlife.</span>
                    <span class="inter-bold-romance-18px"><br>After:</span>
                    <span class="span-5 body-2-regular">
                        Flourishing forests, enriched soil, vibrant habitats, and cleaner air.<br /><br />Every tree planted
                        turns desolation into life, combating climate change and creating a healthier, greener planet for future
                        generations.
                    </span>
                </p>
            </div>
            <div class="before-after-1">
                <div class="comparison" onmousemove="moveDivisor(event, this)">
                    <figure>
                        <div class="divisor"></div>
                    </figure>
                </div>
            </div>
        </div>
        
        <div class="our-partners-section-1">
            <div class="partners-2">
                <div class="frame-456">
                    <div class="our-partners-1 librebaskerville-normal-mirage-64px">Our Partners</div>
                </div>
            </div>
            <section class="scrolling-cards-wrapper" aria-label="Scrolling Partner Logos">
                <div class="scrolling-track">
                    <div class="scrolling-group">
                        <div class="scrolling-set">
                            <?php
                            // Query partners for carousel (desktop)
                            $partner_args = array(
                                'post_type' => 'partner',
                                'posts_per_page' => 12,
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'meta_query' => array(
                                    array(
                                        'key' => 'partner_is_foundation',
                                        'value' => '1',
                                        'compare' => '!=',
                                    ),
                                ),
                            );
                            
                            $partners_query = new WP_Query($partner_args);
                            
                            if ($partners_query->have_posts()) :
                                while ($partners_query->have_posts()) : $partners_query->the_post();
                                    $partner_id = get_the_ID();
                                    $partner_url = get_field('partner_website', $partner_id);
                                    $logo_url = has_post_thumbnail($partner_id) ? get_the_post_thumbnail_url($partner_id, 'medium') : '';
                                    $target = !empty($partner_url) ? ' target="_blank" rel="noopener noreferrer"' : '';
                                    $href = !empty($partner_url) ? esc_url($partner_url) : esc_url(get_post_type_archive_link('partner'));
                                    ?>
                                    <a href="<?php echo $href; ?>"<?php echo $target; ?> class="partner-card" aria-label="Visit <?php echo esc_attr(get_the_title()); ?> website">
                                        <?php if (!empty($logo_url)) : ?>
                                            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?> logo" />
                                        <?php else : ?>
                                            <div class="partner-card-no-logo">
                                                <?php echo esc_html(get_the_title()); ?>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                // Fallback if no partners are found
                                foreach ($partner_logos as $logo) : ?>
                                <article class="partner-card">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/partner-logos/<?php echo esc_attr($logo); ?>" alt="Partner logo" />
                                </article>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                    <div class="scrolling-group" aria-hidden="true">
                        <div class="scrolling-set">
                            <?php
                            // Repeat the partners for infinite scrolling effect (desktop)
                            if ($partners_query->have_posts()) :
                                $partners_query->rewind_posts();
                                while ($partners_query->have_posts()) : $partners_query->the_post();
                                    $partner_id = get_the_ID();
                                    $partner_url = get_field('partner_website', $partner_id);
                                    $logo_url = has_post_thumbnail($partner_id) ? get_the_post_thumbnail_url($partner_id, 'medium') : '';
                                    $target = !empty($partner_url) ? ' target="_blank" rel="noopener noreferrer"' : '';
                                    $href = !empty($partner_url) ? esc_url($partner_url) : esc_url(get_post_type_archive_link('partner'));
                                    ?>
                                    <a href="<?php echo $href; ?>"<?php echo $target; ?> class="partner-card" aria-label="Visit <?php echo esc_attr(get_the_title()); ?> website">
                                        <?php if (!empty($logo_url)) : ?>
                                            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?> logo" />
                                        <?php else : ?>
                                            <div class="partner-card-no-logo">
                                                <?php echo esc_html(get_the_title()); ?>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                foreach ($partner_logos as $logo) : ?>
                                <article class="partner-card">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/partner-logos/<?php echo esc_attr($logo); ?>" alt="Partner logo" />
                                </article>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            <div class="partners-2">
                <a href="<?php echo esc_url(get_post_type_archive_link('partner')); ?>">
                    <div class="tertiary-button-2 tertiary-button">
                        <div class="default-24 default body-2-regular">See All</div>
                        <img class="icon-1" src="<?php echo get_template_directory_uri(); ?>/assets/images/chevron-small.svg" alt="Icon" />
                    </div>
                </a>
            </div>
        </div>
        
        <div class="support-drives-impact-1">
            <div class="frame-415">
                <p class="how-your-support-drives-impact librebaskerville-normal-mirage-64px">
                    <span class="span-3 librebaskerville-normal-mirage-64px">How Your </span>
                    <span class="span-3 librebaskerville-normal-mirage-64px-2">Support </span>
                    <span class="span-3 librebaskerville-normal-mirage-64px">Drives Impact</span>
                </p>
                <div class="impact-graphic-1">
                    <?php foreach ($impact_steps as $index => $step) : ?>
                        <?php if ($index === 0) : ?>
                        <div class="frame-462">
                            <div class="frame-2-3 frame-2">
                                <div class="number-4 number heading-2"><?php echo esc_html($step['number']); ?></div>
                                <div class="frame-19-1">
                                    <div class="<?php echo sanitize_title($step['title']); ?>-1 subtitle-1"><?php echo esc_html($step['title']); ?></div>
                                    <p class="<?php echo sanitize_title($step['description'], '', 'save'); ?>-1 body-2-regular">
                                        <?php echo esc_html($step['description']); ?>
                                    </p>
                                </div>
                            </div>
                            <img class="impact-img-1" src="<?php echo get_template_directory_uri(); ?>/assets/images/<?php echo esc_attr($step['image']); ?>" alt="Rectangle 26" />
                        </div>
                        <object class="vector-1" data="<?php echo get_template_directory_uri(); ?>/assets/images/impact-vector-desktop-1.svg" type="image/svg+xml" alt="Vector 2"></object>
                        <?php elseif ($index === 1) : ?>
                        <div class="frame-46-1 frame-46">
                            <img class="impact-img-2" src="<?php echo get_template_directory_uri(); ?>/assets/images/<?php echo esc_attr($step['image']); ?>" alt="Rectangle 27" />
                            <div class="frame-21">
                                <div class="number-4 number heading-2"><?php echo esc_html($step['number']); ?></div>
                                <div class="frame-19-1">
                                    <div class="<?php echo sanitize_title($step['title']); ?>-1 subtitle-1"><?php echo esc_html($step['title']); ?></div>
                                    <p class="<?php echo sanitize_title($step['description'], '', 'save'); ?>-1 body-2-regular">
                                        <?php echo esc_html($step['description']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <object class="vector-1" data="<?php echo get_template_directory_uri(); ?>/assets/images/impact-vector-desktop-2.svg" type="image/svg+xml" alt="Vector 5"></object>
                        <?php elseif ($index === 2) : ?>
                        <div class="frame-464">
                            <div class="frame-2-3 frame-2">
                                <div class="number-4 number heading-2"><?php echo esc_html($step['number']); ?></div>
                                <div class="frame-19-1">
                                    <div class="<?php echo sanitize_title($step['title']); ?>-1 subtitle-1"><?php echo esc_html($step['title']); ?></div>
                                    <p class="<?php echo sanitize_title($step['description'], '', 'save'); ?>-1 body-2-regular">
                                        <?php echo esc_html($step['description']); ?>
                                    </p>
                                </div>
                            </div>
                            <img class="impact-img-3" src="<?php echo get_template_directory_uri(); ?>/assets/images/<?php echo esc_attr($step['image']); ?>" alt="Rectangle 28" />
                        </div>
                        <object class="vector-1" data="<?php echo get_template_directory_uri(); ?>/assets/images/impact-vector-desktop-3.svg" type="image/svg+xml" alt="Vector 4"></object>
                        <?php else : ?>
                        <div class="frame-46-1 frame-46">
                            <img class="impact-img-4" src="<?php echo get_template_directory_uri(); ?>/assets/images/<?php echo esc_attr($step['image']); ?>" alt="Rectangle 29" />
                            <div class="frame-2-3 frame-2">
                                <div class="number-4 number heading-2"><?php echo esc_html($step['number']); ?></div>
                                <div class="frame-19-1">
                                    <div class="<?php echo sanitize_title($step['title']); ?>-1 subtitle-1"><?php echo esc_html($step['title']); ?></div>
                                    <p class="<?php echo sanitize_title($step['description'], '', 'save'); ?>-1 body-2-regular">
                                        <?php echo esc_html($step['description']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="frame-113-2">
                    <a href="<?php echo esc_url(home_url('/donate')); ?>" class="primary-button-salem primary-button">
                        <div class="primary-button-salem primary-button primary-button-romance-text body-2-regular">Donate</div>
                    </a>
                    <a href="<?php echo esc_url(home_url('/partner')); ?>" class="secondary-button-salem secondary-button">
                        <div class="secondary-button-salem secondary-button secondary-button-salem-text body-2-regular">Partner</div>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="testimonials-1">
            <div class="frame-127-2">
                <div class="what-people-are-saying-1 subtitle-2">WHAT PEOPLE ARE SAYING</div>
                <div class="testimonials-2 librebaskerville-normal-mirage-64px">Testimonials</div>
            </div>
            <div class="frame-15">
                <?php foreach ($testimonials as $index => $testimonial) : ?>
                <div class="frame-<?php echo $index === 0 ? '466' : '467'; ?>">
                    <div class="testimonial-card-1">
                        <div class="frame-128-1">
                            <div class="avatar-1"></div>
                            <div class="person-name-partner body-1-semibold"><?php echo esc_html($testimonial['name']); ?></div>
                        </div>
                        <div class="frame-130">
                            <img class="quote" src="<?php echo get_template_directory_uri(); ?>/assets/images/quote-opening.svg" alt="quote.opening" />
                            <p class="partnering-with-this-1 body-1-regular"><?php echo esc_html($testimonial['quote']); ?></p>
                            <img class="quote" src="<?php echo get_template_directory_uri(); ?>/assets/images/quote-closing.svg" alt="quote.closing" />
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="get-involved-3">
            <div class="get-involved-4 librebaskerville-normal-romance-64px">Get Involved</div>
            <div class="frame-28-2">
                <?php foreach ($involvement_options as $index => $option) : 
                    if ($index > 0) : ?>
                    <hr class="line-romance-vertical" aria-hidden="true" />
                <?php endif; ?>
                <div class="<?php echo $index === 0 ? 'frame-27' : 'frame-2-4 frame-2'; ?>">
                    <div class="frame-24-1">
                        <div class="for-1 subtitle-2"><?php echo esc_html($option['for']); ?></div>
                        <div class="<?php echo sanitize_title($option['title']); ?>-1 heading-3"><?php echo esc_html($option['title']); ?></div>
                        <p class="<?php echo sanitize_title($option['description'], '', 'save'); ?>-1 body-2-regular">
                            <?php echo esc_html($option['description']); ?>
                        </p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/' . $option['link'])); ?>">
                        <div class="secondary-button-romance secondary-button">
                            <div class="secondary-button-romance-text body-2-regular"><?php echo esc_html($option['button_text']); ?></div>
                            <img class="chevron-right" src="<?php echo get_template_directory_uri(); ?>/assets/images/chevron-right-romance.svg" alt="Chevron Right" />
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="our-stories-section">
            <div class="our-stories">
                <div class="our-2 librebaskerville-normal-mirage-64px">Our Stories</div>
            </div>
            <div class="story-cards">
                <?php
                // Get recent stories from the story custom post type (for desktop)
                $recent_stories = new WP_Query(array(
                    'post_type' => 'story',
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'post_status' => 'publish'
                ));

                if ($recent_stories->have_posts()) :
                    while ($recent_stories->have_posts()) : $recent_stories->the_post();
                        $post_date = get_the_date('M d Y');
                        $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: get_template_directory_uri() . '/assets/images/rectangle-18-3@2x.png';
                ?>
                <a href="<?php the_permalink(); ?>">
                    <article class="story-card">
                        <img class="rectangle-18-1" src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                        <div class="frame-55-1">
                            <div class="frame-5-1 frame-5">
                                <div class="feb-1-1 subtitle-2"><?php echo esc_html(strtoupper($post_date)); ?></div>
                                <p class="title-for-story-card-template body-1-semibold"><?php echo esc_html(get_the_title()); ?></p>
                                <p class="story-card-description body-2-regular">
                                    <?php echo esc_html(wp_trim_words(get_the_excerpt(), 12)); ?>
                                </p>
                            </div>
                        </div>
                    </article>
                </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    for ($i = 0; $i < 3; $i++) :
                ?>
                <article class="story-card">
                    <img class="rectangle-18-1" src="<?php echo get_template_directory_uri(); ?>/assets/images/rectangle-18-3@2x.png" alt="Rectangle 18" />
                    <div class="frame-55-1">
                        <div class="frame-5-1 frame-5">
                            <div class="feb-1-1 subtitle-2">FEB 16 2025</div>
                            <p class="title-for-story-card-template body-1-semibold">Title For Story Card Template</p>
                            <p class="story-card-description body-2-regular">
                                Here would contain a brief introduction to the article like the first
                            </p>
                        </div>
                    </div>
                </article>
                <?php
                    endfor;
                endif;
                ?>
            </div>
            <div class="stories-button">
                <a href="<?php echo esc_url(get_post_type_archive_link('story')); ?>">
                    <div class="tertiary-button-2 tertiary-button">
                        <div class="default-22 default body-2-regular">See More</div>
                        <img class="icon-1" src="<?php echo get_template_directory_uri(); ?>/assets/images/chevron-small.svg" alt="Icon" />
                    </div>
                </a>
            </div>
        </div>
        
        <div class="act-now-1 act-now">
            <div class="frame-35-1">
                <div class="frame-34-1">
                    <div class="act-now-2 subtitle-2">ACT NOW</div>
                    <div class="frame-5-2 frame-5">
                        <div class="be-the-change-1 librebaskerville-normal-mirage-64px">
                            <span class="span-3 librebaskerville-normal-mirage-64px">Be The </span>
                            <span class="span-3 librebaskerville-normal-mirage-64px-2">Change</span>
                        </div>
                        <p class="your-support-is-the-1 body-2-regular">
                            Your support is the root of transformation. Every donation, every action, and every partnership helps
                            us plant more trees, restore more ecosystems, and uplift more lives.<br />Donate today to make an
                            immediate impact, or join us as a volunteer or partner to grow a greener, brighter future. Together,
                            we can heal the planet—one tree at a time.
                        </p>
                    </div>
                </div>
                <div class="frame-113-2">
                    <a href="<?php echo esc_url(home_url('/donate')); ?>" class="primary-button-salem primary-button">
                        <div class="primary-button-salem primary-button primary-button-romance-text body-2-regular">Donate</div>
                    </a>
                    <a href="<?php echo esc_url(home_url('/partner')); ?>" class="secondary-button-salem secondary-button">
                        <div class="secondary-button-salem secondary-button secondary-button-salem-text body-2-regular">Partner</div>
                    </a>
                </div>
            </div>
            <img class="image-5" src="<?php echo get_template_directory_uri(); ?>/assets/images/be-the-change.png" alt="image" />
        </div>
    </div>
</div>

<!-- Include JavaScript for functionality -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/overlay-loader.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/mobile-menu-overlay.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/image-comparison.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/google-maps.js"></script>
<style>
    /* Basic styling for each map container */
    #map-mobile, #map-desktop {
        border-radius: var(--border-radius-10, 10px);
        box-shadow: var(--box-shadow-large, 0 4px 8px rgba(0, 0, 0, 0.1));
    }
    
    #map-mobile {
        height: 300px;
        width: 100%;
    }
    
    #map-desktop {
        height: 500px;
        width: 100%;
    }
</style>
<script>
// Initialize map when Google Maps API is loaded
function initMap() {
    // Define locations where ForestPlanet has projects
    const locations = [
        { name: "Khenifra, Morocco", lat: 32.9394, lng: -5.6693 },
        { name: "Pangani Basin, Tanzania", lat: -5.4265, lng: 37.9745 },
        { name: "Mozambique Channel, Madagascar", lat: -20.0000, lng: 45.3000 }
    ];

    // Get theme color for markers (or use a default)
    const markerColor = getComputedStyle(document.documentElement).getPropertyValue('--fuchsia-blue').trim() || '#765BA7';
    
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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSmeebBc_qKg-lMWboxtSLB9qYFVi2Fc4&callback=initMap" async defer></script>

<?php get_footer(); ?> 