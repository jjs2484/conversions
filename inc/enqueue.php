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
		wp_register_style( 'conversions-gutenberg', get_stylesheet_directory_uri() . '/build/gutenberg-editor-style.min.css' );
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

		$links_color = get_theme_mod( 'conversions_link_color', '#0068d7' );
		$links_hcolor = get_theme_mod( 'conversions_link_hcolor', '#00698c' );

		// WC button option
		$wc_primary_btn = get_theme_mod( 'conversions_wc_primary_btn', 'btn-outline-primary' );

		// WC button multidimensional array
		$wc_btns = array(
			"btn-primary" => array( "btn_bg" => "#007bff", "btn_color" => "#fff", "btn_border" => "#007bff", "btn_bg_hover" => "#0069d9", "btn_color_hover" => "#fff", "btn_border_hover" => "#0069d9" ),
			"btn-secondary" => array ( "btn_bg" => "#6c757d", "btn_color" => "#fff", "btn_border" => "#6c757d", "btn_bg_hover" => "#5a6268", "btn_color_hover" => "#fff", "btn_border_hover" => "#5a6268" ),
			"btn-success" => array ( "btn_bg" => "#019875", "btn_color" => "#fff", "btn_border" => "#019875", "btn_bg_hover" => "#017258", "btn_color_hover" => "#fff", "btn_border_hover" => "#017258" ),
			"btn-danger" => array ( "btn_bg" => "#dc3545", "btn_color" => "#fff", "btn_border" => "#dc3545", "btn_bg_hover" => "#c82333", "btn_color_hover" => "#fff", "btn_border_hover" => "#c82333" ),
			"btn-warning" => array ( "btn_bg" => "#ffc107", "btn_color" => "#212529", "btn_border" => "#ffc107", "btn_bg_hover" => "#e0a800", "btn_color_hover" => "#212529", "btn_border_hover" => "#e0a800" ),
			"btn-info" => array ( "btn_bg" => "#17a2b8", "btn_color" => "#fff", "btn_border" => "#17a2b8", "btn_bg_hover" => "#138496", "btn_color_hover" => "#fff", "btn_border_hover" => "#138496" ),
			"btn-light" => array ( "btn_bg" => "#f8f9fa", "btn_color" => "#212529", "btn_border" => "#f8f9fa", "btn_bg_hover" => "#e2e6ea", "btn_color_hover" => "#212529", "btn_border_hover" => "#e2e6ea" ),
			"btn-dark" => array ( "btn_bg" => "#151b26", "btn_color" => "#fff", "btn_border" => "#151b26", "btn_bg_hover" => "#07090d", "btn_color_hover" => "#fff", "btn_border_hover" => "#07090d" ),
			"btn-outline-primary" => array ( "btn_bg" => "transparent", "btn_color" => "#007bff", "btn_border" => "#007bff", "btn_bg_hover" => "#007bff", "btn_color_hover" => "#fff", "btn_border_hover" => "#007bff" ),
			"btn-outline-secondary" => array ( "btn_bg" => "transparent", "btn_color" => "#6c757d", "btn_border" => "#6c757d", "btn_bg_hover" => "#6c757d", "btn_color_hover" => "#fff", "btn_border_hover" => "#6c757d" ),
			"btn-outline-success" => array ( "btn_bg" => "transparent", "btn_color" => "#019875", "btn_border" => "#019875", "btn_bg_hover" => "#019875", "btn_color_hover" => "#fff", "btn_border_hover" => "#019875" ),
			"btn-outline-danger" => array ( "btn_bg" => "transparent", "btn_color" => "#dc3545", "btn_border" => "#dc3545", "btn_bg_hover" => "#dc3545", "btn_color_hover" => "#fff", "btn_border_hover" => "#dc3545" ),
			"btn-outline-warning" => array ( "btn_bg" => "transparent", "btn_color" => "#ffc107", "btn_border" => "#ffc107", "btn_bg_hover" => "#ffc107", "btn_color_hover" => "#212529", "btn_border_hover" => "#ffc107" ),
			"btn-outline-info" => array ( "btn_bg" => "transparent", "btn_color" => "#17a2b8", "btn_border" => "#17a2b8", "btn_bg_hover" => "#17a2b8", "btn_color_hover" => "#fff", "btn_border_hover" => "#17a2b8" ),
			"btn-outline-light" => array ( "btn_bg" => "transparent", "btn_color" => "#f8f9fa", "btn_border" => "#f8f9fa", "btn_bg_hover" => "#f8f9fa", "btn_color_hover" => "#212529", "btn_border_hover" => "#f8f9fa" ),
			"btn-outline-dark" => array ( "btn_bg" => "transparent", "btn_color" => "#151b26", "btn_border" => "#151b26", "btn_bg_hover" => "#151b26", "btn_color_hover" => "#fff", "btn_border_hover" => "#151b26" ),
		);

		$custom_gb_css = '
			.editor-styles-wrapper .editor-writing-flow .editor-post-title__block .editor-post-title__input,
			.editor-styles-wrapper .editor-writing-flow .wp-block-heading h1,
			.editor-styles-wrapper .editor-writing-flow .wp-block-heading h2,
			.editor-styles-wrapper .editor-writing-flow .wp-block-heading h3,
			.editor-styles-wrapper .editor-writing-flow .wp-block-heading h4,
			.editor-styles-wrapper .editor-writing-flow .wp-block-heading h5 {
				font-family: '.esc_html($headings_font).';
			}
			.editor-styles-wrapper .editor-writing-flow {
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
			.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wp-block-button__link {
				background: '.esc_html( $wc_btns[$wc_primary_btn]["btn_bg"] ).';
				color: '.esc_html( $wc_btns[$wc_primary_btn]["btn_color"] ).' !important;
				border: 1px solid '.esc_html( $wc_btns[$wc_primary_btn]["btn_border"] ).';
			}
			.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wp-block-button__link:hover {
				color: '.esc_html( $wc_btns[$wc_primary_btn]["btn_color_hover"] ).' !important;
				background-color: '.esc_html( $wc_btns[$wc_primary_btn]["btn_bg_hover"] ).';
				border-color: '.esc_html( $wc_btns[$wc_primary_btn]["btn_border_hover"] ).';
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

		$links_color = get_theme_mod( 'conversions_link_color', '#0068d7' );
		$links_hcolor = get_theme_mod( 'conversions_link_hcolor', '#00698c' );

		// Add them to the classic editor
		$styles = 'body.mce-content-body { font-family:'.esc_html($body_font).'; } body.mce-content-body h1, body.mce-content-body h2, body.mce-content-body h3, body.mce-content-body h4, body.mce-content-body h5, body.mce-content-body h6 { font-family:'.esc_html($headings_font).'; } body.mce-content-body a { color:'.esc_html($links_color).'; } body.mce-content-body a:hover { color:'.esc_html($links_hcolor).'; }';
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
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/build/font-awesome.min.css', array(), '5.10.2' );

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
