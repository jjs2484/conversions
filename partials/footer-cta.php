<?php
/**
 * Call to action partial
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

	<?php
	do_action( 'conversions_before_cta' );

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
		case 'image':
			// Get image ID.
			$conversions_cta_bg_img = get_theme_mod( 'conversions_hcta_bg_img' );
			if ( ! empty( $conversions_cta_bg_img ) ) {
				echo conversions()->template->fullscreen_cta_image(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier
			}
			echo '<section class="c-cta">';
			break;
		default:
			echo '<section class="c-cta ' . esc_attr( get_theme_mod( 'conversions_hcta_bg_gradient', 'crystal-clear' ) ) . '">';
	}
	?>

		<div class="container-fluid">
			<div class="row">
					<div class="col-12">

						<div class="w-md-80 w-lg-60 mx-auto">

							<?php
							do_action( 'conversions_before_cta_content' );

							do_action( 'conversions_cta_content' );

							do_action( 'conversions_after_cta_content' );
							?>

						</div>

					</div>
				</div>
		</div>
	</section>
