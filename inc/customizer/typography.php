<?php
/**
 * Typography customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_typography',
	[
		'title'       => __( 'Typography', 'conversions' ),
		'priority'    => 21,
		'description' => __( 'Select your typography settings', 'conversions' ),
		'capability'  => 'edit_theme_options',
	]
);
// Create our settings.
$wp_customize->add_setting(
	'conversions_google_fonts',
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
		'conversions_google_fonts',
		[
			'label'       => __( 'Google fonts', 'conversions' ),
			'description' => __( 'Enable Google fonts? If disabled native fonts will be displayed instead.', 'conversions' ),
			'section'     => 'conversions_typography',
			'settings'    => 'conversions_google_fonts',
			'type'        => 'checkbox',
			'priority'    => '1',
		]
	)
);
$wp_customize->add_setting(
	'conversions_headings_fonts',
	[
		'default'           => 'Roboto:400,400italic,700,700italic',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_headings_fonts',
		[
			'label'       => __( 'Heading font', 'conversions' ),
			'description' => __( 'Select Google font for headings.', 'conversions' ),
			'section'     => 'conversions_typography',
			'settings'    => 'conversions_headings_fonts',
			'type'        => 'select',
			'choices'     => $this->font_choices,
			'priority'    => '2',
		]
	)
);
$wp_customize->add_setting(
	'conversions_body_fonts',
	[
		'default'           => 'Roboto:400,400italic,700,700italic',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_body_fonts',
		[
			'label'       => __( 'Body font', 'conversions' ),
			'description' => __( 'Select Google font for the body.', 'conversions' ),
			'section'     => 'conversions_typography',
			'settings'    => 'conversions_body_fonts',
			'type'        => 'select',
			'choices'     => $this->font_choices,
			'priority'    => '3',
		]
	)
);
$wp_customize->add_setting(
	'conversions_link_color',
	[
		'default'           => '#0068d7',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_link_color_control',
	[
		'label'       => __( 'Link color', 'conversions' ),
		'description' => __( 'Select a color for hyperlinks.', 'conversions' ),
		'section'     => 'conversions_typography',
		'settings'    => 'conversions_link_color',
		'priority'    => 40,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_link_hcolor',
	[
		'default'           => '#00698c',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_link_hcolor_control',
	[
		'label'       => __( 'Link hover color', 'conversions' ),
		'description' => __( 'Select a hover color for hyperlinks.', 'conversions' ),
		'section'     => 'conversions_typography',
		'settings'    => 'conversions_link_hcolor',
		'priority'    => 50,
		'type'        => 'color',
	]
);
