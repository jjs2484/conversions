<?php
/**
 * Enqueue scripts and styles
 *
 * @package conversions
 */

namespace conversions;

/**
 * Class Enqueue
 *
 * @since 2019-08-15
 */
class Enqueue {
	/**
	 * Class constructor.
	 *
	 * @since 2019-08-15
	 */
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_assets' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_inline' ], 99 );
		add_action( 'tiny_mce_before_init', [ $this, 'tiny_mce_before_init' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ] );
		add_action( 'customize_controls_enqueue_scripts', [ $this, 'customize_controls_enqueue_scripts' ] );
		add_action( 'wp_head', [ $this, 'resource_hints' ], 1 );
	}

	/**
	 * Get theme version.
	 *
	 * @since 2020-11-24
	 */
	public function get_theme_version() {
		// Get theme version.
		$theme         = wp_get_theme();
		$theme_version = $theme->get( 'Version' );

		return $theme_version;
	}

	/**
	 * Get Google Font options.
	 *
	 * @since 2020-11-25
	 */
	public function get_google_fonts() {

		// Get the user choices.
		$headings_font = get_theme_mod( 'conversions_headings_fonts', 'Roboto:400,400italic,700,700italic' );
		$body_font     = get_theme_mod( 'conversions_body_fonts', 'Roboto:400,400italic,700,700italic' );

		$google_fonts   = [];
		$google_fonts[] = $headings_font;
		$google_fonts[] = $body_font;

		return $google_fonts;
	}

	/**
	 * Google Fonts enqueue.
	 *
	 * @since 2020-11-25
	 */
	public function google_fonts_enqueue() {

		// Get theme version.
		$theme_version = $this->get_theme_version();

		if ( get_theme_mod( 'conversions_google_fonts', true ) !== true ) {
			return;
		}

		if ( get_theme_mod( 'conversions_google_fonts', true ) === true ) {

			// Get the user choices.
			$google_fonts = $this->get_google_fonts();

			if ( $headings_font === $body_font ) {
				$google_font = wp_enqueue_style(
					'conversions-gfont',
					'https://fonts.googleapis.com/css?family=' . esc_html( $google_fonts[0] ) . '&display=swap',
					array(),
					$theme_version
				);
			} elseif ( $google_fonts[0] !== $google_fonts[1] ) {
				$google_font = wp_enqueue_style(
					'conversions-gfont',
					'https://fonts.googleapis.com/css?family=' . esc_html( $google_fonts[0] ) . '|' . esc_html( $google_fonts[1] ) . '&display=swap',
					array(),
					$theme_version
				);
			}

			return $google_font;
		}

	}

	/**
	 * Enqueue scripts and styles for Gutenberg editor.
	 *
	 * @since 2019-08-16
	 */
	public function enqueue_block_editor_assets() {

		// Get theme version.
		$theme_version = $this->get_theme_version();

		// Google Fonts.
		$google_font = $this->google_fonts_enqueue();
		if ( ! empty( $google_font ) ) {
			$google_font;
		}

		// Editor styles.
		wp_enqueue_style(
			'conversions-gutenberg',
			get_theme_file_uri( '/build/gutenberg-editor-style.min.css' ),
			array(),
			$theme_version
		);
	}

	/**
	 * Add inline CSS styles to Gutenberg editor.
	 *
	 * - hooks onto stylesheet id: conversions-gutenberg
	 *
	 * @since 2019-11-24
	 */
	public function enqueue_block_editor_inline() {

		// Are Google fonts enabled?
		if ( get_theme_mod( 'conversions_google_fonts', true ) === true ) {

			// Get the user choices.
			$google_fonts = $this->get_google_fonts();

			// Create variables for inline styles.
			$headings_font_pieces = explode( ':', $google_fonts[0] );
			$headings_font        = $headings_font_pieces[0];
			$body_font_pieces     = explode( ':', $google_fonts[1] );
			$body_font            = $body_font_pieces[0];

		} else {
			$headings_font = 'Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont';
			$body_font     = 'Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont';
		}

		$links_color  = get_theme_mod( 'conversions_link_color', '#0068d7' );
		$links_hcolor = get_theme_mod( 'conversions_link_hcolor', '#00698c' );

		// WC button option.
		$wc_primary_btn = get_theme_mod( 'conversions_wc_primary_btn', 'btn-outline-primary' );

		// EDD button option.
		$edd_primary_btn = get_theme_mod( 'conversions_edd_primary_btn', 'btn-primary' );

		// WC button multidimensional array.
		$wc_btns = array(
			'btn-primary'           => array( 'btn_bg' => '#007bff', 'btn_color' => '#fff', 'btn_border' => '#007bff', 'btn_bg_hover' => '#0069d9', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#0069d9' ),
			'btn-secondary'         => array ( 'btn_bg' => '#6c757d', 'btn_color' => '#fff', 'btn_border' => '#6c757d', 'btn_bg_hover' => '#5a6268', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#5a6268' ),
			'btn-success'           => array ( 'btn_bg' => '#019875', 'btn_color' => '#fff', 'btn_border' => '#019875', 'btn_bg_hover' => '#017258', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#017258' ),
			'btn-danger'            => array ( 'btn_bg' => '#dc3545', 'btn_color' => '#fff', 'btn_border' => '#dc3545', 'btn_bg_hover' => '#c82333', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#c82333' ),
			'btn-warning'           => array ( 'btn_bg' => '#ffc107', 'btn_color' => '#212529', 'btn_border' => '#ffc107', 'btn_bg_hover' => '#e0a800', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#e0a800' ),
			'btn-info'              => array ( 'btn_bg' => '#17a2b8', 'btn_color' => '#fff', 'btn_border' => '#17a2b8', 'btn_bg_hover' => '#138496', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#138496' ),
			'btn-light'             => array ( 'btn_bg' => '#f8f9fa', 'btn_color' => '#212529', 'btn_border' => '#f8f9fa', 'btn_bg_hover' => '#e2e6ea', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#e2e6ea' ),
			'btn-dark'              => array ( 'btn_bg' => '#151b26', 'btn_color' => '#fff', 'btn_border' => '#151b26', 'btn_bg_hover' => '#07090d', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#07090d' ),
			'btn-outline-primary'   => array ( 'btn_bg' => 'transparent', 'btn_color' => '#007bff', 'btn_border' => '#007bff', 'btn_bg_hover' => '#007bff', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#007bff' ),
			'btn-outline-secondary' => array ( 'btn_bg' => 'transparent', 'btn_color' => '#6c757d', 'btn_border' => '#6c757d', 'btn_bg_hover' => '#6c757d', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#6c757d' ),
			'btn-outline-success'   => array ( 'btn_bg' => 'transparent', 'btn_color' => '#019875', 'btn_border' => '#019875', 'btn_bg_hover' => '#019875', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#019875' ),
			'btn-outline-danger'    => array ( 'btn_bg' => 'transparent', 'btn_color' => '#dc3545', 'btn_border' => '#dc3545', 'btn_bg_hover' => '#dc3545', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#dc3545' ),
			'btn-outline-warning'   => array ( 'btn_bg' => 'transparent', 'btn_color' => '#ffc107', 'btn_border' => '#ffc107', 'btn_bg_hover' => '#ffc107', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#ffc107' ),
			'btn-outline-info'      => array ( 'btn_bg' => 'transparent', 'btn_color' => '#17a2b8', 'btn_border' => '#17a2b8', 'btn_bg_hover' => '#17a2b8', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#17a2b8' ),
			'btn-outline-light'     => array ( 'btn_bg' => 'transparent', 'btn_color' => '#f8f9fa', 'btn_border' => '#f8f9fa', 'btn_bg_hover' => '#f8f9fa', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#f8f9fa' ),
			'btn-outline-dark'      => array ( 'btn_bg' => 'transparent', 'btn_color' => '#151b26', 'btn_border' => '#151b26', 'btn_bg_hover' => '#151b26', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#151b26' ),
		);

		$custom_gb_css = '
			.editor-styles-wrapper .editor-post-title__block .editor-post-title__input,
			.editor-styles-wrapper h1,
			.editor-styles-wrapper h2,
			.editor-styles-wrapper h3,
			.editor-styles-wrapper h4,
			.editor-styles-wrapper h5 {
				font-family: ' . esc_html( $headings_font ) . ';
			}
			.editor-styles-wrapper .editor-writing-flow,
			.editor-styles-wrapper .block-editor-writing-flow {
				font-family: ' . esc_html( $body_font ) . ';
			}
			.editor-styles-wrapper a,
			.wp-block-freeform.block-library-rich-text__tinymce a {
				color: ' . esc_html( $links_color ) . ';
				text-decoration: none;
			}
			.editor-styles-wrapper a:hover,
			.wp-block-freeform.block-library-rich-text__tinymce a:hover {
				color: ' . esc_html( $links_hcolor ) . ';
			}
			.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wp-block-button__link {
				background: ' . esc_html( $wc_btns[$wc_primary_btn]['btn_bg'] ) . ';
				color: ' . esc_html( $wc_btns[$wc_primary_btn]['btn_color'] ) . ' !important;
				border: 1px solid ' . esc_html( $wc_btns[$wc_primary_btn]['btn_border'] ) . ';
			}
			.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wp-block-button__link:hover {
				color: ' . esc_html( $wc_btns[$wc_primary_btn]['btn_color_hover'] ) . ' !important;
				background-color: ' . esc_html( $wc_btns[$wc_primary_btn]['btn_bg_hover'] ) . ';
				border-color: ' . esc_html( $wc_btns[$wc_primary_btn]['btn_border_hover'] ) . ';
			}
			.editor-styles-wrapper .edd_downloads_list .edd_download .edd_download_buy_button .edd_download_purchase_form a.edd-add-to-cart {
				background: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_bg'] ) . ';
				color: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_color'] ) . ' !important;
				border: 1px solid ' . esc_html( $wc_btns[$edd_primary_btn]['btn_border'] ) . ';
			}
			.editor-styles-wrapper .edd_downloads_list .edd_download .edd_download_buy_button .edd_download_purchase_form a.edd-add-to-cart:hover {
				color: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_color_hover'] ) . ' !important;
				background-color: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_bg_hover'] ) . ';
				border-color: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_border_hover'] ) . ';
			}
		';
		wp_add_inline_style( 'conversions-gutenberg', $custom_gb_css );

	}

	/**
	 * Add Google fonts to TinyMCE editor.
	 *
	 * @since 2019-08-19
	 */
	public function after_setup_theme() {
		// Are Google fonts enabled?
		if ( get_theme_mod( 'conversions_google_fonts', true ) === true ) {

			// Get the user choices.
			$google_fonts = $this->get_google_fonts();

			// Enqueue headings font.
			$headings_font_url = str_replace( ',', '%2C', 'https://fonts.googleapis.com/css?family=' . esc_url( $google_fonts[0] ) . '&display=swap' );
			add_editor_style( $headings_font_url );

			// Enqueue body font.
			if ( $google_fonts[0] !== $google_fonts[1] ) {
				$body_font_url = str_replace( ',', '%2C', 'https://fonts.googleapis.com/css?family=' . esc_url( $google_fonts[1] ) . '&display=swap' );
				add_editor_style( $body_font_url );
			}
		}
	}

	/**
	 * Add custom styles to TinyMCE editor.
	 *
	 * @since 2019-08-19
	 *
	 * @param array $mceInit An array with TinyMCE config.
	 * @return array $mceInit Array of TinyMCE config.
	 */
	public function tiny_mce_before_init( $mceInit ) {

		// Are Google fonts active?
		if ( get_theme_mod( 'conversions_google_fonts', true ) === true ) {

			// Get the user choices.
			$google_fonts = $this->get_google_fonts();

			// Headings font.
			$headings_font_pieces = explode( ':', $google_fonts[0] );
			$headings_font        = $headings_font_pieces[0];

			// Body font.
			$body_font_pieces = explode( ':', $google_fonts[1] );
			$body_font        = $body_font_pieces[0];

		} else {
			$headings_font = 'Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont';
			$body_font     = 'Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont';
		}

		$links_color  = get_theme_mod( 'conversions_link_color', '#0068d7' );
		$links_hcolor = get_theme_mod( 'conversions_link_hcolor', '#00698c' );

		// Add them to the classic editor.
		$styles = 'body.mce-content-body { font-family:' . esc_html( $body_font ) . '; } body.mce-content-body h1, body.mce-content-body h2, body.mce-content-body h3, body.mce-content-body h4, body.mce-content-body h5, body.mce-content-body h6 { font-family:' . esc_html( $headings_font ) . '; } body.mce-content-body a { color:' . esc_html( $links_color ) . '; } body.mce-content-body a:hover { color:' . esc_html( $links_hcolor ) . '; }';
		if ( isset( $mceInit['content_style'] ) ) {
			$mceInit['content_style'] .= ' ' . $styles . ' ';
		} else {
			$mceInit['content_style'] = $styles . ' ';
		}
		return $mceInit;
	}

	/**
	 * Enqueue scripts and styles for the frontend.
	 *
	 * @since 2019-08-16
	 */
	public function wp_enqueue_scripts() {

		// Get theme version.
		$theme_version = $this->get_theme_version();

		// Google Fonts.
		$google_font = $this->google_fonts_enqueue();
		if ( ! empty( $google_font ) ) {
			$google_font;
		}

		// Font Awesome.
		wp_enqueue_style(
			'font-awesome',
			get_theme_file_uri( '/build/font-awesome.min.css' ),
			array(),
			$theme_version
		);

		// CSS.
		wp_enqueue_style(
			'conversions-styles',
			get_theme_file_uri( '/build/theme.min.css' ),
			array(),
			$theme_version
		);
		// RTL.
		if ( is_rtl() ) {
			wp_enqueue_style(
				'conversions-styles-rtl',
				get_theme_file_uri( '/build/theme.rtl.min.css' ),
				array(),
				$theme_version
			);
			wp_dequeue_style( 'conversions-styles' );
		}

		// jQuery.
		wp_enqueue_script( 'jquery' );

		// Javascript.
		wp_enqueue_script(
			'conversions-scripts',
			get_theme_file_uri( '/build/theme.min.js' ),
			array(),
			$theme_version,
			true
		);
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	/**
	 * Enqueue scripts and styles for the customizer.
	 *
	 * @since 2019-12-25
	 */
	public function customize_controls_enqueue_scripts() {

		// Get theme version.
		$theme_version = $this->get_theme_version();

		// Styles.
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style(
			'font-awesome',
			get_theme_file_uri( '/build/font-awesome.min.css' ),
			array(),
			$theme_version
		);
		wp_enqueue_style(
			'conversions-customizer-css',
			get_theme_file_uri( '/build/conversions-customizer.min.css' ),
			array(),
			$theme_version
		);

		// Scripts.
		wp_enqueue_script(
			'conversions-customizer-js',
			get_theme_file_uri( '/build/conversions-customizer.min.js' ),
			array(),
			$theme_version,
			true
		);
	}

	/**
	 * Resource hints: preload, preconnect.
	 *
	 * @since 2020-11-24
	 */
	public function resource_hints() {

		// Font Awesome preload.
		$resources  = '<link rel="preload" href="' . esc_url( get_theme_file_uri( '/fonts/fa-solid-900.woff2' ) ) . '" as="font" type="font/woff2" crossorigin="anonymous">';
		$resources .= '<link rel="preload" href="' . esc_url( get_theme_file_uri( '/fonts/fa-brands-400.woff2' ) ) . '" as="font" type="font/woff2" crossorigin="anonymous">';
		$resources .= '<link rel="preload" href="' . esc_url( get_theme_file_uri( '/fonts/fa-regular-400.woff2' ) ) . '" as="font" type="font/woff2" crossorigin="anonymous">';

		// Are Google Fonts active?
		if ( get_theme_mod( 'conversions_google_fonts', true ) === true ) {
			// Add Google Fonts preconnect.
			$resources .= '<link rel="preconnect" href="' . esc_url( 'https://fonts.gstatic.com/' ) . '" crossorigin>';
		}

		// Apply filter if exists.
		if ( has_filter( 'conversions_resource_hints' ) ) {
			$resources = apply_filters( 'conversions_resource_hints', $resources );
		}

		echo $resources; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier.

	}
}
