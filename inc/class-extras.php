<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package conversions
 */

namespace conversions;

/**
 * Class Extras
 *
 * @since 2019-08-15
 */
class Extras {
	/**
	 * Class constructor.
	 *
	 * @since 2019-08-15
	 */
	public function __construct() {
		add_action( 'wp_head', [ $this, 'wp_head' ] );
		add_filter( 'body_class', [ $this, 'body_class' ] );
		add_filter( 'excerpt_more', [ $this, 'excerpt_more' ] );
		add_filter( 'get_custom_logo', [ $this, 'get_custom_logo' ] );
		add_filter( 'wp_trim_excerpt', [ $this, 'wp_trim_excerpt' ] );
		add_action( 'after_setup_theme', [ $this, 'set_content_width' ] );
		add_action( 'template_redirect', [ $this, 'adjust_content_width' ] );
	}

	/**
	 * Add custom classes to the body tag.
	 *
	 * @since 2019-08-18
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public function body_class( $classes ) {
		foreach ( $classes as $key => $value ) {
			if ( 'tag' == $value ) {
				unset( $classes[ $key ] );
			}
		}

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}
		// Adds class of no-sidebar if no active sidebar and not singular download post.
		if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) && ! is_singular( 'download' ) ) {
			$classes[] = 'no-sidebar';
		}
		// Adds class of no-sidebar if is full width page template.
		if ( is_page_template( 'page-templates/fullwidthpage.php' ) || is_page_template( 'page-templates/pagebuilder-fullwidth.php' ) ) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}

	/**
	 * Removes ... from excerpt read more link.
	 *
	 * @since 2019-08-18
	 *
	 * @param string $more The excerpt.
	 * @return string
	 */
	public function excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}

	/**
	 * Filters the custom logo output.
	 *
	 * @since 2019-08-18
	 *
	 * @param string $html Custom logo HTML output.
	 * @return string Custom logo markup.
	 */
	public function get_custom_logo( $html ) {
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"', $html );

		return $html;
	}

	/**
	 * Add pingback url to wp_head for singular posts.
	 *
	 * @since 2019-08-18
	 */
	public function wp_head() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
		}
	}

	/**
	 * Filters the trimmed excerpt string.
	 *
	 * @since 2019-08-18
	 *
	 * @param string $post_excerpt The trimmed text.
	 * @return string $post_excerpt Custom excerpt markup.
	 */
	public function wp_trim_excerpt( $post_excerpt ) {
		global $post;
		if ( ! is_admin() && $post->post_type != 'download' ) {
			$post_excerpt = $post_excerpt . ' [...]<p><a class="btn ' . esc_attr( get_theme_mod( 'conversions_blog_more_btn', 'btn-secondary' ) ) . ' conversions-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Read More...', 'conversions' ) . '</a></p>';
		}
		return $post_excerpt;
	}

	/**
	 * Set the content_width based on the theme design and stylesheet.
	 *
	 * @since 2019-10-30
	 */
	public function set_content_width() {
		if ( ! isset( $content_width ) ) {
			$content_width = 1140 * .75 - ( 15 * 2 );
		}
	}

	/**
	 * Adjust content_width in certain contexts.
	 *
	 * @since 2019-10-30
	 */
	public function adjust_content_width() {
		if ( is_page_template( 'page-templates/fullwidthpage.php' ) || is_page_template( 'page-templates/homepage.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) || ! is_active_sidebar( 'sidebar-2' ) ) {
			global $content_width;
			$content_width = 1140 - ( 15 * 2 ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
		}
	}

}
new Extras();
