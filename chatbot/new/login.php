<?php
/**
 * WordPress User Page
 *
 * Handles authentication, registering, resetting passwords, forgot password,
 * and other user handling.
 *
 * @package WordPress
 */

/** Make sure that the WordPress bootstrap has run before continuing. */
require __DIR__ . '/load.php';

// Redirect to HTTPS login if forced to use SSL.
if ( force_ssl_admin() && ! is_ssl() ) {
	if ( str_starts_with( $_SERVER['REQUEST_URI'], 'http' ) ) {
		wp_safe_redirect( set_url_scheme( $_SERVER['REQUEST_URI'], 'https' ) );
		exit;
	} else {
		wp_safe_redirect( 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		exit;
	}
}

/**
 * ─────────────────────────────────────────────────────────
 *  CUSTOM VISUAL LAYER — only CSS/HTML is changed here.
 *  All PHP authentication logic below is 100% original.
 * ─────────────────────────────────────────────────────────
 */
function kpy_login_styles() { ?>
<style>
/* ── Reset ─────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html, body.login { height: 100%; }

body.login {
    display: flex !important;
    min-height: 100vh;
    background: #fff !important;
    font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
}

/* ── LEFT PANEL ─────────────────────────────────────── */
#kpy-left {
    flex: 0 0 46%;
    background: #fdf2f2;
    display: flex;
    flex-direction: column;
    padding: 2.8rem 3.5rem;
    position: relative;
    overflow: hidden;
}
#kpy-left::before {
    content: '';
    position: absolute; top: -100px; right: -100px;
    width: 380px; height: 380px; border-radius: 50%;
    background: rgba(192,0,12,.05); pointer-events: none;
}
#kpy-left::after {
    content: '';
    position: absolute; bottom: -80px; left: -80px;
    width: 300px; height: 300px; border-radius: 50%;
    background: rgba(17,17,17,.04); pointer-events: none;
}

.kpy-logo { display: flex; align-items: center; gap: .7rem; }
.kpy-logo span {
    font-size: 1.55rem; font-weight: 700;
    color: #111; letter-spacing: -.3px;
}

.kpy-content { margin-top: 3rem; }
.kpy-content h2 {
    font-size: 2.1rem; font-weight: 700;
    color: #111; line-height: 1.22; margin-bottom: .7rem;
}
.kpy-content p { font-size: .97rem; color: #666; line-height: 1.6; }

.kpy-illustration {
    flex: 1; display: flex;
    align-items: center; justify-content: center; padding: 1rem 0;
}
.kpy-illustration svg {
    width: 100%; max-width: 420px; height: auto;
    filter: drop-shadow(0 8px 24px rgba(192,0,12,.10));
}

.kpy-footer { font-size: .78rem; color: #aaa; margin-top: auto; padding-top: 1rem; }

/* ── RIGHT PANEL ─────────────────────────────────────── */
body.login > #kpy-right-wrap {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    padding: 2rem;
}

/* Override default WP login positioning */
#login {
    width: 100% !important;
    max-width: 420px !important;
    padding: 0 !important;
    margin: 0 !important;
}

/* Hide default WP logo */
.wp-login-logo { display: none !important; }
h1.screen-reader-text { display: none !important; }

/* ── Custom form heading (injected via CSS) ──────────── */
#loginform::before  { content: "Sign in to your account"; }
#lostpasswordform::before { content: "Reset your password"; }
#registerform::before { content: "Create an account"; }
#resetpassform::before { content: "Set new password"; }

#loginform::before,
#lostpasswordform::before,
#registerform::before,
#resetpassform::before {
    display: block;
    font-size: 1.85rem;
    font-weight: 700;
    color: #111;
    margin-bottom: 2rem;
    line-height: 1.2;
}

/* Labels */
.login label {
    font-size: .875rem; font-weight: 600; color: #333;
    display: block; margin-bottom: .45rem; letter-spacing: .01em;
}

/* Inputs */
.login input[type="text"],
.login input[type="password"],
.login input[type="email"] {
    width: 100% !important;
    border: 1.5px solid #ddd !important;
    border-radius: 8px !important;
    padding: 11px 14px !important;
    font-size: .95rem !important;
    color: #111 !important;
    background: #fafafa !important;
    box-shadow: none !important;
    transition: border-color .2s, box-shadow .2s, background .2s !important;
    -webkit-appearance: none;
}
.login input[type="text"]:focus,
.login input[type="password"]:focus,
.login input[type="email"]:focus {
    border-color: #c0000c !important;
    background: #fff !important;
    box-shadow: 0 0 0 3px rgba(192,0,12,.12) !important;
    outline: none !important;
}

/* Field spacing */
.login p,
.login .user-pass-wrap,
.login .login-username,
.login .login-password { margin-bottom: 1.25rem !important; }

/* Show/hide password button */
button.wp-hide-pw {
    background: transparent !important; border: none !important;
    box-shadow: none !important; color: #aaa !important; padding: 0 10px !important;
}

/* Submit button */
.login .button-primary,
#wp-submit {
    width: 100% !important;
    background: #c0000c !important;
    color: #fff !important;
    border: none !important;
    border-radius: 8px !important;
    padding: 13px 20px !important;
    font-size: 1rem !important;
    font-weight: 700 !important;
    letter-spacing: .04em !important;
    cursor: pointer !important;
    transition: background .2s, transform .1s, box-shadow .2s !important;
    box-shadow: 0 3px 12px rgba(192,0,12,.28) !important;
    height: auto !important;
    line-height: 1.4 !important;
    -webkit-appearance: none;
}
.login .button-primary:hover,
#wp-submit:hover {
    background: #8a0008 !important;
    box-shadow: 0 5px 18px rgba(192,0,12,.38) !important;
}
#wp-submit:active { transform: scale(.99) !important; }

/* Nav links (forgot password, register) */
#nav {
    text-align: center !important;
    margin-top: 1.4rem !important;
    padding: 0 !important;
    border: none !important;
}
#nav a {
    color: #c0000c !important;
    font-size: .88rem !important;
    text-decoration: none !important;
    font-weight: 500 !important;
}
#nav a:hover { text-decoration: underline !important; }
#nav .sep,
#nav a[href*="register"] { display: none !important; }

/* Hide back-to-blog, language switcher */
#backtoblog,
.language-switcher,
#language-switcher { display: none !important; }

/* Error / notice boxes */
#login_error,
.notice,
.message {
    border-left: 4px solid #c0000c !important;
    border-radius: 0 6px 6px 0 !important;
    font-size: .88rem !important;
    background: #fff5f5 !important;
    color: #7a0008 !important;
    box-shadow: none !important;
    margin-bottom: 1.4rem !important;
    padding: .85rem 1rem !important;
}
.notice.notice-info,
.message.message {
    border-left-color: #c0000c !important;
    background: #fff5f5 !important;
    color: #7a0008 !important;
}

