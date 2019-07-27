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

						<!-- copyright -->
						<div class="copyright col-md">
							<?php
								echo "&copy;" . date("Y") . " - ";
							
								$copyright_text = esc_html( get_theme_mod( 'conversions_copyright_text', 'conversions' ) );
								if( $copyright_text ) {
									echo esc_html( get_theme_mod( 'conversions_copyright_text' ) );
								} else {
									echo bloginfo('name');
								}
								echo " - <a href='https://themer.com'>Conversions theme</a>";
							?>
						</div>
						
						<?php
							// social icons - /inc/customizer-social.php
							do_action ( 'conversions_output_social' ); 
						?>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

