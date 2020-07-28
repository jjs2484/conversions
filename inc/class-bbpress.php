<?php
/**
 * bbPress functions
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
		/**
		* First unhook the WooCommerce wrappers
		*/
		add_filter( 'bbp_get_topic_pagination_links', [ $this, 'bbp_get_topic_pagination_links' ], 777 );

	}

	/**
	 * Adds Bootstrap syntax to the bbPress Topic pagination.
	 *
	 * @since 2020-07-26
	 *
	 * @param string $pagination String of the topic pagination.
	 */
	public function bbp_get_topic_pagination_links( $pagination ) {

		$pagination = str_replace( 'span', 'a', $pagination );
		$pagination = str_replace( 'page-numbers', 'page-link', $pagination );
		$pagination = str_replace( '<a', '<li class="page-item"><a', $pagination );
		$pagination = str_replace( '</a>', '</a></li>', $pagination );
		$pagination = str_replace( '<li class="page-item"><a aria-current="page" class="page-link current">', '<li class="page-item active"><a aria-current="page" class="page-link">', $pagination );
		$pagination = str_replace( '<li class="page-item"><a class="page-link dots">', '<li class="page-item disabled"><a class="page-link dots">', $pagination );

		return $pagination;
	}

}
new bbPress();
