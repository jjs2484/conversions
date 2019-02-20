<?php
/**
 * Left sidebar check.
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php
$sidebar_pos = get_theme_mod( 'conversions_sidebar_position' );
?>

<?php if ( 'left' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>
    <?php get_template_part( 'partials/sidebar', 'left' ); ?>
<?php endif; ?>

<?php
	// primary content area columns based on selected and active sidebars
	// if left sidebar is selected
	if ( 'left' === $sidebar_pos ) {
		if ( is_active_sidebar( 'left-sidebar' )) { ?>
			<div class="col-md-8 content-area" id="primary">
		<?php }
		else { ?>
			<div class="col-md-12 content-area" id="primary">
		<?php }
	} 

	// if right sidebar is selected
	if ( 'right' === $sidebar_pos ) {
		if ( is_active_sidebar( 'right-sidebar' )) { ?>
			<div class="col-md-8 content-area" id="primary">
		<?php }
		else { ?>
			<div class="col-md-12 content-area" id="primary">
		<?php }
	} 

	// if both sidebars are selected
	if ( 'both' === $sidebar_pos ) {
		if ( is_active_sidebar( 'left-sidebar' ) && is_active_sidebar( 'right-sidebar' ) ) { ?>
			<div class="col-md-6 content-area" id="primary">
		<?php } elseif ( is_active_sidebar( 'left-sidebar' )) { ?>
			<div class="col-md-8 content-area" id="primary">
		<?php } elseif ( is_active_sidebar( 'right-sidebar' )) { ?>
			<div class="col-md-8 content-area" id="primary">
		<?php } else { ?>
			<div class="col-md-12 content-area" id="primary">
		<?php }
	}
		
?>