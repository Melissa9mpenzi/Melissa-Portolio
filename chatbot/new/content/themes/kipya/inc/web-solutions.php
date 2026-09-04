<?php
/**
 * Plugin Name: LwegaTech Web Solutions Shortcode
 * Description: Displays all pages with "web" category as styled project cards.
 *              Usage: [web_solutions] on any page.
 * Version:     1.1.0
 * Author:      LwegaTech
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* =========================================================
   1.  REGISTER THE SHORTCODE
   ========================================================= */
add_shortcode( 'web_solutions', 'lwegatech_web_solutions_shortcode' );

function lwegatech_web_solutions_shortcode( $atts ) {

    $atts = shortcode_atts(
        array(
            'posts_per_page' => -1,
            'columns'        => 3,
            'category_slug'  => 'web'
        ),
        $atts,
        'web_solutions'
    );

    /* ----------------------------------------------------------
       2.  QUERY PAGES IN THE "web" PAGE-CATEGORY
    ---------------------------------------------------------- */
    $tax_query = array();

    if ( taxonomy_exists( 'page_category' ) ) {
        $tax_query[] = array( 'taxonomy' => 'page_category', 'field' => 'slug', 'terms' => sanitize_text_field( $atts['category_slug'] ) );
    } elseif ( taxonomy_exists( 'category' ) ) {
        $tax_query[] = array( 'taxonomy' => 'category', 'field' => 'slug', 'terms' => sanitize_text_field( $atts['category_slug'] ) );
    }

    $query_args = array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => intval( $atts['posts_per_page'] ),
        'orderby'        => 'menu_order date',
        'order'          => 'ASC',
    );

    if ( ! empty( $tax_query ) ) { $query_args['tax_query'] = $tax_query; }

    $web_pages = new WP_Query( $query_args );

    /* ----------------------------------------------------------
       3.  BUILD OUTPUT
    ---------------------------------------------------------- */
    ob_start();

    if ( $web_pages->have_posts() ) :
        $cols = intval( $atts['columns'] );
?>

<!-- ===================== INLINE STYLES ===================== -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap');

:root { --lwt-bg:#0d0d0d; --lwt-card-bg:#161616; --lwt-card-border:#2a2a2a; --lwt-red:#e3000f; --lwt-white:#ffffff; --lwt-muted:#9b9b9b; --lwt-transition:0.38s cubic-bezier(0.23,1,0.32,1); }

.lwt-solutions-wrap { background:var(--lwt-bg); padding:60px 24px 80px; font-family:'Montserrat',sans-serif; width:100%; box-sizing:border-box; }

.lwt-solutions-wrap .lwt-section-title { font-family:'Montserrat',sans-serif; font-size:clamp(2rem,4vw,3rem); font-weight:800; letter-spacing:0.06em; color:var(--lwt-white); margin:0 0 8px; line-height:1; text-transform:uppercase; text-align:center; }

.lwt-solutions-wrap .lwt-section-sub { color:var(--lwt-muted); font-size:1rem; margin:0 0 48px; font-weight:400; letter-spacing:0.01em; text-align:center; }

.lwt-solutions-grid { display:grid; grid-template-columns:repeat(<?php echo esc_attr( $cols ); ?>,1fr); gap:28px; max-width:1400px; margin:0 auto; }

@media (max-width:1100px) { .lwt-solutions-grid { grid-template-columns:repeat(2,1fr); } }
@media (max-width:680px)  { .lwt-solutions-grid { grid-template-columns:1fr; } }

.lwt-card { position:relative; background:var(--lwt-card-bg); border:1px solid var(--lwt-card-border); border-radius:0; overflow:hidden; display:flex; flex-direction:column; cursor:pointer; transition:transform var(--lwt-transition),box-shadow var(--lwt-transition),border-color var(--lwt-transition); text-decoration:none; color:inherit; }

.lwt-card:hover { transform:translateY(-7px) scale(1.012); box-shadow:0 24px 56px rgba(0,0,0,0.65),0 0 0 1px var(--lwt-red); border-color:var(--lwt-red); }

.lwt-card-title-bar { padding:18px 22px 16px; background:var(--lwt-card-bg); border-bottom:1px solid var(--lwt-card-border); }

.lwt-card-title-bar h3 { font-family:'Montserrat',sans-serif; font-size:1.1rem; font-weight:800; letter-spacing:0.07em; color:var(--lwt-white); margin:0; line-height:1.15; text-transform:uppercase; }

.lwt-card-thumb { position:relative; width:100%; aspect-ratio:16/10; overflow:hidden; flex-shrink:0; background:#1f1f1f;  }
.lwt-card-thumb::before { content:''; position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.88) 0%, rgba(0,0,0,0.65) 28%, rgba(0,0,0,0.20) 55%, rgba(0,0,0,0) 100%); z-index:1; pointer-events:none; }

