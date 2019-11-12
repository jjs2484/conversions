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
			add_editor_style( 'build/classic-editor-style.min.css' );

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

			// Check if settings are set, if not set defaults.
			$defaults = array(
				'conversions_logo_height' => '40',
				'conversions_nav_position' => 'fixed-top',
				'conversions_nav_colors' => 'white',
				'conversions_nav_dropshadow' => true,
				'conversions_nav_tbpadding' => '8',
				'conversions_nav_mobile_type' => 'collapse',
				'conversions_nav_button' => 'no',
				'conversions_nav_search_icon' => false,
				'conversions_container_width' => '1140',
				'conversions_sidebar_position' => 'right',
				'conversions_sidebar_mv' => true,
				'conversions_google_fonts' => true,
				'conversions_headings_fonts' => 'Roboto:400,400italic,700,700italic',
				'conversions_body_fonts' => 'Roboto:400,400italic,700,700italic',
				'conversions_link_color' => '#0068d7',
				'conversions_link_hcolor' => '#00698c',
				'conversions_footer_bg_color' => '#ffffff',
				'conversions_footer_text_color' => '#222222',
				'conversions_footer_link_color' => '#0068d7',
				'conversions_footer_link_hcolor' => '#00698c',
				'conversions_social_size' => '20',
				'conversions_wc_cart_nav' => true,
				'conversions_wc_account' => false,
				'conversions_wc_checkout_columns' => 'two-column',
				'conversions_wc_primary_btn' => 'btn-outline-primary',
				'conversions_wc_secondary_btn' => 'btn-primary',
				'conversions_featured_img_parallax' => false,
				'conversions_featured_img_height' => '65',
				'conversions_featured_img_color' => '#000000',
				'conversions_featured_img_overlay' => '.4',
				'conversions_featured_title_color' => '#ffffff',
				'conversions_blog_sticky_posts' => 'primary',
				'conversions_blog_more_btn' => 'btn-secondary',
				'conversions_comment_btn' => 'btn-secondary',
				'conversions_blog_related' => true,
				'conversions_blog_taxonomy' => 'categories',
				'conversions_hh_title_color' => '#222222',
				'conversions_hh_desc_color' => '#222222',
				'conversions_hh_content_position' => 'col-lg-10 d-flex flex-column text-center mx-auto',
				'conversions_hh_img_parallax' => false,
				'conversions_hh_img_height' => '72',
				'conversions_hh_img_color' => '#000000',
				'conversions_hh_img_overlay' => '.4',
				'conversions_hh_button' => 'no',
				'conversions_hh_vbtn' => 'no',
				'conversions_hc_bg_color' => '#F3F3F3',
				'conversions_hc_logo_width' => '100',
				'conversions_hc_respond' => 'auto',
				'conversions_hc_sm' => '2',
				'conversions_hc_md' => '3',
				'conversions_hc_lg' => '4',
				'conversions_hc_max' => '5',
				'conversions_features_title' => 'Features section',
				'conversions_features_desc' => 'We offer custom services to our clients. Have a project that you would like to work together on? We would love to hear more about it.',
				'conversions_features_sm' => '2',
				'conversions_features_md' => '2',
				'conversions_features_lg' => '3',
				'conversions_pricing_bg_color' => '#F3F3F3',
				'conversions_pricing_title' => 'Pricing section',
				'conversions_pricing_desc' => 'We offer custom services to our clients. Have a project that you would like to work together on? We would love to hear more about it.',
				'conversions_pricing_row' => '3',
				'conversions_news_bg_color' => '#F3F3F3',
				'conversions_news_title' => 'Latest News',
				'conversions_news_desc' => 'Read our latest news. We post regularly to keep you up to date on a variety of topics in our industry.',
				'conversions_news_mposts' => '2',
				'conversions_testimonials_title' => 'What customers say',
				'conversions_testimonials_desc' => 'We appreciate our customers feedback! Here is what some of our customers have to say about us.',
				'conversions_hcta_state' => true,		
				'conversions_hcta_bg_choice' => 'gradient',
				'conversions_hcta_bg_gradient' => 'crystal-clear',
				'conversions_hcta_title' => 'Get started today!',
				'conversions_hcta_title_color' => '#ffffff',
				'conversions_hcta_desc_color' => '#ffffff',
				'conversions_hcta_desc' => 'Conversions is an HTML5 template, and its mission to improve the future of web. Are you ready to join us?',
				'conversions_hcta_btn' => 'btn-light',
				'conversions_hcta_btn_text' => 'Click me',
				'conversions_cta_btn_url' => 'https://wordpress.org',
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
