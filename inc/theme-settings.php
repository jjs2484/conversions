<?php
/**
 * Check and setup theme's default settings
 *
 * @package conversions
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists ( 'conversions_setup_theme_default_settings' ) ) {
	function conversions_setup_theme_default_settings() {

		// Sidebar position.
		$conversions_sidebar_position = get_theme_mod( 'conversions_sidebar_position' );
		if ( '' == $conversions_sidebar_position ) {
			set_theme_mod( 'conversions_sidebar_position', 'right' );
		}

	}
}