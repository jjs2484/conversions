<?php
/**
 * Right sidebar check.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

</div><!-- #closing the primary container from /partials/left-sidebar-check.php -->

<?php $sidebar_pos = get_theme_mod( 'conversions_sidebar_position', 'right' ); ?>

<?php if ( 'right' === $sidebar_pos ) : ?>

  <?php get_template_part( 'partials/sidebar', 'right' ); ?>

<?php endif;