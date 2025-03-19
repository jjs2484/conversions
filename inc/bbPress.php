<?php
/**
 * BBPress functions
 *
 * @package conversions
 */

namespace conversions;

/**
 * Class bbPress
 *
 * @since 2020-07-24
 */
class bbPress {
	/**
	 * Class constructor.
	 *
	 * @since 2020-07-24
	 */
	public function __construct() {
		add_filter( 'bbp_get_topic_pagination_links', [ $this, 'bbp_get_pagination_links' ] );
		add_filter( 'bbp_get_forum_pagination_links', [ $this, 'bbp_get_pagination_links' ] );
		add_action( 'bbp_theme_before_topic_freshness_link', [ $this, 'bbp_freshness_link_text' ] );
		add_action( 'bbp_theme_before_forum_freshness_link', [ $this, 'bbp_freshness_link_text' ] );
	}

	/**
	 * Adds Bootstrap syntax to the bbPress pagination.
	 *
	 * @since 2020-07-26
	 *
	 * @param string $pagination String of the topic pagination.
	 */
	public function bbp_get_pagination_links( $pagination ) {

		// Ensure $pagination is a string.
		$pagination = $pagination ?? '';

		$pagination = str_replace( 'span', 'a', $pagination );
		$pagination = str_replace( 'page-numbers', 'page-link', $pagination );
		$pagination = str_replace( '<a', '<li class="page-item"><a', $pagination );
		$pagination = str_replace( '</a>', '</a></li>', $pagination );
		$pagination = str_replace( '<li class="page-item"><a aria-current="page" class="page-link current">', '<li class="page-item active"><a aria-current="page" class="page-link">', $pagination );
		$pagination = str_replace( '<li class="page-item"><a class="page-link dots">', '<li class="page-item disabled"><a class="page-link dots">', $pagination );

		return $pagination;
	}

	/**
	 * Adds text before the last post link -- for mobile devices
	 *
	 * @since 2020-08-03
	 */
	public function bbp_freshness_link_text() {
		echo '<span class="c-bbp-freshness-text">' . esc_html__( 'Last post:', 'conversions' ) . '</span>';
	}

}
