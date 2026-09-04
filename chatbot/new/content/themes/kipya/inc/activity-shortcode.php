<?php
/**
 * LwegaTech – "Our Impact" Shortcode (self-contained, internal CSS)
 * Usage: [lwegatech_impact]
 */
function lwegatech_impact_shortcode() {
    ob_start();

    $posts_per_page = 3;
    $current_page   = isset( $_GET['impact_page'] ) ? max( 1, absint( $_GET['impact_page'] ) ) : 1;
    $offset         = ( $current_page - 1 ) * $posts_per_page;

    $count_q     = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => -1, 'category_name' => 'impact', 'fields' => 'ids', 'no_found_rows' => false ] );
    $total_posts = (int) $count_q->found_posts;
    $total_pages = max( 1, (int) ceil( $total_posts / $posts_per_page ) );
    wp_reset_postdata();

    $query = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => $posts_per_page, 'offset' => $offset, 'category_name' => 'impact', 'orderby' => 'date', 'order' => 'DESC', 'no_found_rows' => true ] );

    $base_url    = ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . strtok( $_SERVER['REQUEST_URI'], '?' );
    $base_params = $_GET;
    unset( $base_params['impact_page'] );
    $page_url = function( int $n ) use ( $base_url, $base_params ): string {
        $p = $base_params;
        if ( $n > 1 ) $p['impact_page'] = $n;
        $qs = http_build_query( $p );
        return esc_url( $base_url . ( $qs ? '?' . $qs : '' ) );
    };

    $impacts = [];
    while ( $query->have_posts() ) : $query->the_post();
        $id = get_the_ID();
        $impacts[] = [
            'id'       => $id,
            'title'    => get_the_title(),
            'content'  => get_the_content(),
            'thumb_id' => get_post_thumbnail_id( $id ),
            's1_val'   => get_post_meta( $id, 'impact_stat_1_val',   true ),
            's1_label' => get_post_meta( $id, 'impact_stat_1_label', true ),
            's1_icon'  => get_post_meta( $id, 'impact_stat_1_icon',  true ) ?: '$',
            's2_val'   => get_post_meta( $id, 'impact_stat_2_val',   true ),
            's2_label' => get_post_meta( $id, 'impact_stat_2_label', true ),
            's2_icon'  => get_post_meta( $id, 'impact_stat_2_icon',  true ) ?: '↑',
            'website'  => get_post_meta( $id, 'impact_website_link', true ),
        ];
    endwhile;
    wp_reset_postdata();
    ?>

