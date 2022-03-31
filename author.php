<?php
/**
 * The template for displaying author pages
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper content-wrapper" id="author-wrapper">

	<div class="container-fluid" id="content">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'partials/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<header class="page-header author-header">

					<?php
					$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );
					?>

					<h1><?php esc_html_e( 'About:', 'conversions' ); ?><?php echo esc_html( $curauth->nickname ); ?></h1>

					<?php if ( ! empty( $curauth->ID ) ) : ?>
						<?php echo get_avatar( $curauth->ID ); ?>
					<?php endif; ?>

					<dl>
						<?php if ( ! empty( $curauth->user_url ) ) : ?>
							<dt><?php esc_html_e( 'Website', 'conversions' ); ?></dt>
							<dd>
								<a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
							</dd>
						<?php endif; ?>

						<?php if ( ! empty( $curauth->user_description ) ) : ?>
							<dt><?php esc_html_e( 'Profile', 'conversions' ); ?></dt>
							<dd><?php esc_html( $curauth->user_description ); ?></dd>
						<?php endif; ?>
					</dl>

					<h2><?php esc_html_e( 'Posts by', 'conversions' ); ?> <?php echo esc_html( $curauth->nickname ); ?>
						:</h2>

				</header><!-- .page-header -->

				<ul>

					<!-- The Loop -->
					<?php if ( have_posts() ) : ?>
						<?php
						while ( have_posts() ) :
							the_post();
							?>
							<li>
								<a rel="bookmark" href="<?php esc_url( the_permalink() ); ?>" title="<?php esc_attr_e( 'Permanent Link:', 'conversions' ); ?> <?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
								<?php esc_html_e( 'posted on', 'conversions' ); ?>
								<?php conversions()->template->posted_on(); ?>
							</li>
						<?php endwhile; ?>

					<?php else : ?>

						<?php get_template_part( 'partials/content', 'none' ); ?>

					<?php endif; ?>

					<!-- End Loop -->

				</ul>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php echo conversions()->template->the_posts_pagination(); ?>

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'partials/right-sidebar-check' ); ?>

	</div> <!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php
get_footer();
