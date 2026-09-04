<?php
/**
 * Renders the standardized layout for web and app service templates.
 * Redesigned: Hosting-style dark theme, Bulma CSS, no border-radius,
 * Why Choose Us section, cartoon GIFs, inline highlights.
 * Updated: Animated red wave mesh canvas background (Atompoint-style).
 * v3: Packages carousel for 4+ packages; static grid for 3 or fewer.
 *     Carousel cards use hosting-style layout (badge, price block, feature list, CTA strip).
 */

/**
 * Generate a secure order URL with random security code
 * 
 * @param string $base_url The base URL for the order (e.g., 'https://billing.lwegatech.com/order2/web-hosting/silver-package=')
 * @return string Complete URL with security code appended
 */
function kipya_generate_secure_order_url($base_url) {
    $scode = bin2hex(random_bytes(24));
    return $base_url . $scode;
}

function kipya_render_service_template($args) {

    $args = wp_parse_args($args, array(
        'family'              => 'web',
        'eyebrow'             => '',
        'hero_title'          => '',
        'hero_subtitle'       => '',
        'gif_url'             => '',
        'intro_title'         => '',
        'intro_text'          => '',
        'intro_gif'           => 'https://media.giphy.com/media/SWoSkN6DxTszqIKEqv/giphy.gif',
        'packages_bg_text'    => '',
        'packages_sub'        => '',
        'packages_button_url' => '',
        'packages_button_label' => '',
        'highlights'          => array(),
        'packages'            => array(),
        'faqs'                => array(),
        'deliverables'        => array(),
        'why_choose_us'       => array(),
        'cta_title'           => '',
        'cta_text'            => '',
        'cta_primary_label'   => '',
        'cta_primary_url'     => '',
        'cta_secondary_label' => '',
        'cta_secondary_url'   => '',
    ));

    $use_carousel = count($args['packages']) > 3;

    ?>
    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <main role="main" class="kpy-service-main">

        <!-- ===================== HERO ===================== -->
        <section class="kpy-hero hosting-hero <?php echo esc_attr($args['family']); ?>-hero" data-aos="fade-up">

            <div class="kpy-hero-black-bg"></div>
            <canvas class="kpy-wave-canvas" id="kpyWaveCanvas"></canvas>
            <div class="kpy-grid-lines"></div>

            <div class="kpy-hero-overlay">
                <div class="container">
                    <div class="kpy-hero-text-wrap">
                        <?php if ($args['eyebrow']): ?>
                        <div class="kpy-hero-badge">
                            <i class="bi bi-star-fill"></i>
                            <?php echo esc_html($args['eyebrow']); ?>
                        </div>
                        <?php endif; ?>
                        <h1 class="kpy-hero-title"><?php echo esc_html($args['hero_title']); ?></h1>
                        <p class="kpy-hero-subtitle"><?php echo esc_html($args['hero_subtitle']); ?></p>
                        <?php if ($args['cta_primary_label']): ?>
                        <div class="kpy-hero-ctas">
                            <a href="<?php echo esc_url($args['cta_primary_url']); ?>" class="kpy-btn-primary">
                                <?php echo esc_html($args['cta_primary_label']); ?>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                            <?php if ($args['cta_secondary_label']): ?>
                            <a href="<?php echo esc_url($args['cta_secondary_url']); ?>" class="kpy-btn-ghost">
                                <?php echo esc_html($args['cta_secondary_label']); ?>
                            </a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===================== INTRO / ABOUT SECTION ===================== -->
        <section class="kpy-intro-section kpy-dark-waves" data-aos="fade-up">
            <div class="container">
                <div class="columns is-vcentered kpy-intro-columns">

                    <div class="column is-7">
                        <div class="kpy-section-label">
                            <span class="kpy-label-line"></span>
                            <span><?php echo esc_html($args['eyebrow']); ?></span>
                        </div>
                        <h2 class="kpy-section-title">
                            <?php echo esc_html($args['intro_title']); ?>
                        </h2>
                        <div class="kpy-intro-divider"></div>
                        <p class="kpy-intro-text">
                            <?php echo nl2br(esc_html($args['intro_text'])); ?>
                        </p>

                        <?php if (!empty($args['highlights'])): ?>
                        <div class="kpy-inline-features">
                            <?php foreach ($args['highlights'] as $index => $hl): ?>
                            <div class="kpy-inline-feature" data-aos="fade-right" data-aos-delay="<?php echo $index * 100; ?>">
                                <div class="kpy-inline-icon">
                                    <i class="<?php echo esc_attr($hl['icon']); ?>"></i>
                                </div>
                                <div class="kpy-inline-text">
                                    <h4><?php echo esc_html($hl['title']); ?></h4>
                                    <p><?php echo esc_html($hl['text']); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="column is-5">
                        <div class="kpy-gif-frame">
                            <div class="kpy-gif-accent-top"></div>
                            <div class="kpy-gif-accent-bottom"></div>
                            <div class="kpy-gif-inner">
                                <img src="<?php echo esc_url($args['intro_gif']); ?>"
                                     alt="<?php echo esc_attr($args['intro_title']); ?>"
                                     class="kpy-gif-img">
                            </div>
                            <div class="kpy-gif-badge">
                                <i class="bi bi-lightning-fill"></i>
                                <span>Your Tech Experts</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ===================== WHAT YOU GET ===================== -->
        <?php if (!empty($args['deliverables'])): ?>
        <section class="kpy-deliverables-section" data-aos="fade-up">
            <div class="container">
                <div class="columns is-vcentered">

                    <div class="column is-5">
                        <div class="kpy-section-label">
                            <span class="kpy-label-line"></span>
                            <span>Deliverables</span>
                        </div>
                        <h2 class="kpy-section-title">What You <span class="kpy-red">Get</span></h2>
                        <ul class="kpy-deliverables-list">
                            <?php foreach ($args['deliverables'] as $index => $item): ?>
                            <li data-aos="fade-left" data-aos-delay="<?php echo $index * 100; ?>">
                                <div class="kpy-check-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <span><?php echo esc_html($item); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="column is-7">
                        <div class="kpy-offset-img-wrap">
                            <div class="kpy-offset-shadow"></div>
                            <div class="kpy-offset-border">
                                <img src="https://i.pinimg.com/736x/ec/6a/b2/ec6ab2ca543e90f89c13a89aa5bbba25.jpg"
                                     alt="What You Get"
                                     class="kpy-offset-img">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- ===================== PRICING PACKAGES ===================== -->
        <?php if (!empty($args['packages']) || !empty($args['packages_button_url'])): ?>
        <section class="kpy-packages-section" data-aos="fade-up">
            <div class="container">
                <div class="has-text-centered kpy-section-header">
                    <div class="kpy-section-label is-centered">
                        <span class="kpy-label-line"></span>
                        <span>Pricing</span>
                        <span class="kpy-label-line"></span>
                    </div>
                    <h2 class="kpy-section-title">
                        Our <span class="kpy-red">Packages</span>
                    </h2>
                    <?php if (!empty($args['packages_sub'])): ?>
                    <p class="kpy-section-sub"><?php echo esc_html($args['packages_sub']); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($args['packages_button_url'])): ?>
                    <div class="kpy-view-details-text">
                        <a href="<?php echo esc_url($args['packages_button_url']); ?>" target="_blank">
                            <?php echo esc_html($args['packages_button_label'] ?: 'View Details About Our Packages'); ?>
                            <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($args['packages'])):
                    $use_carousel = count($args['packages']) > 3;
                ?>
                <!-- ── CAROUSEL MODE (4+ packages) ── -->
                <div class="kpy-carousel-outer">

                    <button class="kpy-carousel-arrow kpy-carousel-prev" aria-label="Previous package">
                        <i class="bi bi-chevron-left"></i>
                    </button>

                    <div class="kpy-carousel-viewport">
                        <div class="kpy-carousel-track">
                            <?php foreach ($args['packages'] as $index => $pkg):
                                $is_featured = !empty($pkg['featured']);
                            ?>
                            <div class="kpy-carousel-slide" data-aos="fade-up" data-aos-delay="<?php echo $index * 150; ?>">
                                <div class="kpy-package-card kpy-card-hosting <?php echo $is_featured ? 'kpy-featured' : ''; ?>">

                                    <?php if ($is_featured): ?>
                                    <div class="kpy-popular-tag">
                                        <i class="bi bi-star-fill"></i> Most Popular
                                    </div>
                                    <?php endif; ?>

                                    <div class="kpy-pkg-badge"><?php echo esc_html($pkg['title']); ?></div>
                                    <div class="kpy-pkg-type"><?php echo esc_html($pkg['type'] ?? 'Website Design'); ?></div>

                                    <?php if (!empty($pkg['note_top'])): ?>
                                    <div class="kpy-pkg-note-top"><?php echo esc_html($pkg['note_top']); ?></div>
                                    <?php endif; ?>

                                    <?php if (!empty($pkg['price'])): ?>
                                    <div class="kpy-pkg-price-block">
                                        <?php echo esc_html($pkg['price']); ?>
                                        <?php if (!empty($pkg['price_period'])): ?>
                                        <span><?php echo esc_html($pkg['price_period']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>

                                    <ul class="kpy-pkg-features">
                                        <?php foreach ((array)$pkg['features'] as $feature): ?>
                                        <li>
                                            <i class="bi bi-check-circle-fill"></i>
                                            <span><?php echo esc_html($feature); ?></span>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>

                                    <?php if (!empty($pkg['note'])): ?>
                                    <p class="kpy-pkg-note"><?php echo esc_html($pkg['note']); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($pkg['delivery'])): ?>
                                    <div class="kpy-pkg-delivery">
                                        <i class="bi bi-clock"></i>
                                        <?php echo esc_html($pkg['delivery']); ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php
                                    // Generate secure order URL if order_base_url is provided, otherwise use cta_url
                                    $btn_url = !empty($pkg['order_base_url']) ? kipya_generate_secure_order_url($pkg['order_base_url']) : (!empty($pkg['cta_url']) ? $pkg['cta_url'] : $args['cta_primary_url']);
                                    ?>
                                    <a href="<?php echo esc_url($btn_url); ?>"
                                       class="kpy-pkg-btn <?php echo $is_featured ? 'kpy-pkg-btn-featured' : ''; ?>">
                                        <?php echo esc_html(!empty($pkg['cta_label']) ? $pkg['cta_label'] : 'Get Started'); ?>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>

                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <button class="kpy-carousel-arrow kpy-carousel-next" aria-label="Next package">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>

                <div class="kpy-carousel-dots">
                    <?php foreach ($args['packages'] as $index => $pkg): ?>
                    <button class="kpy-dot <?php echo $index === 0 ? 'active' : ''; ?>"
                            aria-label="Go to slide <?php echo $index + 1; ?>"></button>
                    <?php endforeach; ?>
                </div>

                <div class="kpy-carousel-counter">
                    <span class="kpy-counter-current">1</span>
                    <span class="kpy-counter-sep"> / </span>
                    <span class="kpy-counter-total"><?php echo count($args['packages']); ?></span>
                </div>

                <?php else: ?>
                <!-- ── STATIC GRID MODE (3 or fewer packages) ── -->
                <div class="columns is-multiline kpy-packages-grid">
                    <?php foreach ($args['packages'] as $index => $pkg):
                        $total_pkgs  = count($args['packages']);
                        $col_size    = $total_pkgs === 1 ? '8 is-offset-2' : ($total_pkgs === 2 ? '6' : '4');
                        $is_featured = !empty($pkg['featured']);
                    ?>
                    <div class="column is-<?php echo $col_size; ?>" data-aos="fade-up" data-aos-delay="<?php echo $index * 150; ?>">
                        <div class="kpy-package-card kpy-card-hosting <?php echo $is_featured ? 'kpy-featured' : ''; ?>">

                            <?php if ($is_featured): ?>
                            <div class="kpy-popular-tag">
                                <i class="bi bi-star-fill"></i> Most Popular
                            </div>
                            <?php endif; ?>

                            <div class="kpy-pkg-badge"><?php echo esc_html($pkg['title']); ?></div>
                            <div class="kpy-pkg-type"><?php echo esc_html($pkg['type'] ?? 'Website Design'); ?></div>

                            <?php if (!empty($pkg['note_top'])): ?>
                            <div class="kpy-pkg-note-top"><?php echo esc_html($pkg['note_top']); ?></div>
                            <?php endif; ?>

                            <?php if (!empty($pkg['price'])): ?>
                            <div class="kpy-pkg-price-block">
                                <?php echo esc_html($pkg['price']); ?>
                                <?php if (!empty($pkg['price_period'])): ?>
                                <span><?php echo esc_html($pkg['price_period']); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <ul class="kpy-pkg-features">
                                <?php foreach ((array)$pkg['features'] as $feature): ?>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span><?php echo esc_html($feature); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>

                            <?php if (!empty($pkg['note'])): ?>
                            <p class="kpy-pkg-note"><?php echo esc_html($pkg['note']); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($pkg['delivery'])): ?>
                            <div class="kpy-pkg-delivery">
                                <i class="bi bi-clock"></i>
                                <?php echo esc_html($pkg['delivery']); ?>
                            </div>
                            <?php endif; ?>

                            <?php
                            // Generate secure order URL if order_base_url is provided, otherwise use cta_url
                            $btn_url = !empty($pkg['order_base_url']) ? kipya_generate_secure_order_url($pkg['order_base_url']) : (!empty($pkg['cta_url']) ? $pkg['cta_url'] : $args['cta_primary_url']);
                            ?>
                            <a href="<?php echo esc_url($btn_url); ?>"
                               class="kpy-pkg-btn <?php echo $is_featured ? 'kpy-pkg-btn-featured' : ''; ?>">
                                <?php echo esc_html(!empty($pkg['cta_label']) ? $pkg['cta_label'] : 'Get Started'); ?>
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

            </div>
        </section>
        <?php endif; ?>

        <!-- ===================== FAQs ===================== -->
        <?php if (!empty($args['faqs'])): ?>
        <section class="kpy-faqs-section kpy-dark-waves" data-aos="fade-up">
            <div class="container">
                <div class="has-text-centered kpy-section-header">
                    <div class="kpy-section-label is-centered">
                        <span class="kpy-label-line"></span>
                        <span>Help</span>
                        <span class="kpy-label-line"></span>
                    </div>
                    <h2 class="kpy-section-title">
                        Frequently <span class="kpy-red">Asked</span> Questions
                    </h2>
                </div>

                <?php
                $total  = count($args['faqs']);
                $half   = (int)ceil($total / 2);
                $left   = array_slice($args['faqs'], 0, $half);
                $right  = array_slice($args['faqs'], $half);
                ?>

                <div class="columns is-vcentered">
                    <div class="column is-4">
                        <?php foreach ($left as $index => $faq): ?>
                        <div class="kpy-faq-item" data-aos="fade-right" data-aos-delay="<?php echo $index * 100; ?>">
                            <div class="kpy-faq-q">
                                <span><?php echo esc_html($faq['q']); ?></span>
                                <i class="bi bi-plus-lg kpy-faq-icon"></i>
                            </div>
                            <div class="kpy-faq-a">
                                <p><?php echo nl2br(esc_html($faq['a'])); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="column is-4 has-text-centered">
                        <div class="kpy-faq-gif-wrap">
                            <img src="https://www.lwegatech.info/new/content/uploads/2026/03/FAQ-removebg-preview.png"
                                 alt="FAQ Illustration"
                                 class="kpy-faq-gif">
                            <div class="kpy-faq-gif-label">
                                <i class="bi bi-question-circle-fill"></i>
                                Got Questions? We've Got Answers.
                            </div>
                        </div>
                    </div>

                    <div class="column is-4">
                        <?php foreach ($right as $index => $faq): ?>
                        <div class="kpy-faq-item" data-aos="fade-left" data-aos-delay="<?php echo $index * 100; ?>">
                            <div class="kpy-faq-q">
                                <span><?php echo esc_html($faq['q']); ?></span>
                                <i class="bi bi-plus-lg kpy-faq-icon"></i>
                            </div>
                            <div class="kpy-faq-a">
                                <p><?php echo nl2br(esc_html($faq['a'])); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- ===================== WHY CHOOSE US ===================== -->
        <?php if (!empty($args['why_choose_us'])): ?>
        <section class="kpy-why-section" data-aos="fade-up">
            <div class="container">
                <div class="columns is-vcentered kpy-why-inner">

                    <div class="column is-4">
                        <div class="kpy-section-label">
                            <span class="kpy-label-line"></span>
                            <span>Our Edge</span>
                        </div>
                        <h2 class="kpy-section-title">
                            Why <span class="kpy-red">Choose</span><br>Lwegatech?
                        </h2>
                        <p class="kpy-why-subtext">
                            We combine technical expertise with design excellence to deliver results that matter for your business.
                        </p>
                        <div class="kpy-why-gif-wrap">
                            <img src="https://media.giphy.com/media/l3vR85PnGsBwu1PFK/giphy.gif"
                                 alt="Why Choose Us"
                                 class="kpy-why-gif">
                        </div>
                    </div>

                    <div class="column is-8">
                        <div class="columns is-multiline kpy-why-grid">
                            <?php foreach ($args['why_choose_us'] as $index => $item): ?>
                            <div class="column is-4" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                                <div class="kpy-why-card">
                                    <div class="kpy-why-icon">
                                        <i class="<?php echo esc_attr($item['icon']); ?>"></i>
                                    </div>
                                    <h4 class="kpy-why-title"><?php echo esc_html($item['title']); ?></h4>
                                    <p class="kpy-why-text"><?php echo esc_html($item['text']); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- ===================== CTA ===================== -->
        <section class="kpy-cta-section kpy-dark-waves" data-aos="fade-up">
            <div class="container">
                <div class="kpy-cta-box">
                    <div class="columns is-vcentered">

                        <div class="column is-7">
                            <div class="kpy-cta-label">
                                <i class="bi bi-rocket-takeoff-fill"></i>
                                Ready to Get Started?
                            </div>
                            <h2 class="kpy-cta-title">
                                <?php echo nl2br(esc_html($args['cta_title'])); ?>
                            </h2>
                            <p class="kpy-cta-text">
                                <?php echo esc_html($args['cta_text']); ?>
                            </p>
                            <div class="kpy-cta-btns">
                                <?php if ($args['cta_primary_label']): ?>
                                <a href="<?php echo esc_url($args['cta_primary_url']); ?>"
                                   class="kpy-cta-btn-primary">
                                    <?php echo esc_html($args['cta_primary_label']); ?>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                <?php endif; ?>
                                <?php if ($args['cta_secondary_label']): ?>
                                <a href="<?php echo esc_url($args['cta_secondary_url']); ?>"
                                   class="kpy-cta-btn-outline">
                                    <?php echo esc_html($args['cta_secondary_label']); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="column is-5">
                            <div class="kpy-cta-img-wrap">
                                <div class="kpy-cta-img-shadow"></div>
                                <div class="kpy-cta-img-border">
                                    <img src="https://i.pinimg.com/1200x/13/db/f6/13dbf6c2e6cf65c2cd3dc6c40e1cdfab.jpg"
                                         alt="CTA Character"
                                         class="kpy-cta-img">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="kpy-cta-strip">
                        <div class="kpy-cta-strip-item"><i class="bi bi-shield-check-fill"></i> Secure & Reliable</div>
                        <div class="kpy-cta-strip-item"><i class="bi bi-headset"></i> 24/7 Support</div>
                        <div class="kpy-cta-strip-item"><i class="bi bi-clock-fill"></i> Fast Delivery</div>
                        <div class="kpy-cta-strip-item"><i class="bi bi-patch-check-fill"></i> Quality Guaranteed</div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- ===================== STYLES ===================== -->
    <style>
    /* ─── Reset & Base ─── */
    .kpy-service-main { background: #0d0d0d; font-family: 'Segoe UI', sans-serif; }
    .kpy-red { color: #c0000c; }

    .kpy-service-main *,
    .kpy-service-main img,
    .kpy-service-main .kpy-package-card,
    .kpy-service-main .kpy-why-card,
    .kpy-service-main .kpy-faq-item,
    .kpy-service-main .kpy-inline-feature,
    .kpy-service-main .kpy-cta-box {
        border-radius: 0 !important;
    }

    /* ─── Section Labels ─── */
    .kpy-section-label {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 1rem;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #c0000c;
    }
    .kpy-section-label.is-centered { justify-content: center; }
    .kpy-label-line {
        display: inline-block;
        height: 2px;
        width: 40px;
        background: #c0000c;
        flex-shrink: 0;
    }
    .kpy-section-title {
        font-size: 2.6rem;
        font-weight: 900;
        color: #fff;
        line-height: 1.1;
        letter-spacing: -0.03em;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
    }
    .kpy-section-header { margin-bottom: 4rem; }
    .kpy-section-sub { color: #888; font-size: 1rem; max-width: 500px; margin: 0 auto; }

    /* ─── Dark Waves BG ─── */
    .kpy-dark-waves { position: relative; }
    .kpy-dark-waves::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: repeating-linear-gradient(
            45deg,
            rgba(192,0,12,0.025) 0px,
            rgba(192,0,12,0.025) 2px,
            transparent 2px,
            transparent 18px
        );
        pointer-events: none;
        z-index: 0;
    }
    .kpy-dark-waves > .container { position: relative; z-index: 1; }

    /* ══════════════════════════════════════════
       HERO
    ══════════════════════════════════════════ */
    .kpy-hero {
        position: relative;
        min-height: 80vh;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: #050505;
        color: #fff;
        padding: 6rem 0;
    }
    .kpy-hero-black-bg {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 80% 70% at 75% 50%, rgba(120,0,8,0.45) 0%, transparent 65%),
            radial-gradient(ellipse 60% 80% at 20% 80%, rgba(80,0,5,0.25) 0%, transparent 60%),
            radial-gradient(ellipse 50% 50% at 50% 0%,  rgba(60,0,4,0.20) 0%, transparent 55%),
            linear-gradient(160deg, #090005 0%, #050505 45%, #0a0003 100%);
        z-index: 0;
    }
    .kpy-wave-canvas {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        opacity: 0.9;
    }
    .kpy-grid-lines {
        position: absolute;
        inset: 0;
        z-index: 2;
        background-image:
            linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
        background-size: 60px 60px;
    }
    .kpy-hero-overlay {
        position: relative;
        z-index: 3;
        width: 100%;
    }
    .kpy-hero-text-wrap { max-width: 700px; }
    .kpy-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(192,0,12,0.15);
        border: 1px solid rgba(192,0,12,0.4);
        color: #ff4455;
        padding: 8px 18px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 1.8rem;
    }
    .kpy-hero-title {
        font-size: clamp(2.8rem, 6vw, 5rem);
        font-weight: 900;
        color: #fff;
        line-height: 1.05;
        letter-spacing: -0.04em;
        text-transform: uppercase;
        margin-bottom: 1.2rem;
    }
    .kpy-hero-subtitle {
        font-size: 1.15rem;
        color: rgba(255,255,255,0.6);
        line-height: 1.7;
        max-width: 560px;
        margin-bottom: 2.5rem;
    }
    .kpy-hero-ctas { display: flex; gap: 1rem; flex-wrap: wrap; }
    .kpy-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #c0000c;
        color: #fff;
        font-weight: 800;
        font-size: 0.9rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 1rem 2rem;
        text-decoration: none;
        border: 2px solid #c0000c;
        transition: background 0.2s, transform 0.2s;
    }
    .kpy-btn-primary:hover { background: #a0000a; transform: translateY(-2px); color: #fff; }
    .kpy-btn-ghost {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        color: #fff;
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 1rem 2rem;
        text-decoration: none;
        border: 2px solid rgba(255,255,255,0.3);
        transition: border-color 0.2s, transform 0.2s;
    }
    .kpy-btn-ghost:hover { border-color: #fff; transform: translateY(-2px); color: #fff; }

    /* ══════════════════════════════════════════
       INTRO / ABOUT
    ══════════════════════════════════════════ */
    .kpy-intro-section { padding: 8rem 0; background: #0d0d0d; }
    .kpy-intro-columns { gap: 4rem; }
    .kpy-intro-divider { width: 80px; height: 4px; background: #c0000c; margin-bottom: 2rem; }
    .kpy-intro-text { color: #aaa; font-size: 1.05rem; line-height: 1.8; margin-bottom: 3rem; }

    .kpy-inline-features { display: flex; flex-direction: column; gap: 0; }
    .kpy-inline-feature {
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
        padding: 1.5rem 0;
        border-bottom: 1px solid #1f1f1f;
        transition: background 0.2s;
    }
    .kpy-inline-feature:first-child { border-top: 1px solid #1f1f1f; }
    .kpy-inline-feature:hover { background: rgba(192,0,12,0.04); }
    .kpy-inline-icon {
        width: 52px;
        height: 52px;
        background: #c0000c;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.3rem;
        flex-shrink: 0;
        position: relative;
    }
    .kpy-inline-icon::after {
        content: '';
        position: absolute;
        inset: 0;
        border: 2px solid rgba(255,255,255,0.1);
        pointer-events: none;
    }
    .kpy-inline-text h4 {
        font-size: 1rem;
        font-weight: 800;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }
    .kpy-inline-text p { color: #888; font-size: 0.9rem; line-height: 1.5; margin: 0; }

    .kpy-gif-frame { position: relative; padding: 1.5rem 0 2rem 1.5rem; }
    .kpy-gif-accent-top {
        position: absolute; top: 0; left: 0;
        width: 100px; height: 100px;
        border-top: 4px solid #c0000c;
        border-left: 4px solid #c0000c;
        z-index: 1; pointer-events: none;
    }
    .kpy-gif-accent-bottom {
        position: absolute; bottom: 0; right: 0;
        width: 100px; height: 100px;
        border-bottom: 4px solid #c0000c;
        border-right: 4px solid #c0000c;
        z-index: 1; pointer-events: none;
    }
    .kpy-gif-inner {
        position: relative; z-index: 2;
        overflow: hidden; border: 1px solid #222; background: #111;
    }
    .kpy-gif-inner::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        pointer-events: none;
        z-index: 3;
    }
    .kpy-gif-img { width: 100%; height: 400px; object-fit: cover; display: block; }
    .kpy-gif-badge {
        position: absolute; bottom: 2.5rem; left: -1rem;
        background: #c0000c; color: #fff;
        font-size: 0.78rem; font-weight: 700;
        letter-spacing: 1px; text-transform: uppercase;
        padding: 0.6rem 1.2rem;
        display: flex; align-items: center; gap: 8px; z-index: 3;
    }

    /* ══════════════════════════════════════════
       WHAT YOU GET
    ══════════════════════════════════════════ */
    .kpy-deliverables-section {
        padding: 8rem 0; background: #0a0a0a; border-top: 1px solid #1a1a1a;
    }
    .kpy-deliverables-list { list-style: none; padding: 0; margin: 0; }
    .kpy-deliverables-list li {
        display: flex; align-items: center; gap: 1.2rem;
        padding: 1.2rem 0; border-bottom: 1px solid #1a1a1a;
    }
    .kpy-deliverables-list li:first-child { border-top: 1px solid #1a1a1a; }
    .kpy-check-icon {
        width: 36px; height: 36px; background: #c0000c;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.1rem; flex-shrink: 0;
    }
    .kpy-deliverables-list li span { color: #ddd; font-size: 1rem; font-weight: 600; }

    .kpy-offset-img-wrap {
        position: relative; padding: 0 2rem 2rem 0;
        max-width: 540px; margin-left: auto;
    }
    .kpy-offset-shadow {
        position: absolute; top: 20px; right: -20px;
        bottom: -20px; left: 20px; background: #c0000c; z-index: 0;
    }
    .kpy-offset-border {
        position: relative; z-index: 1;
        background: #fff; padding: 8px; border: 2px solid #000;
    }
    .kpy-offset-img { width: 100%; height: auto; display: block; }

    /* ══════════════════════════════════════════
       PACKAGES — SHARED
    ══════════════════════════════════════════ */
    .kpy-packages-section {
        padding: 8rem 0; background: #111; border-top: 1px solid #1a1a1a;
    }

    /* Hosting-style card (used in BOTH carousel and static grid) */
    .kpy-package-card.kpy-card-hosting {
        background: #0f0f0f;
        border: 1px solid #222;
        padding: 0;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        transition: border-color 0.25s;
    }
    .kpy-package-card.kpy-card-hosting:hover { border-color: #c0000c; }
    .kpy-package-card.kpy-card-hosting.kpy-featured { border-color: #c0000c; }

    .kpy-popular-tag {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #c0000c;
        color: #fff;
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.5rem 1rem;
        width: 100%;
    }

    .kpy-pkg-badge {
        font-size: 1.4rem;
        font-weight: 900;
        color: #fff;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 1.4rem 2rem 0.2rem;
    }
    .kpy-pkg-type {
        font-size: 0.78rem;
        color: #888;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 0 2rem 0.5rem;
    }
    .kpy-pkg-note-top {
        font-size: 0.72rem;
        color: #555;
        font-style: italic;
        padding: 0 2rem 0.8rem;
    }
    .kpy-pkg-price-block {
        font-size: 1.5rem;
        font-weight: 900;
        color: #c0000c;
        padding: 0.8rem 2rem 1rem;
        border-bottom: 1px solid #1f1f1f;
        line-height: 1;
    }
    .kpy-pkg-price-block span {
        font-size: 0.88rem;
        font-weight: 600;
        color: #777;
        margin-left: 2px;
    }
    .kpy-pkg-features {
        list-style: none;
        padding: 1.2rem 2rem;
        margin: 0;
        flex: 1;
    }
    .kpy-pkg-features li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 0.55rem 0;
        border-bottom: 1px solid #1a1a1a;
        color: #ccc;
        font-size: 0.88rem;
        line-height: 1.4;
    }
    .kpy-pkg-features li:last-child { border-bottom: none; }
    .kpy-pkg-features li i { color: #c0000c; flex-shrink: 0; margin-top: 2px; font-size: 0.9rem; }
    .kpy-pkg-note {
        font-size: 0.75rem;
        color: #555;
        font-style: italic;
        padding: 0.5rem 2rem 0;
        margin: 0;
    }
    .kpy-pkg-delivery {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.78rem;
        color: #888;
        padding: 0.6rem 2rem;
    }
    .kpy-pkg-delivery i { color: #c0000c; }
    .kpy-pkg-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: transparent;
        color: #fff;
        font-weight: 800;
        font-size: 0.85rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 1rem 2rem;
        text-decoration: none;
        border: none;
        border-top: 1px solid #1f1f1f;
        transition: background 0.2s, color 0.2s;
        margin-top: auto;
    }
    .kpy-pkg-btn:hover { background: #c0000c; color: #fff; }
    .kpy-pkg-btn-featured { background: #c0000c; }
    .kpy-pkg-btn-featured:hover { background: #a0000a; }

    /* View Details Text Link */
    .kpy-view-details-text {
        margin-top: 1.5rem;
    }
    .kpy-view-details-text a {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #c0000c;
        font-weight: 700;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
        text-decoration: none;
        border-bottom: 1px solid #c0000c;
        padding-bottom: 2px;
        transition: color 0.2s, border-color 0.2s;
    }
    .kpy-view-details-text a:hover {
        color: #ff4455;
        border-color: #ff4455;
    }
    .kpy-view-details-text a i { font-size: 0.9rem; }

    /* ── CAROUSEL MODE ── */
    .kpy-carousel-outer {
        position: relative;
        display: flex;
        align-items: center;
    }
    .kpy-carousel-viewport { overflow: hidden; flex: 1; min-width: 0; }
    .kpy-carousel-track {
        display: flex;
        align-items: stretch;
        transition: transform 0.45s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        will-change: transform;
    }
    .kpy-carousel-slide {
        flex: 0 0 50%;
        min-width: 0;
        padding: 0 12px;
        box-sizing: border-box;
    }
    .kpy-carousel-arrow {
        flex-shrink: 0;
        width: 52px;
        height: 52px;
        background: #1a1a1a;
        border: 1px solid #333;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.1rem;
        transition: background 0.2s, border-color 0.2s;
        z-index: 2;
    }
    .kpy-carousel-arrow:hover { background: #c0000c; border-color: #c0000c; }
    .kpy-carousel-arrow:disabled { opacity: 0.25; cursor: not-allowed; }
    .kpy-carousel-arrow:disabled:hover { background: #1a1a1a; border-color: #333; }

    .kpy-carousel-dots {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 2.5rem;
    }
    .kpy-dot {
        width: 10px;
        height: 10px;
        background: #333;
        border: none;
        cursor: pointer;
        padding: 0;
        transition: background 0.2s, transform 0.2s;
    }
    .kpy-dot.active { background: #c0000c; transform: scale(1.35); }
    .kpy-dot:hover { background: #555; }

    .kpy-carousel-counter {
        text-align: center;
        margin-top: 1rem;
        font-size: 0.82rem;
        color: #555;
        letter-spacing: 1px;
        font-weight: 700;
    }
    .kpy-counter-current { color: #c0000c; }

    /* ══════════════════════════════════════════
       FAQs
    ══════════════════════════════════════════ */
    .kpy-faqs-section {
        padding: 8rem 0; background: #0a0a0a; border-top: 1px solid #1a1a1a;
    }
    .kpy-faq-item {
        border-bottom: 1px solid #1f1f1f; cursor: pointer; overflow: hidden;
    }
    .kpy-faq-item:first-child { border-top: 1px solid #1f1f1f; }
    .kpy-faq-q {
        display: flex; justify-content: space-between; align-items: center;
        gap: 1rem; padding: 1.3rem 0;
        font-weight: 700; font-size: 0.95rem; color: #ddd; transition: color 0.2s;
    }
    .kpy-faq-item:hover .kpy-faq-q,
    .kpy-faq-item.active .kpy-faq-q { color: #fff; }
    .kpy-faq-icon {
        color: #c0000c; font-size: 1rem; flex-shrink: 0; transition: transform 0.3s;
    }
    .kpy-faq-item.active .kpy-faq-icon { transform: rotate(45deg); }
    .kpy-faq-a { max-height: 0; overflow: hidden; transition: max-height 0.35s ease-out; }
    .kpy-faq-item.active .kpy-faq-a { max-height: 400px; }
    .kpy-faq-a p {
        color: #888; font-size: 0.9rem; line-height: 1.7;
        padding: 0 0 1.3rem; margin: 0;
    }
    .kpy-faq-gif-wrap { display: flex; flex-direction: column; align-items: center; gap: 1.5rem; }
    .kpy-faq-gif {
        width: 100%; max-width: 300px; display: block;
        border: 2px solid #1f1f1f; opacity: 0.85;
    }
    .kpy-faq-gif-label {
        color: #888; font-size: 0.85rem; font-weight: 600; text-align: center;
        display: flex; flex-direction: column; align-items: center; gap: 6px;
    }
    .kpy-faq-gif-label i { color: #c0000c; font-size: 1.5rem; }

    /* ══════════════════════════════════════════
       WHY CHOOSE US
    ══════════════════════════════════════════ */
    .kpy-why-section {
        padding: 8rem 0; background: #111; border-top: 1px solid #1a1a1a;
    }
    .kpy-why-inner { gap: 4rem; }
    .kpy-why-subtext { color: #777; font-size: 0.95rem; line-height: 1.7; margin-bottom: 2rem; }
    .kpy-why-gif-wrap { overflow: hidden; border: 1px solid #222; background: #0d0d0d; }
    .kpy-why-gif {
        width: 100%; height: 220px; object-fit: cover; display: block;
        opacity: 0.8; transition: opacity 0.3s;
    }
    .kpy-why-gif-wrap:hover .kpy-why-gif { opacity: 1; }
    .kpy-why-grid { gap: 0 !important; }
    .kpy-why-card {
        background: #131313; border: 1px solid #1f1f1f;
        padding: 2rem 1.8rem; height: 100%;
        transition: background 0.25s, border-color 0.25s;
        position: relative; overflow: hidden;
    }
    .kpy-why-card::after {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0;
        height: 2px; background: #c0000c;
        transform: scaleX(0); transform-origin: left; transition: transform 0.3s;
    }
    .kpy-why-card:hover { background: #1a1a1a; border-color: #333; }
    .kpy-why-card:hover::after { transform: scaleX(1); }
    .kpy-why-icon {
        width: 48px; height: 48px;
        background: rgba(192,0,12,0.12); border: 1px solid rgba(192,0,12,0.3);
        display: flex; align-items: center; justify-content: center;
        color: #c0000c; font-size: 1.3rem; margin-bottom: 1.2rem; transition: background 0.2s;
    }
    .kpy-why-card:hover .kpy-why-icon { background: #c0000c; color: #fff; border-color: #c0000c; }
    .kpy-why-title {
        font-size: 0.95rem; font-weight: 800; color: #fff;
        text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.6rem;
    }
    .kpy-why-text { color: #777; font-size: 0.85rem; line-height: 1.6; margin: 0; }

    /* ══════════════════════════════════════════
       CTA
    ══════════════════════════════════════════ */
    .kpy-cta-section {
        padding: 6rem 0 8rem; background: #0d0d0d; border-top: 1px solid #1a1a1a;
    }
    .kpy-cta-box { background: #c0000c; padding: 0; overflow: hidden; position: relative; }
    .kpy-cta-box > .columns { padding: 4rem; margin: 0 !important; }
    .kpy-cta-label {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(0,0,0,0.25); color: rgba(255,255,255,0.9);
        font-size: 0.75rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;
        padding: 6px 14px; margin-bottom: 1.5rem;
    }
    .kpy-cta-title {
        font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 900; color: #fff;
        line-height: 1.1; letter-spacing: -0.03em; text-transform: uppercase; margin-bottom: 1.5rem;
    }
    .kpy-cta-text {
        color: rgba(0,0,0,0.7); font-size: 1.05rem; line-height: 1.6;
        font-weight: 600; margin-bottom: 2.5rem; max-width: 520px;
    }
    .kpy-cta-btns { display: flex; gap: 1rem; flex-wrap: wrap; }
    .kpy-cta-btn-primary {
        display: inline-flex; align-items: center; gap: 8px;
        background: #000; color: #fff; font-weight: 800; font-size: 0.88rem;
        letter-spacing: 1px; text-transform: uppercase; padding: 1.1rem 2rem;
        text-decoration: none; border: 2px solid #000;
        transition: background 0.2s, transform 0.2s;
        min-width: 180px; justify-content: center;
    }
    .kpy-cta-btn-primary:hover { background: #1a1a1a; transform: translateY(-2px); color: #fff; }
    .kpy-cta-btn-outline {
        display: inline-flex; align-items: center; gap: 8px;
        background: transparent; color: #000; font-weight: 800; font-size: 0.88rem;
        letter-spacing: 1px; text-transform: uppercase; padding: 1rem 2rem;
        text-decoration: none; border: 2px solid #000;
        transition: background 0.2s, color 0.2s, transform 0.2s;
        min-width: 180px; justify-content: center;
    }
    .kpy-cta-btn-outline:hover { background: #000; color: #fff; transform: translateY(-2px); }
    .kpy-cta-img-wrap {
        position: relative; padding: 0 2rem 2rem 0; max-width: 380px; margin: 0 auto;
    }
    .kpy-cta-img-shadow {
        position: absolute; top: 16px; right: -16px; bottom: -16px; left: 16px;
        background: #000; z-index: 0;
    }
    .kpy-cta-img-border {
        position: relative; z-index: 1; background: #fff; padding: 8px; border: 2px solid #000;
    }
    .kpy-cta-img { width: 100%; height: auto; display: block; }
    .kpy-cta-strip {
        background: rgba(0,0,0,0.25); display: flex; flex-wrap: wrap;
        justify-content: space-around; align-items: center;
        padding: 1.2rem 4rem; gap: 1rem; border-top: 1px solid rgba(0,0,0,0.15);
    }
    .kpy-cta-strip-item {
        display: flex; align-items: center; gap: 8px;
        color: rgba(255,255,255,0.85); font-size: 0.82rem;
        font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;
    }
    .kpy-cta-strip-item i { font-size: 1rem; }

    /* ══════════════════════════════════════════
       RESPONSIVE
    ══════════════════════════════════════════ */
    @media (max-width: 900px) {
        .kpy-carousel-slide { flex: 0 0 100%; }
        .kpy-carousel-arrow { width: 40px; height: 40px; font-size: 0.9rem; }
        .kpy-carousel-outer { margin: 0 -12px; }
        .kpy-carousel-viewport { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    }
    @media (max-width: 640px) {
        .kpy-carousel-slide { flex: 0 0 100%; padding: 0 12px; }
        .kpy-carousel-arrow { width: 36px; height: 36px; font-size: 0.8rem; }
        .kpy-carousel-dots { gap: 6px; margin-top: 2rem; }
        .kpy-dot { width: 8px; height: 8px; }
    }
    @media (max-width: 768px) {
        .kpy-hero { min-height: auto; padding: 5rem 0; }
        .kpy-hero-title { font-size: 2.2rem; }
        .kpy-section-title { font-size: 2rem; }
        .kpy-intro-section,
        .kpy-deliverables-section,
        .kpy-packages-section,
        .kpy-faqs-section,
        .kpy-why-section,
        .kpy-cta-section { padding: 5rem 0; }
        .kpy-cta-box > .columns { padding: 2.5rem; }
        .kpy-cta-strip { padding: 1rem 2rem; }
        .kpy-gif-img { height: 280px; }
        .kpy-why-inner { flex-direction: column; }
        .kpy-offset-img-wrap { margin: 3rem 0 0; }
        .kpy-cta-img-wrap { margin-top: 2rem; }
        .kpy-pkg-badge { font-size: 1.1rem; padding: 1.2rem 1.5rem 0.2rem; }
        .kpy-pkg-features,
        .kpy-pkg-price-block,
        .kpy-pkg-type,
        .kpy-pkg-note-top,
        .kpy-pkg-note,
        .kpy-pkg-delivery,
        .kpy-pkg-btn { padding-left: 1.5rem; padding-right: 1.5rem; }
        .kpy-carousel-outer { gap: 0.5rem; }
        .kpy-carousel-arrow { width: 38px; height: 38px; font-size: 0.85rem; }
        .kpy-carousel-counter { font-size: 0.75rem; }
    }
    @media (max-width: 480px) {
        .kpy-carousel-arrow { width: 32px; height: 32px; font-size: 0.75rem; }
        .kpy-carousel-dots { gap: 5px; margin-top: 1.5rem; }
        .kpy-carousel-counter { font-size: 0.7rem; margin-top: 0.75rem; }
        .kpy-packages-section { padding: 3rem 0; }
    }
    </style>

    <!-- Red Wave Mesh Canvas Animation -->
    <script>
    (function () {
        var canvas = document.getElementById('kpyWaveCanvas');
        if (!canvas) return;
        var ctx = canvas.getContext('2d');

        function resize() {
            canvas.width  = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        var RIBBONS = 9, WAVES = 3, t = 0, ribbons = [];
        for (var r = 0; r < RIBBONS; r++) {
            var isGhost = r >= 6;
            ribbons.push({
                yBase    : 0.08 + (r / (RIBBONS - 1)) * 0.84,
                amp      : isGhost ? (0.03 + Math.random() * 0.05) : (0.07 + Math.random() * 0.13),
                freq     : 0.5  + Math.random() * 1.0,
                speed    : 0.003 + Math.random() * 0.007,
                phase    : Math.random() * Math.PI * 2,
                thickness: isGhost ? (0.4 + Math.random() * 0.8) : (0.8 + Math.random() * 3.0),
                opacity  : isGhost ? (0.06 + Math.random() * 0.10) : (0.15 + Math.random() * 0.35),
                lum      : isGhost ? 30 : (35 + Math.floor(Math.random() * 25)),
                sat      : 85 + Math.floor(Math.random() * 15),
            });
        }

        function drawRibbon(rb, t) {
            var W = canvas.width, H = canvas.height;
            ctx.beginPath();
            for (var i = 0; i <= 250; i++) {
                var xRatio = i / 250, x = xRatio * W, y = rb.yBase * H;
                for (var w = 0; w < WAVES; w++) {
                    y += Math.sin(xRatio * rb.freq * (w + 1) * 0.55 * Math.PI * 2
                         + t * rb.speed * (w % 2 === 0 ? 1 : -0.65) * 60
                         + rb.phase + w * 1.4) * (rb.amp * H / (w + 1));
                }
                i === 0 ? ctx.moveTo(x, y) : ctx.lineTo(x, y);
            }
            var grad = ctx.createLinearGradient(0, 0, W, 0);
            grad.addColorStop(0,    'hsla(0,' + rb.sat + '%,' + rb.lum + '%,0)');
            grad.addColorStop(0.12, 'hsla(0,' + rb.sat + '%,' + rb.lum + '%,' + (rb.opacity * 0.5) + ')');
            grad.addColorStop(0.45, 'hsla(0,' + rb.sat + '%,' + (rb.lum + 18) + '%,' + rb.opacity + ')');
            grad.addColorStop(0.72, 'hsla(0,' + rb.sat + '%,' + (rb.lum + 22) + '%,' + (rb.opacity * 1.15) + ')');
            grad.addColorStop(0.88, 'hsla(0,' + rb.sat + '%,' + rb.lum + '%,' + (rb.opacity * 0.6) + ')');
            grad.addColorStop(1,    'hsla(0,' + rb.sat + '%,' + rb.lum + '%,0)');
            ctx.strokeStyle = grad;
            ctx.lineWidth   = rb.thickness;
            ctx.shadowColor = 'rgba(200,0,12,0.55)';
            ctx.shadowBlur  = rb.thickness > 1.5 ? 22 : 8;
            ctx.stroke();
            ctx.shadowBlur  = 0;
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            t += 0.016;
            ribbons.forEach(function(rb) { drawRibbon(rb, t); });
            requestAnimationFrame(draw);
        }
        draw();
    })();
    </script>

    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });
    });
    </script>

    <!-- FAQ accordion -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.kpy-faq-q').forEach(function(q) {
            q.addEventListener('click', function() {
                var item = this.closest('.kpy-faq-item');
                var isOpen = item.classList.contains('active');
                document.querySelectorAll('.kpy-faq-item').forEach(function(i) { i.classList.remove('active'); });
                if (!isOpen) item.classList.add('active');
            });
        });
    });
    </script>

    <!-- Carousel (only runs when .kpy-carousel-outer exists in the DOM) -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var outer = document.querySelector('.kpy-carousel-outer');
        if (!outer) return;

        var track      = outer.querySelector('.kpy-carousel-track');
        var slides     = Array.from(outer.querySelectorAll('.kpy-carousel-slide'));
        var prevBtn    = outer.querySelector('.kpy-carousel-prev');
        var nextBtn    = outer.querySelector('.kpy-carousel-next');
        var dots       = Array.from(document.querySelectorAll('.kpy-dot'));
        var counterCur = document.querySelector('.kpy-counter-current');
        var total      = slides.length;
        var current    = 0;

        function visible() { return window.innerWidth <= 900 ? 1 : 2; }

        function maxIdx() { return Math.max(0, total - visible()); }

        function goTo(idx) {
            current = Math.min(Math.max(idx, 0), maxIdx());
            var v   = visible();

            /* update slide flex-basis */
            slides.forEach(function(s) { s.style.flex = '0 0 ' + (100 / v) + '%'; });

            track.style.transform = 'translateX(-' + ((100 / v) * current) + '%)';

            /** Update dots: on mobile (1 visible), show active based on current slide.
                On desktop (2 visible), show dots for current and next visible slide. **/
            dots.forEach(function(d, i) { 
                var isActive = (v === 1) ? (i === current) : (i === current || i === current + 1);
                d.classList.toggle('active', isActive); 
            });
            
            if (counterCur) counterCur.textContent = current + 1;
            if (prevBtn) prevBtn.disabled = current === 0;
            if (nextBtn) nextBtn.disabled = current >= maxIdx();
        }

        goTo(0);

        if (prevBtn) prevBtn.addEventListener('click', function() { goTo(current - 1); });
        if (nextBtn) nextBtn.addEventListener('click', function() { goTo(current + 1); });
        dots.forEach(function(d, i) { d.addEventListener('click', function() { goTo(i); }); });

        /* swipe support */
        var startX = null;
        track.addEventListener('touchstart', function(e) { startX = e.touches[0].clientX; }, { passive: true });
        track.addEventListener('touchend',   function(e) {
            if (startX === null) return;
            var diff = startX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) goTo(current + (diff > 0 ? 1 : -1));
            startX = null;
        }, { passive: true });

        window.addEventListener('resize', function() { goTo(Math.min(current, maxIdx())); });
    });
    </script>
    <?php
}
?>