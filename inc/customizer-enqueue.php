<?php

/**
 * Enqueue google font
 */
function conversions_gfont_scripts() {
	$google_fonts_state = esc_html(get_theme_mod('conversions_google_fonts'));
	
	if( $google_fonts_state == 'enable_gfonts' ) {
		
		$headings_font = esc_html(get_theme_mod('conversions_headings_fonts'));
		if( $headings_font ) {
			wp_enqueue_style( 'conversions-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );
		} else {
			wp_enqueue_style( 'conversions-roboto', '//fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic');
		}

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
 * Inline customizer style choices
 */
function conversions_customizer_css_ouput()
{
	$google_fonts_state = esc_html(get_theme_mod('conversions_google_fonts'));
	
	if( $google_fonts_state == 'enable_gfonts' ) {
		//Fonts
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
    ?>

         <style type="text/css">
         	/* Container width customizer styles */
         	.container-fluid { max-width: <?php echo get_theme_mod('conversions_container_width', '1140'); ?>px; }
         	/* Logo customizer styles */
         	a.navbar-brand img { 
         		max-width: <?php echo get_theme_mod('conversions_logo_width', '200'); ?>px; 
         		width: 100%;
				height: auto;
			}
         	/* Header customizer styles */
			.navbar.navbar-dark { background-color: <?php echo get_theme_mod('conversions_header_background_color', '#111111'); ?>; }
			.navbar.navbar-dark a.navbar-brand, .navbar.navbar-dark a.navbar-brand:focus, .navbar.navbar-dark a.navbar-brand:hover { color: <?php echo get_theme_mod('conversions_header_text_color', '#ffffff'); ?>; }
			.navbar.navbar-dark .navbar-nav a.nav-link { color: <?php echo get_theme_mod('conversions_header_link_color', '#ffffff'); ?>; }
			.navbar.navbar-dark .navbar-nav .nav-link:focus, .navbar.navbar-dark .navbar-nav .nav-link:hover { color: <?php echo get_theme_mod('conversions_header_link_hover_color', '#cccccc'); ?>; }
			/* Footer customizer styles */
			#wrapper-footer-full { background-color: <?php echo get_theme_mod('conversions_footer_background_color', '#3c3d45'); ?>; }
			#footer-full-content .h1, #footer-full-content .h2, #footer-full-content .h3, #footer-full-content .h4, #footer-full-content .h5, #footer-full-content .h6, #footer-full-content h1, #footer-full-content h2, #footer-full-content h3, #footer-full-content h4, #footer-full-content h5, #footer-full-content h6 { color: <?php echo get_theme_mod('conversions_footer_heading_color', '#ffffff'); ?>; }
			#footer-full-content p, #footer-full-content table, #footer-full-content li, #footer-full-content caption { color: <?php echo get_theme_mod('conversions_footer_text_color', '#ffffff'); ?>; }
			#footer-full-content a { color: <?php echo get_theme_mod('conversions_footer_link_color', '#00ffff'); ?>; }
			#footer-full-content a:hover { color: <?php echo get_theme_mod('conversions_footer_link_hover_color', '#dddddd'); ?>; }
			/* Background customizer styles */
			body { background-color: <?php echo get_theme_mod('conversions_background_color', '#ffffff'); ?>; }
			/* Typography customizer styles */
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
			/* Copyright customizer styles */
			#wrapper-footer { background-color: <?php echo get_theme_mod('conversions_copyright_background_color', '#ffffff'); ?>; }
			#wrapper-footer .site-info { color: <?php echo get_theme_mod('conversions_copyright_text_color', '#111111'); ?>; }
			#wrapper-footer .site-info a { color: <?php echo get_theme_mod('conversions_copyright_link_color', '#2600e6'); ?>; }
			#wrapper-footer .site-info a:hover { color: <?php echo get_theme_mod('conversions_copyright_link_hover_color', '#2600e6'); ?>; }
         </style>
         
    <?php
}
add_action( 'wp_head', 'conversions_customizer_css_ouput', 99 );