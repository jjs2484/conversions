<?php
/**
 * Navbar functions
 *
 * @package conversions
 */

namespace conversions;

/**
 * Navbar class.
 *
 * Contains Navbar functions.
 *
 * @since 2020-01-28
 */
class Navbar {
	/**
	 * Class constructor.
	 *
	 * @since 2020-01-28
	 */
	public function __construct() {
		add_action( 'conversions_navbar', [ $this, 'conversions_navbar_open' ], 10 );
		add_action( 'conversions_navbar', [ $this, 'conversions_navbar_branding' ], 20 );
		add_action( 'conversions_navbar', [ $this, 'conversions_navbar_menu' ], 30 );
		add_action( 'conversions_navbar', [ $this, 'conversions_navbar_close' ], 40 );
		add_filter( 'wp_nav_menu_items', [ $this, 'wp_nav_menu_items' ], 10, 2 );
		add_action( 'wp_footer', [ $this, 'wp_footer' ], 100 );
	}

	/**
	 * Navbar color scheme.
	 *
	 * @since 2020-01-28
	 */
	public static function conversions_navbar_color() {
		// header color scheme.
		$nav_color_scheme = get_theme_mod( 'conversions_nav_colors', 'white' );
		switch ( $nav_color_scheme ) {
			case 'dark':
				$nav_foreground_color = 'navbar-dark';
				$nav_background_color = 'bg-dark';
				break;
			case 'light':
				$nav_foreground_color = 'navbar-light';
				$nav_background_color = 'bg-light';
				break;
			case 'white':
				$nav_foreground_color = 'navbar-light';
				$nav_background_color = 'bg-white';
				break;
			case 'primary':
				$nav_foreground_color = 'navbar-dark';
				$nav_background_color = 'bg-primary';
				break;
			case 'secondary':
				$nav_foreground_color = 'navbar-dark';
				$nav_background_color = 'bg-secondary';
				break;
			case 'success':
				$nav_foreground_color = 'navbar-dark';
				$nav_background_color = 'bg-success';
				break;
			case 'danger':
				$nav_foreground_color = 'navbar-dark';
				$nav_background_color = 'bg-danger';
				break;
			case 'warning':
				$nav_foreground_color = 'navbar-light';
				$nav_background_color = 'bg-warning';
				break;
			case 'info':
				$nav_foreground_color = 'navbar-dark';
				$nav_background_color = 'bg-info';
				break;
			default:
				$nav_foreground_color = 'navbar-light';
				$nav_background_color = 'bg-white';
		}

		return [$nav_foreground_color, $nav_background_color];
	}

	/**
	 * Navbar wrapper classes.
	 *
	 * @since 2020-01-28
	 */
	public function conversions_wrapper_classes() {
		$nav_color_scheme = get_theme_mod( 'conversions_nav_colors', 'white' );
		$nav_position     = get_theme_mod( 'conversions_nav_position', 'fixed-top' );
		$nav_drop_shadow  = get_theme_mod( 'conversions_nav_dropshadow', false );

		// Set up empty array.
		$classes = [];

		// Add position class.
		$classes[] = $nav_position;

		// Add color scheme class.
		$classes[] = 'is-' . $nav_color_scheme . '-color';

		// Add drop shadow class if active.
		if ( $nav_drop_shadow === true ) {
			$classes[] = 'drop-shadow-is-true';
		}

		$classes = implode( ' ', array_filter( $classes ) );

		return $classes;
	}

	/**
	 * Navbar mobile toggler.
	 *
	 * @since 2020-04-20
	 */
	public static function conversions_navbar_toggler() {

		// mobile navbar toggler button.
		$navbar_mobile_toggler = sprintf(
			'<button class="navbar-toggler hamburger hamburger--spring" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="%s"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>',
			esc_attr__( 'Toggle navigation', 'conversions' )
		);

		return $navbar_mobile_toggler;
	}

