<?php
/**
 * Add WooCommerce support
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'after_setup_theme', 'conversions_woocommerce_support' );
if ( ! function_exists( 'conversions_woocommerce_support' ) ) {
	/**
	 * Declares WooCommerce theme support.
	 */
	function conversions_woocommerce_support() {

		// Is WooCommerce active?
        if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            return;
        }

 		// Add theme support
        add_theme_support('woocommerce');

		// Add New Woocommerce 3.0.0 Product Gallery support
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );

		// hook in and customizer form fields.
		add_filter( 'woocommerce_form_field_args', 'conversions_wc_form_field_args', 10, 3 );
	}
}

/**
* First unhook the WooCommerce wrappers
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
* Then hook in your own functions to display the wrappers your theme requires
*/
add_action('woocommerce_before_main_content', 'conversions_woocommerce_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'conversions_woocommerce_wrapper_end', 10);
if ( ! function_exists( 'conversions_woocommerce_wrapper_start' ) ) {
	function conversions_woocommerce_wrapper_start() {
		echo '<div class="wrapper" id="woocommerce-wrapper">';
	  echo '<div class="container-fluid" id="content" tabindex="-1">';
		echo '<div class="row">';
		get_template_part( 'partials/left-sidebar-check' );
		echo '<main class="site-main" id="main">';
	}
}
if ( ! function_exists( 'conversions_woocommerce_wrapper_end' ) ) {
function conversions_woocommerce_wrapper_end() {
	echo '</main><!-- #main -->';
	get_template_part( 'partials/right-sidebar-check' );
  echo '</div><!-- .row -->';
	echo '</div><!-- Container end -->';
	echo '</div><!-- Wrapper end -->';
	}
}

/**
* Append cart item (and cart count) to end of main menu.
*/
add_filter( 'wp_nav_menu_items', 'conversions_append_cart_icon', 10, 2 );
if ( ! function_exists( 'conversions_append_cart_icon' ) ) {

	function conversions_append_cart_icon( $items, $args ) {

		// Is WooCommerce active?
		if ( class_exists( 'woocommerce' ) ) {
			// Is this the primary menu?
			if ( $args->theme_location === 'primary' ) {
				// Customizer option to show cart
				if (get_theme_mod( 'conversions_wccart_nav', 'yes' ) == 'yes') {

					$cart_link = sprintf( '<li class="cart menu-item nav-item menu-item-type-post_type menu-item-object-page"><a class="cart-customlocation nav-link" href="%s" title="View your shopping cart"><i class="fas fa-shopping-bag"></i>%s</a></li>',
						wc_get_cart_url(),
						sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() )
					);
					// Add the cart link to the end of the menu.
					$items = $items . $cart_link;

				}
			}
		}
		return $items;
	}
}

/**
 * Update cart contents with Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation nav-link" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="View your shopping cart"><i class="fas fa-shopping-bag"></i><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'conversions'), $woocommerce->cart->cart_contents_count);?></a>
	<?php
	$fragments['a.cart-customlocation.nav-link'] = ob_get_clean();
	return $fragments;
}

/**
 * Filter hook function monkey patching form classes
 * Author: Adriano Monecchi http://stackoverflow.com/a/36724593/307826
 *
 * @param string $args Form attributes.
 * @param string $key Not in use.
 * @param null   $value Not in use.
 *
 * @return mixed
 */
if ( ! function_exists ( 'conversions_wc_form_field_args' ) ) {
	function conversions_wc_form_field_args( $args, $key, $value = null ) {
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
}