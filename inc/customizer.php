<?php
/**
 * conversions Theme Customizer
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'conversions_theme_customize_register' ) ) {
	function conversions_theme_customize_register( $wp_customize ) {

		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
        function conversions_theme_slug_sanitize_select( $input, $setting ){
            // Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
            $input = sanitize_key( $input );
           	// Get the list of possible select options.
           	$choices = $setting->manager->get_control( $setting->id )->choices;
            // If the input is a valid key, return it; otherwise, return the default.
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
        }

		//-----------------------------------------------------
		// Remove some default sections
		//-----------------------------------------------------
		$wp_customize->get_section( 'colors' )->active_callback = '__return_false';
		$wp_customize->get_section( 'background_image' )->active_callback = '__return_false';

		//-----------------------------------------------------
		// Logo width setting added to site identity panel
		//-----------------------------------------------------
		$wp_customize->add_setting( 'conversions_logo_width' , array(
			'default'       => '200',
			'type'          => 'theme_mod',
			'capability'    => 'edit_theme_options',
			'transport'     => 'refresh',
			'sanitize_callback' => 'absint', //converts value to a non-negative integer
		) );
		$wp_customize->add_control( 'conversions_logo_width_control', array(
			'label'      => 'Logo width',
			'description'=> 'Max logo width in px',
			'section'    => 'title_tagline',
			'settings'   => 'conversions_logo_width',
			'priority'   => 8,
			'type'       => 'number',
			'input_attrs'=> array( 
				'min' => 1,
				'max' => 1000,
			),
		) );

		//-----------------------------------------------------
		// Create appearance panel
		//-----------------------------------------------------

		$wp_customize->add_panel( 'conversions_appearance_settings', array(
			'priority'       => 36,
			'title'          => 'Appearance Settings',
			'description'    => 'Change colors, fonts, and more.',
			'capability'        => 'edit_theme_options',
		) );

		//-----------------------------------------------------
		// Header section
		//-----------------------------------------------------
		$wp_customize->add_section( 'conversions_header' , array(
			'title'             => __('Header', 'conversions'),
			'priority'          => 36,
			'description'       => __('Select your header colors', 'conversions'),
			'capability'        => 'edit_theme_options',
			'panel'             => 'conversions_appearance_settings',
		) );	
		// Create our settings
		$wp_customize->add_setting( 'conversions_header_position', array(
			'default'           => 'header-p-n',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'conversions_theme_slug_sanitize_select',
			'capability'        => 'edit_theme_options',
			'transport'     => 'refresh',
		) );
		$wp_customize->add_control( 
			new WP_Customize_Control(
				$wp_customize,
				'conversions_header_position', array(
					'label'       => __( 'Sticky Header', 'conversions' ),
					'description' => __( 'Should the header be fixed or sticky?', 'conversions' ),
					'section'     => 'conversions_header',
					'settings'    => 'conversions_header_position',
					'type'        => 'select',
					'choices'     => array(
						'header-p-n' => __( 'Normal', 'conversions' ),
						'fixed-top'       => __( 'Fixed', 'conversions' ),
						'sticky-top'       => __( 'Sticky', 'conversions' ),
					),
					'priority'    => '10',
				)
		) );
		$wp_customize->add_setting( 'conversions_header_background_color' , array(
			'default'       => '#111111',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_header_background_color_control', array(
			'label'      => __('Background color', 'conversions'),
			'section'    => 'conversions_header',
			'settings'   => 'conversions_header_background_color',
			'priority'   => 11,
			'type'       => 'color',
		) );
		$wp_customize->add_setting( 'conversions_header_text_color' , array(
			'default'       => '#ffffff',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_header_text_color_control', array(
			'label'      => __('Text color', 'conversions'),
			'section'    => 'conversions_header',
			'settings'   => 'conversions_header_text_color',
			'priority'   => 20,
			'type'       => 'color',
		) );
		$wp_customize->add_setting( 'conversions_header_link_color' , array(
			'default'       => '#ffffff',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_header_link_color_control', array(
			'label'      => __('Link color', 'conversions'),
			'section'    => 'conversions_header',
			'settings'   => 'conversions_header_link_color',
			'priority'   => 31,
			'type'       => 'color',
		) );
		$wp_customize->add_setting( 'conversions_header_link_hover_color' , array(
			'default'       => '#cccccc',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_header_link_hover_color_control', array(
			'label'      => __('Link hover color', 'conversions'),
			'section'    => 'conversions_header',
			'settings'   => 'conversions_header_link_hover_color',
			'priority'   => 40,
			'type'       => 'color',
		) );


		//-----------------------------------------------------
		// Footer colors section
		//-----------------------------------------------------
		$wp_customize->add_section( 'conversions_footer' , array(
			'title'             => __('Footer', 'conversions'),
			'priority'          => 37,
			'description'       => __('Select your footer colors', 'conversions'),
			'capability'        => 'edit_theme_options',
			'panel'             => 'conversions_appearance_settings',
		) );	
		// Create our settings
		$wp_customize->add_setting( 'conversions_footer_background_color' , array(
			'default'       => '#3c3d45',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_footer_background_color_control', array(
			'label'      => __('Background color', 'conversions'),
			'section'    => 'conversions_footer',
			'settings'   => 'conversions_footer_background_color',
			'priority'   => 10,
			'type'       => 'color',
		) );
		$wp_customize->add_setting( 'conversions_footer_heading_color' , array(
			'default'       => '#ffffff',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_footer_heading_color_control', array(
			'label'      => __('Heading color', 'conversions'),
			'section'    => 'conversions_footer',
			'settings'   => 'conversions_footer_heading_color',
			'priority'   => 20,
			'type'       => 'color',
		) );
		$wp_customize->add_setting( 'conversions_footer_text_color' , array(
			'default'       => '#ffffff',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_footer_text_color_control', array(
			'label'      => __('Text color', 'conversions'),
			'section'    => 'conversions_footer',
			'settings'   => 'conversions_footer_text_color',
			'priority'   => 30,
			'type'       => 'color',
		) );
		$wp_customize->add_setting( 'conversions_footer_link_color' , array(
			'default'       => '#00ffff',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_footer_link_color_control', array(
			'label'      => __('Link color', 'conversions'),
			'section'    => 'conversions_footer',
			'settings'   => 'conversions_footer_link_color',
			'priority'   => 40,
			'type'       => 'color',
		) );
		$wp_customize->add_setting( 'conversions_footer_link_hover_color' , array(
			'default'       => '#dddddd',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_footer_link_hover_color_control', array(
			'label'      => __('Link hover color', 'conversions'),
			'section'    => 'conversions_footer',
			'settings'   => 'conversions_footer_link_hover_color',
			'priority'   => 50,
			'type'       => 'color',
		) );


		//-----------------------------------------------------
		// Background colors section
		//-----------------------------------------------------
		$wp_customize->add_section( 'conversions_background' , array(
			'title'             => __('Background', 'conversions'),
			'priority'          => 38,
			'description'       => __('Select your background color', 'conversions'),
			'capability'        => 'edit_theme_options',
			'panel'             => 'conversions_appearance_settings',
		) );	
		// Create our settings
		$wp_customize->add_setting( 'conversions_background_color' , array(
			'default'       => '#ffffff',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_background_color_control', array(
			'label'      => __('Background color', 'conversions'),
			'section'    => 'conversions_background',
			'settings'   => 'conversions_background_color',
			'priority'   => 10,
			'type'       => 'color',
		) );


		//-----------------------------------------------------
		// Typography section
		//-----------------------------------------------------
		$wp_customize->add_section( 'conversions_typography' , array(
			'title'             => __('Typography', 'conversions'),
			'priority'          => 39,
			'description'       => __('Select your typography settings', 'conversions'),
			'capability'        => 'edit_theme_options',
			'panel'             => 'conversions_appearance_settings',
		) );	
		// Create our settings
		$font_choices = array(
			'Roboto:400,400italic,700,700italic' => 'Roboto',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Droid Sans:400,700' => 'Droid Sans',
			'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
			'Lato:400,700,400italic,700italic' => 'Lato',
			'Arvo:400,700,400italic,700italic' => 'Arvo',
			'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
			'Arimo:400,700,400italic,700italic' => 'Arimo',
			'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		);
		$wp_customize->add_setting( 'conversions_headings_fonts', array(
			'default'       => 'Roboto:400,400italic,700,700italic',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
		) );
		$wp_customize->add_control( 'conversions_headings_fonts', array(
			'type' => 'select',
			'description' => __('Select your desired font for the headings.', 'conversions'),
			'section' => 'conversions_typography',
			'choices' => $font_choices
		) );
		$wp_customize->add_setting( 'conversions_body_fonts', array(
			'default'       => 'Roboto:400,400italic,700,700italic',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
		) );
		$wp_customize->add_control( 'conversions_body_fonts', array(
			'type' => 'select',
			'description' => __( 'Select your desired font for the body.', 'conversions' ),
			'section' => 'conversions_typography',
			'choices' => $font_choices
		) );
		$wp_customize->add_setting( 'conversions_typography_heading_color' , array(
			'default'       => '#222222',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_typography_heading_color_control', array(
			'label'      => __('Heading color', 'conversions'),
			'section'    => 'conversions_typography',
			'settings'   => 'conversions_typography_header_color',
			'priority'   => 20,
			'type'       => 'color',
		) );	
		$wp_customize->add_setting( 'conversions_typography_text_color' , array(
			'default'       => '#111111',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_typography_text_color_control', array(
			'label'      => __('Text color', 'conversions'),
			'section'    => 'conversions_typography',
			'settings'   => 'conversions_typography_text_color',
			'priority'   => 30,
			'type'       => 'color',
		) );	
		$wp_customize->add_setting( 'conversions_typography_link_color' , array(
			'default'       => '#2600e6',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_typography_link_color_control', array(
			'label'      => __('Link color', 'conversions'),
			'section'    => 'conversions_typography',
			'settings'   => 'conversions_typography_link_color',
			'priority'   => 40,
			'type'       => 'color',
		) );	
		$wp_customize->add_setting( 'conversions_typography_link_hover_color' , array(
			'default'       => '#2600e6',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_typography_link_hover_color_control', array(
			'label'      => __('Link hover color', 'conversions'),
			'section'    => 'conversions_typography',
			'settings'   => 'conversions_typography_link_hover_color',
			'priority'   => 50,
			'type'       => 'color',
		) );


		//-----------------------------------------------------
		// Layout settings section
		//-----------------------------------------------------
		$wp_customize->add_section( 'conversions_theme_layout_options', array(
			'title'       => __( 'Layout', 'conversions' ),
			'capability'  => 'edit_theme_options',
			'description' => __( 'Container width and sidebar defaults', 'conversions' ),
			'priority'    => 40,
			'panel'             => 'conversions_appearance_settings',
		) );

		$wp_customize->add_setting( 'conversions_container_width' , array(
			'default'       => '1140',
			'type'          => 'theme_mod',
			'capability'    => 'edit_theme_options',
			'transport'     => 'refresh',
			'sanitize_callback' => 'absint', //converts value to a non-negative integer
		) );
		$wp_customize->add_control( 'conversions_container_width_control', array(
			'label'      => 'Max container width',
			'description'=> 'Specify the max container width in px',
			'section'    => 'conversions_theme_layout_options',
			'settings'   => 'conversions_container_width',
			'priority'   => 10,
			'type'       => 'number',
			'input_attrs'=> array( 
				'min' => 1,
				'max' => 9999,
			),
		) );

		$wp_customize->add_setting( 'conversions_sidebar_position', array(
			'default'           => 'right',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => 'edit_theme_options',
			'transport'     => 'refresh',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'conversions_sidebar_position', array(
					'label'       => __( 'Sidebar Positioning', 'conversions' ),
					'description' => __( 'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
					'conversions' ),
					'section'     => 'conversions_theme_layout_options',
					'settings'    => 'conversions_sidebar_position',
					'type'        => 'select',
					'sanitize_callback' => 'conversions_theme_slug_sanitize_select',
					'choices'     => array(
						'right' => __( 'Right sidebar', 'conversions' ),
						'left'  => __( 'Left sidebar', 'conversions' ),
						'both'  => __( 'Left & Right sidebars', 'conversions' ),
						'none'  => __( 'No sidebar', 'conversions' ),
					),
					'priority'    => '20',
				)
			) 
		);


		//-----------------------------------------------------
		// Copyright section
		//-----------------------------------------------------
		$wp_customize->add_section( 'conversions_copyright' , array(
			'title'             => __('Copyright', 'conversions'),
			'priority'          => 41,
			'description'       => __('Change your copyright settings', 'conversions'),
			'capability'        => 'edit_theme_options',
			'panel'             => 'conversions_appearance_settings',
		) );
		// Create our settings
		$wp_customize->add_setting( 'conversions_copyright_text' , array(
			'default'       => 'conversions',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		) );
		$wp_customize->add_control( 'conversions_copyright_text_control', array(
			'label'      => 'Copyright text',
			'section'    => 'conversions_copyright',
			'settings'   => 'conversions_copyright_text',
			'priority'   => 10,
			'type'       => 'text',
		) );
		$wp_customize->add_setting( 'conversions_copyright_background_color' , array(
			'default'       => '#ffffff',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_copyright_background_color_control', array(
			'label'      => __('Copyright background color', 'conversions'),
			'section'    => 'conversions_copyright',
			'settings'   => 'conversions_copyright_background_color',
			'priority'   => 20,
			'type'       => 'color',
		) );
		$wp_customize->add_setting( 'conversions_copyright_text_color' , array(
			'default'       => '#111111',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_copyright_text_color_control', array(
			'label'      => __('Text color', 'conversions'),
			'section'    => 'conversions_copyright',
			'settings'   => 'conversions_copyright_text_color',
			'priority'   => 30,
			'type'       => 'color',
		) );
		$wp_customize->add_setting( 'conversions_copyright_link_color' , array(
			'default'       => '#2600e6',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_copyright_link_color_control', array(
			'label'      => __('Link color', 'conversions'),
			'section'    => 'conversions_copyright',
			'settings'   => 'conversions_copyright_link_color',
			'priority'   => 40,
			'type'       => 'color',
		) );	
		$wp_customize->add_setting( 'conversions_copyright_link_hover_color' , array(
			'default'       => '#2600e6',
			'type'          => 'theme_mod',
			'transport'     => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( 'conversions_copyright_link_hover_color_control', array(
			'label'      => __('Link hover color', 'conversions'),
			'section'    => 'conversions_copyright',
			'settings'   => 'conversions_copyright_link_hover_color',
			'priority'   => 50,
			'type'       => 'color',
		) );

		//-----------------------------------------------------
		// Homepage
		//-----------------------------------------------------
	
	}
	add_action( 'customize_register', 'conversions_theme_customize_register' );
}