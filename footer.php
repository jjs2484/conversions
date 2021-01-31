<?php
/**
 * The template for displaying the footer
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Call to action section.
if ( get_theme_mod( 'conversions_hcta_state', false ) === true ) {
	get_template_part( 'partials/footer', 'cta' );
} ?>

<?php do_action( 'conversions_before_footer' ); ?>

<footer id="colophon" class="site-footer">

	<?php get_template_part( 'partials/sidebar', 'footer' ); ?>

	<div id="wrapper-footer" class="wrapper">

		<div class="container-fluid">

			<div class="row">

				<div class="col-md-12">

					<div class="site-info row">

						<?php
						/**
						 * Functions hooked in to conversions_footer_info action
						 *
						 * @hooked conversions_footer_credits - 10
						 * @hooked conversions_footer_social - 20
						 */
						do_action( 'conversions_footer_info' );
						?>

					</div><!-- .site-info -->

				</div><!--col end -->

			</div><!-- row end -->

		</div><!-- container end -->

	</div><!-- wrapper end -->

</footer><!-- #colophon -->

<?php do_action( 'conversions_after_footer' ); ?>

</div><!-- #page end -->

<?php wp_footer(); ?>

</body>

</html>
