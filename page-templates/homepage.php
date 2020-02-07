<?php
/**
 * Template Name: Homepage
 *
 * Template for displaying the homepage.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Featured image styles.
if ( has_post_thumbnail( get_the_ID() ) ) {
	conversions()->template->get_featured_image();
}

get_header();
?>

<div id="homepage-wrapper" class="wrapper content-wrapper">

<?php do_action( 'homepage' ); ?>

</div><!-- Wrapper end -->

<?php
get_footer();
