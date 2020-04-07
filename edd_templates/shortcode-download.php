<?php
/**
 * A single download inside of the [downloads] shortcode
 *
 * @package conversions
 */

global $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i;

$conversions_edd = new conversions\easy_digital_downloads();
$conversions_edd_grid_options = $conversions_edd->conversions_edd_grid_options( $edd_download_shortcode_item_atts );
?>

<div class="<?php echo esc_attr( apply_filters( 'edd_download_class', 'edd_download', get_the_ID(), $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i ) ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?>" id="edd_download_<?php the_ID(); ?>">

	<div class="<?php echo esc_attr( apply_filters( 'edd_download_inner_class', 'edd_download_inner', get_the_ID(), $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i ) ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?>">

		<?php
		do_action( 'edd_download_before' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound

		if ( true === $conversions_edd_grid_options['thumbnails'] ) {
			// Show the download image.
			edd_get_template_part( 'shortcode', 'content-image' );
			do_action( 'edd_download_after_thumbnail' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		}

		// Show the download title.
		edd_get_template_part( 'shortcode', 'content-title' );

		do_action( 'edd_download_after_title' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound

		if ( true === $conversions_edd_grid_options['excerpt'] && true !== $conversions_edd_grid_options['full_content'] ) {
			// Show the download excerpt.
			edd_get_template_part( 'shortcode', 'content-excerpt' );

			do_action( 'edd_download_after_content' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		} elseif ( true === $conversions_edd_grid_options['full_content'] ) {
			// Show the download full content.
			edd_get_template_part( 'shortcode', 'content-full' );

			do_action( 'edd_download_after_content' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		}

		// Check if price or button are active.
		if ( true === $conversions_edd_grid_options['price'] || true === $conversions_edd_grid_options['buy_button'] ) :

			// Add a wrapper to the price and buy button.
			echo '<div class="edd-downloads-footer">';

			if ( true === $conversions_edd_grid_options['price'] ) :
				// Show the download price.
				edd_get_template_part( 'shortcode', 'content-price' );
				do_action( 'edd_download_after_price' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
			endif;

			if ( true === $conversions_edd_grid_options['buy_button'] ) :
				// Show the download by button section.
				edd_get_template_part( 'shortcode', 'content-cart-button' );
			endif;

			echo '</div>';

		endif;

		do_action( 'edd_download_after' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		?>

	</div>

</div>
