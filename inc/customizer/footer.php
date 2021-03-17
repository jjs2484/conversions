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
		'priority'   => 45,
		'capability' => 'edit_theme_options',
	]
);
// Create our settings.
$wp_customize->add_setting(
	'conversions_copyright_text',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_copyright_text_control',
	[
		'label'       => __( 'Copyright text', 'conversions' ),
		'description' => __( 'Add your copyright text. If left blank the Site Title will be used instead.', 'conversions' ),
		'section'     => 'conversions_footer',
		'settings'    => 'conversions_copyright_text',
		'priority'    => 10,
		'type'        => 'text',
	]
);
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
		'label'       => __( 'Footer background color', 'conversions' ),
		'description' => __( 'Select a footer background color.', 'conversions' ),
		'section'     => 'conversions_footer',
		'settings'    => 'conversions_footer_bg_color',
		'priority'    => 20,
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
		'label'       => __( 'Footer text color', 'conversions' ),
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
		'label'       => __( 'Footer link color', 'conversions' ),
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
		'label'       => __( 'Footer link hover color', 'conversions' ),
		'description' => __( 'Select hyperlink hover color for footer.', 'conversions' ),
		'section'     => 'conversions_footer',
		'settings'    => 'conversions_footer_link_hcolor',
		'priority'    => 50,
		'type'        => 'color',
	]
);