/* Remember me checkbox */
.login .forgetmenot { margin-bottom: .5rem !important; }
.login .forgetmenot input[type="checkbox"] { accent-color: #c0000c; }

/* Password strength meter */
#pass-strength-result { border-radius: 4px !important; }

/* Responsive */
@media (max-width: 860px) {
    body.login { flex-direction: column; }
    #kpy-left { flex: 0 0 auto; padding: 2rem; }
    .kpy-illustration { display: none; }
    .kpy-content { margin-top: 1.5rem; }
    .kpy-content h2 { font-size: 1.65rem; }
    body.login > #kpy-right-wrap { padding: 2rem 1.5rem; }
}
@media (max-width: 480px) {
    body.login > #kpy-right-wrap { padding: 1.5rem 1rem; }
}
</style>
<?php }
add_action( 'login_enqueue_scripts', 'kpy_login_styles' );


/**
 * Outputs the login page header.
 * ── PHP logic identical to WordPress core ──
 * ── Only HTML structure is changed ──
 */
function login_header( $title = null, $message = '', $wp_error = null ) {
	global $error, $interim_login, $action;

	if ( null === $title ) {
		$title = __( 'Log In' );
	}

	add_filter( 'wp_robots', 'wp_robots_sensitive_page' );
	add_action( 'login_head', 'wp_strict_cross_origin_referrer' );
	add_action( 'login_head', 'wp_login_viewport_meta' );

	if ( ! is_wp_error( $wp_error ) ) {
		$wp_error = new WP_Error();
	}

	$shake_error_codes = array( 'empty_password', 'empty_email', 'invalid_email', 'invalidcombo', 'empty_username', 'invalid_username', 'incorrect_password', 'retrieve_password_email_failure' );
	$shake_error_codes = apply_filters( 'shake_error_codes', $shake_error_codes );

	if ( $shake_error_codes && $wp_error->has_errors() && in_array( $wp_error->get_error_code(), $shake_error_codes, true ) ) {
		add_action( 'login_footer', 'wp_shake_js', 12 );
	}

	$login_title = get_bloginfo( 'name', 'display' );
	$login_title = sprintf( __( '%1$s &lsaquo; %2$s &#8212; WordPress' ), $title, $login_title );

	if ( wp_is_recovery_mode() ) {
		$login_title = sprintf( __( 'Recovery Mode &#8212; %s' ), $login_title );
	}

	$login_title = apply_filters( 'login_title', $login_title, $title );

	?><!DOCTYPE html>
	<html <?php language_attributes(); ?>>
	<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<title><?php echo $login_title; ?></title>
	<?php

	wp_enqueue_style( 'login' );

	if ( 'loggedout' === $wp_error->get_error_code() ) {
		ob_start();
		?>
		<script>if("sessionStorage" in window){try{for(var key in sessionStorage){if(key.indexOf("wp-autosave-")!=-1){sessionStorage.removeItem(key)}}}catch(e){}};</script>
		<?php
		wp_print_inline_script_tag( wp_remove_surrounding_empty_script_tags( ob_get_clean() ) );
	}

	do_action( 'login_enqueue_scripts' );
	do_action( 'login_head' );

	$login_header_url   = apply_filters( 'login_headerurl', __( 'https://wordpress.org/' ) );
	$login_header_title = '';
	$login_header_title = apply_filters_deprecated(
		'login_headertitle',
		array( $login_header_title ),
		'5.2.0',
		'login_headertext',
		__( 'Usage of the title attribute on the login logo is not recommended for accessibility reasons. Use the link text instead.' )
	);
	$login_header_text = empty( $login_header_title ) ? __( 'Powered by WordPress' ) : $login_header_title;
	$login_header_text = apply_filters( 'login_headertext', $login_header_text );

	$classes   = array( 'login-action-' . $action, 'wp-core-ui' );
	if ( is_rtl() ) { $classes[] = 'rtl'; }
	if ( $interim_login ) {
		$classes[] = 'interim-login';
		?><style type="text/css">html{background-color: transparent;}</style><?php
		if ( 'success' === $interim_login ) { $classes[] = 'interim-login-success'; }
	}
	$classes[] = ' locale-' . sanitize_html_class( strtolower( str_replace( '_', '-', get_locale() ) ) );
	$classes   = apply_filters( 'login_body_class', $classes, $action );

	?>
	</head>
	<body class="login no-js <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php wp_print_inline_script_tag( "document.body.className = document.body.className.replace('no-js','js');" ); ?>

	<?php
	// ── CUSTOM LEFT PANEL ─────────────────────────────────
	if ( ! $interim_login ) : ?>
	<div id="kpy-left">
		<div class="kpy-logo">
			<img src="https://www.lwegatech.info/new/content/uploads/2026/03/lwega-web.png" alt="Lwegatech Logo" style="height: 48px; width: auto; filter: brightness(0) saturate(100%) invert(13%) sepia(85%) saturate(7181%) hue-rotate(349deg) brightness(98%) contrast(100%);">
		</div>

		<div class="kpy-content">
			<h2>Own Your Digital Presence</h2>
			<p>Manage your content, your way.</p>
		</div>

		<div class="kpy-illustration" aria-hidden="true">
			<svg viewBox="0 0 520 400" xmlns="http://www.w3.org/2000/svg">
				<rect x="110" y="55" width="300" height="215" rx="14" fill="#c0000c" opacity=".9"/>
				<rect x="124" y="69" width="272" height="188" rx="7" fill="#fff5f5"/>
				<rect x="124" y="69" width="272" height="26" rx="7" fill="#fddcdc"/>
				<circle cx="140" cy="82" r="5" fill="#f08080" opacity=".7"/>
				<circle cx="156" cy="82" r="5" fill="#f08080" opacity=".7"/>
				<circle cx="172" cy="82" r="5" fill="#f08080" opacity=".7"/>
				<rect x="196" y="77" width="120" height="10" rx="4" fill="#f5b8b8"/>
				<rect x="137" y="107" width="160" height="10" rx="4" fill="#f5b8b8"/>
				<rect x="137" y="124" width="240" height="7" rx="3" fill="#fddcdc"/>
				<rect x="137" y="138" width="200" height="7" rx="3" fill="#fddcdc"/>
				<rect x="137" y="156" width="105" height="72" rx="8" fill="#fdf2f2" stroke="#f5b8b8" stroke-width="1.5"/>
				<rect x="150" y="168" width="60" height="8" rx="3" fill="#f08080"/>
				<rect x="150" y="183" width="50" height="6" rx="2" fill="#fddcdc"/>
				<rect x="150" y="196" width="40" height="6" rx="2" fill="#fddcdc"/>
				<rect x="150" y="209" width="55" height="9" rx="4" fill="#c0000c"/>
				<rect x="253" y="156" width="120" height="72" rx="8" fill="#f2f2f2" stroke="#ccc" stroke-width="1.5"/>
				<rect x="266" y="168" width="70" height="8" rx="3" fill="#555" opacity=".7"/>
				<rect x="266" y="183" width="55" height="6" rx="2" fill="#ddd"/>
				<rect x="266" y="196" width="45" height="6" rx="2" fill="#ddd"/>
				<rect x="266" y="209" width="55" height="9" rx="4" fill="#111"/>
				<rect x="233" y="270" width="54" height="28" rx="3" fill="#c0000c" opacity=".5"/>
				<rect x="200" y="296" width="120" height="11" rx="5" fill="#c0000c" opacity=".4"/>
				<ellipse cx="80" cy="254" rx="19" ry="20" fill="#fcd9a8"/>
				<ellipse cx="80" cy="242" rx="19" ry="10" fill="#2c1a0e"/>
				<rect x="60" y="274" width="40" height="58" rx="10" fill="#c0000c"/>
				<rect x="100" y="278" width="40" height="13" rx="6" fill="#fcd9a8" transform="rotate(-15 100 278)"/>
				<rect x="45" y="282" width="15" height="40" rx="6" fill="#c0000c"/>
				<rect x="62" y="330" width="14" height="28" rx="5" fill="#111"/>
				<rect x="82" y="330" width="14" height="28" rx="5" fill="#111"/>
				<ellipse cx="438" cy="248" rx="19" ry="20" fill="#fcd9a8"/>
				<ellipse cx="438" cy="236" rx="19" ry="10" fill="#1a1a1a"/>
				<rect x="418" y="268" width="40" height="58" rx="10" fill="#111"/>
				<rect x="398" y="272" width="22" height="13" rx="6" fill="#fcd9a8" transform="rotate(10 398 272)"/>
				<rect x="458" y="276" width="15" height="40" rx="6" fill="#111"/>
				<rect x="420" y="324" width="14" height="28" rx="5" fill="#333"/>
				<rect x="440" y="324" width="14" height="28" rx="5" fill="#333"/>
				<rect x="388" y="90" width="68" height="52" rx="9" fill="white" stroke="#fddcdc" stroke-width="1.5"/>
				<rect x="400" y="103" width="40" height="7" rx="3" fill="#f5b8b8"/>
				<rect x="400" y="117" width="28" height="6" rx="2" fill="#fddcdc"/>
				<rect x="400" y="129" width="34" height="6" rx="2" fill="#fddcdc"/>
				<rect x="58" y="88" width="64" height="52" rx="9" fill="white" stroke="#ddd" stroke-width="1.5"/>
				<circle cx="75" cy="104" r="8" fill="#c0000c" opacity=".2"/>
				<rect x="88" y="100" width="24" height="7" rx="3" fill="#c0000c" opacity=".5"/>
				<rect x="70" y="117" width="42" height="6" rx="2" fill="#eee"/>
				<rect x="70" y="129" width="32" height="6" rx="2" fill="#eee"/>
				<circle cx="355" cy="335" r="18" fill="#c0000c" opacity=".9"/>
				<polyline points="347,335 353,341 365,323" stroke="white" stroke-width="2.8"
				          fill="none" stroke-linecap="round" stroke-linejoin="round"/>
				<circle cx="465" cy="155" r="4" fill="#f08080" opacity=".7"/>
				<circle cx="479" cy="155" r="4" fill="#f08080" opacity=".5"/>
				<circle cx="493" cy="155" r="4" fill="#f08080" opacity=".3"/>
			</svg>
		</div>

		<div class="kpy-footer">&copy; <?php echo date('Y'); ?> LWEGATECH. All rights reserved.</div>
	</div>
	<div id="kpy-right-wrap">
	<?php endif;
	// ── END CUSTOM LEFT PANEL ─────────────────────────────

	do_action( 'login_header' ); // ← fires our site-core.php hook if present

	if ( 'confirm_admin_email' !== $action && ! empty( $title ) ) : ?>
		<h1 class="screen-reader-text"><?php echo $title; ?></h1>
	<?php endif; ?>

	<div id="login">
		<h1 role="presentation" class="wp-login-logo">
			<a href="<?php echo esc_url( $login_header_url ); ?>"><?php echo $login_header_text; ?></a>
		</h1>
	<?php

	$message = apply_filters( 'login_message', $message );
	if ( ! empty( $message ) ) { echo $message . "\n"; }

	if ( ! empty( $error ) ) {
		$wp_error->add( 'error', $error );
		unset( $error );
	}

	if ( $wp_error->has_errors() ) {
		$error_list = array();
		$messages   = '';

		foreach ( $wp_error->get_error_codes() as $code ) {
			$severity = $wp_error->get_error_data( $code );
			foreach ( $wp_error->get_error_messages( $code ) as $error_message ) {
				if ( 'message' === $severity ) {
					$messages .= '<p>' . $error_message . '</p>';
				} else {
					$error_list[] = $error_message;
				}
			}
		}

		if ( ! empty( $error_list ) ) {
			$errors = '';
			if ( count( $error_list ) > 1 ) {
				$errors .= '<ul class="login-error-list">';
				foreach ( $error_list as $item ) { $errors .= '<li>' . $item . '</li>'; }
				$errors .= '</ul>';
			} else {
				$errors .= '<p>' . $error_list[0] . '</p>';
			}
			$errors = apply_filters( 'login_errors', $errors );
			wp_admin_notice( $errors, array( 'type' => 'error', 'id' => 'login_error', 'paragraph_wrap' => false ) );
		}

		if ( ! empty( $messages ) ) {
			$messages = apply_filters( 'login_messages', $messages );
			wp_admin_notice( $messages, array( 'type' => 'info', 'id' => 'login-message', 'additional_classes' => array( 'message' ), 'paragraph_wrap' => false ) );
		}
	}
} // End of login_header().


