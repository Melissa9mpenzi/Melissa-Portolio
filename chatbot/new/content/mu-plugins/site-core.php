<?php
/**
 * ╔══════════════════════════════════════════════════════╗
 *  SITE CORE — Must-Use Plugin
 *  Location: /content/mu-plugins/site-core.php
 *         OR /wp-content/mu-plugins/site-core.php
 *         (works in both — uses WP constants, not hardcoded paths)
 *  Loads automatically. Cannot be deactivated.
 *  Login page HTML & CSS live in login.php.
 * ╚══════════════════════════════════════════════════════╝
 */

// ════════════════════════════════════════════════════════
//  ⚙  CONFIGURATION
// ════════════════════════════════════════════════════════
define( 'SITE_LOGIN_SLUG', 'portal' );
define( 'SITE_NAME',       'LWEGATECH CMS' );

define( 'DASH_NAVY',       '#0f2044' );
define( 'DASH_NAVY_HOVER', '#162d5c' );
define( 'DASH_NAVY_SUB',   '#1a3560' );
define( 'DASH_RED',        '#c0000c' );
define( 'DASH_RED_DARK',   '#8a0008' );


// ════════════════════════════════════════════════════════
//  1. FREEZE ALL UPDATES
// ════════════════════════════════════════════════════════
add_filter( 'auto_update_plugin',            '__return_false' );
add_filter( 'auto_update_theme',             '__return_false' );
add_filter( 'auto_update_translation',       '__return_false' );

remove_action( 'wp_version_check',           'wp_version_check' );
remove_action( 'wp_update_plugins',          'wp_update_plugins' );
remove_action( 'wp_update_themes',           'wp_update_themes' );

add_filter( 'site_transient_update_core',    '__return_false' );
add_filter( 'site_transient_update_plugins', '__return_false' );
add_filter( 'site_transient_update_themes',  '__return_false' );

add_action( 'admin_menu', function () {
    remove_action( 'admin_notices', 'update_nag', 3 );
} );

// ── Disable Site Health update checks ──
add_filter( 'site_status_tests', function( $tests ) {
    unset( $tests['async']['background_updates'] );
    unset( $tests['direct']['plugin_version'] );
    unset( $tests['direct']['theme_version'] );
    unset( $tests['direct']['wordpress_version'] );
    return $tests;
} );

// ── Remove WordPress Events & News dashboard widget ──
add_action( 'wp_dashboard_setup', function () {
    remove_meta_box( 'dashboard_primary',       'dashboard', 'side' );   // WP Events & News
    remove_meta_box( 'dashboard_secondary',     'dashboard', 'side' );   // WP news (older)
    remove_meta_box( 'dashboard_site_health',   'dashboard', 'normal' ); // Site Health Status
} );


// ════════════════════════════════════════════════════════
//  2. SCRUB WORDPRESS FINGERPRINTS
// ════════════════════════════════════════════════════════
remove_action( 'wp_head', 'wp_generator' );
add_filter(    'the_generator',   '__return_empty_string' );
remove_action( 'wp_head',         'rsd_link' );
remove_action( 'wp_head',         'wlwmanifest_link' );
remove_action( 'wp_head',         'wp_shortlink_wp_head' );
remove_action( 'wp_head',         'rest_output_link_wp_head' );
remove_action( 'wp_head',         'wp_oembed_add_discovery_links' );

// Strip ?ver= only from WP-core assets (static version strings like 6.7.2).
// Leaves filemtime-based timestamps (10+ digits) intact so theme custom.css
// auto-refreshes in the browser whenever the file is saved.
add_filter( 'style_loader_src', function( $src ) {
    $ver = (string) ( parse_url( $src, PHP_URL_QUERY ) ? '' : '' );
    preg_match( '/[?&]ver=([^&]+)/', $src, $m );
    // If ver looks like a Unix timestamp (10+ digits), keep it — it's filemtime.
    if ( isset( $m[1] ) && strlen( $m[1] ) >= 10 && ctype_digit( $m[1] ) ) {
        return $src;
    }
    return remove_query_arg( 'ver', $src );
}, 9999 );
add_filter( 'script_loader_src', fn( $src ) => remove_query_arg( 'ver', $src ), 9999 );

add_filter( 'wp_headers', function ( $h ) {
    unset( $h['X-Pingback'] );
    return $h;
} );


// ════════════════════════════════════════════════════════
//  3. LOGIN ROUTING
// ════════════════════════════════════════════════════════
add_action( 'wp_login', function ( $user_login, $user ) {
    wp_redirect( admin_url() );
    exit;
}, 10, 2 );

add_filter( 'login_url', function ( $login_url, $redirect, $force_reauth ) {
    $url = home_url( '/' . SITE_LOGIN_SLUG );
    if ( $redirect )     { $url = add_query_arg( 'redirect_to', urlencode( $redirect ), $url ); }
    if ( $force_reauth ) { $url = add_query_arg( 'reauth', '1', $url ); }
    return $url;
}, 10, 3 );


// ════════════════════════════════════════════════════════
//  4. GENERIC LOGIN ERROR MESSAGE
// ════════════════════════════════════════════════════════
add_filter( 'login_errors', fn() =>
    '<strong>Error:</strong> Incorrect credentials. Please try again.'
);


// ════════════════════════════════════════════════════════
//  5. POPPINS — Google Fonts (no local font dependency)
//  Uses content_url() so it works whether folder is
//  named wp-content OR content
// ════════════════════════════════════════════════════════
add_action( 'admin_enqueue_scripts', function () {
    wp_enqueue_style(
        'poppins',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap',
        array(), null
    );
} );

add_action( 'login_enqueue_scripts', function () {
    wp_enqueue_style(
        'poppins-login',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap',
        array(), null
    );
} );


