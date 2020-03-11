<?php
/**
 * Homepage template functions.
 *
 * @package conversions
 */

namespace conversions;

/**
 * Class Homepage
 *
 * - Handles the display of the various homepage sections.
 *
 * @since 2019-12-16
 */
class Homepage {
	/**
	 * The sections available.
	 *
	 * @since 2019-12-16
	 * @var array $sections
	 */
	public static $sections;

	/**
	 * The key where we store our data.
	 *
	 * @since 2019-12-16
	 * @var string $theme_mod_key
	 */
	public static $theme_mod_key = 'conversions_homepage_sorting';

	/**
	 * Class constructor.
	 *
	 * @since 2019-12-16
	 */
	public function __construct() {
		static::$sections = [
			'hero'         => [
				'title' => __( 'Hero', 'conversions' ),
			],
			'clients'      => [
				'title' => __( 'Clients', 'conversions' ),
			],
			'features'     => [
				'title' => __( 'Features', 'conversions' ),
			],
			'woocommerce'  => [
				'title' => __( 'WooCommerce', 'conversions' ),
			],
			'edd'          => [
				'title' => __( 'Easy Digital Downloads', 'conversions' ),
			],
			'pricing'      => [
				'title' => __( 'Pricing tables', 'conversions' ),
			],
			'testimonials' => [
				'title' => __( 'Testimonials', 'conversions' ),
			],
			'news'         => [
				'title' => __( 'News', 'conversions' ),
			],
		];

		if ( ! class_exists( 'woocommerce' ) ) {
			unset( static::$sections[ 'woocommerce' ] );
		}

		if ( ! class_exists( 'Easy_Digital_Downloads' ) ) {
			unset( static::$sections[ 'edd' ] );
		}

		$this->add_sections();
		add_action( 'get_header', [ $this, 'add_sections' ] );
		add_filter( 'customize_register', [ $this, 'customize_register' ] );
	}

	/**
	 * Adds the homepage sections to the homepage action.
	 *
	 * @since 2019-12-16
	 */
	public function add_sections() {
		remove_all_actions( 'homepage' );

		$sections = static::get_sorted_sections();
		$counter  = 1;
		foreach ( $sections as $section_id => $section ) {
			if ( isset( $section[ 'disabled' ] ) )
				continue;
			add_action( 'homepage', [ $this, $section_id ], $counter * 100 );
			$counter++;
		}
	}

	/**
	 * Add ourselves to the customizer.
	 *
	 * @since 2019-12-16
	 *
	 * @param object $wp_customize The Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$wp_customize->add_section(
			static::$theme_mod_key,
			[
				'panel'    => 'conversions_homepage',
				'priority' => 80,
				'title'    => __( 'Homepage sorting', 'conversions' ),
			]
		);

		$wp_customize->add_setting(
			static::$theme_mod_key,
			[
				'capability'        => 'edit_theme_options',
				'default'           => get_theme_mod( static::$theme_mod_key ),
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			]
		);

		// phpcs:disable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_parent_theme_file_path( '/inc/class-homepage-sorting-customizer-control.php' );
		// phpcs:enable

		$theme = wp_get_theme();

		$wp_customize->add_control(
			new Homepage_Sorting_Customizer_Control(
				$wp_customize,
				static::$theme_mod_key,
				[
					'priority' => 10,
					'section'  => static::$theme_mod_key,
					'settings' => static::$theme_mod_key,
					'type'     => 'hidden',
				]
			)
		);
	}

	/**
	 * Return the array of client logos.
	 *
	 * @since 2019-12-19
	 */
	public function get_client_logos() {
		$client_logos         = get_theme_mod( 'conversions_hc_logos' );
		$client_logos_decoded = json_decode( $client_logos );
		if ( ! $client_logos_decoded)
			return false;
		$has_logos = ( $client_logos_decoded[ 0 ]->image_url != '' );
		if ( ! $has_logos )
			return false;
		return $client_logos_decoded;
	}

	/**
	 * Return an array of feature blocks.
	 *
	 * @since 2019-12-19
	 */
	public function get_features() {
		// Get all feature blocks.
		$features         = get_theme_mod( 'conversions_features_icons' );
		$features_decoded = json_decode( $features );
		if ( ! $features_decoded )
			return false;
		$has_features = ( $features_decoded[ 0 ]->icon_value != '' || $features_decoded[ 0 ]->title != '' );
		if ( ! $has_features )
			return false;
		return $features_decoded;
	}

