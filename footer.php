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

<footer class="site-footer" id="colophon">

	<?php get_template_part( 'partials/sidebar', 'footerfull' ); ?>

	<div class="wrapper" id="wrapper-footer">

		<div class="container-fluid">

			<div class="row">

				<div class="col-md-12">

					<div class="site-info row">

						<div class="copyright col-md">

							<?php 
								if ( ! empty( get_theme_mod( 'conversions_copyright_text' ) ) ) {
									$copyright_text = get_theme_mod( 'conversions_copyright_text' );
								} else {
									$copyright_text = get_bloginfo( 'name' );
								}

								echo sprintf( '&copy;'.date("Y").'&nbsp;&bull;&nbsp;<a class="site-name" href="%s" rel="home">%s</a>', 
                    				esc_url( home_url( '/' ) ),
                    				esc_html( $copyright_text )
                  				);
								
								if ( function_exists( 'the_privacy_policy_link' ) ) {
									the_privacy_policy_link( '&nbsp;&bull;&nbsp;', '<span role="separator" aria-hidden="true"></span>' );
								} 

								echo sprintf( '&nbsp;&bull;&nbsp;%s&nbsp;<a href="%s">%s</a>', 
                    				esc_html__( 'Powered by', 'conversions' ),
                    				esc_url( 'https://conversionswp.com' ),
                    				esc_html__( 'Conversions', 'conversions' )
                  				);
								
							?>

						</div>
						
						<?php do_action( 'conversions_output_social' ); ?>

					</div><!-- .site-info -->

				</div><!--col end -->

			</div><!-- row end -->

		</div><!-- container end -->

	</div><!-- wrapper end -->

</footer><!-- #colophon -->

</div><!-- #page end -->

<?php wp_footer(); ?>

</body>

</html>