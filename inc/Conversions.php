<?php
/**
 * Conversions theme functions
 *
 * @package conversions
 */

namespace conversions
{
	/**
	 * Conversions class.
	 *
	 * @since 2019-08-06
	 */
	class Conversions {

		/**
		 * The instance of the theme.
		 *
		 * @since 2019-08-18
		 *
		 * @var $instance
		 */
		public static $instance;

		/**
		 * Customizer instance.
		 *
		 * @var $customizer
		 */
		public $customizer;

		/**
		 * Template instance.
		 *
		 * @var $template
		 */
		public $template;

		/**
		 * Widgets instance.
		 *
		 * @var $widgets
		 */
		public $widgets;

		/**
		 * Constructor.
		 *
		 * @since 2019-08-06
		 */
		public function __construct() {
			static::$instance = $this;
		}

		/**
		 * Load language files.
		 *
		 * Runs first (priority 0) so every later __('…','conversions') call
		 * finds its translations and avoids the “_load_textdomain_just_in_time”
		 * notice introduced in WP 6.7.
		 */
		public function load_textdomain() {
			load_theme_textdomain(
				'conversions',
				get_template_directory() . '/languages'
			);
		}

		/**
		 * Load the various modules.
		 *
		 * @since 2019-08-18
		 */
		public function load() {
			new Comments();
			$this->customizer = new Customizer();
			new Enqueue();
			new Extras();
			$this->template = new Template();
			$this->widgets  = new Widgets();
			if ( class_exists( 'woocommerce' ) ) {
				new WooCommerce();
			}
			if ( class_exists( 'Easy_Digital_Downloads' ) ) {
				new Easy_Digital_Downloads();
			}
			if ( class_exists( 'bbPress' ) ) {
				new bbPress();
			}
			new Admin();
			new Fab();
			new Cta();

			// phpcs:disable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require_once get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );
			// phpcs:enable
			add_action( 'tgmpa_register', [ $this, 'tgmpa_register' ] );

			// 1) load translations (priority 0)
			add_action( 'after_setup_theme', [ $this, 'load_textdomain' ], 0 );
			// 2) run theme setup after translations are available (default priority 10)
			add_action( 'after_setup_theme', [ $this, 'setup' ] );
		}

		/**
		 * Bootstrap color palette.
		 *
		 * @since 2022-05-19
		 */
		public static function bootstrap_color_palette() {

			$bs_colors = [
				'primary'   => '#0d6efd',
				'secondary' => '#6c757d',
				'success'   => '#198754',
				'danger'    => '#dc3545',
				'warning'   => '#ffc107',
				'info'      => '#0dcaf0',
				'light'     => '#f8f9fa',
				'dark'      => '#151b26',
			];

			return $bs_colors;
		}

