<?php 
/**
 * Defines cookie related WordPress constants
 *
 * @since 3.0.0
 */
/**
 * Whether to force SSL used for the Administration Screens.
 *
 * @since 2.6.0
 *
 * @staticvar bool $forced
 *
 * @param string|bool $force Optional. Whether to force SSL in admin screens. Default null.
 * @return bool True if forced, false if not forced.
 */
function force_ssl_admin( $force = null ) {
	static $forced = false;

	if ( !is_null( $force ) ) {
		$old_forced = $forced;
		$forced = $force;
		return $old_forced;
	}

	return $forced;
}

?>