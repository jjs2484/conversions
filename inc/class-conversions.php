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
		 * Class constructor.
		 *
		 * @since 2019-08-06
		 */
		public function __construct() {
			static::$instance = $this;
		}

		/**
		 * Load the various modules.
		 *
		 * @since 2019-08-18
		 */
		public function load() {
			// phpcs:disable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require_once get_parent_theme_file_path( '/inc/class-comments.php' );
			require_once get_parent_theme_file_path( '/inc/class-customizer.php' );
			require_once get_parent_theme_file_path( '/inc/class-enqueue.php' );
			require_once get_parent_theme_file_path( '/inc/class-extras.php' );
			require_once get_parent_theme_file_path( '/inc/class-navbar.php' );
			require_once get_parent_theme_file_path( '/inc/class-template.php' );
			require_once get_parent_theme_file_path( '/inc/class-widgets.php' );
			require_once get_parent_theme_file_path( '/inc/class-woocommerce.php' );
			require_once get_parent_theme_file_path( '/inc/class-wp-bootstrap-comment-walker.php' );
			require_once get_parent_theme_file_path( '/inc/class-wp-bootstrap-navwalker.php' );
			require_once get_parent_theme_file_path( '/inc/class-easy-digital-downloads.php' );
			require_once get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );
			// phpcs:enable
			$this->setup();
			add_action( 'tgmpa_register', [ $this, 'conversions_register_required_plugins' ] );
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
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				]
			);

			// Adding thumbnail basic support.
			add_theme_support( 'post-thumbnails' );

			// Add fullscreen thumbnail size.
			add_image_size( 'conversions-fullscreen', 1920, 9999 );

			// Add news image size.
			add_image_size( 'conversions-news', 550, 320, true );

			// Add blog index image size.
			add_image_size( 'conversions-blog', 1200, 480, true );

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

			// Register the color palette options - gutenberg.
			add_theme_support(
				'editor-color-palette',
				[
					[
						'name'  => __( 'Primary', 'conversions' ),
						'slug'  => 'primary',
						'color' => '#007BFF',
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
						'name'  => __( 'Danger', 'conversions' ),
						'slug'  => 'danger',
						'color' => '#dc3545',
					],
					[
						'name'  => __( 'Warning', 'conversions' ),
						'slug'  => 'warning',
						'color' => '#ffc107',
					],
					[
						'name'  => __( 'Info', 'conversions' ),
						'slug'  => 'info',
						'color' => '#17a2b8',
					],
					[
						'name'  => __( 'Light', 'conversions' ),
						'slug'  => 'light',
						'color' => '#f8f9fa',
					],
					[
						'name'  => __( 'Dark', 'conversions' ),
						'slug'  => 'dark',
						'color' => '#151B26',
					],
				]
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
				'conversions_hcta_title_color'     => '#ffffff',
				'conversions_hcta_desc_color'      => '#ffffff',
				'conversions_hcta_btn'             => 'no',
				'conversions_edd_nav_cart'         => true,
				'conversions_edd_primary_btn'      => 'btn-primary',
				'conversions_edd_download_details' => true,
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
		public function conversions_register_required_plugins() {

			// Include plugin from the WordPress Plugin Repository.
			$plugins = array(
				array(
					'name'     => 'Conversions Extensions',
					'slug'     => 'conversions-extensions',
					'required' => false,
				),
			);

			// Array of configuration settings. Amend each line as needed.
			$config = array(
				'id'           => 'conversions',           // Unique ID for hashing notices for multiple instances of TGMPA.
				'default_path' => '',                      // Default absolute path to bundled plugins.
				'menu'         => 'tgmpa-install-plugins', // Menu slug.
				'has_notices'  => true,                    // Show admin notices or not.
				'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => false,                   // Automatically activate plugins after installation or not.
				'message'      => '',                      // Message to output right before the plugins table.
			);

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

	new \conversions\Conversions();
	conversions()->load();
}
