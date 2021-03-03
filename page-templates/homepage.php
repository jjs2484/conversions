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
	conversions()->template->get_hero_image();
}

get_header();
?>

<div id="homepage-wrapper" class="wrapper content-wrapper">

	<?php
	// If conversions extensions plugin isn't installed lets recommend it.
	if ( ! class_exists( '\conversions\extensions\homepage\Homepage' ) ) {
		if ( current_user_can( 'edit_theme_options' ) ) { // Display this only to those with the right access.
			?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="alert alert-primary mt-5 mb-5" role="alert">
							<?php
							printf(
								/* translators: %s: plugin link */
								esc_html__( 'You need %s activated to display the homepage sections. Activate the plugin first!', 'conversions' ),
								'<a href="' . esc_url( 'https://wordpress.org/plugins/conversions-extensions/', 'conversions' ) . '" class="alert-link">' . esc_html__( 'Conversions Extensions', 'conversions' ) . '</a>'
							);
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}

	// Output homepage.
	do_action( 'homepage' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
	?>

</div><!-- Wrapper end -->

<?php
get_footer();
