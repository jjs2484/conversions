<?php
/**
 * Check and setup theme's default settings
 *
 * @package conversions
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists ( 'conversions_setup_theme_default_settings' ) ) {
	function conversions_setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$conversions_posts_index_style = get_theme_mod( 'conversions_posts_index_style' );
		if ( '' == $conversions_posts_index_style ) {
			set_theme_mod( 'conversions_posts_index_style', 'default' );
		}

		// Sidebar position.
		$conversions_sidebar_position = get_theme_mod( 'conversions_sidebar_position' );
		if ( '' == $conversions_sidebar_position ) {
			set_theme_mod( 'conversions_sidebar_position', 'right' );
		}

		// Container width.
		$conversions_container_type = get_theme_mod( 'conversions_container_type' );
		if ( '' == $conversions_container_type ) {
			set_theme_mod( 'conversions_container_type', 'container' );
		}
	}
}