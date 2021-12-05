<?php
/**
 * Customizer options
 *
 * @package conversions
 */

namespace conversions
{

	/**
	 * Customizer class.
	 *
	 * Contains customizer functions and options.
	 *
	 * @since 2019-08-15
	 */
	class Customizer {
		/**
		 * Class constructor.
		 *
		 * @since 2019-08-15
		 */
		public function __construct() {
			add_action( 'customize_register', [ $this, 'customize_register' ] );
			add_action( 'wp_head', [ $this, 'wp_head' ], 99 );
		}

		/**
		 * Customize register function.
		 *
		 * @since 2019-08-15
		 *
		 * @param object $wp_customize The Customizer object.
		 */
		public function customize_register( $wp_customize ) {
			// Save this so that it can be passed to the conversions_customize_register action.
			$this->wp_customize = $wp_customize;

			// font choices.
			$this->font_choices = [
				'Comfortaa:400,700'                       => __( 'Comfortaa', 'conversions' ),
				'Handlee:400'                             => __( 'Handlee', 'conversions' ),
				'Indie Flower:400'                        => __( 'Indie Flower', 'conversions' ),
				'Lato:400,700,400italic,700italic'        => __( 'Lato', 'conversions' ),
				'Libre Baskerville:400,400italic,700'     => __( 'Libre Baskerville', 'conversions' ),
				'Lora:400,700,400italic,700italic'        => __( 'Lora', 'conversions' ),
				'Merriweather:400,300italic,300,400italic,700,700italic' => __( 'Merriweather', 'conversions' ),
				'Noto Sans:400,400italic,700,700italic'   => __( 'Noto Sans', 'conversions' ),
				'Open Sans:400italic,700italic,400,700'   => __( 'Open Sans', 'conversions' ),
				'Oxygen:400,300,700'                      => __( 'Oxygen', 'conversions' ),
				'Roboto:400,400italic,700,700italic'      => __( 'Roboto', 'conversions' ),
				'Roboto Mono:400,400italic,700,700italic' => __( 'Roboto Mono', 'conversions' ),
				'Roboto Slab:400,700'                     => __( 'Roboto Slab', 'conversions' ),
				'Special Elite:400'                       => __( 'Special Elite', 'conversions' ),
				'Ubuntu:400,700,400italic,700italic'      => __( 'Ubuntu', 'conversions' ),
			];

			// button choices.
			$this->button_choices = [
				'btn-primary'           => __( 'Primary', 'conversions' ),
				'btn-secondary'         => __( 'Secondary', 'conversions' ),
				'btn-success'           => __( 'Success', 'conversions' ),
				'btn-danger'            => __( 'Danger', 'conversions' ),
				'btn-warning'           => __( 'Warning', 'conversions' ),
				'btn-info'              => __( 'Info', 'conversions' ),
				'btn-light'             => __( 'Light', 'conversions' ),
				'btn-dark'              => __( 'Dark', 'conversions' ),
				'btn-outline-primary'   => __( 'Primary outline', 'conversions' ),
				'btn-outline-secondary' => __( 'Secondary outline', 'conversions' ),
				'btn-outline-success'   => __( 'Success outline', 'conversions' ),
				'btn-outline-danger'    => __( 'Danger outline', 'conversions' ),
				'btn-outline-warning'   => __( 'Warning outline', 'conversions' ),
				'btn-outline-info'      => __( 'Info outline', 'conversions' ),
				'btn-outline-light'     => __( 'Light outline', 'conversions' ),
				'btn-outline-dark'      => __( 'Dark outline', 'conversions' ),
			];

			// extra button choices.
			$this->extra_button_choices = [
				'no' => __( 'None', 'conversions' ),
			];

			// alt button choices.
			$this->alt_button_choices = array_merge( $this->extra_button_choices, $this->button_choices );

			// gradient choices.
			$this->gradient_choices = [
				'grade-grey'       => __( 'Grade Grey', 'conversions' ),
				'cool-blues'       => __( 'Cool Blues', 'conversions' ),
				'moonlit-asteroid' => __( 'Moonlit Asteroid', 'conversions' ),
				'evening-sunshine' => __( 'Evening Sunshine', 'conversions' ),
				'dark-ocean'       => __( 'Dark Ocean', 'conversions' ),
				'cool-sky'         => __( 'Cool Sky', 'conversions' ),
				'yoda'             => __( 'Yoda', 'conversions' ),
				'memariani'        => __( 'Memariani', 'conversions' ),
				'harvey'           => __( 'Harvey', 'conversions' ),
				'witching-hour'    => __( 'Witching Hour', 'conversions' ),
				'wiretap'          => __( 'Wiretap', 'conversions' ),
				'magic'            => __( 'Magic', 'conversions' ),
				'mellow'           => __( 'Mellow', 'conversions' ),
				'crystal-clear'    => __( 'Crystal Clear', 'conversions' ),
				'summer'           => __( 'Summer', 'conversions' ),
				'burning-orange'   => __( 'Burning Orange', 'conversions' ),
				'instagram'        => __( 'Instagram', 'conversions' ),
				'dracula'          => __( 'Dracula', 'conversions' ),
				'titanium'         => __( 'Titanium', 'conversions' ),
				'moss'             => __( 'Moss', 'conversions' ),
			];

			// -----------------------------------------------------
			// Remove background image section
			// -----------------------------------------------------
			$wp_customize->get_section( 'background_image' )->active_callback = '__return_false';

			// -----------------------------------------------------
			// Remove colors section and move control
			// -----------------------------------------------------
			$wp_customize->get_section( 'colors' )->active_callback = '__return_false';

			// -----------------------------------------------------
			// Add logo height to site identity panel
			// -----------------------------------------------------
			$wp_customize->add_setting(
				'conversions_logo_height',
				[
					'default'           => '2.5',
					'type'              => 'theme_mod',
					'capability'        => 'edit_theme_options',
					'transport'         => 'refresh',
					'sanitize_callback' => 'conversions_sanitize_float',
				]
			);
			$wp_customize->add_control(
				'conversions_logo_height_control',
				[
					'label'       => __( 'Logo height', 'conversions' ),
					'description' => __( 'Max logo height in rem', 'conversions' ),
					'section'     => 'title_tagline',
					'settings'    => 'conversions_logo_height',
					'priority'    => 8,
					'type'        => 'number',
					'input_attrs' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 0.1,
					],
				]
			);

