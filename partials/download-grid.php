<?php
/**
 * Easy Digital Downloads partial template for archives
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$conversions_edd = new conversions\easy_digital_downloads();
$conversions_download_grid = $conversions_edd->conversions_edd_grid_options();
?>

<div class="<?php echo esc_attr( apply_filters( 'edd_download_class', 'edd_download', get_the_ID(), '', '' ) ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?>" id="edd_download_<?php the_ID(); ?>">

	<div class="edd_download_inner">

		<?php

		do_action( 'edd_download_before' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound

		if ( true === $conversions_download_grid['thumbnails'] ) {
			edd_get_template_part( 'shortcode', 'content-image' );
			do_action( 'edd_download_after_thumbnail' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		}

		do_action( 'edd_download_before_title' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound

		// Show the download title.
		edd_get_template_part( 'shortcode', 'content-title' );

		do_action( 'edd_download_after_title' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound

		if ( true === $conversions_download_grid['excerpt'] && true !== $conversions_download_grid['full_content'] ) {
			edd_get_template_part( 'shortcode', 'content-excerpt' );
			do_action( 'edd_download_after_content' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		} elseif ( true === $conversions_download_grid['full_content'] ) {
			edd_get_template_part( 'shortcode', 'content-full' );
			do_action( 'edd_download_after_content' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		}

		// Check if price or button are active.
		if ( true === $conversions_download_grid['price'] || true === $conversions_download_grid['buy_button'] ) :

			// Add a wrapper to the price and buy button.
			echo '<div class="edd-downloads-footer">';

			if ( true === $conversions_download_grid['price'] ) :
				// Show the download price.
				edd_get_template_part( 'shortcode', 'content-price' );
				do_action( 'edd_download_after_price' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
			endif;

			if ( true === $conversions_download_grid['buy_button'] ) :
				// Show the download by button.
				edd_get_template_part( 'shortcode', 'content-cart-button' );
			endif;

			echo '</div>';

		endif;

		do_action( 'edd_download_after' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound

		?>

	</div>
</div>
