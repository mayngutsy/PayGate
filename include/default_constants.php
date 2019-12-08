<?php

// Default Constants

/**
 * Defines constants and global variables that can be overridden.
 *
 * @package PayGate
 */

 /**
 * Defines initial Paygate constants
 *
 *
 * @since 3.0.0
 *
 * @global int    $service_id    The current service ID.
 * @global string $pg_version The PayGate version string.
 */

function pg_initial_constants(){

	global $pg_service_id;

 	/**#@+
	 * Constants for expressing human-readable data sizes in their respective number of bytes.
	 *
	 * @since 4.4.0
	 */
	define( 'KB_IN_BYTES', 1024 );
	define( 'MB_IN_BYTES', 1024 * KB_IN_BYTES );
	define( 'GB_IN_BYTES', 1024 * MB_IN_BYTES );
	define( 'TB_IN_BYTES', 1024 * GB_IN_BYTES );
	/**#@-*/

	$current_limit     = @ini_get( 'memory_limit' );
	$current_limit_int = pg_convert_hr_to_bytes( $current_limit );

	// Define memory limits.
	if ( ! defined( 'PG_MEMORY_LIMIT' ) ) {
		if ( false === pg_is_ini_value_changeable( 'memory_limit' ) ) {
			define( 'PG_MEMORY_LIMIT', $current_limit );
		} else {
			define( 'PG_MEMORY_LIMIT', '40M' );
		}
	}

	if ( ! defined( 'PG_MAX_MEMORY_LIMIT' ) ) {
		if ( false === pg_is_ini_value_changeable( 'memory_limit' ) ) {
			define( 'PG_MAX_MEMORY_LIMIT', $current_limit );
		} elseif ( -1 === $current_limit_int || $current_limit_int > 268435456 /* = 256M */ ) {
			define( 'PG_MAX_MEMORY_LIMIT', $current_limit );
		} else {
			define( 'PG_MAX_MEMORY_LIMIT', '256M' );
		}
	}

	// Set memory limits.
	$wp_limit_int = pg_convert_hr_to_bytes( PG_MEMORY_LIMIT );
	if ( -1 !== $current_limit_int && ( -1 === $wp_limit_int || $wp_limit_int > $current_limit_int ) ) {
		@ini_set( 'memory_limit', PG_MAX_MEMORY_LIMIT );
	}

	if ( ! isset($pg_service_id) )
		$pg_service_id = 1;

	if ( !defined('PG_CONTENT_DIR') )
		define( 'PG_CONTENT_DIR', ABSPATH . 'content' ); // no trailing slash, full paths only - PG_CONTENT_URL is defined further down


 	// Set define('WP_DEBUG', true); in pg_config.php to enable display of notices during development.
 	if( !defined('PG_DEBUG') )
 		define('PG_DEBUG', false);

 	// Add define('WP_DEBUG_DISPLAY', null); to wp-config.php use the globally configured setting for
	// display_errors and not force errors to be displayed. Use false to force display_errors off.
	if ( !defined('PG_DEBUG_DISPLAY') )
		define( 'PG_DEBUG_DISPLAY', true );

	// Add define('WP_DEBUG_LOG', true); to enable error logging to wp-content/debug.log.
	if ( !defined('PG_DEBUG_LOG') )
		define('PG_DEBUG_LOG', false);

	if ( !defined('PG_CACHE') )
		define('PG_CACHE', false);


}

 /**
 * Defines plugin directory constants
 *
 * Defines must-use plugin directory constants, which may be overridden in the sunrise.php drop-in
 *
 * @since 0.1
 */

function wp_plugin_directory_constants() {
	if ( !defined('PG_CONTENT_URL') )
		define( 'PG_CONTENT_URL', get_option('siteurl') . '/content'); // full url - WP_CONTENT_DIR is defined further up

	/**
	 * Allows for the plugins directory to be moved from the default location.
	 *
	 * @since 2.6.0
	 */
	if ( !defined('PG_PLUGIN_DIR') )
		define( 'PG_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' ); // full path, no trailing slash

	/**
	 * Allows for the plugins directory to be moved from the default location.
	 *
	 * @since 2.6.0
	 */
	if ( !defined('WP_PLUGIN_URL') )
		define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' ); // full url, no trailing slash

	/**
	 * Allows for the plugins directory to be moved from the default location.
	 *
	 * @since 2.1.0
	 * @deprecated
	 */
	if ( !defined('PLUGINDIR') )
		define( 'PLUGINDIR', 'content/plugins' ); // Relative to ABSPATH. For back compat.
}	

function wp_cookie_constants() {
	/**
	 * Used to Guarantee unique hash cookies
	 *
	 * @since 0.1
	 */
	if ( !defined( 'COOKIEHASH' ) ) {
		$siteurl = get_site_option( 'siteurl' );
		if ( $siteurl )
			define( 'COOKIEHASH', md5( $siteurl ) );
		else
			define( 'COOKIEHASH', '' );
	}

	/**
	 * @since 2.0.0
	 */
	if ( !defined('USER_COOKIE') )
		define('USER_COOKIE', 'paygatuser_' . COOKIEHASH);

	/**
	 * @since 2.0.0
	 */
	if ( !defined('PASS_COOKIE') )
		define('PASS_COOKIE', 'paygatepass_' . COOKIEHASH);

	/**
	 * @since 2.5.0
	 */
	if ( !defined('AUTH_COOKIE') )
		define('AUTH_COOKIE', 'paygate_' . COOKIEHASH);

	/**
	 * @since 2.6.0
	 */
	if ( !defined('SECURE_AUTH_COOKIE') )
		define('SECURE_AUTH_COOKIE', 'paygate_sec_' . COOKIEHASH);

	/**
	 * @since 2.6.0
	 */
	if ( !defined('LOGGED_IN_COOKIE') )
		define('LOGGED_IN_COOKIE', 'paygate_logged_in_' . COOKIEHASH);

	/**
	 * @since 2.3.0
	 */
	if ( !defined('TEST_COOKIE') )
		define('TEST_COOKIE', 'paygate_test_cookie');

	/**
	 * @since 1.2.0
	 */
	if ( !defined('COOKIEPATH') )
		define('COOKIEPATH', preg_replace('|https?://[^/]+|i', '', get_option('home') . '/' ) );

	/**
	 * @since 1.5.0
	 */
	if ( !defined('SITECOOKIEPATH') )
		define('SITECOOKIEPATH', preg_replace('|https?://[^/]+|i', '', get_option('siteurl') . '/' ) );

	/**
	 * @since 2.6.0
	 */
	if ( !defined('ADMIN_COOKIE_PATH') )
		define( 'ADMIN_COOKIE_PATH', SITECOOKIEPATH . 'wp-admin' );

	/**
	 * @since 2.6.0
	 */
	if ( !defined('PLUGINS_COOKIE_PATH') )
		define( 'PLUGINS_COOKIE_PATH', preg_replace('|https?://[^/]+|i', '', WP_PLUGIN_URL)  );

	/**
	 * @since 2.0.0
	 */
	if ( !defined('COOKIE_DOMAIN') )
		define('COOKIE_DOMAIN', false);
}

 ?>