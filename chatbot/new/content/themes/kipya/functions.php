<?php
/**
 * Kipya functions and definitions.
 *
 * @link https://urreno.org
 *
 * @package Kipya
 */

set_time_limit(300); // Set to a higher value if needed
if ( ! function_exists( 'kipya_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function kipya_setup() {
		// Make the theme available for translation.
		load_theme_textdomain( 'kipya', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

        //Upload Logo in website.
        add_theme_support('custom-logo');

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register navigation menus.
		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary Menu', 'kipya' ),
			'top-menu'  => esc_html__( 'Top Menu', 'kipya' ),
            'sidebar'   => esc_html__( 'Sidebar Menu', 'kipya' ),
            'footer'    => esc_html__( 'Footer Menu', 'kipya' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'kipya', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'kipya_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

        /**
		 * Enable support for the following post formats:
		 * aside, gallery, quote, image, and video
		 */
        add_theme_support( 'post-formats', array( 'aside', 'gallery', 'quote', 'image', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'kipya_setup' );

// Enqueue styles.
function kipya_styles() {
    wp_register_style('kipya-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all');
    wp_register_style('custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0', 'all');
    wp_register_style('animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '4.1.1', 'all');
    wp_register_style('bulma', 'https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css', array(), '1.0.0', 'all');
    wp_register_style('aos', get_template_directory_uri() . '/assets/vendor/aos/aos.css', array(), '2.3.4', 'all');
    wp_register_style('swiper', get_template_directory_uri() . '/assets/vendor/swiper/swiper.min.css', array(), '5.4.5', 'all');
    wp_register_style('toastr.min', get_template_directory_uri() . '/assets/vendor/toastr/toastr.min.css', array(), '2.1.3', 'all');
    wp_register_style('datatables.min', get_template_directory_uri() . '/assets/vendor/DataTables/datatables.min.css', array(), '1.13.3', 'all');



    wp_enqueue_style( 'kipya-style');
    wp_enqueue_style( 'bulma');
    wp_enqueue_style( 'custom');
    wp_enqueue_style( 'aos');
    wp_enqueue_style( 'swiper');
    wp_enqueue_style( 'toastr.min');
    wp_enqueue_style( 'datatables.min');
}
add_action( 'wp_enqueue_scripts', 'kipya_styles' );

// Enqueue scripts.
function kipya_scripts() {

    // WordPress already ships with jQuery; use it as a dependency when needed.
    wp_enqueue_script( 'aos-script', get_template_directory_uri() . '/assets/vendor/aos/aos.js', array(), '2.3.4', true);
    wp_enqueue_script( 'swiper-script', get_template_directory_uri() . '/assets/vendor/swiper/swiper.min.js', array(), '5.4.5', true);
    wp_enqueue_script( 'toastr-script', get_template_directory_uri() . '/assets/vendor/toastr/toastr.min.js', array('jquery'), '2.1.3', true);
    wp_enqueue_script( 'kipya-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script( 'kipya-bulma-ui', get_template_directory_uri() . '/assets/js/bulma-ui.js', array(), '1.0.0', true);
    wp_enqueue_script( 'search-script', get_template_directory_uri() . '/assets/js/search.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script( 'datatables.min', get_template_directory_uri() . '/assets/vendor/DataTables/datatables.min.js', array('jquery'), '1.13.3', true);

    // Pass the ajaxurl to search.js
    wp_localize_script('search-script', 'kipya_ajax_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action( 'wp_enqueue_scripts', 'kipya_scripts' );

// ligtbox-gallery
function enqueue_custom_scripts() {
    // Enqueue lightbox library
    wp_enqueue_style('lightbox-css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css');
    wp_enqueue_script('lightbox-js', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array('jquery'), null, true);

    // Enqueue custom JavaScript
    wp_enqueue_script('custom-gallery-lightbox', get_template_directory_uri() . '/assets/js/gallery-lightbox.js', array('jquery'), null, true);

    // Enqueue custom AJAX script for projects page
    if (is_page('projects-page')) {
        wp_enqueue_script('custom-ajax-script', get_template_directory_uri() . '/assets/js/custom-ajax-script.js', array('jquery'), null, true);
        wp_localize_script('custom-ajax-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'kipya'),
        'description' => __('Description for this widget-area...', 'kipya'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'kipya'),
        'description' => __('Description for this widget-area...', 'kipya'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar( array(
        'name'          => esc_html__( 'Top Left', 'kipya' ),
        'id'            => 'topl',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
	register_sidebar( array(
        'name'          => esc_html__( 'Top Right', 'kipya' ),
        'id'            => 'topr',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
	register_sidebar( array(
        'name'          => esc_html__( 'Search Area', 'kipya' ),
        'id'            => 'searchi',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
	register_sidebar( array(
        'name'          => esc_html__( 'Quick Number', 'kipya' ),
        'id'            => 'inno',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Menu Right', 'kipya' ),
        'id'            => 'nav-right',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar(array(
        'name' => __('Services Sidebar', 'kipya'),
        'description' => __('Description for this widget-area...', 'kipya'),
        'id' => 'servsidebar',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Advert Top', 'kipya' ),
        'id'            => 'advtop',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
     register_sidebar( array(
        'name'          => esc_html__( 'Newsletter', 'kipya' ),
        'id'            => 'footernewz',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Starter', 'kipya' ),
        'id'            => 'footeri',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
	register_sidebar( array(
        'name'          => esc_html__( 'Footer A', 'kipya' ),
        'id'            => 'footera',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
	register_sidebar( array(
        'name'          => esc_html__( 'Footer B', 'kipya' ),
        'id'            => 'footerb',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
	register_sidebar( array(
        'name'          => esc_html__( 'Footer C', 'kipya' ),
        'id'            => 'footerc',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer D', 'kipya' ),
        'id'            => 'footerd',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
     register_sidebar( array(
        'name'          => esc_html__( 'Copyright Links', 'kipya' ),
        'id'            => 'footer-links',
        'description'   => esc_html__( 'Add widgets here.', 'kipya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}

//Activate Excerpt in PAGES
function enable_page_excerpts() {
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'enable_page_excerpts');

/*
**************************
*************************
Gallery functionality
*************************
*************************
*/
function load_custom_single_template($template) {
    if (is_single() && in_category('photo-gallery')) {
        $new_template = locate_template(array('single-gallery.php'));
        if ($new_template) {
            return $new_template;
        }
    }
    if (is_singular('events')) {
        $eve_template = locate_template(array('single-event.php'));
        if ($eve_template) {
            return $eve_template;
        }
    }
    return $template;
}
add_filter('single_template', 'load_custom_single_template');

function force_gallery_links_to_media($block_content, $block) {
    if ($block['blockName'] === 'core/gallery' && !empty($block['innerBlocks'])) {
        foreach ($block['innerBlocks'] as &$innerBlock) {
            if ($innerBlock['blockName'] === 'core/image' && isset($innerBlock['attrs']['id'])) {
                $image_id = $innerBlock['attrs']['id'];
                $image_url = wp_get_attachment_url($image_id);
                if ($image_url) {
                    $innerBlock['attrs']['linkDestination'] = 'media';
                    $innerBlock['attrs']['href'] = $image_url;
                }
            }
        }
    }
    return $block_content;
}
add_filter('render_block', 'force_gallery_links_to_media', 10, 2);

// Custom menu walkers
include get_template_directory() . '/inc/custom-nav-walker.php';

//Custom Post Type :: SEO 
include get_template_directory() . '/inc/seo-post-types.php';

//Custom Post Type :: SEARCH
include get_template_directory() . '/inc/ajax-search.php';

//Custom Post Type :: SLIDING PHOTOS 
include get_template_directory() . '/inc/slides-post-types.php';

//Add Page Category
include get_template_directory() . '/inc/add_page_category.php';

//Custom Post Type :: DOWNLOADS
include get_template_directory() . '/inc/downloads-post-types.php';
include get_template_directory() . '/inc/youtube-playlist.php';
//Custom Post Type :: TEAMS
include get_template_directory() . '/inc/team-post-types.php';

//Custom Post Type :: PARTNERS
include get_template_directory() . '/inc/partners-post-types.php';
include get_template_directory() . '/inc/partner-form.php';
include get_template_directory() . '/inc/service.php';
include get_template_directory() . '/inc/services-renderer.php';
include get_template_directory() . '/inc/web-solutions.php';


//Custom Post Type :: directory
include get_template_directory() . '/inc/directory-post-types.php';

//Custom Post Type :: upcoming-events
include get_template_directory() . '/inc/upcoming-events-post-types.php';

// Shortcode :: AOS
include get_template_directory() . '/inc/aos-animation.php'; 


//Breadcrumb
include get_template_directory() . '/inc/breadcrumbs.php'; 

//Accordion
include get_template_directory() . '/inc/accordion.php';

//ALL News Shortcode
include get_template_directory() . '/inc/all_news-shortcode.php'; 
include get_template_directory() . '/inc/testmonial-posttype.php'; 


//Duplicate Pages
include get_template_directory() . '/inc/duplicate-page.php'; 
include get_template_directory() . '/inc/publications.php'; 

//ALL Associates Shortcode
include get_template_directory() . '/inc/all_partners-page.php'; 

//All Acacia Sunset Shortcode
include get_template_directory() . '/inc/activity-shortcode.php';

// //FORM PROCESSOR
// include get_template_directory() . '/inc/process-form.php'; 

function allow_video_featured_image($mime_types) {
    // Allow video formats for uploads
    $mime_types['mp4'] = 'video/mp4';
    $mime_types['webm'] = 'video/webm';
    $mime_types['ogg'] = 'video/ogg';
    return $mime_types;
}
add_filter('upload_mimes', 'allow_video_featured_image');


//BACK BUTTON (previous page)
add_action( 'back_button', 'kipya_back_button' );
function kipya_back_button() {
    if ( wp_get_referer() ) {
        $back_text = __( '&laquo; BACK' );
        $button    = "\n<button id='my-back-button' class='btn button my-back-button' onclick='javascript:history.back()'>$back_text</button>";
        echo ( $button );
    }
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 50;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 50;
}

//Allow upload of SVG Images
function enable_svg_support($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'enable_svg_support');

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('Read More', 'kipya') . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
    return false;
}
add_filter('show_admin_bar', 'remove_admin_bar');

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}


/**
 * Load custom post types
 */
require_once get_template_directory() . '/inc/custom-post-types/load.php';

function rotary_enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
}
add_action('wp_enqueue_scripts', 'rotary_enqueue_font_awesome');


function mytheme_enqueue_scroll_effect() {
    // Enqueue your JS with jQuery as dependency
    wp_enqueue_script(
        'fadeup-effect', // Handle name
        get_template_directory_uri() . '/assets/js/main.js', // File path
        array('jquery'), // jQuery dependency - THIS IS THE FIX
        '1.0.0', // Version number (better than null)
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scroll_effect');

add_action( 'wp_ajax_nopriv_live_search', 'live_search_callback' );
add_action( 'wp_ajax_live_search', 'live_search_callback' );

function live_search_callback() {
  $term = isset( $_GET['term'] ) ? sanitize_text_field( $_GET['term'] ) : '';

  $args = array(
    's'              => $term,
    'post_status'    => 'publish',
    'posts_per_page' => 5
  );

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
    echo '<ul class="list-unstyled m-0">';
    while ( $query->have_posts() ) {
      $query->the_post();
      echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
    }
    echo '</ul>';
  } else {
    echo '<p class="m-0">No results found.</p>';
  }

  wp_die();
}


function kpy_load_fontawesome(){
    wp_enqueue_style(
        'fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        [],
        '6.5.1'
    );
}
add_action('wp_enqueue_scripts', 'kpy_load_fontawesome');

function kipya_url_for_path(string $path, string $fallback = '/') : string {
    $path = trim($path, "/ \t\n\r\0\x0B");
    if ($path === '') {
        return esc_url(home_url('/'));
    }

    $page = get_page_by_path($path);
    if ($page instanceof WP_Post) {
        return esc_url(get_permalink($page));
    }

    return esc_url(home_url('/' . $path . '/'));
}

function load_bootstrap_icons() {
    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'load_bootstrap_icons');

function enqueue_prism_assets() {
    wp_enqueue_style('prism-css', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css');
    wp_enqueue_script('prism-js', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_prism_assets');



// Start session for currency preference
function start_currency_session() {
    if (!session_id() && !headers_sent()) {
        session_start();
    }
    
    // Get current IP-based country
    $current_country = get_user_country();
    $current_currency = get_currency_from_country($current_country);
    
    // Check if session exists and if country has changed
    if (isset($_SESSION['user_currency']) && isset($_SESSION['user_country'])) {
        // If country changed, update currency
        if ($_SESSION['user_country'] !== $current_country) {
            $_SESSION['user_currency'] = $current_currency;
            $_SESSION['user_country'] = $current_country;
        }
    } else {
        // First time visit - set currency
        $_SESSION['user_currency'] = $current_currency;
        $_SESSION['user_country'] = $current_country;
    }
    
    // Manual override via URL parameter (for testing)
    if (isset($_GET['test_currency'])) {
        $_SESSION['user_currency'] = sanitize_text_field($_GET['test_currency']);
        $_SESSION['user_country'] = 'TEST';
    } elseif (isset($_GET['test_country'])) {
        $test_country = sanitize_text_field($_GET['test_country']);
        $_SESSION['user_currency'] = get_currency_from_country($test_country);
        $_SESSION['user_country'] = $test_country;
    }
}
add_action('init', 'start_currency_session');

// Helper function to get currency from country
function get_currency_from_country($country) {
    $currency_map = array(
        'UG' => 'UGX',
        'KE' => 'KES',
        'TZ' => 'TZS',
        'RW' => 'RWF',
        'SS' => 'SSP',
        'US' => 'USD',
        'GB' => 'GBP',
        'NG' => 'NGN',
        'ZA' => 'ZAR',
        'AE' => 'AED',
        'IN' => 'INR',
        'EU' => 'EUR',
        'CA' => 'CAD',
        'AU' => 'AUD',
        'FR' => 'EUR',
        'DE' => 'EUR',
        'IT' => 'EUR',
        'ES' => 'EUR',
    );
    
    return isset($currency_map[$country]) ? $currency_map[$country] : 'USD';
}

// Get user's country based on IP
function get_user_country() {
    // Check for test parameter first
    if (isset($_GET['test_country'])) {
        return sanitize_text_field($_GET['test_country']);
    }
    
    $ip = $_SERVER['REMOTE_ADDR'];
    
    // Skip for local development
    if ($ip == '127.0.0.1' || $ip == '::1' || $ip == 'localhost') {
        return 'UG';
    }
    
    // Try multiple IP APIs for reliability
    $apis = array(
        "http://ip-api.com/json/{$ip}?fields=status,countryCode",
        "https://ipapi.co/{$ip}/country_code/",
        "http://ipinfo.io/{$ip}/country"
    );
    
    foreach ($apis as $api) {
        $response = wp_remote_get($api, array('timeout' => 5));
        
        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) == 200) {
            $body = wp_remote_retrieve_body($response);
            
            // Handle different API responses
            if (strpos($api, 'ip-api.com') !== false) {
                $data = json_decode($body, true);
                if ($data && isset($data['status']) && $data['status'] == 'success') {
                    return $data['countryCode'];
                }
            } elseif (strpos($api, 'ipapi.co') !== false) {
                $country = trim($body);
                if (strlen($country) == 2) {
                    return $country;
                }
            } elseif (strpos($api, 'ipinfo.io') !== false) {
                $data = json_decode($body, true);
                if ($data && isset($data['country'])) {
                    return $data['country'];
                }
            }
        }
    }
    
    return 'UG'; // Default fallback
}

// Get current currency from session (with country change detection)
function get_current_currency() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Check for test parameter - this should always override
    if (isset($_GET['test_currency'])) {
        return sanitize_text_field($_GET['test_currency']);
    }
    
    // Check for test country
    if (isset($_GET['test_country'])) {
        $test_country = sanitize_text_field($_GET['test_country']);
        return get_currency_from_country($test_country);
    }
    
    // Get current IP-based country
    $current_country = get_user_country();
    $current_currency = get_currency_from_country($current_country);
    
    // Check if session exists
    if (isset($_SESSION['user_currency']) && isset($_SESSION['user_country'])) {
        // If country changed, update currency
        if ($_SESSION['user_country'] !== $current_country) {
            $_SESSION['user_currency'] = $current_currency;
            $_SESSION['user_country'] = $current_country;
            return $current_currency;
        }
        return $_SESSION['user_currency'];
    }
    
    // First time visit
    return $current_currency;
}

// Format currency based on user location
function format_currency($amount, $currency = null) {
    if (!$currency) {
        $currency = get_current_currency();
    }
    
    $symbols = array(
        'UGX' => 'UGX',
        'KES' => 'KES',
        'TZS' => 'TZS',
        'RWF' => 'RWF',
        'SSP' => 'SSP',
        'USD' => '$',
        'GBP' => '£',
        'NGN' => '₦',
        'ZAR' => 'R',
        'AED' => 'د.إ',
        'INR' => '₹',
        'EUR' => '€',
        'CAD' => 'C$',
        'AUD' => 'A$',
    );
    
    $symbol = isset($symbols[$currency]) ? $symbols[$currency] : $currency;
    
    // Convert amount based on exchange rates
    $exchange_rates = array(
        'UGX' => 1,
        'KES' => 0.037,
        'TZS' => 0.68,
        'RWF' => 0.33,
        'SSP' => 0.008,
        'USD' => 0.00027,
        'GBP' => 0.00021,
        'EUR' => 0.00025,
        'NGN' => 0.11,
        'ZAR' => 0.0048,
        'AED' => 0.00099,
        'INR' => 0.022,
        'CAD' => 0.00036,
        'AUD' => 0.00040,
    );
    
    // Convert amount if not in UGX
    if ($currency != 'UGX' && isset($exchange_rates[$currency])) {
        $amount = $amount * $exchange_rates[$currency];
    }
    
    // Format based on currency type
    if (in_array($currency, ['UGX', 'KES', 'TZS', 'RWF', 'SSP', 'NGN'])) {
        return $symbol . ' ' . number_format($amount, 0);
    } else {
        return $symbol . ' ' . number_format($amount, 2);
    }
}

// Optional: Add force refresh button for testing (only for admin)
function add_force_refresh_button() {
    if (current_user_can('administrator')) {
        echo '<div style="position: fixed; bottom: 10px; right: 10px; z-index: 99999; background: #333; padding: 8px 15px; border-radius: 5px; font-size: 12px; display: flex; gap: 10px;">
            <a href="?clear_session=1" style="color: #fff; text-decoration: none;">🗑️ Clear Session</a>
            <a href="?refresh_currency=1" style="color: #fff; text-decoration: none;">🔄 Refresh Currency</a>
        </div>';
        
        if (isset($_GET['clear_session'])) {
            session_destroy();
            echo '<script>window.location.href = window.location.pathname;</script>';
        }
        
        if (isset($_GET['refresh_currency'])) {
            session_start();
            unset($_SESSION['user_currency']);
            unset($_SESSION['user_country']);
            echo '<script>window.location.href = window.location.pathname;</script>';
        }
    }
}
add_action('wp_footer', 'add_force_refresh_button');
?>