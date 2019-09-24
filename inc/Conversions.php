<?php

namespace conversions
{
	/**
		@brief		Conversions class.
		@since		2019-08-06 21:06:48
	**/
	class Conversions
	{
		/**
			@brief		The instance of the theme.
			@since		2019-08-18 19:52:29
		**/
		public static $instance;
		/**
			@brief		Constructor.
			@since		2019-08-06 21:07:52
		**/
		public function __construct()
		{
			static::$instance = $this;
		}

		/**
			@brief		Load the various modules.
			@since		2019-08-18 19:55:09
		**/
		public function load()
		{
			require_once( __DIR__ . '/Comments.php' );
			require_once( __DIR__ . '/Customizer.php' );
			require_once( __DIR__ . '/Enqueue.php' );
			require_once( __DIR__ . '/Extras.php' );
			require_once( __DIR__ . '/Template.php' );
			require_once( __DIR__ . '/Widgets.php' );
			require_once( __DIR__ . '/WooCommerce.php' );
			require_once( __DIR__ . '/WP_Bootstrap_Comment-Walker.php' );
			require_once( __DIR__ . '/WP_Bootstrap_Navwalker.php' );

			$this->setup();
		}

		/**
			@brief		Setup the theme.
			@since		2019-08-18 20:03:39
		**/
		public function setup()
		{
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
			
			// Add news image size
			add_image_size( 'news-image', 550, 320, true );

			// Add blog index image size
			add_image_size( 'blog-index', 1200, 480, true );

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
					'name'	=> __( 'Warning', 'conversions' ),
					'slug'	=> 'warning',
					'color'	=> '#ffc107',
				),
				array(
					'name'	=> __( 'Info', 'conversions' ),
					'slug'	=> 'info',
					'color'	=> '#17a2b8',
				),
				array(
					'name'	=> __( 'Light', 'conversions' ),
					'slug'	=> 'light',
					'color'	=> '#f8f9fa',
				),
				array(
					'name'	=> __( 'Dark', 'conversions' ),
					'slug'	=> 'dark',
					'color'	=> '#151B26',
				),
			) );

			// check if settings are set, if not set defaults.
			// Caution: DO NOT check existence using === always check with == .

			$defaults = array(
				'conversions_logo_height' => '60',
				'conversions_header_position' => 'fixed-top',
				'conversions_header_colors' => 'dark',
				'conversions_header_dropshadow' => 'no',
				'conversions_header_tpadding' => '8',
				'conversions_header_bpadding' => '8',
				'conversions_nav_mobile_type' => 'offcanvas',
				'conversions_nav_button' => 'no',
				'conversions_nav_button_text' => 'Click me',
				'conversions_nav_button_url' => 'https://wordpress.org',
				'conversions_nav_search_icon' => 'show',
				'conversions_container_width' => '1140',
				'conversions_sidebar_position' => 'right',
				'conversions_sidebar_mvisibility' => 'show',
				'conversions_google_fonts' => 'enable_gfonts',
				'conversions_headings_fonts' => 'Roboto:400,400italic,700,700italic',
				'conversions_body_fonts' => 'Roboto:400,400italic,700,700italic',
				'conversions_heading_color' => '#222222',
				'conversions_text_color' => '#111111',
				'conversions_link_color' => '#0057b4',
				'conversions_link_hcolor' => '#004086',
				'conversions_footer_background_color' => '#3c3d45',
				'conversions_footer_heading_color' => '#ffffff',
				'conversions_footer_text_color' => '#ffffff',
				'conversions_footer_link_color' => '#ccffff',
				'conversions_footer_link_hcolor' => '#c9dede',
				'conversions_copyright_text' => 'conversions',
				'conversions_copyright_background_color' => '#ffffff',
				'conversions_copyright_text_color' => '#111111',
				'conversions_copyright_link_color' => '#0057b4',
				'conversions_copyright_link_hcolor' => '#004086',
				'conversions_social_link_target' => '_self',
				'conversions_social_size' => '22',
				'conversions_social_link_color' => '#0057b4',
				'conversions_social_link_hcolor' => '#004086',
				'conversions_wccart_nav' => 'yes',
				'conversions_wccheckout_columns' => 'two-column',
				'conversions_blog_img_overlay' => '.5',
				'conversions_blog_related' => 'enable',
				'conversions_blog_taxonomy' => 'categories'
			);

			foreach ($defaults as $c => $v) {
				if ( '' == get_theme_mod( $c ) ) {
					set_theme_mod($c, $v);
				}
			}
		}
	}
}
namespace
{
	/**
		@brief		Return the conversions namespace.
		@since		2019-08-18 19:53:07
	**/
	function conversions()
	{
		return \conversions\Conversions::$instance;

	}

	new \conversions\Conversions();
	conversions()->load();
}
