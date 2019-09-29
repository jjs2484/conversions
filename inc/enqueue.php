<?php

namespace conversions;

/**
	@brief		Enqueue
	@since		2019-08-15 23:01:47
**/
class Enqueue
{
	/**
		@brief		Constructor.
		@since		2019-08-15 23:01:47
	**/
	public function __construct()
	{
		add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_assets' ] );
		add_action( 'tiny_mce_before_init', [ $this, 'tiny_mce_before_init' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ] );
	}

	/**
		@brief		after_setup_theme
		@since		2019-08-19 21:38:39
	**/
	public function after_setup_theme()
	{
		// Are Google fonts enabled?
		if ( get_theme_mod( 'conversions_google_fonts', true ) == true ) {

			// Enqueue headings font
			$headings_font = get_theme_mod( 'conversions_headings_fonts', 'Roboto:400,400italic,700,700italic' );
			$headings_font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family='. esc_html($headings_font) );
    		add_editor_style( $headings_font_url );

			// Enqueue body font
			$body_font = get_theme_mod( 'conversions_body_fonts', 'Roboto:400,400italic,700,700italic' );
			if( $body_font === $headings_font ) {
				return;
			}
			else {
				$body_font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family='. esc_html($body_font) );
    			add_editor_style( $body_font_url );
			}
		}
	}

