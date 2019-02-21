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

// which sidebar is selected?
$sidebar_pos = get_theme_mod( 'conversions_sidebar_position' );
?>

<?php 
	if ( 'right' === $sidebar_pos ) { ?>
		<div class="col-md-4 col-xl-3 widget-area" id="right-sidebar" role="complementary">
	<?php } 
?>
<?php dynamic_sidebar( 'right-sidebar' ); ?>

</div><!-- #right-sidebar -->
