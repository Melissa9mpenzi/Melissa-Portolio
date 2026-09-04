<?php
/**
 * Custom Post Type :: TEAMS
 * ─────────────────────────────────────────────────────────────
 * STRUCTURE  : CPT 'team', 'department' taxonomy, meta boxes,
 *              shortcodes [team] and [past-team]
 * DESIGN     : kpy‑* dark card aesthetic, Bulma modal pattern,
 *              department filter bar, internal CSS via wp_head
 * ─────────────────────────────────────────────────────────────
 * SHORTCODES:
 *   [team]          → Current team members (3‑column grid)
 *   [past-team]     → Past members with optional department filter bar
 *
 * ORDERING: Uses custom meta field '_display_order' (0 = first).
 * ─────────────────────────────────────────────────────────────
 * REQUIRES: Bulma CSS, Bootstrap Icons (bi bi-*) in your theme.
 */

/* ============================================================
   CUSTOM POST TYPE REGISTRATION
   ============================================================ */
if (!function_exists('custom_post_type_team')) {
function custom_post_type_team() {
    $labels = array(
        'name'          => __('Team', 'kipya'),
        'add_new_item'  => __('Add New Member', 'kipya'),
        'add_new'       => __('Add New Member', 'kipya'),
        'edit_item'     => __('Edit Member', 'kipya'),
        'update_item'   => __('Update Member', 'kipya'),
        'all_items'     => __('Team Members', 'kipya'),
        'search_items'  => __('Search', 'kipya'),
        'singular_name' => __('Team'),
    );
    $supports = array('title', 'excerpt', 'editor', 'thumbnail', 'page-attributes');
    $args = array(
        'labels'              => $labels,
        'description'         => 'For all Teams and their Members',
        'supports'            => $supports,
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 9,
        'menu_icon'           => 'dashicons-groups',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'capability_type'     => 'post',
    );
    register_post_type('team', $args);

    // ── Department Taxonomy ──
    $taxonomy_labels = array(
        'name'          => _x('Departments', 'taxonomy general name'),
        'singular_name' => _x('Department', 'taxonomy singular name'),
        'search_items'  => __('Search Departments'),
        'all_items'     => __('All Departments'),
        'edit_item'     => __('Edit Department'),
        'update_item'   => __('Update Department'),
        'add_new_item'  => __('Add New Department'),
        'new_item_name' => __('New Department Name'),
        'menu_name'     => __('Departments'),
    );
    $taxonomy_args = array(
        'hierarchical' => true,
        'labels'       => $taxonomy_labels,
        'show_ui'      => true,
        'show_in_rest' => true,
        'query_var'    => true,
        'rewrite'      => array('slug' => 'department'),
    );
    register_taxonomy('department', 'team', $taxonomy_args);

    $default_departments = array('Sales', 'IT', 'Finance', 'Administration');
    foreach ($default_departments as $dept) {
        if (!term_exists($dept, 'department')) {
            wp_insert_term($dept, 'department');
        }
    }
}
}
add_action('init', 'custom_post_type_team');


/* ============================================================
   META BOX :: Member Details
   ============================================================ */