	/**
		@brief		enqueue_block_editor_assets
		@since		2019-08-16 11:35:36
	**/
	public function enqueue_block_editor_assets()
	{
		// Editor scripts
		wp_enqueue_script( 'be-editor', get_stylesheet_directory_uri() . '/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_stylesheet_directory() . '/js/editor.js' ), true );

		// Editor styles
		wp_register_style( 'conversions-gutenberg', get_stylesheet_directory_uri() . '/build/gutenberg-editor-style.css' );
		wp_enqueue_style( 'conversions-gutenberg' );

		// Are Google fonts enabled?
		if ( get_theme_mod( 'conversions_google_fonts', true ) == true ) {

			// Enqueue headings font
			$headings_font = get_theme_mod( 'conversions_headings_fonts', 'Roboto:400,400italic,700,700italic' );
			wp_register_style( 'conversions-gutenberg-heading-font', '//fonts.googleapis.com/css?family='. esc_html($headings_font) );
			wp_enqueue_style( 'conversions-gutenberg-heading-font' );

			// Enqueue body font
			$body_font = get_theme_mod( 'conversions_body_fonts', 'Roboto:400,400italic,700,700italic' );
			if( $body_font === $headings_font ) {
				return;
			}
			else {
				wp_register_style( 'conversions-gutenberg-body-font', '//fonts.googleapis.com/css?family='. esc_html($body_font) );
				wp_enqueue_style( 'conversions-gutenberg-body-font' );
			}

			// create variables for inline styles
			$headings_font_pieces = explode(":", $headings_font);
			$headings_font = $headings_font_pieces[0];
			$body_font_pieces = explode(":", $body_font);
			$body_font = $body_font_pieces[0];

		} else {
			$headings_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
			$body_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
		}

		$headings_color = get_theme_mod( 'conversions_heading_color', '#222222' );
		$body_color = get_theme_mod( 'conversions_text_color', '#111111' );
		$links_color = get_theme_mod( 'conversions_link_color', '#0057b4' );
		$links_hcolor = get_theme_mod( 'conversions_link_hcolor', '#004086' );
		$container_width = get_theme_mod( 'conversions_container_width', '1140' );

		$custom_gb_css = '
			.editor-styles-wrapper .editor-writing-flow .editor-post-title__block .editor-post-title__input,
			.editor-styles-wrapper .editor-writing-flow .wp-block-heading h1,
			.editor-styles-wrapper .editor-writing-flow .wp-block-heading h2,
			.editor-styles-wrapper .editor-writing-flow .wp-block-heading h3,
			.editor-styles-wrapper .editor-writing-flow .wp-block-heading h4,
			.editor-styles-wrapper .editor-writing-flow .wp-block-heading h5 {
				color: '.esc_html($headings_color).';
				font-family: '.esc_html($headings_font).';
			}
			.editor-styles-wrapper .editor-writing-flow {
				color: '.esc_html($body_color).';
				font-family: '.esc_html($body_font).';
			}
			.editor-styles-wrapper a,
			.wp-block-freeform.block-library-rich-text__tinymce a {
				color: '.esc_html($links_color).';
				text-decoration: none;
			}
			.editor-styles-wrapper a:hover,
			.wp-block-freeform.block-library-rich-text__tinymce a:hover {
				color: '.esc_html($links_hcolor).';
			}
			.wp-block {
				max-width: '.esc_html($container_width).'px;
			}
			.wp-block[data-align="wide"] {
				max-width: '.esc_html($container_width).'px;
			}
		';
		wp_add_inline_style( 'conversions-gutenberg', $custom_gb_css );
	}

	/**
		@brief		tiny_mce_before_init
		@since		2019-08-19 21:39:20
	**/
	public function tiny_mce_before_init( $mceInit )
	{
		// Are Google fonts enabled?
		if ( get_theme_mod( 'conversions_google_fonts', true ) == true ) {

			// headings font
			$headings_font = get_theme_mod( 'conversions_headings_fonts', 'Roboto:400,400italic,700,700italic' );
			$headings_font_pieces = explode(":", $headings_font);
			$headings_font = $headings_font_pieces[0];

			//body font
			$body_font = get_theme_mod( 'conversions_body_fonts', 'Roboto:400,400italic,700,700italic' );
			$body_font_pieces = explode(":", $body_font);
			$body_font = $body_font_pieces[0];

		} else {
			$headings_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
			$body_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
		}

		$headings_color = get_theme_mod( 'conversions_heading_color', '#222222' );
		$body_color = get_theme_mod( 'conversions_text_color', '#111111' );
		$links_color = get_theme_mod( 'conversions_link_color', '#0057b4' );
		$links_hcolor = get_theme_mod( 'conversions_link_hcolor', '#004086' );

		// Add them to the classic editor
		$styles = 'body.mce-content-body { color:'.esc_html($body_color).';font-family:'.esc_html($body_font).'; } body.mce-content-body h1, body.mce-content-body h2, body.mce-content-body h3, body.mce-content-body h4, body.mce-content-body h5, body.mce-content-body h6 { color:'.esc_html($headings_color).';font-family:'.esc_html($headings_font).'; } body.mce-content-body a { color:'.esc_html($links_color).'; } body.mce-content-body a:hover { color:'.esc_html($links_hcolor).'; }';
		if ( isset( $mceInit['content_style'] ) ) {
			$mceInit['content_style'] .= ' ' . $styles . ' ';
		} else {
			$mceInit['content_style'] = $styles . ' ';
		}
		return $mceInit;
	}

	/**
		@brief		Enqueue scripts.
		@since		2019-08-16 11:35:07
	**/
	function wp_enqueue_scripts()
	{
		// Get the theme data.
		$the_theme = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		// CSS
		$css_version = $theme_version . '.' . filemtime(get_template_directory() . '/build/main.min.css');
		wp_enqueue_style( 'conversions-styles', get_template_directory_uri() . '/build/main.min.css', array(), $css_version );

		// jQuery
		wp_enqueue_script( 'jquery');

		// Javascript
		$js_version = $theme_version . '.' . filemtime(get_template_directory() . '/build/theme.min.js');
		wp_enqueue_script( 'conversions-scripts', get_template_directory_uri() . '/build/theme.min.js', array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Google fonts
		if ( get_theme_mod( 'conversions_google_fonts', true ) == true ) {
			// headings font
			$headings_font = get_theme_mod( 'conversions_headings_fonts', 'Roboto:400,400italic,700,700italic' );
			wp_enqueue_style( 'conversions-heading-gfont', '//fonts.googleapis.com/css?family='. esc_html( $headings_font ) );

			// body font
			$body_font = get_theme_mod( 'conversions_body_fonts', 'Roboto:400,400italic,700,700italic' );
			if( $body_font === $headings_font ) {
				return;
			}
			else {
				wp_enqueue_style( 'conversions-body-gfont', '//fonts.googleapis.com/css?family='. esc_html( $body_font ) );
			}
		}
	}
}
new Enqueue();
