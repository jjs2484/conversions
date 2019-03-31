<?php
/**
 * conversions customizer main output for scripts and styles
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Enqueue google font
 */
function conversions_gfont_scripts() {
	$google_fonts_state = esc_html(get_theme_mod('conversions_google_fonts'));
	
	if( $google_fonts_state == 'enable_gfonts' ) {
		
		// headings font
		$headings_font = esc_html(get_theme_mod('conversions_headings_fonts'));
		if( $headings_font ) {
			wp_enqueue_style( 'conversions-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );
		} else {
			wp_enqueue_style( 'conversions-roboto', '//fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic');
		}

		// body font
		$body_font = esc_html(get_theme_mod('conversions_body_fonts'));
		if( $body_font ) {
			if( $body_font === $headings_font ) {
				return;
			}
			else {
				wp_enqueue_style( 'conversions-body-fonts', '//fonts.googleapis.com/css?family='. $body_font );
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'conversions_gfont_scripts' );

/**
 * Customizer choices style output
 */
function conversions_customizer_css_ouput()
{
	
	// google fonts variables
	$google_fonts_state = esc_html(get_theme_mod('conversions_google_fonts'));
	
	if( $google_fonts_state == 'enable_gfonts' ) {
		$headings_font = esc_html(get_theme_mod('conversions_headings_fonts'));
		if ( $headings_font ) {
			$font_pieces = explode(":", $headings_font);
			$headings_font = $font_pieces[0];
		}
		else {
			$headings_font = "Roboto";
		}
		$body_font = esc_html(get_theme_mod('conversions_body_fonts'));
		if ( $body_font ) {
			$font_pieces = explode(":", $body_font);
			$body_font = $font_pieces[0];
		}
		else {
			$body_font = "Roboto";
		}
	} else {
		$headings_font = "Arial, Helvetica, sans-serif";
		$body_font = "Arial, Helvetica, sans-serif";
	}

	// fixed header height calc variable
	if ( has_custom_logo() ) {
    	$c_logo_height = get_theme_mod('conversions_logo_height', '60');
	}
	else {
		$c_logo_height = 30;
	}
	$c_header_padding = get_theme_mod('conversions_header_tb_padding', '8');
	$c_logo_padding = 10;
	$c_total_fheader_height = $c_logo_height + ($c_header_padding * 2) + $c_logo_padding;

    ?>

	<style type="text/css">
		/* Container width */
		.container-fluid { max-width: <?php echo get_theme_mod('conversions_container_width', '1140'); ?>px; }
		/* Logo size */
		a.navbar-brand img { 
         	max-height: <?php echo get_theme_mod('conversions_logo_height', '60'); ?>px; 
         	height: 100%;
			width: auto;
		}
		/* Header styles */
		<?php if (get_theme_mod( 'conversions_header_position', 'fixed-top' ) == 'fixed-top') { ?>
			/* Fixed header height */
			#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper, #search-wrapper, #index-wrapper, #error-404-wrapper, #archive-wrapper, #author-wrapper { 
				margin-top: <?php echo $c_total_fheader_height; ?>px; 
			}
		<?php } ?>
		.navbar { 
			padding-top: <?php echo get_theme_mod('conversions_header_tb_padding', '8'); ?>px;
			padding-bottom: <?php echo get_theme_mod('conversions_header_tb_padding', '8'); ?>px;
		}
		<?php if (get_theme_mod( 'conversions_header_dropshadow', 'no' ) == 'yes') { ?>
			/* Fixed header height */
			#wrapper-navbar nav.navbar { 
				box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
			}
		<?php } ?>
		/* Footer styles */
		#wrapper-footer-full { background-color: <?php echo get_theme_mod('conversions_footer_background_color', '#3c3d45'); ?>; }
		#footer-full-content .h1, #footer-full-content .h2, #footer-full-content .h3, #footer-full-content .h4, #footer-full-content .h5, #footer-full-content .h6, #footer-full-content h1, #footer-full-content h2, #footer-full-content h3, #footer-full-content h4, #footer-full-content h5, #footer-full-content h6 { color: <?php echo get_theme_mod('conversions_footer_heading_color', '#ffffff'); ?>; }
		#footer-full-content p, #footer-full-content table, #footer-full-content li, #footer-full-content caption { color: <?php echo get_theme_mod('conversions_footer_text_color', '#ffffff'); ?>; }
		#footer-full-content a { color: <?php echo get_theme_mod('conversions_footer_link_color', '#00ffff'); ?>; }
		#footer-full-content a:hover { color: <?php echo get_theme_mod('conversions_footer_link_hover_color', '#dddddd'); ?>; }
		/* Background color */
		body { background-color: <?php echo get_theme_mod('conversions_background_color', '#ffffff'); ?>; }
		/* Typography styles */
		.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 { 
			color: <?php echo get_theme_mod('conversions_typography_heading_color', '#222222'); ?>; 
			font-family: <?php echo $headings_font; ?>;
		}
		body, input, select, textarea { 
			color: <?php echo get_theme_mod('conversions_typography_text_color', '#111111'); ?>;
			font-family: <?php echo $body_font; ?>;
		}
		a { color: <?php echo get_theme_mod('conversions_typography_link_color', '#2600e6'); ?>; }
		a:hover { color: <?php echo get_theme_mod('conversions_typography_link_hover_color', '#2600e6'); ?>; }
		/* Copyright styles */
		#wrapper-footer { background-color: <?php echo get_theme_mod('conversions_copyright_background_color', '#eeeeee'); ?>; }
		#wrapper-footer .site-info .copyright { color: <?php echo get_theme_mod('conversions_copyright_text_color', '#111111'); ?>; }
		#wrapper-footer .site-info .copyright a { color: <?php echo get_theme_mod('conversions_copyright_link_color', '#2600e6'); ?>; }
		#wrapper-footer .site-info .copyright a:hover { color: <?php echo get_theme_mod('conversions_copyright_link_hover_color', '#2600e6'); ?>; }
		/* Social icons */
		#wrapper-footer .social-media-icons ul li.list-inline-item i { 
			font-size: <?php echo get_theme_mod('conversions_social_size', '22'); ?>px;
			color: <?php echo get_theme_mod('conversions_social_link_color', '#2600e6'); ?>;
		}
		#wrapper-footer .social-media-icons ul li.list-inline-item i:hover {
			color: <?php echo get_theme_mod('conversions_social_link_hover_color', '#2600e6'); ?>; }
		/* WooCommerce */
		<?php if (get_theme_mod( 'conversions_wccheckout_columns', 'two-column' ) == 'two-column') { ?>
			@media screen and (min-width:768px) {
				body.woocommerce-checkout #customer_details { width: 48%; float: left; margin-right: 1.9%; }
				body.woocommerce-checkout .col-12.col-md-7.conversions-wcbilling { flex: 0 0 100%; -webkit-flex: 0 0 100%; -ms-flex: 0 0 100%; max-width: 100%; }
				body.woocommerce-checkout .col-12.col-md-5.conversions-wcshipping { flex: 0 0 100%; -webkit-flex: 0 0 100%; -ms-flex: 0 0 100%; max-width: 100%; margin-top: 1em; }
				body.woocommerce-checkout #order_review, body.woocommerce-checkout #order_review_heading { width: 48%; float: right; margin-right: 0; }
			}
		<?php } ?>
		/* Sidebar */
		<?php if (get_theme_mod( 'conversions_sidebar_mvisibility', 'show' ) == 'hide') { ?>
			@media (max-width: 767.98px) {
				#left-sidebar, #right-sidebar {
					display: none;
				}
			}
		<?php } ?>
	</style>
         
	<?php
}
add_action( 'wp_head', 'conversions_customizer_css_ouput', 99 );
