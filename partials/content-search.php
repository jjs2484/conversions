<?php
/**
 * Search results partial template
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'card shadow-sm mb-5' ); ?> id="post-<?php the_ID(); ?>">

	<div class="card-body pb-1">

		<header class="entry-header">

			<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

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

		<div class="entry-summary">

			<?php the_excerpt(); ?>

		</div><!-- .entry-summary -->

	</div>

	<div class="card-footer text-muted small">

		<footer class="entry-footer">
			<?php conversions()->template->entry_footer(); ?>
		</footer><!-- .entry-footer -->

	</div>

</article><!-- #post-## -->