	/**
	 * Return the latest news.
	 *
	 * @since 2019-12-19
	 */
	public function get_news() {
		// Get latest posts.
		$args = [
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 3,
			'orderby'             => 'date',
			'order'               => 'DESC',
			'ignore_sticky_posts' => 1,
		];

		$news = new \WP_Query( $args );
		if ( ! $news->have_posts() )
			return false;

		return $news;
	}

	/**
	 * Return the pricing blocks.
	 *
	 * @since 2019-12-19
	 */
	public function get_pricing() {
		// Get all pricing tables.
		$pricing = get_theme_mod( 'conversions_pricing_repeater' );
		$pricing = json_decode( $pricing );

		if ( ! $pricing )
			return false;

		$has_pricing = ( $pricing[ 0 ]->title != '' || $pricing[ 0 ]->subtitle != '' );

		if ( ! $has_pricing )
			return false;

		return $pricing;
	}

	/**
	 * Return the sections array but sorted as per the user's sorting.
	 *
	 * @since 2019-12-16
	 */
	public static function get_sorted_sections() {
		$sections = static::$sections;
		$options  = get_theme_mod( static::$theme_mod_key );

		if ( $options != '' ) {
			$options      = explode( ',', $options );
			$new_sections = [];
			foreach ( $options as $section ) {
				if ( isset( $sections[ $section ] ) ) {
					$new_sections[ $section ] = $sections[ $section ];
					unset( $sections[ $section ] );
				}
			}

			// Add whatever sections are left as disabled at the end.
			foreach ( $sections as $section_id => $section ) {
				$section[ 'disabled' ]       = true;
				$new_sections[ $section_id ] = $section;
			}
			$sections = $new_sections;
		}

		return $sections;
	}

	/**
	 * Return the testimonials array.
	 *
	 * @since 2019-12-19
	 */
	public function get_testimonials() {
		$testimonials = get_theme_mod( 'conversions_testimonials_repeater' );
		$testimonials = json_decode( $testimonials );

		if ( ! $testimonials )
			return false;

		$has_testimonials = ( $testimonials[ 0 ]->title != '' || $testimonials[ 0 ]->text != '' );

		if ( ! $has_testimonials )
			return false;

		return $testimonials;
	}

	// -------------------
	// SECTIONS BELOW HERE
	// -------------------

	/**
	 * Hero section.
	 *
	 * @since 2019-12-16
	 */
	public function hero() {
		?>
	<!-- Hero Section -->
	<section class="c-hero d-flex align-items-center">
		<div class="container-fluid">
			<div class="row">
				<div class="<?php echo esc_attr( get_theme_mod( 'conversions_hh_content_position' ) ); ?>">

					<!-- Title -->
					<h1><?php echo esc_html( get_the_title() ); ?></h1>

					<?php
					if ( ! empty( get_theme_mod( 'conversions_hh_desc' ) ) ) {
						echo '<p class="lead c-hero__description">' . wp_kses_post( get_theme_mod( 'conversions_hh_desc' ) ) . '</p>';
					}

					if ( ( get_theme_mod( 'conversions_hh_button', 'no' ) !== 'no' ) || ( get_theme_mod( 'conversions_hh_vbtn', 'no' ) !== 'no' ) ) :

						// Button links.
						echo '<p class="lead">';

						// callout button.
						if ( get_theme_mod( 'conversions_hh_button', 'no' ) !== 'no' ) {
							echo sprintf(
								'<a href="%s" class="btn %s btn-lg c-hero__callout-btn">%s</a>',
								esc_url( get_theme_mod( 'conversions_hh_button_url' ) ),
								esc_attr( get_theme_mod( 'conversions_hh_button' ) ),
								esc_html( get_theme_mod( 'conversions_hh_button_text' ) )
							);
						}

						// video modal.
						if ( get_theme_mod( 'conversions_hh_vbtn', 'no' ) !== 'no' ) {

							echo sprintf(
								'<a data-src="%1$s" data-toggle="modal" data-target="#c-hero-modal" href="#" class="c-hero__fb-video"><span class="c-hero__video-btn btn btn-%2$s btn--circle"><i class="fa fa-play"></i></span><span class="c-hero__video-text btn btn-link text-%2$s">%3$s</span></a>',
								esc_url( 'https://www.youtube.com/embed/' . get_theme_mod( 'conversions_hh_vbtn_url' ) ),
								esc_attr( get_theme_mod( 'conversions_hh_vbtn' ) ),
								esc_html( get_theme_mod( 'conversions_hh_vbtn_text' ) )
							);
							?>

							<!-- Modal -->
							<div class="modal fade" id="c-hero-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-body">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<!-- 16:9 aspect ratio -->
											<div class="embed-responsive embed-responsive-16by9">
												<iframe class="embed-responsive-item" src="" id="video" allow="autoplay" allowfullscreen></iframe>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
						}

						echo '</p>';

					endif;
					?>

				</div>
			</div>
		</div>
	</section>
		<?php
	}

