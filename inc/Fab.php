<?php
/**
 * Fab functions - Floating action button
 *
 * @package conversions
 */

namespace conversions;

/**
 * Fab class.
 *
 * Contains Fab functions.
 *
 * @since 2021-01-23
 */
class Fab {
	/**
	 * Class constructor.
	 *
	 * @since 2021-01-23
	 */
	public function __construct() {
		add_action( 'wp_footer', [ $this, 'wp_footer' ], 10 );
	}

	/**
	 * FAB button.
	 *
	 * @since 2021-01-24
	 */
	public function wp_footer() {

		if ( class_exists( 'woocommerce' ) ) {

			// Only show fab if cart is not empty.
			if ( WC()->cart->get_cart_contents_count() != 0 ) {
				$fab_button = $this->fab_cart();
			}
		} elseif ( class_exists( 'Easy_Digital_Downloads' ) ) {

			// Only show fab if cart is not empty.
			$edd_cart_contents = edd_get_cart_contents();
			if ( ! empty( $edd_cart_contents ) ) {
				$fab_button = $this->fab_cart();
			}
		} elseif ( get_theme_mod( 'conversions_nav_button', 'no' ) !== 'no' ) {

			$fab_button = $this->fab_fullwidth();
		}

		// Check for filter before output.
		if ( has_filter( 'conversions_fab' ) ) {
			$fab_button = apply_filters( 'conversions_fab', $fab_button );
		}

		// If not empty output.
		if ( ! empty( $fab_button ) ) {
			echo $fab_button; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier
		}
	}

	/**
	 * FAB cart.
	 *
	 * @since 2021-01-28
	 */
	public function fab_cart() {

		global $post;

		// Get fab color.
		$color = $this->fab_color();

		// Get cart URL.
		if ( class_exists( 'woocommerce' ) ) {
			$cart_url = wc_get_cart_url();
		} else {
			$cart_url = edd_get_checkout_uri();
		}

		// Check if we are on single product page.
		if ( is_singular( 'product' ) || is_singular( 'download' ) ) {

			// Add to cart FAB.
			$fab_cart = sprintf(
				'<button onclick="cScrollToCart()" title="%1$s" class="c-fab__btn btn %2$s"><i aria-hidden="true" class="fa-solid fa-cart-plus"></i></button>',
				__( 'Add to your shopping cart', 'conversions' ),
				esc_attr( $color )
			);
			// Add wrapper to add cart fab.
			$fab_cart = '<div class="c-fab c-fab__cart-add">' . $fab_cart . '</div>';

			// Cart FAD.
			$fab_button = sprintf(
				'<a title="%1$s" class="c-fab__btn btn %2$s" href="%3$s"><i aria-hidden="true" class="fa-solid fa-shopping-cart"></i></a>',
				__( 'View your shopping cart', 'conversions' ),
				esc_attr( 'btn-light' ),
				esc_url( $cart_url )
			);
			// Add wrapper to cart fab.
			$fab_button = '<div class="c-fab c-fab__cart-wrapper">' . $fab_button . '</div>';

			$fab_button = $fab_cart . $fab_button;
		} else {

			// Cart FAB.
			$fab_button = sprintf(
				'<a title="%1$s" class="c-fab__btn btn %2$s" href="%3$s"><i aria-hidden="true" class="fa-solid fa-shopping-cart"></i></a>',
				__( 'View your shopping cart', 'conversions' ),
				esc_attr( $color ),
				esc_url( $cart_url )
			);
			// Add wrapper to cart fab.
			$fab_button = '<div class="c-fab c-fab__cart-wrapper">' . $fab_button . '</div>';
		}

		// Check for filter before output.
		if ( has_filter( 'conversions_fab_cart' ) ) {
			$fab_button = apply_filters( 'conversions_fab_cart', $fab_button );
		}

		return $fab_button;
	}

	/**
	 * FAB fullwidth.
	 *
	 * @since 2021-01-28
	 */
	public function fab_fullwidth() {

		// Button text.
		$fab_button_text = get_theme_mod( 'conversions_nav_button_text' );
		if ( empty( $fab_button_text ) ) {
			$fab_button_text = '';
			$fab_button_icon = '';
		} else {
			// Check whether we should automatically add an icon.
			$fab_button_icon = $this->fab_fullwidth_icon( $fab_button_text );
		}

		// Button URL.
		$fab_button_url = get_theme_mod( 'conversions_nav_button_url' );
		if ( empty( $fab_button_url ) ) {
			$fab_button_url = '';
		}

		// Get fab color.
		$color = $this->fab_color();

		$fab_button = sprintf(
			'<div class="d-grid gap-2"><a title="%1$s" href="%2$s" class="c-fab__btn btn %3$s btn-lg">%4$s%1$s</a></div>',
			esc_html( $fab_button_text ),
			esc_url( $fab_button_url ),
			esc_attr( $color ),
			$fab_button_icon
		);

		// If not empty add wrapper.
		if ( ! empty( $fab_button ) ) {
			$fab_button = '<div class="c-fab c-fab__btn-wrapper">' . $fab_button . '</div>';
		}

		// Check for filter before output.
		if ( has_filter( 'conversions_fab_fullwidth' ) ) {
			$fab_button = apply_filters( 'conversions_fab_fullwidth', $fab_button );
		}

		return $fab_button;
	}

	/**
	 * FAB color.
	 *
	 * @since 2021-01-26
	 */
	public function fab_color() {

		if ( class_exists( 'woocommerce' ) || class_exists( 'Easy_Digital_Downloads' ) ) {

			// Get nav bg color.
			$color = \conversions\Navbar::conversions_navbar_color();
			$color = $color[1];
			// Add btn selector.
			$color = str_replace( 'bg-', 'btn-', $color );
			// If white invert it.
			$color = str_replace( 'btn-white', 'btn-dark', $color );

		} else {

			// Button color.
			$color = get_theme_mod( 'conversions_nav_button' );
			$color = str_replace( '-outline-', '-', $color );
		}

		// Check for filter before output.
		if ( has_filter( 'conversions_fab_color' ) ) {
			$color = apply_filters( 'conversions_fab_color', $color );
		}

		return $color;
	}

	/**
	 * FAB button icon.
	 *
	 * @since 2021-01-26
	 *
	 * @param string $fab_button_text Fab button text.
	 */
	public function fab_fullwidth_icon( $fab_button_text ) {

		// Create variables for automatic phone number check.
		// Allow +, - and . in phone number.
		$filtered_phone_number = filter_var( $fab_button_text, FILTER_SANITIZE_NUMBER_INT );
		// Remove "-" from number.
		$phone_to_check = str_replace( '-', '', $filtered_phone_number );

		// Are we a phone number or email address?
		if ( strlen( $phone_to_check ) >= 10 && strlen( $phone_to_check ) <= 14 ) {
			$fab_button_icon = '<i class="fa-solid fa-phone-alt"></i> ';
		} elseif ( filter_var( $fab_button_text, FILTER_VALIDATE_EMAIL ) ) {
			$fab_button_icon = '<i class="fa-solid fa-envelope"></i> ';
		} else {
			$fab_button_icon = '';
		}

		// Check for filter before output.
		if ( has_filter( 'conversions_fab_fullwidth_icon' ) ) {
			$fab_button_icon = apply_filters( 'conversions_fab_fullwidth_icon', $fab_button_icon );
		}

		return $fab_button_icon;
	}
}
