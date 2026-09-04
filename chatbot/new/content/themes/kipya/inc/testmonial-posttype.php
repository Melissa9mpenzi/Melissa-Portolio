<?php
/**
 * Plugin Name: KPY Testimonials Slider
 * Description: Custom Post Type for Testimonials with a responsive slider shortcode.
 * Version: 1.0.0
 * Author: Your Name
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register Testimonial Custom Post Type
 */
function kpy_register_testimonial_cpt() {
    $labels = array(
        'name'               => 'Testimonials',
        'singular_name'      => 'Testimonial',
        'menu_name'          => 'Testimonials',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Testimonial',
        'edit_item'          => 'Edit Testimonial',
        'new_item'           => 'New Testimonial',
        'view_item'          => 'View Testimonial',
        'search_items'       => 'Search Testimonials',
        'not_found'          => 'No testimonials found',
        'not_found_in_trash' => 'No testimonials found in trash',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
        'menu_icon'           => 'dashicons-format-quote',
    );

    register_post_type( 'kpy_testimonial', $args );
}
add_action( 'init', 'kpy_register_testimonial_cpt' );


/**
 * Shortcode to display testimonials slider
 * Usage: [kpy_testimonials_slider]
 */
function kpy_testimonials_slider_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'posts_per_page' => -1,
    ), $atts );

    $args = array(
        'post_type'      => 'kpy_testimonial',
        'posts_per_page' => $atts['posts_per_page'],
        'post_status'    => 'publish',
    );

    $testimonials = get_posts( $args );

    if ( empty( $testimonials ) ) {
        return '<p>No testimonials found.</p>';
    }

    $slider_id = 'kpy-slider-' . uniqid();
    
    ob_start();
    ?>
    <div class="kpy-testimonials-wrapper">
        <div class="kpy-sg-header">
            <div class="kpy-sg-title-container">
                <div class="kpy-sg-title-bg" aria-hidden="true">
                    Testimonials
                </div>
                <h2 class="kpy-sg-title">
                    <span class="kpy-sg-title-red">What Our</span>
                    <span class="kpy-sg-title-white">Clients Say</span>
                </h2>
            </div>
        </div>
        
        <!-- Navigation above cards -->
        <div class="kpy-slider-nav">
            <button class="testimonial-prev" data-slider="<?php echo esc_attr($slider_id); ?>">‹</button>
            <button class="testimonial-next" data-slider="<?php echo esc_attr($slider_id); ?>">›</button>
        </div>
        
        <div class="kpy-testimonials-slider container" id="<?php echo esc_attr($slider_id); ?>">
            <div class="kpy-slider-track">
                <?php foreach ( $testimonials as $testimonial ) : 
                    $name = get_the_title( $testimonial->ID );
                    $content = get_post_field( 'post_content', $testimonial->ID );
                    $position = get_post_meta( $testimonial->ID, '_kpy_testimonial_position', true );
                    $badge_text = get_post_meta( $testimonial->ID, '_kpy_testimonial_badge', true );
                    $thumbnail_id = get_post_thumbnail_id( $testimonial->ID );
                    $avatar_url = '';
                    $has_avatar = false;

                    if ( $thumbnail_id ) {
                        $avatar_url = wp_get_attachment_image_url( $thumbnail_id, 'medium' );
                        if ( $avatar_url ) {
                            $has_avatar = true;
                        }
                    }

                    $first_letter = ! empty( $name ) ? mb_substr( $name, 0, 1 ) : 'U';
                    $clean_content = wp_strip_all_tags( $content );
                ?>
                    <div class="kpy-slide">
                        <div class="single-testimonials-item kpy-testimonial-card">
                            <?php if ( ! empty( $badge_text ) ) : ?>
                                <div class="kpy-testimonial-title-badge">
                                    <?php echo esc_html( $badge_text ); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="kpy-testimonial-text">
                                <?php echo nl2br( esc_html( $clean_content ) ); ?>
                            </div>
                            
                            <div class="kpy-testimonial-author-section">
                                <div class="kpy-testimonial-avatar">
                                    <?php if ( $has_avatar ) : ?>
                                        <img src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_attr( $name ); ?>">
                                    <?php else : ?>
                                        <span class="kpy-testimonial-initial"><?php echo esc_html( $first_letter ); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="kpy-testimonial-author-info">
                                    <strong><?php echo esc_html( $name ); ?></strong>
                                    <?php if ( ! empty( $position ) ) : ?>
                                        <span><?php echo esc_html( $position ); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="kpy-slider-pagination" data-slider="<?php echo esc_attr($slider_id); ?>"></div>
    </div>
    
    <style>
        /* Testimonial Card Styles */
        .kpy-testimonial-card {
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 30px;
            margin: 10px;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        /* Title Badge - Top of Card */
        .kpy-testimonial-title-badge {
            color: white;
            padding: 8px 0;
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
            display: inline-block;
            margin-bottom: 5px;
            align-self: flex-start;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            letter-spacing: 0.5px;
        }
        

    </style>
    
    <script>
    (function() {
        var sliderId = '<?php echo esc_js($slider_id); ?>';
        var container = document.getElementById(sliderId);
        if (!container) return;
        
        var track = container.querySelector('.kpy-slider-track');
        var slides = container.querySelectorAll('.kpy-slide');
        var prevBtn = document.querySelector('.testimonial-prev[data-slider="' + sliderId + '"]');
        var nextBtn = document.querySelector('.testimonial-next[data-slider="' + sliderId + '"]');
        var pagination = document.querySelector('.kpy-slider-pagination[data-slider="' + sliderId + '"]');
        
        var slidesPerView = 2;
        var currentIndex = 0;
        var totalSlides = slides.length;
        var autoplayInterval;
        
        // Check screen size for slides per view
        function updateSlidesPerView() {
            if (window.innerWidth < 768) {
                slidesPerView = 1;
            } else {
                slidesPerView = 2;
            }
            return slidesPerView;
        }
        
        // Update slider position
        function updateSlider() {
            if (!slides.length) return;
            var slideWidth = slides[0].offsetWidth;
            var gap = 30; // Gap between slides
            var offset = -(currentIndex * (slideWidth + gap));
            track.style.transform = 'translateX(' + offset + 'px)';
            updatePagination();
        }
        
        // Update pagination dots
        function updatePagination() {
            if (!pagination) return;
            
            var totalGroups = Math.ceil(totalSlides / slidesPerView);
            pagination.innerHTML = '';
            
            for (var i = 0; i < totalGroups; i++) {
                var dot = document.createElement('span');
                dot.classList.add('kpy-pagination-dot');
                var activeGroup = Math.floor(currentIndex / slidesPerView);
                if (i === activeGroup) {
                    dot.classList.add('active');
                }
                dot.addEventListener('click', (function(index) {
                    return function() {
                        currentIndex = index * slidesPerView;
                        if (currentIndex >= totalSlides) {
                            currentIndex = totalSlides - slidesPerView;
                        }
                        if (currentIndex < 0) currentIndex = 0;
                        updateSlider();
                        resetAutoplay();
                    };
                })(i));
                pagination.appendChild(dot);
            }
        }
        
        // Next slide
        function nextSlide() {
            var maxIndex = totalSlides - slidesPerView;
            if (currentIndex + slidesPerView < totalSlides) {
                currentIndex += slidesPerView;
            } else {
                currentIndex = 0;
            }
            updateSlider();
        }
        
        // Previous slide
        function prevSlide() {
            if (currentIndex - slidesPerView >= 0) {
                currentIndex -= slidesPerView;
            } else {
                currentIndex = totalSlides - slidesPerView;
                if (currentIndex < 0) currentIndex = 0;
            }
            updateSlider();
        }
        
        // Reset autoplay timer
        function resetAutoplay() {
            if (autoplayInterval) {
                clearInterval(autoplayInterval);
                autoplayInterval = setInterval(nextSlide, 5000);
            }
        }
        
        // Start autoplay
        function startAutoplay() {
            if (autoplayInterval) clearInterval(autoplayInterval);
            autoplayInterval = setInterval(nextSlide, 5000);
        }
        
        // Handle window resize
        var resizeTimeout;
        function handleResize() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                var oldSlidesPerView = slidesPerView;
                updateSlidesPerView();
                if (oldSlidesPerView !== slidesPerView) {
                    currentIndex = 0;
                    updateSlider();
                }
                updateSlider();
            }, 100);
        }
        
        // Initialize slider
        function initSlider() {
            if (totalSlides === 0) return;
            
            updateSlidesPerView();
            updateSlider();
            
            // Event listeners
            if (prevBtn) prevBtn.addEventListener('click', function() { prevSlide(); resetAutoplay(); });
            if (nextBtn) nextBtn.addEventListener('click', function() { nextSlide(); resetAutoplay(); });
            window.addEventListener('resize', handleResize);
            
            // Start autoplay
            startAutoplay();
            
            // Pause autoplay on hover
            container.addEventListener('mouseenter', function() {
                if (autoplayInterval) clearInterval(autoplayInterval);
            });
            container.addEventListener('mouseleave', function() {
                startAutoplay();
            });
        }
        
        // Wait for images to load then initialize
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSlider);
        } else {
            initSlider();
        }
    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode( 'kpy_testimonials_slider', 'kpy_testimonials_slider_shortcode' );

