<?php

namespace conversions;

/**
	@brief		Custom comments.
	@since		2019-08-15 23:01:47
**/
class Comments
{
	/**
		@brief		Constructor.
		@since		2019-08-15 23:01:47
	**/
	public function __construct()
	{
		add_filter( 'comment_form_default_fields', [ $this, 'comment_form_default_fields' ] );
		add_filter( 'comment_form_defaults', [ $this, 'comment_form_defaults' ] );
	}

	/**
		@brief		comment_form_default_fields
		@since		2019-08-15 23:03:41
	**/
	public function comment_form_default_fields( $fields )
	{
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );
		$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
		$consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		$fields    = [
			'author'  => '<div class="form-group comment-form-author"><label for="author">'
				. __( 'Name', 'conversions' ) . ( $req ? ' <span class="required">*</span>' : '' )
				. '</label> ' . '<input class="form-control" id="author" name="author" type="text" value="'
				. esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . '></div>',
			'email'   => '<div class="form-group comment-form-email"><label for="email">'
				. __( 'Email', 'conversions' ) . ( $req ? ' <span class="required">*</span>' : '' )
				. '</label> ' . '<input class="form-control" id="email" name="email" '
				. ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . '></div>',
			'url'     => '<div class="form-group comment-form-url"><label for="url">'
				. __( 'Website', 'conversions' ) . '</label> ' . '<input class="form-control" id="url" name="url" '
				. ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"></div>',
			'cookies' => '<div class="form-group form-check comment-form-cookies-consent"><input class="form-check-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"'
				. $consent . ' /> ' .	'<label class="form-check-label" for="wp-comment-cookies-consent">'
				. __( 'Save my name, email, and website in this browser for the next time I comment', 'conversions' ) . '</label></div>',
		];

		return $fields;
	}

	/**
		@brief		comment_form_defaults
		@since		2019-08-15 23:07:16
	**/
	public function comment_form_defaults( $args )
	{
		$args['comment_field'] = '<div class="form-group comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'conversions' ) . ( ' <span class="required">*</span>' ) . '</label><textarea class="form-control" id="comment" name="comment" aria-required="true" cols="45" rows="8"></textarea></div>';
		$args['class_submit']  = 'btn '. esc_attr( get_theme_mod( 'conversions_comment_btn', 'btn-secondary' ) ) .''; // since WP 4.1.
		return $args;
	}

}
new Comments();
