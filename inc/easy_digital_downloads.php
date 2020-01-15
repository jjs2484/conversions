<?php

namespace conversions;

/**
	@brief		Easy Digital Downloads functionality.
	@since		2020-01-15 01:32:43
**/
class Easy_Digital_Downloads
{
	/**
		@brief		Constructor.
		@since		2020-01-15 01:32:43
	**/
	public function __construct()
	{
		// Remove the purchase link at the bottom of the single download page.
		remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );

		add_action( 'conversions_edd_download_info', [ $this, 'conversions_edd_price' ], 10 );
		add_action( 'conversions_edd_download_info', [ $this, 'conversions_edd_purchase_link' ], 20 );
		add_action( 'conversions_edd_download_info', [ $this, 'conversions_edd_download_details' ], 30 );
	}

	/**
		@brief		EDD price for singular product.
		@since		2020-01-15 01:41:02
	**/
	public function conversions_edd_price()
	{
		// Get the download ID
		$download_id = get_the_ID();

		// Get the prices
		if ( edd_is_free_download( $download_id ) ) {
			$price = '<span id="edd-price-' . $download_id . '" class="edd-price">' . __( 'Free', 'conversions' ) . '</span>';
 		} elseif ( edd_has_variable_prices( $download_id ) ) {
			$price = '<span id="edd-price-' . $download_id . '" class="edd-price">' . __( 'From', 'conversions' ) . '&nbsp;' . edd_currency_filter( edd_format_amount( edd_get_lowest_price_option( $download_id ) ) ) . '</span>';
		} else {
			$price = edd_price( $download_id, false );
		}

		echo $price;
	}

	/**
		@brief		EDD purchase link for singular product.
		@since		2020-01-15 01:44:14
	**/
	public function conversions_edd_purchase_link()
	{
		// Get the download ID
		$download_id = get_the_ID();

		// Get the purchase button
		if ( get_post_meta( $download_id, '_edd_hide_purchase_link', true ) ) {
			return; // Do not show if auto output is disabled
		}

		echo edd_get_purchase_link();
	}

	/**
		@brief		EDD purchase link for singular product.
		@since		2020-01-15 02:34:44
	**/
	public function conversions_edd_download_details()
	{
		// Get the download ID
		$download_id = get_the_ID();
		
		echo '<section class="edd-details">';

			// Title 
			echo '<span class="edd-details__title">' . __( 'Details', 'conversions' ) . '</span>';

			echo '<ul>';

				// Date published.
				echo '<li class="edd-details__published">
					<span class="edd-details__published-name">' . __( 'Published:', 'conversions' ) . '</span>
					<span class="edd-details__published-value">' . get_the_time( 'F j, Y', $download_id ) . '</span>
				</li>';

				// Sale count.
				$sales = edd_get_download_sales_stats( $download_id );

				if ($sales > 0 ) : 
					echo '<li class="edd-details__sales">
						<span class="edd-details__sales-name">' . __( 'Sales:', 'themedd' ) . '</span>
						<span class="edd-details__sales-value">' . $sales . '</span>
					</li>';
				endif;

				// Version.
				if ( class_exists( 'EDD_Software_Licensing' ) ) :
					// Get version number from EDD Software Licensing.
					$version = get_post_meta( $download_id, '_edd_sl_version', true );

					if ( $version ) :
						echo '<li class="edd-details__version">
							<span class="edd-details__version-name">' . __( 'Version:', 'conversions' ) . '</span>
							<span class="edd-details__version-value">' . $version . '</span>
						</li>';
					endif;
				endif;

				// Download categories.
				$categories = get_the_term_list( $download_id, 'download_category', '', ', ' );
				if ( $categories ) :
					echo '<li class="edd-details__categories">
						<span class="edd-details__categories-name">' . __( 'Categories:', 'conversions' ) . '</span>
						<span class="edd-details__categories-value">' . $categories . '</span>
					</li>';
				endif;

				// Download tags.
				$tags = get_the_term_list( $download_id, 'download_tag', '', ', ' );
				if ( $tags ) :
					echo '<li class="edd-details__tags">
						<span class="edd-details__tags-name">' . __( 'Tags:', 'conversions' ) . '</span>
						<span class="edd-details__tags-value">' . $tags . '</span>
					</li>';
				endif;

			echo '</ul>';
		echo '</section>';
	}

}
new Easy_Digital_Downloads();
