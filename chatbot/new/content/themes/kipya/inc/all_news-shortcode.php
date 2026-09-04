<?php
function allNews_shortcode() {
    ob_start();

    $news_args = array(
        'post_type'      => 'post',
        'posts_per_page' => 20,
        'category_name'  => 'news,blog',
        'paged'          => max(1, get_query_var('paged') ?: 1),
    );

    $news_query = new WP_Query($news_args);
    ?>

    <div class="all-news-slider-container">
        
        <!-- News Grid -->
        <div class="all-news-grid-wrapper container">
            <div class="all-news-grid">
                <?php if ($news_query->have_posts()) : ?>
                    <?php while ($news_query->have_posts()) : $news_query->the_post(); 
                        // Calculate reading time (average 200-250 words per minute)
                        $content = get_post_field('post_content', get_the_ID());
                        $word_count = str_word_count(strip_tags($content));
                        $reading_time = ceil($word_count / 200);
                        $reading_time = max(1, $reading_time); // Minimum 1 minute
                        
                        // Get view count from post meta
                        $view_count = get_post_meta(get_the_ID(), '_post_views_count', true);
                        $view_count = $view_count ? number_format($view_count) : '0';
                    ?>
                        <div class="all-news-slide">
                            <article class="kpy-news-card">
                                <a href="<?= esc_url(get_permalink()); ?>" class="kpy-news-card-link">
                                    <div class="kpy-news-card-thumbnail">
                                        <?php if (has_post_thumbnail()) {
                                            the_post_thumbnail('large', ['class' => 'kpy-news-card-image']);
                                        } else {
                                            echo '<img src="'. get_template_directory_uri().'/assets/images/photo-placeholder.jpg" class="kpy-news-card-image"/>';
                                        } ?>
                                        <div class="kpy-news-overlay"></div>
                                        
                                        <!-- Date at top left (keeping original position) -->
                                        <span class="kpy-news-date"><?php echo get_the_date('F j, Y'); ?></span>
                                        
                                        <div class="kpy-news-overlay-content">
                                            <!-- Stats Icons above title with border -->
                                            <div class="kpy-news-stats-wrapper">
                                                <div class="kpy-news-stats">
                                                    <span class="kpy-news-stat">
                                                        <i class="fas fa-book-open"></i>
                                                        <?php echo $reading_time; ?> min read
                                                    </span>
                                                    <span class="kpy-news-stat">
                                                        <i class="fas fa-eye"></i>
                                                        <?php echo $view_count; ?> views
                                                    </span>
                                                </div>
                                                <div class="kpy-news-stats-border"></div>
                                            </div>
                                            
                                            <!-- Title -->
                                            <h3 class="kpy-news-title"><?php the_title(); ?></h3>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Pagination -->
        <div class="all-news-pagination">
            <?php
            echo paginate_links(array(
                'total'        => $news_query->max_num_pages,
                'current'      => max(1, get_query_var('paged')),
                'prev_text'    => __('‹'),
                'next_text'    => __('›'),
                'type'         => 'list',
                'add_args'     => false,
            ));
            ?>
        </div>
    </div>



    <?php
    return ob_get_clean();
}
add_shortcode('all_news', 'allNews_shortcode');



