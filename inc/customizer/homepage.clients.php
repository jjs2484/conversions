<?php
/**
 * Homepage Clients customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_homepage_clients',
	[
		'title'      => __( 'Clients', 'conversions' ),
		'priority'   => 20,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_hc_bg_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_hc_bg_color_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'Client section background color.', 'conversions' ),
		'section'     => 'conversions_homepage_clients',
		'settings'    => 'conversions_hc_bg_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_hc_logo_width',
	[
		'default'           => '6.2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_sanitize_float',
	]
);
$wp_customize->add_control(
	'conversions_hc_logo_width_control',
	[
		'label'       => __( 'Client logo width', 'conversions' ),
		'description' => __( 'Logo max-width in rem', 'conversions' ),
		'section'     => 'conversions_homepage_clients',
		'settings'    => 'conversions_hc_logo_width',
		'priority'    => 20,
		'type'        => 'number',
		'input_attrs' => [
			'min'  => 0,
			'max'  => 100,
			'step' => 0.1,
		],
	]
);
$wp_customize->add_setting(
	'conversions_hc_respond',
	[
		'default'           => 'auto',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_hc_respond',
		[
			'label'       => __( 'Responsive', 'conversions' ),
			'description' => __( 'Select auto or manual item breakpoints.', 'conversions' ),
			'section'     => 'conversions_homepage_clients',
			'settings'    => 'conversions_hc_respond',
			'type'        => 'select',
			'choices'     => [
				'auto'   => __( 'Auto', 'conversions' ),
				'manual' => __( 'Manual', 'conversions' ),
			],
			'priority'    => '30',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hc_sm',
	[
		'default'           => '2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_hc_sm_control',
	[
		'label'       => __( '# of items up to 576px', 'conversions' ),
		'description' => __( 'Number of items to show up to 576px.', 'conversions' ),
		'section'     => 'conversions_homepage_clients',
		'settings'    => 'conversions_hc_sm',
		'priority'    => 40,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 50,
		],
	]
);
$wp_customize->add_setting(
	'conversions_hc_md',
	[
		'default'           => '3',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_hc_md_control',
	[
		'label'       => __( '# of items up to 768px', 'conversions' ),
		'description' => __( 'Number of items to show up to 768px.', 'conversions' ),
		'section'     => 'conversions_homepage_clients',
		'settings'    => 'conversions_hc_md',
		'priority'    => 50,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 50,
		],
	]
);
$wp_customize->add_setting(
	'conversions_hc_lg',
	[
		'default'           => '4',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_hc_lg_control',
	[
		'label'       => __( '# of items up to 992px', 'conversions' ),
		'description' => __( 'Number of items to show up to 992px.', 'conversions' ),
		'section'     => 'conversions_homepage_clients',
		'settings'    => 'conversions_hc_lg',
		'priority'    => 60,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 50,
		],
	]
);
$wp_customize->add_setting(
	'conversions_hc_max',
	[
		'default'           => '5',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_hc_max_control',
	[
		'label'       => __( 'Max items to show', 'conversions' ),
		'description' => __( 'Max number of items to show at once.', 'conversions' ),
		'section'     => 'conversions_homepage_clients',
		'settings'    => 'conversions_hc_max',
		'priority'    => 70,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 50,
		],
	]
);
$wp_customize->add_setting(
	'conversions_hc_logos',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_repeater_sanitize',
	]
);
$wp_customize->add_control(
	new \Conversions_Repeater(
		$wp_customize,
		'conversions_hc_logos',
		[
			'label'    => __( 'Client logo', 'conversions' ),
			'section'  => 'conversions_homepage_clients',
			'priority' => 80,
			'customizer_repeater_image_control' => true,
		]
	)
);
