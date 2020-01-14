<?php
/**
 * The header for our theme.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
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

<?php if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} else {
	do_action( 'wp_body_open' );
} ?>

<div class="site" id="page">

	<!-- The Navbar -->
	<div id="wrapper-navbar" class="<?php echo esc_attr( get_theme_mod( 'conversions_nav_position', 'fixed-top' ) ); ?>">

		<?php if ( is_page_template( 'page-templates/homepage.php' ) ) { ?>
			<a class="skip-link sr-only sr-only-focusable" href="#homepage-wrapper"><?php esc_html_e( 'Skip to content', 'conversions' ); ?></a>
		<?php } else { ?>
			<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'conversions' ); ?></a>
		<?php } ?>

		<?php get_template_part( 'partials/navbar', 'right' ); ?>

	</div><!-- #wrapper-navbar end -->

	<?php do_action( 'conversions_before_content' ); ?>