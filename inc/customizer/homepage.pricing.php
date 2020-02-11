<?php
/**
 * Homepage Pricing customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_homepage_pricing',
	[
		'title'      => __( 'Pricing', 'conversions' ),
		'priority'   => 59,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_pricing_bg_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_pricing_bg_color_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'Pricing section background color.', 'conversions' ),
		'section'     => 'conversions_homepage_pricing',
		'settings'    => 'conversions_pricing_bg_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_pricing_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	]
);
$wp_customize->add_control(
	'conversions_pricing_title_control',
	[
		'label'       => __( 'Title', 'conversions' ),
		'description' => __( 'Add your title.', 'conversions' ),
		'section'     => 'conversions_homepage_pricing',
		'settings'    => 'conversions_pricing_title',
		'priority'    => 20,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_pricing_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_pricing_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title.', 'conversions' ),
		'section'     => 'conversions_homepage_pricing',
		'settings'    => 'conversions_pricing_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_pricing_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_pricing_desc',
	[
		'label'       => __( 'Description', 'conversions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_pricing',
		'settings'    => 'conversions_pricing_desc',
		'priority'    => 40,
		'type'        => 'textarea',
		'capability'  => 'edit_theme_options',
	]
);
$wp_customize->add_setting(
	'conversions_pricing_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_pricing_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions' ),
		'description' => __( 'Select a color for the description text.', 'conversions' ),
		'section'     => 'conversions_homepage_pricing',
		'settings'    => 'conversions_pricing_desc_color',
		'priority'    => 50,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_pricing_respond',
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
		'conversions_pricing_respond',
		[
			'label'       => __( 'Responsive', 'conversions' ),
			'description' => __( 'Select auto or manual item breakpoints.', 'conversions' ),
			'section'     => 'conversions_homepage_pricing',
			'settings'    => 'conversions_pricing_respond',
			'type'        => 'select',
			'choices'     => [
				'auto'   => __( 'Auto', 'conversions' ),
				'manual' => __( 'Manual', 'conversions' ),
			],
			'priority'    => '55',
		]
	)
);
$wp_customize->add_setting(
	'conversions_pricing_sm',
	[
		'default'           => '1',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_pricing_sm_control',
	[
		'label'       => __( '# of items on small screens', 'conversions' ),
		'description' => __( 'Items to show 576px to 767px. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_pricing',
		'settings'    => 'conversions_pricing_sm',
		'priority'    => 60,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_pricing_md',
	[
		'default'           => '1',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_pricing_md_control',
	[
		'label'       => __( '# of items on medium screens', 'conversions' ),
		'description' => __( 'Items to show 768px to 991px. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_pricing',
		'settings'    => 'conversions_pricing_md',
		'priority'    => 70,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_pricing_lg',
	[
		'default'           => '3',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_pricing_lg_control',
	[
		'label'       => __( '# of items on large screens', 'conversions' ),
		'description' => __( 'Items to show 992px up. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_pricing',
		'settings'    => 'conversions_pricing_lg',
		'priority'    => 80,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_pricing_repeater',
	[
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_repeater_sanitize',
	]
);
$wp_customize->add_control(
	new \Conversions_Repeater(
		$wp_customize,
		'conversions_pricing_repeater',
		[
			'label'                                 => __( 'Pricing table', 'conversions' ),
			'section'                               => 'conversions_homepage_pricing',
			'priority'                              => 90,
			'customizer_repeater_title_control'     => true,
			'customizer_repeater_subtitle_control'  => true,
			'customizer_repeater_subtitle2_control' => true,
			'customizer_repeater_linktext_control'  => true,
			'customizer_repeater_link_control'      => true,
			'customizer_repeater_repeater_control'  => true,
		]
	)
);