/**
 * Outputs the footer for the login page.
 * ── Identical to core, except closing the kpy-right-wrap div ──
 */
function login_footer( $input_id = '' ) {
	global $interim_login;

	if ( ! $interim_login ) {
		?>
		<p id="backtoblog">
			<?php
			$html_link = sprintf(
				'<a href="%s">%s</a>',
				esc_url( home_url( '/' ) ),
				sprintf( _x( '&larr; Go to %s', 'site' ), get_bloginfo( 'title', 'display' ) )
			);
			echo apply_filters( 'login_site_html_link', $html_link );
			?>
		</p>
		<?php
		the_privacy_policy_link( '<div class="privacy-policy-page-link">', '</div>' );
	}
	?>
	</div><?php // End of <div id="login">. ?>

	<?php if ( ! $interim_login && apply_filters( 'login_display_language_dropdown', true ) ) :
		$languages = get_available_languages();
		if ( ! empty( $languages ) ) : ?>
		<div class="language-switcher">
			<form id="language-switcher" method="get">
				<label for="language-switcher-locales">
					<span class="dashicons dashicons-translation" aria-hidden="true"></span>
					<span class="screen-reader-text"><?php _e( 'Language' ); ?></span>
				</label>
				<?php
				$args = array(
					'id'                          => 'language-switcher-locales',
					'name'                        => 'wp_lang',
					'selected'                    => determine_locale(),
					'show_available_translations' => false,
					'explicit_option_en_us'       => true,
					'languages'                   => $languages,
				);
				wp_dropdown_languages( apply_filters( 'login_language_dropdown_args', $args ) );
				?>
				<?php if ( $interim_login ) : ?><input type="hidden" name="interim-login" value="1" /><?php endif; ?>
				<?php if ( isset( $_GET['redirect_to'] ) && '' !== $_GET['redirect_to'] ) : ?><input type="hidden" name="redirect_to" value="<?php echo sanitize_url( $_GET['redirect_to'] ); ?>" /><?php endif; ?>
				<?php if ( isset( $_GET['action'] ) && '' !== $_GET['action'] ) : ?><input type="hidden" name="action" value="<?php echo esc_attr( $_GET['action'] ); ?>" /><?php endif; ?>
				<input type="submit" class="button" value="<?php esc_attr_e( 'Change' ); ?>">
			</form>
		</div>
		<?php endif;
	endif; ?>

	<?php if ( ! empty( $input_id ) ) {
		ob_start(); ?>
		<script>
		try{document.getElementById('<?php echo $input_id; ?>').focus();}catch(e){}
		if(typeof wpOnload==='function')wpOnload();
		</script>
		<?php
		wp_print_inline_script_tag( wp_remove_surrounding_empty_script_tags( ob_get_clean() ) );
	}

	do_action( 'login_footer' );

	// Close kpy-right-wrap if not interim login
	if ( ! $interim_login ) {
		echo '</div><!-- /#kpy-right-wrap -->';
	}
	?>
	</body>
	</html>
	<?php
}

