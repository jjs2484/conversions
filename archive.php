<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper" id="archive-wrapper">

	<div class="container-fluid" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'partials/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'partials/content' );
						?>

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'partials/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php conversions_pagination(); ?>

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'partials/right-sidebar-check' ); ?>

	</div> <!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer();