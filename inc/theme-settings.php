<?php
/**
 * Check and setup theme's default settings
 *
 * @package conversions
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'conversions_theme_default_settings' ) ) {
	/**
	 * We run this function in /inc/setup.php
	 * At the end of conversions_setup() which hooks into after_setup_theme.
	 * 
	 */
	function conversions_theme_default_settings() {
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
			'conversions_link_color' => '#2600e6',
			'conversions_footer_background_color' => '#3c3d45',
			'conversions_footer_heading_color' => '#ffffff',
			'conversions_footer_text_color' => '#ffffff',
			'conversions_footer_link_color' => '#00ffff',
			'conversions_copyright_text' => 'conversions',
			'conversions_copyright_background_color' => '#ffffff',
			'conversions_copyright_text_color' => '#111111',
			'conversions_copyright_link_color' => '#2600e6',
			'conversions_social_link_target' => '_self',
			'conversions_social_size' => '22',
			'conversions_social_link_color' => '#2600e6',
			'conversions_wccart_nav' => 'yes',
			'conversions_wccheckout_columns' => 'two-column'
		);

		foreach ($defaults as $c => $v) {
        	if ( '' == get_theme_mod( $c ) ) {
				set_theme_mod($c, $v);
			}
    	}

	}
}