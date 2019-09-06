
<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('card shadow-sm mb-5'); ?> id="post-<?php the_ID(); ?>">

	<!-- Post image -->
	<a class="c-news__img-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title(); ?>">
		<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'card-img-top' ) ); ?>
	</a>

	<div class="card-body pb-1">
	
		<header class="entry-header">

			<?php the_title( sprintf( '<h2 class="h3 entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>

				<div class="entry-meta">
					<span class="d-block">
						<?php conversions()->template->posted_on(); ?>
					</span>
					<span class="d-block">
						<?php conversions()->template->reading_time(); ?>
					</span>
				</div><!-- .entry-meta -->

			<?php endif; ?>

		</header><!-- .entry-header -->

		<div class="entry-content">

			<?php the_excerpt(); ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'conversions' ),
					'after'  => '</div>',
				) );
			?>

		</div><!-- .entry-content -->

	</div>

	<div class="card-footer text-muted d-flex justify-content-between align-items-center small">
		<footer class="entry-footer">
			<div class="d-flex align-items-center">
          		<?php conversions()->template->entry_footer(); ?>
        	</div>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-## -->