/**
 * Add meta box for testimonial position/role and badge
 */
function kpy_testimonial_add_meta_box() {
    add_meta_box(
        'kpy_testimonial_details',
        'Testimonial Details',
        'kpy_testimonial_meta_box_callback',
        'kpy_testimonial',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'kpy_testimonial_add_meta_box' );

function kpy_testimonial_meta_box_callback( $post ) {
    wp_nonce_field( 'kpy_testimonial_save_data', 'kpy_testimonial_nonce' );
    $position = get_post_meta( $post->ID, '_kpy_testimonial_position', true );
    $badge_text = get_post_meta( $post->ID, '_kpy_testimonial_badge', true );
    ?>
    <p>
        <label for="kpy_testimonial_position">Position/Role (e.g., CEO at Envato):</label>
        <input type="text" id="kpy_testimonial_position" name="kpy_testimonial_position" value="<?php echo esc_attr( $position ); ?>" style="width: 100%;" />
    </p>
    <p>
        <label for="kpy_testimonial_badge">Title Badge (e.g., it has fantastic):</label>
        <input type="text" id="kpy_testimonial_badge" name="kpy_testimonial_badge" value="<?php echo esc_attr( $badge_text ); ?>" style="width: 100%;" placeholder="Enter title badge text" />
        <small>This will appear as a styled title badge at the top of each testimonial card.</small>
    </p>
    <?php
}

function kpy_testimonial_save_meta_data( $post_id ) {
    if ( ! isset( $_POST['kpy_testimonial_nonce'] ) || ! wp_verify_nonce( $_POST['kpy_testimonial_nonce'], 'kpy_testimonial_save_data' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['kpy_testimonial_position'] ) ) {
        update_post_meta( $post_id, '_kpy_testimonial_position', sanitize_text_field( $_POST['kpy_testimonial_position'] ) );
    }
    if ( isset( $_POST['kpy_testimonial_badge'] ) ) {
        update_post_meta( $post_id, '_kpy_testimonial_badge', sanitize_text_field( $_POST['kpy_testimonial_badge'] ) );
    }
}
add_action( 'save_post', 'kpy_testimonial_save_meta_data' );

/**
 * Create JS file (fallback)
 */
function kpy_create_js_file() {
    $js_dir = plugin_dir_path( __FILE__ ) . 'js';
    if ( ! file_exists( $js_dir ) ) {
        wp_mkdir_p( $js_dir );
    }
    $js_file = $js_dir . '/testimonial-slider.js';
    if ( ! file_exists( $js_file ) ) {
        $js_content = "// Main slider initialization is handled inline in the shortcode\nconsole.log('KPY Testimonials Slider - Ready');";
        file_put_contents( $js_file, $js_content );
    }
}
register_activation_hook( __FILE__, 'kpy_create_js_file' );
add_action( 'admin_init', 'kpy_create_js_file' );