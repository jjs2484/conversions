<?php
/**
 * conversions enqueue scripts
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

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
}
add_action( 'wp_enqueue_scripts', 'conversions_scripts' );

/**
 * Gutenberg scripts and styles
 */
if ( ! function_exists( 'conversions_gutenberg_scripts' ) ) {
	function conversions_gutenberg_scripts() {
		wp_enqueue_script( 'be-editor', get_stylesheet_directory_uri() . '/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_stylesheet_directory() . '/js/editor.js' ), true );
	}
}
add_action( 'enqueue_block_editor_assets', 'conversions_gutenberg_scripts' );



/**
 * Enqueue Gutenberg editor stylesheet and fonts
 * @action enqueue_block_editor_assets
 */
function conversions_enqueue_gutenberg() {
 	
 	// Editor styles
	wp_register_style( 'conversions-gutenberg', get_stylesheet_directory_uri() . '/build/gutenberg-editor-style.css' );
	wp_enqueue_style( 'conversions-gutenberg' );

	// Are Google fonts enabled?
	$google_fonts_state = esc_html(get_theme_mod('conversions_google_fonts', 'enable_gfonts'));
	if( $google_fonts_state == 'enable_gfonts' ) {
		
		// Enqueue headings font
		$headings_font = esc_html(get_theme_mod('conversions_headings_fonts', 'Roboto:400,400italic,700,700italic'));
		wp_register_style( 'conversions-gutenberg-heading-font', '//fonts.googleapis.com/css?family='. $headings_font );
		wp_enqueue_style( 'conversions-gutenberg-heading-font' );

		// Enqueue body font
		$body_font = esc_html(get_theme_mod('conversions_body_fonts', 'Roboto:400,400italic,700,700italic'));
		if( $body_font === $headings_font ) {
			return;
		}
		else {
			wp_register_style( 'conversions-gutenberg-body-font', '//fonts.googleapis.com/css?family='. $body_font );
			wp_enqueue_style( 'conversions-gutenberg-body-font' );
		}

		// create variables for inline styles
		$headings_font_pieces = explode(":", $headings_font);
		$headings_font = $headings_font_pieces[0];
		$body_font_pieces = explode(":", $body_font);
		$body_font = $body_font_pieces[0];
	
	} else {
		$headings_font = "Arial, Helvetica, sans-serif";
		$body_font = "Arial, Helvetica, sans-serif";
	}

	$headings_color = esc_html(get_theme_mod('conversions_typography_heading_color', '#222222'));
	$body_color = esc_html(get_theme_mod('conversions_typography_text_color', '#111111'));
    $links_color = esc_html(get_theme_mod('conversions_typography_link_color', '#2600e6'));
    $links_color_hover = esc_html(get_theme_mod('conversions_typography_link_hover_color', '#2600e6'));

	$custom_gb_css = "
		.editor-styles-wrapper .editor-writing-flow .editor-post-title__block .editor-post-title__input,
    	.editor-styles-wrapper .editor-writing-flow .wp-block-heading h1, 
    	.editor-styles-wrapper .editor-writing-flow .wp-block-heading h2, 
    	.editor-styles-wrapper .editor-writing-flow .wp-block-heading h3,
    	.editor-styles-wrapper .editor-writing-flow .wp-block-heading h4,
    	.editor-styles-wrapper .editor-writing-flow .wp-block-heading h5 {
			color: {$headings_color};
			font-family: {$headings_font};
		}
		.editor-styles-wrapper .editor-writing-flow {
			color: {$body_color};
			font-family: {$body_font};
		}
		.editor-styles-wrapper .editor-writing-flow .wp-block a {
			color: {$links_color};
			text-decoration: none;
		}
		.editor-styles-wrapper .editor-writing-flow .wp-block a:hover {
			color: {$links_color_hover};
			text-decoration: none;
		}
	";
	wp_add_inline_style( 'conversions-gutenberg', $custom_gb_css );

}
add_action( 'enqueue_block_editor_assets', 'conversions_enqueue_gutenberg' );
