<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper content-wrapper" id="index-wrapper">

	<div class="container-fluid" id="content">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'partials/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php if ( is_home() && ! is_front_page() ) : ?>
					<header class="page-header">
						<h1 class="page-title"><?php echo single_post_title(); ?></h1>
					</header>
				<?php endif; ?>

				<?php do_action( 'conversions_loop_before' ); ?>

				<?php if ( have_posts() ) : ?>

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


	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php
get_footer();
