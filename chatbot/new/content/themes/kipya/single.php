<?php 
    get_header(); 
    include get_template_directory() . '/inc/menus/menu.php'; 
?>
<main role="main">

    <section class="hero-section" >
        <!-- Solid black background -->
        <div class="hero-black-background"></div>

        <!-- SVG Background Layer with animated networks -->
        <div class="svg-background">
            <div class="svg-container">
                <!-- Network 1: Connected Nodes -->
                <svg class="network-svg network-1" viewBox="0 0 300 300">
                    <path d="M50 150 L120 80 L200 120 L250 180 L180 250 L80 220 L50 150" stroke="currentColor" fill="none" stroke-dasharray="4 6"/>
                    <path d="M120 80 L200 120 M200 120 L250 180 M180 250 L80 220 M80 220 L50 150" stroke="currentColor" fill="none" stroke-width="1"/>
                    <circle cx="50" cy="150" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="80" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="200" cy="120" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="250" cy="180" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="180" cy="250" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="80" cy="220" r="6" stroke="currentColor" fill="none"/>
                    <path d="M120 80 L80 220 M200 120 L180 250 M250 180 L50 150" stroke="currentColor" fill="none" stroke-dasharray="3 8" opacity="0.6"/>
                </svg>

                <!-- Network 2: Hexagon Pattern -->
                <svg class="network-svg network-2" viewBox="0 0 300 300">
                    <path d="M150 30 L240 90 L240 210 L150 270 L60 210 L60 90 L150 30" stroke="currentColor" fill="none" stroke-dasharray="5 5"/>
                    <path d="M150 30 L150 270 M60 90 L240 210 M60 210 L240 90" stroke="currentColor" fill="none" opacity="0.5"/>
                    <circle cx="150" cy="30" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="240" cy="90" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="240" cy="210" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="270" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="60" cy="210" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="60" cy="90" r="5" stroke="currentColor" fill="none"/>
                </svg>

                <!-- Network 3: Grid Pattern -->
                <svg class="network-svg network-3" viewBox="0 0 300 300">
                    <path d="M50 50 L250 50 M50 120 L250 120 M50 190 L250 190 M50 260 L250 260" stroke="currentColor" fill="none" opacity="0.4"/>
                    <path d="M50 50 L50 260 M120 50 L120 260 M190 50 L190 260 M260 50 L260 260" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="50" cy="50" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="50" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="190" cy="50" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="260" cy="50" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="50" cy="120" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="120" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="190" cy="120" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="260" cy="120" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="50" cy="190" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="190" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="190" cy="190" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="260" cy="190" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="50" cy="260" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="260" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="190" cy="260" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="260" cy="260" r="4" stroke="currentColor" fill="none"/>
                    <path d="M50 50 L260 260 M260 50 L50 260" stroke="currentColor" fill="none" stroke-dasharray="6 6" opacity="0.3"/>
                </svg>

                <!-- Network 4: Starburst Pattern -->
                <svg class="network-svg network-4" viewBox="0 0 300 300">
                    <circle cx="150" cy="150" r="50" stroke="currentColor" fill="none" stroke-dasharray="4 8"/>
                    <circle cx="150" cy="150" r="100" stroke="currentColor" fill="none" stroke-dasharray="4 6"/>
                    <path d="M150 30 L150 270 M30 150 L270 150 M70 70 L230 230 M230 70 L70 230" stroke="currentColor" fill="none" opacity="0.5"/>
                    <circle cx="150" cy="150" r="8" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="50" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="250" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="50" cy="150" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="250" cy="150" r="4" stroke="currentColor" fill="none"/>
                </svg>

                <!-- Network 5: Circular/Web Pattern -->
                <svg class="network-svg network-5" viewBox="0 0 300 300">
                    <circle cx="150" cy="150" r="40" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="150" cy="150" r="80" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="150" cy="150" r="120" stroke="currentColor" fill="none" opacity="0.4"/>
                    <path d="M150 30 L150 270" stroke="currentColor" fill="none" opacity="0.3"/>
                    <path d="M30 150 L270 150" stroke="currentColor" fill="none" opacity="0.3"/>
                    <path d="M70 70 L230 230" stroke="currentColor" fill="none" opacity="0.3"/>
                    <path d="M230 70 L70 230" stroke="currentColor" fill="none" opacity="0.3"/>
                    <circle cx="150" cy="150" r="8" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="70" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="230" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="70" cy="150" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="230" cy="150" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="100" cy="100" r="3" stroke="currentColor" fill="none"/>
                    <circle cx="200" cy="200" r="3" stroke="currentColor" fill="none"/>
                    <circle cx="100" cy="200" r="3" stroke="currentColor" fill="none"/>
                    <circle cx="200" cy="100" r="3" stroke="currentColor" fill="none"/>
                </svg>

                <!-- Network 6: Random Connections -->
                <svg class="network-svg network-6" viewBox="0 0 300 300">
                    <path d="M40 80 L120 40 L200 70 L260 120 L230 200 L160 250 L70 220 L40 150 L40 80" stroke="currentColor" fill="none" stroke-dasharray="3 4"/>
                    <path d="M120 40 L200 70 M200 70 L230 200 M230 200 L160 250 M160 250 L70 220 M70 220 L40 150 M40 150 L120 40" stroke="currentColor" fill="none"/>
                    <path d="M120 40 L160 250 M200 70 L70 220 M40 80 L230 200 M260 120 L70 220" stroke="currentColor" fill="none" opacity="0.5"/>
                    <circle cx="40" cy="80" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="40" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="200" cy="70" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="260" cy="120" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="230" cy="200" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="160" cy="250" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="70" cy="220" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="40" cy="150" r="5" stroke="currentColor" fill="none"/>
                </svg>

                <!-- Network 7: Spiral Web -->
                <svg class="network-svg network-7" viewBox="0 0 300 300">
                    <path d="M150 30 L150 270 M30 150 L270 150" stroke="currentColor" fill="none" opacity="0.3"/>
                    <path d="M70 70 L230 230 M230 70 L70 230" stroke="currentColor" fill="none" opacity="0.3"/>
                    <circle cx="150" cy="150" r="40" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="150" cy="150" r="80" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="150" cy="150" r="120" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="150" cy="60" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="240" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="60" cy="150" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="240" cy="150" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="100" cy="100" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="200" cy="200" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="100" cy="200" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="200" cy="100" r="4" stroke="currentColor" fill="none"/>
                    <path d="M150 60 L100 100 M150 60 L200 100 M150 240 L100 200 M150 240 L200 200 M60 150 L100 100 M60 150 L100 200 M240 150 L200 100 M240 150 L200 200" stroke="currentColor" fill="none" opacity="0.5"/>
                </svg>

                <!-- Network 8: Fractal Tree -->
                <svg class="network-svg network-8" viewBox="0 0 300 300">
                    <path d="M150 250 L150 150 M150 150 L100 100 M150 150 L200 100" stroke="currentColor" fill="none" stroke-width="1.5"/>
                    <path d="M100 100 L70 60 M100 100 L130 60 M200 100 L170 60 M200 100 L230 60" stroke="currentColor" fill="none" opacity="0.6"/>
                    <path d="M70 60 L50 30 M70 60 L90 30 M130 60 L110 30 M130 60 L150 30 M170 60 L150 30 M170 60 L190 30 M230 60 L210 30 M230 60 L250 30" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="150" cy="250" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="150" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="100" cy="100" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="200" cy="100" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="70" cy="60" r="3" stroke="currentColor" fill="none"/>
                    <circle cx="130" cy="60" r="3" stroke="currentColor" fill="none"/>
                    <circle cx="170" cy="60" r="3" stroke="currentColor" fill="none"/>
                    <circle cx="230" cy="60" r="3" stroke="currentColor" fill="none"/>
                </svg>

                <!-- Network 9: Additional web pattern -->
                <svg class="network-svg network-9" viewBox="0 0 300 300">
                    <path d="M50 100 L150 30 L250 100 L250 200 L150 270 L50 200 L50 100" stroke="currentColor" fill="none" stroke-dasharray="5 4"/>
                    <path d="M150 30 L150 270 M50 100 L250 200 M50 200 L250 100" stroke="currentColor" fill="none" opacity="0.5"/>
                    <circle cx="50" cy="100" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="30" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="250" cy="100" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="250" cy="200" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="270" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="50" cy="200" r="5" stroke="currentColor" fill="none"/>
                </svg>

                <!-- Network 10: Radial wave -->
                <svg class="network-svg network-10" viewBox="0 0 300 300">
                    <circle cx="150" cy="150" r="30" stroke="currentColor" fill="none" stroke-dasharray="3 5"/>
                    <circle cx="150" cy="150" r="70" stroke="currentColor" fill="none" stroke-dasharray="4 6"/>
                    <circle cx="150" cy="150" r="110" stroke="currentColor" fill="none" stroke-dasharray="5 7"/>
                    <path d="M150 50 L150 250 M50 150 L250 150 M80 80 L220 220 M220 80 L80 220" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="150" cy="150" r="6" stroke="currentColor" fill="none"/>
                </svg>
            </div>
        </div>

        <!-- Additional Connection Lines Overlay -->
        <div class="connection-lines"></div>

        <!-- Grid Lines Overlay -->
        <div class="grid-lines"></div>

        <!-- Hero Content Overlay -->
        <div class="hero-overlay">
            <div class="hero-header-content">
                <h2 class="kpy-page-title">
                    <?php the_title(); ?>
                </h2>
            </div>
        </div>
    </section>

    <section class="kpy-single-news-section">
        <div class="container">
            <div class="kpy-single-news-grid">

                <!-- Main Content -->
                <div class="kpy-main-content">
                    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('kpy-news-article'); ?>>

                            <div class="kpy-article-thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('full', array('class' => 'kpy-featured-image')); ?>
                                <?php endif; ?>
                            </div>

                            <div class="kpy-article-meta">
                                <span class="kpy-meta-date">
                                    <i class="bi bi-calendar3"></i>
                                    <?php the_time('F j, Y'); ?>
                                </span>
                                <span class="kpy-meta-author">
                                    <i class="bi bi-person"></i>
                                    <?php the_author(); ?>
                                </span>
                            </div>

                            <h1 class="kpy-article-title"><?php the_title(); ?></h1>

                            <div class="kpy-article-content">
                                <?php the_content(); ?>
                            </div>

                            <?php if (has_tag()) : ?>
                                <div class="kpy-article-tags">
                                    <span class="kpy-tags-label"><i class="bi bi-tags"></i> Tags:</span>
                                    <?php the_tags('', ' ', ''); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Share -->
                            <div class="kpy-share-section">
                                <h4 class="kpy-share-title">Share this article</h4>
                                <div class="kpy-share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= esc_url(get_permalink()); ?>" target="_blank" class="kpy-share-btn kpy-share-facebook">
                                        <i class="bi bi-facebook"></i>
                                        <span>Facebook</span>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?= esc_url(get_permalink()); ?>&text=<?= urlencode(get_the_title()); ?>" target="_blank" class="kpy-share-btn kpy-share-twitter">
                                        <i class="bi bi-twitter-x"></i>
                                        <span>Twitter</span>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= esc_url(get_permalink()); ?>" target="_blank" class="kpy-share-btn kpy-share-linkedin">
                                        <i class="bi bi-linkedin"></i>
                                        <span>LinkedIn</span>
                                    </a>
                                    <a href="https://wa.me/?text=<?= urlencode(get_the_title() . ' - ' . get_permalink()); ?>" target="_blank" class="kpy-share-btn kpy-share-whatsapp">
                                        <i class="bi bi-whatsapp"></i>
                                        <span>WhatsApp</span>
                                    </a>
                                </div>
                            </div>

                            <?php edit_post_link('Edit Post', '<div class="kpy-edit-link">', '</div>'); ?>
                        </article>
                    <?php endwhile; endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="kpy-sidebar">

                    <div class="kpy-sidebar-widget kpy-related-news-widget">
                        <h3 class="kpy-widget-title">
                            <span class="kpy-title-icon"><i class="bi bi-newspaper"></i></span>
                            Latest Stories
                        </h3>
                        
                       <?php
                    $related_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field'    => 'slug',
                                'terms'    => 'news',
                            ),
                        ),
                    );
                    $related_query = new WP_Query($related_args);
                    
                    if ($related_query->have_posts()) : ?>
                            <div class="kpy-horizontal-news-list">
                                <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                    <div class="kpy-horizontal-news-card">
                                        <a href="<?php the_permalink(); ?>" class="kpy-horizontal-news-link">
                                            <div class="kpy-horizontal-thumbnail" style="height:140px;">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php the_post_thumbnail('medium', array('class' => 'kpy-horizontal-image')); ?>
                                                <?php else : ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-news.jpg" alt="<?php the_title(); ?>" class="kpy-horizontal-image">
                                                <?php endif; ?>
                                            </div>
                                            <div class="kpy-horizontal-content">
                                                <span class="kpy-horizontal-date">
                                                    <i class="bi bi-calendar3"></i>
                                                    <?php echo get_the_date('M d, Y'); ?>
                                                </span>
                                                <h4 class="kpy-horizontal-title"><?php the_title(); ?></h4>
                                                <span class="kpy-horizontal-read-more">
                                                    Read More <i class="bi bi-arrow-right"></i>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                        <?php else : ?>
                            <p class="kpy-widget-empty">No related stories found.</p>
                        <?php endif; ?>
                    </div>

                    <!-- CTA Widget (Reusing donation styles) -->
<div class="kpy-sidebar-widget kpy-donation-widget">
    <div class="kpy-donation-content">
        
        <div class="kpy-donation-icon">
            <i class="bi bi-megaphone-fill"></i>
        </div>

        <h4 class="kpy-donation-title">Let’s Work Together</h4>

        <p class="kpy-donation-text">
            Have a project in mind or need a powerful digital solution? 
            Let’s help you build something amazing.
        </p>

        <a href="/contact" class="kpy-donation-btn">
            Get Started <i class="bi bi-arrow-right"></i>
        </a>

        <p class="kpy-donation-note">
            <i class="bi bi-check-circle"></i>
            Fast response. Professional support.
        </p>

    </div>
</div>

                </div>

            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