			// -----------------------------------------------------
			// Add Doc and Premium Extensions link
			// -----------------------------------------------------
			$wp_customize->register_section_type( \conversions\Button::class );
			$wp_customize->add_section(
				new \conversions\Button(
					$wp_customize,
					'conversions_premium',
					[
						'title'         => '',
						'button_text'   => __( 'Get Started', 'conversions' ),
						'button_url'    => admin_url( 'themes.php?page=conversions-info' ),
						'button_text_2' => __( 'Premium', 'conversions' ),
						'button_url_2'  => 'https://conversionswp.com/premium-extensions/',
						'priority'      => 1,
						'capability'    => 'edit_theme_options',
					]
				)
			);

			// -----------------------------------------------------
			// Include customizer sections
			// -----------------------------------------------------
			// phpcs:disable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			include get_parent_theme_file_path( '/inc/customizer/navbar.php' );
			include get_parent_theme_file_path( '/inc/customizer/layout.php' );
			include get_parent_theme_file_path( '/inc/customizer/typography.php' );
			include get_parent_theme_file_path( '/inc/customizer/call-to-action.php' );
			include get_parent_theme_file_path( '/inc/customizer/footer.php' );
			include get_parent_theme_file_path( '/inc/customizer/blog.php' );
			include get_parent_theme_file_path( '/inc/customizer/featured-image.php' );
			include get_parent_theme_file_path( '/inc/customizer/woocommerce.php' );
			include get_parent_theme_file_path( '/inc/customizer/edd.php' );
			include get_parent_theme_file_path( '/inc/customizer/bbpress.php' );
			// phpcs:enable

