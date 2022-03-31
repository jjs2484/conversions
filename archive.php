<?php
/**
 * The template for displaying archive pages
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper content-wrapper" id="archive-wrapper">

	<div class="container-fluid" id="content">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'partials/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php do_action( 'conversions_loop_before' ); ?>

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php
					while ( have_posts() ) :

						the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'partials/content' );

					endwhile;
					?>

				<?php else : ?>

					<?php get_template_part( 'partials/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php
			echo conversions()->template->the_posts_pagination(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier
			?>

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'partials/right-sidebar-check' ); ?>

	</div> <!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php
get_footer();