	/**
	 * Content for the clients section.
	 *
	 * @since 2019-12-19
	 */
	public function clients_content() {
		$client_logos = $this->get_client_logos();
		if ( ! $client_logos )
			return;

		// We want to capture the output so that we can return it.
		ob_start();
		?>
				<div class="col-12">

					<?php
					$chc_max_slides = get_theme_mod( 'conversions_hc_max', '5' );
					$chc_logo_width = ( get_theme_mod( 'conversions_hc_logo_width', '6.2' ) * 16 ) + 40;

					if ( get_theme_mod( 'conversions_hc_respond', 'auto' ) === 'auto' ) {

						$chc_breakpoints = ['768', '576', '375'];

						foreach ( $chc_breakpoints as $s ) {
							$n = floor( $s / $chc_logo_width );
							if ( $n > $chc_max_slides ) {
								$n = $chc_max_slides;
							} elseif ( $n < 1 ) {
								$n = 1;
							}
							$chc_items_to_show[] = $n;
						}
					} else {
						$chc_items_to_show = [
							'' . esc_html( get_theme_mod( 'conversions_hc_lg', '4' ) ) . '',
							'' . esc_html( get_theme_mod( 'conversions_hc_md', '3' ) ) . '',
							'' . esc_html( get_theme_mod( 'conversions_hc_sm', '2' ) ) . '',
						];
					}
					?>

					<!-- Client logos -->
					<div class='c-clients__carousel py-4' data-slick='{"arrows":true,"dots":false,"infinite":true,"slidesToShow":<?php echo esc_attr( get_theme_mod( 'conversions_hc_max', '5' ) ); ?>,"slidesToScroll":<?php echo esc_attr( get_theme_mod( 'conversions_hc_max', '5' ) ); ?>,"responsive":[{"breakpoint":992,"settings":{"slidesToShow":<?php echo esc_attr( $chc_items_to_show[0] ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_items_to_show[0] ); ?>}},{"breakpoint":768,"settings":{"slidesToShow":<?php echo esc_attr( $chc_items_to_show[1] ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_items_to_show[1] ); ?>}},{"breakpoint":576,"settings":{"slidesToShow":<?php echo esc_attr( $chc_items_to_show[2] ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_items_to_show[2] ); ?>}}]}'>

						<?php
						$cclient_logo_count = 0;
						foreach ( $client_logos as $chc_logo ) {
							// Retrieve img id.
							$chc_url     = $chc_logo->image_url;
							$chc_logo_id = conversions()->template->conversions_id_by_url( $chc_url );
							// Retrieve the correct img size.
							$chc_logo_med = wp_get_attachment_image_src( $chc_logo_id, 'medium' );
							// Retrieve the alt text.
							$chc_logo_alt = get_post_meta( $chc_logo_id, '_wp_attachment_image_alt', true );

							echo '<div class="c-clients__item px-3" id="c-clients__' . esc_attr( $cclient_logo_count ) . '">
								<img class="client" src="' . esc_url( $chc_logo_med[0] ) . '" alt="' . esc_html( $chc_logo_alt ) . '">
							</div>';

							++$cclient_logo_count;
						}
						?>
					</div>

				</div>
		<?php
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Clients section.
	 *
	 * @since 2019-12-16
	 */
	public function clients() {
		$client_logos = $this->get_client_logos();
		if ( ! $client_logos )
			return;
		?>
	<!-- Clients section -->
	<section class="c-clients">
		<div class="container-fluid">
			<div class="row">

				<?php
					do_action( 'conversions_homepage_before_clients' );
					echo $this->clients_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					do_action( 'conversions_homepage_after_clients' );
				?>

			</div>
		</div>
	</section>
		<?php
	}

	/**
	 * Return the features content.
	 *
	 * @since 2019-12-19
	 */
	public function features_content() {
		$features = $this->get_features();
		if ( ! $features )
			return;

		// We want to capture the output so that we can return it.
		ob_start();

		$cfeature_block_count = 0;

		foreach ( $features as $repeater_item ) {
			// How many to show per row.
			$conversions_features_sm = get_theme_mod( 'conversions_features_sm', '2' );
			$conversions_features_md = get_theme_mod( 'conversions_features_md', '2' );
			$conversions_features_lg = get_theme_mod( 'conversions_features_lg', '3' );

			// # per row to bootstrap grid.
			$cfri = array(
				'1' => '12',
				'2' => '6',
				'3' => '4',
				'4' => '3',
			);

			// Feature block.
			echo '<div id="c-features__block-' . esc_attr( $cfeature_block_count ) . '" class="c-features__block col-sm-' . esc_attr( $cfri[$conversions_features_sm] ) . ' col-md-' . esc_attr( $cfri[$conversions_features_md] ) . ' col-lg-' . esc_attr( $cfri[$conversions_features_lg] ) . '">';

			echo '<div class="card border-0 h-100"><div class="card-body p-2">';

			if ( ! empty( $repeater_item->icon_value ) ) {
				if ( ! empty( $repeater_item->color ) ) {
					echo '<span class="c-features__block-icon"><i class="' . esc_attr( $repeater_item->icon_value ) . ' mb-3" aria-hidden="true" style="color:' . esc_attr( $repeater_item->color ) . ';"></i></span>';
				} else {
					echo '<span class="c-features__block-icon"><i class="' . esc_attr( $repeater_item->icon_value ) . ' mb-3" aria-hidden="true"></i></span>';
				}
			}

			if ( ! empty( $repeater_item->title ) ) {
				echo '<h3 class="h5">' . esc_html( $repeater_item->title ) . '</h3>';
			}

			if ( ! empty( $repeater_item->text ) ) {
				echo '<p class="c-features__block-desc">' . esc_html( $repeater_item->text ) . '</p>';
			}

			if ( ! empty( $repeater_item->linktext ) ) {
				echo sprintf(
					'<a class="c-features__block-link" href="%s">%s</a>',
					esc_url( $repeater_item->link ),
					esc_html( $repeater_item->linktext )
				);
			}

			echo '</div></div></div>';

			++$cfeature_block_count;
		}

		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Features section.
	 *
	 * @since 2019-12-16
	 */
	public function features() {
		$features = $this->get_features();
		if ( ! $features )
			return;
		?>
	<!-- Features section -->
	<section class="c-features">
		<div class="container-fluid">
			<div class="row">

				<?php

				if ( ! empty( get_theme_mod( 'conversions_features_title' ) ) || ! empty( get_theme_mod( 'conversions_features_desc' ) ) ) {
					?>

					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( get_theme_mod( 'conversions_features_title' ) ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_features_title' ) ) . '</h2>';
							}
							if ( ! empty( get_theme_mod( 'conversions_features_desc' ) ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_features_desc' ) ) . '</p>';
							}
							?>
						</div>
					</div>

					<?php
				}

				do_action( 'conversions_homepage_before_features' );
				echo $this->features_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				do_action( 'conversions_homepage_after_features' );

				?>

			</div>
		</div>
	</section>
		<?php
	}

	/**
	 * WooCommerce section.
	 *
	 * @since 2019-12-16
	 */
	public function woocommerce() {
		// Check whether to show Woo section.
		if ( ! class_exists( 'woocommerce' ) )
			return;
		if ( get_theme_mod( 'conversions_woo_products' ) === 'no' )
			return;
		?>
	<!-- WooCommerce section -->
	<section class="c-woo">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( get_theme_mod( 'conversions_woo_title' ) ) || ! empty( get_theme_mod( 'conversions_woo_desc' ) ) ) { ?>

					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( get_theme_mod( 'conversions_woo_title' ) ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_woo_title' ) ) . '</h2>';
							}
							if ( ! empty( get_theme_mod( 'conversions_woo_desc' ) ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_woo_desc' ) ) . '</p>';
							}
							?>
						</div>
					</div>

				<?php } ?>

				<?php do_action( 'conversions_homepage_before_woo_products' ); ?>

				<div class="col-12">
					<?php
					$c_product_type = get_theme_mod( 'conversions_woo_products' );
					if ( $c_product_type === 'all' ) {
						$c_product_type = '';
					} else {
						$c_product_type = esc_attr( $c_product_type ) . '="true"';
					}
					$c_product_limit   = get_theme_mod( 'conversions_woo_product_limit' );
					$c_product_columns = get_theme_mod( 'conversions_woo_product_columns' );
					$c_product_order   = get_theme_mod( 'conversions_woo_products_order' );

					echo do_shortcode( '[products limit="' . esc_attr( $c_product_limit ) . '" columns="' . esc_attr( $c_product_columns ) . '" orderby="' . esc_attr( $c_product_order ) . '" ' . $c_product_type . ' ]' );
					?>
				</div>

				<?php do_action( 'conversions_homepage_after_woo_products' ); ?>

			</div>
		</div>
	</section>
		<?php
	}

	/**
	 * Easy Digital Downloads section.
	 *
	 * @since 2020-01-21
	 */
	public function edd() {
		// Check whether to show EDD section.
		if ( ! class_exists( 'Easy_Digital_Downloads' ) )
			return;
		if ( get_theme_mod( 'conversions_edd_products' ) === 'no' )
			return;
		?>
	<!-- Easy Digital Downloads section -->
	<section class="c-edd">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( get_theme_mod( 'conversions_edd_title' ) ) || ! empty( get_theme_mod( 'conversions_edd_desc' ) ) ) { ?>

					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( get_theme_mod( 'conversions_edd_title' ) ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_edd_title' ) ) . '</h2>';
							}
							if ( ! empty( get_theme_mod( 'conversions_edd_desc' ) ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_edd_desc' ) ) . '</p>';
							}
							?>
						</div>
					</div>

				<?php } ?>

				<?php do_action( 'conversions_homepage_before_edd_products' ); ?>

				<div class="col-12">
					<?php
					$edd_product_type = get_theme_mod( 'conversions_edd_products' );
					if ( $edd_product_type === 'all' ) {
						$edd_product_type = '';
					} elseif ( $edd_product_type === 'category' ) {
						$edd_product_type = 'category="' . esc_attr( get_theme_mod( 'conversions_edd_product_tax' ) ) . '"';
					} elseif ( $edd_product_type === 'tags' ) {
						$edd_product_type = 'tags="' . esc_attr( get_theme_mod( 'conversions_edd_product_tax' ) ) . '"';
					}
					$edd_product_limit   = get_theme_mod( 'conversions_edd_product_limit' );
					$edd_product_columns = get_theme_mod( 'conversions_edd_product_columns' );
					$edd_product_orderby = get_theme_mod( 'conversions_edd_products_orderby' );
					$edd_product_order   = get_theme_mod( 'conversions_edd_products_order' );

					echo do_shortcode( '[downloads pagination="false" number="' . esc_attr( $edd_product_limit ) . '" columns="' . esc_attr( $edd_product_columns ) . '" orderby="' . esc_attr( $edd_product_orderby ) . '" order="' . esc_attr( $edd_product_order ) . '" ' . $edd_product_type . ' ]' );
					?>
				</div>

				<?php do_action( 'conversions_homepage_after_edd_products' ); ?>

			</div>
		</div>
	</section>
		<?php
	}

	/**
	 * Return the pricing content.
	 *
	 * @since 2019-12-19
	 */
	public function pricing_content() {
		$pricing = $this->get_pricing();
		if ( ! $pricing )
			return;

		// We want to capture the output so that we can return it.
		ob_start();
		if ( get_theme_mod( 'conversions_pricing_respond', 'auto' ) === 'auto' ) {
			// Count pricing tables in loop.
			$cpt_total_count = count( $pricing );
			// Auto calc columns.
			$conversions_pricing_sm = 12;
			$conversions_pricing_md = 12;
			$conversions_pricing_lg = conversions()->template->auto_col_calc( $cpt_total_count );
		} else {
			// # per row to bootstrap grid.
			$cpri = array(
				'1' => '12',
				'2' => '5',
				'3' => '4',
				'4' => '3',
			);
			// manual options per row.
			$conversions_pricing_sm = $cpri[get_theme_mod( 'conversions_pricing_sm', '1' )];
			$conversions_pricing_md = $cpri[get_theme_mod( 'conversions_pricing_md', '1' )];
			$conversions_pricing_lg = $cpri[get_theme_mod( 'conversions_pricing_lg', '3' )];
		}

		$cpricing_table_count = 0;

		foreach ( $pricing as $repeater_item ) {

			// Pricing table.
			echo '<div id="c-pricing__table-' . esc_attr( $cpricing_table_count ) . '" class="c-pricing__table col-sm-' . esc_attr( $conversions_pricing_sm ) . ' col-md-' . esc_attr( $conversions_pricing_md ) . ' col-lg-' . esc_attr( $conversions_pricing_lg ) . '">';
			?>

				<div class="card shadow h-100">
					<header class="card-header">
						<h4 class="h5 text-secondary mb-3">
							<?php
								// Plan title.
								echo esc_html( $repeater_item->title );
							?>
						</h4>
						<span class="d-block">
							<span class="display-4">
								<?php
									// Plan price.
									echo esc_html( $repeater_item->subtitle );
								?>
							</span>
							<span class="d-block text-secondary">
								<?php
									// Plan duration.
									echo esc_html( $repeater_item->subtitle2 );
								?>
							</span>
						</span>
					</header>
					<div class="card-body">
						<ul class="list-unstyled mb-4">
							<?php
							// Get all plan features.
							$feature_repeater = json_decode( html_entity_decode( $repeater_item->feature_repeater ) );
							if ( ! empty( $feature_repeater ) ) {
								$cpricing_feature_count = 0;
								foreach ( $feature_repeater as $value ) {
									// Output each feature.
									echo sprintf(
										'<li id="c-pricing__t%1$s-f%2$s">%3$s</li>',
										esc_attr( $cpricing_table_count ),
										esc_attr( $cpricing_feature_count ),
										esc_html( $value->feature )
									);
									++$cpricing_feature_count;
								}
							}
							?>
						</ul>
						<?php
							// Plan button and link.
							echo sprintf(
								'<a href="%1$s" class="btn btn-block btn-primary">%2$s</a>',
								esc_url( $repeater_item->link ),
								esc_html( $repeater_item->linktext )
							);
						?>
					</div>
				</div>
			</div>

			<?php
			++$cpricing_table_count;
		}
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Pricing section.
	 *
	 * @since 2019-12-16
	 */
	public function pricing() {
		$pricing = $this->get_pricing();
		if ( ! $pricing )
			return;
		?>
	<!-- Pricing section -->
	<section class="c-pricing">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( get_theme_mod( 'conversions_pricing_title' ) ) || ! empty( get_theme_mod( 'conversions_pricing_desc' ) ) ) { ?>

					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( get_theme_mod( 'conversions_pricing_title' ) ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_pricing_title' ) ) . '</h2>';
							}
							if ( ! empty( get_theme_mod( 'conversions_pricing_desc' ) ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_pricing_desc' ) ) . '</p>';
							}
							?>
						</div>
					</div>

					<?php
				}

				do_action( 'conversions_homepage_before_pricing' );
				echo $this->pricing_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				do_action( 'conversions_homepage_after_pricing' );
				?>

			</div>
		</div>
	</section>
		<?php
	}

	/**
	 * Return the testimonials content.
	 *
	 * @since 2019-12-19
	 */
	public function testimonials_content() {
		$testimonials = $this->get_testimonials();
		if ( ! $testimonials )
			return;
		ob_start();
		?>
		<!-- Testimonials -->
		<div class="col-12">
			<!-- Slick Carousel -->
			<div class="c-testimonials__carousel">

				<?php

				$testimonials_count = 0;
				foreach ( $testimonials as $conversions_testimonial ) {
					?>

					<!-- Testimonial -->
					<div class="c-testimonials__item" id="c-testimonials__<?php echo esc_attr( $testimonials_count ); ?>">
						<blockquote class="c-testimonials__quote shadow w-md-95 w-lg-90 mx-auto">

							<?php
							if ( ! empty( $conversions_testimonial->text ) ) {
								echo '<p>' . esc_html( $conversions_testimonial->text ) . '</p>';
							}
							?>

							<div class="d-flex flex-column flex-sm-row justify-content-sm-between">
								<cite>

									<?php
									if ( ! empty( $conversions_testimonial->title ) ) {
										echo '<span class="d-block">' . esc_html( $conversions_testimonial->title ) . '</span>';
									}

									if ( ! empty( $conversions_testimonial->subtitle ) ) {
										echo '<span class="d-block">' . esc_html( $conversions_testimonial->subtitle ) . '</span>';
									}

									for ( $i = 0; $i < 5; $i++ ) {
										echo '<i class="fas fa-star" aria-hidden="true"></i>';
									}
									?>

								</cite>
								<div class="c-testimonials__nav align-self-end ml-sm-auto">
									<i class="fas fa-chevron-left slick-arrow mr-2" aria-hidden="true" title="<?php esc_attr_e( 'Previous', 'conversions' ); ?>"></i>
									<i class="fas fa-chevron-right slick-arrow" aria-hidden="true" title="<?php esc_attr_e( 'Next', 'conversions' ); ?>"></i>
								</div>
							</div>
						</blockquote>
					</div>

					<?php
					++$testimonials_count;
				}
				?>

			</div> <!-- End Slick Carousel -->
		</div>
		<?php
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Testimonials section.
	 *
	 * @since 2019-12-16
	 */
	public function testimonials() {
		$testimonials = $this->get_testimonials();
		if ( ! $testimonials )
			return;
		?>
	<!-- Testimonial Section -->
	<section class="c-testimonials">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( get_theme_mod( 'conversions_testimonials_title' ) ) || ! empty( get_theme_mod( 'conversions_testimonials_desc' ) ) ) { ?>
					<!-- Title -->
					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( get_theme_mod( 'conversions_testimonials_title' ) ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_testimonials_title' ) ) . '</h2>';
							}
							if ( ! empty( get_theme_mod( 'conversions_testimonials_desc' ) ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_testimonials_desc' ) ) . '</p>';
							}
							?>
						</div>
					</div>
				<?php } ?>


				<?php
					do_action( 'conversions_homepage_before_testimonials' );
					echo $this->testimonials_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					do_action( 'conversions_homepage_after_testimonials' );
				?>

			</div>
		</div>
	</section>
		<?php
	}

	/**
	 * Return the news section content.
	 *
	 * @since 2019-12-19
	 */
	public function news_content() {
		$news = $this->get_news();
		if ( ! $news )
			return;
		ob_start();
		$news_count = 0;
		while ( $news->have_posts() ) :
			$news->the_post();
			?>

			<!-- Post item -->
			<div class="col-sm-12 col-lg-4 c-news__card-wrapper" id="c-news__<?php echo esc_attr( $news_count ); ?>">
				<article class="card shadow h-100">

					<!-- Post image -->
					<a class="c-news__img-link" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>">
						<?php
						if ( has_post_thumbnail() ) :
							the_post_thumbnail( 'news-image', array( 'class' => 'card-img-top' ) );
						else :
							echo '<img class="card-img-top" alt="' . esc_html( get_the_title() ) . '" src="' . esc_url( get_template_directory_uri() ) . '/placeholder.png" />';
						endif;
						?>
					</a>

					<!-- Post content -->
					<div class="card-body pb-1">
						<h3 class="h5">
							<a href="<?php esc_url( the_permalink() ); ?>">
								<?php the_title(); ?>
							</a>
						</h3>
						<p class="text-muted">
							<?php
							$related_content = strip_shortcodes( get_the_content() );
							echo wp_kses_post( wp_trim_words( $related_content, 15, '...' ) );
							?>
						</p>
					</div>

					<!-- Post meta -->
					<div class="card-footer text-muted d-flex justify-content-between align-items-center small">
						<?php
						conversions()->template->posted_on();
						conversions()->template->reading_time();
						?>
					</div>
				</article>
			</div>
			<!-- End Post Item -->

			<?php
			++$news_count;

		endwhile;
		wp_reset_postdata();
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * News section.
	 *
	 * @since 2019-12-16
	 */
	public function news() {
		$news = $this->get_news();
		if ( ! $news )
			return;
		?>
	<!-- News Section -->
	<section class="c-news">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( get_theme_mod( 'conversions_news_title' ) ) || ! empty( get_theme_mod( 'conversions_news_desc' ) ) ) { ?>

					<!-- Title -->
					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( get_theme_mod( 'conversions_news_title' ) ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_news_title' ) ) . '</h2>';
							}
							if ( ! empty( get_theme_mod( 'conversions_news_desc' ) ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_news_desc' ) ) . '</p>';
							}
							?>
						</div>
					</div>

					<?php
				}

				do_action( 'conversions_homepage_before_news' );
				echo $this->news_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				do_action( 'conversions_homepage_after_news' );
				?>

			</div>
		</div>
	</section>
		<?php
	}
}
new Homepage();
