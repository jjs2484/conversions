<?php
/**
 * Call to action partial
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

	<!-- Call-to-action section -->
	<?php
	// CTA background type.
	$conversions_cta_bg_type = get_theme_mod( 'conversions_hcta_bg_choice', 'gradient' );
	switch ( $conversions_cta_bg_type ) {
		case 'gradient':
			echo '<section class="c-cta ' . esc_attr( get_theme_mod( 'conversions_hcta_bg_gradient', 'crystal-clear' ) ) . '">';
			break;
		case 'bootstrap':
			echo '<section class="c-cta ' . esc_attr( get_theme_mod( 'conversions_hcta_bg_bootstrap', 'bg-secondary' ) ) . '">';
			break;
		case 'custom':
			echo '<section class="c-cta" style="background-color: ' . esc_attr( get_theme_mod( 'conversions_hcta_bg_color', '#6c757d' ) ) . '">';
			break;
		default:
			echo '<section class="c-cta ' . esc_attr( get_theme_mod( 'conversions_hcta_bg_gradient', 'crystal-clear' ) ) . '">';
	}
	?>

		<div class="container-fluid">
			<div class="row">
					<div class="col-12">

						<div class="w-md-80 w-lg-60 mx-auto">

							<?php do_action( 'conversions_before_cta_content' ); ?>

							<!-- Call-to-action text -->
							<div class="c-cta__items">
								<?php
								if ( ! empty( get_theme_mod( 'conversions_hcta_title' ) ) ) {
									// Title.
									echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_hcta_title' ) ) . '</h2>';
								}

								if ( ! empty( get_theme_mod( 'conversions_hcta_desc' ) ) ) {
									// Description.
									echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_hcta_desc' ) ) . '</p>';
								}

								if ( get_theme_mod( 'conversions_hcta_btn', 'no' ) !== 'no' ) {
									// Button.
									$conversions_cta_btn_text = get_theme_mod( 'conversions_hcta_btn_text' );
									if ( empty( $conversions_cta_btn_text ) ) {
										$conversions_cta_btn_text = '';
									}
									$conversions_cta_btn_url = get_theme_mod( 'conversions_cta_btn_url' );
									if ( empty( $conversions_cta_btn_url ) ) {
										$conversions_cta_btn_url = '';
									}
									echo sprintf(
										'<a href="%s" class="btn %s btn-lg">%s</a>',
										esc_url( $conversions_cta_btn_url ),
										esc_attr( get_theme_mod( 'conversions_hcta_btn', 'btn-light' ) ),
										esc_html( $conversions_cta_btn_text )
									);
								}
								?>
							</div>

							<?php
							if ( ! empty( get_theme_mod( 'conversions_hcta_shortcode' ) ) ) {
								// Shortcode.
								echo do_shortcode( wp_kses_post( get_theme_mod( 'conversions_hcta_shortcode' ) ) );
							}
							?>

							<?php do_action( 'conversions_after_cta_content' ); ?>

						</div>

					</div>
				</div>
		</div>
	</section>
