<?php

namespace conversions;

/**
	@brief		WooCommerce functionality.
	@since		2019-08-06 21:44:43
**/
class WooCommerce
{
	/**
		@brief		Constructor.
		@since		2019-08-06 21:45:26
	**/
	public function __construct()
	{
		/**
		* First unhook the WooCommerce wrappers
		*/
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );

		add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
		add_action( 'woocommerce_before_main_content',	[ $this, 'woocommerce_before_main_content' ] );
		add_action( 'woocommerce_after_main_content',	[ $this, 'woocommerce_after_main_content' ] );

		$this->review_ratings();
	}

	/**
		@brief		Declares WooCommerce theme support.
		@since		2019-08-06 21:46:05
	**/
	function after_setup_theme()
	{
		// Is WooCommerce active?
		if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
			return;

		// Add theme support
		add_theme_support('woocommerce');

		// Add New Woocommerce 3.0.0 Product Gallery support
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );

		// hook in and customizer form fields.
		add_filter( 'woocommerce_form_field_args', [ $this, 'woocommerce_form_field_args' ], 10, 3 );
	}

	/**
		@brief		Enable review ratings support.
		@since		2019-08-06 21:53:11
	**/
	public function review_ratings()
	{
		if ( is_admin() )
			return;
		if ( function_exists( 'wc_review_ratings_enabled' ) )
			return;

		/**
		 * Check if reviews are enabled.
		 *
		 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
		 *
		 * @return bool
		 */
		function wc_reviews_enabled()
		{
			return 'yes' === get_option( 'woocommerce_enable_reviews' );
		}

		/**
		 * Check if reviews ratings are enabled.
		 *
		 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
		 *
		 * @return bool
		 */
		function wc_review_ratings_enabled()
		{
			return wc_reviews_enabled() && 'yes' === get_option( 'woocommerce_enable_review_rating' );
		}
	}

	/**
		@brief		woocommerce_form_field_args
		@since		2019-08-06 21:48:52
	**/
	function woocommerce_form_field_args( $args, $key, $value = null ) {
		// Start field type switch case.
		switch ( $args['type'] ) {
			/* Targets all select input type elements, except the country and state select input types */
			case 'select' :
				// Add a class to the field's html element wrapper - woocommerce
				// input types (fields) are often wrapped within a <p></p> tag.
				$args['class'][] = 'form-group';
				// Add a class to the form input itself.
				$args['input_class']       = array( 'form-control', 'input-lg' );
				$args['label_class']       = array( 'control-label' );
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
					// Add custom data attributes to the form input itself.
				);
				break;
			// By default WooCommerce will populate a select with the country names - $args
			// defined for this specific input type targets only the country select element.
			case 'country' :
				$args['class'][]     = 'form-group single-country';
				$args['label_class'] = array( 'control-label' );
				break;
			// By default WooCommerce will populate a select with state names - $args defined
			// for this specific input type targets only the country select element.
			case 'state' :
				// Add class to the field's html element wrapper.
				$args['class'][] = 'form-group';
				// add class to the form input itself.
				$args['input_class']       = array( '', 'input-lg' );
				$args['label_class']       = array( 'control-label' );
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;
			case 'password' :
			case 'text' :
			case 'email' :
			case 'tel' :
			case 'number' :
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control', 'input-lg' );
				$args['label_class'] = array( 'control-label' );
				break;
			case 'textarea' :
				$args['input_class'] = array( 'form-control', 'input-lg' );
				$args['label_class'] = array( 'control-label' );
				break;
			case 'checkbox' :
				$args['label_class'] = array( 'custom-control custom-checkbox' );
				$args['input_class'] = array( 'custom-control-input', 'input-lg' );
				break;
			case 'radio' :
				$args['label_class'] = array( 'custom-control custom-radio' );
				$args['input_class'] = array( 'custom-control-input', 'input-lg' );
				break;
			default :
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control', 'input-lg' );
				$args['label_class'] = array( 'control-label' );
				break;
		} // end switch ($args).
		return $args;
	}

	/**
		@brief		woocommerce_before_main_content
		@since		2019-08-06 21:54:04
	**/
	public function woocommerce_before_main_content()
	{
		echo '<div class="wrapper" id="woocommerce-wrapper">';
		echo '<div class="container-fluid" id="content" tabindex="-1">';
		echo '<div class="row">';
		get_template_part( 'partials/left-sidebar-check' );
		echo '<main class="site-main" id="main">';
	}

	/**
		@brief		woocommerce_after_main_content
		@since		2019-08-06 21:55:30
	**/
	public function woocommerce_after_main_content()
	{
		echo '</main><!-- #main -->';
		get_template_part( 'partials/right-sidebar-check' );
		echo '</div><!-- .row -->';
		echo '</div><!-- Container end -->';
		echo '</div><!-- Wrapper end -->';
	}

}
new WooCommerce();