.lwt-card-thumb img { width:100%; height:100%; object-fit:contain; object-position:center center; display:block; background:#1a1a1a; transition:transform var(--lwt-transition),filter var(--lwt-transition); }

.lwt-card:hover .lwt-card-thumb img { transform:scale(1.05); filter:brightness(0.85); }

.lwt-card-thumb-placeholder { width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg,#1a1a1a 0%,#242424 100%); font-family:'Montserrat',sans-serif; font-size:1.4rem; font-weight:800; letter-spacing:0.1em; color:#333; text-transform:uppercase; text-align:center; padding:16px; box-sizing:border-box; }

.lwt-card-thumb::after { content:''; position:absolute; bottom:0; left:0; right:0; height:4px; background:var(--lwt-red); transform:scaleX(0); transform-origin:left; transition:transform var(--lwt-transition); }

.lwt-card:hover .lwt-card-thumb::after { transform:scaleX(1); }

.lwt-card-excerpt { padding:16px 22px 0; color:var(--lwt-muted); font-size:0.875rem; line-height:1.6; flex-grow:1; font-family:'Montserrat',sans-serif; }

.lwt-card-footer { display:flex; align-items:center; justify-content:flex-end; padding:16px 22px; margin-top:auto; border-top:1px solid var(--lwt-card-border); }

.lwt-arrow-btn { width:44px; height:44px; border-radius:50%; background:#2a2a2a; border:none; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:background var(--lwt-transition),transform var(--lwt-transition); flex-shrink:0; text-decoration:none; color:var(--lwt-white); }

.lwt-card:hover .lwt-arrow-btn { background:var(--lwt-red); transform:rotate(-45deg); }

.lwt-arrow-btn svg { width:18px; height:18px; fill:none; stroke:#fff; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; }

.lwt-no-results { text-align:center; color:var(--lwt-muted); padding:80px 0; font-size:1.1rem; letter-spacing:0.02em; grid-column:1/-1; font-family:'Montserrat',sans-serif; }
</style>
<!-- =================== END STYLES ======================== -->

<div class="lwt-solutions-wrap">

    <p class="lwt-section-title">Our Web Solutions</p>
    <p class="lwt-section-sub">Professional, Secure, and Scalable Web Services for Every Industry.</p>

    <div class="lwt-solutions-grid">

    <?php while ( $web_pages->have_posts() ) : $web_pages->the_post(); ?>

        <?php
        $page_url   = get_permalink();
        $page_title = get_the_title();
        $thumb_html = '';

        if ( has_post_thumbnail() ) {
            $thumb_html = get_the_post_thumbnail( get_the_ID(), 'large', array( 'alt' => esc_attr( $page_title ) ) );
        }

        $excerpt = wp_trim_words( get_the_excerpt(), 18, '...' );
        ?>

        <a href="<?php echo esc_url( $page_url ); ?>" class="lwt-card" title="<?php echo esc_attr( $page_title ); ?>">

            <!-- Title Banner -->
            <div class="lwt-card-title-bar">
                <h3><?php echo esc_html( $page_title ); ?></h3>
            </div>

            <!-- Thumbnail -->
            <div class="lwt-card-thumb">
                <?php if ( $thumb_html ) : ?>
                    <?php echo $thumb_html; ?>
                <?php else : ?>
                    <div class="lwt-card-thumb-placeholder"><?php echo esc_html( $page_title ); ?></div>
                <?php endif; ?>
            </div>

            <!-- Excerpt -->
            <?php if ( $excerpt ) : ?>
            <p class="lwt-card-excerpt"><?php echo esc_html( $excerpt ); ?></p>
            <?php endif; ?>

            <!-- Footer: Arrow button only, no label -->
            <div class="lwt-card-footer">
                <span class="lwt-arrow-btn" aria-hidden="true">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </span>
            </div>

        </a><!-- .lwt-card -->

    <?php endwhile; ?>

    <?php if ( ! $web_pages->have_posts() ) : ?>
        <p class="lwt-no-results">No web solutions found. Make sure your pages are assigned to the <strong>web</strong> page category.</p>
    <?php endif; ?>

    </div><!-- .lwt-solutions-grid -->

</div><!-- .lwt-solutions-wrap -->

<?php
    else :
        echo '<p style="color:#999;text-align:center;padding:40px 0;font-family:Montserrat,sans-serif;">No web solution pages found. Make sure pages are assigned to the <strong>web</strong> page category.</p>';
    endif;

    wp_reset_postdata();

    return ob_get_clean();
}