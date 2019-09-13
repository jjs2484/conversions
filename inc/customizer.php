<?php

namespace conversions
{
	/**
		@brief		Customizer.
		@since		2019-08-15 23:01:47
	**/
	class Customizer
	{
		/**
			@brief		Constructor.
			@since		2019-08-15 23:01:47
		**/
		public function __construct()
		{
			add_action( 'conversions_output_social', [ $this, 'conversions_output_social' ] );
			add_action( 'customize_register', [ $this, 'customize_register' ] );
			add_action( 'wp_footer', [ $this, 'wp_footer' ], 100 );
			add_action( 'wp_head', [ $this, 'wp_head' ], 99 );
			add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'woocommerce_add_to_cart_fragments' ] );
			add_filter( 'wp_nav_menu_items', [ $this, 'wp_nav_menu_items' ], 10, 2 );
		}

		/**
			@brief		conversions_output_social
			@since		2019-08-15 23:29:01
		**/
		public function conversions_output_social()
		{
			// Any inputs that aren't empty are stored in $active_sites array
			foreach( $this->get_social_sites() as $social_site ) {
				if ( strlen( get_theme_mod( $social_site ) ) > 0 ) {
					$active_sites[] = $social_site;
				}
			}

			// For each active social site, add it as a list item
			if ( !empty( $active_sites ) ) {

				echo "<div class='social-media-icons col-md'>";

					echo "<ul class='list-inline'>";

						foreach ( $active_sites as $active_site ) { ?>

							<li class="list-inline-item">
								<a href="<?php echo get_theme_mod( $active_site ); ?>" target="<?php echo get_theme_mod('conversions_social_link_target', '_self'); ?>">
									<?php if( $active_site == 'dribbble' ) { ?>
										<i class="fab fa-<?php echo $active_site; ?>-square"></i>
									<?php } elseif( $active_site == 'google my business' ) { ?>
										<i class="fas fa-map-marker-alt"></i>
									<?php } else { ?>
										<i class="fab fa-<?php echo $active_site; ?>"></i>
									<?php } ?>
								</a>
							</li>

						<?php }

					echo "</ul>";

				echo "</div>";
			}
		}

		/**
			@brief		customize_register
			@since		2019-08-15 23:32:18
		**/
		public function customize_register( $wp_customize )
		{
			//-----------------------------------------------------
			// Remove some default sections
			//-----------------------------------------------------
			$wp_customize->get_section( 'colors' )->active_callback = '__return_false';
			$wp_customize->get_section( 'background_image' )->active_callback = '__return_false';

			//-----------------------------------------------------
			// Add logo height to site identity panel
			//-----------------------------------------------------
			$wp_customize->add_setting( 'conversions_logo_height', array(
				'default'       => '60',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint', //converts value to a non-negative integer
			) );
			$wp_customize->add_control( 'conversions_logo_height_control', array(
				'label'      => 'Logo height',
				'description'=> 'Max logo height in px',
				'section'    => 'title_tagline',
				'settings'   => 'conversions_logo_height',
				'priority'   => 8,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 1000,
				),
			) );

			//-----------------------------------------------------
			// Create theme options panel
			//-----------------------------------------------------
			$wp_customize->add_panel( 'conversions_theme_options', array(
				'priority'       => 36,
				'title'          => 'Theme Options',
				'description'    => 'Change colors, fonts, and more.',
				'capability'        => 'edit_theme_options',
			) );

			//-----------------------------------------------------
			// Header section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_header', array(
				'title'             => __('Header', 'conversions'),
				'priority'          => 10,
				'description'       => __('Select your header colors', 'conversions'),
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_theme_options',
			) );
			// Create our settings
			$wp_customize->add_setting( 'conversions_header_position', array(
				'default'           => 'fixed-top',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_header_position', array(
						'label'       => __( 'Header position', 'conversions' ),
						'description' => __( 'Should the header be fixed or normal?', 'conversions' ),
						'section'     => 'conversions_header',
						'settings'    => 'conversions_header_position',
						'type'        => 'select',
						'choices'     => array(
							'header-p-n' => __( 'Normal', 'conversions' ),
							'fixed-top'       => __( 'Fixed', 'conversions' ),
						),
						'priority'    => '10',
					)
			) );
			$wp_customize->add_setting( 'conversions_header_colors', array(
				'default'           => 'dark',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_header_colors', array(
						'label'       => __( 'Header color scheme', 'conversions' ),
						'description' => __( 'Choose a header color scheme', 'conversions' ),
						'section'     => 'conversions_header',
						'settings'    => 'conversions_header_colors',
						'type'        => 'select',
						'choices'     => array(
							'dark' => __( 'Dark', 'conversions' ),
							'light' => __( 'Light', 'conversions' ),
							'white' => __( 'White', 'conversions' ),
							'primary' => __( 'Primary', 'conversions' ),
							'secondary' => __( 'Secondary', 'conversions' ),
							'success' => __( 'Success', 'conversions' ),
							'danger' => __( 'Danger', 'conversions' ),
							'warning' => __( 'Warning', 'conversions' ),
							'info' => __( 'Info', 'conversions' ),
						),
						'priority'    => '20',
					)
			) );
			$wp_customize->add_setting( 'conversions_header_dropshadow', array(
				'default'           => 'no',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_header_dropshadow', array(
						'label'       => __( 'Header drop shadow', 'conversions' ),
						'description' => __( 'Add a drop shadoow to the header?', 'conversions' ),
						'section'     => 'conversions_header',
						'settings'    => 'conversions_header_dropshadow',
						'type'        => 'select',
						'choices'     => array(
							'yes' => __( 'Yes', 'conversions' ),
							'no' => __( 'No', 'conversions' ),
						),
						'priority'    => '30',
					)
			) );
			$wp_customize->add_setting( 'conversions_header_tpadding', array(
				'default'       => '8',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint', //converts value to a non-negative integer
			) );
			$wp_customize->add_control( 'conversions_header_tpadding_control', array(
				'label'      => 'Header top padding',
				'description'=> 'Top padding in px',
				'section'    => 'conversions_header',
				'settings'   => 'conversions_header_tpadding',
				'priority'   => 40,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 1000,
				),
			) );
			$wp_customize->add_setting( 'conversions_header_bpadding', array(
				'default'       => '8',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint', //converts value to a non-negative integer
			) );
			$wp_customize->add_control( 'conversions_header_bpadding_control', array(
				'label'      => 'Header bottom padding',
				'description'=> 'Bottom padding in px',
				'section'    => 'conversions_header',
				'settings'   => 'conversions_header_bpadding',
				'priority'   => 50,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 1000,
				),
			) );

			//-----------------------------------------------------
			// Navigation section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_nav' , array(
				'title'             => __('Navigation', 'conversions'),
				'priority'          => 20,
				'description'       => __('Select your navigation settings', 'conversions'),
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_theme_options',
			) );
			// Create our settings
			$wp_customize->add_setting( 'conversions_nav_mobile_type', array(
				'default'           => 'offcanvas',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_mobile_type', array(
						'label'       => __( 'Mobile navigation type', 'conversions' ),
						'description' => __( 'Offcanvas or slide down mobile nav?', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_mobile_type',
						'type'        => 'select',
						'choices'     => array(
							'offcanvas' => __( 'Offcanvas', 'conversions' ),
							'collapse'       => __( 'Slide down', 'conversions' ),
						),
						'priority'    => '30',
					)
			) );
			$wp_customize->add_setting( 'conversions_nav_button', array(
				'default'           => 'no',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_button', array(
						'label'       => __( 'Add button to navigation', 'conversions' ),
						'description' => __( 'Want to append a conversion button to the nav?', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_button',
						'type'        => 'select',
						'choices'     => array(
							'no' => __( 'No button', 'conversions' ),
							'btn-primary' => __( 'Primary button', 'conversions' ),
							'btn-secondary' => __( 'Secondary button', 'conversions' ),
							'btn-success' => __( 'Success button', 'conversions' ),
							'btn-danger' => __( 'Danger button', 'conversions' ),
							'btn-warning' => __( 'Warning button', 'conversions' ),
							'btn-info' => __( 'Info button', 'conversions' ),
						),
						'priority'    => '40',
					)
			) );
			$wp_customize->add_setting( 'conversions_nav_button_text', array(
				'default'       => 'Click me',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'conversions_nav_button_text_control', array(
				'label'      => 'Navigation button text',
				'section'    => 'conversions_nav',
				'settings'   => 'conversions_nav_button_text',
				'priority'   => 50,
				'type'       => 'text',
			) );
			$wp_customize->add_setting( 'conversions_nav_button_url', array(
				'default'       => 'https://wordpress.org',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'conversions_nav_button_url_control', array(
				'label'      => 'Navigation button URL',
				'section'    => 'conversions_nav',
				'settings'   => 'conversions_nav_button_url',
				'priority'   => 60,
				'type'       => 'text',
			) );
			$wp_customize->add_setting( 'conversions_nav_search_icon', array(
				'default'           => 'show',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_search_icon', array(
						'label'       => __( 'Show search icon?', 'conversions' ),
						'description' => __( 'Show or hide a search icon in the nav.', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_search_icon',
						'type'        => 'select',
						'choices'     => array(
							'show' => __( 'Show search icon', 'conversions' ),
							'hide'       => __( 'Hide search icon', 'conversions' ),
						),
						'priority'    => '70',
					)
			) );

			//-----------------------------------------------------
			// Layout settings
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_layout_options', array(
				'title'       => __( 'Layout', 'conversions' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'conversions' ),
				'priority'    => 40,
				'panel'             => 'conversions_theme_options',
			) );

			$wp_customize->add_setting( 'conversions_container_width', array(
				'default'       => '1140',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint', //converts value to a non-negative integer
			) );
			$wp_customize->add_control( 'conversions_container_width_control', array(
				'label'      => 'Max container width',
				'description'=> 'Specify the max container width in px',
				'section'    => 'conversions_layout_options',
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
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_sidebar_position', array(
						'label'       => __( 'Sidebar Positioning', 'conversions' ),
						'description' => __( 'Set sidebar\'s default position. Can either be: right, left, or none. Note: this can be overridden on individual pages.',
						'conversions' ),
						'section'     => 'conversions_layout_options',
						'settings'    => 'conversions_sidebar_position',
						'type'        => 'select',
						'sanitize_callback' => 'conversions_sanitize_select',
						'choices'     => array(
							'right' => __( 'Right sidebar', 'conversions' ),
							'left'  => __( 'Left sidebar', 'conversions' ),
							'none'  => __( 'No sidebar', 'conversions' ),
						),
						'priority'    => '20',
					)
				)
			);
			$wp_customize->add_setting( 'conversions_sidebar_mvisibility', array(
				'default'           => 'show',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_sidebar_mvisibility', array(
						'label'       => __( 'Hide sidebar on mobile?', 'conversions' ),
						'description' => __( 'Should we hide the sidebar on small screens?',
						'conversions' ),
						'section'     => 'conversions_layout_options',
						'settings'    => 'conversions_sidebar_mvisibility',
						'type'        => 'select',
						'sanitize_callback' => 'conversions_sanitize_select',
						'choices'     => array(
							'show' => __( 'Show sidebar', 'conversions' ),
							'hide'  => __( 'Hide sidebar', 'conversions' ),
						),
						'priority'    => '30',
					)
				)
			);

			//-----------------------------------------------------
			// Typography section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_typography', array(
				'title'             => __('Typography', 'conversions'),
				'priority'          => 50,
				'description'       => __('Select your typography settings', 'conversions'),
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_theme_options',
			) );
			// Create our settings
			$wp_customize->add_setting( 'conversions_google_fonts', array(
				'default'       => 'enable_gfonts',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control( 'conversions_google_fonts_control', array(
				'label'      => 'Google fonts',
				'description'=> 'Enable or disable Google fonts If disabled native browser fonts will be used',
				'section'    => 'conversions_typography',
				'settings'   => 'conversions_google_fonts',
				'priority'   => 1,
				'type'       => 'select',
				'choices'    => array(
					'enable_gfonts' => 'Enable',
					'disable_gfonts' => 'Disable',
				),
			) );
			$font_choices = array(
				'Droid Sans:400,700' => 'Droid Sans',
				'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
				'Francois One:400' => 'Francois One',
				'Lato:400,700,400italic,700italic' => 'Lato',
				'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
				'Lora:400,700,400italic,700italic' => 'Lora',
				'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
				'Open Sans:400italic,700italic,400,700' => 'Open Sans',
				'Oxygen:400,300,700' => 'Oxygen',
				'Roboto:400,400italic,700,700italic' => 'Roboto',
				'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
			);
			$wp_customize->add_setting( 'conversions_headings_fonts', array(
				'default'       => 'Roboto:400,400italic,700,700italic',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control( 'conversions_headings_fonts', array(
				'label'      => __('Heading font', 'conversions'),
				'type' => 'select',
				'description' => __('Select your Google font for headings.', 'conversions'),
				'section' => 'conversions_typography',
				'choices' => $font_choices
			) );
			$wp_customize->add_setting( 'conversions_body_fonts', array(
				'default'       => 'Roboto:400,400italic,700,700italic',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control( 'conversions_body_fonts', array(
				'label'      => __('Body font', 'conversions'),
				'type' => 'select',
				'description' => __( 'Select your Google font for the body.', 'conversions' ),
				'section' => 'conversions_typography',
				'choices' => $font_choices
			) );
			$wp_customize->add_setting( 'conversions_heading_color', array(
				'default'       => '#222222',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_heading_color_control', array(
				'label'      => __('Heading color', 'conversions'),
				'section'    => 'conversions_typography',
				'settings'   => 'conversions_heading_color',
				'priority'   => 20,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_text_color', array(
				'default'       => '#111111',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_text_color_control', array(
				'label'      => __('Text color', 'conversions'),
				'section'    => 'conversions_typography',
				'settings'   => 'conversions_text_color',
				'priority'   => 30,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_link_color', array(
				'default'       => '#2600e6',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_link_color_control', array(
				'label'      => __('Link color', 'conversions'),
				'section'    => 'conversions_typography',
				'settings'   => 'conversions_link_color',
				'priority'   => 40,
				'type'       => 'color',
			) );

			//-----------------------------------------------------
			// Footer colors
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_footer' , array(
				'title'             => __('Footer', 'conversions'),
				'priority'          => 60,
				'description'       => __('Select your footer colors', 'conversions'),
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_theme_options',
			) );
			// Create our settings
			$wp_customize->add_setting( 'conversions_footer_background_color', array(
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
			$wp_customize->add_setting( 'conversions_footer_heading_color', array(
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
			$wp_customize->add_setting( 'conversions_footer_text_color', array(
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
			$wp_customize->add_setting( 'conversions_footer_link_color', array(
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

			//-----------------------------------------------------
			// Copyright section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_copyright', array(
				'title'             => __('Copyright', 'conversions'),
				'priority'          => 70,
				'description'       => __('Change your copyright settings', 'conversions'),
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_theme_options',
			) );
			// Create our settings
			$wp_customize->add_setting( 'conversions_copyright_text', array(
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
			$wp_customize->add_setting( 'conversions_copyright_background_color', array(
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
			$wp_customize->add_setting( 'conversions_copyright_text_color', array(
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
			$wp_customize->add_setting( 'conversions_copyright_link_color', array(
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

			//-----------------------------------------------------
			// Social media icons
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_social', array(
				'title' => __( 'Social Media Icons', 'conversions' ),
				'description'       => __('Add social icons', 'conversions'),
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_theme_options',
				'priority' => 80,
			));
			// Create our settings
			$wp_customize->add_setting( 'conversions_social_link_target', array(
				'default'           => '_self',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_social_link_target', array(
						'label'       => __( 'Link open behavior', 'conversions' ),
						'description' => __( 'Open links in same window or new window?', 'conversions' ),
						'section'     => 'conversions_social',
						'settings'    => 'conversions_social_link_target',
						'type'        => 'select',
						'choices'     => array(
							'_self' => __( 'Same widow', 'conversions' ),
							'_blank'       => __( 'New window', 'conversions' ),
						),
						'priority'    => '10',
					)
			) );
			$wp_customize->add_setting( 'conversions_social_size', array(
				'default'       => '22',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint', //converts value to a non-negative integer
			) );
			$wp_customize->add_control( 'conversions_social_size_control', array(
				'label'      => 'Social icons size',
				'description'=> 'Icons size in px',
				'section'    => 'conversions_social',
				'settings'   => 'conversions_social_size',
				'priority'   => 20,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 1000,
				),
			) );
			$wp_customize->add_setting( 'conversions_social_link_color', array(
				'default'       => '#2600e6',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_social_link_color_control', array(
				'label'      => __('Link color', 'conversions'),
				'section'    => 'conversions_social',
				'settings'   => 'conversions_social_link_color',
				'priority'   => 30,
				'type'       => 'color',
			) );
			$social_sites = $this->get_social_sites();
			foreach( $social_sites as $social_site ) {
				$wp_customize->add_setting( "$social_site", array(
					'type' => 'theme_mod',
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_url_raw',
				));
				$wp_customize->add_control( $social_site, array(
					'label' => __("$social_site URL:", 'conversions'),
					'section' => 'conversions_social',
					'type' => 'text',
					'priority' => 50,
				));
			}

			//-----------------------------------------------------
			// WooCommerce Options
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_woocommerce', array(
				'title' => __( 'WooCommerce', 'conversions' ),
				'description'       => __('WooCommerce Options', 'conversions'),
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_theme_options',
				'priority' => 90,
				'theme_supports' => array('woocommerce'),
			));
			// Create our settings
			$wp_customize->add_setting( 'conversions_wccart_nav', array(
				'default'           => 'yes',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_wccart_nav', array(
						'label'       => __( 'Show cart in navigation', 'conversions' ),
						'description' => __( 'Want to show the cart in the nav?', 'conversions' ),
						'section'     => 'conversions_woocommerce',
						'settings'    => 'conversions_wccart_nav',
						'type'        => 'select',
						'choices'     => array(
							'yes' => __( 'Show cart', 'conversions' ),
							'no'       => __( 'No cart', 'conversions' ),
						),
						'priority'    => '10',
					)
			) );
			$wp_customize->add_setting( 'conversions_wccheckout_columns', array(
				'default'           => 'two-column',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_wccheckout_columns', array(
						'label'       => __( 'Checkout columns', 'conversions' ),
						'description' => __( 'How many columns should the checkout be?', 'conversions' ),
						'section'     => 'conversions_woocommerce',
						'settings'    => 'conversions_wccheckout_columns',
						'type'        => 'select',
						'choices'     => array(
							'two-column' => __( 'Two column', 'conversions' ),
							'one-column'       => __( 'One column', 'conversions' ),
						),
						'priority'    => '20',
					)
			) );
		}

		/**
			@brief		Return a list of social media icons.
			@since		2019-08-15 23:29:22
		**/
		public function get_social_sites()
		{
			return [
				'amazon',
				'discord',
				'dribbble',
				'facebook',
				'flickr',
				'github',
				'google my business',
				'instagram',
				'linkedin',
				'pinterest',
				'reddit',
				'slack',
				'tumblr',
				'twitter',
				'vimeo',
				'wordpress',
				'yelp',
				'youtube',
			];
		}

		/**
			@brief		wp_footer
			@since		2019-08-15 23:16:11
		**/
		public function wp_footer()
		{
			$nav_search_icon = get_theme_mod( 'conversions_nav_search_icon', 'show' );
			if ($nav_search_icon != 'hide') {

				// Add modal window for search
				$search_form = get_search_form(false);
				echo '<div id="csearchModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="csearchModal__label" aria-hidden="true">',

					'<div class="modal-dialog">',

						'<div class="modal-content">',

							'<div class="modal-header">',
								'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>',
							'</div>',

							'<div class="modal-body">',
								'<h3 id="csearchModal__label" class="modal-title">'.esc_html__( 'Start typing and press enter to search', 'conversions' ).'</h3>',
								''.$search_form.'',
							'</div>',

						'</div>',

					'</div>',

				'</div>';
			}
		}

		/**
			@brief		wp_head
			@since		2019-08-15 23:12:24
		**/
		public function wp_head()
		{
			// font variables
			$google_fonts_state = esc_html(get_theme_mod('conversions_google_fonts', 'enable_gfonts'));

			if( $google_fonts_state == 'enable_gfonts' ) {

				// headings
				$headings_font = esc_html(get_theme_mod('conversions_headings_fonts', 'Roboto:400,400italic,700,700italic'));
				$heading_font_pieces = explode(":", $headings_font);
				$headings_font = $heading_font_pieces[0];

				// body
				$body_font = esc_html(get_theme_mod('conversions_body_fonts', 'Roboto:400,400italic,700,700italic'));
				$body_font_pieces = explode(":", $body_font);
				$body_font = $body_font_pieces[0];

			} else {
				$headings_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
				$body_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
			}

			// fixed header height calc variables
			if ( has_custom_logo() ) {
				$logo_height = get_theme_mod('conversions_logo_height', '60');
			}
			else {
				$logo_height = 30;
			}
			$header_top_padding = get_theme_mod('conversions_header_tpadding', '8');
			$header_bottom_padding = get_theme_mod('conversions_header_bpadding', '8');
			$logo_padding = 10;
			$total_header_height = $logo_height + $header_top_padding + $header_bottom_padding + $logo_padding - 1;

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
					#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper, #homepage-wrapper, #search-wrapper, #index-wrapper, #error-404-wrapper, #archive-wrapper, #author-wrapper { 
						margin-top: <?php echo $total_header_height; ?>px; 
					}
				<?php } ?>
				.navbar {
					padding-top: <?php echo get_theme_mod('conversions_header_tpadding', '8'); ?>px;
					padding-bottom: <?php echo get_theme_mod('conversions_header_bpadding', '8'); ?>px;
				}
				<?php if (get_theme_mod( 'conversions_header_dropshadow', 'no' ) == 'yes') { ?>
					/* Header drop shadow */
					#wrapper-navbar nav.navbar {
						box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
					}
				<?php } ?>
				/* Footer styles */
				#wrapper-footer-full { background-color: <?php echo get_theme_mod('conversions_footer_background_color', '#3c3d45'); ?>; }
				#footer-full-content .h1, #footer-full-content .h2, #footer-full-content .h3, #footer-full-content .h4, #footer-full-content .h5, #footer-full-content .h6, #footer-full-content h1, #footer-full-content h2, #footer-full-content h3, #footer-full-content h4, #footer-full-content h5, #footer-full-content h6 { color: <?php echo get_theme_mod('conversions_footer_heading_color', '#ffffff'); ?>; }
				#footer-full-content p, #footer-full-content table, #footer-full-content li, #footer-full-content caption { color: <?php echo get_theme_mod('conversions_footer_text_color', '#ffffff'); ?>; }
				#footer-full-content a { color: <?php echo get_theme_mod('conversions_footer_link_color', '#00ffff'); ?>; }
				/* Typography styles */
				.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
					color: <?php echo get_theme_mod('conversions_heading_color', '#222222'); ?>;
					font-family: <?php echo $headings_font; ?>;
				}
				body, input, select, textarea {
					color: <?php echo get_theme_mod('conversions_text_color', '#111111'); ?>;
					font-family: <?php echo $body_font; ?>;
				}
				a { color: <?php echo get_theme_mod('conversions_link_color', '#2600e6'); ?>; }
				/* Copyright styles */
				#wrapper-footer { background-color: <?php echo get_theme_mod('conversions_copyright_background_color', '#eeeeee'); ?>; }
				#wrapper-footer .site-info .copyright { color: <?php echo get_theme_mod('conversions_copyright_text_color', '#111111'); ?>; }
				#wrapper-footer .site-info .copyright a { color: <?php echo get_theme_mod('conversions_copyright_link_color', '#2600e6'); ?>; }
				/* Social icons */
				#wrapper-footer .social-media-icons ul li.list-inline-item i {
					font-size: <?php echo get_theme_mod('conversions_social_size', '22'); ?>px;
					color: <?php echo get_theme_mod('conversions_social_link_color', '#2600e6'); ?>;
				}
				<?php if (get_theme_mod( 'conversions_wccheckout_columns', 'two-column' ) == 'two-column') { ?>
					/* WooCommerce */
					@media screen and (min-width:768px) {
						body.woocommerce-checkout #customer_details { width: 48%; float: left; margin-right: 1.9%; }
						body.woocommerce-checkout .col-12.col-md-7.conversions-wcbilling { flex: 0 0 100%; -webkit-flex: 0 0 100%; -ms-flex: 0 0 100%; max-width: 100%; }
						body.woocommerce-checkout .col-12.col-md-5.conversions-wcshipping { flex: 0 0 100%; -webkit-flex: 0 0 100%; -ms-flex: 0 0 100%; max-width: 100%; margin-top: 1em; }
						body.woocommerce-checkout #order_review, body.woocommerce-checkout #order_review_heading { width: 48%; float: right; margin-right: 0; }
					}
				<?php } ?>
				<?php if (get_theme_mod( 'conversions_sidebar_mvisibility', 'show' ) == 'hide') { ?>
					/* Sidebar */
					@media (max-width: 767.98px) {
						#sidebar-2, #sidebar-1 { display: none; }
					}
				<?php } ?>
			</style>

			<?php
		}

		/**
			@brief		woocommerce_add_to_cart_fragments
			@since		2019-08-15 23:17:37
		**/
		public function woocommerce_add_to_cart_fragments( $fragments )
		{
			global $woocommerce;

			ob_start();

			$cart_totals = WC()->cart->get_cart_contents_count();
			if( WC()->cart->get_cart_contents_count() > 0)
			{
				$cart_totals = WC()->cart->get_cart_contents_count();
			}
			else
			{
				$cart_totals = '';
			}

			?>
			<a class="cart-customlocation nav-link" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="View your shopping cart"><i class="fas fa-shopping-bag"></i><?php echo $cart_totals; ?></a>
			<?php
			$fragments['a.cart-customlocation.nav-link'] = ob_get_clean();

			return $fragments;
		}

		/**
			@brief		wp_nav_menu_items
			@since		2019-08-15 23:15:12
		**/
		public function wp_nav_menu_items( $items, $args )
		{
			if ( $args->theme_location === 'primary' ) {

				// Append Navigation Button?
				// get nav button customizer setting whether to show button or not
				$nav_button_type = get_theme_mod( 'conversions_nav_button', 'no' );
				if ($nav_button_type != 'no') {
					// get nav button text option
					$nav_button_text = get_theme_mod( 'conversions_nav_button_text', 'Click me' );
					// get nav button url option
					$nav_button_url = get_theme_mod( 'conversions_nav_button_url', 'https://wordpress.org' );
					// output the nav button with options
					$nav_button = '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="nav-callout-button menu-item nav-item"><a title="' . $nav_button_text . '" href="' . $nav_button_url . '" class="btn ' . $nav_button_type . '">' . $nav_button_text . '</a></li>';
					// Add the nav button to the end of the menu.
					$items = $items . $nav_button;
				}

				// Append WooCommerce Cart Icon?
				// first check if woocommerce is active
				if ( class_exists( 'woocommerce' ) ) {
					// get customizer option whether to show cart icon or not
					if (get_theme_mod( 'conversions_wccart_nav', 'yes' ) == 'yes') {
						// get WC cart totals and if = 0 only show icon with no text
						$cart_totals = WC()->cart->get_cart_contents_count();
						if( WC()->cart->get_cart_contents_count() > 0) {
							$cart_totals = WC()->cart->get_cart_contents_count();
						}
						else {
							$cart_totals = '';
						}
						// output the cart icon with item count
						$cart_link = sprintf( '<li class="cart menu-item nav-item" itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"><a class="cart-customlocation nav-link" href="%s" title="View your shopping cart"><i class="fas fa-shopping-bag"></i>%s</a></li>',
							wc_get_cart_url(),
							$cart_totals
						);
						// Add the cart icon to the end of the menu.
						$items = $items . $cart_link;
					}
				}

				// Append Search Icon to nav? Separate function coversions_nav_search_modal adds modal html to footer.
				// get search icon customizer setting whether to show or not
				$nav_search_icon = get_theme_mod( 'conversions_nav_search_icon', 'show' );
				if ($nav_search_icon != 'hide') {
					// output the nav search icon if active.
					$nav_search = '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="search-icon menu-item nav-item"><a title="Search" href="#csearchModal" data-toggle="modal" class="nav-link"><i class="fas fa-search"></i></a></li>';
					// Add the nav button to the end of the menu.
					$items = $items . $nav_search;
				}

			}
			return $items;
		}
	}
	conversions()->customizer = new Customizer();
}
namespace
{
	/**
	 * Select sanitization function
	 *
	 * @param string               $input   Slug to sanitize.
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
	 */
	function conversions_sanitize_select( $input, $setting )
	{
		// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
		$input = sanitize_key( $input );
		// Get the list of possible select options.
		$choices = $setting->manager->get_control( $setting->id )->choices;
		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}