			do_action( 'conversions_customize_register', $this );
		}

		/**
		 * Fixed navbar height calculations for inline styles.
		 *
		 * @since 2020-04-27
		 */
		public function fixed_navbar_height_calc() {

			// fixed navbar height calc variables.
			if ( has_custom_logo() ) {
				$logo_height = get_theme_mod( 'conversions_logo_height', '2.5' );
			} else {
				$logo_height = 1.875;
			}
			$logo_padding  = .625;
			$nav_tbpadding = get_theme_mod( 'conversions_nav_tbpadding', '.5' ) * 2;

			// Nav height total calc.
			$total_nav_height = $logo_height + $nav_tbpadding + $logo_padding - .1250;

			// Desktop nav below calc specifics.
			$nav_link_height             = 1.5;
			$nav_menu_padding_height     = get_theme_mod( 'conversions_nav_tbpadding', '.5' ) * 2;
			$nav_branding_padding_height = get_theme_mod( 'conversions_branding_tbpadding', '.5' ) * 2;
			$nav_below_ph                = $nav_link_height + $nav_menu_padding_height + $nav_branding_padding_height;
			$total_nav_height_below      = $logo_height + $nav_below_ph + $logo_padding - .1250;

			$nav_height = [$total_nav_height, $total_nav_height_below];

			// Apply filter if exists.
			if ( has_filter( 'conversions_fixed_navbar_margin' ) ) {
				$nav_height = apply_filters( 'conversions_fixed_navbar_margin', $nav_height );
			}

			return $nav_height;
		}

		/**
		 * Get Google Font options.
		 *
		 * @since 2020-11-25
		 */
		public function get_google_fonts() {
			/*
			 * Get the user choices and add to an array.
			 * $google_fonts = get_google_fonts();
			 * heading font is $google_fonts[0]
			 * body font is $google_fonts[1]
			 */
			$google_fonts   = [];
			$google_fonts[] = get_theme_mod( 'conversions_headings_fonts', 'Roboto:400,400italic,700,700italic' );
			$google_fonts[] = get_theme_mod( 'conversions_body_fonts', 'Roboto:400,400italic,700,700italic' );

			return $google_fonts;
		}

		/**
		 * Get font family.
		 *
		 * @since 2020-11-25
		 */
		public function get_font_family() {
			/*
			 * Get the user choices and add to an array.
			 * $font_family = get_font_family();
			 * heading font is $font_family[0]
			 * body font is $font_family[1]
			 */

			// Are Google fonts enabled?
			if ( get_theme_mod( 'conversions_google_fonts', true ) === true ) {

				// Get the user choices.
				$google_fonts = $this->get_google_fonts();

				// Get the font family name to use in inline styles.
				$headings_font_pieces = explode( ':', $google_fonts[0] );
				$headings_font        = $headings_font_pieces[0];
				$body_font_pieces     = explode( ':', $google_fonts[1] );
				$body_font            = $body_font_pieces[0];

			} else {
				// If not use web safe fonts.
				$headings_font = 'Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont';
				$body_font     = 'Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont';
			}

			// Create an array.
			$font_family   = [];
			$font_family[] = $headings_font;
			$font_family[] = $body_font;

			// Apply filter if exists.
			if ( has_filter( 'conversions_font_family' ) ) {
				$resources = apply_filters( 'conversions_font_family', $font_family );
			}

			return $font_family;
		}

