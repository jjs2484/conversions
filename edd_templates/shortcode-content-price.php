<?php
/**
 * Easy Digital Downloads shortcode price
 *
 * @package conversions
 */

echo '<div><div class="edd_price">';

// Get the download ID.
$conversions_download_id = get_the_ID();

// Get the prices.
if ( edd_is_free_download( $conversions_download_id ) ) {
	$conversions_download_price = esc_html__( 'Free', 'conversions' );
} elseif ( edd_has_variable_prices( $conversions_download_id ) ) {
	$conversions_download_price = edd_price_range( $conversions_download_id );
} else {
	$conversions_download_price = edd_price( $conversions_download_id );
}

echo $conversions_download_price; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier

echo '</div></div>';
