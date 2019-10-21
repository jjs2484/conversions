<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php get_template_part( 'partials/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="container-fluid">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info row">

						<div class="copyright col-md">

							<?php 
								if ( ! empty( get_theme_mod( 'conversions_copyright_text' ) ) ) {
									$copyright_text = get_theme_mod( 'conversions_copyright_text' );
								} else {
									$copyright_text = get_bloginfo( 'name' );
								}

								echo sprintf( '&copy;'.date("Y").'&nbsp;|&nbsp;<a class="site-name" href="%s" rel="home">%s</a>', 
                    				esc_url( home_url( '/' ) ),
                    				esc_html( $copyright_text )
                  				);
								
								if ( function_exists( 'the_privacy_policy_link' ) ) {
									the_privacy_policy_link( '&nbsp;|&nbsp;', '<span role="separator" aria-hidden="true"></span>' );
								} 
							?>

						</div>
						
						<?php do_action ( 'conversions_output_social' ); ?>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page end -->

<?php wp_footer(); ?>

</body>

</html>