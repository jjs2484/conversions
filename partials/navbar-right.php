<?php
/**
 * The header with navbar inline to the right
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// header color scheme
$nav_color_scheme = get_theme_mod( 'conversions_nav_colors', 'white' );
switch( $nav_color_scheme )
{
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

// mobile navigation type
$mobile_nav_type = get_theme_mod( 'conversions_nav_mobile_type', 'offcanvas' );
if ( $mobile_nav_type == 'collapse' ) {
	$mobile_nav_container = 'collapse navbar-collapse';
} else {
	$mobile_nav_container = 'navbar-collapse offcanvas-collapse';
}
?>

	<nav class="navbar navbar-expand-lg <?php echo $nav_color_scheme; ?>">

		<div class="container-fluid">

			<!-- Branding in the menu -->
			<?php if ( ! has_custom_logo() ) { ?>

				<?php if ( is_front_page() && is_home() ) : ?>

					<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

				<?php else : ?>

					<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

				<?php endif; ?>

			<?php } else {
				the_custom_logo();
			} ?><!-- end custom logo -->

			<button class="navbar-toggler" type="button" data-toggle="<?php echo $mobile_nav_type; ?>" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'conversions' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- The WordPress Menu -->
			<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => $mobile_nav_container,
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
						'depth'           => 2,
						'walker'          => new conversions\WP_Bootstrap_Navwalker(),
					)
				);
			?>

		</div><!-- .container -->

	</nav><!-- .site-navigation -->