function news_slider_shortcode() {
    ob_start();

    $news_args = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'category_name' => 'news,blog',
    );

    $news_query = new WP_Query($news_args); ?>

    <div class="kpy-news-slider-container">

        <!-- Header -->
        <div class="kpy-sg-header">
            <div class="kpy-sg-title-container">
                <div class="kpy-sg-title-bg" aria-hidden="true">
                    What's Latest
                </div>

                <!-- MAIN TITLE -->
                <h2 class="kpy-sg-title">
                    <span class="kpy-sg-title-red">What's</span>
                    <span class="kpy-sg-title-white">Latest</span>
                </h2>
            </div>
        </div>

        <!-- Slider with Navigation in top right -->
        <div class="kpy-news-slider-wrapper container">
            <div class="kpy-news-slider-nav">
                <button class="kpy-news-slider-prev">‹</button>
                <button class="kpy-news-slider-next">›</button>
            </div>
            
            <div class="kpy-news-slider">
                <?php if ($news_query->have_posts()) : ?>
                    <?php while ($news_query->have_posts()) : $news_query->the_post(); 
                        // Calculate reading time
                        $content = get_post_field('post_content', get_the_ID());
                        $word_count = str_word_count(strip_tags($content));
                        $reading_time = ceil($word_count / 200);
                        $reading_time = max(1, $reading_time);
                        
                        // Get view count
                        $view_count = get_post_meta(get_the_ID(), '_post_views_count', true);
                        $view_count = $view_count ? number_format($view_count) : '0';
                    ?>
                        <div class="kpy-news-slide">
                            <article class="kpy-news-card">
                                <a href="<?= esc_url(get_permalink()); ?>" class="kpy-news-card-link">
                                    <div class="kpy-news-card-thumbnail">
                                        <?php if (has_post_thumbnail()) {
                                            the_post_thumbnail('large', ['class' => 'kpy-news-card-image']);
                                        } else {
                                            echo '<img src="'. get_template_directory_uri().'/assets/images/photo-placeholder.jpg" class="kpy-news-card-image"/>';
                                        } ?>

                                        <!-- Overlay -->
                                        <div class="kpy-news-overlay"></div>
                                        
                                        <!-- Date at top left (keeping original position) -->
                                        <span class="kpy-news-date"><?php echo get_the_date('F j, Y'); ?></span>

                                        <!-- Content at bottom -->
                                        <div class="kpy-news-overlay-content">
                                            <!-- Stats Icons above title with border -->
                                            <div class="kpy-news-stats-wrapper">
                                                <div class="kpy-news-stats">
                                                    <span class="kpy-news-stat">
                                                        <i class="fas fa-book-open"></i>
                                                        <?php echo $reading_time; ?> min read
                                                    </span>
                                                    <span class="kpy-news-stat">
                                                        <i class="fas fa-eye"></i>
                                                        <?php echo $view_count; ?> views
                                                    </span>
                                                </div>
                                                <div class="kpy-news-stats-border"></div>
                                            </div>
                                            
                                            <!-- Title -->
                                            <h3 class="kpy-news-title"><?php the_title(); ?></h3>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>



    <!-- SCRIPT -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.querySelector('.kpy-news-slider');
        const prevBtn = document.querySelector('.kpy-news-slider-prev');
        const nextBtn = document.querySelector('.kpy-news-slider-next');
        const slides = document.querySelectorAll('.kpy-news-slide');

        if (!slider || !prevBtn || !nextBtn || slides.length === 0) return;

        let currentIndex = 0;

        function getSlideWidth() {
            const slide = slides[0];
            const style = window.getComputedStyle(slide);
            const marginRight = parseFloat(style.marginRight) || 30;
            return slide.offsetWidth + marginRight;
        }

        function updateButtons() {
            const maxScroll = slider.scrollWidth - slider.clientWidth;
            prevBtn.disabled = slider.scrollLeft <= 0;
            nextBtn.disabled = slider.scrollLeft >= maxScroll - 1;
        }

        function scrollToSlide(index) {
            const slideWidth = getSlideWidth();
            const maxIndex = slides.length - 1;
            index = Math.max(0, Math.min(index, maxIndex));
            slider.scrollTo({
                left: index * slideWidth,
                behavior: 'smooth'
            });
            currentIndex = index;
        }

        prevBtn.addEventListener('click', () => {
            scrollToSlide(currentIndex - 1);
        });

        nextBtn.addEventListener('click', () => {
            scrollToSlide(currentIndex + 1);
        });

        slider.addEventListener('scroll', () => {
            const slideWidth = getSlideWidth();
            currentIndex = Math.round(slider.scrollLeft / slideWidth);
            updateButtons();
        });

        // Auto scroll
        let autoScrollInterval;
        let isHovered = false;

        function startAutoScroll() {
            if (autoScrollInterval) clearInterval(autoScrollInterval);
            autoScrollInterval = setInterval(() => {
                if (!isHovered && slides.length > 0) {
                    let nextIndex = (currentIndex + 1) % slides.length;
                    scrollToSlide(nextIndex);
                }
            }, 5000);
        }

        function stopAutoScroll() {
            if (autoScrollInterval) {
                clearInterval(autoScrollInterval);
                autoScrollInterval = null;
            }
        }

        slider.addEventListener('mouseenter', () => {
            isHovered = true;
            stopAutoScroll();
        });
        
        slider.addEventListener('mouseleave', () => {
            isHovered = false;
            startAutoScroll();
        });

        // Initial setup
        updateButtons();
        startAutoScroll();

        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                scrollToSlide(currentIndex);
            }, 250);
        });
    });
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('news_slider', 'news_slider_shortcode');

