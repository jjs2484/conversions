<?php
/**
 * Featured image customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_featured_img',
	[
		'title'       => __( 'Featured Images', 'conversions' ),
		'priority'    => 48,
		'description' => __( 'Settings for the featured image displayed on posts and pages.', 'conversions' ),
		'capability'  => 'edit_theme_options',
	]
);
$wp_customize->add_setting(
	'conversions_featured_img_parallax',
	[
		'default'           => false,
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_sanitize_checkbox',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_featured_img_parallax',
		[
			'label'       => __( 'Fixed background image', 'conversions' ),
			'description' => __( 'Check to create a parallax effect when the visitor scrolls.', 'conversions' ),
			'section'     => 'conversions_featured_img',
			'settings'    => 'conversions_featured_img_parallax',
			'type'        => 'checkbox',
			'priority'    => '1',
		]
	)
);
$wp_customize->add_setting(
	'conversions_featured_img_height',
	[
		'default'           => '60',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_featured_img_height_control',
	[
		'label'       => __( 'Featured image height', 'conversions' ),
		'description' => __( 'Height in vh units. 10vh is relative to 10% of the current viewport height.', 'conversions' ),
		'section'     => 'conversions_featured_img',
		'settings'    => 'conversions_featured_img_height',
		'priority'    => 5,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 100,
		],
	]
);
$wp_customize->add_setting(
	'conversions_featured_img_color',
	[
		'default'           => '#000000',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_featured_img_color_control',
	[
		'label'       => __( 'Overlay color', 'conversions' ),
		'description' => __( 'Select a color for the image overlay.', 'conversions' ),
		'section'     => 'conversions_featured_img',
		'settings'    => 'conversions_featured_img_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_featured_img_overlay',
	[
		'default'           => '.5',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_featured_img_overlay',
		[
			'label'       => __( 'Overlay opacity', 'conversions' ),
			'description' => __( 'Lighten or darken the featured image overlay. Set the contrast high enough so the text is readable.', 'conversions' ),
			'section'     => 'conversions_featured_img',
			'settings'    => 'conversions_featured_img_overlay',
			'type'        => 'select',
			'choices'     => [
				'0'  => __( '0%', 'conversions' ),
				'.1' => __( '10%', 'conversions' ),
				'.2' => __( '20%', 'conversions' ),
				'.3' => __( '30%', 'conversions' ),
				'.4' => __( '40%', 'conversions' ),
				'.5' => __( '50%', 'conversions' ),
				'.6' => __( '60%', 'conversions' ),
				'.7' => __( '70%', 'conversions' ),
				'.8' => __( '80%', 'conversions' ),
				'.9' => __( '90%', 'conversions' ),
				'1'  => __( '100%', 'conversions' ),
			],
			'priority'    => '20',
		]
	)
);
$wp_customize->add_setting(
	'conversions_featured_title_color',
	[
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_featured_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title text.', 'conversions' ),
		'section'     => 'conversions_featured_img',
		'settings'    => 'conversions_featured_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
