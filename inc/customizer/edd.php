<?php
/**
 * Easy Digital Downloads customizer section
 *
 * @package conversions
 */

if ( class_exists( 'Easy_Digital_Downloads' ) ) {

	$wp_customize->add_section(
		'conversions_edd',
		[
			'title'       => __( 'Easy Digital Downloads', 'conversions' ),
			'description' => __( 'Settings for Easy Digital Downloads.', 'conversions' ),
			'priority'    => 121,
			'capability'  => 'edit_theme_options',
		]
	);
	// Create our settings.
	$wp_customize->add_setting(
		'conversions_edd_nav_cart',
		[
			'default'           => true,
			'type'              => 'theme_mod',
			'sanitize_callback' => 'conversions_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
		]
	);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'conversions_edd_nav_cart',
			[
				'label'       => __( 'Cart icon in navbar', 'conversions' ),
				'description' => __( 'Enable cart icon in the navbar.', 'conversions' ),
				'section'     => 'conversions_edd',
				'settings'    => 'conversions_edd_nav_cart',
				'type'        => 'checkbox',
				'priority'    => '10',
			]
		)
	);
	$wp_customize->add_setting(
		'conversions_edd_nav_account',
		[
			'default'           => false,
			'type'              => 'theme_mod',
			'sanitize_callback' => 'conversions_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
		]
	);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'conversions_edd_nav_account',
			[
				'label'       => __( 'Account icon in navbar', 'conversions' ),
				'description' => __( 'Enable Account icon in the navbar.', 'conversions' ),
				'section'     => 'conversions_edd',
				'settings'    => 'conversions_edd_nav_account',
				'type'        => 'checkbox',
				'priority'    => '20',
			]
		)
	);
	$wp_customize->add_setting(
		'conversions_edd_primary_btn',
		[
			'default'           => 'btn-primary',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'conversions_sanitize_select',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
		]
	);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'conversions_edd_primary_btn',
			[
				'label'       => __( 'Primary button type', 'conversions' ),
				'description' => __( 'Select the primary button type. Applies to: add to cart, checkout, etc.', 'conversions' ),
				'section'     => 'conversions_edd',
				'settings'    => 'conversions_edd_primary_btn',
				'type'        => 'select',
				'choices'     => $this->button_choices,
				'priority'    => '30',
			]
		)
	);
	$wp_customize->add_setting(
		'conversions_edd_download_details',
		[
			'default'           => true,
			'type'              => 'theme_mod',
			'sanitize_callback' => 'conversions_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
		]
	);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'conversions_edd_download_details',
			[
				'label'       => __( 'Download details', 'conversions' ),
				'description' => __( 'Show download details on single posts: date, categories, tags, etc.', 'conversions' ),
				'section'     => 'conversions_edd',
				'settings'    => 'conversions_edd_download_details',
				'type'        => 'checkbox',
				'priority'    => '40',
			]
		)
	);

}