	/**
	 * Navbar opening divs.
	 *
	 * @since 2020-01-28
	 */
	public function conversions_navbar_open() {

		$navbar_color_scheme = implode( ' ', $this->conversions_navbar_color() );
		$navbar_open         = '<nav class="navbar navbar-expand-lg navbar-right ' . esc_attr( $navbar_color_scheme ) . '">';
		$navbar_open        .= '<div class="container-fluid">';

		if ( has_filter( 'conversions_nav_open_wrapper' ) ) {
			$navbar_open = apply_filters( 'conversions_nav_open_wrapper', $navbar_open );
		}
		echo $navbar_open; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Navbar closing divs.
	 *
	 * @since 2020-01-28
	 */
	public function conversions_navbar_close() {

		$navbar_close = '</div></nav>';

		if ( has_filter( 'conversions_nav_close_wrapper' ) ) {
			$navbar_close = apply_filters( 'conversions_nav_close_wrapper', $navbar_close );
		}
		echo $navbar_close; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Navbar branding output.
	 *
	 * @since 2020-01-28
	 */
	public function conversions_navbar_branding() {

		// Navbar brand text if blog is homepage.
		$conversions_brand_blog_home = sprintf(
			'<h1 class="navbar-brand mb-0"><a rel="home" href="%s" title="%s" itemprop="url">%s</a></h1>',
			esc_url( home_url( '/' ) ),
			esc_attr( get_bloginfo( 'name', 'display' ) ),
			esc_html( get_bloginfo( 'name' ) )
		);

		// Navbar brand text.
		$conversions_brand_text = sprintf(
			'<a class="navbar-brand" rel="home" href="%s" title="%s" itemprop="url">%s</a>',
			esc_url( home_url( '/' ) ),
			esc_attr( get_bloginfo( 'name', 'display' ) ),
			esc_html( get_bloginfo( 'name' ) )
		);

		// If no custom logo output blog name.
		if ( ! has_custom_logo() ) {
			if ( is_front_page() && is_home() ) {
				$navbar_branding = $conversions_brand_blog_home; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				$navbar_branding = $conversions_brand_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		} else {
			$navbar_branding = get_custom_logo();
		}

		if ( has_filter( 'conversions_nav_branding_output' ) ) {
			$navbar_branding = apply_filters( 'conversions_nav_branding_output', $navbar_branding );
		}
		echo $navbar_branding; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Navbar menu output.
	 *
	 * @since 2020-01-28
	 */
	public function conversions_navbar_menu() {

		$menu = '';

		// Mobile nav toggler.
		if ( get_theme_mod( 'conversions_nav_layout', 'right' ) === 'right' ) {
			$menu .= $this->conversions_navbar_toggler();
		}

		// Nav walker.
		$walker = new WP_Bootstrap_Navwalker();
		$menu  .= wp_nav_menu(
			array(
				'item_spacing'    => 'discard',
				'theme_location'  => 'primary',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav navbar-nav-scroll',
				'menu_id'         => 'main-menu',
				'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
				'depth'           => 2,
				'fallback_cb'     => [ $walker, 'fallback' ],
				'walker'          => $walker,
				'echo'            => false,
			)
		);

		// Apply filter if exists.
		if ( has_filter( 'conversions_navbar_menu' ) ) {
			$menu = apply_filters( 'conversions_navbar_menu', $menu );
		}

		echo $menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier.

	}

	/**
	 * Append menu items: cart, icons, button, etc.
	 *
	 * @since 2019-08-15
	 *
	 * @param string $items Menu items.
	 * @param string $args Arguments.
	 */
	public function wp_nav_menu_items( $items, $args ) {

		if ( $args->theme_location === 'primary' ) {

			$woocommerce = self::conversions_navbar_woocommerce();
			$edd         = self::conversions_navbar_edd();
			$bbpress     = self::conversions_navbar_bbp();
			$search      = self::conversions_navbar_search();
			$button      = self::conversions_navbar_button();

			if ( ! empty( $woocommerce ) ) {
				$items .= $woocommerce;
			}

			if ( ! empty( $edd ) ) {
				$items .= $edd;
			}

			if ( ! empty( $bbpress ) ) {
				$items .= $bbpress;
			}

			if ( ! empty( $search ) ) {
				$items .= $search;
			}

			if ( class_exists( '\conversions\extensions\social\Social' ) && get_theme_mod( 'conversions_social_navbar', false ) === true ) {
				$navbar_social_icons = \conversions\extensions\social\social_icons::social_icons_content();
				if ( ! empty( $navbar_social_icons ) ) {
					$navbar_social_icons = str_replace( 'list-inline-item', 'c-nav__social-icon menu-item nav-item', $navbar_social_icons );
					$navbar_social_icons = str_replace( '<a title=', '<a class="nav-link" title=', $navbar_social_icons );
					$navbar_social_icons = '<ul class="c-nav__social">' . $navbar_social_icons . '</ul>';
					$items              .= $navbar_social_icons;
				}
			}

			if ( ! empty( $button ) ) {
				$items .= $button;
			}

			// Apply filter if exists.
			if ( has_filter( 'conversions_navbar_extras' ) ) {
				$items = apply_filters( 'conversions_navbar_extras', $items );
			}
		}
		return $items;
	}

	/**
	 * Conversions Navbar Woocommerce items.
	 *
	 * @since 2020-11-27
	 */
	public static function conversions_navbar_woocommerce() {

		// Create empty string variable to add active elements to.
		$items = '';

		// Is woocommerce is active?
		if ( class_exists( 'woocommerce' ) ) {

			// Append WooCommerce Account icon?
			if ( get_theme_mod( 'conversions_wc_account', false ) === true ) {

				if ( is_user_logged_in() ) {
					$wc_al = __( 'My Account', 'conversions' );
				} else {
					$wc_al = __( 'Login / Register', 'conversions' );
				}
				// output the account icon if active.
				$wc_account_link = sprintf(
					'<li class="account-icon menu-item nav-item"><a href="%1$s" class="nav-link" title="%2$s"><i aria-hidden="true" class="fas fa-user"></i><span class="sr-only">%2$s</span></a></li>',
					esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ),
					$wc_al
				);

				// Add the account to the end of the menu.
				$items .= $wc_account_link;
			}

			// Append WooCommerce Cart icon?
			if ( get_theme_mod( 'conversions_wc_cart_nav', true ) === true ) {
				// output the cart icon with item count.
				$cart_link = sprintf(
					'<li class="cart menu-item nav-item">%s</li>',
					WooCommerce::get_cart_nav_html()
				);
				// Add the cart icon to the end of the menu.
				$items .= $cart_link;
			}
		}
		return $items;
	}

	/**
	 * Conversions Navbar Easy Digital Downloads items.
	 *
	 * @since 2020-11-27
	 */
	public static function conversions_navbar_edd() {

		// Create empty string variable to add active elements to.
		$items = '';

		// Is Easy Digital Downloads active?
		if ( class_exists( 'Easy_Digital_Downloads' ) ) {

			// Append Easy Digital Downloads Account icon?
			if ( get_theme_mod( 'conversions_edd_nav_account', false ) === true ) {

				if ( is_user_logged_in() ) {
					$edd_al = __( 'My Account', 'conversions' );
				} else {
					$edd_al = __( 'Login / Register', 'conversions' );
				}
				// output the account icon if active.
				$edd_account_link = sprintf(
					'<li class="account-icon menu-item nav-item"><a href="%1$s" class="nav-link" title="%2$s"><i aria-hidden="true" class="fas fa-user"></i><span class="sr-only">%2$s</span></a></li>',
					esc_url( edd_get_user_verification_page() ),
					$edd_al
				);

				// Add the account to the end of the menu.
				$items .= $edd_account_link;
			}

			// Append Easy Digital Downloads Cart icon?
			if ( get_theme_mod( 'conversions_edd_nav_cart', true ) === true ) {

				$edd_cart_totals = sprintf(
					'<span class="header-cart edd-cart-quantity">%s</span><span class="sr-only">' . __( 'View your shopping cart', 'conversions' ) . '</span>',
					edd_get_cart_quantity()
				);

				// output the cart icon with item count.
				$edd_cart_link = sprintf(
					'<li class="cart menu-item nav-item"><a title="' . __( 'View your shopping cart', 'conversions' ) . '" class="cart-customlocation nav-link" href="%s"><i aria-hidden="true" class="fas fa-shopping-cart"></i>%s</a></li>',
					esc_url( edd_get_checkout_uri() ),
					$edd_cart_totals
				);

				// Add the cart icon to the end of the menu.
				$items .= $edd_cart_link;
			}
		}
		return $items;
	}

	/**
	 * Conversions Navbar bbPress items.
	 *
	 * @since 2020-11-27
	 */
	public static function conversions_navbar_bbp() {

		// Create empty string variable to add active elements to.
		$items = '';

		// Is bbPress active?
		if ( class_exists( 'bbPress' ) ) {

			// Append bbPress Account icon?
			if ( get_theme_mod( 'conversions_bbp_account', false ) === true ) {

				if ( is_user_logged_in() ) {
					$bbp_al          = __( 'My Account', 'conversions' );
					$bbp_profile_url = bbp_get_user_profile_url( bbp_get_current_user_id() );
				} else {
					$bbp_al          = __( 'Login / Register', 'conversions' );
					$bbp_profile_url = wp_login_url();
				}

				// output the account icon if active.
				$bbp_account_link = sprintf(
					'<li class="account-icon menu-item nav-item"><a href="%1$s" class="nav-link" title="%2$s"><i aria-hidden="true" class="fas fa-user"></i><span class="sr-only">%2$s</span></a></li>',
					esc_url( $bbp_profile_url ),
					$bbp_al
				);

				// Add the account to the end of the menu.
				$items .= $bbp_account_link;
			}
		}
		return $items;
	}

	/**
	 * Conversions Navbar search item.
	 *
	 * @since 2020-11-27
	 */
	public static function conversions_navbar_search() {

		// Create empty string variable to add active elements to.
		$items = '';

		// Append Search Icon to nav? Separate function coversions_nav_search_modal adds modal html to footer.
		if ( get_theme_mod( 'conversions_nav_search_icon', false ) === true ) {
			$nav_search = sprintf(
				'<li class="search-icon menu-item nav-item"><a href="#csearchModal" data-toggle="modal" class="nav-link" title="%1$s"><i aria-hidden="true" class="fas fa-search"></i><span class="sr-only">%1$s</span></a></li>',
				__( 'Search', 'conversions' )
			);

			// Add the nav button to the end of the menu.
			$items .= $nav_search;
		}

		return $items;
	}

	/**
	 * Conversions Navbar button item.
	 *
	 * @since 2020-11-27
	 */
	public static function conversions_navbar_button() {

		// Create empty string variable to add active elements to.
		$items = '';

		// Append Navigation Button?
		if ( get_theme_mod( 'conversions_nav_button', 'no' ) !== 'no' ) {

			$nav_btn_text = get_theme_mod( 'conversions_nav_button_text' );
			if ( empty( $nav_btn_text ) ) {
				$nav_btn_text = '';
			}
			$nav_btn_url = get_theme_mod( 'conversions_nav_button_url' );
			if ( empty( $nav_btn_url ) ) {
				$nav_btn_url = '';
			}

			$nav_button = sprintf(
				'<li class="nav-callout-button menu-item nav-item"><a title="%1$s" href="%2$s" class="btn %3$s">%1$s</a></li>',
				esc_html( $nav_btn_text ),
				esc_url( $nav_btn_url ),
				esc_attr( get_theme_mod( 'conversions_nav_button' ) )
			);

			// Add the nav button to the end of the menu.
			$items .= $nav_button;
		}

		return $items;
	}

	/**
	 * Search modal for nav search icon added to wp_footer.
	 *
	 * @since 2019-08-15
	 */
	public function wp_footer() {
		if ( get_theme_mod( 'conversions_nav_search_icon', false ) === true ) {
			// Add modal window for search.
			$search_form = get_search_form( false );
			echo '<div id="csearchModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="csearchModal__label" aria-hidden="true">',
				'<div class="modal-dialog">',
					'<div class="modal-content">',
						'<div class="modal-header">',
							'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>',
						'</div>',
						'<div class="modal-body">',
							'<h3 id="csearchModal__label" class="modal-title">' . esc_html__( 'Start typing and press enter to search', 'conversions' ) . '</h3>',
							'' . $search_form . '', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'</div>',
					'</div>',
				'</div>',
			'</div>';
		}
	}
}
