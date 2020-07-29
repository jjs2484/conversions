<?php
/**
 * Colors customizer section
 *
 * @package conversions
 */

// Create our settings.
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
		'section'     => 'colors',
		'settings'    => 'conversions_link_color',
		'priority'    => 20,
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
		'section'     => 'colors',
		'settings'    => 'conversions_link_hcolor',
		'priority'    => 30,
		'type'        => 'color',
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
		'section'     => 'colors',
		'settings'    => 'conversions_footer_bg_color',
		'priority'    => 40,
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
		'section'     => 'colors',
		'settings'    => 'conversions_footer_text_color',
		'priority'    => 50,
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
		'section'     => 'colors',
		'settings'    => 'conversions_footer_link_color',
		'priority'    => 60,
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
		'section'     => 'colors',
		'settings'    => 'conversions_footer_link_hcolor',
		'priority'    => 70,
		'type'        => 'color',
	]
);
