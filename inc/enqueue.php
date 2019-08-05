<?php
/**
 * conversions enqueue scripts
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'conversions_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS resources.
	 */
	function conversions_scripts() {
		// Get the theme data.
		$the_theme = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );
		
		// CSS
		$css_version = $theme_version . '.' . filemtime(get_template_directory() . '/build/main.min.css');
		wp_enqueue_style( 'conversions-styles', get_template_directory_uri() . '/build/main.min.css', array(), $css_version );

		// jQuery
		wp_enqueue_script( 'jquery');
		
		// Javascript
		$js_version = $theme_version . '.' . filemtime(get_template_directory() . '/build/theme.min.js');
		wp_enqueue_script( 'conversions-scripts', get_template_directory_uri() . '/build/theme.min.js', array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Google fonts
		$google_fonts_state = esc_html(get_theme_mod('conversions_google_fonts', 'enable_gfonts'));
		if( $google_fonts_state == 'enable_gfonts' ) {
			// headings font
			$headings_font = esc_html(get_theme_mod('conversions_headings_fonts', 'Roboto:400,400italic,700,700italic'));
			wp_enqueue_style( 'conversions-heading-gfont', '//fonts.googleapis.com/css?family='. $headings_font );

			// body font
			$body_font = esc_html(get_theme_mod('conversions_body_fonts', 'Roboto:400,400italic,700,700italic'));
			if( $body_font === $headings_font ) {
				return;
			}
			else {
				wp_enqueue_style( 'conversions-body-gfont', '//fonts.googleapis.com/css?family='. $body_font );
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'conversions_scripts' );

/**
 * Enqueue Gutenberg editor scripts, styles, and fonts
 * @action enqueue_block_editor_assets
*/
if ( ! function_exists( 'conversions_gb_editor_scripts' ) ) {
function conversions_gb_editor_scripts() {
 	
 	// Editor scripts
 	wp_enqueue_script( 'be-editor', get_stylesheet_directory_uri() . '/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_stylesheet_directory() . '/js/editor.js' ), true );

 	// Editor styles
	wp_register_style( 'conversions-gutenberg', get_stylesheet_directory_uri() . '/build/gutenberg-editor-style.css' );
	wp_enqueue_style( 'conversions-gutenberg' );

	// Are Google fonts enabled?
	$google_fonts_state = esc_html(get_theme_mod('conversions_google_fonts', 'enable_gfonts'));
	if( $google_fonts_state == 'enable_gfonts' ) {
		
		// Enqueue headings font
		$headings_font = esc_html(get_theme_mod('conversions_headings_fonts', 'Roboto:400,400italic,700,700italic'));
		wp_register_style( 'conversions-gutenberg-heading-font', '//fonts.googleapis.com/css?family='. $headings_font );
		wp_enqueue_style( 'conversions-gutenberg-heading-font' );

		// Enqueue body font
		$body_font = esc_html(get_theme_mod('conversions_body_fonts', 'Roboto:400,400italic,700,700italic'));
		if( $body_font === $headings_font ) {
			return;
		}
		else {
			wp_register_style( 'conversions-gutenberg-body-font', '//fonts.googleapis.com/css?family='. $body_font );
			wp_enqueue_style( 'conversions-gutenberg-body-font' );
		}

		// create variables for inline styles
		$headings_font_pieces = explode(":", $headings_font);
		$headings_font = $headings_font_pieces[0];
		$body_font_pieces = explode(":", $body_font);
		$body_font = $body_font_pieces[0];
	
	} else {
		$headings_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
		$body_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
	}

	$headings_color = esc_html(get_theme_mod('conversions_heading_color', '#222222'));
	$body_color = esc_html(get_theme_mod('conversions_text_color', '#111111'));
    $links_color = esc_html(get_theme_mod('conversions_link_color', '#2600e6'));
    $container_width = esc_html(get_theme_mod('conversions_container_width', '1140'));

	$custom_gb_css = "
		.editor-styles-wrapper .editor-writing-flow .editor-post-title__block .editor-post-title__input,
    	.editor-styles-wrapper .editor-writing-flow .wp-block-heading h1, 
    	.editor-styles-wrapper .editor-writing-flow .wp-block-heading h2, 
    	.editor-styles-wrapper .editor-writing-flow .wp-block-heading h3,
    	.editor-styles-wrapper .editor-writing-flow .wp-block-heading h4,
    	.editor-styles-wrapper .editor-writing-flow .wp-block-heading h5 {
			color: {$headings_color};
			font-family: {$headings_font};
		}
		.editor-styles-wrapper .editor-writing-flow {
			color: {$body_color};
			font-family: {$body_font};
		}
		.editor-styles-wrapper a,
		.wp-block-freeform.block-library-rich-text__tinymce a {
			color: {$links_color};
			text-decoration: none;
		}
		.wp-block {
    		max-width: {$container_width}px;
		}
		.wp-block[data-align='wide'] {
    		max-width: {$container_width}px;
		}
	";
	wp_add_inline_style( 'conversions-gutenberg', $custom_gb_css );

}
}
add_action( 'enqueue_block_editor_assets', 'conversions_gb_editor_scripts' );

/**
 * Register Google Fonts in classic editor
*/
if ( ! function_exists( 'conversions_classic_editor_gfonts' ) ) {
	function conversions_classic_editor_gfonts() {
		// Are Google fonts enabled?
		$google_fonts_state = esc_html(get_theme_mod('conversions_google_fonts', 'enable_gfonts'));
		if( $google_fonts_state == 'enable_gfonts' ) {
		
			// Enqueue headings font
			$headings_font = esc_html(get_theme_mod('conversions_headings_fonts', 'Roboto:400,400italic,700,700italic'));
			$headings_font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family='. $headings_font );
    		add_editor_style( $headings_font_url );

			// Enqueue body font
			$body_font = esc_html(get_theme_mod('conversions_body_fonts', 'Roboto:400,400italic,700,700italic'));
			if( $body_font === $headings_font ) {
				return;
			}
			else {
				$body_font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family='. $body_font );
    			add_editor_style( $body_font_url );
			}
		}
	}
}
add_action( 'after_setup_theme', 'conversions_classic_editor_gfonts' );

/**
 * Add theme mods to classic editor
*/
if ( ! function_exists( 'conversions_classic_editor_styles' ) ) {
function conversions_classic_editor_styles( $mceInit ) {

	// Are Google fonts enabled?
	$google_fonts_state = esc_html(get_theme_mod('conversions_google_fonts', 'enable_gfonts'));
	if( $google_fonts_state == 'enable_gfonts' ) {
		
		// headings font
		$headings_font = esc_html(get_theme_mod('conversions_headings_fonts', 'Roboto:400,400italic,700,700italic'));
		$headings_font_pieces = explode(":", $headings_font);
		$headings_font = $headings_font_pieces[0];
		
		//body font
		$body_font = esc_html(get_theme_mod('conversions_body_fonts', 'Roboto:400,400italic,700,700italic'));
		$body_font_pieces = explode(":", $body_font);
		$body_font = $body_font_pieces[0];
		
	} else {
		$headings_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
		$body_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
	}

	$headings_color = esc_html(get_theme_mod('conversions_heading_color', '#222222'));
	$body_color = esc_html(get_theme_mod('conversions_text_color', '#111111'));
    $links_color = esc_html(get_theme_mod('conversions_link_color', '#2600e6'));

    // Add them to the classic editor
    $styles = 'body.mce-content-body { color:'.$body_color.';font-family:'.$body_font.'; } body.mce-content-body h1, body.mce-content-body h2, body.mce-content-body h3, body.mce-content-body h4, body.mce-content-body h5, body.mce-content-body h6 { color:'.$headings_color.';font-family:'.$headings_font.'; } body.mce-content-body a { color:'.$links_color.'; }';
    if ( isset( $mceInit['content_style'] ) ) {
        $mceInit['content_style'] .= ' ' . $styles . ' ';
    } else {
        $mceInit['content_style'] = $styles . ' ';
    }
    return $mceInit;
}
}
add_filter('tiny_mce_before_init','conversions_classic_editor_styles');