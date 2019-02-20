<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod( 'conversions_sidebar_position' );
?>

<?php if ( 'both' === $sidebar_pos ) {
	if ( is_active_sidebar( 'left-sidebar' ) && is_active_sidebar( 'right-sidebar' ) ) { ?>
		<div class="col-md-3 widget-area" id="right-sidebar" role="complementary">
	<?php } elseif ( is_active_sidebar( 'right-sidebar' )) { ?>
		<div class="col-md-4 widget-area" id="right-sidebar" role="complementary">
	<?php } 
} elseif ( 'right' === $sidebar_pos ) {
	if ( is_active_sidebar( 'right-sidebar' )) { ?>
		<div class="col-md-4 widget-area" id="right-sidebar" role="complementary">
	<?php } 
} ?>
<?php dynamic_sidebar( 'right-sidebar' ); ?>

</div><!-- #right-sidebar -->
