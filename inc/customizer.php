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
			// get option values and decode
			$conversions_si = get_theme_mod( 'conversions_social_icons' );
			$conversions_si_decoded = json_decode( $conversions_si );
			
			if ( !empty( $conversions_si_decoded ) ) {
				echo '<div class="social-media-icons col-md"><ul class="list-inline">';
      			foreach ( $conversions_si_decoded as $repeater_item ) {

      				// remove prefixes for titles and screen reader text
      				$find = array('/\bfas \b/', '/\bfab \b/', '/\bfar \b/', '/\bfa-\b/');
					$title = preg_replace($find, "", $repeater_item->icon_value);

					// output the icon and link
					echo sprintf( '<li class="list-inline-item"><a title="%1$s" href="%2$s" target="_blank"><i aria-hidden="true" class="%3$s"></i><span class="sr-only">%1$s</span></a></li>',
						esc_attr( $title ), 
						esc_url( $repeater_item->link ),
						esc_attr( $repeater_item->icon_value )
                	);
				}
				echo '</ul></div>';
			}

		}
		/**
			@brief		customize_register
			@since		2019-08-15 23:32:18
		**/
		public function customize_register( $wp_customize )
		{
			// require customizer repeater
			require get_template_directory() . '/inc/Customizer_Repeater.php';
			
			// font choices
			$font_choices = array(
				'Comfortaa:400,700' => __( 'Comfortaa', 'conversions' ),
				'Droid Sans:400,700' => __( 'Droid Sans', 'conversions' ),
				'Droid Serif:400,700,400italic,700italic' => __( 'Droid Serif', 'conversions' ),
				'Handlee:400' => __( 'Handlee', 'conversions' ),
				'Indie Flower:400' => __( 'Indie Flower', 'conversions' ),
				'Lato:400,700,400italic,700italic' => __( 'Lato', 'conversions' ),
				'Libre Baskerville:400,400italic,700' => __( 'Libre Baskerville', 'conversions' ),
				'Lora:400,700,400italic,700italic' => __( 'Lora', 'conversions' ),
				'Merriweather:400,300italic,300,400italic,700,700italic' => __( 'Merriweather', 'conversions' ),
				'Open Sans:400italic,700italic,400,700' => __( 'Open Sans', 'conversions' ),
				'Oxygen:400,300,700' => __( 'Oxygen', 'conversions' ),
				'Roboto:400,400italic,700,700italic' => __( 'Roboto', 'conversions' ),
				'Roboto Slab:400,700' => __( 'Roboto Slab', 'conversions' ),
				'Special Elite:400' => __( 'Special Elite', 'conversions' ),
				'Ubuntu:400,700,400italic,700italic' => __( 'Ubuntu', 'conversions' ),
			);

			// button choices
			$button_choices = array(
				'btn-primary' => __( 'Primary', 'conversions' ),
				'btn-secondary' => __( 'Secondary', 'conversions' ),
				'btn-success' => __( 'Success', 'conversions' ),
				'btn-danger' => __( 'Danger', 'conversions' ),
				'btn-warning' => __( 'Warning', 'conversions' ),
				'btn-info' => __( 'Info', 'conversions' ),
				'btn-light' => __( 'Light', 'conversions' ),
				'btn-dark' => __( 'Dark', 'conversions' ),
				'btn-outline-primary' => __( 'Primary outline', 'conversions' ),
				'btn-outline-secondary' => __( 'Secondary outline', 'conversions' ),
				'btn-outline-success' => __( 'Success outline', 'conversions' ),
				'btn-outline-danger' => __( 'Danger outline', 'conversions' ),
				'btn-outline-warning' => __( 'Warning outline', 'conversions' ),
				'btn-outline-info' => __( 'Info outline', 'conversions' ),
				'btn-outline-light' => __( 'Light outline', 'conversions' ),
				'btn-outline-dark' => __( 'Dark outline', 'conversions' ),
			);

			// extra button choices
			$extra_button_choices = array(
				'no' => __( 'None', 'conversions' ),
			);

			// alt button choices
			$alt_button_choices = array_merge( $extra_button_choices , $button_choices );

			// gradient choices
			$gradient_choices = array(
				'grade-grey' => __( 'Grade Grey', 'conversions' ),
				'cool-blues' => __( 'Cool Blues', 'conversions' ),
				'moonlit-asteroid' => __( 'Moonlit Asteroid', 'conversions' ),
				'evening-sunshine' => __( 'Evening Sunshine', 'conversions' ),
				'dark-ocean' => __( 'Dark Ocean', 'conversions' ),
				'cool-sky' => __( 'Cool Sky', 'conversions' ),
				'yoda' => __( 'Yoda', 'conversions' ),
				'memariani' => __( 'Memariani', 'conversions' ),
				'harvey' => __( 'Harvey', 'conversions' ),
				'witching-hour' => __( 'Witching Hour', 'conversions' ),
				'wiretap' => __( 'Wiretap', 'conversions' ),
				'magic' => __( 'Magic', 'conversions' ),
				'mellow' => __( 'Mellow', 'conversions' ),
				'crystal-clear' => __( 'Crystal Clear', 'conversions' ),
				'summer' => __( 'Summer', 'conversions' ),
				'burning-orange' => __( 'Burning Orange', 'conversions' ),
				'instagram' => __( 'Instagram', 'conversions' ),
				'dracula' => __( 'Dracula', 'conversions' ),
				'titanium' => __( 'Titanium', 'conversions' ),
				'moss' => __( 'Moss', 'conversions' ),
			);

			//-----------------------------------------------------
			// Remove some default sections
			//-----------------------------------------------------
			$wp_customize->get_section( 'colors' )->active_callback = '__return_false';
			$wp_customize->get_section( 'background_image' )->active_callback = '__return_false';

			//-----------------------------------------------------
			// Add logo height to site identity panel
			//-----------------------------------------------------
			$wp_customize->add_setting( 'conversions_logo_height', array(
				'default'       => '40',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_logo_height_control', array(
				'label'      => __('Logo height', 'conversions'),
				'description'=> __('Max logo height in px', 'conversions'),
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
			// Navbar section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_nav' , array(
				'title'             => __('Navbar', 'conversions'),
				'priority'          => 21,
				'capability'        => 'edit_theme_options',
			) );
			// Create our settings
			$wp_customize->add_setting( 'conversions_nav_colors', array(
				'default'           => 'white',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_colors', array(
						'label'       => __( 'Navbar color scheme', 'conversions' ),
						'description' => __( 'Select the Navbar color scheme.', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_colors',
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
						'priority'    => '10',
					)
			) );
			$wp_customize->add_setting( 'conversions_nav_position', array(
				'default'           => 'fixed-top',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_position', array(
						'label'       => __( 'Navbar position', 'conversions' ),
						'description' => __( 'Should the Navbar be fixed or normal?', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_position',
						'type'        => 'select',
						'choices'     => array(
							'header-p-n' => __( 'Normal', 'conversions' ),
							'fixed-top'       => __( 'Fixed', 'conversions' ),
						),
						'priority'    => '20',
					)
			) );
			$wp_customize->add_setting( 'conversions_nav_dropshadow', array(
				'default'           => true,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_dropshadow', array(
						'label'       => __( 'Navbar drop shadow', 'conversions' ),
						'description' => __( 'Add a drop shadow to the Navbar?', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_dropshadow',
						'type'        => 'checkbox',
						'priority'    => '30',
					)
			) );
			$wp_customize->add_setting( 'conversions_nav_tbpadding', array(
				'default'       => '8',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint', //converts value to a non-negative integer
			) );
			$wp_customize->add_control( 'conversions_nav_tbpadding_control', array(
				'label'      => __( 'Navbar padding', 'conversions' ),
				'description'=> __( 'Top and bottom padding in px.', 'conversions' ),
				'section'    => 'conversions_nav',
				'settings'   => 'conversions_nav_tbpadding',
				'priority'   => 40,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 1000,
				),
			) );
			$wp_customize->add_setting( 'conversions_nav_search_icon', array(
				'default'           => false,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_search_icon', array(
						'label'       => __( 'Navbar search icon', 'conversions' ),
						'description' => __( 'Add a search icon to the Navbar?', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_search_icon',
						'type'        => 'checkbox',
						'priority'    => '60',
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
						'label'       => __( 'Add button to Navbar?', 'conversions' ),
						'description' => __( 'Choose the type of button.', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_button',
						'type'        => 'select',
						'choices'     => $alt_button_choices,
						'priority'    => '70',
					)
			) );
			$wp_customize->add_setting( 'conversions_nav_button_text', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'conversions_nav_button_text_control', array(
				'label'      => __( 'Button text', 'conversions' ),
				'description'=> __('Add text for button to display.', 'conversions'),
				'section'    => 'conversions_nav',
				'settings'   => 'conversions_nav_button_text',
				'priority'   => 80,
				'type'       => 'text',
			) );
			$wp_customize->add_setting( 'conversions_nav_button_url', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
			) );
			$wp_customize->add_control( 'conversions_nav_button_url_control', array(
				'label'      => __( 'Button URL', 'conversions' ),
				'description'=> __('Where should the button link to?', 'conversions'),
				'section'    => 'conversions_nav',
				'settings'   => 'conversions_nav_button_url',
				'priority'   => 90,
				'type'       => 'url',
			) );
			$wp_customize->add_setting( 'conversions_nav_mobile_type', array(
				'default'           => 'collapse',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_mobile_type', array(
						'label'       => __( 'Mobile menu type', 'conversions' ),
						'description' => __( 'Offcanvas or slide down mobile menu?', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_mobile_type',
						'type'        => 'select',
						'choices'     => array(
							'offcanvas' => __( 'Offcanvas', 'conversions' ),
							'collapse'       => __( 'Slide down', 'conversions' ),
						),
						'priority'    => '100',
					)
			) );

			//-----------------------------------------------------
			// Layout settings
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_layout_options', array(
				'title'       => __( 'Layout', 'conversions' ),
				'capability'  => 'edit_theme_options',
				'priority'    => 21,
			) );
			$wp_customize->add_setting( 'conversions_container_width', array(
				'default'       => '1140',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_container_width_control', array(
				'label'      => __( 'Max container width', 'conversions' ),
				'description'=> __( 'Specify the container max-width in px', 'conversions' ),
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
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_sidebar_position', array(
						'label'       => __( 'Sidebar Positioning', 'conversions' ),
						'description' => __( 'Set the sidebar position: right, left, or none. Note: this can be overridden on individual pages.',
						'conversions' ),
						'section'     => 'conversions_layout_options',
						'settings'    => 'conversions_sidebar_position',
						'type'        => 'select',
						'choices'     => array(
							'right' => __( 'Right', 'conversions' ),
							'left'  => __( 'Left', 'conversions' ),
							'none'  => __( 'None', 'conversions' ),
						),
						'priority'    => '20',
					)
				)
			);
			$wp_customize->add_setting( 'conversions_sidebar_mv', array(
				'default'           => true,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_sidebar_mv', array(
						'label'       => __( 'Show sidebar on mobile?', 'conversions' ),
						'description' => __( 'Check to show the sidebar on mobile.',
						'conversions' ),
						'section'     => 'conversions_layout_options',
						'settings'    => 'conversions_sidebar_mv',
						'type'        => 'checkbox',
						'priority'    => '30',
					)
				)
			);

			//-----------------------------------------------------
			// Typography section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_typography', array(
				'title'             => __('Typography', 'conversions'),
				'priority'          => 21,
				'description'       => __('Select your typography settings', 'conversions'),
				'capability'        => 'edit_theme_options',
			) );
			// Create our settings
			$wp_customize->add_setting( 'conversions_google_fonts', array(
				'default'       => true,
				'type'          => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_google_fonts', array(
						'label'       => __( 'Google fonts', 'conversions' ),
						'description' => __( 'Enable Google fonts? If disabled native fonts will be displayed instead.', 'conversions' ),
						'section'     => 'conversions_typography',
						'settings'    => 'conversions_google_fonts',
						'type'        => 'checkbox',
						'priority'    => '1',
					)
			) );
			$wp_customize->add_setting( 'conversions_headings_fonts', array(
				'default'       => 'Roboto:400,400italic,700,700italic',
				'type'          => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_headings_fonts', array(
						'label'       => __( 'Heading font', 'conversions' ),
						'description' => __( 'Select Google font for headings.', 'conversions' ),
						'section'     => 'conversions_typography',
						'settings'    => 'conversions_headings_fonts',
						'type'        => 'select',
						'choices' => $font_choices,
						'priority'    => '2',
					)
			) );
			$wp_customize->add_setting( 'conversions_body_fonts', array(
				'default'       => 'Roboto:400,400italic,700,700italic',
				'type'          => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_body_fonts', array(
						'label'       => __( 'Body font', 'conversions' ),
						'description' => __( 'Select Google font for the body.', 'conversions' ),
						'section'     => 'conversions_typography',
						'settings'    => 'conversions_body_fonts',
						'type'        => 'select',
						'choices' => $font_choices,
						'priority'    => '3',
					)
			) );
			$wp_customize->add_setting( 'conversions_link_color', array(
				'default'       => '#0068d7',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_link_color_control', array(
				'label'      => __('Link color', 'conversions'),
				'description'=> __('Select a color for hyperlinks.', 'conversions'),
				'section'    => 'conversions_typography',
				'settings'   => 'conversions_link_color',
				'priority'   => 40,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_link_hcolor', array(
				'default'       => '#00698c',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_link_hcolor_control', array(
				'label'      => __('Link hover color', 'conversions'),
				'description'=> __('Select a hover color for hyperlinks.', 'conversions'),
				'section'    => 'conversions_typography',
				'settings'   => 'conversions_link_hcolor',
				'priority'   => 50,
				'type'       => 'color',
			) );

			//-----------------------------------------------------
			// Call to action section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_cta', array(
				'title'             => __('Call to Action', 'conversions'),
				'priority'          => 21,
				'capability'        => 'edit_theme_options',
			) );
			$wp_customize->add_setting( 'conversions_hcta_state', array(
				'default'       => true,
				'type'          => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hcta_state', array(
						'label'       => __( 'Call to Action section', 'conversions' ),
						'description' => __( 'Enable Call to Action section?', 'conversions' ),
						'section'     => 'conversions_cta',
						'settings'    => 'conversions_hcta_state',
						'type'        => 'checkbox',
						'priority'    => '1',
					)
			) );
			$wp_customize->add_setting( 'conversions_hcta_bg_choice', array(
				'default'           => 'gradient',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hcta_bg_choice', array(
						'label'       => __( 'Background type', 'conversions' ),
						'description' => __( 'Select gradient, bootstrap colors, or custom.', 'conversions' ),
						'section'     => 'conversions_cta',
						'settings'    => 'conversions_hcta_bg_choice',
						'type'        => 'select',
						'choices'     => array(
							'bootstrap' => __( 'Bootstrap colors', 'conversions' ),
							'custom' => __( 'Custom colors', 'conversions' ),
							'gradient' => __( 'Gradient colors', 'conversions' ),
						),
						'priority'    => '2',
					)
			) );
			$wp_customize->add_setting( 'conversions_hcta_bg_gradient', array(
				'default'           => 'crystal-clear',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hcta_bg_gradient', array(
						'label'       => __( 'Gradient colors', 'conversions' ),
						'description' => __( 'Call to Action section background color.', 'conversions' ),
						'section'     => 'conversions_cta',
						'settings'    => 'conversions_hcta_bg_gradient',
						'type'        => 'select',
						'choices'     => $gradient_choices,
						'priority'    => '3',
					)
			) );
			$wp_customize->add_setting( 'conversions_hcta_bg_bootstrap', array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hcta_bg_bootstrap', array(
						'label'       => __( 'Bootstrap colors', 'conversions' ),
						'description' => __( 'Call to Action section background color.', 'conversions' ),
						'section'     => 'conversions_cta',
						'settings'    => 'conversions_hcta_bg_bootstrap',
						'type'        => 'select',
						'choices' => array(
							'bg-primary' => __( 'Primary', 'conversions' ),
							'bg-secondary' => __( 'Secondary', 'conversions' ),
							'bg-success' => __( 'Success', 'conversions' ),
							'bg-danger' => __( 'Danger', 'conversions' ),
							'bg-warning' => __( 'Warning', 'conversions' ),
							'bg-info' => __( 'Info', 'conversions' ),
							'bg-light' => __( 'Light', 'conversions' ),
							'bg-dark' => __( 'Dark', 'conversions' ),
							'bg-white' => __( 'White', 'conversions' ),
						),
						'priority'    => '4',
					)
			) );
			$wp_customize->add_setting( 'conversions_hcta_bg_color', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_hcta_bg_color_control', array(
				'label'      => __('Custom color', 'conversions'),
				'description'=> __('Call to Action section background color.', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_hcta_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_hcta_title', array(
				'default'       => __( 'Get started today!', 'conversions' ),
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'conversions_hcta_title_control', array(
				'label'      => __('Title', 'conversions'),
				'description'=> __('Add your title.', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_hcta_title',
				'priority'   => 20,
				'type'       => 'text',
			) );
			$wp_customize->add_setting( 'conversions_hcta_title_color', array(
				'default'       => '#ffffff',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_hcta_title_color_control', array(
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_hcta_title_color',
				'priority'   => 30,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_hcta_desc', array(
      			'default' => __( 'Conversions is an HTML5 template, and its mission to improve the future of web. Are you ready to join us?', 'conversions' ),
      			'type'          => 'theme_mod',
      			'transport' => 'refresh',
      			'sanitize_callback' => 'wp_kses_post'
   			) );
			$wp_customize->add_control( 'conversions_hcta_desc', array(
      			'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
      			'section' => 'conversions_cta',
      			'settings'   => 'conversions_hcta_desc',
      			'priority' => 40,
      			'type' => 'textarea',
      			'capability' => 'edit_theme_options',
   			) );
   			$wp_customize->add_setting( 'conversions_hcta_desc_color', array(
				'default'       => '#ffffff',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_hcta_desc_color_control', array(
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_hcta_desc_color',
				'priority'   => 50,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_hcta_btn', array(
				'default'           => 'btn-light',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hcta_btn', array(
						'label'       => __( 'Callout button', 'conversions' ),
						'description' => __( 'Choose the type of button.', 'conversions' ),
						'section'     => 'conversions_cta',
						'settings'    => 'conversions_hcta_btn',
						'type'        => 'select',
						'choices'     => $alt_button_choices,
						'priority'    => '60',
					)
			) );
			$wp_customize->add_setting( 'conversions_hcta_btn_text', array(
				'default'       => __( 'Click me', 'conversions' ),
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'conversions_hcta_btn_text_control', array(
				'label'      => __( 'Callout button text', 'conversions' ),
				'description'=> __('Add text for button to display.', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_hcta_btn_text',
				'priority'   => 70,
				'type'       => 'text',
			) );
			$wp_customize->add_setting( 'conversions_cta_btn_url', array(
				'default'       => 'https://wordpress.org',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
			) );
			$wp_customize->add_control( 'conversions_cta_btn_url_control', array(
				'label'      => __( 'Callout button URL', 'conversions' ),
				'description'=> __('Where should the button link to?', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_cta_btn_url',
				'priority'   => 80,
				'type'       => 'url',
			) );
			$wp_customize->add_setting( 'conversions_hcta_shortcode', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_kses_post',
			) );
			$wp_customize->add_control( 'conversions_hcta_shortcode_control', array(
				'label'      => __('Shortcode', 'conversions'),
				'description'=> __('Add your shortcode.', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_hcta_shortcode',
				'priority'   => 90,
				'type'       => 'text',
			) );

			//-----------------------------------------------------
			// Footer colors
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_footer' , array(
				'title'             => __('Footer', 'conversions'),
				'priority'          => 21,
				'capability'        => 'edit_theme_options',
			) );
			// Create our settings
			$wp_customize->add_setting( 'conversions_footer_bg_color', array(
				'default'       => '#ffffff',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_footer_bg_color_control', array(
				'label'      => __('Background color', 'conversions'),
				'description'=> __('Select a footer background color.', 'conversions'),
				'section'    => 'conversions_footer',
				'settings'   => 'conversions_footer_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_footer_text_color', array(
				'default'       => '#222222',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_footer_text_color_control', array(
				'label'      => __('Text color', 'conversions'),
				'description'=> __('Select text color for footer.', 'conversions'),
				'section'    => 'conversions_footer',
				'settings'   => 'conversions_footer_text_color',
				'priority'   => 30,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_footer_link_color', array(
				'default'       => '#0068d7',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_footer_link_color_control', array(
				'label'      => __('Link color', 'conversions'),
				'description'=> __('Select hyperlink color for footer.', 'conversions'),
				'section'    => 'conversions_footer',
				'settings'   => 'conversions_footer_link_color',
				'priority'   => 40,
				'type'       => 'color',
			) );

			$wp_customize->add_setting( 'conversions_footer_link_hcolor', array(
				'default'       => '#00698c',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_footer_link_hcolor_control', array(
				'label'      => __('Link hover color', 'conversions'),
				'description'=> __('Select hyperlink hover color for footer.', 'conversions'),
				'section'    => 'conversions_footer',
				'settings'   => 'conversions_footer_link_hcolor',
				'priority'   => 50,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_copyright_text', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'conversions_copyright_text_control', array(
				'label'      => __('Copyright text', 'conversions'),
				'description'=> __('Add your copyright text. If left blank the Site Title will be used instead.', 'conversions'),
				'section'    => 'conversions_footer',
				'settings'   => 'conversions_copyright_text',
				'priority'   => 60,
				'type'       => 'text',
			) );
			$wp_customize->add_setting( 'conversions_social_size', array(
				'default'       => '20',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_social_size_control', array(
				'label'      => __( 'Social icon size', 'conversions' ),
				'description'=> __( 'Icon size in px', 'conversions' ),
				'section'    => 'conversions_footer',
				'settings'   => 'conversions_social_size',
				'priority'   => 70,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 1000,
				),
			) );
			$wp_customize->add_setting( 'conversions_social_icons', array(
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'     => 'refresh',
         		'sanitize_callback' => 'conversions_repeater_sanitize'
      		));
      		$wp_customize->add_control( 
      			new \Conversions_Repeater( 
      			$wp_customize, 'conversions_social_icons', array(
					'label'   => __('Icons','conversions'),
					'section' => 'conversions_footer',
					'priority' => 80,
					'customizer_repeater_icon_control' => true,
					'customizer_repeater_link_control' => true,
 				) 
      		) );

			//-----------------------------------------------------
			// Blog section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_blog', array(
				'title'             => __('Blog', 'conversions'),
				'priority'          => 21,
				'capability'        => 'edit_theme_options',
			) );
			// Create our settings
			$wp_customize->add_setting( 'conversions_blog_sticky_posts', array(
				'default'           => 'primary',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_blog_sticky_posts', array(
						'label'       => __( 'Sticky post highlight color', 'conversions' ),
						'description' => __( 'Select the highlight color for sticky posts.', 'conversions' ),
						'section'     => 'conversions_blog',
						'settings'    => 'conversions_blog_sticky_posts',
						'type'        => 'select',
						'choices'     => array(
							'no' => __( 'None', 'conversions' ),
							'primary' => __( 'Primary', 'conversions' ),
							'secondary' => __( 'Secondary', 'conversions' ),
							'success' => __( 'Success', 'conversions' ),
							'danger' => __( 'Danger', 'conversions' ),
							'warning' => __( 'Warning', 'conversions' ),
							'info' => __( 'Info', 'conversions' ),
						),
						'priority'    => '1',
					)
			) );
			$wp_customize->add_setting( 'conversions_blog_more_btn', array(
				'default'           => 'btn-secondary',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_blog_more_btn', array(
						'label'       => __( 'Read more button type', 'conversions' ),
						'description' => __( 'Choose the read more button type shown on the blog index.', 'conversions' ),
						'section'     => 'conversions_blog',
						'settings'    => 'conversions_blog_more_btn',
						'type'        => 'select',
						'choices' => $button_choices,
						'priority'    => '2',
					)
			) );
			$wp_customize->add_setting( 'conversions_comment_btn', array(
				'default'           => 'btn-secondary',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_comment_btn', array(
						'label'       => __( 'Comment button type', 'conversions' ),
						'description' => __( 'Choose the comment button type.', 'conversions' ),
						'section'     => 'conversions_blog',
						'settings'    => 'conversions_comment_btn',
						'type'        => 'select',
						'choices' => $button_choices,
						'priority'    => '3',
					)
			) );
			$wp_customize->add_setting( 'conversions_blog_related', array(
				'default'       => true,
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_blog_related', array(
						'label'       => __( 'Show related posts', 'conversions' ),
						'description' => __( 'Enable related posts on single posts.', 'conversions' ),
						'section'     => 'conversions_blog',
						'settings'    => 'conversions_blog_related',
						'type'        => 'checkbox',
						'priority'    => '5',
					)
			) );
			$wp_customize->add_setting( 'conversions_blog_taxonomy', array(
				'default'       => 'categories',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_select',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_blog_taxonomy', array(
						'label'       => __( 'Related posts taxonomy', 'conversions' ),
						'description' => __( 'Use categories or tags to find related posts?', 'conversions' ),
						'section'     => 'conversions_blog',
						'settings'    => 'conversions_blog_taxonomy',
						'type'        => 'select',
						'choices'    => array(
							'tags' => __( 'Tags', 'conversions' ),
							'categories' => __( 'Categories', 'conversions' ),
						),
						'priority'    => '6',
					)
			) );

			//-----------------------------------------------------
			// Featured image section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_featured_img', array(
				'title'             => __('Featured Image', 'conversions'),
				'priority'          => 21,
				'description'       => __('Settings for the featured image displayed on posts and pages.', 'conversions'),
				'capability'        => 'edit_theme_options',
			) );
			$wp_customize->add_setting( 'conversions_featured_img_parallax', array(
				'default'       => false,
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_featured_img_parallax', array(
						'label'       => __( 'Fixed background image', 'conversions' ),
						'description' => __( 'Check to create a parallax effect when the visitor scrolls.', 'conversions' ),
						'section'     => 'conversions_featured_img',
						'settings'    => 'conversions_featured_img_parallax',
						'type'        => 'checkbox',
						'priority'    => '1',
					)
			) );
			$wp_customize->add_setting( 'conversions_featured_img_height', array(
				'default'       => '65',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_featured_img_height_control', array(
				'label'      => __('Featured image height', 'conversions'),
				'description'=> __('Height in vh units. 10vh is relative to 10% of the current viewport height.', 'conversions'),
				'section'    => 'conversions_featured_img',
				'settings'   => 'conversions_featured_img_height',
				'priority'   => 5,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 100,
				),
			) );
			$wp_customize->add_setting( 'conversions_featured_img_color', array(
				'default'       => '#000000',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_featured_img_color_control', array(
				'label'      => __('Overlay color', 'conversions'),
				'description'=> __('Select a color for the image overlay.', 'conversions'),
				'section'    => 'conversions_featured_img',
				'settings'   => 'conversions_featured_img_color',
				'priority'   => 10,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_featured_img_overlay', array(
				'default'           => '.4',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_featured_img_overlay', array(
						'label'       => __( 'Overlay opacity', 'conversions' ),
						'description' => __( 'Lighten or darken the featured image overlay. Set the contrast high enough so the text is readable.', 'conversions' ),
						'section'     => 'conversions_featured_img',
						'settings'    => 'conversions_featured_img_overlay',
						'type'        => 'select',
						'choices'     => array(
							'0' => __( '0%', 'conversions' ),
							'.1' => __( '10%', 'conversions' ),
							'.2' => __( '20%', 'conversions' ),
							'.3' => __( '30%', 'conversions' ),
							'.4' => __( '40%', 'conversions' ),
							'.5' => __( '50%', 'conversions' ),
							'.6' => __( '60%', 'conversions' ),
							'.7' => __( '70%', 'conversions' ),
							'.8' => __( '80%', 'conversions' ),
							'.9' => __( '90%', 'conversions' ),
							'1' => __( '100%', 'conversions' ),
						),
						'priority'    => '20',
					)
			) );
			$wp_customize->add_setting( 'conversions_featured_title_color', array(
				'default'       => '#ffffff',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_featured_title_color_control', array(
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title text.', 'conversions'),
				'section'    => 'conversions_featured_img',
				'settings'   => 'conversions_featured_title_color',
				'priority'   => 30,
				'type'       => 'color',
			) );

			//-----------------------------------------------------
			// WooCommerce Options
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_woocommerce', array(
				'title' => __( 'Conversions', 'conversions' ),
				'description'       => __('WooCommerce options for Conversions theme.', 'conversions'),
				'capability'        => 'edit_theme_options',
				'panel'             => 'woocommerce',
				'priority' => 100,
				'theme_supports' => array('woocommerce'),
			));
			// Create our settings
			$wp_customize->add_setting( 'conversions_wc_cart_nav', array(
				'default'           => true,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_wc_cart_nav', array(
						'label'       => __( 'Cart icon in navbar', 'conversions' ),
						'description' => __( 'Enable cart icon in the navbar.', 'conversions' ),
						'section'     => 'conversions_woocommerce',
						'settings'    => 'conversions_wc_cart_nav',
						'type'        => 'checkbox',
						'priority'    => '10',
					)
			) );
			$wp_customize->add_setting( 'conversions_wc_account', array(
				'default'           => false,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_wc_account', array(
						'label'       => __( 'Account icon in navbar', 'conversions' ),
						'description' => __( 'Enable Account icon in the navbar.', 'conversions' ),
						'section'     => 'conversions_woocommerce',
						'settings'    => 'conversions_wc_account',
						'type'        => 'checkbox',
						'priority'    => '20',
					)
			) );
			$wp_customize->add_setting( 'conversions_wc_checkout_columns', array(
				'default'           => 'two-column',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_wc_checkout_columns', array(
						'label'       => __( 'Checkout columns', 'conversions' ),
						'description' => __( 'How many columns should the checkout be?', 'conversions' ),
						'section'     => 'conversions_woocommerce',
						'settings'    => 'conversions_wc_checkout_columns',
						'type'        => 'select',
						'choices'     => array(
							'two-column' => __( 'Two column', 'conversions' ),
							'one-column'       => __( 'One column', 'conversions' ),
						),
						'priority'    => '30',
					)
			) );
			$wp_customize->add_setting( 'conversions_wc_primary_btn', array(
				'default'           => 'btn-outline-primary',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_wc_primary_btn', array(
						'label'       => __( 'Primary button type', 'conversions' ),
						'description' => __( 'Select the primary button type. Applies to: add to cart, apply coupon, update cart, login, register, etc.', 'conversions' ),
						'section'     => 'conversions_woocommerce',
						'settings'    => 'conversions_wc_primary_btn',
						'type'        => 'select',
						'choices' => $button_choices,
						'priority'    => '40',
					)
			) );
			$wp_customize->add_setting( 'conversions_wc_secondary_btn', array(
				'default'           => 'btn-primary',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_wc_secondary_btn', array(
						'label'       => __( 'Secondary button type', 'conversions' ),
						'description' => __( 'Select the secondary button type. Applies to: view cart, proceed to checkout, place order, etc.', 'conversions' ),
						'section'     => 'conversions_woocommerce',
						'settings'    => 'conversions_wc_secondary_btn',
						'type'        => 'select',
						'choices' => $button_choices,
						'priority'    => '45',
					)
			) );

			//-----------------------------------------------------
			// Homepage section
			//-----------------------------------------------------
			$wp_customize->add_panel( 'conversions_homepage', array(
				'priority'          => 119,
				'title'             => __('Homepage Design', 'conversions'),
				'description'       => __('Settings for the Homepage template', 'conversions'),
				'capability'        => 'edit_theme_options',
			) );

			//-----------------------------------------------------
			// Homepage Hero section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_hero', array(
				'title'             => __('Hero', 'conversions'),
				'priority'          => 10,
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
			) );
   			$wp_customize->add_setting( 'conversions_hh_title_color', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_hh_title_color_control', array(
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_title_color',
				'priority'   => 2,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_hh_desc', array(
      			'default' => '',
      			'type'          => 'theme_mod',
      			'transport' => 'refresh',
      			'sanitize_callback' => 'wp_kses_post'
   			) );
			$wp_customize->add_control( 'conversions_hh_desc', array(
      			'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
      			'section' => 'conversions_homepage_hero',
      			'settings'   => 'conversions_hh_desc',
      			'priority' => 3,
      			'type' => 'textarea',
      			'capability' => 'edit_theme_options',
   			) );
   			$wp_customize->add_setting( 'conversions_hh_desc_color', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_hh_desc_color_control', array(
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_desc_color',
				'priority'   => 4,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_hh_content_position', array(
				'default'           => 'col-lg-10 d-flex flex-column text-center mx-auto',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hh_content_position', array(
						'label'       => __( 'Content position', 'conversions' ),
						'description' => __( 'Select the content display position.', 'conversions' ),
						'section'     => 'conversions_homepage_hero',
						'settings'    => 'conversions_hh_content_position',
						'type'        => 'select',
						'choices'     => array(
							'col-lg-6' => __( 'Left', 'conversions' ),
							'col-lg-10 d-flex flex-column text-center mx-auto' => __( 'Center', 'conversions' ),
						),
						'priority'    => '5',
					)
			) );
			$wp_customize->add_setting( 'conversions_hh_img_parallax', array(
				'default'       => false,
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hh_img_parallax', array(
						'label'       => __( 'Fixed background image', 'conversions' ),
						'description' => __( 'Check to create a parallax effect when the visitor scrolls.', 'conversions' ),
						'section'     => 'conversions_homepage_hero',
						'settings'    => 'conversions_hh_img_parallax',
						'type'        => 'checkbox',
						'priority'    => '6',
					)
			) );
			$wp_customize->add_setting( 'conversions_hh_img_height', array(
				'default'       => '72',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_hh_img_height_control', array(
				'label'      => __('Hero image height', 'conversions'),
				'description'=> __('Height in vh units. 10vh is relative to 10% of the current viewport height.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_img_height',
				'priority'   => 7,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 100,
				),
			) );
			$wp_customize->add_setting( 'conversions_hh_img_color', array(
				'default'       => '#000000',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_hh_img_color_control', array(
				'label'      => __('Image overlay color', 'conversions'),
				'description'=> __('Select a color for the image overlay.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_img_color',
				'priority'   => 8,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_hh_img_overlay', array(
				'default'           => '.4',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hh_img_overlay', array(
						'label'       => __( 'Image overlay opacity', 'conversions' ),
						'description' => __( 'Lighten or darken the hero image overlay. Set the contrast high enough so the text is readable.', 'conversions' ),
						'section'     => 'conversions_homepage_hero',
						'settings'    => 'conversions_hh_img_overlay',
						'type'        => 'select',
						'choices'     => array(
							'0' => __( '0%', 'conversions' ),
							'.1' => __( '10%', 'conversions' ),
							'.2' => __( '20%', 'conversions' ),
							'.3' => __( '30%', 'conversions' ),
							'.4' => __( '40%', 'conversions' ),
							'.5' => __( '50%', 'conversions' ),
							'.6' => __( '60%', 'conversions' ),
							'.7' => __( '70%', 'conversions' ),
							'.8' => __( '80%', 'conversions' ),
							'.9' => __( '90%', 'conversions' ),
							'1' => __( '100%', 'conversions' ),
						),
						'priority'    => '9',
					)
			) );
			$wp_customize->add_setting( 'conversions_hh_button', array(
				'default'           => 'no',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hh_button', array(
						'label'       => __( 'Callout button', 'conversions' ),
						'description' => __( 'Choose the type of button.', 'conversions' ),
						'section'     => 'conversions_homepage_hero',
						'settings'    => 'conversions_hh_button',
						'type'        => 'select',
						'choices'     => $alt_button_choices,
						'priority'    => '10',
					)
			) );
			$wp_customize->add_setting( 'conversions_hh_button_text', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'conversions_hh_button_text_control', array(
				'label'      => __( 'Callout button text', 'conversions' ),
				'description'=> __('Add text for button to display.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_button_text',
				'priority'   => 11,
				'type'       => 'text',
			) );
			$wp_customize->add_setting( 'conversions_hh_button_url', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
			) );
			$wp_customize->add_control( 'conversions_hh_button_url_control', array(
				'label'      => __( 'Callout button URL', 'conversions' ),
				'description'=> __('Where should the button link to?', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_button_url',
				'priority'   => 12,
				'type'       => 'url',
			) );
			$wp_customize->add_setting( 'conversions_hh_vbtn', array(
				'default'           => 'no',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hh_vbtn', array(
						'label'       => __( 'Video modal button', 'conversions' ),
						'description' => __( 'Choose the type of button.', 'conversions' ),
						'section'     => 'conversions_homepage_hero',
						'settings'    => 'conversions_hh_vbtn',
						'type'        => 'select',
						'choices'     => array(
							'no' => __( 'None', 'conversions' ),
							'primary' => __( 'Primary', 'conversions' ),
							'secondary' => __( 'Secondary', 'conversions' ),
							'success' => __( 'Success', 'conversions' ),
							'danger' => __( 'Danger', 'conversions' ),
							'warning' => __( 'Warning', 'conversions' ),
							'info' => __( 'Info', 'conversions' ),
							'light' => __( 'Light', 'conversions' ),
							'dark' => __( 'Dark', 'conversions' ),
						),
						'priority'    => '13',
					)
			) );
			$wp_customize->add_setting( 'conversions_hh_vbtn_text', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'conversions_hh_vbtn_text_control', array(
				'label'      => __( 'Video button text', 'conversions' ),
				'description'=> __('Text to display next to the video button.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_vbtn_text',
				'priority'   => 14,
				'type'       => 'text',
			) );
			$wp_customize->add_setting( 'conversions_hh_vbtn_url', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
			) );
			$wp_customize->add_control( 'conversions_hh_vbtn_url_control', array(
				'label'      => __( 'Video URL', 'conversions' ),
				'description'=> __('Youtube or Vimeo video URL.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_vbtn_url',
				'priority'   => 15,
				'type'       => 'url',
			) );

			//-----------------------------------------------------
			// Homepage Clients section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_clients', array(
				'title'             => __('Clients', 'conversions'),
				'priority'          => 20,
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
			) );
			$wp_customize->add_setting( 'conversions_hc_bg_color', array(
				'default'       => '#F3F3F3',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_hc_bg_color_control', array(
				'label'      => __('Background color', 'conversions'),
				'description'=> __('Client section background color.', 'conversions'),
				'section'    => 'conversions_homepage_clients',
				'settings'   => 'conversions_hc_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_hc_logo_width', array(
				'default'       => '100',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_hc_logo_width_control', array(
				'label'      => __('Client logo width', 'conversions'),
				'description'=> __('Logo max-width in px', 'conversions'),
				'section'    => 'conversions_homepage_clients',
				'settings'   => 'conversions_hc_logo_width',
				'priority'   => 20,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 1000,
				),
			) );
			$wp_customize->add_setting( 'conversions_hc_respond', array(
				'default'           => 'auto',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hc_respond', array(
						'label'       => __( 'Responsive', 'conversions' ),
						'description' => __( 'Select auto or manual item breakpoints.', 'conversions' ),
						'section'     => 'conversions_homepage_clients',
						'settings'    => 'conversions_hc_respond',
						'type'        => 'select',
						'choices'     => array(
							'auto' => __( 'Auto', 'conversions' ),
							'manual' => __( 'Manual', 'conversions' ),
						),
						'priority'    => '30',
					)
			) );
			$wp_customize->add_setting( 'conversions_hc_sm', array(
				'default'       => '2',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_hc_sm_control', array(
				'label'      => __('# of items up to 576px', 'conversions'),
				'description'=> __('Number of items to show up to 576px.', 'conversions'),
				'section'    => 'conversions_homepage_clients',
				'settings'   => 'conversions_hc_sm',
				'priority'   => 40,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 50,
				),
			) );
			$wp_customize->add_setting( 'conversions_hc_md', array(
				'default'       => '3',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_hc_md_control', array(
				'label'      => __('# of items up to 768px', 'conversions'),
				'description'=> __('Number of items to show up to 768px.', 'conversions'),
				'section'    => 'conversions_homepage_clients',
				'settings'   => 'conversions_hc_md',
				'priority'   => 50,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 50,
				),
			) );
			$wp_customize->add_setting( 'conversions_hc_lg', array(
				'default'       => '4',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_hc_lg_control', array(
				'label'      => __('# of items up to 992px', 'conversions'),
				'description'=> __('Number of items to show up to 992px.', 'conversions'),
				'section'    => 'conversions_homepage_clients',
				'settings'   => 'conversions_hc_lg',
				'priority'   => 60,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 50,
				),
			) );
			$wp_customize->add_setting( 'conversions_hc_max', array(
				'default'       => '5',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_hc_max_control', array(
				'label'      => __('Max items to show', 'conversions'),
				'description'=> __('Max number of items to show at once.', 'conversions'),
				'section'    => 'conversions_homepage_clients',
				'settings'   => 'conversions_hc_max',
				'priority'   => 70,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 50,
				),
			) );
      		$wp_customize->add_setting( 'conversions_hc_logos', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
         		'sanitize_callback' => 'conversions_repeater_sanitize',
      		) );
      		$wp_customize->add_control( 
      			new \Conversions_Repeater( 
      				$wp_customize, 
      				'conversions_hc_logos', array(
						'label'   => __( 'Client logo', 'conversions' ),
						'section' => 'conversions_homepage_clients',
						'priority' => 80,
						'customizer_repeater_image_control' => true,
 					) 
      		) );

      		//-----------------------------------------------------
			// Homepage Features section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_features', array(
				'title'             => __('Features', 'conversions'),
				'priority'          => 30,
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
			) );
			$wp_customize->add_setting( 'conversions_features_bg_color', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_features_bg_color_control', array(
				'label'      => __('Background color', 'conversions'),
				'description'=> __('Features section background color.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_features_title', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'conversions_features_title_control', array(
				'label'      => __('Title', 'conversions'),
				'description'=> __('Add your title.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_title',
				'priority'   => 20,
				'type'       => 'text',
			) );
			$wp_customize->add_setting( 'conversions_features_title_color', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_features_title_color_control', array(
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_title_color',
				'priority'   => 30,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_features_desc', array(
      			'default' => '',
      			'type' => 'theme_mod',
      			'transport' => 'refresh',
      			'sanitize_callback' => 'wp_kses_post'
   			) );
			$wp_customize->add_control( 'conversions_features_desc', array(
      			'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
      			'section' => 'conversions_homepage_features',
      			'settings'   => 'conversions_features_desc',
      			'priority' => 40,
      			'type' => 'textarea',
      			'capability' => 'edit_theme_options',
   			) );
   			$wp_customize->add_setting( 'conversions_features_desc_color', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_features_desc_color_control', array(
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_desc_color',
				'priority'   => 50,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_features_sm', array(
				'default'       => '2',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_features_sm_control', array(
				'label'      => __('# of items on small screens', 'conversions'),
				'description'=> __('Items to show 576px to 767px. Choose 1-5.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_sm',
				'priority'   => 60,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 5,
				),
			) );
			$wp_customize->add_setting( 'conversions_features_md', array(
				'default'       => '2',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_features_md_control', array(
				'label'      => __('# of items on medium screens', 'conversions'),
				'description'=> __('Items to show 768px to 991px. Choose 1-5.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_md',
				'priority'   => 70,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 5,
				),
			) );
			$wp_customize->add_setting( 'conversions_features_lg', array(
				'default'       => '3',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_features_lg_control', array(
				'label'      => __('# of items on large screens', 'conversions'),
				'description'=> __('Items to show 992px up. Choose 1-5.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_lg',
				'priority'   => 80,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 5,
				),
			) );
			$wp_customize->add_setting( 'conversions_features_icons', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
         		'sanitize_callback' => 'conversions_repeater_sanitize',
      		) );
      		$wp_customize->add_control( 
      			new \Conversions_Repeater( 
      				$wp_customize, 
      				'conversions_features_icons', array(
						'label'   => __( 'Icon block', 'conversions' ),
						'section' => 'conversions_homepage_features',
						'priority' => 90,
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_color_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_linktext_control' => true,
						'customizer_repeater_link_control' => true,
 					) 
      		) );

      		//-----------------------------------------------------
			// Homepage Pricing section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_pricing', array(
				'title'             => __('Pricing', 'conversions'),
				'priority'          => 59,
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
			) );
			$wp_customize->add_setting( 'conversions_pricing_bg_color', array(
				'default'       => '#F3F3F3',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_pricing_bg_color_control', array(
				'label'      => __('Background color', 'conversions'),
				'description'=> __('Pricing section background color.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_pricing_title', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'conversions_pricing_title_control', array(
				'label'      => __('Title', 'conversions'),
				'description'=> __('Add your title.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_title',
				'priority'   => 20,
				'type'       => 'text',
			) );
			$wp_customize->add_setting( 'conversions_pricing_title_color', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_pricing_title_color_control', array(
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_title_color',
				'priority'   => 30,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_pricing_desc', array(
      			'default' => '',
      			'type' => 'theme_mod',
      			'transport' => 'refresh',
      			'sanitize_callback' => 'wp_kses_post'
   			) );
			$wp_customize->add_control( 'conversions_pricing_desc', array(
      			'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
      			'section' => 'conversions_homepage_pricing',
      			'settings'   => 'conversions_testimonials_desc',
      			'priority' => 40,
      			'type' => 'textarea',
      			'capability' => 'edit_theme_options',
   			) );
   			$wp_customize->add_setting( 'conversions_pricing_desc_color', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_pricing_desc_color_control', array(
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_desc_color',
				'priority'   => 50,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_pricing_respond', array(
				'default'           => 'auto',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_pricing_respond', array(
						'label'       => __( 'Responsive', 'conversions' ),
						'description' => __( 'Select auto or manual item breakpoints.', 'conversions' ),
						'section'     => 'conversions_homepage_pricing',
						'settings'    => 'conversions_pricing_respond',
						'type'        => 'select',
						'choices'     => array(
							'auto' => __( 'Auto', 'conversions' ),
							'manual' => __( 'Manual', 'conversions' ),
						),
						'priority'    => '55',
					)
			) );
			$wp_customize->add_setting( 'conversions_pricing_sm', array(
				'default'       => '1',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_pricing_sm_control', array(
				'label'      => __('# of items on small screens', 'conversions'),
				'description'=> __('Items to show 576px to 767px. Choose 1-5.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_sm',
				'priority'   => 60,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 5,
				),
			) );
			$wp_customize->add_setting( 'conversions_pricing_md', array(
				'default'       => '1',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_pricing_md_control', array(
				'label'      => __('# of items on medium screens', 'conversions'),
				'description'=> __('Items to show 768px to 991px. Choose 1-5.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_md',
				'priority'   => 70,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 5,
				),
			) );
			$wp_customize->add_setting( 'conversions_pricing_lg', array(
				'default'       => '3',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_pricing_lg_control', array(
				'label'      => __('# of items on large screens', 'conversions'),
				'description'=> __('Items to show 992px up. Choose 1-5.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_lg',
				'priority'   => 80,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 5,
				),
			) );
			$wp_customize->add_setting( 'conversions_pricing_repeater', array(
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
         		'sanitize_callback' => 'conversions_repeater_sanitize',
      		) );
      		$wp_customize->add_control( 
      			new \Conversions_Repeater( 
      				$wp_customize, 
      				'conversions_pricing_repeater', array(
						'label'   => __( 'Pricing table', 'conversions' ),
						'section' => 'conversions_homepage_pricing',
						'priority' => 90,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_subtitle2_control' => true,
						'customizer_repeater_linktext_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_repeater_control' => true
 					) 
      		) );

      		//-----------------------------------------------------
			// Homepage Testimonials section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_testimonials', array(
				'title'             => __('Testimonials', 'conversions'),
				'priority'          => 60,
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
			) );
			$wp_customize->add_setting( 'conversions_testimonials_bg_color', array(
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_testimonials_bg_color_control', array(
				'label'      => __('Background color', 'conversions'),
				'description'=> __('Testimonials section background color.', 'conversions'),
				'section'    => 'conversions_homepage_testimonials',
				'settings'   => 'conversions_testimonials_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_testimonials_title', array(
				'default'       => __( 'What customers say', 'conversions' ),
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'conversions_testimonials_title_control', array(
				'label'      => __('Title', 'conversions'),
				'description'=> __('Add your title.', 'conversions'),
				'section'    => 'conversions_homepage_testimonials',
				'settings'   => 'conversions_testimonials_title',
				'priority'   => 20,
				'type'       => 'text',
			) );
			$wp_customize->add_setting( 'conversions_testimonials_title_color', array(
				'default'       => '#222222',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_testimonials_title_color_control', array(
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_homepage_testimonials',
				'settings'   => 'conversions_testimonials_title_color',
				'priority'   => 30,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_testimonials_desc', array(
      			'default' => __( 'We appreciate our customers feedback! Here is what some of our customers have to say about us.', 'conversions' ),
      			'type' => 'theme_mod',
      			'transport' => 'refresh',
      			'sanitize_callback' => 'wp_kses_post'
   			) );
			$wp_customize->add_control( 'conversions_testimonials_desc', array(
      			'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
      			'section' => 'conversions_homepage_testimonials',
      			'settings'   => 'conversions_testimonials_desc',
      			'priority' => 40,
      			'type' => 'textarea',
      			'capability' => 'edit_theme_options',
   			) );
   			$wp_customize->add_setting( 'conversions_testimonials_desc_color', array(
				'default'       => '#6c757d',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_testimonials_desc_color_control', array(
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_homepage_testimonials',
				'settings'   => 'conversions_testimonials_desc_color',
				'priority'   => 50,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_testimonials_repeater', array(
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
         		'sanitize_callback' => 'conversions_repeater_sanitize',
      		) );
      		$wp_customize->add_control( 
      			new \Conversions_Repeater( 
      				$wp_customize, 
      				'conversions_testimonials_repeater', array(
						'label'   => __( 'Testimonials', 'conversions' ),
						'section' => 'conversions_homepage_testimonials',
						'priority' => 60,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_text_control' => true,
 					) 
      		) );

      		//-----------------------------------------------------
			// Homepage News section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_news', array(
				'title'             => __('News', 'conversions'),
				'priority'          => 70,
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
			) );
			$wp_customize->add_setting( 'conversions_news_bg_color', array(
				'default'       => '#F3F3F3',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_news_bg_color_control', array(
				'label'      => __('Background color', 'conversions'),
				'description'=> __('Call to Action section background color.', 'conversions'),
				'section'    => 'conversions_homepage_news',
				'settings'   => 'conversions_news_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_news_title', array(
				'default'       => __( 'Latest News', 'conversions' ),
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control( 'conversions_news_title_control', array(
				'label'      => __('Title', 'conversions'),
				'description'=> __('Add your title.', 'conversions'),
				'section'    => 'conversions_homepage_news',
				'settings'   => 'conversions_news_title',
				'priority'   => 20,
				'type'       => 'text',
			) );
			$wp_customize->add_setting( 'conversions_news_title_color', array(
				'default'       => '#222222',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_news_title_color_control', array(
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_homepage_news',
				'settings'   => 'conversions_news_title_color',
				'priority'   => 30,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_news_desc', array(
      			'default' => __( 'Read our latest news. We post regularly to keep you up to date on a variety of topics in our industry.', 'conversions' ),
      			'type'          => 'theme_mod',
      			'transport' => 'refresh',
      			'sanitize_callback' => 'wp_kses_post'
   			) );
			$wp_customize->add_control( 'conversions_news_desc', array(
      			'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
      			'section' => 'conversions_homepage_news',
      			'settings'   => 'conversions_news_desc',
      			'priority' => 40,
      			'type' => 'textarea',
      			'capability' => 'edit_theme_options',
   			) );
   			$wp_customize->add_setting( 'conversions_news_desc_color', array(
				'default'       => '#6c757d',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( 'conversions_news_desc_color_control', array(
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_homepage_news',
				'settings'   => 'conversions_news_desc_color',
				'priority'   => 50,
				'type'       => 'color',
			) );
			$wp_customize->add_setting( 'conversions_news_mposts', array(
				'default'       => '2',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			) );
			$wp_customize->add_control( 'conversions_news_mposts_control', array(
				'label'      => __('# of posts to show on mobile', 'conversions'),
				'description'=> __('Number of posts to show from 992px and down.', 'conversions'),
				'section'    => 'conversions_homepage_news',
				'settings'   => 'conversions_news_mposts',
				'priority'   => 60,
				'type'       => 'number',
				'input_attrs'=> array(
					'min' => 1,
					'max' => 3,
				),
			) );

		}

		/**
			@brief		wp_footer
			@since		2019-08-15 23:16:11
		**/
		public function wp_footer()
		{
			if ( get_theme_mod( 'conversions_nav_search_icon', false ) == true ) {
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
			if ( get_theme_mod( 'conversions_google_fonts', true ) == true ) {
				// headings
				$headings_font = get_theme_mod( 'conversions_headings_fonts', 'Roboto:400,400italic,700,700italic' );
				$heading_font_pieces = explode(":", $headings_font);
				$headings_font = $heading_font_pieces[0];
				// body
				$body_font = get_theme_mod( 'conversions_body_fonts', 'Roboto:400,400italic,700,700italic' );
				$body_font_pieces = explode(":", $body_font);
				$body_font = $body_font_pieces[0];
			} else {
				$headings_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
				$body_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
			}
			// fixed header height calc variables
			if ( has_custom_logo() ) {
				$logo_height = get_theme_mod( 'conversions_logo_height', '40' );
			}
			else {
				$logo_height = 30;
			}
			$nav_tbpadding = get_theme_mod( 'conversions_nav_tbpadding', '8' );
			$logo_padding = 10;
			$total_nav_height = $logo_height + ( $nav_tbpadding * 2 ) + $logo_padding - 1;
			$nav_offset = $total_nav_height + 50;

			// WC button option
			$wc_primary_btn = get_theme_mod( 'conversions_wc_primary_btn', 'btn-outline-primary' );
			$wc_secondary_btn = get_theme_mod( 'conversions_wc_secondary_btn', 'btn-primary' );

			// WC button multidimensional array
			$wc_btns = array(
				"btn-primary" => array ( "btn_bg" => "#007bff", "btn_color" => "#fff", "btn_border" => "#007bff", "btn_bg_hover" => "#0069d9", "btn_color_hover" => "#fff", "btn_border_hover" => "#0069d9" ),
				"btn-secondary" => array ( "btn_bg" => "#6c757d", "btn_color" => "#fff", "btn_border" => "#6c757d", "btn_bg_hover" => "#5a6268", "btn_color_hover" => "#fff", "btn_border_hover" => "#5a6268" ),
				"btn-success" => array ( "btn_bg" => "#019875", "btn_color" => "#fff", "btn_border" => "#019875", "btn_bg_hover" => "#017258", "btn_color_hover" => "#fff", "btn_border_hover" => "#017258" ),
				"btn-danger" => array ( "btn_bg" => "#dc3545", "btn_color" => "#fff", "btn_border" => "#dc3545", "btn_bg_hover" => "#c82333", "btn_color_hover" => "#fff", "btn_border_hover" => "#c82333" ),
				"btn-warning" => array ( "btn_bg" => "#ffc107", "btn_color" => "#212529", "btn_border" => "#ffc107", "btn_bg_hover" => "#e0a800", "btn_color_hover" => "#212529", "btn_border_hover" => "#e0a800" ),
				"btn-info" => array ( "btn_bg" => "#17a2b8", "btn_color" => "#fff", "btn_border" => "#17a2b8", "btn_bg_hover" => "#138496", "btn_color_hover" => "#fff", "btn_border_hover" => "#138496" ),
				"btn-light" => array ( "btn_bg" => "#f8f9fa", "btn_color" => "#212529", "btn_border" => "#f8f9fa", "btn_bg_hover" => "#e2e6ea", "btn_color_hover" => "#212529", "btn_border_hover" => "#e2e6ea" ),
				"btn-dark" => array ( "btn_bg" => "#151b26", "btn_color" => "#fff", "btn_border" => "#151b26", "btn_bg_hover" => "#07090d", "btn_color_hover" => "#fff", "btn_border_hover" => "#07090d" ),
				"btn-outline-primary" => array ( "btn_bg" => "transparent", "btn_color" => "#007bff", "btn_border" => "#007bff", "btn_bg_hover" => "#007bff", "btn_color_hover" => "#fff", "btn_border_hover" => "#007bff" ),
				"btn-outline-secondary" => array ( "btn_bg" => "transparent", "btn_color" => "#6c757d", "btn_border" => "#6c757d", "btn_bg_hover" => "#6c757d", "btn_color_hover" => "#fff", "btn_border_hover" => "#6c757d" ),
				"btn-outline-success" => array ( "btn_bg" => "transparent", "btn_color" => "#019875", "btn_border" => "#019875", "btn_bg_hover" => "#019875", "btn_color_hover" => "#fff", "btn_border_hover" => "#019875" ),
				"btn-outline-danger" => array ( "btn_bg" => "transparent", "btn_color" => "#dc3545", "btn_border" => "#dc3545", "btn_bg_hover" => "#dc3545", "btn_color_hover" => "#fff", "btn_border_hover" => "#dc3545" ),
				"btn-outline-warning" => array ( "btn_bg" => "transparent", "btn_color" => "#ffc107", "btn_border" => "#ffc107", "btn_bg_hover" => "#ffc107", "btn_color_hover" => "#212529", "btn_border_hover" => "#ffc107" ),
				"btn-outline-info" => array ( "btn_bg" => "transparent", "btn_color" => "#17a2b8", "btn_border" => "#17a2b8", "btn_bg_hover" => "#17a2b8", "btn_color_hover" => "#fff", "btn_border_hover" => "#17a2b8" ),
				"btn-outline-light" => array ( "btn_bg" => "transparent", "btn_color" => "#f8f9fa", "btn_border" => "#f8f9fa", "btn_bg_hover" => "#f8f9fa", "btn_color_hover" => "#212529", "btn_border_hover" => "#f8f9fa" ),
				"btn-outline-dark" => array ( "btn_bg" => "transparent", "btn_color" => "#151b26", "btn_border" => "#151b26", "btn_bg_hover" => "#151b26", "btn_color_hover" => "#fff", "btn_border_hover" => "#151b26" ),
			);

			$mods = array(
				array(".container-fluid", "max-width", get_theme_mod( "conversions_container_width" ), "px"),
				array("a.navbar-brand img", "max-height", get_theme_mod( 'conversions_logo_height' ), "px"),
				array(".navbar", "padding-top", get_theme_mod( 'conversions_nav_tbpadding' ), "px"),
				array(".navbar", "padding-bottom", get_theme_mod( 'conversions_nav_tbpadding' ), "px"),
				array("footer.site-footer", "background-color", get_theme_mod( 'conversions_footer_bg_color' )),
				array("footer.site-footer .h1, footer.site-footer .h2, footer.site-footer .h3, footer.site-footer .h4, footer.site-footer .h5, footer.site-footer .h6, footer.site-footer h1, footer.site-footer h2, footer.site-footer h3, footer.site-footer h4, footer.site-footer h5, footer.site-footer h6, footer.site-footer p, footer.site-footer table, footer.site-footer li, footer.site-footer caption, footer.site-footer .site-info .copyright", "color", get_theme_mod( 'conversions_footer_text_color' )),
				array("footer.site-footer a, footer.site-footer .site-info .copyright a, footer.site-footer .social-media-icons ul li.list-inline-item i", "color", get_theme_mod( 'conversions_footer_link_color' )),
				array("footer.site-footer a:hover, footer.site-footer .site-info .copyright a:hover, footer.site-footer .social-media-icons ul li.list-inline-item i:hover", "color", get_theme_mod( 'conversions_footer_link_hcolor' )),
				array("a", "color", get_theme_mod( 'conversions_link_color' )),
				array("a:hover", "color", get_theme_mod( 'conversions_link_hcolor')),
				array(".conversions-hero-cover .conversions-hero-cover__inner-container h1", "color", get_theme_mod( 'conversions_featured_title_color' )),
				array(".page-template-homepage section.c-hero h1", "color", get_theme_mod( 'conversions_hh_title_color' )),
				array(".page-template-homepage section.c-hero .c-hero__description", "color", get_theme_mod( 'conversions_hh_desc_color' )),
				array(".page-template-homepage section.c-clients", "background-color", get_theme_mod( 'conversions_hc_bg_color' )),
				array("section.c-clients img.client", "max-width", get_theme_mod( 'conversions_hc_logo_width' ), "px"),
				array("section.c-cta h2", "color", get_theme_mod( 'conversions_hcta_title_color' )),
				array("section.c-cta p.subtitle", "color", get_theme_mod( 'conversions_hcta_desc_color' )),
				array(".page-template-homepage section.c-news", "background-color", get_theme_mod( 'conversions_news_bg_color' )),
				array(".page-template-homepage section.c-news h2", "color", get_theme_mod( 'conversions_news_title_color' )),
				array(".page-template-homepage section.c-news p.subtitle", "color", get_theme_mod(' conversions_news_desc_color' )),
				array(".page-template-homepage section.c-testimonials", "background-color", get_theme_mod( 'conversions_testimonials_bg_color' )),
				array(".page-template-homepage section.c-testimonials h2", "color", get_theme_mod( 'conversions_testimonials_title_color' )),
				array(".page-template-homepage section.c-testimonials p.subtitle", "color", get_theme_mod( 'conversions_testimonials_desc_color' )),
				array(".page-template-homepage section.c-pricing", "background-color", get_theme_mod( 'conversions_pricing_bg_color' )),
				array(".page-template-homepage section.c-pricing h2", "color", get_theme_mod( 'conversions_pricing_title_color' )),
				array(".page-template-homepage section.c-pricing p.subtitle", "color", get_theme_mod( 'conversions_pricing_desc_color' )),
				array(".page-template-homepage section.c-features", "background-color", get_theme_mod( 'conversions_features_bg_color' )),
				array(".page-template-homepage section.c-features h2, section.c-features .card h3", "color", get_theme_mod( 'conversions_features_title_color' )),
				array(".page-template-homepage section.c-features p.subtitle, section.c-features .card .c-features__block-desc", "color", get_theme_mod( 'conversions_features_desc_color' )),
				array(".conversions-hero-cover", "min-height", get_theme_mod( 'conversions_featured_img_height'), "vh"),
				array(".h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6", "font-family", $headings_font),
				array("body, input, select, textarea", "font-family", $body_font),
				array("#wrapper-footer .social-media-icons ul li.list-inline-item i", "font-size", get_theme_mod( 'conversions_social_size' ), "px"),
				array(".page-template-homepage section.c-hero", "min-height", get_theme_mod( 'conversions_hh_img_height' ), "vh"),
			);
			?>

			<style>
				<?php
				foreach($mods as $key => $value) { 
					if ( !empty( $value[2] ) ) {
						echo $value[0];
						echo "{";
						echo $value[1];
						echo ":";
						echo esc_html($value[2]);
						if ( !empty($value[3])) {
							echo $value[3];
						}
						echo ";}";
					}
				}

				// Fixed navbar height
				if ( get_theme_mod( 'conversions_nav_position', 'fixed-top' ) == 'fixed-top' ) {
					echo '#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper, #homepage-wrapper, #search-wrapper, #index-wrapper, #error-404-wrapper, #archive-wrapper, #author-wrapper { 
							margin-top: '.esc_html( $total_nav_height ).'px; 
					}';
					echo '.wrapper :target:before, .wrapper li[id].comment:before { 
						display: block;
						content: " ";
						margin-top: -'.esc_html( $nav_offset ).'px;
						height: '.esc_html( $nav_offset ).'px;
						visibility: hidden;
						pointer-events: none;
					}';
				}
				// Navbar drop shadow
				if ( get_theme_mod( 'conversions_nav_dropshadow', true ) == true ) {
					echo '#wrapper-navbar nav.navbar { 
						box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
					}';
				}
				// Featured image
				if ( get_theme_mod( 'conversions_featured_img_parallax', false ) == true ) {
					echo '.conversions-hero-cover { 
						background-attachment: fixed; 
					}';
				}
				// Woocommerce
				if ( class_exists( 'woocommerce' ) ) {
					if ( get_theme_mod( 'conversions_wc_checkout_columns', 'two-column' ) == 'two-column' ) {
						// checkout columns
						echo '@media screen and (min-width:768px) {
							body.woocommerce-checkout #customer_details { width: 48%; float: left; margin-right: 1.9%; }
							body.woocommerce-checkout .col-12.col-md-7.conversions-wcbilling { flex: 0 0 100%; -webkit-flex: 0 0 100%; -ms-flex: 0 0 100%; max-width: 100%; }
							body.woocommerce-checkout .col-12.col-md-5.conversions-wcshipping { flex: 0 0 100%; -webkit-flex: 0 0 100%; -ms-flex: 0 0 100%; max-width: 100%; margin-top: 1em; }
							body.woocommerce-checkout #order_review, body.woocommerce-checkout #order_review_heading { width: 48%; float: right; margin-right: 0; }
						}';
					}
					// shop buttons
					echo '.woocommerce ul.products li.product .button, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wp-block-button__link {
						background: '.esc_html( $wc_btns[$wc_primary_btn]["btn_bg"] ).';
						color: '.esc_html( $wc_btns[$wc_primary_btn]["btn_color"] ).';
						border: 1px solid '.esc_html( $wc_btns[$wc_primary_btn]["btn_border"] ).';
					}';
					echo '.woocommerce ul.products li.product .button:hover, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wp-block-button__link:hover {
						color: '.esc_html( $wc_btns[$wc_primary_btn]["btn_color_hover"] ).';
						background-color: '.esc_html( $wc_btns[$wc_primary_btn]["btn_bg_hover"] ).';
						border-color: '.esc_html( $wc_btns[$wc_primary_btn]["btn_border_hover"] ).';
					}';
					echo '.woocommerce ul.products li.product .added_to_cart, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .added_to_cart {
						background: '.esc_html( $wc_btns[$wc_secondary_btn]["btn_bg"] ).';
						color: '.esc_html( $wc_btns[$wc_secondary_btn]["btn_color"] ).';
						border: 1px solid '.esc_html( $wc_btns[$wc_secondary_btn]["btn_border"] ).';
					}';
					echo '.woocommerce ul.products li.product .added_to_cart:hover, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .added_to_cart:hover {
						color: '.esc_html( $wc_btns[$wc_secondary_btn]["btn_color_hover"] ).';
						background-color: '.esc_html( $wc_btns[$wc_secondary_btn]["btn_bg_hover"] ).';
						border-color: '.esc_html( $wc_btns[$wc_secondary_btn]["btn_border_hover"] ).';
					}';
				}
				// sidebar
				if ( get_theme_mod( 'conversions_sidebar_mv', true ) == false ) {
					echo '@media (max-width: 767.98px) { #sidebar-2, #sidebar-1 { display: none; } }';
				}
				// Homepage hero
				if ( get_theme_mod( 'conversions_hh_img_parallax', false ) == true ) { 
					echo '.page-template-homepage section.c-hero {
						background-attachment: fixed;
					}';
				}
				// Homepage news
				if ( get_theme_mod( 'conversions_news_mposts', '2' ) == 1 ) {
					echo '@media (max-width: 991.98px) {
						section.c-news .c-news__card-wrapper:nth-of-type(2),
						section.c-news .c-news__card-wrapper:nth-of-type(3) {
							display: none;
						}
					}';
				}
				if ( get_theme_mod( 'conversions_news_mposts', '2' ) == 2 ) {
					echo '@media (max-width: 991.98px) {
						section.c-news .c-news__card-wrapper:nth-of-type(3) {
							display: none;
						}
					}';
				} 
				?>
			</style>

		<?php }

		/**
			@brief		woocommerce_add_to_cart_fragments
			@since		2019-08-15 23:17:37
		**/
		public function woocommerce_add_to_cart_fragments( $fragments )
		{
			global $woocommerce;
			ob_start();
			$cart_totals = WC()->cart->get_cart_contents_count();
			if ( WC()->cart->get_cart_contents_count() > 0)
			{
				$cart_totals = sprintf( '%s<span class="sr-only">' . __( ' items in your shopping cart', 'conversions' ) . '</span>',
					WC()->cart->get_cart_contents_count()
				);
			} else {
				$cart_totals = '<span class="sr-only">' . __( 'View your shopping cart', 'conversions' ) . '</span>';
			}
			?>
			<a class="cart-customlocation nav-link" title="<?php _e( 'View your shopping cart', 'conversions' ); ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><i aria-hidden="true" class="fas fa-shopping-bag"></i><?php echo $cart_totals; ?></a>
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
				
				// Is woocommerce is active?
				if ( class_exists( 'woocommerce' ) ) {
					
					// Append WooCommerce Cart icon?
					if ( get_theme_mod( 'conversions_wc_cart_nav', true ) == true ) {
						// get WC cart totals and if = 0 only show icon with no text
						$cart_totals = WC()->cart->get_cart_contents_count();
						if( WC()->cart->get_cart_contents_count() > 0) {
							$cart_totals = sprintf( '%s<span class="sr-only">' . __( ' items in your shopping cart', 'conversions' ) . '</span>',
								WC()->cart->get_cart_contents_count()
							);
						}
						else {
							$cart_totals = '<span class="sr-only">' . __( 'View your shopping cart', 'conversions' ) . '</span>';
						}
						// output the cart icon with item count
						$cart_link = sprintf( '<li class="cart menu-item nav-item" itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"><a title="' . __( 'View your shopping cart', 'conversions' ) . '" class="cart-customlocation nav-link" href="%s"><i aria-hidden="true" class="fas fa-shopping-bag"></i>%s</a></li>',
							wc_get_cart_url(),
							$cart_totals
						);
						// Add the cart icon to the end of the menu.
						$items = $items . $cart_link;
					}

					// Append WooCommerce Account icon?
					if ( get_theme_mod( 'conversions_wc_account', false ) == true ) {
						
						if ( is_user_logged_in() ) {
 							$wc_al = __('My Account','conversions');
 						} else {
 							$wc_al = __( 'Login / Register', 'conversions' );
 						}
						// output the account icon if active.
						$wc_account_link = sprintf( '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="search-icon menu-item nav-item"><a href="%1$s" class="nav-link" title="%2$s"><i aria-hidden="true" class="fas fa-user"></i><span class="sr-only">%2$s</span></a></li>',
							esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ),
							$wc_al
						);

						// Add the account to the end of the menu.
						$items = $items . $wc_account_link;
					}

				}

				// Append Search Icon to nav? Separate function coversions_nav_search_modal adds modal html to footer.
				if ( get_theme_mod( 'conversions_nav_search_icon', false ) == true ) {
					$nav_search = sprintf( '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="search-icon menu-item nav-item"><a href="#csearchModal" data-toggle="modal" class="nav-link" title="%1$s"><i aria-hidden="true" class="fas fa-search"></i><span class="sr-only">%1$s</span></a></li>',
						__( 'Search', 'conversions' )
						);

					// Add the nav button to the end of the menu.
					$items = $items . $nav_search;
				}

				// Append Navigation Button?
				if ( get_theme_mod( 'conversions_nav_button', 'no' ) != 'no' ) {

					$nav_btn_text = get_theme_mod( 'conversions_nav_button_text' );
					if ( empty( $nav_btn_text ) ) { 
						$nav_btn_text = "";
					}
					$nav_btn_url = get_theme_mod( 'conversions_nav_button_url' );
					if ( empty( $nav_btn_url ) ) { 
						$nav_btn_url = "";
					}

					$nav_button = sprintf( '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="nav-callout-button menu-item nav-item"><a title="%1$s" href="%2$s" class="btn %3$s">%1$s</a></li>',
						esc_html( $nav_btn_text ),
						esc_url( $nav_btn_url ),
						esc_attr( get_theme_mod( 'conversions_nav_button' ) )
					);

					// Add the nav button to the end of the menu.
					$items = $items . $nav_button;
				}
				
			}
			return $items;
		}
	}
	conversions()->customizer = new Customizer();
}