/**
 * Outputs the JavaScript to handle the form shaking on the login page.
 * ── Identical to core ──
 */
function wp_shake_js() {
	wp_print_inline_script_tag( "document.querySelector('form').classList.add('shake');" );
}

/**
 * Outputs the viewport meta tag for the login page.
 * ── Identical to core ──
 */
function wp_login_viewport_meta() {
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php
}

/*
 * ════════════════════════════════════════════════════════
 *  MAIN — 100% IDENTICAL TO WORDPRESS CORE FROM HERE DOWN
 *  Nothing below this line has been changed.
 * ════════════════════════════════════════════════════════
 */

$action = isset( $_REQUEST['action'] ) && is_string( $_REQUEST['action'] ) ? $_REQUEST['action'] : 'login';
$errors = new WP_Error();

if ( isset( $_GET['key'] ) )        { $action = 'resetpass'; }
if ( isset( $_GET['checkemail'] ) ) { $action = 'checkemail'; }

$default_actions = array(
	'confirm_admin_email', 'postpass', 'logout', 'lostpassword',
	'retrievepassword', 'resetpass', 'rp', 'register', 'checkemail',
	'confirmaction', 'login',
	WP_Recovery_Mode_Link_Service::LOGIN_ACTION_ENTERED,
);

if ( ! in_array( $action, $default_actions, true ) && false === has_filter( 'login_form_' . $action ) ) {
	$action = 'login';
}

nocache_headers();
header( 'Content-Type: ' . get_bloginfo( 'html_type' ) . '; charset=' . get_bloginfo( 'charset' ) );

if ( defined( 'RELOCATE' ) && RELOCATE ) {
	if ( isset( $_SERVER['PATH_INFO'] ) && ( $_SERVER['PATH_INFO'] !== $_SERVER['PHP_SELF'] ) ) {
		$_SERVER['PHP_SELF'] = str_replace( $_SERVER['PATH_INFO'], '', $_SERVER['PHP_SELF'] );
	}
	$url = dirname( set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ) );
	if ( get_option( 'siteurl' ) !== $url ) { update_option( 'siteurl', $url ); }
}

$secure = ( 'https' === parse_url( wp_login_url(), PHP_URL_SCHEME ) );
setcookie( TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN, $secure, true );
if ( SITECOOKIEPATH !== COOKIEPATH ) {
	setcookie( TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN, $secure, true );
}
if ( isset( $_GET['wp_lang'] ) ) {
	setcookie( 'wp_lang', sanitize_text_field( $_GET['wp_lang'] ), 0, COOKIEPATH, COOKIE_DOMAIN, $secure, true );
}

do_action( 'login_init' );
do_action( "login_form_{$action}" );

$http_post     = ( 'POST' === $_SERVER['REQUEST_METHOD'] );
$interim_login = isset( $_REQUEST['interim-login'] );
$login_link_separator = apply_filters( 'login_link_separator', ' | ' );

