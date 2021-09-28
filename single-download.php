<?php
/**
 * The template for displaying single downloads
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div id="edd-single-wrapper" class="wrapper content-wrapper">

	<div id="content" class="container-fluid">

		<div class="row">

			<div class="col-12">

				<header class="entry-header">
					<h1 class="entry-title edd-title">
						<?php echo esc_html( get_the_title( get_the_ID() ) ); ?>
					</h1>
					<p class="h5 text-muted">
						<?php echo esc_html( get_the_excerpt() ); ?>
					</p>
				</header><!-- .entry-header -->

			</div>

			<div class="col-lg-9 pe-lg-5 content-area" id="primary">

				<main class="site-main" id="main">

					<?php
					while ( have_posts() ) :

						the_post();

						get_template_part( 'partials/download', 'single' );

						// If comments are open or we have at least one comment, load comments.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile;
					?>

				</main><!-- #main -->

			</div>

			<!-- right sidebar -->
			<div class="col-lg-3 widget-area ps-lg-3" id="sidebar-1" role="complementary">

				<?php
				// Price, purchase button, and download details.
				do_action( 'conversions_edd_download_info' );
				?>

			</div><!-- #end sidebar -->

		</div><!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php
get_footer();
