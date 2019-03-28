<?php
/**
 * conversions customizer filter nav and add options
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Navigation button
add_filter( 'wp_nav_menu_items', 'conversions_add_navbar_buttons', 10, 2 );

if ( ! function_exists( 'conversions_add_navbar_buttons' ) ) {
	function conversions_add_navbar_buttons( $items, $args ) {
		if ( $args->theme_location === 'primary' ) {
			
			// Append Navigation Button?
			// get nav button customizer setting whether to show button or not
			$nav_button_type = get_theme_mod( 'conversions_nav_button', 'no' );
			if ($nav_button_type != 'no') {
				// get nav button text option
				$nav_button_text = get_theme_mod( 'conversions_nav_button_text', 'Click me' );
				// get nav button url option
				$nav_button_url = get_theme_mod( 'conversions_nav_button_url', 'https://wordpress.org' );
				// output the nav button with options
				$nav_button = '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="nav-callout-button menu-item nav-item"><a title="' . $nav_button_text . '" href="' . $nav_button_url . '" class="btn ' . $nav_button_type . '">' . $nav_button_text . '</a></li>';
				// Add the nav button to the end of the menu.
				$items = $items . $nav_button;
			}
			
			// Append WooCommerce Cart Icon?
			// first check if woocommerce is active
			if ( class_exists( 'woocommerce' ) ) {
				// get customizer option whether to show cart icon or not
				if (get_theme_mod( 'conversions_wccart_nav', 'yes' ) == 'yes') {
					// get WC cart totals and if = 0 only show icon with no text
					$cart_totals = WC()->cart->get_cart_contents_count();
					if( WC()->cart->get_cart_contents_count() > 0) {
						$cart_totals = WC()->cart->get_cart_contents_count();
					}
					else {
						$cart_totals = '';
					}
					// output the cart icon with item count
					$cart_link = sprintf( '<li class="cart menu-item nav-item" itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"><a class="cart-customlocation nav-link" href="%s" title="View your shopping cart"><i class="fas fa-shopping-bag"></i>%s</a></li>',
						wc_get_cart_url(),
						$cart_totals
					);
					// Add the cart icon to the end of the menu.
					$items = $items . $cart_link;
				}
			}

			// Append Search Icon to nav? Separate function coversions_nav_search_modal adds modal html to footer.
			// get search icon customizer setting whether to show or not
			$nav_search_icon = get_theme_mod( 'conversions_nav_search_icon', 'show' );
			if ($nav_search_icon != 'hide') {
				// output the nav search icon if active.
				$nav_search = '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="search-icon menu-item nav-item"><a title="Search" href="#csearchModal" data-toggle="modal" class="nav-link"><i class="fas fa-search"></i></a></li>';
				// Add the nav button to the end of the menu.
				$items = $items . $nav_search;
			}

		}
		return $items;
	}
}

/**
 * Output the search modal html in the footer if is active in the nav
 */
if ( ! function_exists( 'coversions_nav_search_modal' ) ) {
	
	function coversions_nav_search_modal() {
    	$nav_search_icon = get_theme_mod( 'conversions_nav_search_icon', 'show' );
		if ($nav_search_icon != 'hide') {

			// Add modal window for search
			$search_form = get_search_form();
			echo 
				'<div id="csearchModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="Search" aria-hidden="true">',

					'<div class="modal-dialog">',

						'<div class="modal-content">',

							'<div class="modal-header"><button class="btn btn-secondary" data-dismiss="modal">close</button></div>',

							'<div class="modal-body">',
								'<h3 id="myModalLabel" class="modal-title">Start typing and press enter to search</h3>',
								''.$search_form.'',
							'</div>',
							
						'</div>',

					'</div>',

				'</div>';
		}
		else {
			return;
		}
	}
}
add_action( 'wp_footer', 'coversions_nav_search_modal', 100 );


/**
 * Update WooCommerce cart contents with Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

if ( ! function_exists( 'woocommerce_header_add_to_cart_fragment' ) ) {
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		$cart_totals = WC()->cart->get_cart_contents_count();
		if( WC()->cart->get_cart_contents_count() > 0)
		{
			$cart_totals = WC()->cart->get_cart_contents_count();
		}
		else 
		{
			$cart_totals = '';
		}

		?>
		<a class="cart-customlocation nav-link" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="View your shopping cart"><i class="fas fa-shopping-bag"></i><?php echo $cart_totals; ?></a>
		<?php
		$fragments['a.cart-customlocation.nav-link'] = ob_get_clean();
		return $fragments;
	}
}
