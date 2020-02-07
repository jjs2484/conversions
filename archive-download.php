<?php
/**
 * Easy Digital Downloads archive page
 *
 * This is used by default unless EDD_DISABLE_ARCHIVE is set to true
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$edd = new conversions\easy_digital_downloads();
?>

<div class="wrapper content-wrapper" id="edd-archive-wrapper">

	<div class="container-fluid" id="content" tabindex="-1">

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

					<div class="<?php echo esc_attr( $edd->conversions_edd_archive_list_classes() ); ?>">

						<?php
						while ( have_posts() ) :

							the_post();

							// Include the download-grid template for the content.
							get_template_part( 'partials/download', 'grid' );

						endwhile;
						?>

					</div>

				<?php else : ?>

					<?php get_template_part( 'partials/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php conversions()->template->pagination(); ?>

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'partials/right-sidebar-check' ); ?>

	</div> <!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php
get_footer();
