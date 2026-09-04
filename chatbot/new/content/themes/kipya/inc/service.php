<?php
/**
 * Services Grid Shortcode - Updated Version
 */
if ( ! function_exists( 'kpy_services_grid_shortcode' ) ) {

    function kpy_services_grid_shortcode( $atts ) {

        $atts = shortcode_atts( [
            'category'      => 'service',
            'media_url'     => '',
            'media_type'    => '',
            'title'         => 'Our Services',
            'subtitle'      => 'We work with enterprises, organizations, and businesses from various industries.',
            'posts_per_page'=> 6,
        ], $atts, 'kpy_services_grid' );

        // DEBUG: Check if media_url is being passed
        $debug_info = '';
        if ( empty( $atts['media_url'] ) ) {
            $debug_info = '<!-- DEBUG: media_url is EMPTY. Please add media_url="your-image-url.jpg" to the shortcode -->';
        } else {
            $debug_info = '<!-- DEBUG: media_url = ' . esc_url( $atts['media_url'] ) . ' -->';
        }

        // Auto-detect media type
        $media_type = $atts['media_type'];
        if ( empty( $media_type ) && ! empty( $atts['media_url'] ) ) {
            $url_parts = parse_url( $atts['media_url'] );
            $path = $url_parts['path'] ?? '';
            $extension = strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );
            
            $video_extensions = ['mp4', 'webm', 'ogg', 'mov', 'm4v'];
            $image_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
            
            if ( in_array( $extension, $video_extensions ) ) {
                $media_type = 'video';
            } elseif ( in_array( $extension, $image_extensions ) ) {
                $media_type = 'image';
            } else {
                $media_type = 'image'; // Default to image
            }
        }

        $query = new WP_Query( [
            'post_type'      => 'page',
            'posts_per_page' => intval( $atts['posts_per_page'] ),
            'orderby'        => 'date',
            'order'          => 'DESC',
            'tax_query'      => [
                [
                    'taxonomy' => 'page_category',
                    'field'    => 'slug',
                    'terms'    => array( sanitize_title( $atts['category'] ) ),
                ],
            ],
        ] );

        $pages = $query->posts;

        // Service icons mapping
        $service_icons = [
            'web hosting' => 'fas fa-server',
            'digital security' => 'fas fa-shield-alt',
            'app and software development' => 'fas fa-code',
            'seo and maintenance' => 'fas fa-chart-line',
            'domain' => 'fas fa-globe',
            'domains' => 'fas fa-globe',
            'web solution' => 'fas fa-laptop-code',
            'web solutions' => 'fas fa-laptop-code',
        ];

        $uid = 'kpy-sg-' . uniqid();
        wp_enqueue_style( 'font-awesome-6', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), '6.4.2' );

        ob_start();
        echo $debug_info;
        ?>
        <div class="kpy-sg-wrapper" id="<?php echo esc_attr( $uid ); ?>">

            <!-- Section Header -->
            <div class="kpy-sg-header">
                <div class="kpy-sg-title-container">
                    <div class="kpy-sg-title-bg" aria-hidden="true">
                        What We Do
                    </div>
                    <h2 class="kpy-sg-title">
                        <span class="kpy-sg-title-red">Our</span>
                        <span class="kpy-sg-title-white">Services</span>
                    </h2>
                </div>
               
            </div>

            <!-- Grid -->
            <div class="kpy-sg-grid">

                <!-- Hero Card with Media -->
                <div class="kpy-sg-card kpy-sg-card--hero">
                    <?php if ( ! empty( $atts['media_url'] ) ) : ?>
                        <?php if ( $media_type === 'video' ) : ?>
                            <video
                                class="kpy-sg-media kpy-sg-video"
                                src="<?php echo esc_url( $atts['media_url'] ); ?>"
                                autoplay
                                loop
                                muted
                                playsinline
                                preload="auto"
                            ></video>
                        <?php else : ?>
                            <img 
                                class="kpy-sg-media kpy-sg-image"
                                src="<?php echo esc_url( $atts['media_url'] ); ?>"
                                alt="Hero background"
                                loading="lazy"
                            />
                        <?php endif; ?>
                    <?php else : ?>
                        <div class="kpy-sg-media kpy-sg-media--placeholder">
                            <?php if ( current_user_can( 'manage_options' ) ) : ?>
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white; background: rgba(0,0,0,0.7); padding: 20px; border-radius: 10px;">
                                    <p style="margin: 0; font-size: 14px;">⚠️ ADMIN NOTICE: Please add media_url parameter to the shortcode</p>
                                    <p style="margin: 5px 0 0; font-size: 12px;">Example: [kpy_services_grid media_url="https://your-site.com/image.jpg"]</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Overlay Content - Left Aligned -->
                    <div class="kpy-sg-hero-overlay">
                        <div class="kpy-sg-hero-content kpy-sg-hero-content--left">
                            <div class="kpy-sg-hero-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h3 class="kpy-sg-hero-title">Innovative Solutions</h3>
                            <p class="kpy-sg-hero-description">Transforming ideas into reality with cutting-edge technology, expert craftsmanship, and a passion for innovation. We build digital solutions that are powerful, intuitive, and designed to help your business succeed.</p>
                        </div>
                    </div>
                </div>

                <!-- Service Cards -->
                <?php if ( $pages ) : ?>
                    <?php foreach ( $pages as $index => $page ) : ?>
                        <?php
                        // Clean excerpt
                        if ( ! empty( $page->post_excerpt ) ) {
                            $excerpt = strip_shortcodes( $page->post_excerpt );
                            $excerpt = wp_strip_all_tags( $excerpt );
                        } else {
                            $excerpt = wp_trim_words( strip_shortcodes( $page->post_content ), 20, '...' );
                            $excerpt = wp_strip_all_tags( $excerpt );
                        }
                        
                        $link = get_permalink( $page->ID );
                        $name = strtolower( get_the_title( $page ) );
                        
                        // Determine icon
                        $icon_class = 'fas fa-cube';
                        foreach ( $service_icons as $service_name => $icon ) {
                            if ( strpos( $name, $service_name ) !== false ) {
                                $icon_class = $icon;
                                break;
                            }
                        }
                        ?>
                        <a href="<?php echo esc_url( $link ); ?>" class="kpy-sg-card kpy-sg-card--service">
                            <div class="kpy-sg-card__glass-bg"></div>
                            <div class="kpy-sg-card__inner">
                                <div class="kpy-sg-icon-container">
                                    <i class="<?php echo $icon_class; ?> kpy-sg-fa-icon"></i>
                                </div>
                                <span class="kpy-sg-card__name"><?php echo esc_html( get_the_title( $page ) ); ?></span>
                            </div>
                            
                            <!-- Excerpt Overlay (appears on hover) -->
                            <?php if ( ! empty( $excerpt ) ) : ?>
                                <div class="kpy-sg-card__excerpt-overlay">
                                    <div class="kpy-sg-card__excerpt-content">
                                        <?php echo esc_html( $excerpt ); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Red hover overlay -->
                            <div class="kpy-sg-card__red-overlay"></div>
                            <div class="kpy-sg-card__edge-highlight"></div>
                        </a>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="kpy-sg-empty">No services found for category <em><?php echo esc_html( $atts['category'] ); ?></em>.</p>
                <?php endif; ?>

            </div>
        </div>



        <?php
        return ob_get_clean();
    }

    add_shortcode( 'kpy_services_grid', 'kpy_services_grid_shortcode' );
}