// ════════════════════════════════════════════════════════
//  6. ADMIN DASHBOARD SKIN — NAVY + RED + POPPINS
// ════════════════════════════════════════════════════════
add_action( 'admin_head', function () { ?>
<style>

/* ── Poppins everywhere ── */
body.wp-admin, body.wp-admin *,
#wpadminbar, #wpadminbar *,
#adminmenu, #adminmenu *,
.wrap, .wrap *,
input, select, textarea, button, .button, label {
    font-family: 'Poppins', sans-serif !important;
    letter-spacing: -.01em;
}

/* ════════════════════
   ADMIN BAR
════════════════════ */
#wpadminbar {
    background: <?php echo DASH_NAVY; ?> !important;
    box-shadow: 0 1px 0 rgba(255,255,255,.06) !important;
}
#wpadminbar .ab-item,
#wpadminbar a.ab-item,
#wpadminbar .ab-top-menu > li > .ab-item,
#wpadminbar #wp-admin-bar-my-account .ab-item {
    color: rgba(255,255,255,.88) !important;
    font-size: 12px !important;
    font-weight: 500 !important;
}
#wpadminbar .ab-top-menu > li:hover > .ab-item,
#wpadminbar .ab-top-menu > li.hover > .ab-item {
    background: <?php echo DASH_RED; ?> !important;
    color: #fff !important;
}
#wpadminbar .menupop .ab-sub-wrapper {
    background: <?php echo DASH_NAVY_SUB; ?> !important;
    border: none !important;
    box-shadow: 0 8px 24px rgba(0,0,0,.35) !important;
}
#wpadminbar .menupop .ab-sub-wrapper a {
    color: rgba(255,255,255,.82) !important;
    font-size: 12px !important;
}
#wpadminbar .menupop .ab-sub-wrapper a:hover {
    background: <?php echo DASH_RED; ?> !important;
    color: #fff !important;
}

/* ════════════════════
   SIDEBAR
════════════════════ */
#adminmenu, #adminmenuback, #adminmenuwrap {
    background: <?php echo DASH_NAVY; ?> !important;
}
#adminmenu a, #adminmenu .menu-top, #adminmenu .wp-menu-name {
    color: rgba(255,255,255,.80) !important;
    font-size: 12.5px !important;
    font-weight: 400 !important;
    transition: color .15s, background .15s !important;
}

/* ── All dashicons → white (CPTs keep their own icons) ── */
#adminmenu .wp-menu-image:before {
    color: rgba(255,255,255,.70) !important;
    transition: color .15s !important;
}

/* ── Custom SVG icons for 10 built-in menus only ── */
#menu-dashboard .wp-menu-image:before {
    font-family: none !important; content: '' !important;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.80)' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='3' width='7' height='7' rx='1'/%3E%3Crect x='14' y='3' width='7' height='7' rx='1'/%3E%3Crect x='3' y='14' width='7' height='7' rx='1'/%3E%3Crect x='14' y='14' width='7' height='7' rx='1'/%3E%3C/svg%3E") center/16px no-repeat !important;
}
#menu-posts .wp-menu-image:before {
    font-family: none !important; content: '' !important;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.80)' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'/%3E%3Cpolyline points='14 2 14 8 20 8'/%3E%3Cline x1='16' y1='13' x2='8' y2='13'/%3E%3Cline x1='16' y1='17' x2='8' y2='17'/%3E%3C/svg%3E") center/16px no-repeat !important;
}
#menu-media .wp-menu-image:before {
    font-family: none !important; content: '' !important;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.80)' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='3' width='18' height='18' rx='2'/%3E%3Ccircle cx='8.5' cy='8.5' r='1.5'/%3E%3Cpolyline points='21 15 16 10 5 21'/%3E%3C/svg%3E") center/16px no-repeat !important;
}
#menu-pages .wp-menu-image:before {
    font-family: none !important; content: '' !important;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.80)' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z'/%3E%3Cpolyline points='13 2 13 9 20 9'/%3E%3C/svg%3E") center/16px no-repeat !important;
}
#menu-comments .wp-menu-image:before {
    font-family: none !important; content: '' !important;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.80)' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z'/%3E%3C/svg%3E") center/16px no-repeat !important;
}
#menu-appearance .wp-menu-image:before {
    font-family: none !important; content: '' !important;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.80)' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='12' r='10'/%3E%3Ccircle cx='12' cy='10' r='3'/%3E%3Cpath d='M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662'/%3E%3C/svg%3E") center/16px no-repeat !important;
}
#menu-plugins .wp-menu-image:before {
    font-family: none !important; content: '' !important;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.80)' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z'/%3E%3C/svg%3E") center/16px no-repeat !important;
}
#menu-users .wp-menu-image:before {
    font-family: none !important; content: '' !important;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.80)' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'/%3E%3Ccircle cx='9' cy='7' r='4'/%3E%3Cpath d='M23 21v-2a4 4 0 0 0-3-3.87'/%3E%3Cpath d='M16 3.13a4 4 0 0 1 0 7.75'/%3E%3C/svg%3E") center/16px no-repeat !important;
}
#menu-tools .wp-menu-image:before {
    font-family: none !important; content: '' !important;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.80)' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z'/%3E%3C/svg%3E") center/16px no-repeat !important;
}
#menu-settings .wp-menu-image:before {
    font-family: none !important; content: '' !important;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.80)' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='12' r='3'/%3E%3Cpath d='M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z'/%3E%3C/svg%3E") center/16px no-repeat !important;
}

/* Hover / active icon brightness */
#adminmenu li:hover .wp-menu-image:before,
#adminmenu li.current .wp-menu-image:before,
#adminmenu li.wp-has-current-submenu .wp-menu-image:before {
    color: #fff !important;
    opacity: 1 !important;
}

/* Separators */
#adminmenu .wp-menu-separator {
    background: transparent !important;
    height: 1px !important;
    margin: 4px 16px !important;
    border-top: 1px solid rgba(255,255,255,.07) !important;
}

/* Hover */
#adminmenu li:hover > a,
#adminmenu li > a:hover,
#adminmenu li > a:focus {
    background: <?php echo DASH_NAVY_HOVER; ?> !important;
    color: #fff !important;
}