/**
 * Track post views for real numbers - More robust version
 */
function kpy_track_post_views($post_id) {
    // Only track on single posts
    if (!is_single()) return;
    
    // Get the post ID if not provided
    if (empty($post_id)) {
        global $post;
        if (!$post || empty($post->ID)) return;
        $post_id = $post->ID;
    }
    
    // Don't track if it's a revision or auto-save
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) return;
    
    // Don't track for admin users (optional - remove if you want to count admin views)
    if (current_user_can('manage_options')) return;
    
    $count_key = '_post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    
    // Check if the count exists
    if ($count == '' || $count === false) {
        // If not, create it with initial count of 1
        update_post_meta($post_id, $count_key, 1);
    } else {
        // Otherwise increment the count
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

// Hook into wp_head for single posts only
function kpy_init_view_tracking() {
    if (is_single()) {
        add_action('wp_head', 'kpy_track_post_views');
    }
}
add_action('wp', 'kpy_init_view_tracking');

// Alternative: Hook directly into template_redirect (more reliable)
function kpy_track_post_views_redirect() {
    if (is_single()) {
        global $post;
        if ($post && isset($post->ID)) {
            $count_key = '_post_views_count';
            $count = get_post_meta($post->ID, $count_key, true);
            
            if ($count == '' || $count === false) {
                update_post_meta($post->ID, $count_key, 1);
            } else {
                $count++;
                update_post_meta($post->ID, $count_key, $count);
            }
        }
    }
}
add_action('template_redirect', 'kpy_track_post_views_redirect');

// Function to display view count (for use in templates)
function kpy_get_post_views($post_id = null) {
    if (!$post_id) {
        global $post;
        $post_id = $post->ID;
    }
    
    $count = get_post_meta($post_id, '_post_views_count', true);
    if ($count == '' || $count === false) {
        return '0';
    }
    
    return number_format($count);
}

// Shortcode to display view count anywhere
function kpy_display_post_views_shortcode($atts) {
    $atts = shortcode_atts(array(
        'id' => null,
    ), $atts);
    
    $post_id = $atts['id'] ?: get_the_ID();
    return kpy_get_post_views($post_id);
}
add_shortcode('post_views', 'kpy_display_post_views_shortcode');
/**
 *******************************
 *  gallery
 *******************************
**/
function gallery_cards_shortcode($atts) {
    ob_start();
    
    // Shortcode attributes
    $atts = shortcode_atts(array(
        'posts_per_page' => -1,
        'category' => 'photo-gallery'
    ), $atts);
    
    // Pagination
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    // Query arguments
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $atts['posts_per_page'],
        'category_name' => $atts['category'],
        'paged' => $paged
    );
    
    $gallery_query = new WP_Query($args);
    
    if ($gallery_query->have_posts()) : ?>
        <div class="gallery-cards-container">
            <div class="gallery-grid">
                <?php while ($gallery_query->have_posts()) : $gallery_query->the_post(); ?>
                    <div class="gallery-card">
                        <a href="<?php the_permalink(); ?>" class="gallery-card-link">
                            <div class="gallery-thumbnail-wrapper">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', array('class' => 'gallery-thumbnail')); ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/photo-placeholder.jpg'); ?>" 
                                         alt="<?php esc_attr(the_title()); ?>" 
                                         class="gallery-thumbnail">
                                <?php endif; ?>
                                <div class="gallery-title-overlay">
                                    <h3 class="gallery-title"><?php the_title(); ?></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <div class="gallery-pagination">
                <?php
                echo paginate_links(array(
                    'total' => $gallery_query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => __('<span class="pagination-arrow">&larr;</span> Previous'),
                    'next_text' => __('Next <span class="pagination-arrow">&rarr;</span>'),
                    'type' => 'list',
                    'mid_size' => 2
                ));
                ?>
            </div>
        </div>
        
        
    <?php else : ?>
        <p class="no-galleries">No photo galleries found.</p>
    <?php endif;
    
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('gallery', 'gallery_cards_shortcode');

