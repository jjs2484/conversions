<?php
/**
 * The right sidebar containing widget area
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

// which sidebar is selected?
$conversions_sidebar_pos = get_theme_mod( 'conversions_sidebar_position', 'right' );
?>

<?php
if ( 'right' === $conversions_sidebar_pos || is_page_template( 'page-templates/right-sidebarpage.php') ) {
	?>
	<div class="col-lg-3 widget-area ps-lg-3" id="sidebar-1" role="complementary">
	<?php
}

dynamic_sidebar( 'sidebar-1' );
?>

</div><!-- #sidebar-1 -->
