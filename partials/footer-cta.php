<?php
/**
 * Call to action partial for footer
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

	<!-- Call-to-action section -->
	<?php
	if ( get_theme_mod( 'conversions_hcta_bg_choice' ) === 'gradient' ) {
		?>
		<section class="c-cta <?php if ( ! empty( get_theme_mod( 'conversions_hcta_bg_gradient' ) ) ) { echo esc_attr( get_theme_mod( 'conversions_hcta_bg_gradient' ) ); } ?>">
		<?php
	} elseif ( get_theme_mod( 'conversions_hcta_bg_choice' ) === 'bootstrap' ) {
		?>
		<section class="c-cta <?php if ( ! empty( get_theme_mod( 'conversions_hcta_bg_bootstrap' ) ) ) { echo esc_attr( get_theme_mod( 'conversions_hcta_bg_bootstrap' ) ); } ?>">
		<?php
	} elseif ( get_theme_mod( 'conversions_hcta_bg_choice' ) === 'custom' ) {
		?>
		<section class="c-cta" style="background-color: <?php if ( ! empty( get_theme_mod( 'conversions_hcta_bg_color' ) ) ) { echo esc_attr( get_theme_mod( 'conversions_hcta_bg_color' ) ); } ?>;">
		<?php
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
