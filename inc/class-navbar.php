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
	}

	/**
	 * Navbar color scheme.
	 *
	 * @since 2020-01-28
	 */
	public function conversions_navbar_color() {
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

		// Set up array.
		$classes = [];

		$classes[] = get_theme_mod( 'conversions_nav_position', 'fixed-top' );
		$classes[] = 'is-' . $nav_color_scheme . '-color';

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
			'<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="%s"><span class="navbar-toggler-icon"></span></button>',
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
		$navbar_open = '<nav class="navbar navbar-expand-lg navbar-right ' . esc_attr( $navbar_color_scheme ) . '">';
		$navbar_open .= '<div class="container-fluid">';

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

		// Mobile nav toggler.
		if ( get_theme_mod( 'conversions_nav_layout', 'right' ) == 'right' ) {
			echo $this->conversions_navbar_toggler(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		if ( get_theme_mod( 'conversions_nav_layout', 'right' ) != 'right' ) {
			$navbar_color_scheme = implode( ' ', $this->conversions_navbar_color() );
			echo '<div class="' . esc_attr( $navbar_color_scheme ) . ' navbar-below-menu"><div class="container-fluid">';
		}

		// Nav walker.
		$walker = new WP_Bootstrap_Navwalker();
		wp_nav_menu(
			array(
				'item_spacing'    => 'discard',
				'theme_location'  => 'primary',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav',
				'menu_id'         => 'main-menu',
				'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
				'depth'           => 2,
				'fallback_cb'     => [ $walker, 'fallback' ],
				'walker'          => $walker,
			)
		);

		if ( get_theme_mod( 'conversions_nav_layout', 'right' ) != 'right' ) {
			echo '</div></div>';
		}

	}
}
