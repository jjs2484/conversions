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
			require_once( __DIR__ . '/comments.php' );
			require_once( __DIR__ . '/customizer.php' );
			require_once( __DIR__ . '/enqueue.php' );
			require_once( __DIR__ . '/extras.php' );
			require_once( __DIR__ . '/homepage.php' );
			require_once( __DIR__ . '/template.php' );
			require_once( __DIR__ . '/widgets.php' );
			require_once( __DIR__ . '/woocommerce.php' );
			require_once( __DIR__ . '/wp_bootstrap_comment_walker.php' );
			require_once( __DIR__ . '/wp_bootstrap_navwalker.php' );

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
			register_nav_menus( [
				'primary' => __( 'Primary Menu', 'conversions' ),
			] );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', [
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			] );

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
			add_theme_support( 'custom-background', apply_filters( 'conversions_custom_background_args', [
				'default-color' => 'ffffff',
				'default-image' => '',
			] ) );

			// Set up the WordPress Theme logo feature.
			add_theme_support( 'custom-logo' );

			// Add classic editor styles
			add_editor_style( 'build/classic-editor-style.min.css' );

			// Add support for responsive embedded content - gutenberg
			add_theme_support( 'responsive-embeds' );

			// Add support for wide images - gutenberg
			add_theme_support( 'align-wide' );

			// Register the color palette options - gutenberg
			add_theme_support( 'editor-color-palette', [
				[
					'name'  => __( 'Primary', 'conversions' ),
					'slug'  => 'primary',
					'color'	=> '#007BFF',
				],
				[
					'name'  => __( 'Secondary', 'conversions' ),
					'slug'  => 'secondary',
					'color' => '#6c757d',
				],
				[
					'name'  => __( 'Success', 'conversions' ),
					'slug'  => 'success',
					'color' => '#019875',
				],
				[
					'name'	=> __( 'Danger', 'conversions' ),
					'slug'	=> 'danger',
					'color'	=> '#dc3545',
				],
				[
					'name'	=> __( 'Warning', 'conversions' ),
					'slug'	=> 'warning',
					'color'	=> '#ffc107',
				],
				[
					'name'	=> __( 'Info', 'conversions' ),
					'slug'	=> 'info',
					'color'	=> '#17a2b8',
				],
				[
					'name'	=> __( 'Light', 'conversions' ),
					'slug'	=> 'light',
					'color'	=> '#f8f9fa',
				],
				[
					'name'	=> __( 'Dark', 'conversions' ),
					'slug'	=> 'dark',
					'color'	=> '#151B26',
				],
			] );

			// Check if settings are set, if not set defaults.
			$defaults = [
				'conversions_logo_height' => '40',
				'conversions_nav_position' => 'fixed-top',
				'conversions_nav_colors' => 'white',
				'conversions_nav_dropshadow' => true,
				'conversions_nav_tbpadding' => '8',
				'conversions_nav_mobile_type' => 'collapse',
				'conversions_nav_button' => 'no',
				'conversions_nav_search_icon' => false,
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
				'conversions_featured_img_overlay' => '.5',
				'conversions_featured_title_color' => '#ffffff',
				'conversions_blog_sticky_posts' => 'primary',
				'conversions_blog_more_btn' => 'btn-secondary',
				'conversions_comment_btn' => 'btn-secondary',
				'conversions_blog_related' => true,
				'conversions_blog_taxonomy' => 'categories',
				'conversions_blog_postnav' => true,
				'conversions_hh_content_position' => 'col-lg-6',
				'conversions_hh_img_parallax' => false,
				'conversions_hh_img_height' => '72',
				'conversions_hh_img_color' => '#000000',
				'conversions_hh_img_overlay' => '.5',
				'conversions_hh_button' => 'no',
				'conversions_hh_vbtn' => 'no',
				'conversions_hc_logo_width' => '100',
				'conversions_hc_respond' => 'auto',
				'conversions_hc_sm' => '2',
				'conversions_hc_md' => '3',
				'conversions_hc_lg' => '4',
				'conversions_hc_max' => '5',
				'conversions_features_sm' => '2',
				'conversions_features_md' => '2',
				'conversions_features_lg' => '3',
				'conversions_pricing_respond' => 'auto',
				'conversions_pricing_sm' => '1',
				'conversions_pricing_md' => '1',
				'conversions_pricing_lg' => '3',
				'conversions_news_mposts' => '2',
				'conversions_hcta_state' => false,
				'conversions_hcta_bg_choice' => 'gradient',
				'conversions_hcta_bg_gradient' => 'crystal-clear',
				'conversions_hcta_title_color' => '#ffffff',
				'conversions_hcta_desc_color' => '#ffffff',
				'conversions_hcta_btn' => 'no',
				'conversions_woo_products' => 'no',
				'conversions_woo_product_limit' => '8',
				'conversions_woo_product_columns' => '4',
				'conversions_woo_products_order' => 'popularity',
			];

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