/* Active / current → red */
#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu,
#adminmenu li.current a.menu-top {
    background: <?php echo DASH_RED; ?> !important;
    color: #fff !important;
    font-weight: 500 !important;
}
#adminmenu li.current a .wp-menu-image:before,
#adminmenu li.wp-has-current-submenu a .wp-menu-image:before {
    color: #fff !important;
}
#adminmenu .wp-menu-arrow,
#adminmenu .wp-menu-arrow div { background: <?php echo DASH_RED; ?> !important; }

/* Submenu */
#adminmenu .wp-submenu, #adminmenu .wp-submenu-wrap {
    background: <?php echo DASH_NAVY_SUB; ?> !important;
    border: none !important;
    box-shadow: none !important;
}
#adminmenu .wp-submenu a {
    color: rgba(255,255,255,.72) !important;
    font-size: 12px !important;
    font-weight: 300 !important;
    padding: 5px 5px 5px 16px !important;
}
#adminmenu .wp-submenu a:hover,
#adminmenu .wp-submenu li.current a {
    color: #fff !important;
    background: <?php echo DASH_RED; ?> !important;
}

/* Collapse */
#collapse-button { color: rgba(255,255,255,.5) !important; }
#collapse-button:hover { color: rgba(255,255,255,.9) !important; }


/* ════════════════════
   MAIN CONTENT
════════════════════ */
#wpcontent, #wpbody { background: #f5f7fb !important; }

#wpbody-content .wrap > h1,
#wpbody-content .wrap > h2 {
    color: <?php echo DASH_NAVY; ?> !important;
    font-weight: 600 !important;
    font-size: 1.5rem !important;
    margin-bottom: 1.2rem !important;
}
h3, h4 { color: <?php echo DASH_NAVY; ?> !important; }

/* Primary buttons — no border-radius for sharp professional look */
.button-primary, .page-title-action, input[type="submit"].button-primary {
    background: <?php echo DASH_RED; ?> !important;
    border: none !important;
    color: #fff !important;
    border-radius: 0 !important;
    font-weight: 500 !important;
    box-shadow: none !important;
    text-shadow: none !important;
    padding: 6px 16px !important;
    transition: background .18s !important;
}
.button-primary:hover, .button-primary:focus, .page-title-action:hover {
    background: <?php echo DASH_RED_DARK; ?> !important;
    color: #fff !important;
    border: none !important;
}

/* Secondary buttons — no border-radius */
.button-secondary, .button {
    border: 1px solid #d0d7e3 !important;
    color: <?php echo DASH_NAVY; ?> !important;
    border-radius: 0 !important;
    background: #fff !important;
    font-weight: 400 !important;
    box-shadow: none !important;
    transition: background .18s, color .18s, border-color .18s !important;
}
.button-secondary:hover, .button:hover {
    background: <?php echo DASH_NAVY; ?> !important;
    border-color: <?php echo DASH_NAVY; ?> !important;
    color: #fff !important;
}

/* Links */
#wpbody-content a:not(.button):not(.page-title-action):not(.menu-top) {
    color: <?php echo DASH_RED; ?> !important;
}
#wpbody-content a:not(.button):not(.page-title-action):not(.menu-top):hover {
    color: <?php echo DASH_NAVY; ?> !important;
}