<style>
/* ── IMPACT WRAP ── */
#lwgt-impact { width:100%; max-width:1320px; margin:0 auto; padding:60px 24px 100px; box-sizing:border-box; font-family:"Montserrat",sans-serif; }
/* ── 3-COL GRID ── */
#lwgt-impact .lwi-grid { display:grid; grid-template-columns:220px 1fr 380px; gap:24px; align-items:start; }
@media(max-width:1100px){ #lwgt-impact .lwi-grid{ grid-template-columns:180px 1fr 300px; } }
@media(max-width:860px){ #lwgt-impact .lwi-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:580px){ #lwgt-impact .lwi-grid{ grid-template-columns:1fr; } }
/* ── LEFT NAV ── */
#lwgt-impact .lwi-nav { display:flex; flex-direction:column; gap:10px; }
@media(max-width:860px){ #lwgt-impact .lwi-nav{ flex-direction:row; flex-wrap:wrap; grid-column:1/-1; } }
#lwgt-impact .lwi-nav-label { font-size:0.76rem; font-weight:600; color:rgba(255,255,255,0.4); letter-spacing:0.04em; line-height:1.6; margin:0 0 14px; }
#lwgt-impact .lwi-nav-label span { display:block; font-size:1rem; margin-bottom:4px; color:rgba(255,255,255,0.5); }
#lwgt-impact .lwi-tab { font-family:"Montserrat",sans-serif; font-size:0.86rem; font-weight:700; color:rgba(255,255,255,0.6); background:rgba(255,255,255,0.06); border:1.5px solid rgba(255,255,255,0.12); border-radius:50px; padding:14px 22px; cursor:pointer; text-align:left; line-height:1.3; transition:all .25s ease; outline:none; width:100%; }
#lwgt-impact .lwi-tab:hover { color:#fff; background:rgba(255,255,255,0.1); border-color:rgba(255,255,255,0.3); }
#lwgt-impact .lwi-tab.lwi-active { color:#fff !important; background:#d90000 !important; border-color:#d90000 !important; }
/* ── CENTER CONTENT ── */
#lwgt-impact .lwi-contents { position:relative; }
@media(max-width:860px){ #lwgt-impact .lwi-contents{ grid-column:1/2; } }
@media(max-width:580px){ #lwgt-impact .lwi-contents{ grid-column:1/-1; } }
#lwgt-impact .lwi-panel { background:#ffffff; border-radius:24px; padding:48px 44px; min-height:460px; display:none; flex-direction:column; justify-content:center; box-sizing:border-box; }
#lwgt-impact .lwi-panel.lwi-active { display:flex; animation:lwi-fade .35s ease; }
@media(max-width:1100px){ #lwgt-impact .lwi-panel{ padding:36px 30px; min-height:380px; } }
@media(max-width:580px){ #lwgt-impact .lwi-panel{ padding:28px 22px; min-height:auto; border-radius:16px; } }
#lwgt-impact .lwi-panel h2 { font-family:"Montserrat",sans-serif; font-size:2.1rem; font-weight:900; color:#1a1a1a; line-height:1.15; margin:0 0 28px; letter-spacing:-0.01em; }
@media(max-width:1100px){ #lwgt-impact .lwi-panel h2{ font-size:1.7rem; } }
@media(max-width:580px){ #lwgt-impact .lwi-panel h2{ font-size:1.4rem; } }
#lwgt-impact .lwi-body { font-size:0.95rem; color:#555; line-height:1.85; }
#lwgt-impact .lwi-body p { margin:0 0 18px; }
#lwgt-impact .lwi-body p:last-child { margin:0; }
#lwgt-impact .lwi-body strong { color:#1a1a1a; font-weight:700; }
/* ── RIGHT VISUAL ── */
#lwgt-impact .lwi-visuals { position:relative; }
@media(max-width:860px){ #lwgt-impact .lwi-visuals{ grid-column:2/3; } }
@media(max-width:580px){ #lwgt-impact .lwi-visuals{ grid-column:1/-1; } }
#lwgt-impact .lwi-visual { position:relative; border-radius:24px; overflow:hidden; background:#0d0000; min-height:460px; display:none; }
#lwgt-impact .lwi-visual.lwi-active { display:block; animation:lwi-fade .35s ease; }
@media(max-width:1100px){ #lwgt-impact .lwi-visual{ min-height:380px; } }
@media(max-width:580px){ #lwgt-impact .lwi-visual{ min-height:280px; border-radius:16px; } }
#lwgt-impact .lwi-vbg { position:absolute; inset:0; background:radial-gradient(ellipse at 72% 22%, rgba(217,0,0,0.82) 0%, rgba(120,0,0,0.45) 38%, #0d0000 100%); z-index:1; }
#lwgt-impact .lwi-vimg { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center top; z-index:2; mix-blend-mode:luminosity; opacity:0.65; }
/* ── METRIC BADGES ── */
#lwgt-impact .lwi-metric { position:absolute; z-index:5; background:rgba(255,255,255,0.97); border-radius:50px; padding:9px 16px 9px 10px; display:flex; align-items:center; gap:10px; box-shadow:0 6px 28px rgba(0,0,0,0.5); backdrop-filter:blur(8px); }
#lwgt-impact .lwi-metric.pos-tr { top:22px; right:18px; }
#lwgt-impact .lwi-metric.pos-ml { top:56%; left:14px; transform:translateY(-50%); }
#lwgt-impact .lwi-mdot { width:32px; height:32px; border-radius:50%; background:#d90000; display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#fff; font-size:0.72rem; font-weight:900; }
#lwgt-impact .lwi-mtext { display:flex; flex-direction:column; line-height:1.2; }
#lwgt-impact .lwi-mval { font-family:"Montserrat",sans-serif; font-size:0.83rem; font-weight:800; color:#1a1a1a; }
#lwgt-impact .lwi-mlabel { font-size:0.67rem; color:#888; font-weight:500; }
/* ── RED BUTTON ── */
#lwgt-impact .lwi-btn-red { display:inline-flex; align-items:center; gap:8px; background:#d90000; color:#fff; font-family:"Montserrat",sans-serif; font-size:0.82rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; padding:14px 18px; border-radius:50px; text-decoration:none; transition:all .25s ease; margin-top:20px; }
#lwgt-impact .lwi-btn-red:hover { background:#b80000; transform:translateY(-2px); box-shadow:0 8px 24px rgba(217,0,0,0.35); }
#lwgt-impact .lwi-btn-red::after { content:"→"; font-size:1.1em; }
/* ── PAGINATION ── */
#lwgt-impact .lwi-pagination { display:flex; align-items:center; justify-content:center; gap:5px; margin-top:56px; flex-wrap:wrap; }
#lwgt-impact .lwi-pbtn { font-family:"Montserrat",sans-serif; font-size:0.75rem; font-weight:700; letter-spacing:0.07em; text-transform:uppercase; color:rgba(255,255,255,0.45); background:rgba(255,255,255,0.05); border:1.5px solid rgba(255,255,255,0.1); border-radius:0 !important; padding:10px 16px; text-decoration:none !important; transition:all .22s ease; display:inline-flex; align-items:center; justify-content:center; min-width:40px; line-height:1; }
#lwgt-impact .lwi-pbtn:hover { color:#fff; background:rgba(255,255,255,0.1); border-color:rgba(255,255,255,0.3); text-decoration:none !important; }
#lwgt-impact .lwi-pbtn.lwi-pactive { color:#fff !important; background:#d90000 !important; border-color:#d90000 !important; pointer-events:none; }
#lwgt-impact .lwi-pbtn.lwi-pdis { opacity:0.25; pointer-events:none; }
#lwgt-impact .lwi-pellipsis { font-size:0.85rem; color:rgba(255,255,255,0.3); padding:10px 6px; display:inline-flex; align-items:center; }
#lwgt-impact .lwi-empty { color:rgba(255,255,255,0.3); text-align:center; padding:56px 0; font-size:0.95rem; }
@keyframes lwi-fade { from{ opacity:0; transform:translateY(8px); } to{ opacity:1; transform:translateY(0); } }
</style>

<div id="lwgt-impact">

    <?php if ( ! empty( $impacts ) ) : ?>

    <div class="lwi-grid">

        <?php /* ─── LEFT NAV ─── */ ?>
        <nav class="lwi-nav" aria-label="Impact stories">
            <p class="lwi-nav-label"><span>↓</span>Discover the real impact we create for our clients</p>
            <?php foreach ( $impacts as $i => $imp ) : ?>
                <button class="lwi-tab<?php echo $i === 0 ? ' lwi-active' : ''; ?>" data-idx="<?php echo $i; ?>" type="button">
                    <?php echo esc_html( $imp['title'] ); ?>
                </button>
            <?php endforeach; ?>
        </nav>

        <?php /* ─── CENTER PANELS ─── */ ?>
        <div class="lwi-contents">
            <?php foreach ( $impacts as $i => $imp ) : ?>
                <div class="lwi-panel<?php echo $i === 0 ? ' lwi-active' : ''; ?>" data-idx="<?php echo $i; ?>">
                    <h2><?php echo esc_html( $imp['title'] ); ?></h2>
                    <div class="lwi-body"><?php echo wp_kses_post( wpautop( $imp['content'] ) ); ?></div>
                    <?php if ( $imp['website'] ) : ?>
                        <a href="<?php echo esc_url( $imp['website'] ); ?>" class="lwi-btn-red" target="_blank" rel="noopener noreferrer">Visit Website</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php /* ─── RIGHT VISUALS ─── */ ?>
        <div class="lwi-visuals">
            <?php foreach ( $impacts as $i => $imp ) : ?>
                <div class="lwi-visual<?php echo $i === 0 ? ' lwi-active' : ''; ?>" data-idx="<?php echo $i; ?>">
                    <div class="lwi-vbg"></div>

                    <?php if ( $imp['thumb_id'] ) : ?>
                        <?php echo wp_get_attachment_image( $imp['thumb_id'], 'large', false, [ 'class' => 'lwi-vimg', 'alt' => esc_attr( $imp['title'] ) ] ); ?>
                    <?php endif; ?>

                    <?php if ( $imp['s1_val'] ) : ?>
                        <div class="lwi-metric pos-tr">
                            <span class="lwi-mdot"><?php echo esc_html( $imp['s1_icon'] ); ?></span>
                            <div class="lwi-mtext">
                                <span class="lwi-mval"><?php echo esc_html( $imp['s1_val'] ); ?></span>
                                <?php if ( $imp['s1_label'] ) : ?><span class="lwi-mlabel"><?php echo esc_html( $imp['s1_label'] ); ?></span><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ( $imp['s2_val'] ) : ?>
                        <div class="lwi-metric pos-ml">
                            <span class="lwi-mdot"><?php echo esc_html( $imp['s2_icon'] ); ?></span>
                            <div class="lwi-mtext">
                                <span class="lwi-mval"><?php echo esc_html( $imp['s2_val'] ); ?></span>
                                <?php if ( $imp['s2_label'] ) : ?><span class="lwi-mlabel"><?php echo esc_html( $imp['s2_label'] ); ?></span><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        </div>

    </div><!-- /.lwi-grid -->

    <?php /* ─── PAGINATION ─── */ ?>
    <?php if ( $total_pages > 1 ) : ?>
        <nav class="lwi-pagination" aria-label="Impact pagination">

            <?php if ( $current_page > 1 ) : ?>
                <a class="lwi-pbtn" href="<?php echo $page_url( $current_page - 1 ); ?>" aria-label="Previous">&#8592;</a>
            <?php else : ?>
                <span class="lwi-pbtn lwi-pdis">&#8592;</span>
            <?php endif; ?>

            <?php
            $prev_gap = false;
            for ( $i = 1; $i <= $total_pages; $i++ ) :
                $in_range = ( $i === 1 || $i === $total_pages || abs( $i - $current_page ) <= 1 );
                if ( ! $in_range ) {
                    if ( ! $prev_gap ) echo '<span class="lwi-pellipsis">&hellip;</span>';
                    $prev_gap = true; continue;
                }
                $prev_gap = false;
                $act = ( $i === $current_page ) ? ' lwi-pactive' : '';
            ?>
                <a class="lwi-pbtn<?php echo $act; ?>" href="<?php echo $page_url( $i ); ?>" aria-label="Page <?php echo $i; ?>" <?php echo $i === $current_page ? 'aria-current="page"' : ''; ?>><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ( $current_page < $total_pages ) : ?>
                <a class="lwi-pbtn" href="<?php echo $page_url( $current_page + 1 ); ?>" aria-label="Next">&#8594;</a>
            <?php else : ?>
                <span class="lwi-pbtn lwi-pdis">&#8594;</span>
            <?php endif; ?>

        </nav>
    <?php endif; ?>

    <?php else : ?>
        <p class="lwi-empty">No impact stories found — add posts under the <strong>impact</strong> category.</p>
    <?php endif; ?>

</div><!-- /#lwgt-impact -->

<script>
(function(){
    var wrap = document.getElementById('lwgt-impact');
    if(!wrap) return;
    var tabs = wrap.querySelectorAll('.lwi-tab');
    var panels = wrap.querySelectorAll('.lwi-panel');
    var visuals = wrap.querySelectorAll('.lwi-visual');
    tabs.forEach(function(tab){
        tab.addEventListener('click', function(){
            var idx = this.dataset.idx;
            tabs.forEach(function(t){ t.classList.remove('lwi-active'); });
            panels.forEach(function(p){ p.classList.remove('lwi-active'); });
            visuals.forEach(function(v){ v.classList.remove('lwi-active'); });
            this.classList.add('lwi-active');
            var p = wrap.querySelector('.lwi-panel[data-idx="'+idx+'"]');
            var v = wrap.querySelector('.lwi-visual[data-idx="'+idx+'"]');
            if(p) p.classList.add('lwi-active');
            if(v) v.classList.add('lwi-active');
        });
    });
})();
</script>

    <?php
    return ob_get_clean();
}
add_shortcode( 'lwegatech_impact', 'lwegatech_impact_shortcode' );