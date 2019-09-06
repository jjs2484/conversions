<?php
/**
 * Single post partial template.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php

			if ( ! has_post_thumbnail() ) // check if featured image is set
			{
				echo the_title( '<h1 class="entry-title">', '</h1>' );
			}
		?>

		<div class="entry-meta">
			<span class="d-block">
				<?php conversions()->template->posted_on(); ?>
			</span>
			<span class="d-block">
				<?php conversions()->template->reading_time(); ?>
			</span>
    	</div>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'conversions' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php conversions()->template->entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->