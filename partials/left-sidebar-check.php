<?php
/**
 * Left sidebar check
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php
$sidebar_pos = get_theme_mod( 'conversions_sidebar_position', 'right' );
?>

<?php if ( 'left' === $sidebar_pos ) : ?>
	<?php get_template_part( 'partials/sidebar', 'left' ); ?>
<?php endif; ?>

<?php
// primary content area columns based on selected and active sidebars.
// if left sidebar is selected.
if ( 'left' === $sidebar_pos ) {
	if ( is_active_sidebar( 'sidebar-2' ) ) {
		?>
		<div class="col-md-8 col-lg-9 pl-lg-5 content-area" id="primary">
		<?php
	} else {
		?>
		<div class="col-md-12 content-area" id="primary">
		<?php
	}
} elseif ( 'right' === $sidebar_pos ) { // if right sidebar is selected.
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		?>
		<div class="col-md-8 col-lg-9 pr-lg-5 content-area" id="primary">
		<?php
	} else {
		?>
		<div class="col-md-12 content-area" id="primary">
		<?php
	}
} elseif ( 'none' === $sidebar_pos ) { // if no sidebar is selected.
	?>
	<div class="col-md-12 content-area" id="primary">
	<?php
}
