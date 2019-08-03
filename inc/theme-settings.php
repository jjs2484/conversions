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

		//-----------------------------------------------------
		// Logo section
		//-----------------------------------------------------
		// Logo height
		$conversions_logo_height = get_theme_mod( 'conversions_logo_height' );
		if ( '' == $conversions_logo_height ) {
			set_theme_mod( 'conversions_logo_height', '60' );
		}
		// Logo position
		$conversions_header_position = get_theme_mod( 'conversions_header_position' );
		if ( '' == $conversions_header_position ) {
			set_theme_mod( 'conversions_header_position', 'fixed-top' );
		}

		//-----------------------------------------------------
		// Header section
		//-----------------------------------------------------
		// Header color scheme
		$conversions_header_colors = get_theme_mod( 'conversions_header_colors' );
		if ( '' == $conversions_header_colors ) {
			set_theme_mod( 'conversions_header_colors', 'dark' );
		}
		// Header dropshadow
		$conversions_header_dropshadow = get_theme_mod( 'conversions_header_dropshadow' );
		if ( '' == $conversions_header_dropshadow ) {
			set_theme_mod( 'conversions_header_dropshadow', 'no' );
		}
		// Header top-padding
		$conversions_header_tpadding = get_theme_mod( 'conversions_header_tpadding' );
		if ( '' == $conversions_header_tpadding ) {
			set_theme_mod( 'conversions_header_tpadding', '8' );
		}
		// Header bottom-padding
		$conversions_header_bpadding = get_theme_mod( 'conversions_header_bpadding' );
		if ( '' == $conversions_header_bpadding ) {
			set_theme_mod( 'conversions_header_bpadding', '8' );
		}

		//-----------------------------------------------------
		// Navigation section
		//-----------------------------------------------------
		// Mobile nav type
		$conversions_nav_mobile_type = get_theme_mod( 'conversions_nav_mobile_type' );
		if ( '' == $conversions_nav_mobile_type ) {
			set_theme_mod( 'conversions_nav_mobile_type', 'offcanvas' );
		}
		// Nav button
		$conversions_nav_button = get_theme_mod( 'conversions_nav_button' );
		if ( '' == $conversions_nav_button ) {
			set_theme_mod( 'conversions_nav_button', 'no' );
		}
		// Nav button text
		$conversions_nav_button_text = get_theme_mod( 'conversions_nav_button_text' );
		if ( '' == $conversions_nav_button_text ) {
			set_theme_mod( 'conversions_nav_button_text', 'Click me' );
		}
		// Nav button URL
		$conversions_nav_button_url = get_theme_mod( 'conversions_nav_button_url' );
		if ( '' == $conversions_nav_button_url ) {
			set_theme_mod( 'conversions_nav_button_url', 'https://wordpress.org' );
		}
		// Nav search icon
		$conversions_nav_search_icon = get_theme_mod( 'conversions_nav_search_icon' );
		if ( '' == $conversions_nav_search_icon ) {
			set_theme_mod( 'conversions_nav_search_icon', 'show' );
		}

		//-----------------------------------------------------
		// Layout settings
		//-----------------------------------------------------
		// Container width
		$conversions_container_width = get_theme_mod( 'conversions_container_width' );
		if ( '' == $conversions_container_width ) {
			set_theme_mod( 'conversions_container_width', '1140' );
		}
		// Sidebar position
		$conversions_sidebar_position = get_theme_mod( 'conversions_sidebar_position' );
		if ( '' == $conversions_sidebar_position ) {
			set_theme_mod( 'conversions_sidebar_position', 'right' );
		}
		// Sidebar mobile visibility
		$conversions_sidebar_mvisibility = get_theme_mod( 'conversions_sidebar_mvisibility' );
		if ( '' == $conversions_sidebar_mvisibility ) {
			set_theme_mod( 'conversions_sidebar_mvisibility', 'show' );
		}

		//-----------------------------------------------------
		// Typography section
		//-----------------------------------------------------
		// Google fonts enable/disable
		$conversions_google_fonts = get_theme_mod( 'conversions_google_fonts' );
		if ( '' == $conversions_google_fonts ) {
			set_theme_mod( 'conversions_google_fonts', 'enable_gfonts' );
		}
		// Headings font
		$conversions_headings_fonts = get_theme_mod( 'conversions_headings_fonts' );
		if ( '' == $conversions_headings_fonts ) {
			set_theme_mod( 'conversions_headings_fonts', 'Roboto:400,400italic,700,700italic' );
		}
		// Body font
		$conversions_body_fonts = get_theme_mod( 'conversions_body_fonts' );
		if ( '' == $conversions_body_fonts ) {
			set_theme_mod( 'conversions_body_fonts', 'Roboto:400,400italic,700,700italic' );
		}
		// Headings font color
		$conversions_heading_color = get_theme_mod( 'conversions_heading_color' );
		if ( '' == $conversions_heading_color ) {
			set_theme_mod( 'conversions_heading_color', '#222222' );
		}
		// Body font color
		$conversions_text_color = get_theme_mod( 'conversions_text_color' );
		if ( '' == $conversions_text_color ) {
			set_theme_mod( 'conversions_text_color', '#111111' );
		}
		// Link color
		$conversions_link_color = get_theme_mod( 'conversions_link_color' );
		if ( '' == $conversions_link_color ) {
			set_theme_mod( 'conversions_link_color', '#2600e6' );
		}

		//-----------------------------------------------------
		// Footer colors
		//-----------------------------------------------------
		// Footer background color
		$conversions_footer_background_color = get_theme_mod( 'conversions_footer_background_color' );
		if ( '' == $conversions_footer_background_color ) {
			set_theme_mod( 'conversions_footer_background_color', '#3c3d45' );
		}
		// Footer heading color
		$conversions_footer_heading_color = get_theme_mod( 'conversions_footer_heading_color' );
		if ( '' == $conversions_footer_heading_color ) {
			set_theme_mod( 'conversions_footer_heading_color', '#ffffff' );
		}
		// Footer text color
		$conversions_footer_text_color = get_theme_mod( 'conversions_footer_text_color' );
		if ( '' == $conversions_footer_text_color ) {
			set_theme_mod( 'conversions_footer_text_color', '#ffffff' );
		}
		// Footer link color
		$conversions_footer_link_color = get_theme_mod( 'conversions_footer_link_color' );
		if ( '' == $conversions_footer_link_color ) {
			set_theme_mod( 'conversions_footer_link_color', '#00ffff' );
		}

		//-----------------------------------------------------
		// Copyright section
		//-----------------------------------------------------
		// Copyright text
		$conversions_copyright_text = get_theme_mod( 'conversions_copyright_text' );
		if ( '' == $conversions_copyright_text ) {
			set_theme_mod( 'conversions_copyright_text', 'conversions' );
		}
		// Copyright background color
		$conversions_copyright_background_color = get_theme_mod( 'conversions_copyright_background_color' );
		if ( '' == $conversions_copyright_background_color ) {
			set_theme_mod( 'conversions_copyright_background_color', '#ffffff' );
		}
		// Copyright text color
		$conversions_copyright_text_color = get_theme_mod( 'conversions_copyright_text_color' );
		if ( '' == $conversions_copyright_text_color ) {
			set_theme_mod( 'conversions_copyright_text_color', '#111111' );
		}
		// Copyright link color
		$conversions_copyright_link_color = get_theme_mod( 'conversions_copyright_link_color' );
		if ( '' == $conversions_copyright_link_color ) {
			set_theme_mod( 'conversions_copyright_link_color', '#2600e6' );
		}

		//-----------------------------------------------------
		// Social media icons
		//-----------------------------------------------------
		// Social icon link target
		$conversions_social_link_target = get_theme_mod( 'conversions_social_link_target' );
		if ( '' == $conversions_social_link_target ) {
			set_theme_mod( 'conversions_social_link_target', '_self' );
		}
		// Social icon size
		$conversions_social_size = get_theme_mod( 'conversions_social_size' );
		if ( '' == $conversions_social_size ) {
			set_theme_mod( 'conversions_social_size', '22' );
		}
		// Social icon link color
		$conversions_social_link_color = get_theme_mod( 'conversions_social_link_color' );
		if ( '' == $conversions_social_link_color ) {
			set_theme_mod( 'conversions_social_link_color', '#2600e6' );
		}

 		//-----------------------------------------------------
		// WooCommerce Options
		//-----------------------------------------------------
		// WC cart in nav
		$conversions_wccart_nav = get_theme_mod( 'conversions_wccart_nav' );
		if ( '' == $conversions_wccart_nav ) {
			set_theme_mod( 'conversions_wccart_nav', 'yes' );
		}
		// WC checkout columns
		$conversions_wccheckout_columns = get_theme_mod( 'conversions_wccheckout_columns' );
		if ( '' == $conversions_wccheckout_columns ) {
			set_theme_mod( 'conversions_wccheckout_columns', 'two-column' );
		}

	}
}