/* Tables — no border-radius */
.widefat {
    border: none !important;
    box-shadow: 0 1px 4px rgba(0,0,0,.07) !important;
    border-radius: 0 !important;
    overflow: hidden;
}
.widefat thead th, .widefat tfoot th {
    background: <?php echo DASH_NAVY; ?> !important;
    color: rgba(255,255,255,.9) !important;
    font-weight: 500 !important;
    font-size: 11px !important;
    text-transform: uppercase !important;
    letter-spacing: .06em !important;
    border: none !important;
}
.widefat td, .widefat th { border-bottom: 1px solid #eef1f7 !important; }
.widefat tr:last-child td { border-bottom: none !important; }
.widefat tr:nth-child(even) td { background: #f8fafd !important; }
.widefat tr:hover td { background: #eef2fa !important; }
.row-actions .trash a { color: <?php echo DASH_RED; ?> !important; }

/* Post boxes — no border-radius */
.postbox {
    border: none !important;
    border-radius: 0 !important;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,.07) !important;
    background: #fff !important;
}
.postbox .postbox-header {
    background: <?php echo DASH_NAVY; ?> !important;
    border: none !important;
    padding: 0 12px !important;
    min-height: 42px !important;
}
.postbox .postbox-header h2,
.postbox .postbox-header h3,
.postbox .hndle {
    color: #fff !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    text-transform: uppercase !important;
    letter-spacing: .08em !important;
    border: none !important;
}
.postbox .postbox-header button {
    color: rgba(255,255,255,.55) !important;
    background: none !important;
    border: none !important;
    box-shadow: none !important;
}
.postbox .postbox-header button:hover { color: #fff !important; }
.postbox .inside { padding: 16px !important; }

/* Inputs — no border-radius */
input[type="text"], input[type="email"], input[type="url"],
input[type="password"], input[type="search"], input[type="number"],
select, textarea {
    border: 1px solid #dce3ef !important;
    border-radius: 0 !important;
    font-size: 13px !important;
    color: #1a2540 !important;
    box-shadow: none !important;
    transition: border-color .18s, box-shadow .18s !important;
}
input:focus, select:focus, textarea:focus {
    border-color: <?php echo DASH_RED; ?> !important;
    box-shadow: 0 0 0 3px rgba(192,0,12,.10) !important;
    outline: none !important;
}

/* Notices — no border-radius */
.notice {
    border-left: none !important;
    border-radius: 0 !important;
    box-shadow: 0 1px 4px rgba(0,0,0,.07) !important;
    padding: 10px 14px !important;
}
.notice-success { background: #f0faf5 !important; border-left: 3px solid #1e8a4c !important; border-radius: 0 !important; }
.notice-error   { background: #fff5f5 !important; border-left: 3px solid <?php echo DASH_RED; ?> !important; border-radius: 0 !important; }
.notice-warning { background: #fffbf0 !important; border-left: 3px solid #c78800 !important; border-radius: 0 !important; }
.notice-info    { background: #f0f6ff !important; border-left: 3px solid <?php echo DASH_NAVY; ?> !important; border-radius: 0 !important; }

/* Pagination — no border-radius */
.tablenav .tablenav-pages a,
.tablenav .tablenav-pages .current {
    border-radius: 0 !important;
    border-color: #d0d7e3 !important;
}
.tablenav .tablenav-pages a:hover,
.tablenav .tablenav-pages .current {
    background: <?php echo DASH_RED; ?> !important;
    border-color: <?php echo DASH_RED_DARK; ?> !important;
    color: #fff !important;
    box-shadow: none !important;
}

/* Screen options / help — no border-radius */
#screen-options-wrap, #contextual-help-wrap {
    border-top: 2px solid <?php echo DASH_RED; ?> !important;
    background: #fff !important;
    box-shadow: 0 4px 12px rgba(0,0,0,.08) !important;
    border-radius: 0 !important;
}

/* Footer */
#wpfooter {
    border-top: 1px solid #e8ecf4 !important;
    color: #9aa3b5 !important;
    font-size: 11px !important;
}

/* Misc */
#wpbody-content .meta-box-sortables { box-shadow: none !important; }
.form-table th { color: <?php echo DASH_NAVY; ?> !important; font-weight: 500 !important; }
.post-state { color: <?php echo DASH_RED; ?> !important; }
#adminmenu .awaiting-mod, #adminmenu .update-plugins {
    background: <?php echo DASH_RED; ?> !important;
    border-color: <?php echo DASH_RED_DARK; ?> !important;
    color: #fff !important;
    border-radius: 0 !important;
}

</style>
<?php } );


// ════════════════════════════════════════════════════════
//  11. CUSTOMIZER SIDEBAR RESKIN
//      Uses customize_controls_print_styles — fires inside
//      the customizer iframe head, so full control of the
//      sidebar panel, sections, controls, and footer.
// ════════════════════════════════════════════════════════
add_action( 'customize_controls_enqueue_scripts', function () {
    wp_enqueue_style(
        'poppins-customizer',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap',
        array(), null
    );
} );

add_action( 'customize_controls_print_styles', function () { ?>
<style id="lwegatech-customizer-skin">

/* ── Font ── */
body#customize-controls, body#customize-controls *,
.wp-full-overlay-sidebar, .wp-full-overlay-sidebar * {
    font-family: 'Poppins', sans-serif !important;
    box-sizing: border-box;
}

/* ══════════════════════════════════════════════
   SIDEBAR SHELL
   ══════════════════════════════════════════════ */
.wp-full-overlay-sidebar {
    background: <?php echo DASH_NAVY; ?> !important;
    border-right: 2px solid <?php echo DASH_RED; ?> !important;
    color: rgba(255,255,255,.90) !important;
}

/* ── Top header "You are customizing" ── */
#customize-header-actions {
    background: <?php echo DASH_NAVY; ?> !important;
    border-bottom: 1px solid rgba(255,255,255,.10) !important;
    padding: 8px 10px !important;
}
.customize-controls-close {
    color: rgba(255,255,255,.75) !important;
    border-right: 1px solid rgba(255,255,255,.12) !important;
    transition: background .15s, color .15s !important;
}
.customize-controls-close:hover {
    background: <?php echo DASH_RED; ?> !important;
    color: #fff !important;
}

/* Save / Publish button */
#customize-header-actions .customize-save-button-wrapper .button,
#customize-save-button-wrapper .button,
.customize-controls-preview-toggle,
#save-header-actions .button-primary.save,
.customize-save-button-wrapper .wp-customize-save {
    background: <?php echo DASH_RED; ?> !important;
    border: none !important;
    color: #fff !important;
    font-weight: 600 !important;
    font-size: 12px !important;
    letter-spacing: .04em !important;
    text-transform: uppercase !important;
    box-shadow: none !important;
    border-radius: 0 !important;
    transition: background .15s !important;
}
#customize-header-actions .customize-save-button-wrapper .button:hover,
.customize-save-button-wrapper .wp-customize-save:hover {
    background: <?php echo DASH_RED_DARK; ?> !important;
}

/* ── Pane "You are customizing / Active theme" info strip ── */
#accordion-section-themes.accordion-section .accordion-section-title,
#customize-info .accordion-section-title,
#customize-info {
    background: rgba(255,255,255,.04) !important;
    border-bottom: 1px solid rgba(255,255,255,.08) !important;
}
#customize-info .preview-notice,
#customize-info .theme-name,
#customize-info .customize-action {
    color: rgba(255,255,255,.70) !important;
    font-size: 11px !important;
    font-weight: 400 !important;
}
#customize-info .theme-name strong,
#customize-info strong {
    color: #fff !important;
    font-weight: 600 !important;
    font-size: 14px !important;
}

/* "Change" theme button */
#customize-info .theme-name .button,
.customize-section-back.button,
.change-theme {
    background: transparent !important;
    border: 1px solid rgba(255,255,255,.30) !important;
    color: rgba(255,255,255,.85) !important;
    font-size: 11px !important;
    border-radius: 0 !important;
    transition: all .15s !important;
}
#customize-info .theme-name .button:hover,
.change-theme:hover {
    background: <?php echo DASH_RED; ?> !important;
    border-color: <?php echo DASH_RED; ?> !important;
    color: #fff !important;
}

/* ══════════════════════════════════════════════
   SECTION LIST (accordion items)
   ══════════════════════════════════════════════ */
