<?php
/**
 * bbPress functions
 *
 * @package conversions
 */

namespace conversions;

/**
 * Class bbPress
 *
 * @since 2020-07-24
 */
class bbPress {
	/**
	 * Class constructor.
	 *
	 * @since 2019-07-24
	 */
	public function __construct() {
		/**
		* First unhook the WooCommerce wrappers
		*/
		// remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );

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

}
new bbPress();
