<?php
/**
 * The left sidebar containing widget area
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}

// which sidebar is selected?
$sidebar_pos = get_theme_mod( 'conversions_sidebar_position', 'right' );
?>

<?php 
	if ( 'left' === $sidebar_pos ) { ?>
		<div class="col-md-4 col-lg-3 widget-area pr-md-4 pr-lg-3" id="sidebar-2" role="complementary">
	<?php } 
?>
<?php dynamic_sidebar( 'sidebar-2' ); ?>

</div><!-- #sidebar-2 -->