<?php
/**
 * Theme setup.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'conversions_setup' );

if ( ! function_exists( 'conversions_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function conversions_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'conversions' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		// Add fullscreen thumbnail size
		add_image_size( 'fullscreen', 1920, 9999 );

		// Add 
		add_image_size( 'homepage-news', 9999, 200 );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'conversions_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );

		// Add classic editor styles
		add_editor_style( 'build/classic-editor-style.css' );

		// Add support for responsive embedded content - gutenberg
		add_theme_support( 'responsive-embeds' );

		// Add support for wide images - gutenberg
		add_theme_support( 'align-wide' );

		// Register the color palette options - gutenberg
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Primary', 'conversions' ),
				'slug'  => 'primary',
				'color'	=> '#007BFF',
			),
			array(
				'name'  => __( 'Secondary', 'conversions' ),
				'slug'  => 'secondary',
				'color' => '#6c757d',
			),
			array(
				'name'  => __( 'Success', 'conversions' ),
				'slug'  => 'success',
				'color' => '#019875',
			),
			array(
				'name'	=> __( 'Danger', 'conversions' ),
				'slug'	=> 'danger',
				'color'	=> '#dc3545',
			),
			array(
				'name'	=> __( 'Info', 'conversions' ),
				'slug'	=> 'info',
				'color'	=> '#17a2b8',
			),
			array(
				'name'	=> __( 'Dark', 'conversions' ),
				'slug'	=> 'dark',
				'color'	=> '#151B26',
			),
		) );

		// Check and setup theme default settings.
		conversions_theme_default_settings();

	}
}


add_filter( 'excerpt_more', 'conversions_custom_excerpt_more' );

if ( ! function_exists( 'conversions_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function conversions_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}
}

add_filter( 'wp_trim_excerpt', 'conversions_all_excerpts_get_more_link' );

if ( ! function_exists( 'conversions_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function conversions_all_excerpts_get_more_link( $post_excerpt ) {
		if ( ! is_admin() ) {
			$post_excerpt = $post_excerpt . ' [...]<p><a class="btn btn-secondary conversions-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Read More...',
			'conversions' ) . '</a></p>';
		}
		return $post_excerpt;
	}
}