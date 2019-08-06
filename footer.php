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
							
							&copy; <?php echo date("Y"); ?>

							<?php echo "&nbsp;|&nbsp;"; ?>

							<?php 
								$copyright_text = esc_html( get_theme_mod( 'conversions_copyright_text', 'conversions' ) );
								$blog_info = get_bloginfo( 'name' );
							?>
							<?php if ( ! empty( $copyright_text ) ) { ?>
								<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_theme_mod( 'conversions_copyright_text' ) ); ?></a>
							<?php } elseif ( ! empty( $blog_info ) ) { ?>
								<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							<?php } ?>

							<?php echo "&nbsp;|&nbsp;"; ?>

							<?php if ( function_exists( 'the_privacy_policy_link' ) ) {
								the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
							} ?>

						</div>
						
						<?php
							do_action ( 'conversions_output_social' ); // inc/customizer-social.php 
						?>

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