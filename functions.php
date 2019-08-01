<?php
/**
 * conversions functions and definitions
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$conversions_includes = array(
	'/setup.php',							// Theme setup and custom theme supports.
	'/widgets.php',							// Register widget area.
	'/enqueue.php',							// Enqueue scripts and styles.
	'/template-tags.php',					// Custom template tags for this theme.
	'/pagination.php',						// Custom pagination for this theme.
	'/extras.php',							// Custom functions.
	'/customizer.php',						// Customizer additions.
	'/customizer-social.php',				// Customizer social icons.
	'/customizer-nav.php',					// Customizer nav filter with options.
	'/customizer-output.php',				// Customizer output styles.
	'/custom-comments.php',					// Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',	// Load custom WordPress nav walker.
	'/woocommerce.php',						// Load WooCommerce functions.
);

foreach ( $conversions_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}