#customize-theme-controls {
    border-top: none !important;
}
.accordion-section-title,
.customize-panel-back,
#customize-theme-controls .accordion-section-title {
    background: <?php echo DASH_NAVY; ?> !important;
    color: rgba(255,255,255,.82) !important;
    font-size: 13px !important;
    font-weight: 400 !important;
    border-bottom: 1px solid rgba(255,255,255,.06) !important;
    border-left: 3px solid transparent !important;
    transition: background .15s, border-left-color .15s, color .15s !important;
    padding: 14px 14px 14px 16px !important;
}
.accordion-section-title:hover,
#customize-theme-controls .accordion-section-title:hover {
    background: <?php echo DASH_NAVY_HOVER; ?> !important;
    border-left-color: <?php echo DASH_RED; ?> !important;
    color: #fff !important;
}
.control-section.open > .accordion-section-title,
.accordion-section.open > .accordion-section-title {
    background: <?php echo DASH_RED; ?> !important;
    border-left-color: <?php echo DASH_RED_DARK; ?> !important;
    color: #fff !important;
    font-weight: 500 !important;
}
/* Arrow chevrons */
.accordion-section-title::after,
.accordion-section-title:after {
    border-top-color: rgba(255,255,255,.60) !important;
}
.control-section.open > .accordion-section-title::after,
.accordion-section.open > .accordion-section-title::after {
    border-top-color: rgba(255,255,255,.90) !important;
}

/* ── Section sub-panel header (Back arrow + title) ── */
#customize-theme-controls .customize-section-title,
.customize-section-title {
    background: <?php echo DASH_NAVY; ?> !important;
    border-bottom: 2px solid <?php echo DASH_RED; ?> !important;
    padding: 14px 16px !important;
}
.customize-section-title h3,
.customize-section-title .preview-notice {
    color: #fff !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    letter-spacing: .03em !important;
}
.customize-section-back {
    color: rgba(255,255,255,.75) !important;
    border-right: 1px solid rgba(255,255,255,.12) !important;
}
.customize-section-back:hover {
    background: rgba(255,255,255,.08) !important;
    color: #fff !important;
}

/* ── Panel back button ── */
.customize-panel-back {
    color: rgba(255,255,255,.75) !important;
}

/* ══════════════════════════════════════════════
   SECTION CONTENT (controls area)
   ══════════════════════════════════════════════ */
.accordion-section-content,
#customize-theme-controls .accordion-section-content {
    background: <?php echo DASH_NAVY_SUB; ?> !important;
    border-left: 3px solid <?php echo DASH_RED; ?> !important;
    padding: 4px 0 !important;
}

/* Control rows */
.customize-control {
    border-bottom: 1px solid rgba(255,255,255,.05) !important;
    padding: 10px 16px !important;
}
.customize-control-title,
.customize-control label {
    color: rgba(255,255,255,.80) !important;
    font-size: 12px !important;
    font-weight: 500 !important;
}
.customize-control-description,
.description {
    color: rgba(255,255,255,.45) !important;
    font-size: 11px !important;
}

/* Text / email / url / number inputs */
.customize-control input[type="text"],
.customize-control input[type="email"],
.customize-control input[type="url"],
.customize-control input[type="number"],
.customize-control input[type="search"],
.customize-control select,
.customize-control textarea {
    background: rgba(255,255,255,.07) !important;
    border: 1px solid rgba(255,255,255,.18) !important;
    color: #fff !important;
    font-family: 'Poppins', sans-serif !important;
    font-size: 12px !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    transition: border-color .15s !important;
}
.customize-control input:focus,
.customize-control select:focus,
.customize-control textarea:focus {
    border-color: <?php echo DASH_RED; ?> !important;
    box-shadow: 0 0 0 2px rgba(192,0,12,.20) !important;
    outline: none !important;
}
/* Select arrow on dark bg */
.customize-control select {
    -webkit-appearance: none !important;
    appearance: none !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='rgba(255,255,255,.5)'/%3E%3C/svg%3E") !important;
    background-repeat: no-repeat !important;
    background-position: right 10px center !important;
    padding-right: 28px !important;
}

/* Checkboxes & radios */
.customize-control input[type="checkbox"],
.customize-control input[type="radio"] {
    accent-color: <?php echo DASH_RED; ?> !important;
}

/* Range sliders */
.customize-control input[type="range"] {
    accent-color: <?php echo DASH_RED; ?> !important;
}

/* Color swatches */
.customize-control-color .color-picker-hex,
.wp-picker-container .wp-color-result {
    border-radius: 0 !important;
}

/* Buttons inside controls */
.customize-control .button,
.customize-control .button-secondary {
    background: transparent !important;
    border: 1px solid rgba(255,255,255,.25) !important;
    color: rgba(255,255,255,.80) !important;
    font-size: 11px !important;
    border-radius: 0 !important;
    transition: all .15s !important;
}
.customize-control .button:hover {
    background: <?php echo DASH_RED; ?> !important;
    border-color: <?php echo DASH_RED; ?> !important;
    color: #fff !important;
}

/* ══════════════════════════════════════════════
   FOOTER — "Hide Controls" + device preview icons
   ══════════════════════════════════════════════ */