// Enhanced Fancybox initialization
function enqueue_lightbox_assets() {
    wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
    wp_enqueue_script('fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), null, true);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    
    wp_add_inline_script('fancybox-js', '
        jQuery(document).ready(function($) {
            $("[data-fancybox]").fancybox({
                buttons: ["zoom", "slideShow", "thumbs", "close"],
                animationEffect: "fade",
                transitionEffect: "slide",
                loop: true,
                infobar: true,
                toolbar: true,
                protect: false,
                modal: false,
                touch: {
                    vertical: true,
                    momentum: true
                },
                thumbs: {
                    autoStart: false,
                    hideOnClose: true,
                    parentEl: ".fancybox-container",
                    axis: "y"
                },
                caption: function(instance, item) {
                    var caption = $(item.opts.$orig).data("caption");
                    return caption && caption.trim() ? 
                        "<div class=\"fancybox-caption-custom\">" + caption + "</div>" : 
                        "";
                },
                beforeShow: function(instance, current) {
                    // Enhanced caption styling
                    if (!$("#fancybox-caption-styles").length) {
                        $("head").append(`
                            <style id="fancybox-caption-styles">
                                .fancybox-caption-custom {
                                    color: #fff !important;
                                    font-size: 16px;
                                    line-height: 1.4;
                                    padding: 12px 20px;
                                    background: rgba(0,0,0,0.8);
                                    border-radius: 6px;
                                    text-align: center;
                                    margin: 10px auto 0;
                                    max-width: 80%;
                                    backdrop-filter: blur(10px);
                                }
                                .fancybox-caption {
                                    color: #fff !important;
                                    text-align: center !important;
                                }
                                .fancybox-toolbar {
                                    background: rgba(0,0,0,0.5) !important;
                                }
                                @media (max-width: 768px) {
                                    .fancybox-caption-custom {
                                        font-size: 14px;
                                        padding: 10px 15px;
                                        max-width: 90%;
                                    }
                                }
                            </style>
                        `);
                    }
                }
            });
        });
    ');
}
add_action('wp_enqueue_scripts', 'enqueue_lightbox_assets');


// AJAX handler for image data
add_action('wp_ajax_get_image_data', 'get_image_data_callback');
add_action('wp_ajax_nopriv_get_image_data', 'get_image_data_callback');

function get_image_data_callback() {
    $image_id = intval($_GET['id']);
    $image_url = wp_get_attachment_image_url($image_id, 'full');
    $image_caption = get_the_title($image_id);
    
    wp_send_json(array(
        'url' => $image_url,
        'caption' => $image_caption
    ));
}





function kpy_get_service_icon_by_order($position) {
    $icons_in_order = [
        'fa-solid fa-comments',
        'fa-solid fa-chalkboard-user',
        'fa-solid fa-file-circle-check',
        'fa-solid fa-headset',
        'fa-solid fa-chess',
        'fa-solid fa-chart-line',
        'fa-solid fa-code',
        'fa-solid fa-bullhorn',
        'fa-solid fa-palette',
        'fa-solid fa-user-graduate',
        'fa-solid fa-chart-bar',
        'fa-solid fa-rocket',
        'fa-solid fa-screwdriver-wrench',
        'fa-solid fa-handshake',
        'fa-solid fa-magnifying-glass',
        'fa-solid fa-briefcase',
        'fa-solid fa-tasks',
        'fa-solid fa-calculator',
        'fa-solid fa-laptop-code',
        'fa-solid fa-paint-brush',
    ];
    
    $default_icon = 'fa-solid fa-arrow-right';
    $index = $position - 1;
    return isset($icons_in_order[$index]) ? $icons_in_order[$index] : $default_icon;
}

function kpy_services_overlap_shortcode($atts) {
    $atts = shortcode_atts([
        'taxonomy' => 'page_category',
        'term' => 'services',
        'bg' => '',
        'intro_bg' => '',
        'intro_title' => 'WHAT<br>WE DO',
        'intro_desc' => 'Comprehensive solutions tailored to your business needs'
    ], $atts);

    if (empty($atts['bg'])) { $atts['bg'] = get_template_directory_uri() . '/assets/images/default-bg.jpg'; }
    if (empty($atts['intro_bg'])) { $atts['intro_bg'] = get_template_directory_uri() . '/assets/images/intro-bg.jpg'; }

    $q = new WP_Query([
        'post_type' => 'page',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => [[
            'taxonomy' => $atts['taxonomy'],
            'field' => 'slug',
            'terms' => $atts['term']
        ]]
    ]);

    ob_start(); ?>
    
    <section class="kpy-services-hero" style="background-image:url('<?php echo esc_url($atts['bg']); ?>');">
        <div class="kpy-overlay"></div>
        <div class="kpy-hero-content" style="text-align: center; color: var(--kpy-white); z-index: 2; position: absolute; padding: 0 20px; top:60px;">
            <h1 style="font-size: 2.5rem; margin-bottom: 20px; font-weight: 700;font-family: var(--kpy-font-heading);">Our Services</h1>
            <p style="font-size: 18px; max-width: 600px; margin: 0 auto; opacity: 0.9;">Expert solutions designed to drive your business forward</p>
        </div>
    </section>

    <section class="kpy-services-grid-wrapper">
        <div class="kpy-services-grid">
            <div class="kpy-service-card kpy-intro-card" style="background-image:url('<?php echo esc_url($atts['intro_bg']); ?>');">
                <div class="kpy-overlay"></div>
                <div class="kpy-intro-content">
                    <h2><?php echo wp_kses_post($atts['intro_title']); ?></h2>
                    <p class="kpy-intro-description"><?php echo esc_html($atts['intro_desc']); ?></p>
                </div>
            </div>

            <?php 
            $counter = 0;
            while($q->have_posts()): 
                $q->the_post();
                $counter++;
                $icon = kpy_get_service_icon_by_order($counter);
                $excerpt = get_the_excerpt() ?: 'Learn more about our specialized service designed to meet your specific needs.';
            ?>
            
            <a href="<?php the_permalink(); ?>" class="kpy-service-card">
                <span class="kpy-service-number"><?php echo str_pad($counter, 2, '0', STR_PAD_LEFT); ?></span>
                <i class="kpy-icon <?php echo esc_attr($icon); ?>"></i>
                <div class="kpy-card-content">
                    <div class="kpy-card-main"></div>
                    <div class="kpy-card-footer">
                        <div class="kpy-card-text">
                            <h3 class="kpy-service-title"><?php the_title(); ?></h3>
                            <p class="kpy-service-excerpt"><?php echo esc_html($excerpt); ?></p>
                        </div>
                        <div class="kpy-arrow-btn">→</div>
                    </div>
                </div>
            </a>

            <?php 
            endwhile; 
            wp_reset_postdata(); 
            
            if ($counter % 2 != 0 || $counter < 6) : ?>
            <div class="kpy-service-card" style="background: linear-gradient(135deg, var(--kpy-primary), var(--kpy-base)); color: var(--kpy-white);">
                <div class="kpy-intro-content">
                    <span class="kpy-small-title" style="color: rgba(255,255,255,0.9); border-color: rgba(255,255,255,0.3);">READY TO START?</span>
                    <p style="opacity: 0.9; margin-bottom: 25px;">Contact us for a personalized consultation and discover how we can help you achieve your goals.</p>
                    <a href="<?php echo esc_url(home_url('/becoming-a-member')); ?>" style="display: inline-block; background: var(--kpy-white); color: var(--kpy-base); padding: 12px 30px; border-radius: 18PX 0; text-decoration: none; font-weight: 600; transition: transform 0.3s ease;">Become A Member →</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php return ob_get_clean();
}
add_shortcode('kpy_services', 'kpy_services_overlap_shortcode');

function iwca_page_cards_shortcode($atts) {

    ob_start();

    // Shortcode attributes
    $atts = shortcode_atts(
        array(
            'category' => '', // ongoing | complete | empty = both
        ),
        $atts,
        'iwca_page_cards'
    );

    // Tax query
    $tax_query = array();

    if (!empty($atts['category'])) {
        $tax_query[] = array(
            'taxonomy' => 'page_category',
            'field'    => 'slug',
            'terms'    => $atts['category'],
        );
    } else {
        $tax_query[] = array(
            'taxonomy' => 'page_category',
            'field'    => 'slug',
            'terms'    => array('ongoing', 'complete'),
        );
    }

    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'tax_query'      => $tax_query,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) : ?>

        <section class="business-services-section" style="background:rgba(92, 50, 36, 0.01);">


            <div class="business-services-grid">

                <?php while ($query->have_posts()) : $query->the_post(); ?>

                    <a href="<?php the_permalink(); ?>" class="service-card-link">
                        <div class="service-card">

                            <div class="service-card-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large'); ?>
                                <?php endif; ?>

                                <div class="image-overlay"></div>

                                <div class="service-title-overlay">
                                    <h3><?php the_title(); ?></h3>
                                </div>

                            </div>

                        </div>
                    </a>

                <?php endwhile; ?>

            </div>
        </section>

    <?php
    else :
        echo '<p>No projects found.</p>';
    endif;

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('iwca_page_cards', 'iwca_page_cards_shortcode');



?>