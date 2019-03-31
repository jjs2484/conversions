<?php
/**
 * The header with navbar inline to the right
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// header color scheme
$header_color_scheme = get_theme_mod( 'conversions_header_scheme', 'bg-dark' );
if ($header_color_scheme == 'bg-dark') {
	$header_color_scheme = 'navbar-dark bg-dark';
} elseif ($header_color_scheme == 'bg-light') {
	$header_color_scheme = 'navbar-light bg-light';
} elseif ($header_color_scheme == 'bg-primary') {
	$header_color_scheme = 'navbar-dark bg-primary';
}

// mobile navigation type
$mobile_nav_container = get_theme_mod( 'conversions_nav_mobile_type', 'offcanvas' );
if ($mobile_nav_container == 'collapse') {
	$mobile_nav_container = 'collapse navbar-collapse';
} else {
	$mobile_nav_container = 'navbar-collapse offcanvas-collapse';
}
?>

	<nav class="navbar navbar-expand-lg <?php echo $header_color_scheme; ?>">

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

				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => $mobile_nav_container,
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new conversions_WP_Bootstrap_Navwalker(),
					)
				); 
			?>

		</div><!-- .container -->

	</nav><!-- .site-navigation -->