.wp-full-overlay-footer {
    background: <?php echo DASH_NAVY; ?> !important;
    border-top: 1px solid rgba(255,255,255,.10) !important;
}
.collapse-sidebar,
.collapse-sidebar-label {
    color: rgba(255,255,255,.65) !important;
    font-size: 11px !important;
    font-weight: 400 !important;
    transition: color .15s !important;
}
.collapse-sidebar:hover,
.collapse-sidebar:hover .collapse-sidebar-label {
    color: #fff !important;
}
.collapse-sidebar-arrow { fill: rgba(255,255,255,.65) !important; }
.collapse-sidebar:hover .collapse-sidebar-arrow { fill: #fff !important; }

/* Device preview toggle icons */
.devices-wrapper .preview-desktop,
.devices-wrapper .preview-tablet,
.devices-wrapper .preview-mobile,
.wp-full-overlay-footer .devices button {
    color: rgba(255,255,255,.55) !important;
    background: transparent !important;
    border: none !important;
    transition: color .15s !important;
}
.devices-wrapper .preview-desktop:hover,
.devices-wrapper .preview-tablet:hover,
.devices-wrapper .preview-mobile:hover,
.wp-full-overlay-footer .devices button:hover,
.devices-wrapper .active,
.wp-full-overlay-footer .devices button.active {
    color: <?php echo DASH_RED; ?> !important;
}
/* Dashicons in footer */
.wp-full-overlay-footer .dashicons { color: inherit !important; }

/* ══════════════════════════════════════════════
   MISC — Scrollbar, spinner, search, notifications
   ══════════════════════════════════════════════ */
/* Custom scrollbar */
.wp-full-overlay-sidebar::-webkit-scrollbar { width: 4px; }
.wp-full-overlay-sidebar::-webkit-scrollbar-track { background: <?php echo DASH_NAVY; ?>; }
.wp-full-overlay-sidebar::-webkit-scrollbar-thumb { background: <?php echo DASH_RED; ?>; border-radius: 0; }

/* Search (Menu panel) */
.customize-control-search-terms input {
    background: rgba(255,255,255,.07) !important;
    border-color: rgba(255,255,255,.18) !important;
    color: #fff !important;
}

/* Notification / status bar */
.wp-customize-bubble,
ul#customize-notifications-list .notice,
.customize-changeset-notification {
    background: rgba(192,0,12,.12) !important;
    border-left: 3px solid <?php echo DASH_RED; ?> !important;
    color: rgba(255,255,255,.85) !important;
    border-radius: 0 !important;
}

/* Remove WP border-radius globally in customizer */
* { border-radius: 0 !important; }

</style>
<?php } );


// ════════════════════════════════════════════════════════
//  7. STRIP WP BRANDING
// ════════════════════════════════════════════════════════
add_action( 'wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
    $wp_admin_bar->remove_menu( 'updates' );   // ← removes the "NEW" updates badge
} );

// ── Custom LWEGATECH "L" icon + name in admin bar ──
add_action( 'admin_bar_menu', function ( $wp_admin_bar ) {
    // Brand node
    $wp_admin_bar->add_node( array(
        'id'    => 'lwegatech-logo',
        'title' => '<span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;background:#111;color:#c0000c;font-family:Poppins,sans-serif;font-weight:700;font-size:15px;line-height:1;margin:4px 4px 0 0;">L</span><span style="font-family:Poppins,sans-serif;font-weight:600;font-size:13px;color:#fff;letter-spacing:.03em;">LWEGATECH</span>',
        'href'  => admin_url(),
        'meta'  => array( 'title' => 'LWEGATECH CMS' ),
    ) );

    // Strip text from the "+ New" button — keep SVG icon only
    $new_node = $wp_admin_bar->get_node( 'new-content' );
    if ( $new_node ) {
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.88)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;vertical-align:middle;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>';
        $wp_admin_bar->add_node( array(
            'id'    => 'new-content',
            'title' => $icon,
        ) );
    }

    // Strip text from the comments bubble — keep SVG icon only
    $comments_node = $wp_admin_bar->get_node( 'comments' );
    if ( $comments_node ) {
        // Preserve the existing href and just replace title
        $icon_c = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.88)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;vertical-align:middle;margin-right:3px;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>';
        $wp_admin_bar->add_node( array(
            'id'    => 'comments',
            'title' => $icon_c . '<span id="ab-awaiting-mod" class="ab-awaiting-mod awaiting-mod">' . $comments_node->title . '</span>',
        ) );
    }
}, 999 );

add_filter( 'admin_footer_text', fn() =>
    '<span>' . esc_html( SITE_NAME ) . ' &mdash; Content Management System</span>'
);
add_filter( 'update_footer', fn() => '', 11 );

add_filter( 'admin_title', function ( $admin_title ) {
    return str_replace( '— WordPress', '— ' . SITE_NAME, $admin_title );
} );


// ════════════════════════════════════════════════════════
//  8. (REMOVED — wp-admin/ has been physically renamed to admin/,
//     so admin_url() naturally outputs /admin/ — no filter needed)
// ════════════════════════════════════════════════════════


// ════════════════════════════════════════════════════════
//  9. JS DOM SCRUBBER — erase remaining "WordPress" text
//  Uses TreeWalker for efficient text-node traversal.
// ════════════════════════════════════════════════════════
add_action( 'admin_footer', function () { ?>
<script id="portal-dom-scrubber">
(function () {
    'use strict';

    function scrub() {

        /* ── 1. <title> ───────────────────────────────── */
        document.title = document.title
            .replace(/—\s*WordPress/gi, '— <?php echo esc_js( SITE_NAME ); ?>')
            .replace(/WordPress/gi, '<?php echo esc_js( SITE_NAME ); ?>');

        /* ── 2. Text nodes ───────────────────────────── */
        var walker = document.createTreeWalker(
            document.body,
            NodeFilter.SHOW_TEXT,
            {
                acceptNode: function (n) {
                    var p = n.parentElement;
                    if (!p) return NodeFilter.FILTER_REJECT;
                    var t = p.tagName;
                    if (t === 'SCRIPT' || t === 'STYLE' || t === 'TEXTAREA') {
                        return NodeFilter.FILTER_REJECT;
                    }
                    return (n.textContent.indexOf('WordPress') !== -1 ||
                            n.textContent.indexOf('Howdy,')    !== -1)
                        ? NodeFilter.FILTER_ACCEPT
                        : NodeFilter.FILTER_SKIP;
                }
            }
        );
        var node;
        while ((node = walker.nextNode())) {
            node.textContent = node.textContent
                /* "WordPress 6.x.x" → "Portal" */
                .replace(/WordPress\s+\d+[\d.]*/gi, '<?php echo esc_js( SITE_NAME ); ?>')
                /* bare "WordPress" */
                .replace(/WordPress/gi, '<?php echo esc_js( SITE_NAME ); ?>')
                /* "Howdy," → "Hello," */
                .replace(/Howdy,/g, 'Hello,');
        }
    }

    /* Run after DOM is ready */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', scrub);
    } else {
        scrub();
    }
})();
</script>
<?php }, 9999 );


