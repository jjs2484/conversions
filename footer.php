<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'conversions_container_type' );
?>

<?php get_template_part( 'partials/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

						<?php 
							echo "&copy;" . date("Y") . " - ";
							
							$copyright_text = esc_html( get_theme_mod( 'conversions_copyright_text' ) );
							if( $copyright_text ) {
								echo esc_html( get_theme_mod( 'conversions_copyright_text' ) );
							} else {
								echo bloginfo('name');
							}

							echo " - <a href='https://themer.com'>conversions theme by themer</a>";
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

