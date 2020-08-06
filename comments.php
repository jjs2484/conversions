<?php
/**
 * The template for displaying comments and comment form
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="comments-area" id="comments">

	<?php if ( have_comments() ) : ?>

		<h3 class="comments-title pb-2 border-bottom">

			<?php
			$comments_number = absint( get_comments_number() );
			if ( 1 === (int) $comments_number ) {
				printf(
					/* translators: %s: post title */
					esc_html_x( 'One comment on &ldquo;%s&rdquo;', 'comments title', 'conversions' ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					esc_html(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s comment on &ldquo;%2$s&rdquo;',
							'%1$s comments on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'conversions'
						)
					),
					esc_html( number_format_i18n( $comments_number ) ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			}
			?>

		</h3><!-- .comments-title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>

			<nav class="comment-navigation" id="comment-nav-above">

				<h2 class="sr-only"><?php esc_html_e( 'Comment navigation', 'conversions' ); ?></h2>

				<?php
				if ( get_previous_comments_link() ) {
					?>
					<div class="nav-previous">
						<?php
						previous_comments_link( __( '&larr; Older Comments', 'conversions' ) );
						?>
					</div>
					<?php
				}
				if ( get_next_comments_link() ) {
					?>
					<div class="nav-next">
						<?php
						next_comments_link( __( 'Newer Comments &rarr;', 'conversions' ) );
						?>
					</div>
					<?php
				}
				?>

			</nav><!-- #comment-nav-above -->

		<?php endif; // check for comment navigation. ?>

		<ul class="list-unstyled">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => '60',
					'walker'      => new \conversions\WP_Bootstrap_Comment_Walker(),
				)
			);
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>

			<nav class="comment-navigation" id="comment-nav-below">

				<h2 class="sr-only"><?php esc_html_e( 'Comment navigation', 'conversions' ); ?></h2>

				<?php
				if ( get_previous_comments_link() ) {
					?>
					<div class="nav-previous">
						<?php
						previous_comments_link( __( '&larr; Older Comments', 'conversions' ) );
						?>
					</div>
					<?php
				}
				if ( get_next_comments_link() ) {
					?>
					<div class="nav-next">
						<?php
						next_comments_link( __( 'Newer Comments &rarr;', 'conversions' ) );
						?>
					</div>
					<?php
				}
				?>

			</nav><!-- #comment-nav-below -->

		<?php endif; // check for comment navigation. ?>

	<?php endif; // endif have_comments. ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'conversions' ); ?></p>

	<?php endif; ?>

	<?php comment_form(); // Render comments form. ?>

</div><!-- #comments -->