		/**
		 * Bootstrap button colors.
		 *
		 * @since 2022-05-19
		 */
		public static function bootstrap_btn_colors() {

			$bs_btn_colors = [
				'btn-primary'           => [ 'btn_bg' => '#0d6efd', 'btn_color' => '#fff', 'btn_border' => '#0d6efd', 'btn_bg_hover' => '#0b5ed7', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#0b5ed7' ],
				'btn-secondary'         => [ 'btn_bg' => '#6c757d', 'btn_color' => '#fff', 'btn_border' => '#6c757d', 'btn_bg_hover' => '#5a6268', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#5a6268' ],
				'btn-success'           => [ 'btn_bg' => '#198754', 'btn_color' => '#fff', 'btn_border' => '#198754', 'btn_bg_hover' => '#017258', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#017258' ],
				'btn-danger'            => [ 'btn_bg' => '#dc3545', 'btn_color' => '#fff', 'btn_border' => '#dc3545', 'btn_bg_hover' => '#c82333', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#c82333' ],
				'btn-warning'           => [ 'btn_bg' => '#ffc107', 'btn_color' => '#212529', 'btn_border' => '#ffc107', 'btn_bg_hover' => '#e0a800', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#e0a800' ],
				'btn-info'              => [ 'btn_bg' => '#0dcaf0', 'btn_color' => '#fff', 'btn_border' => '#0dcaf0', 'btn_bg_hover' => '#138496', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#138496' ],
				'btn-light'             => [ 'btn_bg' => '#f8f9fa', 'btn_color' => '#212529', 'btn_border' => '#f8f9fa', 'btn_bg_hover' => '#e2e6ea', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#e2e6ea' ],
				'btn-dark'              => [ 'btn_bg' => '#151b26', 'btn_color' => '#fff', 'btn_border' => '#151b26', 'btn_bg_hover' => '#07090d', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#07090d' ],
				'btn-outline-primary'   => [ 'btn_bg' => 'transparent', 'btn_color' => '#0d6efd', 'btn_border' => '#0d6efd', 'btn_bg_hover' => '#0d6efd', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#0d6efd' ],
				'btn-outline-secondary' => [ 'btn_bg' => 'transparent', 'btn_color' => '#6c757d', 'btn_border' => '#6c757d', 'btn_bg_hover' => '#6c757d', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#6c757d' ],
				'btn-outline-success'   => [ 'btn_bg' => 'transparent', 'btn_color' => '#198754', 'btn_border' => '#198754', 'btn_bg_hover' => '#198754', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#198754' ],
				'btn-outline-danger'    => [ 'btn_bg' => 'transparent', 'btn_color' => '#dc3545', 'btn_border' => '#dc3545', 'btn_bg_hover' => '#dc3545', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#dc3545' ],
				'btn-outline-warning'   => [ 'btn_bg' => 'transparent', 'btn_color' => '#ffc107', 'btn_border' => '#ffc107', 'btn_bg_hover' => '#ffc107', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#ffc107' ],
				'btn-outline-info'      => [ 'btn_bg' => 'transparent', 'btn_color' => '#0dcaf0', 'btn_border' => '#0dcaf0', 'btn_bg_hover' => '#0dcaf0', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#0dcaf0' ],
				'btn-outline-light'     => [ 'btn_bg' => 'transparent', 'btn_color' => '#f8f9fa', 'btn_border' => '#f8f9fa', 'btn_bg_hover' => '#f8f9fa', 'btn_color_hover' => '#212529', 'btn_border_hover' => '#f8f9fa' ],
				'btn-outline-dark'      => [ 'btn_bg' => 'transparent', 'btn_color' => '#151b26', 'btn_border' => '#151b26', 'btn_bg_hover' => '#151b26', 'btn_color_hover' => '#fff', 'btn_border_hover' => '#151b26' ],
			];

			return $bs_btn_colors;
		}

		/**
		 * Setup the theme.
		 *
		 * @since 2019-08-18
		 */
		public function setup() {
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
			register_nav_menus(
				[
					'primary' => __( 'Primary Menu', 'conversions' ),
				]
			);

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

			// Adding thumbnail basic support.
			add_theme_support( 'post-thumbnails' );

			// Add fullscreen thumbnail size.
			add_image_size( 'conversions-fullscreen', 1920, 9999 );

			// Add news image size.
			add_image_size( 'conversions-news', 550, 320, true );

			// Add blog index image size.
			add_image_size( 'conversions-blog', 1200, 480, true );

			// Add team image size.
			add_image_size( 'conversions-team', 270, 270, true );

			// Add gallery image size.
			add_image_size( 'conversions-gallery', 800, 534, true );

			// Set up the WordPress core custom background feature.
			add_theme_support(
				'custom-background',
				apply_filters(
					'conversions_custom_background_args',
					[
						'default-color' => 'ffffff',
						'default-image' => '',
					]
				)
			);

			// Set up the WordPress Theme logo feature.
			add_theme_support( 'custom-logo' );

			// Add classic editor styles.
			add_editor_style( 'build/classic-editor-style.min.css' );

			// Add support for responsive embedded content - gutenberg.
			add_theme_support( 'responsive-embeds' );

			// Add support for wide images - gutenberg.
			add_theme_support( 'align-wide' );

			// Get Booststrap color pallete.
			$bs_colors = self::bootstrap_color_palette();

			// Create array.
			$bs_color_array = [];
			foreach ( $bs_colors as $k => $v ) {

				$bs_color_title = ucfirst( $k );

				$bs_color_array[] = [
					'name'  => ucfirst( $k ),
					'slug'  => $k,
					'color' => $v,
				];
			}

			// Register the color palette options - gutenberg.
			add_theme_support(
				'editor-color-palette',
				$bs_color_array
			);

			// Check if settings are set, if not set defaults.
			$defaults = [
				'conversions_logo_height'          => '2.5',
				'conversions_nav_layout'           => 'right',
				'conversions_nav_position'         => 'fixed-top',
				'conversions_nav_colors'           => 'white',
				'conversions_branding_tbpadding'   => '.5',
				'conversions_nav_tbpadding'        => '.5',
				'conversions_nav_button'           => 'no',
				'conversions_sidebar_position'     => 'right',
				'conversions_sidebar_mv'           => true,
				'conversions_google_fonts'         => true,
				'conversions_headings_fonts'       => 'Roboto:400,400italic,700,700italic',
				'conversions_body_fonts'           => 'Roboto:400,400italic,700,700italic',
				'conversions_link_color'           => '#0068d7',
				'conversions_link_hcolor'          => '#00698c',
				'conversions_footer_bg_color'      => '#ffffff',
				'conversions_footer_text_color'    => '#222222',
				'conversions_footer_link_color'    => '#0068d7',
				'conversions_footer_link_hcolor'   => '#00698c',
				'conversions_wc_cart_nav'          => true,
				'conversions_wc_minicart'          => true,
				'conversions_wc_checkout_columns'  => 'two-column',
				'conversions_wc_primary_btn'       => 'btn-outline-primary',
				'conversions_wc_secondary_btn'     => 'btn-primary',
				'conversions_featured_img_height'  => '60',
				'conversions_featured_img_color'   => '#000000',
				'conversions_featured_img_overlay' => '.5',
				'conversions_featured_title_color' => '#ffffff',
				'conversions_blog_sticky_posts'    => 'primary',
				'conversions_blog_more_btn'        => 'btn-secondary',
				'conversions_comment_btn'          => 'btn-secondary',
				'conversions_blog_related'         => true,
				'conversions_blog_taxonomy'        => 'categories',
				'conversions_blog_postnav'         => true,
				'conversions_hcta_bg_choice'       => 'gradient',
				'conversions_hcta_bg_gradient'     => 'crystal-clear',
				'conversions_hcta_bg_bootstrap'    => 'bg-secondary',
				'conversions_hcta_bg_color'        => '#6c757d',
				'conversions_hcta_img_color'       => '#000000',
				'conversions_hcta_img_overlay'     => '.5',
				'conversions_hcta_title_color'     => '#ffffff',
				'conversions_hcta_desc_color'      => '#ffffff',
				'conversions_hcta_btn'             => 'no',
				'conversions_edd_nav_cart'         => true,
				'conversions_edd_primary_btn'      => 'btn-primary',
				'conversions_edd_download_details' => true,
				'conversions_bbp_primary_btn'      => 'btn-primary',
				'conversions_hh_type'              => 'full',
				'conversions_hh_img_color'         => '#000000',
				'conversions_hh_img_overlay'       => '.5',
			];

			foreach ( $defaults as $c => $v ) {
				if ( 'unset' == get_theme_mod( $c, 'unset' ) ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
					set_theme_mod( $c, $v );
				}
			}
		}

		/**
		 * Register the required plugins for this theme.
		 */
		public function tgmpa_register() {

			// Include plugin from the WordPress Plugin Repository.
			$plugins = [
				[
					'name'     => 'Conversions Extensions',
					'slug'     => 'conversions-extensions',
					'required' => false,
				],
			];

			// Array of configuration settings. Amend each line as needed.
			$config = [
				'id'           => 'conversions',           // Unique ID for hashing notices for multiple instances of TGMPA.
				'default_path' => '',                      // Default absolute path to bundled plugins.
				'menu'         => 'tgmpa-install-plugins', // Menu slug.
				'parent_slug'  => 'themes.php',            // Parent menu slug.
				'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
				'has_notices'  => true,                    // Show admin notices or not.
				'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => true,                    // Automatically activate plugins after installation or not.
				'message'      => '',                      // Message to output right before the plugins table.
			];

			tgmpa( $plugins, $config );
		}
	}
}

namespace
{
	/**
	 * Return the conversions namespace.
	 *
	 * @since 2019-08-18
	 */
	function conversions() {
		return \conversions\Conversions::$instance;
	}
}
