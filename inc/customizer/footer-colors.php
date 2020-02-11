<?php
/**
 * Footer colors customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_footer',
	[
		'title'      => __( 'Footer', 'conversions' ),
		'priority'   => 21,
		'capability' => 'edit_theme_options',
	]
);
// Create our settings.
$wp_customize->add_setting(
	'conversions_footer_bg_color',
	[
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_footer_bg_color_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'Select a footer background color.', 'conversions' ),
		'section'     => 'conversions_footer',
		'settings'    => 'conversions_footer_bg_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_footer_text_color',
	[
		'default'           => '#222222',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_footer_text_color_control',
	[
		'label'       => __( 'Text color', 'conversions' ),
		'description' => __( 'Select text color for footer.', 'conversions' ),
		'section'     => 'conversions_footer',
		'settings'    => 'conversions_footer_text_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_footer_link_color',
	[
		'default'           => '#0068d7',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_footer_link_color_control',
	[
		'label'       => __( 'Link color', 'conversions' ),
		'description' => __( 'Select hyperlink color for footer.', 'conversions' ),
		'section'     => 'conversions_footer',
		'settings'    => 'conversions_footer_link_color',
		'priority'    => 40,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_footer_link_hcolor',
	[
		'default'           => '#00698c',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_footer_link_hcolor_control',
	[
		'label'       => __( 'Link hover color', 'conversions' ),
		'description' => __( 'Select hyperlink hover color for footer.', 'conversions' ),
		'section'     => 'conversions_footer',
		'settings'    => 'conversions_footer_link_hcolor',
		'priority'    => 50,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_copyright_text',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	]
);
$wp_customize->add_control(
	'conversions_copyright_text_control',
	[
		'label'       => __( 'Copyright text', 'conversions' ),
		'description' => __( 'Add your copyright text. If left blank the Site Title will be used instead.', 'conversions' ),
		'section'     => 'conversions_footer',
		'settings'    => 'conversions_copyright_text',
		'priority'    => 60,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_social_size',
	[
		'default'           => '1.5',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_sanitize_float',
	]
);
$wp_customize->add_control(
	'conversions_social_size_control',
	[
		'label'       => __( 'Social icon size', 'conversions' ),
		'description' => __( 'Icon size in rem', 'conversions' ),
		'section'     => 'conversions_footer',
		'settings'    => 'conversions_social_size',
		'priority'    => 70,
		'type'        => 'number',
		'input_attrs' => [
			'min'  => 0,
			'max'  => 100,
			'step' => 0.1,
		],
	]
);
$wp_customize->add_setting(
	'conversions_social_icons',
	[
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_repeater_sanitize',
	]
);
$wp_customize->add_control(
	new \Conversions_Repeater(
		$wp_customize,
		'conversions_social_icons',
		[
			'label'                            => __( 'Icons', 'conversions' ),
			'section'                          => 'conversions_footer',
			'priority'                         => 80,
			'customizer_repeater_icon_control' => true,
			'customizer_repeater_link_control' => true,
		]
	)
);
