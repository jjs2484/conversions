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

		add_action( 'conversions_edd_download_info', [ $this, 'singular_edd_price' ], 10 );
		add_action( 'conversions_edd_download_info', [ $this, 'singular_edd_purchase_link' ], 20 );
		add_action( 'conversions_edd_download_info', [ $this, 'singular_edd_download_details' ], 30 );
		add_filter( 'shortcode_atts_downloads', [ $this, 'shortcode_atts_downloads' ], 10, 4 );
		add_filter( 'edd_add_schema_microdata', [ $this, 'edd_add_schema_microdata' ], 10, 1 );
		add_filter( 'edd_get_cart_quantity', [ $this, 'set_cart_quantity' ], 10, 2 );
	}

	/**
		@brief		EDD price for singular product.
		@since		2020-01-15 01:41:02
	**/
	public function singular_edd_price()
	{
		// Get the download ID
		$download_id = get_the_ID();

		// Get the prices
		if ( edd_is_free_download( $download_id ) ) {
			$price = '<h3 id="edd-price-' . $download_id . '" class="edd-price">' . __( 'Free', 'conversions' ) . '</h3>';
 		} elseif ( edd_has_variable_prices( $download_id ) ) {
			$price = '<h3 id="edd-price-' . $download_id . '" class="edd-price">' . edd_price_range( $download_id ) . '</h3>';
		} else {
			$price = '<h3 id="edd-price-' . $download_id . '" class="edd-price">' . edd_price( $download_id, false ) . '</h3>';
		}

		echo $price;
	}

	/**
		@brief		EDD purchase link for singular product.
		@since		2020-01-15 01:44:14
	**/
	public function singular_edd_purchase_link()
	{
		// Get the download ID
		$download_id = get_the_ID();

		// Get the customizer button option
		$edd_primary_btn = get_theme_mod( 'conversions_edd_primary_btn', 'btn-primary' );

		if ( get_post_meta( $download_id, '_edd_hide_purchase_link', true ) ) {
			return; // Do not show if auto output is disabled
		}

		echo edd_get_purchase_link( array( 'class' => 'btn btn-lg btn-block '. $edd_primary_btn .'', 'price' => false ) );
	}

	/**
		@brief		EDD download details for singular product.
		@since		2020-01-15 02:34:44
	**/
	public function singular_edd_download_details()
	{
		// Get the download ID
		$download_id = get_the_ID();
		
		echo '<section class="edd-details">';

			// Title 
			echo '<h3 class="edd-details__title">' . __( 'Details', 'conversions' ) . '</h3>';

			echo '<ul>';

				// Date published.
				echo '<li class="edd-details__published">
					<span class="name">' . __( 'Published:', 'conversions' ) . '</span>
					<span class="value">' . get_the_time( 'F j, Y', $download_id ) . '</span>
				</li>';

				// Sale count.
				$sales = edd_get_download_sales_stats( $download_id );

				if ($sales > 0 ) : 
					echo '<li class="edd-details__sales">
						<span class="name">' . __( 'Sales:', 'themedd' ) . '</span>
						<span class="value">' . $sales . '</span>
					</li>';
				endif;

				// Version.
				if ( class_exists( 'EDD_Software_Licensing' ) ) :
					// Get version number from EDD Software Licensing.
					$version = get_post_meta( $download_id, '_edd_sl_version', true );

					if ( $version ) :
						echo '<li class="edd-details__version">
							<span class="name">' . __( 'Version:', 'conversions' ) . '</span>
							<span class="value">' . $version . '</span>
						</li>';
					endif;
				endif;

				// Download categories.
				$categories = get_the_term_list( $download_id, 'download_category', '', ', ' );
				if ( $categories ) :
					echo '<li class="edd-details__categories">
						<span class="name">' . __( 'Categories:', 'conversions' ) . '</span>
						<span class="value">' . $categories . '</span>
					</li>';
				endif;

				// Download tags.
				$tags = get_the_term_list( $download_id, 'download_tag', '', ', ' );
				if ( $tags ) :
					echo '<li class="edd-details__tags">
						<span class="name">' . __( 'Tags:', 'conversions' ) . '</span>
						<span class="value">' . $tags . '</span>
					</li>';
				endif;

			echo '</ul>';
		echo '</section>';
	}

	/**
		@brief		Download grid options. Used by all download grids:
					via the [downloads] shortcode
					archive-download.php
					taxonomy-download_category.php
					taxonomy-download_tag.php
		@since		2020-01-16 03:57:44
	**/
	public function conversions_edd_grid_options( $atts = array() ) {

		// Converts the various "yes", "no, "true" etc into a format that the $options array uses.
		if ( ! empty( $atts ) ) {
		
			// Buy button.
			if ( isset( $atts['buy_button'] ) && 'yes' === $atts['buy_button'] ) {
				$atts['buy_button'] = true;
			}

			// Price.
			if ( isset( $atts['price'] ) && 'yes' === $atts['price'] ) {
				$atts['price'] = true;
			}

			// Excerpt.
			if ( isset( $atts['excerpt'] ) && 'yes' === $atts['excerpt'] ) {
				$atts['excerpt'] = true;
			}

			// Full content.
			if ( isset( $atts['full_content'] ) && 'yes' === $atts['full_content'] ) {
				$atts['full_content'] = true;
			}

			// Thumbnails.
			if ( isset( $atts['thumbnails'] ) ) {
				if ( 'true' === $atts['thumbnails'] || 'yes' === $atts['thumbnails'] ) {
					$atts['thumbnails'] = true;
				}
			}

		}

		// Options.
		$options = array(
			'excerpt'      => true,
			'full_content' => false,
			'price'        => true,
			'buy_button'   => true,
			'columns'      => 3,
			'thumbnails'   => true,
			'pagination'   => true,
			'number'       => 9,
			'order'        => 'DESC',
			'orderby'      => 'post_date'
		);

		// Merge the arrays.
		$options = wp_parse_args( $atts, $options );

		// Return the options.
		return apply_filters( 'conversions_edd_grid_options', $options );

	}

	/**
		@brief		Filter the [downloads] shortcode's default attributes.
		@since		2020-01-16 08:21:57
		
		@param array  $out       The output array of shortcode attributes.
		@param array  $pairs     The supported attributes and their defaults.
		@param array  $atts      The user defined shortcode attributes.
		@param string $shortcode The shortcode name.

		@return array $out       The output array of shortcode attributes.
	**/
	public function shortcode_atts_downloads( $out, $pairs, $atts, $shortcode ) 
	{
	
		// Get the download grid options.
		$download_grid_options = $this->conversions_edd_grid_options( $out );

		//Filter the pagination.
		if ( false === $download_grid_options['pagination'] ) {
			$out['pagination'] = 'false';
		} else if ( true === $download_grid_options['pagination'] ) {
			$out['pagination'] = 'true';
		}

		// Sets the number of download columns shown.
		$out['columns'] = $download_grid_options['columns'];

		// Sets the number of downloads shown.
		$out['number'] = $download_grid_options['number'];

		// Sets the "order".
		$out['order'] = $download_grid_options['order'];

		// Sets the "orderby"
		$out['orderby'] = $download_grid_options['orderby'];

		// Sets the price attribute to "yes" automatically if not set on the [downloads] shortcode.
		if ( ! isset( $atts['price'] ) && false !== $download_grid_options['price'] ) {
			$out['price'] = 'yes';
		}
	
		return $out;
	}

	/**
		@brief		Downloads list wrapper classes for archives.
		@since		2020-01-17 07:42:57
	**/
	public function conversions_edd_archive_list_classes() {

		// Get the download grid options.
		$options = $this->conversions_edd_grid_options();

		// Set up array.
		$classes = [];

		if ( empty( $atts ) ) {
			/**
				If empty download grid is being output by an archive:
				- archive-download.php
				- taxonomy-download_category.php
				- taxonomy-download_tag.php
			**/

			// Add downloads list wrapper classes.
			$classes[] = 'edd_downloads_list';
			$classes[] = 'edd_download_columns_' . $options['columns'];
		}

		// Add optional filter and check for its usage.
		if ( has_filter( 'conversions_edd_archive_classes' ) ) {
			$classes = apply_filters( 'conversions_edd_archive_classes', $classes );
		}

		$classes = implode( ' ', array_filter( $classes ) );

		return $classes;
	}

	/**
		@brief		Disable legacy EDD schema.org microdata.		
		@since		2020-01-16 19:54:02
	**/
	public function edd_add_schema_microdata( $ret ) {
		return false;
	}

	/**
		@brief		Make cart quantity blank when no items in the cart.		
		@since		2020-01-16 19:54:02
	**/
	public function set_cart_quantity( $total_quantity, $cart ) {

		if ( ! $cart ) {
			$total_quantity = '';
		}
		return $total_quantity;
	}

}
new Easy_Digital_Downloads();
