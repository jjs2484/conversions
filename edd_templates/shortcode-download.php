<?php
/**
 * A single download inside of the [downloads] shortcode.
 *
 * @since 2.8.0
 *
 * @package EDD
 * @category Template
 * @author Easy Digital Downloads
 * @version 1.0.0
 */

global $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i;

$edd = new conversions\easy_digital_downloads();
$download_grid_options = $edd->conversions_edd_grid_options( $edd_download_shortcode_item_atts );
?>

<div class="<?php echo esc_attr( apply_filters( 'edd_download_class', 'edd_download', get_the_ID(), $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i ) ); ?>" id="edd_download_<?php the_ID(); ?>">

	<div class="<?php echo esc_attr( apply_filters( 'edd_download_inner_class', 'edd_download_inner', get_the_ID(), $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i ) ); ?>">

		<?php
			do_action( 'edd_download_before' );

			if ( true === $download_grid_options['thumbnails'] ) {
				// Show the download image.
				edd_get_template_part( 'shortcode', 'content-image' );
				do_action( 'edd_download_after_thumbnail' );
			}

			// Show the download title
			edd_get_template_part( 'shortcode', 'content-title' );

			do_action( 'edd_download_after_title' );

			if ( true === $download_grid_options['excerpt'] && true !== $download_grid_options['full_content'] ) {
				// Show the download excerpt.
				edd_get_template_part( 'shortcode', 'content-excerpt' );

				do_action( 'edd_download_after_content' );
			} elseif ( true === $download_grid_options['full_content'] ) {
				// Show the download full content.
				edd_get_template_part( 'shortcode', 'content-full' );
				
				do_action( 'edd_download_after_content' );
			}

			// Check if price or button are active
			if ( true === $download_grid_options['price'] || true === $download_grid_options['buy_button'] ) :
				
				// Add a wrapper to the price and buy button
				echo '<div class="edd-downloads-footer">';
			
				if ( true === $download_grid_options['price'] ) :
					// Show the download price
					edd_get_template_part( 'shortcode', 'content-price' );
					do_action( 'edd_download_after_price' );
				endif;

				if ( true === $download_grid_options['buy_button'] ) :
					// Show the download by button section
					edd_get_template_part( 'shortcode', 'content-cart-button' );
				endif;

				echo '</div>';

			endif;

			do_action( 'edd_download_after' );
		?>

	</div>

</div>