// ════════════════════════════════════════════════════════
//  10. EXTRA CSS — hide remaining WP-branded UI elements
// ════════════════════════════════════════════════════════
add_action( 'admin_head', function () { ?>
<style id="lwegatech-extra-css">

/* ══════════════════════════════════════════════
   GLOBAL — no border-radius anywhere
   ══════════════════════════════════════════════ */
* { border-radius: 0 !important; }

/* WP version string — right side of footer */
#wpfooter #footer-upgrade { display: none !important; }

/* ══════════════════════════════════════════════
   ADMIN BAR — Remove "NEW" text label & fix broken icon boxes
   ══════════════════════════════════════════════ */

/* Hide the text label "New" / "NEW" on the + New button */
#wp-admin-bar-new-content > .ab-item .ab-label,
#wp-admin-bar-new-content > .ab-item > span.ab-label {
    display: none !important;
}

/* Hide ALL broken dashicon boxes in the admin bar (span.dashicons, ab-icon spans) */
#wpadminbar .ab-icon,
#wpadminbar .ab-top-menu > li > .ab-item .dashicons,
#wpadminbar .ab-item .dashicons,
#wpadminbar .dashicons {
    display: none !important;
}

/* ── Replace comments icon with clean SVG ── */
#wp-admin-bar-comments > .ab-item::before {
    content: '' !important;
    display: inline-block !important;
    width: 16px !important;
    height: 16px !important;
    margin-right: 4px !important;
    vertical-align: middle !important;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.88)' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z'/%3E%3C/svg%3E") center/16px no-repeat !important;
}

/* ── Replace + New button icon with clean SVG ── */
#wp-admin-bar-new-content > .ab-item::before {
    content: '' !important;
    display: inline-block !important;
    width: 16px !important;
    height: 16px !important;
    margin-right: 6px !important;
    vertical-align: middle !important;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.88)' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='12' r='10'/%3E%3Cline x1='12' y1='8' x2='12' y2='16'/%3E%3Cline x1='8' y1='12' x2='16' y2='12'/%3E%3C/svg%3E") center/16px no-repeat !important;
}

/* Keep the "+ New" sub-menu items readable */
#wp-admin-bar-new-content .ab-submenu .ab-item {
    padding-left: 12px !important;
}

/* WP logo node in admin bar (belt-and-suspenders) */
#wpadminbar #wp-admin-bar-wp-logo,
#wpadminbar li#wp-admin-bar-wp-logo { display: none !important; }

/* "Get WordPress" link in admin bar (multisite context) */
#wp-admin-bar-wporg_favorites { display: none !important; }

/* About-page badge */
.about-wrap .wp-badge,
.about-header .wp-badge { display: none !important; }

/* Update nag */
.update-nag, .notice.update-nag { display: none !important; }

/* Footer text override */
#wpfooter p:first-child { visibility: hidden; }
#wpfooter p:first-child .portal-footer-replace { visibility: visible; }

/* ══════════════════════════════════════════════
   CUSTOMIZER / APPEARANCE EDITOR — unique skin
   ══════════════════════════════════════════════ */
/* Customizer sidebar */
.wp-full-overlay-sidebar,
#customize-controls .wp-full-overlay-sidebar {
    background: <?php echo DASH_NAVY; ?> !important;
    border-right: 2px solid <?php echo DASH_RED; ?> !important;
}
#customize-header-actions {
    background: <?php echo DASH_NAVY; ?> !important;
    border-bottom: 1px solid rgba(255,255,255,.08) !important;
}
#customize-header-actions .customize-controls-close {
    border-right: 1px solid rgba(255,255,255,.12) !important;
    color: rgba(255,255,255,.8) !important;
}
#customize-header-actions .customize-controls-close:hover {
    background: <?php echo DASH_RED; ?> !important;
    color: #fff !important;
}
#customize-info .customize-panel-description,
#customize-info .accordion-section-title,
.customize-section-title h3,
.customize-panel-title h3,
#customize-theme-controls .accordion-section-title {
    color: rgba(255,255,255,.9) !important;
    background: transparent !important;
    border-color: rgba(255,255,255,.08) !important;
}
#customize-theme-controls .accordion-section-title:hover {
    background: rgba(255,255,255,.06) !important;
    color: #fff !important;
    border-left: 3px solid <?php echo DASH_RED; ?> !important;
}
#customize-theme-controls .control-section.open > .accordion-section-title {
    background: <?php echo DASH_RED; ?> !important;
    color: #fff !important;
}
.customize-control-title,
.customize-section-description {
    color: rgba(255,255,255,.85) !important;
}
.customize-control input[type="text"],
.customize-control select,
.customize-control textarea {
    background: rgba(255,255,255,.08) !important;
    border: 1px solid rgba(255,255,255,.15) !important;
    color: #fff !important;
}
.customize-control input:focus,
.customize-control select:focus,
.customize-control textarea:focus {
    border-color: <?php echo DASH_RED; ?> !important;
    box-shadow: 0 0 0 2px rgba(192,0,12,.25) !important;
}
#save-header-actions .button-primary.save {
    background: <?php echo DASH_RED; ?> !important;
    border: none !important;
}

/* ══════════════════════════════════════════════
   BLOCK EDITOR — unique skin
   ══════════════════════════════════════════════ */
