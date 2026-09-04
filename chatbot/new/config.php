<?php
/**
 * The base configuration for WordPress
 *
 * The config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'lwegatech-cms' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */


// ── Auth Keys & Salts ──────────────────────────────────
define( 'AUTH_KEY',         'El_</=WV$8nW7m{$X[@r]KntG/,;xr<F3 be&;$S(51m<z)4]FP[oo)vfhH}Q>IU' );
define( 'SECURE_AUTH_KEY',  'eN)<H1@X+-M!}[eP]ngy054eiv1h=mW,`5<32p+LoGgIB/x!Sc:B062!;TLy}T}E' );
define( 'LOGGED_IN_KEY',    '5H%<GsFn(Y#R_w`1ydg7f3J7;H3cKW0G@_Xn-j{JafB`0*U9{!:g|6=hsaa&%qy2' );
define( 'NONCE_KEY',        ')sCF>7^,;9X({3)XI1kkoy8/gEppf]9]v+ONpARfK+,~dZ-Ry}ya7AbaDI[]@Fq(' );
define( 'AUTH_SALT',        '$3zTU_x~k>qaTH}ds9RpU>hO,0v/c@L_6B9<7EdOZLJJ?TP%}j*jSsM}^b#y%-5f' );
define( 'SECURE_AUTH_SALT', ':YLUMbd*;k5(XoOC:LOU?[?3;l |O,@Y61F:lgt^,1[9,s@%Aqm%s1UvN3szM=r$' );
define( 'LOGGED_IN_SALT',   'fUhRZ&Fo&xgt&ii9Uis$2HeU-b::gCkF7LZZ }6f,NBK;dl|l=/_{8y_Ac(#4dL0' );
define( 'NONCE_SALT',       'sFZ?toX$YX_0Qu:$nG8_BiGPbnXD@1*=-Y@suIUD8Q-lNN8l|-aEtByt=.V-@Vbb' );

// ── Table Prefix ───────────────────────────────────────
$table_prefix = 'wpw26_';

// ── Debug (keep off on production) ────────────────────
define( 'WP_DEBUG', false );


/* ══════════════════════════════════════════════════════
   CUSTOM SETTINGS
   ══════════════════════════════════════════════════════ */

// ── Subdirectory cookie fix ────────────────────────────
define( 'COOKIEPATH',     '/new/' );
define( 'SITECOOKIEPATH', '/new/' );
define( 'COOKIE_DOMAIN',  false );

// ── Freeze all updates ─────────────────────────────────
define( 'AUTOMATIC_UPDATER_DISABLED', true );
define( 'WP_AUTO_UPDATE_CORE',        false );

// ── Lock file editor and installs from dashboard ───────
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', true );


// ── wp-content folder rename ───────────────────────────
define( 'WP_CONTENT_DIR',  ABSPATH . 'content' );

// Avoid hardcoding localhost/http which can break CSS/font loading (mixed-content / wrong host).
// This keeps the intentional /new + /content structure while adapting to the current request host/scheme.
$__portal_scheme = ( ! empty( $_SERVER['HTTPS'] ) && 'off' !== $_SERVER['HTTPS'] ) ? 'https' : 'http';
$__portal_host   = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : 'localhost';
$__portal_base   = $__portal_scheme . '://' . $__portal_host . '/new';

define( 'WP_CONTENT_URL',  $__portal_base . '/content' );
define( 'WP_PLUGIN_DIR',   ABSPATH . 'content/plugins' );
define( 'WP_PLUGIN_URL',   $__portal_base . '/content/plugins' );
define( 'WPMU_PLUGIN_DIR', ABSPATH . 'content/mu-plugins' );
define( 'WPMU_PLUGIN_URL', $__portal_base . '/content/mu-plugins' );

// ── Localhost URL override (prevents prod redirects) ───
// Your DB may still have `home` / `siteurl` set to production.
// This forces localhost URLs only when running locally.
$__portal_is_local = in_array($__portal_host, ['localhost', '127.0.0.1', '::1'], true) || str_ends_with($__portal_host, '.local');
if ($__portal_is_local) {
    define('WP_HOME', $__portal_base);
    define('WP_SITEURL', $__portal_base);
}


/* That's all, stop editing! Happy publishing. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}
require_once ABSPATH . 'settings.php';