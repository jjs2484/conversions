<?php
/**
 * Sidebar setup for footer full.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div class="wrapper" id="wrapper-footer-full">

		<div class="container-fluid" id="footer-full-content" tabindex="-1">

			<div class="row">

				<?php dynamic_sidebar( 'sidebar-3' ); ?>

			</div>

		</div>

	</div><!-- end #wrapper-footer-full -->

<?php endif;