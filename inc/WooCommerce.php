<?php
/**
 * WooCommerce functions
 *
 * @package conversions
 */

namespace conversions;

/**
 * Class WooCommerce.
 *
 * @since 2019-08-06
 */
class WooCommerce {
	/**
	 * Class constructor.
	 *
	 * @since 2019-08-06
	 */
	public function __construct() {
		/**
		* First unhook the WooCommerce wrappers
		*/
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );

		add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
		add_action( 'woocommerce_before_main_content', [ $this, 'woocommerce_before_main_content' ] );
		add_action( 'woocommerce_after_main_content', [ $this, 'woocommerce_after_main_content' ] );

		add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'woocommerce_add_to_cart_fragments' ] );

		$this->review_ratings();
	}

	/**
	 * Declares WooCommerce theme support.
	 *
	 * @since 2019-08-06
	 */
	public function after_setup_theme() {
		// Is WooCommerce active?
		if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
			return;

		// Add theme support.
		add_theme_support( 'woocommerce' );

		// Add New Woocommerce 3.0.0 Product Gallery support.
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Hook in and customizer form fields.
		add_filter( 'woocommerce_form_field_args', [ $this, 'woocommerce_form_field_args' ], 10, 3 );

		// Remove the default woo sidebar since we call our own.
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}

	/**
	 * WooCommerce cart for navbar.
	 *
	 * @since 2020-03-12
	 */
	public static function get_cart_nav_html() {
		// get WC cart totals and if = 0 only show icon with no text.
		$cart_totals = WC()->cart->get_cart_contents_count();
		if ( $cart_totals > 0 ) {
			$cart_totals = sprintf(
				'<span>%d<span class="visually-hidden">' . __( 'items in your shopping cart', 'conversions' ) . '</span></span>',
				esc_html( WC()->cart->get_cart_contents_count() )
			);
		} else {
			$cart_totals = '<span class="visually-hidden">' . __( 'View your shopping cart', 'conversions' ) . '</span>';
		}

		$cart_icon = '<i aria-hidden="true" class="fas fa-shopping-cart"></i>';

		$cart_html = sprintf(
			'<a class="cart-customlocation nav-link" title="%s" href="%s">%s%s</a>',
			esc_attr__( 'View your shopping cart', 'conversions' ), // title.
			esc_url( wc_get_cart_url() ),                           // href.
			$cart_icon,
			$cart_totals
		);
		return $cart_html;
	}

	/**
	 * Enable review ratings support.
	 *
	 * @since 2019-08-06
	 */
	public function review_ratings() {
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
		function wc_reviews_enabled() {
			return 'yes' === get_option( 'woocommerce_enable_reviews' );
		}

		/**
		 * Check if reviews ratings are enabled.
		 *
		 * - Function introduced in WooCommerce 3.6.0.
		 * - Included for backwards compatibility.
		 *
		 * @return bool
		 */
		function wc_review_ratings_enabled() {
			return wc_reviews_enabled() && 'yes' === get_option( 'woocommerce_enable_review_rating' );
		}
	}

	/**
	 * Ajaxify navbar cart totals so it updates when an item is added.
	 *
	 * @since 2019-08-15
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 */
	public function woocommerce_add_to_cart_fragments( $fragments ) {
		$fragments['a.cart-customlocation'] = static::get_cart_nav_html();
		return $fragments;
	}

	/**
	 * Filter function to add Bootstrap form classes to WooCommerce
	 *
	 * @since 2019-08-06
	 *
	 * @param string $args Form attributes.
	 * @param string $key Not in use.
	 * @param null   $value Not in use.
	 *
	 * @return mixed
	 */
	public function woocommerce_form_field_args( $args, $key, $value = null ) {
		// Start field type switch case.
		switch ( $args['type'] ) {
			/* Targets all select input type elements, except the country and state select input types */
			case 'select':
				// Add a class to the field's html element wrapper - woocommerce
				// input types (fields) are often wrapped within a <p></p> tag.
				$args['class'][] = 'mb-3';
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
			case 'country':
				$args['class'][]     = 'mb-3 single-country';
				$args['label_class'] = array( 'control-label' );
				break;
			// By default WooCommerce will populate a select with state names - $args defined
			// for this specific input type targets only the country select element.
			case 'state':
				// Add class to the field's html element wrapper.
				$args['class'][] = 'mb-3';
				// add class to the form input itself.
				$args['input_class']       = array( '', 'input-lg' );
				$args['label_class']       = array( 'control-label' );
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;
			case 'password':
			case 'text':
			case 'email':
			case 'tel':
			case 'number':
				$args['class'][]     = 'mb-3';
				$args['input_class'] = array( 'form-control', 'input-lg' );
				$args['label_class'] = array( 'control-label' );
				break;
			case 'textarea':
				$args['input_class'] = array( 'form-control', 'input-lg' );
				$args['label_class'] = array( 'control-label' );
				break;
			case 'checkbox':
				$args['label_class'] = array( 'custom-control custom-checkbox' );
				$args['input_class'] = array( 'custom-control-input', 'input-lg' );
				break;
			case 'radio':
				$args['label_class'] = array( 'custom-control custom-radio' );
				$args['input_class'] = array( 'custom-control-input', 'input-lg' );
				break;
			default:
				$args['class'][]     = 'mb-3';
				$args['input_class'] = array( 'form-control', 'input-lg' );
				$args['label_class'] = array( 'control-label' );
				break;
		} // end switch.
		return $args;
	}

	/**
	 * Output wrappers before WooCommerce content.
	 *
	 * @since 2019-08-06
	 */
	public function woocommerce_before_main_content() {
		echo '<div class="wrapper content-wrapper" id="woocommerce-wrapper">';
		echo '<div class="container-fluid" id="content">';
		echo '<div class="row">';
		get_template_part( 'partials/left-sidebar-check' );
		echo '<main class="site-main" id="main">';
	}

	/**
	 * Output wrappers after WooCommerce content.
	 *
	 * @since 2019-08-06
	 */
	public function woocommerce_after_main_content() {
		echo '</main><!-- #main -->';
		get_template_part( 'partials/right-sidebar-check' );
		echo '</div><!-- .row -->';
		echo '</div><!-- Container end -->';
		echo '</div><!-- Wrapper end -->';
	}

}
