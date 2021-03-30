<?php
/**
 * Template Name: Left Sidebar
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Featured image styles.
if ( has_post_thumbnail( get_the_ID() ) ) {
	conversions()->template->get_featured_image();
}

get_header();
?>

<div class="wrapper content-wrapper" id="page-wrapper">

	<?php
	if ( has_post_thumbnail( get_the_ID() ) ) {
		// HTML for background image and title.
		echo '<div class="conversions-hero-cover">
    		<div class="container-fluid" id="conversions-hero-content">
    			<div class="row">
					<div class="col-sm-12">
    					<div class="conversions-hero-cover__inner">
    						<h1 class="entry-title text-center">' . esc_html( get_the_title() ) . '</h1>
							' . wp_kses_post( do_action( 'conversions_after_page_hero_title' ) ) . '
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>';
	}
	?>

	<div class="container-fluid" id="content">

		<div class="row">

			<?php get_template_part( 'partials/sidebar', 'left' ); ?>

			<div class="<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>col-lg-9 pl-lg-5<?php else : ?>col-md-12<?php endif; ?> content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php
					while ( have_posts() ) :

						the_post();

						get_template_part( 'partials/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile;
					?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php
get_footer();
