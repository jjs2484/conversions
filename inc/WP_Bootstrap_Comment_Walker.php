<?php
/**
 * WP Bootstrap Comment Walker
 *
 * @since 02/27/20
 *
 * @package conversions
 */

namespace conversions;

/**
 * Bootstrap_Comment_Walker class.
 *
 * @extends Walker_Comment
 */
class WP_Bootstrap_Comment_Walker extends \Walker_Comment {

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @see wp_list_comments()
	 * @see https://developer.wordpress.org/reference/functions/get_comment_author_url/
	 * @see https://developer.wordpress.org/reference/functions/get_comment_author/
	 * @see https://developer.wordpress.org/reference/functions/get_avatar/
	 * @see https://developer.wordpress.org/reference/functions/get_comment_reply_link/
	 * @see https://developer.wordpress.org/reference/functions/get_edit_comment_link/
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {

		$tag  = ( 'div' === $args['style'] ) ? 'div' : 'li';
		$type = get_comment_type();

		?>
		<<?php echo $tag; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media">
				<div class="commenter d-flex flex-row mb-1">

					<?php if ( 0 != $args['avatar_size'] && 'pingback' !== $type && 'trackback' !== $type ) { ?>
						<?php echo get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'comment_avatar mr-3' ) ); ?>
					<?php }; ?>

					<div class="comment-meta">
						<div class="comment-author vcard">
							<?php
							printf(
								/* translators: 1: Comment author name and HTML link. 2: Screen reader text. */
								'%s <span class="says sr-only">%s</span>',
								sprintf(
									'<b class="media-heading fn">%s</b>',
									get_comment_author_link( $comment )
								),
								esc_html__( 'says:', 'conversions' )
							);
							?>
						</div><!-- /.comment-author -->

						<ul class="comment-metadata list-inline">
							<li class="list-inline-item">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php
									printf(
										/* translators: time. */
										esc_html__( '%s ago', 'conversions' ),
										human_time_diff( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											get_comment_time( 'U' ),
											strtotime( wp_date( 'Y-m-d H:i:s' ) )
										)
									);
									?>
								</time>
							</li>
							<li class="list-inline-item">
								<span class="comm-perm">
									<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
										<?php esc_html_e( 'Permalink', 'conversions' ); ?>
									</a>
								</span>
							</li>
						</ul><!-- /.comment-metadata -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
							<div class="alert alert-warning my-2 comment-awaiting-moderation" role="alert">
								<?php esc_html_e( 'Your comment is awaiting moderation.', 'conversions' ); ?>
							</div>
						<?php endif; ?>
					</div><!-- /.comment-meta -->

				</div>

				<div class="media-body w-100">
					<div class="mb-4">
						<div class="comment-content">
							<?php comment_text(); ?>
						</div><!-- /.comment-content -->

						<ul class="list-inline">
							<li class="list-inline-item">
								<?php edit_comment_link( __( 'Edit', 'conversions' ), '<span class="edit-link">', '</span>' ); ?>
							</li>
							<li class="list-inline-item">
								<?php $this->comment_reply_link( $comment, $depth, $args, $add_below = 'reply-comment' ); ?>
							</li>
						</ul><!-- comment actions -->
					</div>
				</div><!-- /.media-body -->
			</article><!-- .media -->
		<?php
	}

	/**
	 * Displays the HTML content for reply to comment link.
	 *
	 * @access protected
	 * @since 0.1.0
	 *
	 * @param object $comment   Comment being replied to. Default current comment.
	 * @param int    $depth     Depth of comment.
	 * @param array  $args      An array of arguments for the Walker Object.
	 * @param string $add_below The id of the element where the comment form will be placed.
	 */
	protected function comment_reply_link( $comment, $depth, $args, $add_below = 'div-comment' ) {
		$type = get_comment_type();
		if ( 'pingback' === $type || 'trackback' === $type ) {
			return;
		}
		comment_reply_link(
			array_merge(
				$args,
				array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div id="reply-comment-' . $comment->comment_ID . '" class="reply">',
					'after'     => '</div>',
				)
			)
		);
	}
}