/* Top header bar */
.edit-post-header,
.editor-header {
    background: <?php echo DASH_NAVY; ?> !important;
    border-bottom: 2px solid <?php echo DASH_RED; ?> !important;
}
/* All buttons in header */
.edit-post-header .components-button,
.editor-header .components-button {
    color: rgba(255,255,255,.85) !important;
}
.edit-post-header .components-button:hover,
.editor-header .components-button:hover {
    color: #fff !important;
    background: rgba(255,255,255,.1) !important;
}
/* Publish/Save button */
.edit-post-header .editor-post-publish-button,
.editor-header .editor-post-publish-button,
.edit-post-header .editor-post-save-draft,
.editor-header .editor-post-save-draft {
    background: <?php echo DASH_RED; ?> !important;
    color: #fff !important;
    border: none !important;
}
.edit-post-header .editor-post-publish-button:hover,
.editor-header .editor-post-publish-button:hover {
    background: <?php echo DASH_RED_DARK; ?> !important;
}
/* WP icon in editor top-left — replace with L */
.edit-post-header .edit-post-fullscreen-mode-close.components-button,
.editor-header .edit-post-fullscreen-mode-close.components-button {
    background: #111 !important;
    color: <?php echo DASH_RED; ?> !important;
    width: 36px !important;
    height: 36px !important;
}
.edit-post-header .edit-post-fullscreen-mode-close.components-button svg,
.editor-header .edit-post-fullscreen-mode-close.components-button svg,
.edit-post-header .edit-post-fullscreen-mode-close.components-button .dashicons,
.editor-header .edit-post-fullscreen-mode-close.components-button .dashicons {
    display: none !important;
}
.edit-post-header .edit-post-fullscreen-mode-close.components-button::before,
.editor-header .edit-post-fullscreen-mode-close.components-button::before {
    content: 'L' !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 100% !important;
    height: 100% !important;
    font-family: 'Poppins', sans-serif !important;
    font-weight: 700 !important;
    font-size: 18px !important;
    color: <?php echo DASH_RED; ?> !important;
    background: #111 !important;
}
.edit-post-header .edit-post-fullscreen-mode-close.components-button:hover,
.editor-header .edit-post-fullscreen-mode-close.components-button:hover {
    background: <?php echo DASH_RED; ?> !important;
}
.edit-post-header .edit-post-fullscreen-mode-close.components-button:hover::before,
.editor-header .edit-post-fullscreen-mode-close.components-button:hover::before {
    color: #fff !important;
    background: <?php echo DASH_RED; ?> !important;
}
/* Right sidebar */
.interface-interface-skeleton__sidebar,
.edit-post-sidebar {
    border-left: 2px solid <?php echo DASH_RED; ?> !important;
}
.edit-post-sidebar__panel-tab.is-active,
.components-tab-panel__tabs .components-button.is-active {
    border-bottom-color: <?php echo DASH_RED; ?> !important;
    color: <?php echo DASH_RED; ?> !important;
}
/* Override all WP blue/purple accent colors in editor */
.components-button.is-primary,
.block-editor .components-button.is-primary {
    background: <?php echo DASH_RED; ?> !important;
    color: #fff !important;
    border: none !important;
}
.components-button.is-primary:hover,
.block-editor .components-button.is-primary:hover {
    background: <?php echo DASH_RED_DARK; ?> !important;
}
/* Blue focus rings → red */
.components-button:focus:not(:disabled),
.block-editor *:focus {
    box-shadow: 0 0 0 2px <?php echo DASH_RED; ?> !important;
    outline: none !important;
}
/* Inserter button, toggle buttons */
.block-editor-inserter__toggle.components-button.has-icon,
.edit-post-header__toolbar .components-button:hover {
    color: #fff !important;
}
/* Match left side toolbar to navy */
.interface-interface-skeleton__header {
    background: <?php echo DASH_NAVY; ?> !important;
}
/* Editor content area accent color override (selection, links) */
.editor-styles-wrapper a { color: <?php echo DASH_RED; ?> !important; }

/* ══════════════════════════════════════════════
   TABLE HEADER + FOOTER TEXT — white on navy
   ══════════════════════════════════════════════ */
.widefat thead th a,
.widefat thead th a:visited,
.widefat thead th a span,
.widefat thead .column-title a,
.widefat thead .column-date a,
.widefat thead .column-author a,
.widefat thead .column-categories a,
.widefat thead .column-tags a,
.widefat thead .column-comments a,
.widefat thead .sorted a,
.widefat thead .manage-column a,
.widefat thead th,
.widefat tfoot th a,
.widefat tfoot th a:visited,
.widefat tfoot th a span,
.widefat tfoot .column-title a,
.widefat tfoot .column-date a,
.widefat tfoot .column-author a,
.widefat tfoot .column-categories a,
.widefat tfoot .column-tags a,
.widefat tfoot .column-comments a,
.widefat tfoot .sorted a,
.widefat tfoot .manage-column a,
.widefat tfoot th {
    color: #fff !important;
}
.widefat thead .sorting-indicators .sorting-indicator,
.widefat tfoot .sorting-indicators .sorting-indicator {
    color: rgba(255,255,255,.5) !important;
}
.widefat thead .sorting-indicators .sorting-indicator.asc::before,
.widefat thead .sorting-indicators .sorting-indicator.desc::before,
.widefat thead th .dashicons,
.widefat tfoot .sorting-indicators .sorting-indicator.asc::before,
.widefat tfoot .sorting-indicators .sorting-indicator.desc::before,
.widefat tfoot th .dashicons {
    color: rgba(255,255,255,.7) !important;
}

/* ══════════════════════════════════════════════
   COMMENTS — hide WordPress references
   ══════════════════════════════════════════════ */
#dashboard_right_now .wordpress-version,
.comment-ays-submit .wp-core-ui,
.dashboard-comment-wrap .comment-author a[href*="wordpress.org"] {
    display: none !important;
}

/* ══════════════════════════════════════════════
   SITE HEALTH — hide version check warnings
   ══════════════════════════════════════════════ */
.site-health-issues-wrapper .health-check-accordion-heading button[aria-label*="WordPress"],
.site-health-issues-wrapper [data-testid*="update"],
body.site-health .health-check-body .site-status-has-issues .issue-list li:has([data-testid*="update"]) {
    display: none !important;
}

</style>
<?php } );