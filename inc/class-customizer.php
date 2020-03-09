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
			add_action( 'conversions_footer_info', [ $this, 'conversions_footer_social' ], 20 );
			add_action( 'customize_register', [ $this, 'customize_register' ] );
			add_action( 'wp_footer', [ $this, 'wp_footer' ], 100 );
			add_action( 'wp_head', [ $this, 'wp_head' ], 99 );
			add_filter( 'wp_nav_menu_items', [ $this, 'wp_nav_menu_items' ], 10, 2 );
		}

		/**
		 * Footer social icons output.
		 *
		 * @since 2019-08-15
		 */
		public function conversions_footer_social() {

			// get option values and decode.
			$conversions_si         = get_theme_mod( 'conversions_social_icons' );
			$conversions_si_decoded = json_decode( $conversions_si );

			if ( ! empty( $conversions_si_decoded ) ) {

				echo '<div class="social-media-icons col-md"><ul class="list-inline">';

				foreach ( $conversions_si_decoded as $repeater_item ) {

					// remove prefixes for titles and screen reader text.
					$find  = [ '/\bfas \b/', '/\bfab \b/', '/\bfar \b/', '/\bfa-\b/' ];
					$title = preg_replace( $find, '', $repeater_item->icon_value );

					// output the icon and link.
					echo sprintf(
						'<li class="list-inline-item"><a title="%1$s" href="%2$s" target="_blank"><i aria-hidden="true" class="%3$s"></i><span class="sr-only">%1$s</span></a></li>',
						esc_attr( $title ),
						esc_url( $repeater_item->link ),
						esc_attr( $repeater_item->icon_value )
					);
				}

				echo '</ul></div>';

			}

		}

		/**
		 * Customize register function.
		 *
		 * @since 2019-08-15
		 *
		 * @param object $wp_customize The Customizer object.
		 */
		public function customize_register( $wp_customize ) {
			// require customizer repeater.
			// phpcs:disable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require get_parent_theme_file_path( '/inc/class-conversions-repeater.php' );
			// phpcs:enable

			// font choices.
			$font_choices = [
				'Comfortaa:400,700'                       => __( 'Comfortaa', 'conversions' ),
				'Droid Sans:400,700'                      => __( 'Droid Sans', 'conversions' ),
				'Droid Serif:400,700,400italic,700italic' => __( 'Droid Serif', 'conversions' ),
				'Handlee:400'                             => __( 'Handlee', 'conversions' ),
				'Indie Flower:400'                        => __( 'Indie Flower', 'conversions' ),
				'Lato:400,700,400italic,700italic'        => __( 'Lato', 'conversions' ),
				'Libre Baskerville:400,400italic,700'     => __( 'Libre Baskerville', 'conversions' ),
				'Lora:400,700,400italic,700italic'        => __( 'Lora', 'conversions' ),
				'Merriweather:400,300italic,300,400italic,700,700italic' => __( 'Merriweather', 'conversions' ),
				'Open Sans:400italic,700italic,400,700'   => __( 'Open Sans', 'conversions' ),
				'Oxygen:400,300,700'                      => __( 'Oxygen', 'conversions' ),
				'Roboto:400,400italic,700,700italic'      => __( 'Roboto', 'conversions' ),
				'Roboto Slab:400,700'                     => __( 'Roboto Slab', 'conversions' ),
				'Special Elite:400'                       => __( 'Special Elite', 'conversions' ),
				'Ubuntu:400,700,400italic,700italic'      => __( 'Ubuntu', 'conversions' ),
			];

			// button choices.
			$button_choices = [
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
			$extra_button_choices = [
				'no' => __( 'None', 'conversions' ),
			];

			// alt button choices.
			$alt_button_choices = array_merge( $extra_button_choices, $button_choices );

			// gradient choices.
			$gradient_choices = [
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
			// Remove some default sections
			// -----------------------------------------------------
			$wp_customize->get_section( 'colors' )->active_callback           = '__return_false';
			$wp_customize->get_section( 'background_image' )->active_callback = '__return_false';

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
			// Include customizer sections
			// -----------------------------------------------------
			// phpcs:disable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			include get_parent_theme_file_path( '/inc/customizer/navbar.php' );
			include get_parent_theme_file_path( '/inc/customizer/layout.php' );
			include get_parent_theme_file_path( '/inc/customizer/typography.php' );
			include get_parent_theme_file_path( '/inc/customizer/call-to-action.php' );
			include get_parent_theme_file_path( '/inc/customizer/footer-colors.php' );
			include get_parent_theme_file_path( '/inc/customizer/blog.php' );
			include get_parent_theme_file_path( '/inc/customizer/featured-image.php' );
			include get_parent_theme_file_path( '/inc/customizer/woocommerce.php' );
			include get_parent_theme_file_path( '/inc/customizer/homepage.php' );
			include get_parent_theme_file_path( '/inc/customizer/homepage.hero.php' );
			include get_parent_theme_file_path( '/inc/customizer/homepage.clients.php' );
			include get_parent_theme_file_path( '/inc/customizer/homepage.features.php' );
			include get_parent_theme_file_path( '/inc/customizer/homepage.pricing.php' );
			include get_parent_theme_file_path( '/inc/customizer/homepage.testimonials.php' );
			include get_parent_theme_file_path( '/inc/customizer/homepage.news.php' );
			include get_parent_theme_file_path( '/inc/customizer/homepage.woocommerce.php' );
			include get_parent_theme_file_path( '/inc/customizer/homepage.edd.php' );
			include get_parent_theme_file_path( '/inc/customizer/edd.php' );
			// phpcs:enable
		}

		/**
		 * Search modal for nav search icon added to wp_footer.
		 *
		 * @since 2019-08-15
		 */
		public function wp_footer() {
			if ( get_theme_mod( 'conversions_nav_search_icon', false ) === true ) {
				// Add modal window for search.
				$search_form = get_search_form( false );
				echo '<div id="csearchModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="csearchModal__label" aria-hidden="true">',
					'<div class="modal-dialog">',
						'<div class="modal-content">',
							'<div class="modal-header">',
								'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>',
							'</div>',
							'<div class="modal-body">',
								'<h3 id="csearchModal__label" class="modal-title">' . esc_html__( 'Start typing and press enter to search', 'conversions' ) . '</h3>',
								'' . $search_form . '', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'</div>',
						'</div>',
					'</div>',
				'</div>';
			}
		}

		/**
		 * Customizer options styles added to wp_head inline.
		 *
		 * @since 2019-08-15
		 */
		public function wp_head() {
			// font variables.
			if ( get_theme_mod( 'conversions_google_fonts', true ) === true ) {
				// headings.
				$headings_font       = get_theme_mod( 'conversions_headings_fonts', 'Roboto:400,400italic,700,700italic' );
				$heading_font_pieces = explode( ':', $headings_font );
				$headings_font       = $heading_font_pieces[0];
				// body.
				$body_font        = get_theme_mod( 'conversions_body_fonts', 'Roboto:400,400italic,700,700italic' );
				$body_font_pieces = explode( ':', $body_font );
				$body_font        = $body_font_pieces[0];
			} else {
				$headings_font = 'Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont';
				$body_font     = 'Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont';
			}
			// fixed header height calc variables.
			if ( has_custom_logo() ) {
				$logo_height = get_theme_mod( 'conversions_logo_height', '2.5' );
			} else {
				$logo_height = 1.875;
			}
			$nav_tbpadding    = get_theme_mod( 'conversions_nav_tbpadding', '.5' );
			$logo_padding     = .625;
			$total_nav_height = $logo_height + ( $nav_tbpadding * 2 ) + $logo_padding - .1250;
			$nav_offset       = $total_nav_height + 3.125;

			// WC button option.
			$wc_primary_btn   = get_theme_mod( 'conversions_wc_primary_btn', 'btn-outline-primary' );
			$wc_secondary_btn = get_theme_mod( 'conversions_wc_secondary_btn', 'btn-primary' );

			// EDD button option.
			$edd_primary_btn = get_theme_mod( 'conversions_edd_primary_btn', 'btn-primary' );

			// button multidimensional array.
			$wc_btns = [
				'btn-primary'           => [ 'btn_bg' => '#007bff', 'btn_color' => '#fff', 'btn_border' => '#007bff', 'btn_bg_hover' => '#0069d9', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#0069d9' ],
				'btn-secondary'         => [ 'btn_bg' => '#6c757d', 'btn_color' => '#fff', 'btn_border' => '#6c757d', 'btn_bg_hover' => '#5a6268', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#5a6268' ],
				'btn-success'           => [ 'btn_bg' => '#019875', 'btn_color' => '#fff', 'btn_border' => '#019875', 'btn_bg_hover' => '#017258', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#017258' ],
				'btn-danger'            => [ 'btn_bg' => '#dc3545', 'btn_color' => '#fff', 'btn_border' => '#dc3545', 'btn_bg_hover' => '#c82333', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#c82333' ],
				'btn-warning'           => [ 'btn_bg' => '#ffc107', 'btn_color' => '#212529', 'btn_border' => '#ffc107', 'btn_bg_hover' => '#e0a800', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#e0a800' ],
				'btn-info'              => [ 'btn_bg' => '#17a2b8', 'btn_color' => '#fff', 'btn_border' => '#17a2b8', 'btn_bg_hover' => '#138496', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#138496' ],
				'btn-light'             => [ 'btn_bg' => '#f8f9fa', 'btn_color' => '#212529', 'btn_border' => '#f8f9fa', 'btn_bg_hover' => '#e2e6ea', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#e2e6ea' ],
				'btn-dark'              => [ 'btn_bg' => '#151b26', 'btn_color' => '#fff', 'btn_border' => '#151b26', 'btn_bg_hover' => '#07090d', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#07090d' ],
				'btn-outline-primary'   => [ 'btn_bg' => 'transparent', 'btn_color' => '#007bff', 'btn_border' => '#007bff', 'btn_bg_hover' => '#007bff', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#007bff' ],
				'btn-outline-secondary' => [ 'btn_bg' => 'transparent', 'btn_color' => '#6c757d', 'btn_border' => '#6c757d', 'btn_bg_hover' => '#6c757d', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#6c757d' ],
				'btn-outline-success'   => [ 'btn_bg' => 'transparent', 'btn_color' => '#019875', 'btn_border' => '#019875', 'btn_bg_hover' => '#019875', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#019875' ],
				'btn-outline-danger'    => [ 'btn_bg' => 'transparent', 'btn_color' => '#dc3545', 'btn_border' => '#dc3545', 'btn_bg_hover' => '#dc3545', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#dc3545' ],
				'btn-outline-warning'   => [ 'btn_bg' => 'transparent', 'btn_color' => '#ffc107', 'btn_border' => '#ffc107', 'btn_bg_hover' => '#ffc107', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#ffc107' ],
				'btn-outline-info'      => [ 'btn_bg' => 'transparent', 'btn_color' => '#17a2b8', 'btn_border' => '#17a2b8', 'btn_bg_hover' => '#17a2b8', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#17a2b8' ],
				'btn-outline-light'     => [ 'btn_bg' => 'transparent', 'btn_color' => '#f8f9fa', 'btn_border' => '#f8f9fa', 'btn_bg_hover' => '#f8f9fa', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#f8f9fa' ],
				'btn-outline-dark'      => [ 'btn_bg' => 'transparent', 'btn_color' => '#151b26', 'btn_border' => '#151b26', 'btn_bg_hover' => '#151b26', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#151b26' ],
			];

			$mods = [
				[ 'a.navbar-brand img', 'max-height', get_theme_mod( 'conversions_logo_height' ), 'rem' ],
				[ '.navbar', 'padding-top', get_theme_mod( 'conversions_nav_tbpadding' ), 'rem' ],
				[ '.navbar', 'padding-bottom', get_theme_mod( 'conversions_nav_tbpadding' ), 'rem' ],
				[ 'footer.site-footer', 'background-color', get_theme_mod( 'conversions_footer_bg_color' ) ],
				[ 'footer.site-footer .h1, footer.site-footer .h2, footer.site-footer .h3, footer.site-footer .h4, footer.site-footer .h5, footer.site-footer .h6, footer.site-footer h1, footer.site-footer h2, footer.site-footer h3, footer.site-footer h4, footer.site-footer h5, footer.site-footer h6, footer.site-footer p, footer.site-footer table, footer.site-footer li, footer.site-footer caption, footer.site-footer .site-info .copyright', 'color', get_theme_mod( 'conversions_footer_text_color' ) ],
				[ 'footer.site-footer a, footer.site-footer .site-info .copyright a, footer.site-footer .social-media-icons ul li.list-inline-item i', 'color', get_theme_mod( 'conversions_footer_link_color' ) ],
				[ 'footer.site-footer a:hover, footer.site-footer .site-info .copyright a:hover, footer.site-footer .social-media-icons ul li.list-inline-item i:hover', 'color', get_theme_mod( 'conversions_footer_link_hcolor' ) ],
				[ 'a', 'color', get_theme_mod( 'conversions_link_color' ) ],
				[ 'a:hover', 'color', get_theme_mod( 'conversions_link_hcolor' ) ],
				[ '.conversions-hero-cover .conversions-hero-cover__inner h1', 'color', get_theme_mod( 'conversions_featured_title_color' ) ],
				[ '.page-template-homepage section.c-hero h1', 'color', get_theme_mod( 'conversions_hh_title_color' ) ],
				[ '.page-template-homepage section.c-hero .c-hero__description', 'color', get_theme_mod( 'conversions_hh_desc_color' ) ],
				[ '.page-template-homepage section.c-clients', 'background-color', get_theme_mod( 'conversions_hc_bg_color' ) ],
				[ 'section.c-clients img.client', 'max-width', get_theme_mod( 'conversions_hc_logo_width' ), 'rem' ],
				[ 'section.c-cta h2', 'color', get_theme_mod( 'conversions_hcta_title_color' ) ],
				[ 'section.c-cta p.subtitle', 'color', get_theme_mod( 'conversions_hcta_desc_color' ) ],
				[ '.page-template-homepage section.c-news', 'background-color', get_theme_mod( 'conversions_news_bg_color' ) ],
				[ '.page-template-homepage section.c-news h2', 'color', get_theme_mod( 'conversions_news_title_color' ) ],
				[ '.page-template-homepage section.c-news p.subtitle', 'color', get_theme_mod( 'conversions_news_desc_color' ) ],
				[ '.page-template-homepage section.c-testimonials', 'background-color', get_theme_mod( 'conversions_testimonials_bg_color' ) ],
				[ '.page-template-homepage section.c-testimonials h2', 'color', get_theme_mod( 'conversions_testimonials_title_color' ) ],
				[ '.page-template-homepage section.c-testimonials p.subtitle', 'color', get_theme_mod( 'conversions_testimonials_desc_color' ) ],
				[ '.page-template-homepage section.c-pricing', 'background-color', get_theme_mod( 'conversions_pricing_bg_color' ) ],
				[ '.page-template-homepage section.c-pricing h2', 'color', get_theme_mod( 'conversions_pricing_title_color' ) ],
				[ '.page-template-homepage section.c-pricing p.subtitle', 'color', get_theme_mod( 'conversions_pricing_desc_color' ) ],
				[ '.page-template-homepage section.c-features', 'background-color', get_theme_mod( 'conversions_features_bg_color' ) ],
				[ '.page-template-homepage section.c-features h2, section.c-features .card h3', 'color', get_theme_mod( 'conversions_features_title_color' ) ],
				[ '.page-template-homepage section.c-features p.subtitle, section.c-features .card .c-features__block-desc', 'color', get_theme_mod( 'conversions_features_desc_color' ) ],
				[ '.conversions-hero-cover', 'min-height', get_theme_mod( 'conversions_featured_img_height' ), 'vh' ],
				[ '.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6', 'font-family', $headings_font ],
				[ 'body, input, select, textarea', 'font-family', $body_font ],
				[ '#wrapper-footer .social-media-icons ul li.list-inline-item i', 'font-size', get_theme_mod( 'conversions_social_size' ), 'rem' ],
				[ '.page-template-homepage section.c-hero', 'min-height', get_theme_mod( 'conversions_hh_img_height' ), 'vh' ],
				[ '.page-template-homepage section.c-woo', 'background-color', get_theme_mod( 'conversions_woo_bg_color' ) ],
				[ '.page-template-homepage section.c-woo h2', 'color', get_theme_mod( 'conversions_woo_title_color' ) ],
				[ '.page-template-homepage section.c-woo p.subtitle', 'color', get_theme_mod( 'conversions_woo_desc_color' ) ],
				[ '.page-template-homepage section.c-edd', 'background-color', get_theme_mod( 'conversions_edd_bg_color' ) ],
				[ '.page-template-homepage section.c-edd h2', 'color', get_theme_mod( 'conversions_edd_title_color' ) ],
				[ '.page-template-homepage section.c-edd p.subtitle', 'color', get_theme_mod( 'conversions_edd_desc_color' ) ],
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
					echo '.content-wrapper {
							margin-top: ' . esc_html( $total_nav_height ) . 'rem;
					}';
					echo '.wrapper :target:before, .wrapper li[id].comment:before {
						display: block;
						content: " ";
						margin-top: -' . esc_html( $nav_offset ) . 'rem;
						height: ' . esc_html( $nav_offset ) . 'rem;
						visibility: hidden;
						pointer-events: none;
					}';
				}
				// Navbar drop shadow.
				if ( get_theme_mod( 'conversions_nav_dropshadow', false ) === true ) {
					echo '#wrapper-navbar {
						box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
					}';
				}
				// Featured image.
				if ( get_theme_mod( 'conversions_featured_img_parallax', false ) === true ) {
					echo '.conversions-hero-cover {
						background-attachment: fixed;
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
					echo '#edd-purchase-button, .edd-submit, [type="submit"].edd-submit {
						background: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_bg'] ) . ';
						color: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_color'] ) . ';
						border: 1px solid ' . esc_html( $wc_btns[$edd_primary_btn]['btn_border'] ) . ';
					}';
					echo '#edd-purchase-button:hover, .edd-submit:hover, [type="submit"].edd-submit:hover {
						color: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_color_hover'] ) . ';
						background-color: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_bg_hover'] ) . ';
						border-color: ' . esc_html( $wc_btns[$edd_primary_btn]['btn_border_hover'] ) . ';
					}';
				}
				// Sidebar.
				if ( get_theme_mod( 'conversions_sidebar_mv', true ) === false ) {
					echo '@media (max-width: 767.98px) { #sidebar-2, #sidebar-1 { display: none; } }';
				}
				// Homepage hero.
				if ( get_theme_mod( 'conversions_hh_img_parallax', false ) === true ) {
					echo '.page-template-homepage section.c-hero {
						background-attachment: fixed;
					}';
				}
				// Homepage news.
				if ( get_theme_mod( 'conversions_news_mposts', '2' ) == 1 ) {
					echo '@media (max-width: 991.98px) {
						section.c-news #c-news__1,
						section.c-news #c-news__2 {
							display: none;
						}
					}';
				}
				if ( get_theme_mod( 'conversions_news_mposts', '2' ) == 2 ) {
					echo '@media (max-width: 991.98px) {
						section.c-news #c-news__2 {
							display: none;
						}
					}';
				}
				?>
			</style>
			<?php
		}

		/**
		 * Add menu items from customizer options.
		 *
		 * @since 2019-08-15
		 *
		 * @param string $items Menu items.
		 * @param string $args Arguments.
		 */
		public function wp_nav_menu_items( $items, $args ) {
			if ( $args->theme_location === 'primary' ) {

				// Is woocommerce is active?
				if ( class_exists( 'woocommerce' ) ) {

					// Append WooCommerce Cart icon?
					if ( get_theme_mod( 'conversions_wc_cart_nav', true ) === true ) {
						// get WC cart totals and if = 0 only show icon with no text.
						$cart_totals = WC()->cart->get_cart_contents_count();
						if ( WC()->cart->get_cart_contents_count() > 0 ) {
							$cart_totals = sprintf(
								'%s<span class="sr-only">' . __( ' items in your shopping cart', 'conversions' ) . '</span>',
								WC()->cart->get_cart_contents_count()
							);
						} else {
							$cart_totals = '<span class="sr-only">' . __( 'View your shopping cart', 'conversions' ) . '</span>';
						}
						// output the cart icon with item count.
						$cart_link = sprintf(
							'<li class="cart menu-item nav-item"><a title="' . __( 'View your shopping cart', 'conversions' ) . '" class="cart-customlocation nav-link" href="%s"><i aria-hidden="true" class="fas fa-shopping-bag"></i>%s</a></li>',
							wc_get_cart_url(),
							$cart_totals
						);
						// Add the cart icon to the end of the menu.
						$items = $items . $cart_link;
					}

					// Append WooCommerce Account icon?
					if ( get_theme_mod( 'conversions_wc_account', false ) === true ) {

						if ( is_user_logged_in() ) {
							$wc_al = __( 'My Account', 'conversions' );
						} else {
							$wc_al = __( 'Login / Register', 'conversions' );
						}
						// output the account icon if active.
						$wc_account_link = sprintf(
							'<li class="account-icon menu-item nav-item"><a href="%1$s" class="nav-link" title="%2$s"><i aria-hidden="true" class="fas fa-user"></i><span class="sr-only">%2$s</span></a></li>',
							esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ),
							$wc_al
						);

						// Add the account to the end of the menu.
						$items = $items . $wc_account_link;
					}
				}

				// Is Easy Digital Downloads active?
				if ( class_exists( 'Easy_Digital_Downloads' ) ) {

					// Append Easy Digital Downloads Cart icon?
					if ( get_theme_mod( 'conversions_edd_nav_cart', true ) === true ) {

						$edd_cart_totals = sprintf(
							'<span class="header-cart edd-cart-quantity">%s</span><span class="sr-only">' . __( 'View your shopping cart', 'conversions' ) . '</span>',
							edd_get_cart_quantity()
						);

						// output the cart icon with item count.
						$edd_cart_link = sprintf(
							'<li class="cart menu-item nav-item"><a title="' . __( 'View your shopping cart', 'conversions' ) . '" class="cart-customlocation nav-link" href="%s"><i aria-hidden="true" class="fas fa-shopping-bag"></i>%s</a></li>',
							esc_url( edd_get_checkout_uri() ),
							$edd_cart_totals
						);

						// Add the cart icon to the end of the menu.
						$items = $items . $edd_cart_link;
					}

					// Append Easy Digital Downloads Account icon?
					if ( get_theme_mod( 'conversions_edd_nav_account', false ) === true ) {

						if ( is_user_logged_in() ) {
							$edd_al = __( 'My Account', 'conversions' );
						} else {
							$edd_al = __( 'Login / Register', 'conversions' );
						}
						// output the account icon if active.
						$edd_account_link = sprintf(
							'<li class="account-icon menu-item nav-item"><a href="%1$s" class="nav-link" title="%2$s"><i aria-hidden="true" class="fas fa-user"></i><span class="sr-only">%2$s</span></a></li>',
							esc_url( edd_get_user_verification_page() ),
							$edd_al
						);

						// Add the account to the end of the menu.
						$items = $items . $edd_account_link;
					}
				}

				// Append Search Icon to nav? Separate function coversions_nav_search_modal adds modal html to footer.
				if ( get_theme_mod( 'conversions_nav_search_icon', false ) === true ) {
					$nav_search = sprintf(
						'<li class="search-icon menu-item nav-item"><a href="#csearchModal" data-toggle="modal" class="nav-link" title="%1$s"><i aria-hidden="true" class="fas fa-search"></i><span class="sr-only">%1$s</span></a></li>',
						__( 'Search', 'conversions' )
					);

					// Add the nav button to the end of the menu.
					$items = $items . $nav_search;
				}

				// Append Navigation Button?
				if ( get_theme_mod( 'conversions_nav_button', 'no' ) !== 'no' ) {

					$nav_btn_text = get_theme_mod( 'conversions_nav_button_text' );
					if ( empty( $nav_btn_text ) ) {
						$nav_btn_text = '';
					}
					$nav_btn_url = get_theme_mod( 'conversions_nav_button_url' );
					if ( empty( $nav_btn_url ) ) {
						$nav_btn_url = '';
					}

					$nav_button = sprintf(
						'<li class="nav-callout-button menu-item nav-item"><a title="%1$s" href="%2$s" class="btn %3$s">%1$s</a></li>',
						esc_html( $nav_btn_text ),
						esc_url( $nav_btn_url ),
						esc_attr( get_theme_mod( 'conversions_nav_button' ) )
					);

					// Add the nav button to the end of the menu.
					$items = $items . $nav_button;
				}
			}
			return $items;
		}
	}
	conversions()->customizer = new Customizer();
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

	/**
	 * Sanitize repeater option input.
	 *
	 * @since 2019-08-15
	 *
	 * @param string $input Repeater input.
	 */
	function conversions_repeater_sanitize( $input ) {
		$input_decoded = json_decode( $input, true );
		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $boxk => $box ) {
				foreach ( $box as $key => $value ) {
					$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
				}
			}
			return json_encode( $input_decoded );
		}
		return $input;
	}

	/**
	 * Filter to modify input label for repeater controls.
	 *
	 * @since 2019-08-15
	 *
	 * @param string $string String.
	 * @param string $id Control ID.
	 * @param string $control Control name.
	 */
	function conversions_repeater_labels( $string, $id, $control ) {

		// testimonial repeater labels.
		if ( $id === 'conversions_testimonials_repeater' ) {
			if ( $control === 'customizer_repeater_title_control' ) {
				return esc_html__( 'Full name', 'conversions' );
			}
			if ( $control === 'customizer_repeater_subtitle_control' ) {
				return esc_html__( 'Company name', 'conversions' );
			}
			if ( $control === 'customizer_repeater_text_control' ) {
				return esc_html__( 'Testimonial text', 'conversions' );
			}
		}

		// pricing table repeater labels.
		if ( $id === 'conversions_pricing_repeater' ) {
			if ( $control === 'customizer_repeater_subtitle_control' ) {
				return esc_html__( 'Price', 'conversions' );
			}
			if ( $control === 'customizer_repeater_subtitle2_control' ) {
				return esc_html__( 'Duration', 'conversions' );
			}
		}

		return $string;
	}
	add_filter( 'repeater_input_labels_filter', 'conversions_repeater_labels', 10, 3 );
}
