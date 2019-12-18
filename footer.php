<?php
/**
 * The template for displaying the footer.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Call to action
if ( get_theme_mod( 'conversions_hcta_state', false ) == true ) {	
	get_template_part( 'partials/footer', 'cta' );
} ?>

<?php do_action( 'conversions_before_footer' ); ?>

<footer class="site-footer" id="colophon">

	<?php get_template_part( 'partials/sidebar', 'footer' ); ?>

	<div class="wrapper" id="wrapper-footer">

		<div class="container-fluid">

			<div class="row">

				<div class="col-md-12">

					<div class="site-info row">

						<?php do_action( 'conversions_footer_credits' ); ?>
						
						<?php do_action( 'conversions_footer_social' ); ?>

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