function add_custom_meta_boxes_teams() {
    add_meta_box('member_details', 'Member Details', 'render_custom_meta_box_teams', 'team', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_custom_meta_boxes_teams');

function render_custom_meta_box_teams($post) {
    $designation  = get_post_meta($post->ID, '_designation', true);
    $role         = get_post_meta($post->ID, '_role', true);
    $brief        = get_post_meta($post->ID, '_brief', true);
    $phone        = get_post_meta($post->ID, '_phone', true);
    $email        = get_post_meta($post->ID, '_email', true);
    $organization = get_post_meta($post->ID, '_organization', true);
    $website      = get_post_meta($post->ID, '_website', true);
    $order        = get_post_meta($post->ID, '_display_order', true);
    wp_nonce_field('team_meta_nonce', 'team_meta_nonce_field');
    ?>
    <style>
        .team-meta-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px; }
        .team-meta-grid .full-width { grid-column:1/-1; }
        .team-meta-grid label { display:block; font-weight:700; margin-bottom:5px; font-size:12px; text-transform:uppercase; letter-spacing:.5px; color:#333; }
        .team-meta-grid input, .team-meta-grid textarea { width:100%; padding:8px 10px; border:1px solid #d0d0d0; font-size:13px; background:#fafafa; border-radius:3px; }
        .team-meta-grid textarea { resize:vertical; min-height:80px; }
        .team-meta-order-note { font-size:11px; color:#888; margin-top:4px; }
    </style>
    <div class="team-meta-grid">
        <div>
            <label for="designation">Job Title / Designation <span style="color:#d90000">*</span></label>
            <input type="text" id="designation" name="designation" value="<?= esc_attr($designation); ?>" required>
        </div>
        <div>
            <label for="role">Department Role</label>
            <input type="text" id="role" name="role" value="<?= esc_attr($role); ?>" placeholder="e.g. Team Lead, Manager">
        </div>
        <div class="full-width">
            <label for="brief">Brief Description</label>
            <textarea id="brief" name="brief" placeholder="Short bio or member description..."><?= esc_textarea($brief); ?></textarea>
        </div>
        <div>
            <label for="organization">Organization</label>
            <input type="text" id="organization" name="organization" value="<?= esc_attr($organization); ?>">
        </div>
        <div>
            <label for="phone">Telephone</label>
            <input type="text" id="phone" name="phone" value="<?= esc_attr($phone); ?>">
        </div>
        <div>
            <label for="email">Email Address</label>
            <input type="text" id="email" name="email" value="<?= esc_attr($email); ?>">
        </div>
        <div>
            <label for="website">Website / Link</label>
            <input type="text" id="website" name="website" value="<?= esc_attr($website); ?>">
        </div>
        <div>
            <label for="display_order">Display Order</label>
            <input type="number" id="display_order" name="display_order" value="<?= esc_attr($order !== '' ? $order : '0'); ?>" min="0" step="1">
            <p class="team-meta-order-note">Lower number = shown first. E.g. 0, 1, 2, 3...</p>
        </div>
    </div>
    <?php
}

function save_custom_meta_box_teams($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['team_meta_nonce_field']) || !wp_verify_nonce($_POST['team_meta_nonce_field'], 'team_meta_nonce')) return;

    $fields = array('designation', 'role', 'phone', 'email', 'organization', 'website');
    foreach ($fields as $field) {
        update_post_meta($post_id, '_' . $field, isset($_POST[$field]) ? sanitize_text_field($_POST[$field]) : '');
    }
    if (isset($_POST['brief'])) {
        update_post_meta($post_id, '_brief', sanitize_textarea_field($_POST['brief']));
    }
    if (isset($_POST['display_order'])) {
        update_post_meta($post_id, '_display_order', intval($_POST['display_order']));
    }
}
add_action('save_post', 'save_custom_meta_box_teams');


/* ============================================================
   META BOX :: Social Details
   ============================================================ */
function add_custom_meta_boxes_team_socials() {
    add_meta_box('social_details', 'Social Media Links', 'render_custom_meta_box_team_socials', 'team', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_custom_meta_boxes_team_socials');

function render_custom_meta_box_team_socials($post) {
    $facebook  = get_post_meta($post->ID, '_facebook', true);
    $linkedin  = get_post_meta($post->ID, '_linkedin', true);
    $instagram = get_post_meta($post->ID, '_instagram', true);
    $x         = get_post_meta($post->ID, '_x', true);
    $whatsapp  = get_post_meta($post->ID, '_whatsapp', true);
    wp_nonce_field('team_socials_nonce', 'team_socials_nonce_field');
    ?>
    <div class="team-meta-grid">
        <div>
            <label for="facebook">Facebook URL</label>
            <input type="text" id="facebook" name="facebook" value="<?= esc_attr($facebook); ?>" placeholder="https://facebook.com/">
        </div>
        <div>
            <label for="twitter">X / Twitter URL</label>
            <input type="text" id="twitter" name="x" value="<?= esc_attr($x); ?>" placeholder="https://x.com/">
        </div>
        <div>
            <label for="insta">Instagram URL</label>
            <input type="text" id="insta" name="instagram" value="<?= esc_attr($instagram); ?>" placeholder="https://instagram.com/">
        </div>
        <div>
            <label for="linkedin">LinkedIn URL</label>
            <input type="text" id="linkedin" name="linkedin" value="<?= esc_attr($linkedin); ?>" placeholder="https://linkedin.com/in/">
        </div>
        <div class="full-width">
            <label for="whatsapp">WhatsApp Link</label>
            <input type="text" id="whatsapp" name="whatsapp" value="<?= esc_attr($whatsapp); ?>" placeholder="https://wa.me/256">
        </div>
    </div>
    <?php
}

function save_custom_meta_box_team_socials($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['team_socials_nonce_field']) || !wp_verify_nonce($_POST['team_socials_nonce_field'], 'team_socials_nonce')) return;

    $fields = array('facebook', 'linkedin', 'instagram', 'x', 'whatsapp');
    foreach ($fields as $field) {
        update_post_meta($post_id, '_' . $field, isset($_POST[$field]) ? sanitize_text_field($_POST[$field]) : '');
    }
}
add_action('save_post', 'save_custom_meta_box_team_socials');


/* ============================================================
   ADMIN COLUMNS
   ============================================================ */
function add_custom_columns_to_team($columns) {
    return array(
        'cb'           => $columns['cb'],
        'photo'        => __('Photo'),
        'title'        => __('Name'),
        'designation'  => __('Title / Designation'),
        'role'         => __('Role'),
        'department'   => __('Department'),
        'organization' => __('Organization'),
        'disp_order'   => __('Order'),
    );
}
add_filter('manage_team_posts_columns', 'add_custom_columns_to_team');

function populate_custom_team_columns($column, $post_id) {
    switch ($column) {
        case 'photo':
            $url = get_the_post_thumbnail_url($post_id, 'thumbnail');
            echo $url ? '<img src="' . esc_url($url) . '" style="max-height:50px;width:auto;border-radius:4px;">' : '—';
            break;
        case 'designation':
            echo esc_html(get_post_meta($post_id, '_designation', true) ?: '—');
            break;
        case 'role':
            echo esc_html(get_post_meta($post_id, '_role', true) ?: '—');
            break;
        case 'organization':
            echo esc_html(get_post_meta($post_id, '_organization', true) ?: '—');
            break;
        case 'disp_order':
            $o = get_post_meta($post_id, '_display_order', true);
            echo '<strong style="font-size:1.1em;">' . esc_html($o !== '' ? $o : '0') . '</strong>';
            break;
        case 'department':
            $terms = wp_get_post_terms($post_id, 'department');
            echo (!empty($terms) && !is_wp_error($terms)) ? esc_html(implode(', ', wp_list_pluck($terms, 'name'))) : '—';
            break;
    }
}
add_action('manage_team_posts_custom_column', 'populate_custom_team_columns', 10, 2);


/* ============================================================
   HELPER :: Build a team WP_Query sorted by _display_order
   ============================================================ */
function kpy_team_query($atts) {
    $args = array(
        'post_type'      => 'team',
        'posts_per_page' => intval($atts['number']),
        'meta_key'       => '_display_order',
        'orderby'        => 'meta_value_num title',
        'order'          => 'ASC',
    );

    $tax_query = array('relation' => 'AND');
    if (!empty($atts['department'])) {
        $tax_query[] = array('taxonomy' => 'department', 'field' => 'slug', 'terms' => $atts['department']);
    }
    if (!empty($atts['category'])) {
        $tax_query[] = array('taxonomy' => 'team_category', 'field' => 'slug', 'terms' => $atts['category']);
    }
    if (count($tax_query) > 1) { $args['tax_query'] = $tax_query; }

    return new WP_Query($args);
}


/* ============================================================
   HELPER :: Render one team card + its modal (Bulma version)
   ============================================================ */
function kpy_render_team_card($pid, $compact = false) {
    global $post;
    $post = get_post($pid);
    setup_postdata($post);

    $designation = get_post_meta($pid, '_designation', true);
    $role        = get_post_meta($pid, '_role', true);
    $brief       = get_post_meta($pid, '_brief', true);
    $facebook    = get_post_meta($pid, '_facebook', true);
    $linkedin    = get_post_meta($pid, '_linkedin', true);
    $instagram   = get_post_meta($pid, '_instagram', true);
    $x           = get_post_meta($pid, '_x', true);
    $whatsapp    = get_post_meta($pid, '_whatsapp', true);
    $email       = get_post_meta($pid, '_email', true);
    $phone       = get_post_meta($pid, '_phone', true);
    $website     = get_post_meta($pid, '_website', true);
    $dept_terms  = wp_get_post_terms($pid, 'department');
    $dept_name   = (!empty($dept_terms) && !is_wp_error($dept_terms)) ? $dept_terms[0]->name : '';
    $dept_slug   = (!empty($dept_terms) && !is_wp_error($dept_terms)) ? $dept_terms[0]->slug : '';
    $modal_id    = 'kpyModal-' . absint($pid);

    $col_class = $compact
        ? 'column is-one-quarter-desktop is-one-third-tablet is-half-mobile'
        : 'column is-one-third-desktop is-half-tablet';
    ?>

    <!-- ══ CARD ══ -->
    <div class="<?= $col_class; ?> kpy-member-col" data-department="<?= esc_attr($dept_slug); ?>">
        <div class="kpy-card">

            <div class="kpy-card__photo">
                <?php if (has_post_thumbnail($pid)) :
                    echo get_the_post_thumbnail($pid, $compact ? 'medium' : 'large');
                else : ?>
                    <img src="<?= get_template_directory_uri(); ?>/assets/images/placeholder-image.jpg" alt="<?= esc_attr(get_the_title($pid)); ?>">
                <?php endif; ?>

                <?php if ($dept_name) : ?>
                    <span class="kpy-card__dept"><?= esc_html($dept_name); ?></span>
                <?php endif; ?>

                <div class="kpy-card__overlay">
                    <?php if ($facebook || $linkedin || $instagram || $x || $whatsapp || $email) : ?>
                    <div class="kpy-card__overlay-socials">
                        <?php if ($email)     : ?><a href="mailto:<?= esc_attr($email); ?>" title="Email"><i class="bi bi-envelope-fill"></i></a><?php endif; ?>
                        <?php if ($whatsapp)  : ?><a href="<?= esc_url($whatsapp); ?>" target="_blank" title="WhatsApp"><i class="bi bi-whatsapp"></i></a><?php endif; ?>
                        <?php if ($linkedin)  : ?><a href="<?= esc_url($linkedin); ?>" target="_blank" title="LinkedIn"><i class="bi bi-linkedin"></i></a><?php endif; ?>
                        <?php if ($facebook)  : ?><a href="<?= esc_url($facebook); ?>" target="_blank" title="Facebook"><i class="bi bi-facebook"></i></a><?php endif; ?>
                        <?php if ($instagram) : ?><a href="<?= esc_url($instagram); ?>" target="_blank" title="Instagram"><i class="bi bi-instagram"></i></a><?php endif; ?>
                        <?php if ($x)         : ?><a href="<?= esc_url($x); ?>" target="_blank" title="X / Twitter"><i class="bi bi-twitter-x"></i></a><?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="kpy-card__body">
                <div class="kpy-card__body-inner">
                    <h4 class="kpy-card__name"><?= esc_html(get_the_title($pid)); ?></h4>
                    <?php if ($designation) : ?><p class="kpy-card__title"><?= esc_html($designation); ?></p><?php endif; ?>
                    <?php if ($role && !$compact) : ?><span class="kpy-card__role"><?= esc_html($role); ?></span><?php endif; ?>
                    <?php if ($brief && !$compact) : ?><p class="kpy-card__brief"><?= esc_html($brief); ?></p><?php endif; ?>
                </div>
                <!-- Bulma modal trigger (uses data-bulma-modal attribute) -->
                <button type="button"
                        class="kpy-card__btn"
                        data-bulma-modal="#<?= esc_attr($modal_id); ?>"
                        onclick="kpyOpenModal('<?= esc_attr($modal_id); ?>')">
                    View Profile <i class="bi bi-arrow-right-circle"></i>
                </button>
            </div>

            <?php if ($dept_name) : ?>
                <div class="kpy-card__dept-strip"><?= esc_html($dept_name); ?></div>
            <?php endif; ?>

        </div>
    </div>

    <!-- ══ MODAL (Bulma version) ══ -->
    <div class="modal" id="<?= esc_attr($modal_id); ?>">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="kpy-modal-inner">

                <button type="button"
                        class="kpy-modal__close modal-close"
                        data-bulma-close
                        aria-label="Close">&times;</button>

                <div class="kpy-modal__photo">
                    <?php if (has_post_thumbnail($pid)) :
                        echo get_the_post_thumbnail($pid, 'large');
                    else : ?>
                        <img src="<?= get_template_directory_uri(); ?>/assets/images/placeholder-image.jpg" alt="<?= esc_attr(get_the_title($pid)); ?>">
                    <?php endif; ?>
                    <?php if ($dept_name) : ?>
                        <div class="kpy-modal__dept"><?= esc_html($dept_name); ?></div>
                    <?php endif; ?>
                </div>

                <div class="kpy-modal__details">
                    <h2 class="kpy-modal__name" id="<?= esc_attr($modal_id); ?>-label"><?= esc_html(get_the_title($pid)); ?></h2>
                    <?php if ($designation) : ?><p class="kpy-modal__designation"><?= esc_html($designation); ?></p><?php endif; ?>
                    <?php if ($role) : ?><span class="kpy-modal__role-tag"><?= esc_html($role); ?></span><?php endif; ?>
                    <div class="kpy-modal__divider"></div>
                    <?php if ($brief) : ?><p class="kpy-modal__brief"><?= esc_html($brief); ?></p><?php endif; ?>
                    <div class="kpy-modal__content"><?php the_content(); ?></div>

                    <?php if ($email || $phone || $website) : ?>
                    <ul class="kpy-modal__contact">
                        <?php if ($email)   : ?><li><i class="bi bi-envelope"></i><a href="mailto:<?= esc_attr($email); ?>"><?= esc_html($email); ?></a></li><?php endif; ?>
                        <?php if ($phone)   : ?><li><i class="bi bi-telephone"></i><?= esc_html($phone); ?></li><?php endif; ?>
                        <?php if ($website) : ?><li><i class="bi bi-globe"></i><a href="<?= esc_url($website); ?>" target="_blank"><?= esc_html($website); ?></a></li><?php endif; ?>
                    </ul>
                    <?php endif; ?>

                    <?php if ($facebook || $linkedin || $instagram || $x || $whatsapp || $email) : ?>
                    <div class="kpy-modal__socials">
                        <?php if ($email)     : ?><a href="mailto:<?= esc_attr($email); ?>" title="Email"><i class="bi bi-envelope-fill"></i></a><?php endif; ?>
                        <?php if ($whatsapp)  : ?><a href="<?= esc_url($whatsapp); ?>" target="_blank" title="WhatsApp"><i class="bi bi-whatsapp"></i></a><?php endif; ?>
                        <?php if ($linkedin)  : ?><a href="<?= esc_url($linkedin); ?>" target="_blank" title="LinkedIn"><i class="bi bi-linkedin"></i></a><?php endif; ?>
                        <?php if ($facebook)  : ?><a href="<?= esc_url($facebook); ?>" target="_blank" title="Facebook"><i class="bi bi-facebook"></i></a><?php endif; ?>
                        <?php if ($instagram) : ?><a href="<?= esc_url($instagram); ?>" target="_blank" title="Instagram"><i class="bi bi-instagram"></i></a><?php endif; ?>
                        <?php if ($x)         : ?><a href="<?= esc_url($x); ?>" target="_blank" title="X / Twitter"><i class="bi bi-twitter-x"></i></a><?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>

            </div><!-- /.kpy-modal-inner -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->

    <?php
    wp_reset_postdata();
}


/* ============================================================
   SHORTCODE :: [team]
   ============================================================ */
function team_shortcode($atts) {
    $atts = shortcode_atts(array(
        'category'   => '',
        'department' => '',
        'number'     => -1,
    ), $atts, 'team');

    $query = kpy_team_query($atts);
    ob_start();

    if ($query->have_posts()) :
        $grid_id = 'kpy-grid-' . absint($query->posts[0]->ID); ?>
        <div id="<?= esc_attr($grid_id); ?>" class="kpy-team-wrap columns is-multiline">
        <?php while ($query->have_posts()) :
            $query->the_post();
            kpy_render_team_card(get_the_ID(), false);
        endwhile;
        wp_reset_postdata(); ?>
        </div>

    <?php else :
        echo '<p class="kpy-team-empty">No team members found.</p>';
    endif;

    return ob_get_clean();
}
add_shortcode('team', 'team_shortcode');


/* ============================================================
   SHORTCODE :: [past-team]
   ============================================================ */
function pastteam_shortcode($atts) {
    $atts = shortcode_atts(array(
        'category'   => 'past-team',
        'department' => '',
        'number'     => -1,
        'filter'     => 'yes',
    ), $atts, 'past-team');

    $query = kpy_team_query($atts);
    ob_start();

    if ($query->have_posts()) :

        $dept_map = array();
        foreach ($query->posts as $p) {
            $terms = wp_get_post_terms($p->ID, 'department');
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $t) { $dept_map[$t->slug] = $t->name; }
            }
        }

        $grid_id = 'kpy-past-grid-' . absint($query->posts[0]->ID);
        if ($atts['filter'] === 'yes' && count($dept_map) > 1) : ?>
        <div class="kpy-filter-bar" data-target="#<?= esc_attr($grid_id); ?>">
            <button class="kpy-filter-btn active" data-filter="all">All Members</button>
            <?php foreach ($dept_map as $slug => $name) : ?>
                <button class="kpy-filter-btn" data-filter="<?= esc_attr($slug); ?>"><?= esc_html($name); ?></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div id="<?= esc_attr($grid_id); ?>" class="kpy-team-wrap columns is-multiline">
        <?php while ($query->have_posts()) :
            $query->the_post();
            kpy_render_team_card(get_the_ID(), true);
        endwhile;
        wp_reset_postdata(); ?>
        </div>

    <?php else :
        echo '<p class="kpy-team-empty">No past team members found.</p>';
    endif;

    return ob_get_clean();
}
add_shortcode('past-team', 'pastteam_shortcode');


