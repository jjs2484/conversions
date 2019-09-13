<?php
/**
 * Search results partial template.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('card shadow-sm mb-5'); ?> id="post-<?php the_ID(); ?>">

	<div class="card-body pb-1">

		<header class="entry-header">

			<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>

				<div class="entry-meta">
					<ul class="byline list-inline">
						<li class="list-inline-item"><?php conversions()->template->posted_by(); ?></li>
						<li class="list-inline-item"><?php conversions()->template->posted_on(); ?></li>
						<li class="list-inline-item"><?php conversions()->template->reading_time(); ?></li>
						<li class="list-inline-item"><?php conversions()->template->single_comments(); ?></li>
					</ul>
    			</div>

			<?php endif; ?>

		</header><!-- .entry-header -->

		<div class="entry-summary">

			<?php the_excerpt(); ?>

		</div><!-- .entry-summary -->

	</div>

	<div class="card-footer text-muted d-flex justify-content-between align-items-center small">
		
		<footer class="entry-footer">
			<div class="d-flex align-items-center">
          		<?php conversions()->template->entry_footer(); ?>
        	</div>
		</footer><!-- .entry-footer -->

	</div>

</article><!-- #post-## -->