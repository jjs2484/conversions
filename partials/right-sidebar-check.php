<?php
/**
 * Right sidebar check
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

</div><!-- #closing primary container from /partials/left-sidebar-check.php -->

<?php $conversions_sidebar_pos = get_theme_mod( 'conversions_sidebar_position', 'right' ); ?>

<?php if ( 'right' === $conversions_sidebar_pos ) : ?>

	<?php get_template_part( 'partials/sidebar', 'right' ); ?>

<?php endif; ?>
