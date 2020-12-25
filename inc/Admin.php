<?php
/**
 * Admin functions.
 *
 * @package conversions
 */

namespace conversions;

/**
 * Class Extras
 *
 * @since 2020-12-23
 */
class Admin {

	/**
	 * Conversions TGMPA Plugins.
	 *
	 * @var array
	 */
	public static $conversions_tgmpa_plugins;

	/**
	 * Class constructor.
	 *
	 * @since 2020-12-23
	 */
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_theme_page' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
		add_action( 'init', [ $this, 'get_tgmpa_plugins' ], 11 );
	}

	/**
	 * Add Conversions submenu page to the admin Appearance menu.
	 *
	 * @since 2020-12-22
	 */
	public function add_theme_page() {
		add_theme_page( 'Conversions Info', 'Conversions Info', 'edit_theme_options', 'conversions-info', [ $this, 'theme_admin_page' ], 5 );
	}

	/**
	 * Add Conversions admin page.
	 *
	 * @since 2020-12-22
	 */
	public function theme_admin_page() {
		include get_template_directory() . '/inc/Admin_Page.php';
	}

	/**
	 * Enqueue scripts and styles for Admin page.
	 *
	 * @since 2020-12-24
	 *
	 * @param string $hook The current admin page.
	 */
	public function admin_enqueue_scripts( $hook ) {

		// Check we are on the right page.
		if ( 'appearance_page_conversions-info' != $hook ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
			return;
		}

		// Get theme version.
		$theme         = wp_get_theme();
		$theme_version = $theme->get( 'Version' );

		// Styles.
		wp_enqueue_style(
			'conversions-admin-info',
			get_theme_file_uri( '/build/conversions-admin.min.css' ),
			array(),
			$theme_version
		);
	}

	/**
	 * Get TGMPA plugins object.
	 *
	 * @since 2020-12-23
	 */
	public static function get_tgmpa_plugins() {

		// Get instance of TGMPA.
		self::$conversions_tgmpa_plugins = isset( $GLOBALS['tgmpa'] ) ? $GLOBALS['tgmpa'] : \TGM_Plugin_Activation::get_instance();

	}

	/**
	 * Get TGMPA plugins state.
	 *
	 * @since 2020-12-23
	 */
	public static function get_plugins_state() {

		// Get instance of TGMPA.
		$conversions_tgmpa_plugins = self::$conversions_tgmpa_plugins;
		if ( empty( $conversions_tgmpa_plugins ) ) {
			return;
		}

		// Turn object into an array.
		$conversions_tgmpa_array = (array) $conversions_tgmpa_plugins;

		// Get the plugins array from key name.
		$conversions_plugins = $conversions_tgmpa_array['plugins'];

		// Now we can loop through the array values.
		foreach ( $conversions_plugins as $slug => $plugin ) {

			// Get the activate link.
			$path          = $plugin['file_path'];
			$activate_link = add_query_arg(
				array(
					'action'        => 'activate',
					'plugin'        => rawurlencode( $path ),
					'plugin_status' => 'all',
					'paged'         => '1',
					'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $path ),
				),
				network_admin_url( 'plugins.php' )
			);

			// Get the install link.
			$install_link = add_query_arg(
				array(
					'action'   => 'install-plugin',
					'plugin'   => $slug,
					'_wpnonce' => wp_create_nonce( 'install-plugin_' . $slug ),
				),
				network_admin_url( 'update.php' )
			);

			// Get the plugin state.
			$installed = $conversions_tgmpa_plugins->is_plugin_installed( $slug );
			$state     = [
				'installed' => $installed,
				'active'    => $installed && $conversions_tgmpa_plugins->is_plugin_active( $slug ),
			];

			// Create button data.
			$plugin_is_ready = $state['installed'] && $state['active'];
			if ( ! $plugin_is_ready ) {
				if ( $state['installed'] ) {
					$link      = $activate_link;
					$label     = __( 'Activate', 'conversions' );
					$btn_class = 'activate';
				} else {
					$link      = $install_link;
					$label     = __( 'Install', 'conversions' );
					$btn_class = 'install-now';
				}
			}

			// Notice color.
			if ( $plugin_is_ready ) {
				$notice_color = 'blue';
			} else {
				$notice_color = '';
			}

			// Plugin name.
			$title = $plugin['name'];

			// Plugin description.
			if ( $plugin['slug'] === 'conversions-extensions' ) {
				$description = __( 'Adds homepage sections, demo imports, and many other features to Conversions.', 'conversions' );
			} elseif ( $plugin['slug'] === 'one-click-demo-import' ) {
				$description = __( 'Import demo content, widgets, and theme settings with one click.', 'conversions' );
			}

			// Build the output.
			$output  = '';
			$output .= '<div class="c-info__notice ' . esc_attr( $notice_color ) . '">';
			$output .= '<h3 class="c-info__notice-title">' . esc_html( $title ) . '</h3>';
			$output .= '<p>' . esc_html( $description ) . '</p>';
			if ( ! $plugin_is_ready ) {
				$output .= sprintf(
					'<a class="%1$s button" href="%2$s">%3$s</a>',
					esc_attr( $btn_class ),
					esc_url( $link ),
					esc_html( $label )
				);
			} else {
				$output .= esc_html__( 'Plugin is installed and active.', 'conversions' );
			}
			$output .= '</div>';

			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier

		}

	}

	/**
	 * Create customize button.
	 *
	 * @since 2020-12-25
	 */
	public static function get_import_page_btn() {

		// Get import page URL.
		$import_page_link = admin_url( 'themes.php?page=pt-one-click-demo-import' );

		// Create button HTML.
		echo sprintf(
			'<a class="button" href="%s">%s</a>',
			esc_url( $import_page_link ),
			esc_html__( 'Conversions Demos', 'conversions' )
		);
	}

	/**
	 * Create customize button.
	 *
	 * @since 2020-12-23
	 */
	public static function get_customize_btn() {

		// Get customizer URL.
		$customizer_link = add_query_arg(
			array(
				'url' => get_home_url(),
			),
			network_admin_url( 'customize.php' )
		);

		// Create button HTML.
		echo sprintf(
			'<a class="button" href="%s">%s</a>',
			esc_url( $customizer_link ),
			esc_html__( 'Customize', 'conversions' )
		);
	}
}
