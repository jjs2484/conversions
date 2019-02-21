<?php
/**
 * Right sidebar check.
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

</div><!-- #closing the primary container from /partials/left-sidebar-check.php -->

<?php $sidebar_pos = get_theme_mod( 'conversions_sidebar_position', 'right' ); ?>

<?php if ( 'right' === $sidebar_pos ) : ?>

  <?php get_template_part( 'partials/sidebar', 'right' ); ?>

<?php endif; ?>
