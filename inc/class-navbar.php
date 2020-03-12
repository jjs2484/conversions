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
				$nav_color_scheme = 'navbar-dark bg-dark';
				break;
			case 'light':
				$nav_color_scheme = 'navbar-light bg-light';
				break;
			case 'white':
				$nav_color_scheme = 'navbar-light bg-white';
				break;
			case 'primary':
				$nav_color_scheme = 'navbar-dark bg-primary';
				break;
			case 'secondary':
				$nav_color_scheme = 'navbar-dark bg-secondary';
				break;
			case 'success':
				$nav_color_scheme = 'navbar-dark bg-success';
				break;
			case 'danger':
				$nav_color_scheme = 'navbar-dark bg-danger';
				break;
			case 'warning':
				$nav_color_scheme = 'navbar-light bg-warning';
				break;
			case 'info':
				$nav_color_scheme = 'navbar-dark bg-info';
				break;
			default:
				$nav_color_scheme = 'navbar-light bg-white';
		}

		return $nav_color_scheme;
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
	 * Navbar opening divs.
	 *
	 * @since 2020-01-28
	 */
	public function conversions_navbar_open() {
		$nav_color_scheme = $this->conversions_navbar_color();

		echo '<nav class="navbar navbar-expand-lg ' . esc_attr( $nav_color_scheme ) . '">';
		echo '<div class="container-fluid">';
	}

	/**
	 * Navbar closing divs.
	 *
	 * @since 2020-01-28
	 */
	public function conversions_navbar_close() {
		echo '</div></nav>';
	}

	/**
	 * Navbar branding output.
	 *
	 * @since 2020-01-28
	 */
	public function conversions_navbar_branding() {
		// If no custom logo output blog name.
		if ( ! has_custom_logo() ) {

			if ( is_front_page() && is_home() ) : ?>

				<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php esc_html( bloginfo( 'name' ) ); ?></a></h1>

			<?php else : ?>

				<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php esc_html( bloginfo( 'name' ) ); ?></a>

				<?php
			endif;

		} else {
			the_custom_logo();
		}
	}

	/**
	 * Navbar menu output.
	 *
	 * @since 2020-01-28
	 */
	public function conversions_navbar_menu() {

		// mobile nav type.
		$mobile_nav_type = get_theme_mod( 'conversions_nav_mobile_type', 'collapse' );

		// mobile nav container class.
		switch ( $mobile_nav_type ) {
			case 'collapse':
				$mobile_nav_container = 'collapse navbar-collapse';
				break;
			case 'offcanvas':
				$mobile_nav_container = 'navbar-collapse offcanvas-collapse';
				break;
			default:
				$mobile_nav_container = 'navbar-collapse offcanvas-collapse';
		}
		?>

		<button class="navbar-toggler" type="button" data-toggle="<?php echo esc_attr( $mobile_nav_type ); ?>" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'conversions' ); ?>">
			<span class="navbar-toggler-icon"></span>
		</button>

		<?php
		$walker = new WP_Bootstrap_Navwalker();
		wp_nav_menu(
			array(
				'item_spacing'    => 'discard',
				'theme_location'  => 'primary',
				'container_class' => $mobile_nav_container,
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav ml-auto',
				'menu_id'         => 'main-menu',
				'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
				'depth'           => 2,
				'fallback_cb'     => [ $walker, 'fallback' ],
				'walker'          => $walker,
			)
		);
	}
}
