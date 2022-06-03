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
		add_action( 'wp_head', [ $this, 'no_js_root' ] );
		add_action( 'wp_body_open', [ $this, 'no_js_body' ] );
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
	 * Google Fonts enqueue.
	 *
	 * @since 2020-11-25
	 */
	public function google_fonts_enqueue() {

		if ( get_theme_mod( 'conversions_google_fonts', true ) !== true ) {
			return;
		}

		if ( get_theme_mod( 'conversions_google_fonts', true ) === true ) {

			// Get theme version.
			$theme_version = $this->get_theme_version();

			// Get the user choices.
			$google_fonts = conversions()->customizer->get_google_fonts();

			if ( $google_fonts[0] === $google_fonts[1] ) {
				$google_fonts_enqueue = wp_enqueue_style(
					'conversions-gfont',
					'https://fonts.googleapis.com/css?family=' . esc_html( $google_fonts[0] ) . '&display=swap',
					array(),
					$theme_version
				);
			} elseif ( $google_fonts[0] !== $google_fonts[1] ) {
				$google_fonts_enqueue = wp_enqueue_style(
					'conversions-gfont',
					'https://fonts.googleapis.com/css?family=' . esc_html( $google_fonts[0] ) . '|' . esc_html( $google_fonts[1] ) . '&display=swap',
					array(),
					$theme_version
				);
			}

			return $google_fonts_enqueue;
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
		$this->google_fonts_enqueue();

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

		// Get the user choices.
		$font_family = conversions()->customizer->get_font_family();

		// Bootstrap button colors.
		$bs_btn_colors = \conversions\Conversions::bootstrap_btn_colors();

		$links_color  = get_theme_mod( 'conversions_link_color', '#0068d7' );
		$links_hcolor = get_theme_mod( 'conversions_link_hcolor', '#00698c' );

		// WC button option.
		$wc_primary_btn = get_theme_mod( 'conversions_wc_primary_btn', 'btn-outline-primary' );

		// EDD button option.
		$edd_primary_btn = get_theme_mod( 'conversions_edd_primary_btn', 'btn-primary' );

		$custom_gb_css = '
			.editor-styles-wrapper .editor-post-title__block .editor-post-title__input,
			.editor-styles-wrapper h1,
			.editor-styles-wrapper h2,
			.editor-styles-wrapper h3,
			.editor-styles-wrapper h4,
			.editor-styles-wrapper h5 {
				font-family: ' . esc_html( $font_family[0] ) . ';
			}
			.editor-styles-wrapper .editor-writing-flow,
			.editor-styles-wrapper .block-editor-writing-flow {
				font-family: ' . esc_html( $font_family[1] ) . ';
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
			.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wp-block-button__link,
			.wc-block-product-search__fields .wc-block-product-search__button {
				background: ' . esc_html( $bs_btn_colors[$wc_primary_btn]['btn_bg'] ) . ';
				color: ' . esc_html( $bs_btn_colors[$wc_primary_btn]['btn_color'] ) . ' !important;
				border: 1px solid ' . esc_html( $bs_btn_colors[$wc_primary_btn]['btn_border'] ) . ';
			}
			.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wp-block-button__link:hover,
			.wc-block-product-search__fields .wc-block-product-search__button:hover {
				color: ' . esc_html( $bs_btn_colors[$wc_primary_btn]['btn_color_hover'] ) . ' !important;
				background-color: ' . esc_html( $bs_btn_colors[$wc_primary_btn]['btn_bg_hover'] ) . ';
				border-color: ' . esc_html( $bs_btn_colors[$wc_primary_btn]['btn_border_hover'] ) . ';
			}
			.editor-styles-wrapper .edd_downloads_list .edd_download .edd_download_buy_button .edd_download_purchase_form a.edd-add-to-cart {
				background: ' . esc_html( $bs_btn_colors[$edd_primary_btn]['btn_bg'] ) . ';
				color: ' . esc_html( $bs_btn_colors[$edd_primary_btn]['btn_color'] ) . ' !important;
				border: 1px solid ' . esc_html( $bs_btn_colors[$edd_primary_btn]['btn_border'] ) . ';
			}
			.editor-styles-wrapper .edd_downloads_list .edd_download .edd_download_buy_button .edd_download_purchase_form a.edd-add-to-cart:hover {
				color: ' . esc_html( $bs_btn_colors[$edd_primary_btn]['btn_color_hover'] ) . ' !important;
				background-color: ' . esc_html( $bs_btn_colors[$edd_primary_btn]['btn_bg_hover'] ) . ';
				border-color: ' . esc_html( $bs_btn_colors[$edd_primary_btn]['btn_border_hover'] ) . ';
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
			$google_fonts = conversions()->customizer->get_google_fonts();

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

		// Get the user choices.
		$font_family = conversions()->customizer->get_font_family();

		$links_color  = get_theme_mod( 'conversions_link_color', '#0068d7' );
		$links_hcolor = get_theme_mod( 'conversions_link_hcolor', '#00698c' );

		// Add them to the classic editor.
		$styles = 'body.mce-content-body { font-family:' . esc_html( $font_family[1] ) . '; } body.mce-content-body h1, body.mce-content-body h2, body.mce-content-body h3, body.mce-content-body h4, body.mce-content-body h5, body.mce-content-body h6 { font-family:' . esc_html( $font_family[0] ) . '; } body.mce-content-body a { color:' . esc_html( $links_color ) . '; } body.mce-content-body a:hover { color:' . esc_html( $links_hcolor ) . '; }';
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
		$this->google_fonts_enqueue();

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
			'conversions-modernizr',
			get_theme_file_uri( '/build/modernizr-output.js' ),
			[ 'jquery' ],
			$theme_version,
			true
		);
		wp_enqueue_script(
			'conversions-scripts',
			get_theme_file_uri( '/build/theme.min.js' ),
			[ 'jquery' ],
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
			[ 'jquery' ],
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

	/**
	 * Remove No-JS class root.
	 *
	 * @since 2022-04-03
	 */
	public function no_js_root() {
		?>
		<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
		<?php
	}

	/**
	 * Remove no-js class body -- bbPress 2.6.9 fix.
	 *
	 * @since 2022-05-18
	 */
	public function no_js_body() {

		if ( class_exists( 'bbPress' ) ) {
			?>
			<script>document.body.className = document.body.className.replace( 'no-js', 'js' );</script>
			<?php
		}
	}
}
