<?php
/**
 * The default template for displaying single posts
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

<div class="wrapper content-wrapper" id="single-wrapper">

	<?php
	if ( has_post_thumbnail( get_the_ID() ) ) {
		// HTML for background image and title.
		echo '<div class="conversions-hero-cover">
    		<div class="container-fluid" id="conversions-hero-content">
    			<div class="row">
					<div class="col-sm-12">
    					<div class="conversions-hero-cover__inner">
    						<h1 class="entry-title text-center">' . esc_html( get_the_title() ) . '</h1>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>';
	}
	?>

	<div class="container-fluid" id="content">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'partials/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php
				while ( have_posts() ) :

					the_post();

					get_template_part( 'partials/content', 'single' );

					if ( get_theme_mod( 'conversions_blog_postnav', true ) === true ) {
						conversions()->template->post_nav();
					}

					if ( get_theme_mod( 'conversions_blog_related', true ) === true ) {
						conversions()->template->related_posts();
					}

					// If comments are open or we have at least one comment, load comments.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile;
				?>

			</main><!-- #main -->

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'partials/right-sidebar-check' ); ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php
get_footer();
