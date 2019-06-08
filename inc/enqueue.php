<?php
/**
 * conversions enqueue scripts
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'conversions_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function conversions_scripts() {
		// Get the theme data.
		$the_theme = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );
		
		$css_version = $theme_version . '.' . filemtime(get_template_directory() . '/build/main.min.css');
		wp_enqueue_style( 'conversions-styles', get_template_directory_uri() . '/build/main.min.css', array(), $css_version );

		wp_enqueue_script( 'jquery');
		
		$js_version = $theme_version . '.' . filemtime(get_template_directory() . '/build/theme.min.js');
		wp_enqueue_script( 'conversions-scripts', get_template_directory_uri() . '/build/theme.min.js', array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'conversions_scripts' ).

add_action( 'wp_enqueue_scripts', 'conversions_scripts' );

/**
 * Gutenberg scripts and styles
 */
if ( ! function_exists( 'conversions_gutenberg_scripts' ) ) {
	function conversions_gutenberg_scripts() {
		wp_enqueue_script( 'be-editor', get_stylesheet_directory_uri() . '/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_stylesheet_directory() . '/js/editor.js' ), true );
	}
	add_action( 'enqueue_block_editor_assets', 'conversions_gutenberg_scripts' );
}