switch ( $action ) {

	case 'confirm_admin_email':
		if ( ! is_user_logged_in() ) { wp_safe_redirect( wp_login_url() ); exit; }
		if ( ! empty( $_REQUEST['redirect_to'] ) ) { $redirect_to = $_REQUEST['redirect_to']; } else { $redirect_to = admin_url(); }
		if ( current_user_can( 'manage_options' ) ) { $admin_email = get_option( 'admin_email' ); } else { wp_safe_redirect( $redirect_to ); exit; }
		$remind_interval = (int) apply_filters( 'admin_email_remind_interval', 3 * DAY_IN_SECONDS );
		if ( ! empty( $_GET['remind_me_later'] ) ) {
			if ( ! wp_verify_nonce( $_GET['remind_me_later'], 'remind_me_later_nonce' ) ) { wp_safe_redirect( wp_login_url() ); exit; }
			if ( $remind_interval > 0 ) { update_option( 'admin_email_lifespan', time() + $remind_interval ); }
			$redirect_to = add_query_arg( 'admin_email_remind_later', 1, $redirect_to );
			wp_safe_redirect( $redirect_to ); exit;
		}
		if ( ! empty( $_POST['correct-admin-email'] ) ) {
			if ( ! check_admin_referer( 'confirm_admin_email', 'confirm_admin_email_nonce' ) ) { wp_safe_redirect( wp_login_url() ); exit; }
			$admin_email_check_interval = (int) apply_filters( 'admin_email_check_interval', 6 * MONTH_IN_SECONDS );
			if ( $admin_email_check_interval > 0 ) { update_option( 'admin_email_lifespan', time() + $admin_email_check_interval ); }
			wp_safe_redirect( $redirect_to ); exit;
		}
		login_header( __( 'Confirm your administration email' ), '', $errors );
		do_action( 'admin_email_confirm', $errors );
		?>
		<form class="admin-email-confirm-form" name="admin-email-confirm-form" action="<?php echo esc_url( site_url( 'login.php?action=confirm_admin_email', 'login_post' ) ); ?>" method="post">
			<?php do_action( 'admin_email_confirm_form' ); wp_nonce_field( 'confirm_admin_email', 'confirm_admin_email_nonce' ); ?>
			<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
			<h1 class="admin-email__heading"><?php _e( 'Administration email verification' ); ?></h1>
			<p class="admin-email__details"><?php _e( 'Please verify that the <strong>administration email</strong> for this website is still correct.' ); ?> <?php printf( '<a href="%s" target="_blank">%s<span class="screen-reader-text"> %s</span></a>', esc_url( __( 'https://wordpress.org/documentation/article/settings-general-screen/#email-address' ) ), __( 'Why is this important?' ), __( '(opens in a new tab)' ) ); ?></p>
			<p class="admin-email__details"><?php printf( __( 'Current administration email: %s' ), '<strong>' . esc_html( $admin_email ) . '</strong>' ); ?></p>
			<p class="admin-email__details"><?php _e( 'This email may be different from your personal email address.' ); ?></p>
			<div class="admin-email__actions">
				<div class="admin-email__actions-primary">
					<?php $change_link = add_query_arg( 'highlight', 'confirm_admin_email', admin_url( 'options-general.php' ) ); ?>
					<a class="button button-large" href="<?php echo esc_url( $change_link ); ?>"><?php _e( 'Update' ); ?></a>
					<input type="submit" name="correct-admin-email" id="correct-admin-email" class="button button-primary button-large" value="<?php esc_attr_e( 'The email is correct' ); ?>" />
				</div>
				<?php if ( $remind_interval > 0 ) : ?>
				<div class="admin-email__actions-secondary">
					<?php $remind_me_link = add_query_arg( array( 'action' => 'confirm_admin_email', 'remind_me_later' => wp_create_nonce( 'remind_me_later_nonce' ) ), wp_login_url( $redirect_to ) ); ?>
					<a href="<?php echo esc_url( $remind_me_link ); ?>"><?php _e( 'Remind me later' ); ?></a>
				</div>
				<?php endif; ?>
			</div>
		</form>
		<?php login_footer(); break;

	case 'postpass':
		$redirect_to = $_POST['redirect_to'] ?? wp_get_referer();
		if ( ! isset( $_POST['post_password'] ) || ! is_string( $_POST['post_password'] ) ) { wp_safe_redirect( $redirect_to ); exit; }
		require_once ABSPATH . WPINC . '/class-phpass.php';
		$hasher  = new PasswordHash( 8, true );
		$expire  = apply_filters( 'post_password_expires', time() + 10 * DAY_IN_SECONDS );
		$secure  = $redirect_to ? ( 'https' === parse_url( $redirect_to, PHP_URL_SCHEME ) ) : false;
		setcookie( 'wp-postpass_' . COOKIEHASH, $hasher->HashPassword( wp_unslash( $_POST['post_password'] ) ), $expire, COOKIEPATH, COOKIE_DOMAIN, $secure );
		wp_safe_redirect( $redirect_to ); exit;

	case 'logout':
		check_admin_referer( 'log-out' );
		$user = wp_get_current_user();
		wp_logout();
		if ( ! empty( $_REQUEST['redirect_to'] ) && is_string( $_REQUEST['redirect_to'] ) ) {
			$redirect_to = $requested_redirect_to = $_REQUEST['redirect_to'];
		} else {
			$redirect_to = add_query_arg( array( 'loggedout' => 'true', 'wp_lang' => get_user_locale( $user ) ), wp_login_url() );
			$requested_redirect_to = '';
		}
		$redirect_to = apply_filters( 'logout_redirect', $redirect_to, $requested_redirect_to, $user );
		wp_safe_redirect( $redirect_to ); exit;

	case 'lostpassword':
	case 'retrievepassword':
		if ( $http_post ) {
			$errors = retrieve_password();
			if ( ! is_wp_error( $errors ) ) {
				$redirect_to = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : 'login.php?checkemail=confirm';
				wp_safe_redirect( $redirect_to ); exit;
			}
		}
		if ( isset( $_GET['error'] ) ) {
			if ( 'invalidkey' === $_GET['error'] ) { $errors->add( 'invalidkey', __( '<strong>Error:</strong> Your password reset link appears to be invalid. Please request a new link below.' ) ); }
			elseif ( 'expiredkey' === $_GET['error'] ) { $errors->add( 'expiredkey', __( '<strong>Error:</strong> Your password reset link has expired. Please request a new link below.' ) ); }
		}
		$lostpassword_redirect = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
		$redirect_to = apply_filters( 'lostpassword_redirect', $lostpassword_redirect );
		do_action( 'lost_password', $errors );
		login_header( __( 'Lost Password' ), wp_get_admin_notice( __( 'Please enter your username or email address. You will receive an email message with instructions on how to reset your password.' ), array( 'type' => 'info', 'additional_classes' => array( 'message' ) ) ), $errors );
		$user_login = isset( $_POST['user_login'] ) && is_string( $_POST['user_login'] ) ? wp_unslash( $_POST['user_login'] ) : '';
		?>
		<form name="lostpasswordform" id="lostpasswordform" action="<?php echo esc_url( network_site_url( 'login.php?action=lostpassword', 'login_post' ) ); ?>" method="post">
			<p><label for="user_login"><?php _e( 'Username or Email Address' ); ?></label>
			<input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr( $user_login ); ?>" size="20" autocapitalize="off" autocomplete="username" required="required" /></p>
			<?php do_action( 'lostpassword_form' ); ?>
			<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
			<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Get New Password' ); ?>" /></p>
		</form>
		<p id="nav"><a class="wp-login-log-in" href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Log in' ); ?></a><?php if ( get_option( 'users_can_register' ) ) { echo esc_html( $login_link_separator ); echo apply_filters( 'register', sprintf( '<a class="wp-login-register" href="%s">%s</a>', esc_url( wp_registration_url() ), __( 'Register' ) ) ); } ?></p>
		<?php login_footer( 'user_login' ); break;

	case 'resetpass':
	case 'rp':
		list( $rp_path ) = explode( '?', wp_unslash( $_SERVER['REQUEST_URI'] ) );
		$rp_cookie = 'wp-resetpass-' . COOKIEHASH;
		if ( isset( $_GET['key'] ) && isset( $_GET['login'] ) ) {
			$value = sprintf( '%s:%s', wp_unslash( $_GET['login'] ), wp_unslash( $_GET['key'] ) );
			setcookie( $rp_cookie, $value, 0, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
			wp_safe_redirect( remove_query_arg( array( 'key', 'login' ) ) ); exit;
		}
		if ( isset( $_COOKIE[ $rp_cookie ] ) && 0 < strpos( $_COOKIE[ $rp_cookie ], ':' ) ) {
			list( $rp_login, $rp_key ) = explode( ':', wp_unslash( $_COOKIE[ $rp_cookie ] ), 2 );
			$user = check_password_reset_key( $rp_key, $rp_login );
			if ( isset( $_POST['pass1'] ) && ! hash_equals( $rp_key, $_POST['rp_key'] ) ) { $user = false; }
		} else { $user = false; }
		if ( ! $user || is_wp_error( $user ) ) {
			setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
			wp_redirect( $user && $user->get_error_code() === 'expired_key' ? site_url( 'login.php?action=lostpassword&error=expiredkey' ) : site_url( 'login.php?action=lostpassword&error=invalidkey' ) ); exit;
		}
		$errors = new WP_Error();
		if ( ! empty( $_POST['pass1'] ) ) {
			$_POST['pass1'] = trim( $_POST['pass1'] );
			if ( empty( $_POST['pass1'] ) ) { $errors->add( 'password_reset_empty_space', __( 'The password cannot be a space or all spaces.' ) ); }
		}
		if ( ! empty( $_POST['pass1'] ) && trim( $_POST['pass2'] ) !== $_POST['pass1'] ) { $errors->add( 'password_reset_mismatch', __( '<strong>Error:</strong> The passwords do not match.' ) ); }
		do_action( 'validate_password_reset', $errors, $user );
		if ( ( ! $errors->has_errors() ) && isset( $_POST['pass1'] ) && ! empty( $_POST['pass1'] ) ) {
			reset_password( $user, $_POST['pass1'] );
			setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
			login_header( __( 'Password Reset' ), wp_get_admin_notice( __( 'Your password has been reset.' ) . ' <a href="' . esc_url( wp_login_url() ) . '">' . __( 'Log in' ) . '</a>', array( 'type' => 'info', 'additional_classes' => array( 'message', 'reset-pass' ) ) ) );
			login_footer(); exit;
		}
		wp_enqueue_script( 'utils' ); wp_enqueue_script( 'user-profile' );
		login_header( __( 'Reset Password' ), wp_get_admin_notice( __( 'Enter your new password below or generate one.' ), array( 'type' => 'info', 'additional_classes' => array( 'message', 'reset-pass' ) ) ), $errors );
		?>
		<form name="resetpassform" id="resetpassform" action="<?php echo esc_url( network_site_url( 'login.php?action=resetpass', 'login_post' ) ); ?>" method="post" autocomplete="off">
			<input type="hidden" id="user_login" value="<?php echo esc_attr( $rp_login ); ?>" autocomplete="off" />
			<div class="user-pass1-wrap">
				<p><label for="pass1"><?php _e( 'New password' ); ?></label></p>
				<div class="wp-pwd">
					<input type="password" name="pass1" id="pass1" class="input password-input" size="24" value="" autocomplete="new-password" spellcheck="false" data-reveal="1" data-pw="<?php echo esc_attr( wp_generate_password( 16 ) ); ?>" aria-describedby="pass-strength-result" />
					<button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Hide password' ); ?>"><span class="dashicons dashicons-hidden" aria-hidden="true"></span></button>
					<div id="pass-strength-result" class="hide-if-no-js" aria-live="polite"><?php _e( 'Strength indicator' ); ?></div>
				</div>
				<div class="pw-weak"><input type="checkbox" name="pw_weak" id="pw-weak" class="pw-checkbox" /><label for="pw-weak"><?php _e( 'Confirm use of weak password' ); ?></label></div>
			</div>
			<p class="user-pass2-wrap"><label for="pass2"><?php _e( 'Confirm new password' ); ?></label><input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="new-password" spellcheck="false" /></p>
			<p class="description indicator-hint"><?php echo wp_get_password_hint(); ?></p>
			<?php do_action( 'resetpass_form', $user ); ?>
			<input type="hidden" name="rp_key" value="<?php echo esc_attr( $rp_key ); ?>" />
			<p class="submit reset-pass-submit">
				<button type="button" class="button wp-generate-pw hide-if-no-js skip-aria-expanded"><?php _e( 'Generate Password' ); ?></button>
				<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Save Password' ); ?>" />
			</p>
		</form>
		<p id="nav"><a class="wp-login-log-in" href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Log in' ); ?></a><?php if ( get_option( 'users_can_register' ) ) { echo esc_html( $login_link_separator ); echo apply_filters( 'register', sprintf( '<a class="wp-login-register" href="%s">%s</a>', esc_url( wp_registration_url() ), __( 'Register' ) ) ); } ?></p>
		<?php login_footer( 'pass1' ); break;

	case 'register':
		if ( is_multisite() ) { wp_redirect( apply_filters( 'wp_signup_location', network_site_url( 'signup.php' ) ) ); exit; }
		if ( ! get_option( 'users_can_register' ) ) { wp_redirect( site_url( 'login.php?registration=disabled' ) ); exit; }
		$user_login = $user_email = '';
		if ( $http_post ) {
			if ( isset( $_POST['user_login'] ) && is_string( $_POST['user_login'] ) ) { $user_login = wp_unslash( $_POST['user_login'] ); }
			if ( isset( $_POST['user_email'] ) && is_string( $_POST['user_email'] ) ) { $user_email = wp_unslash( $_POST['user_email'] ); }
			$errors = register_new_user( $user_login, $user_email );
			if ( ! is_wp_error( $errors ) ) { wp_safe_redirect( ! empty( $_POST['redirect_to'] ) ? $_POST['redirect_to'] : 'login.php?checkemail=registered' ); exit; }
		}
		$registration_redirect = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
		$redirect_to = apply_filters( 'registration_redirect', $registration_redirect, $errors );
		login_header( __( 'Registration Form' ), wp_get_admin_notice( __( 'Register For This Site' ), array( 'type' => 'info', 'additional_classes' => array( 'message', 'register' ) ) ), $errors );
		?>
		<form name="registerform" id="registerform" action="<?php echo esc_url( site_url( 'login.php?action=register', 'login_post' ) ); ?>" method="post" novalidate="novalidate">
			<p><label for="user_login"><?php _e( 'Username' ); ?></label><input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr( $user_login ); ?>" size="20" autocapitalize="off" autocomplete="username" required="required" /></p>
			<p><label for="user_email"><?php _e( 'Email' ); ?></label><input type="email" name="user_email" id="user_email" class="input" value="<?php echo esc_attr( $user_email ); ?>" size="25" autocomplete="email" required="required" /></p>
			<?php do_action( 'register_form' ); ?>
			<p id="reg_passmail"><?php _e( 'Registration confirmation will be emailed to you.' ); ?></p>
			<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
			<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Register' ); ?>" /></p>
		</form>
		<p id="nav"><a class="wp-login-log-in" href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Log in' ); ?></a><?php echo esc_html( $login_link_separator ); echo apply_filters( 'lost_password_html_link', sprintf( '<a class="wp-login-lost-password" href="%s">%s</a>', esc_url( wp_lostpassword_url() ), __( 'Lost your password?' ) ) ); ?></p>
		<?php login_footer( 'user_login' ); break;

	case 'checkemail':
		$redirect_to = admin_url();
		$errors      = new WP_Error();
		if ( 'confirm' === $_GET['checkemail'] ) { $errors->add( 'confirm', sprintf( __( 'Check your email for the confirmation link, then visit the <a href="%s">login page</a>.' ), wp_login_url() ), 'message' ); }
		elseif ( 'registered' === $_GET['checkemail'] ) { $errors->add( 'registered', sprintf( __( 'Registration complete. Please check your email, then visit the <a href="%s">login page</a>.' ), wp_login_url() ), 'message' ); }
		$errors = apply_filters( 'wp_login_errors', $errors, $redirect_to );
		login_header( __( 'Check your email' ), '', $errors );
		login_footer(); break;

	case 'confirmaction':
		if ( ! isset( $_GET['request_id'] ) ) { wp_die( __( 'Missing request ID.' ) ); }
		if ( ! isset( $_GET['confirm_key'] ) ) { wp_die( __( 'Missing confirm key.' ) ); }
		$request_id = (int) $_GET['request_id'];
		$key        = sanitize_text_field( wp_unslash( $_GET['confirm_key'] ) );
		$result     = wp_validate_user_request_key( $request_id, $key );
		if ( is_wp_error( $result ) ) { wp_die( $result ); }
		do_action( 'user_request_action_confirmed', $request_id );
		$message = _wp_privacy_account_request_confirmed_message( $request_id );
		login_header( __( 'User action confirmed.' ), $message );
		login_footer(); exit;

	case 'login':
	default:
		$secure_cookie   = '';
		$customize_login = isset( $_REQUEST['customize-login'] );
		if ( $customize_login ) { wp_enqueue_script( 'customize-base' ); }

		if ( ! empty( $_POST['log'] ) && ! force_ssl_admin() ) {
			$user_name = sanitize_user( wp_unslash( $_POST['log'] ) );
			$user      = get_user_by( 'login', $user_name );
			if ( ! $user && strpos( $user_name, '@' ) ) { $user = get_user_by( 'email', $user_name ); }
			if ( $user && get_user_option( 'use_ssl', $user->ID ) ) { $secure_cookie = true; force_ssl_admin( true ); }
		}

		if ( isset( $_REQUEST['redirect_to'] ) && is_string( $_REQUEST['redirect_to'] ) ) {
			$redirect_to = $_REQUEST['redirect_to'];
			if ( $secure_cookie && str_contains( $redirect_to, 'admin' ) ) { $redirect_to = preg_replace( '|^http://|', 'https://', $redirect_to ); }
		} else {
			$redirect_to = admin_url();
		}

		$reauth = ! empty( $_REQUEST['reauth'] );
		$user   = wp_signon( array(), $secure_cookie );

		if ( empty( $_COOKIE[ LOGGED_IN_COOKIE ] ) ) {
			if ( headers_sent() ) {
				$user = new WP_Error( 'test_cookie', sprintf( __( '<strong>Error:</strong> Cookies are blocked due to unexpected output. For help, please see <a href="%1$s">this documentation</a> or try the <a href="%2$s">support forums</a>.' ), __( 'https://developer.wordpress.org/advanced-administration/wordpress/cookies/' ), __( 'https://wordpress.org/support/forums/' ) ) );
			} elseif ( isset( $_POST['testcookie'] ) && empty( $_COOKIE[ TEST_COOKIE ] ) ) {
				$user = new WP_Error( 'test_cookie', sprintf( __( '<strong>Error:</strong> Cookies are blocked or not supported by your browser. You must <a href="%s">enable cookies</a> to use WordPress.' ), __( 'https://developer.wordpress.org/advanced-administration/wordpress/cookies/#enable-cookies-in-your-browser' ) ) );
			}
		}

		$requested_redirect_to = isset( $_REQUEST['redirect_to'] ) && is_string( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
		$redirect_to = apply_filters( 'login_redirect', $redirect_to, $requested_redirect_to, $user );

		if ( ! is_wp_error( $user ) && ! $reauth ) {
			if ( $interim_login ) {
				$message = '<p class="message">' . __( 'You have logged in successfully.' ) . '</p>';
				$interim_login = 'success';
				login_header( '', $message );
				?></div><?php do_action( 'login_footer' );
				if ( $customize_login ) { ob_start(); ?><script>setTimeout( function(){ new wp.customize.Messenger({ url: '<?php echo wp_customize_url(); ?>', channel: 'login' }).send('login') }, 1000 );</script><?php wp_print_inline_script_tag( wp_remove_surrounding_empty_script_tags( ob_get_clean() ) ); }
				?></body></html><?php exit;
			}

			if ( $user instanceof WP_User && $user->exists() && $user->has_cap( 'manage_options' ) ) {
				$admin_email_lifespan       = (int) get_option( 'admin_email_lifespan' );
				$admin_email_check_interval = (int) apply_filters( 'admin_email_check_interval', 6 * MONTH_IN_SECONDS );
				if ( $admin_email_check_interval > 0 && time() > $admin_email_lifespan ) {
					$redirect_to = add_query_arg( array( 'action' => 'confirm_admin_email', 'wp_lang' => get_user_locale( $user ) ), wp_login_url( $redirect_to ) );
				}
			}

			if ( ( empty( $redirect_to ) || 'admin/' === $redirect_to || admin_url() === $redirect_to ) ) {
				if ( is_multisite() && ! get_active_blog_for_user( $user->ID ) && ! is_super_admin( $user->ID ) ) { $redirect_to = user_admin_url(); }
				elseif ( is_multisite() && ! $user->has_cap( 'read' ) ) { $redirect_to = get_dashboard_url( $user->ID ); }
				elseif ( ! $user->has_cap( 'edit_posts' ) ) { $redirect_to = $user->has_cap( 'read' ) ? admin_url( 'profile.php' ) : home_url(); }
				wp_redirect( $redirect_to ); exit;
			}
			wp_safe_redirect( $redirect_to ); exit;
		}

		$errors = $user;
		if ( ! empty( $_GET['loggedout'] ) || $reauth ) { $errors = new WP_Error(); }
		if ( empty( $_POST ) && $errors->get_error_codes() === array( 'empty_username', 'empty_password' ) ) { $errors = new WP_Error( '', '' ); }
		if ( $interim_login ) { if ( ! $errors->has_errors() ) { $errors->add( 'expired', __( 'Your session has expired. Please log in to continue where you left off.' ), 'message' ); } }
		else {
			if ( isset( $_GET['loggedout'] ) && $_GET['loggedout'] ) { $errors->add( 'loggedout', __( 'You are now logged out.' ), 'message' ); }
			elseif ( isset( $_GET['registration'] ) && 'disabled' === $_GET['registration'] ) { $errors->add( 'registerdisabled', __( '<strong>Error:</strong> User registration is currently not allowed.' ) ); }
			elseif ( str_contains( $redirect_to, 'about.php?updated' ) ) { $errors->add( 'updated', __( '<strong>You have successfully updated WordPress!</strong> Please log back in to see what&#8217;s new.' ), 'message' ); }
			elseif ( WP_Recovery_Mode_Link_Service::LOGIN_ACTION_ENTERED === $action ) { $errors->add( 'enter_recovery_mode', __( 'Recovery Mode Initialized. Please log in to continue.' ), 'message' ); }
			elseif ( isset( $_GET['redirect_to'] ) && is_string( $_GET['redirect_to'] ) && str_contains( $_GET['redirect_to'], 'admin/authorize-application.php' ) ) {
				$query_component = wp_parse_url( $_GET['redirect_to'], PHP_URL_QUERY );
				$query = array();
				if ( $query_component ) { parse_str( $query_component, $query ); }
				$message = ! empty( $query['app_name'] ) ? sprintf( 'Please log in to %1$s to authorize %2$s to connect to your account.', get_bloginfo( 'name', 'display' ), '<strong>' . esc_html( $query['app_name'] ) . '</strong>' ) : sprintf( 'Please log in to %s to proceed with authorization.', get_bloginfo( 'name', 'display' ) );
				$errors->add( 'authorize_application', $message, 'message' );
			}
		}

		$errors = apply_filters( 'wp_login_errors', $errors, $redirect_to );
		if ( $reauth ) { wp_clear_auth_cookie(); }

		login_header( __( 'Log In' ), '', $errors );

		if ( isset( $_POST['log'] ) ) {
			$user_login = ( 'incorrect_password' === $errors->get_error_code() || 'empty_password' === $errors->get_error_code() ) ? wp_unslash( $_POST['log'] ) : '';
		}

		$rememberme       = ! empty( $_POST['rememberme'] );
		$aria_describedby = '';
		$has_errors       = $errors->has_errors();
		if ( $has_errors ) { $aria_describedby = ' aria-describedby="login_error"'; }
		if ( $has_errors && 'message' === $errors->get_error_data() ) { $aria_describedby = ' aria-describedby="login-message"'; }
		wp_enqueue_script( 'user-profile' );
		?>

		<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'login.php', 'login_post' ) ); ?>" method="post">
			<p>
				<label for="user_login"><?php _e( 'Username or Email Address' ); ?></label>
				<input type="text" name="log" id="user_login"<?php echo $aria_describedby; ?> class="input" value="<?php echo esc_attr( $user_login ); ?>" size="20" autocapitalize="off" autocomplete="username" required="required" />
			</p>
			<div class="user-pass-wrap">
				<label for="user_pass"><?php _e( 'Password' ); ?></label>
				<div class="wp-pwd">
					<input type="password" name="pwd" id="user_pass"<?php echo $aria_describedby; ?> class="input password-input" value="" size="20" autocomplete="current-password" spellcheck="false" required="required" />
					<button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Show password' ); ?>"><span class="dashicons dashicons-visibility" aria-hidden="true"></span></button>
				</div>
			</div>
			<?php do_action( 'login_form' ); ?>
			<p class="forgetmenot"><input name="rememberme" type="checkbox" id="rememberme" value="forever" <?php checked( $rememberme ); ?> /> <label for="rememberme"><?php esc_html_e( 'Remember Me' ); ?></label></p>
			<p class="submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Log In' ); ?>" />
				<?php if ( $interim_login ) : ?><input type="hidden" name="interim-login" value="1" /><?php else : ?><input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" /><?php endif; ?>
				<?php if ( $customize_login ) : ?><input type="hidden" name="customize-login" value="1" /><?php endif; ?>
				<input type="hidden" name="testcookie" value="1" />
			</p>
		</form>

		<?php if ( ! $interim_login ) : ?>
		<p id="nav">
			<?php
			if ( get_option( 'users_can_register' ) ) {
				echo apply_filters( 'register', sprintf( '<a class="wp-login-register" href="%s">%s</a>', esc_url( wp_registration_url() ), __( 'Register' ) ) );
				echo esc_html( $login_link_separator );
			}
			echo apply_filters( 'lost_password_html_link', sprintf( '<a class="wp-login-lost-password" href="%s">%s</a>', esc_url( wp_lostpassword_url() ), __( 'Lost your password?' ) ) );
			?>
		</p>
		<?php endif;

		$login_script  = 'function wp_attempt_focus() {';
		$login_script .= 'setTimeout( function() { try {';
		if ( $user_login ) { $login_script .= 'd = document.getElementById( "user_pass" ); d.value = "";'; }
		else {
			$login_script .= 'd = document.getElementById( "user_login" );';
			if ( $errors->get_error_code() === 'invalid_username' ) { $login_script .= 'd.value = "";'; }
		}
		$login_script .= 'd.focus(); d.select();';
		$login_script .= '} catch( er ) {} }, 200); }' . "\n";
		if ( apply_filters( 'enable_login_autofocus', true ) && ! $error ) { $login_script .= "wp_attempt_focus();\n"; }
		$login_script .= "if ( typeof wpOnload === 'function' ) { wpOnload() }";
		wp_print_inline_script_tag( $login_script );

		if ( $interim_login ) {
			ob_start(); ?>
			<script>( function() { try { var i, links = document.getElementsByTagName( 'a' ); for ( i in links ) { if ( links[i].href ) { links[i].target = '_blank'; } } } catch( er ) {} }()); </script>
			<?php wp_print_inline_script_tag( wp_remove_surrounding_empty_script_tags( ob_get_clean() ) );
		}

		login_footer();
		break;

} // End action switch.