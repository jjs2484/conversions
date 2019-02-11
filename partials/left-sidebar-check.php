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

<div class="col-md content-area" id="primary">
