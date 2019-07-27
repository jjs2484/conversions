<?php
/**
 * Left sidebar check.
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
	// primary content area columns based on selected and active sidebars
	
	// if left sidebar is selected
	if ( 'left' === $sidebar_pos ) {
		if ( is_active_sidebar( 'left-sidebar' )) { ?>
			<div class="col-md-8 col-xl-9 content-area" id="primary">
		<?php }
		else { ?>
			<div class="col-md-12 content-area" id="primary">
		<?php }
	} 
	// if right sidebar is selected
	elseif ( 'right' === $sidebar_pos ) {
		if ( is_active_sidebar( 'right-sidebar' )) { ?>
			<div class="col-md-8 col-xl-9 content-area" id="primary">
		<?php }
		else { ?>
			<div class="col-md-12 content-area" id="primary">
		<?php }
	}
	// if no sidebar is selected
	elseif ( 'none' === $sidebar_pos ) { ?>
		<div class="col-md-12 content-area" id="primary">
	<?php }
