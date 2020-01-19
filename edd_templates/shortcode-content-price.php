<?php
	// Get the download ID
	$download_id = get_the_ID();

	// Get the prices
	if ( edd_is_free_download( $download_id ) ) {
		$price = '<div class="edd_price">' . __( 'Free', 'conversions' ) . '</div>';
 	} elseif ( edd_has_variable_prices( $download_id ) ) {
		$price = '<div class="edd_price">' . edd_price_range( $download_id ) . '</div>';
	} else {
		$price = '<div class="edd_price">' . edd_price( $download_id ) . '</div>';
	}

	echo $price;
?>