/* ============================================================
   STYLES (unchanged – all kpy‑* visual styles)
   ============================================================ */
add_action('wp_head', function () { ?>
<style>
/* =========================================================
   KPY TEAM STYLES — BLACK · RED · WHITE
   ========================================================= */
:root {
    --kpy-red: #d90000;
    --kpy-gold: #c9a84c;
    --kpy-black: #0a0a0a;
    --kpy-border: #222222;
    --kpy-white: #ffffff;
    --kpy-muted: #888888;
}

/* ── Filter bar ── */
.kpy-filter-bar { display:flex; flex-wrap:wrap; gap:10px; justify-content:center; max-width:1240px; margin:0 auto 44px; padding:0 24px; }
.kpy-filter-btn { background:transparent; border:1px solid var(--kpy-border); color:var(--kpy-muted); font-size:0.68rem; font-weight:900; letter-spacing:3px; text-transform:uppercase; padding:11px 28px; cursor:pointer; transition:background .2s,color .2s,border-color .2s; }
.kpy-filter-btn:hover { border-color:var(--kpy-white); color:var(--kpy-white); }
.kpy-filter-btn.active { background:var(--kpy-red); border-color:var(--kpy-red); color:#fff; }

/* ── Grid wrapper ── */
.kpy-team-wrap { max-width:1240px; margin:0 auto 64px !important; padding:0 24px !important; }
.kpy-member-col { padding:14px !important; }
.kpy-member-col.kpy-hidden { display:none !important; padding:0 !important; flex:0 !important; margin:0 !important; }

/* ── Card ── */
.kpy-card { position:relative; background:linear-gradient(145deg,#0a0a0a 0%,#0f0f0f 60%,#1c0000 100%); display:flex; flex-direction:column; overflow:hidden; border:1px solid var(--kpy-border); transition:transform .3s ease,box-shadow .3s ease; height:100%; }
.kpy-card:hover { transform:translateY(-6px); box-shadow:0 28px 60px rgba(0,0,0,.8); }

/* ── Photo ── */
.kpy-card__photo { position:relative; overflow:hidden; aspect-ratio:4/5; flex-shrink:0; }
.kpy-card__photo::before { content:''; position:absolute; top:0; left:0; width:3px; height:100%; background:var(--kpy-red); z-index:4; }
.kpy-card__photo img { display:block; width:100%; height:100%; object-fit:cover; object-position:top center; transition:transform .4s ease,filter .4s ease; filter:grayscale(25%); }
.kpy-card:hover .kpy-card__photo img { transform:scale(1.06); filter:grayscale(0%); }

/* ── Dept badge ── */
.kpy-card__dept { position:absolute; top:16px; left:3px; background:var(--kpy-red); color:#fff; font-size:0.54rem; font-weight:900; letter-spacing:3px; text-transform:uppercase; padding:5px 18px 5px 14px; clip-path:polygon(0 0,100% 0,88% 100%,0 100%); z-index:3; }

/* ── Hover overlay ── */
.kpy-card__overlay { position:absolute; inset:0; background:rgba(0,0,0,.82); display:flex; align-items:center; justify-content:center; opacity:0; transition:opacity .3s ease; z-index:5; pointer-events:none; }
.kpy-card:hover .kpy-card__overlay { opacity:1; pointer-events:auto; }
.kpy-card__overlay-socials { display:flex; gap:9px; flex-wrap:wrap; justify-content:center; }
.kpy-card__overlay-socials a { width:42px; height:42px; border:1px solid rgba(255,255,255,.25); color:#fff; display:flex; align-items:center; justify-content:center; font-size:0.95rem; text-decoration:none; transform:translateY(12px); transition:transform .3s ease,background .2s,border-color .2s; }
.kpy-card:hover .kpy-card__overlay-socials a { transform:translateY(0); }
.kpy-card__overlay-socials a:hover { background:var(--kpy-red); border-color:var(--kpy-red); }

/* ── Card body ── */
.kpy-card__body { background:var(--kpy-white); padding:20px 20px 18px; display:flex; flex-direction:column; gap:6px; flex:1; position:relative; z-index:6; }
.kpy-card__body::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:var(--kpy-red); }
.kpy-card__body::after { content:''; position:absolute; top:5px; left:0; right:0; height:1px; background:rgba(217,0,0,.18); }
.kpy-card__body-inner { flex:1; }
.kpy-card__name { font-size:0.95rem; font-weight:900; color:#0a0a0a; text-transform:uppercase; letter-spacing:0.06em; line-height:1.15; margin:0 0 6px; }
.kpy-card__title { font-size:0.62rem; font-weight:800; color:var(--kpy-red); text-transform:uppercase; letter-spacing:2.5px; margin:0; }
.kpy-card__role { display:inline-block; background:#f5f5f5; border-left:2px solid var(--kpy-gold); color:#555; font-size:0.6rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:3px 10px; margin-top:8px; }
.kpy-card__brief { font-size:0.78rem; color:#777; line-height:1.6; margin:8px 0 0; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }

/* ── CTA button ── */
.kpy-card__btn { display:inline-flex; align-items:center; justify-content:space-between; background:var(--kpy-black); color:#fff; border:none; font-size:0.6rem; font-weight:900; letter-spacing:2.5px; text-transform:uppercase; padding:11px 18px; cursor:pointer; margin-top:14px; align-self:stretch; transition:background .2s,letter-spacing .2s; position:relative; z-index:7; }
.kpy-card__btn:hover { background:var(--kpy-red); letter-spacing:3.5px; }

/* ── Dept strip ── */
.kpy-card__dept-strip { background:linear-gradient(90deg,#0a0a0a 0%,#1a0000 100%); color:#555; font-size:0.54rem; font-weight:800; letter-spacing:2.5px; text-transform:uppercase; padding:8px 20px; display:flex; align-items:center; gap:8px; }
.kpy-card__dept-strip::before { content:''; width:16px; height:1px; background:var(--kpy-red); flex-shrink:0; }

/* ── Empty state ── */
.kpy-team-empty { color:var(--kpy-muted); font-size:0.9rem; padding:3rem; text-align:center; border:1px dashed var(--kpy-border); max-width:600px; margin:0 auto; }

/* =========================================================
   MODAL STYLES (Bulma)
   ─────────────────────────────────────────────────────────
   RULE: Bulma's .modal, .modal-background, .modal-content
   are used for visibility. NEVER style them – Bulma handles
   display, positioning, and scroll locking.
   All visual styles go on .kpy-modal-inner and its children.
   ========================================================= */

/* Inner visual shell — this is what the user actually sees */
.kpy-modal-inner { display:grid; grid-template-columns:2fr 3fr; overflow:hidden; position:relative; background:linear-gradient(150deg,#111 0%,#0d0d0d 65%,#200000 100%); box-shadow:0 40px 100px rgba(0,0,0,.6); }

/* Close button */
.kpy-modal__close { position:absolute; top:14px; right:14px; background:var(--kpy-red); color:#fff; border:none; width:38px; height:38px; font-size:1.5rem; line-height:1; cursor:pointer; z-index:10; display:flex; align-items:center; justify-content:center; transition:background .2s; }
.kpy-modal__close:hover { background:#a00000; }

/* Photo column */
.kpy-modal__photo { position:relative; min-height:420px; overflow:hidden; }
.kpy-modal__photo img { display:block; width:100%; height:100%; object-fit:cover; object-position:top center; position:absolute; inset:0; }
.kpy-modal__photo::before { content:''; position:absolute; top:0; left:0; width:4px; height:100%; background:var(--kpy-red); z-index:3; }
.kpy-modal__dept { position:absolute; bottom:0; left:0; right:0; background:var(--kpy-red); color:#fff; font-size:0.6rem; font-weight:900; letter-spacing:2.5px; text-transform:uppercase; padding:9px 18px; z-index:2; }

/* Details column */
.kpy-modal__details { padding:36px 32px 32px; display:flex; flex-direction:column; gap:10px; background:#fff; }
.kpy-modal__name { font-size:1.6rem; font-weight:900; color:#0a0a0a; text-transform:uppercase; letter-spacing:-0.02em; line-height:1.05; margin:0; }
.kpy-modal__designation { font-size:0.72rem; font-weight:800; color:var(--kpy-red); text-transform:uppercase; letter-spacing:2.5px; margin:0; }
.kpy-modal__role-tag { display:inline-block; background:#f5f5f5; border-left:2px solid var(--kpy-gold); color:#555; font-size:0.62rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:4px 12px; align-self:flex-start; }
.kpy-modal__divider { height:2px; background:linear-gradient(90deg,var(--kpy-red),transparent); margin:4px 0; flex-shrink:0; }
.kpy-modal__brief { font-size:0.88rem; color:#666; font-style:italic; line-height:1.75; margin:0; }
.kpy-modal__content { font-size:0.86rem; color:#444; line-height:1.8; }
.kpy-modal__content p { margin-bottom:0.5rem; }
.kpy-modal__contact { list-style:none; margin:4px 0 0; padding:0; display:flex; flex-direction:column; gap:7px; border-top:1px solid #eee; padding-top:14px; }
.kpy-modal__contact li { font-size:0.82rem; color:#444; display:flex; align-items:center; gap:9px; }
.kpy-modal__contact li i { color:var(--kpy-red); font-size:0.9rem; }
.kpy-modal__contact a { color:#444; text-decoration:none; }
.kpy-modal__contact a:hover { color:var(--kpy-red); }
.kpy-modal__socials { display:flex; gap:8px; flex-wrap:wrap; margin-top:6px; padding-top:14px; border-top:1px solid #eee; }
.kpy-modal__socials a { width:38px; height:38px; background:#f0f0f0; border:1px solid #ddd; color:#333; display:flex; align-items:center; justify-content:center; font-size:0.9rem; text-decoration:none; transition:background .2s,color .2s,border-color .2s; }
.kpy-modal__socials a:hover { background:var(--kpy-red); color:#fff; border-color:var(--kpy-red); }

/* ── Responsive ── */
@media (max-width: 768px) {
    .kpy-modal-inner { grid-template-columns:1fr; }
    .kpy-modal__photo { min-height:260px; }
    .kpy-modal__details { padding:22px 18px 20px; }
    .kpy-team-wrap { padding:0 12px !important; }
    .kpy-member-col { padding:8px !important; }
}
</style>
<?php });


/* ============================================================
   SCRIPTS — filter tabs + Bulma modal handling
   ============================================================ */
add_action('wp_footer', function () { ?>
<script>
console.log('[kpy] TEAM SCRIPT LOADED');

// Global function for inline onclick - MUST be outside IIFE
function kpyOpenModal(modalId) {
    console.log('[kpy] kpyOpenModal called with:', modalId);
    var modal = document.getElementById(modalId);
    if (!modal) {
        console.log('[kpy] Modal not found:', modalId);
        return;
    }
    modal.classList.add('is-active');
    document.documentElement.classList.add('is-clipped');
    
    // Bind close handlers if not already bound
    modal.querySelectorAll('.modal-background, .modal-close, [data-bulma-close]').forEach(function(el) {
        el.onclick = function() {
            modal.classList.remove('is-active');
            document.documentElement.classList.remove('is-clipped');
        };
    });
}

// ESC key handler - also global
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        var active = document.querySelector('.modal.is-active');
        if (active) {
            active.classList.remove('is-active');
            document.documentElement.classList.remove('is-clipped');
        }
    }
});

(function () {
    'use strict';
    console.log('[kpy] Filter IIFE executing');

    // ---- FILTER TABS (used by [past-team]) ----
    function kpyInitFilters() {
        document.querySelectorAll('.kpy-filter-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var bar = this.closest('.kpy-filter-bar');
                if (!bar) return;

                bar.querySelectorAll('.kpy-filter-btn').forEach(function (b) { b.classList.remove('active'); });
                this.classList.add('active');

                var wrap     = null;
                var targetId = bar.getAttribute('data-target');
                if (targetId) {
                    wrap = document.querySelector(targetId);
                } else {
                    var sibling = bar.nextElementSibling;
                    while (sibling) {
                        if (sibling.classList.contains('kpy-team-wrap')) { wrap = sibling; break; }
                        sibling = sibling.nextElementSibling;
                    }
                }
                if (!wrap) return;

                var filter = this.getAttribute('data-filter');
                wrap.querySelectorAll('.kpy-member-col').forEach(function (col) {
                    var dept = (col.getAttribute('data-department') || '').trim();
                    col.classList.toggle('kpy-hidden', filter !== 'all' && dept !== filter);
                });
            });
        });
    }

    if (document.readyState !== 'loading') {
        kpyInitFilters();
    } else {
        document.addEventListener('DOMContentLoaded', kpyInitFilters);
    }
})();
</script>
<?php }, 99);