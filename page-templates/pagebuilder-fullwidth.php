<?php
/**
 * Template Name: Page Builder Full Width
 *
 * The template for the page builder full-width.
 *
 * It contains the header, footer, and 100% content width.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div id="builder-wrapper" class="wrapper content-wrapper">

	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>

</div><!-- Wrapper end -->

<?php
get_footer();
