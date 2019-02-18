<?php
/**
 * The header for our theme.
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// header position
$header_position = get_theme_mod( 'conversions_header_position', 'fixed-top' );

// mobile navigation type
$mobile_nav_type = get_theme_mod( 'conversions_nav_mobile_type', 'offcanvas' );
if ($mobile_nav_type == 'collapse') {
	$mobile_nav_container = 'collapse navbar-collapse';
} else {
	$mobile_nav_container = 'navbar-collapse offcanvas-collapse';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- Force IE to use the latest rendering engine available -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" class="<?php echo $header_position; ?>" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'conversions' ); ?></a>

		<nav class="navbar navbar-expand-lg navbar-dark">

			<div class="container-fluid">

					<!-- Your site title as branding in the menu -->
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

				<!-- The WordPress Menu goes here -->
				<?php
					// navigation button
					$nav_button_type = get_theme_mod( 'conversions_nav_button', 'no' );
					if ($nav_button_type == 'no') {
						$nav_button = '<ul id="%1$s" class="%2$s">%3$s</ul>';
					} else {
						$nav_button_text = get_theme_mod( 'conversions_nav_button_text', 'Click me' );
						$nav_button_url = get_theme_mod( 'conversions_nav_button_url', 'https://wordpress.org' );
						$nav_button = '<ul id="%1$s" class="%2$s">%3$s <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="menu-item nav-item"><a title="' . $nav_button_text . '" href="' . $nav_button_url . '" class="btn ' . $nav_button_type . '">' . $nav_button_text . '</a></li> </ul>';
					}

					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => $mobile_nav_container,
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav ml-auto',
							'items_wrap'	  => $nav_button,
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'depth'           => 2,
							'walker'          => new conversions_WP_Bootstrap_Navwalker(),
						)
					); 
				?>

			</div><!-- .container -->

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->