namespace
{
	// Select sanitization
	function conversions_sanitize_select( $input, $setting )
	{
		$control = $setting->manager->get_control( $setting->id );
		$valid = $control->choices;

		//return input if valid or return default option
		return ( array_key_exists( $input, $valid ) ? $input : $setting->default );
	}

    // Checkbox sanitization
	function conversions_sanitize_checkbox( $input ) 
	{
		return ( $input === true ) ? true : false;
	}

	// Repeater sanitization
	function conversions_repeater_sanitize( $input )
	{
		$input_decoded = json_decode( $input, true );
		if( !empty( $input_decoded ) ) {
			foreach ( $input_decoded as $boxk => $box ) {
				foreach ( $box as $key => $value ) {
					$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
				}
			}
			return json_encode( $input_decoded );
		}
		return $input;
	}

	// Filter to modify input label for repeater controls
	function conversions_repeater_labels( $string, $id, $control ) {
     	
     	// testimonial repeater labels
     	if ( $id === 'conversions_testimonials_repeater' ) {
     		if ( $control === 'customizer_repeater_title_control' ) {
     			return esc_html__( 'Full name','conversions' );
     		}
     		if ( $control === 'customizer_repeater_subtitle_control' ) {
     			return esc_html__( 'Company name','conversions' );
     		}
     		if ( $control === 'customizer_repeater_text_control' ) {
     			return esc_html__( 'Testimonial text','conversions' );
     		}
        }

        // pricing table repeater labels
        if ( $id === 'conversions_pricing_repeater' ) {
     		if ( $control === 'customizer_repeater_subtitle_control' ) {
     			return esc_html__( 'Price','conversions' );
     		}
     		if ( $control === 'customizer_repeater_subtitle2_control' ) {
     			return esc_html__( 'Duration','conversions' );
     		}
        }

        return $string;
    }
    add_filter( 'repeater_input_labels_filter','conversions_repeater_labels', 10 , 3 );
}