<?php
/**
 * Sidebar setup for footer
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php if ( is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) || is_active_sidebar( 'sidebar-5' ) || is_active_sidebar( 'sidebar-6' ) ) : ?>

	<!-- Footer widget area -->

	<div class="wrapper" id="wrapper-footer-full">

		<div class="container-fluid" id="footer-full-content" tabindex="-1">

			<div class="row">

				<?php
				do_action( 'conversions_before_footer_widgets' );

				if ( is_active_sidebar( 'sidebar-3' ) ) {
					echo '<div class="footer-widget-area col-md">';
					dynamic_sidebar( 'sidebar-3' );
					echo '</div>';
				}
				if ( is_active_sidebar( 'sidebar-4' ) ) {
					echo '<div class="footer-widget-area col-md">';
					dynamic_sidebar( 'sidebar-4' );
					echo '</div>';
				}
				if ( is_active_sidebar( 'sidebar-5' ) ) {
					echo '<div class="footer-widget-area col-md">';
					dynamic_sidebar( 'sidebar-5' );
					echo '</div>';
				}
				if ( is_active_sidebar( 'sidebar-6' ) ) {
					echo '<div class="footer-widget-area col-md">';
					dynamic_sidebar( 'sidebar-6' );
					echo '</div>';
				}

				do_action( 'conversions_after_footer_widgets' );
				?>

			</div>

		</div>

	</div><!-- end #wrapper-footer-full -->

	<?php
endif;
