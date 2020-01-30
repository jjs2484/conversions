<?php

namespace conversions;

/**
	@brief		Extras
	@since		2019-08-15 23:01:47
**/
class Extras
{
	/**
		@brief		Constructor.
		@since		2019-08-15 23:01:47
	**/
	public function __construct()
	{
		add_action( 'wp_head', [ $this, 'wp_head' ] );
		add_filter( 'body_class', [ $this, 'body_class' ] );
		add_filter( 'excerpt_more', [ $this, 'excerpt_more' ] );
		add_filter( 'get_custom_logo', [ $this, 'get_custom_logo' ] );
		add_filter( 'wp_trim_excerpt', [ $this, 'wp_trim_excerpt' ] );
		add_action( 'after_setup_theme', [ $this, 'set_content_width' ] );
		add_action( 'template_redirect', [ $this, 'adjust_content_width' ] );
	}

	/**
		@brief		body_class
		@since		2019-08-18 19:32:27
	**/
	public function body_class( $classes )
	{
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
		// Adds a class of no-sidebar if sidebar is inactive.
		if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) {
			$classes[] = 'no-sidebar';
		}
		// Adds a class of no-sidebar if is full width page template
		if ( is_page_template( 'page-templates/fullwidthpage.php' ) || is_page_template( 'page-templates/pagebuilder-fullwidth.php' ) ) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}

	/**
		@brief		excerpt_more
		@since		2019-08-18 22:41:17
	**/
	public function excerpt_more( $more )
	{
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}

	/**
		@brief		get_custom_logo
		@since		2019-08-18 19:33:26
	**/
	public function get_custom_logo( $html )
	{
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"', $html );

		return $html;
	}

	/**
		@brief		wp_head
		@since		2019-08-18 19:40:02
	**/
	public function wp_head()
	{
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
		}
	}

	/**
		@brief		wp_trim_excerpt
		@since		2019-08-18 22:41:53
	**/
	public function wp_trim_excerpt( $post_excerpt )
	{
		global $post;
		if ( ! is_admin() && $post->post_type != 'download') {
			$post_excerpt = $post_excerpt . ' [...]<p><a class="btn '. esc_attr( get_theme_mod( 'conversions_blog_more_btn', 'btn-secondary' ) ) .' conversions-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Read More...',
			'conversions' ) . '</a></p>';
		}
		return $post_excerpt;
	}

	/**
		@brief Set the content_width based on the theme's design and stylesheet.
		@since 2019-10-30 01:32:58
	**/
	public function set_content_width()
	{
		if ( ! isset( $content_width ) ) {
			$content_width = 1140 * .75 - ( 15 * 2 );
		}
	}

	/**
		@brief Adjust content_width in certain contexts.
		@since 2019-10-30 01:32:58
	**/
	public function adjust_content_width() 
	{
		if ( is_page_template( 'page-templates/fullwidthpage.php' ) || is_page_template( 'page-templates/homepage.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) || ! is_active_sidebar( 'sidebar-2' ) ) {
			global $content_width;
			$content_width = 1140 - ( 15 * 2 );
		}
	}

}
new Extras();
