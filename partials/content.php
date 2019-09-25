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
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="c-news__img-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title(); ?>">
			<?php
				/* grab the featured image sizes*/
				$blog_index_img = get_post_thumbnail_id( $post->ID );
				$blog_index_img_sm = wp_get_attachment_image_src( $blog_index_img, 'news-image', false );
        		$blog_index_img_lg = wp_get_attachment_image_src( $blog_index_img, 'blog-index', false );
        		$blog_index_img_alt = get_post_meta( $blog_index_img, '_wp_attachment_image_alt', true );

        		echo '<img class="card-img-top" src="'.esc_url($blog_index_img_lg[0]).'" alt="'.$blog_index_img_alt.'" srcset="'.esc_url($blog_index_img_sm[0]).' 550w, '.esc_url($blog_index_img_lg[0]).' 1200w">';
			?>
		</a>
	<?php endif; ?>

	<div class="card-body pb-1">
	
		<header class="entry-header">

			<?php the_title( sprintf( '<h2 class="h3 entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>

				<div class="entry-meta">
					<ul class="byline list-inline">
						<li class="list-inline-item cpb"><?php conversions()->template->posted_by(); ?></li>
						<li class="list-inline-item cpo"><?php conversions()->template->posted_on(); ?></li>
						<li class="list-inline-item crt"><?php conversions()->template->reading_time(); ?></li>
						<li class="list-inline-item csc"><?php conversions()->template->single_comments(); ?></li>
					</ul>
    			</div>

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

	<div class="card-footer text-muted small">
		<footer class="entry-footer">
          	<?php conversions()->template->entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-## -->