		/**
		 * Customizer options styles added to wp_head inline.
		 *
		 * @since 2019-08-15
		 */
		public function wp_head() {

			// Get the user choices.
			$font_family = $this->get_font_family();

			// fixed navbar height calc variables.
			$nav_height = $this->fixed_navbar_height_calc();

			// Sticky post highlight option.
			$sticky_post_highlight = get_theme_mod( 'conversions_blog_sticky_posts', 'primary' );

			// WC button option.
			$wc_primary_btn   = get_theme_mod( 'conversions_wc_primary_btn', 'btn-outline-primary' );
			$wc_secondary_btn = get_theme_mod( 'conversions_wc_secondary_btn', 'btn-primary' );

			// EDD button option.
			$edd_primary_btn = get_theme_mod( 'conversions_edd_primary_btn', 'btn-primary' );

			// bbPress button option.
			$bbp_primary_btn = get_theme_mod( 'conversions_bbp_primary_btn', 'btn-primary' );

			// button multidimensional array.
			$wc_btns = [
				'btn-primary'           => [ 'btn_bg' => '#007bff', 'btn_color' => '#fff', 'btn_border' => '#007bff', 'btn_bg_hover' => '#0069d9', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#0069d9' ],
				'btn-secondary'         => [ 'btn_bg' => '#6c757d', 'btn_color' => '#fff', 'btn_border' => '#6c757d', 'btn_bg_hover' => '#5a6268', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#5a6268' ],
				'btn-success'           => [ 'btn_bg' => '#198754', 'btn_color' => '#fff', 'btn_border' => '#198754', 'btn_bg_hover' => '#017258', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#017258' ],
				'btn-danger'            => [ 'btn_bg' => '#dc3545', 'btn_color' => '#fff', 'btn_border' => '#dc3545', 'btn_bg_hover' => '#c82333', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#c82333' ],
				'btn-warning'           => [ 'btn_bg' => '#ffc107', 'btn_color' => '#212529', 'btn_border' => '#ffc107', 'btn_bg_hover' => '#e0a800', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#e0a800' ],
				'btn-info'              => [ 'btn_bg' => '#17a2b8', 'btn_color' => '#fff', 'btn_border' => '#17a2b8', 'btn_bg_hover' => '#138496', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#138496' ],
				'btn-light'             => [ 'btn_bg' => '#f8f9fa', 'btn_color' => '#212529', 'btn_border' => '#f8f9fa', 'btn_bg_hover' => '#e2e6ea', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#e2e6ea' ],
				'btn-dark'              => [ 'btn_bg' => '#151b26', 'btn_color' => '#fff', 'btn_border' => '#151b26', 'btn_bg_hover' => '#07090d', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#07090d' ],
				'btn-outline-primary'   => [ 'btn_bg' => 'transparent', 'btn_color' => '#007bff', 'btn_border' => '#007bff', 'btn_bg_hover' => '#007bff', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#007bff' ],
				'btn-outline-secondary' => [ 'btn_bg' => 'transparent', 'btn_color' => '#6c757d', 'btn_border' => '#6c757d', 'btn_bg_hover' => '#6c757d', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#6c757d' ],
				'btn-outline-success'   => [ 'btn_bg' => 'transparent', 'btn_color' => '#198754', 'btn_border' => '#198754', 'btn_bg_hover' => '#198754', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#198754' ],
				'btn-outline-danger'    => [ 'btn_bg' => 'transparent', 'btn_color' => '#dc3545', 'btn_border' => '#dc3545', 'btn_bg_hover' => '#dc3545', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#dc3545' ],
				'btn-outline-warning'   => [ 'btn_bg' => 'transparent', 'btn_color' => '#ffc107', 'btn_border' => '#ffc107', 'btn_bg_hover' => '#ffc107', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#ffc107' ],
				'btn-outline-info'      => [ 'btn_bg' => 'transparent', 'btn_color' => '#17a2b8', 'btn_border' => '#17a2b8', 'btn_bg_hover' => '#17a2b8', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#17a2b8' ],
				'btn-outline-light'     => [ 'btn_bg' => 'transparent', 'btn_color' => '#f8f9fa', 'btn_border' => '#f8f9fa', 'btn_bg_hover' => '#f8f9fa', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#f8f9fa' ],
				'btn-outline-dark'      => [ 'btn_bg' => 'transparent', 'btn_color' => '#151b26', 'btn_border' => '#151b26', 'btn_bg_hover' => '#151b26', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#151b26' ],
			];

			// bootstrap colors.
			$bs_colors = [
				'primary'   => [ '#007bff' ],
				'secondary' => [ '#6c757d' ],
				'success'   => [ '#198754' ],
				'danger'    => [ '#dc3545' ],
				'warning'   => [ '#ffc107' ],
				'info'      => [ '#17a2b8' ],
				'light'     => [ '#f8f9fa' ],
				'dark'      => [ '#151b26' ],
			];

			$mods = [
				[ '.navbar-brand img', 'max-height', get_theme_mod( 'conversions_logo_height' ), 'rem' ],
				[ '.navbar', 'padding-top', get_theme_mod( 'conversions_nav_tbpadding' ), 'rem' ],
				[ '.navbar', 'padding-bottom', get_theme_mod( 'conversions_nav_tbpadding' ), 'rem' ],
				[ 'footer.site-footer', 'background-color', get_theme_mod( 'conversions_footer_bg_color' ) ],
				[ 'footer.site-footer .h1, footer.site-footer .h2, footer.site-footer .h3, footer.site-footer .h4, footer.site-footer .h5, footer.site-footer .h6, footer.site-footer h1, footer.site-footer h2, footer.site-footer h3, footer.site-footer h4, footer.site-footer h5, footer.site-footer h6, footer.site-footer p, footer.site-footer table, footer.site-footer li, footer.site-footer dl, footer.site-footer caption, footer.site-footer .site-info .copyright', 'color', get_theme_mod( 'conversions_footer_text_color' ) ],
				[ 'footer.site-footer a, footer.site-footer .site-info .copyright a, footer.site-footer .social-media-icons ul li.list-inline-item i', 'color', get_theme_mod( 'conversions_footer_link_color' ) ],
				[ 'footer.site-footer a:hover, footer.site-footer .site-info .copyright a:hover, footer.site-footer .social-media-icons ul li.list-inline-item i:hover', 'color', get_theme_mod( 'conversions_footer_link_hcolor' ) ],
				[ 'a', 'color', get_theme_mod( 'conversions_link_color' ) ],
				[ 'a:hover', 'color', get_theme_mod( 'conversions_link_hcolor' ) ],
				[ '.conversions-hero-cover .conversions-hero-cover__inner h1', 'color', get_theme_mod( 'conversions_featured_title_color' ) ],
				[ 'section.c-cta h2', 'color', get_theme_mod( 'conversions_hcta_title_color' ) ],
				[ 'section.c-cta p.subtitle', 'color', get_theme_mod( 'conversions_hcta_desc_color' ) ],
				[ '.conversions-hero-cover', 'min-height', get_theme_mod( 'conversions_featured_img_height' ), 'vh' ],
				[ '.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6', 'font-family', $font_family[0] ],
				[ 'body, input, select, textarea', 'font-family', $font_family[1] ],
			];
			?>

			<style>
				<?php
				foreach ( $mods as $key => $value ) {
					if ( ! empty( $value[2] ) ) {
						echo esc_html( $value[0] );
						echo '{';
						echo esc_html( $value[1] );
						echo ':';
						echo esc_html( $value[2] );
						if ( ! empty( $value[3] ) ) {
							echo esc_html( $value[3] );
						}
						echo ';}';
					}
				}

				// Fixed navbar height.
				if ( get_theme_mod( 'conversions_nav_position', 'fixed-top' ) === 'fixed-top' ) {
					if ( get_theme_mod( 'conversions_nav_layout', 'right' ) === 'right' ) {
						// Content margin.
						echo '.content-wrapper {
							margin-top: ' . esc_html( $nav_height[0] ) . 'rem;
						}';
						// Anchor link padding.
						echo 'html {
							scroll-padding-top: ' . esc_html( $nav_height[0] ) . 'rem;
						}';
					}
				}
				// Footer padding if fullwidth FAB active.
				if ( ! class_exists( 'woocommerce' ) && ! class_exists( 'Easy_Digital_Downloads' ) ) {
					if ( get_theme_mod( 'conversions_nav_button', 'no' ) !== 'no' ) {
						echo '@media (max-width: 767.98px) {
							#wrapper-footer.wrapper {
								padding-bottom: 5rem;
							}
						}';
					}
				}
				// Content article card.
				if ( get_theme_mod( 'conversions_content_cards', false ) === true ) {
					echo 'body.page #primary #main > article,
					body.single #primary #main > article,
					body.archive #primary #main > article {
						position: relative;
						display: flex;
						flex-direction: column;
						min-width: 0;
						word-wrap: break-word;
						background-color: #fff;
						border: 1px solid rgba(0,0,0,.125);
						border-radius: .25rem;
						box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
						padding: 2rem;
					}';
					echo '@media (max-width: 575.98px) {
						body.page #primary,
						body.single #primary,
						body.archive #primary {
							padding-left: 0;
							padding-right: 0;
						}
					}';
					echo '@media (max-width: 575.98px) {
						body.page #primary #main > :not(article),
						body.single #primary #main > :not(article),
						body.archive #primary #main > :not(article) {
							padding-left: 15px;
							padding-right: 15px;
						}
					}';
				}
				// Featured image.
				if ( get_theme_mod( 'conversions_featured_img_parallax', false ) === true ) {
					echo '.conversions-hero-cover {
						background-attachment: fixed;
					}';
				}
				// Sticky post highlight.
				if ( $sticky_post_highlight !== 'no' ) {
					echo '.blog:not(.paged) .card.c-sticky-highlight {
						border-color: ' . esc_html( $bs_colors[$sticky_post_highlight][0] ) . ';
					}';
				}
				// Woocommerce.
				if ( class_exists( 'woocommerce' ) ) {
					if ( get_theme_mod( 'conversions_wc_checkout_columns', 'two-column' ) === 'two-column' ) {
						// checkout columns.
						echo '@media screen and (min-width:768px) {
							body.woocommerce-checkout #customer_details { width: 48%; float: left; margin-right: 1.9%; }
							body.woocommerce-checkout .col-12.col-md-7.conversions-wcbilling { flex: 0 0 100%; -webkit-flex: 0 0 100%; -ms-flex: 0 0 100%; max-width: 100%; }
							body.woocommerce-checkout .col-12.col-md-5.conversions-wcshipping { flex: 0 0 100%; -webkit-flex: 0 0 100%; -ms-flex: 0 0 100%; max-width: 100%; margin-top: 1em; }
							body.woocommerce-checkout #order_review, body.woocommerce-checkout #order_review_heading { width: 48%; float: right; margin-right: 0; }
						}';
					}
					// Shop buttons.
					echo '.woocommerce ul.products li.product .button, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wp-block-button__link {
						background: ' . esc_html( $wc_btns[$wc_primary_btn]['btn_bg'] ) . ';
						color: ' . esc_html( $wc_btns[$wc_primary_btn]['btn_color'] ) . ';
						border: 1px solid ' . esc_html( $wc_btns[$wc_primary_btn]['btn_border'] ) . ';
					}';
					echo '.woocommerce ul.products li.product .button:hover, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wp-block-button__link:hover {
						color: ' . esc_html( $wc_btns[$wc_primary_btn]['btn_color_hover'] ) . ';
						background-color: ' . esc_html( $wc_btns[$wc_primary_btn]['btn_bg_hover'] ) . ';
						border-color: ' . esc_html( $wc_btns[$wc_primary_btn]['btn_border_hover'] ) . ';
					}';
					echo '.woocommerce ul.products li.product .added_to_cart, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .added_to_cart {
						background: ' . esc_html( $wc_btns[$wc_secondary_btn]['btn_bg'] ) . ';
						color: ' . esc_html( $wc_btns[$wc_secondary_btn]['btn_color'] ) . ';
						border: 1px solid ' . esc_html( $wc_btns[$wc_secondary_btn]['btn_border'] ) . ';
					}';
					echo '.woocommerce ul.products li.product .added_to_cart:hover, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .added_to_cart:hover {
						color: ' . esc_html( $wc_btns[$wc_secondary_btn]['btn_color_hover'] ) . ';
						background-color: ' . esc_html( $wc_btns[$wc_secondary_btn]['btn_bg_hover'] ) . ';
						border-color: ' . esc_html( $wc_btns[$wc_secondary_btn]['btn_border_hover'] ) . ';
					}';
				}
				// Easy Digital Downloads.
				if ( class_exists( 'Easy_Digital_Downloads' ) ) {
					// primary buttons.
					echo '#edd-purchase-button, .edd-submit, [type="submit"].edd-submit, #edd_checkout_form_wrap input.edd-submit.button.blue {
						background: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_bg'] ) . ';
						color: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_color'] ) . ';
						border: 1px solid ' . esc_html( $wc_btns[$edd_primary_btn]['btn_border'] ) . ';
					}';
					echo '#edd-purchase-button:hover, .edd-submit:hover, [type="submit"].edd-submit:hover, #edd_checkout_form_wrap input.edd-submit.button.blue:hover {
						color: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_color_hover'] ) . ';
						background-color: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_bg_hover'] ) . ';
						border-color: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_border_hover'] ) . ';
					}';
				}
				// bbPress.
				if ( class_exists( 'bbPress' ) ) {
					// primary buttons.
					echo '#bbpress-forums #bbp-search-form #bbp_search_submit,
					#bbpress-forums .bbp-search-form #bbp_search_submit,
					.widget_display_search #bbp-search-form #bbp_search_submit,
					#bbpress-forums.bbpress-wrapper .button.submit,
					#bbpress-forums.bbpress-wrapper #bbp-user-wrapper #bbp-your-profile #password .button {
						background: ' . esc_html( $wc_btns[$bbp_primary_btn]['btn_bg'] ) . ';
						color: ' . esc_html( $wc_btns[$bbp_primary_btn]['btn_color'] ) . ';
						border: 1px solid ' . esc_html( $wc_btns[$bbp_primary_btn]['btn_border'] ) . ';
					}';
					echo '#bbpress-forums #bbp-search-form #bbp_search_submit:hover,
					#bbpress-forums .bbp-search-form #bbp_search_submit:hover,
					.widget_display_search #bbp-search-form #bbp_search_submit:hover,
					#bbpress-forums.bbpress-wrapper .button.submit:hover,
					#bbpress-forums.bbpress-wrapper #bbp-user-wrapper #bbp-your-profile #password .button:hover {
						color: ' . esc_html( $wc_btns[$bbp_primary_btn]['btn_color_hover'] ) . ';
						background-color: ' . esc_html( $wc_btns[$bbp_primary_btn]['btn_bg_hover'] ) . ';
						border-color: ' . esc_html( $wc_btns[$bbp_primary_btn]['btn_border_hover'] ) . ';
					}';
					// Profile search box.
					if ( get_theme_mod( 'conversions_bbp_profile_search', false ) === false ) {
						echo '#bbpress-forums #bbp-user-wrapper .bbp-search-form { display: none; }';
					}
				}
				// Sidebar.
				if ( get_theme_mod( 'conversions_sidebar_mv', true ) === false ) {
					echo '@media (max-width: 767.98px) { #sidebar-2, #sidebar-1 { display: none; } }';
				}
				?>
			</style>
			<?php
		}
	}
}

namespace
{
	/**
	 * Sanitize select option input.
	 *
	 * @since 2019-08-15
	 *
	 * @param string $input Select input.
	 * @param string $setting ID.
	 */
	function conversions_sanitize_select( $input, $setting ) {
		$control = $setting->manager->get_control( $setting->id );
		$valid   = $control->choices;

		// return input if valid or return default option.
		return ( array_key_exists( $input, $valid ) ? $input : $setting->default );
	}

	/**
	 * Sanitize checkbox option input.
	 *
	 * @since 2019-08-15
	 *
	 * @param string $input Checkbox input.
	 */
	function conversions_sanitize_checkbox( $input ) {
		return ( $input === true ) ? true : false;
	}

	/**
	 * Sanitize float option input.
	 *
	 * @since 2019-08-15
	 *
	 * @param string $input Float input.
	 */
	function conversions_sanitize_float( $input ) {
		$input = filter_var( $input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
		return $input;
	}
}
