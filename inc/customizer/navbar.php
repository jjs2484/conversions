<?php
/**
 * Navbar customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_nav',
	[
		'title'      => __( 'Navbar', 'conversions' ),
		'priority'   => 21,
		'capability' => 'edit_theme_options',
	]
);
// Create our settings.
$wp_customize->add_setting(
	'conversions_nav_colors',
	[
		'default'           => 'white',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_nav_colors',
		[
			'label'       => __( 'Navbar color scheme', 'conversions' ),
			'description' => __( 'Select the Navbar color scheme.', 'conversions' ),
			'section'     => 'conversions_nav',
			'settings'    => 'conversions_nav_colors',
			'type'        => 'select',
			'choices'     => [
				'dark'      => __( 'Dark', 'conversions' ),
				'light'     => __( 'Light', 'conversions' ),
				'white'     => __( 'White', 'conversions' ),
				'primary'   => __( 'Primary', 'conversions' ),
				'secondary' => __( 'Secondary', 'conversions' ),
				'success'   => __( 'Success', 'conversions' ),
				'danger'    => __( 'Danger', 'conversions' ),
				'warning'   => __( 'Warning', 'conversions' ),
				'info'      => __( 'Info', 'conversions' ),
			],
			'priority'    => '10',
		]
	)
);
$wp_customize->add_setting(
	'conversions_nav_position',
	[
		'default'           => 'fixed-top',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_nav_position',
		[
			'label'       => __( 'Navbar position', 'conversions' ),
			'description' => __( 'Should the Navbar be fixed or normal?', 'conversions' ),
			'section'     => 'conversions_nav',
			'settings'    => 'conversions_nav_position',
			'type'        => 'select',
			'choices'     => [
				'header-p-n' => __( 'Normal', 'conversions' ),
				'fixed-top'  => __( 'Fixed', 'conversions' ),
			],
			'priority'    => '20',
		]
	)
);
$wp_customize->add_setting(
	'conversions_nav_dropshadow',
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
		'conversions_nav_dropshadow',
		[
			'label'       => __( 'Navbar drop shadow', 'conversions' ),
			'description' => __( 'Add drop shadow to the Navbar? Note: drop shadow combined with fixed Navbar may slightly degrade scroll performance.', 'conversions' ),
			'section'     => 'conversions_nav',
			'settings'    => 'conversions_nav_dropshadow',
			'type'        => 'checkbox',
			'priority'    => '30',
		]
	)
);
$wp_customize->add_setting(
	'conversions_nav_tbpadding',
	[
		'default'           => '.5',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_sanitize_float',
	]
);
$wp_customize->add_control(
	'conversions_nav_tbpadding_control',
	[
		'label'       => __( 'Navbar padding', 'conversions' ),
		'description' => __( 'Top and bottom padding in rem.', 'conversions' ),
		'section'     => 'conversions_nav',
		'settings'    => 'conversions_nav_tbpadding',
		'priority'    => 40,
		'type'        => 'number',
		'input_attrs' => [
			'min'  => 0,
			'max'  => 100,
			'step' => 0.1,
		],
	]
);
$wp_customize->add_setting(
	'conversions_nav_search_icon',
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
		'conversions_nav_search_icon',
		[
			'label'       => __( 'Navbar search icon', 'conversions' ),
			'description' => __( 'Add a search icon to the Navbar?', 'conversions' ),
			'section'     => 'conversions_nav',
			'settings'    => 'conversions_nav_search_icon',
			'type'        => 'checkbox',
			'priority'    => '60',
		]
	)
);
$wp_customize->add_setting(
	'conversions_nav_button',
	[
		'default'           => 'no',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_nav_button',
		[
			'label'       => __( 'Add button to Navbar?', 'conversions' ),
			'description' => __( 'Choose the type of button.', 'conversions' ),
			'section'     => 'conversions_nav',
			'settings'    => 'conversions_nav_button',
			'type'        => 'select',
			'choices'     => $this->alt_button_choices,
			'priority'    => '70',
		]
	)
);
$wp_customize->add_setting(
	'conversions_nav_button_text',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	]
);
$wp_customize->add_control(
	'conversions_nav_button_text_control',
	[
		'label'       => __( 'Button text', 'conversions' ),
		'description' => __( 'Add text for button to display.', 'conversions' ),
		'section'     => 'conversions_nav',
		'settings'    => 'conversions_nav_button_text',
		'priority'    => 80,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_nav_button_url',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	]
);
$wp_customize->add_control(
	'conversions_nav_button_url_control',
	[
		'label'       => __( 'Button URL', 'conversions' ),
		'description' => __( 'Where should the button link to?', 'conversions' ),
		'section'     => 'conversions_nav',
		'settings'    => 'conversions_nav_button_url',
		'priority'    => 90,
		'type'        => 'url',
	]
);
$wp_customize->add_setting(
	'conversions_nav_mobile_type',
	[
		'default'           => 'collapse',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_nav_mobile_type',
		[
			'label'       => __( 'Mobile menu type', 'conversions' ),
			'description' => __( 'Offcanvas or slide down mobile menu?', 'conversions' ),
			'section'     => 'conversions_nav',
			'settings'    => 'conversions_nav_mobile_type',
			'type'        => 'select',
			'choices'     => [
				'offcanvas' => __( 'Offcanvas', 'conversions' ),
				'collapse'  => __( 'Slide down', 'conversions' ),
			],
			'priority'    => '100',
		]
	)
);
