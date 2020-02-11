<?php
/**
 * Homepage Hero customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_homepage_hero',
	[
		'title'      => __( 'Hero', 'conversions' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_hh_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_hh_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_title_color',
		'priority'    => 2,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_hh_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_hh_desc',
	[
		'label'       => __( 'Description', 'conversions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_desc',
		'priority'    => 3,
		'type'        => 'textarea',
		'capability'  => 'edit_theme_options',
	]
);
$wp_customize->add_setting(
	'conversions_hh_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_hh_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions' ),
		'description' => __( 'Select a color for the description text.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_desc_color',
		'priority'    => 4,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_hh_content_position',
	[
		'default'           => 'col-lg-6',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_hh_content_position',
		[
			'label'       => __( 'Content position', 'conversions' ),
			'description' => __( 'Select the content display position.', 'conversions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_content_position',
			'type'        => 'select',
			'choices'     => [
				'col-lg-6' => __( 'Left', 'conversions' ),
				'col-lg-10 d-flex flex-column text-center mx-auto' => __( 'Center', 'conversions' ),
			],
			'priority'    => '5',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_img_parallax',
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
		'conversions_hh_img_parallax',
		[
			'label'       => __( 'Fixed background image', 'conversions' ),
			'description' => __( 'Check to create a parallax effect when the visitor scrolls.', 'conversions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_img_parallax',
			'type'        => 'checkbox',
			'priority'    => '6',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_img_height',
	[
		'default'           => '72',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_hh_img_height_control',
	[
		'label'       => __( 'Hero image height', 'conversions' ),
		'description' => __( 'Height in vh units. 10vh is relative to 10% of the current viewport height.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_img_height',
		'priority'    => 7,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 100,
		],
	]
);
$wp_customize->add_setting(
	'conversions_hh_img_color',
	[
		'default'           => '#000000',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_hh_img_color_control',
	[
		'label'       => __( 'Image overlay color', 'conversions' ),
		'description' => __( 'Select a color for the image overlay.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_img_color',
		'priority'    => 8,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_hh_img_overlay',
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
		'conversions_hh_img_overlay',
		[
			'label'       => __( 'Image overlay opacity', 'conversions' ),
			'description' => __( 'Lighten or darken the hero image overlay. Set the contrast high enough so the text is readable.', 'conversions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_img_overlay',
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
			'priority'    => '9',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_button',
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
		'conversions_hh_button',
		[
			'label'       => __( 'Callout button', 'conversions' ),
			'description' => __( 'Choose the type of button.', 'conversions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_button',
			'type'        => 'select',
			'choices'     => $alt_button_choices,
			'priority'    => '10',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_button_text',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	]
);
$wp_customize->add_control(
	'conversions_hh_button_text_control',
	[
		'label'       => __( 'Callout button text', 'conversions' ),
		'description' => __( 'Add text for button to display.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_button_text',
		'priority'    => 11,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_hh_button_url',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	]
);
$wp_customize->add_control(
	'conversions_hh_button_url_control',
	[
		'label'       => __( 'Callout button URL', 'conversions' ),
		'description' => __( 'Where should the button link to?', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_button_url',
		'priority'    => 12,
		'type'        => 'url',
	]
);
$wp_customize->add_setting(
	'conversions_hh_vbtn',
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
		'conversions_hh_vbtn',
		[
			'label'       => __( 'Video modal button', 'conversions' ),
			'description' => __( 'Choose the type of button.', 'conversions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_vbtn',
			'type'        => 'select',
			'choices'     => [
				'no'        => __( 'None', 'conversions' ),
				'primary'   => __( 'Primary', 'conversions' ),
				'secondary' => __( 'Secondary', 'conversions' ),
				'success'   => __( 'Success', 'conversions' ),
				'danger'    => __( 'Danger', 'conversions' ),
				'warning'   => __( 'Warning', 'conversions' ),
				'info'      => __( 'Info', 'conversions' ),
				'light'     => __( 'Light', 'conversions' ),
				'dark'      => __( 'Dark', 'conversions' ),
			],
			'priority'    => '13',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_vbtn_text',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	]
);
$wp_customize->add_control(
	'conversions_hh_vbtn_text_control',
	[
		'label'       => __( 'Video button text', 'conversions' ),
		'description' => __( 'Text to display next to the video button.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_vbtn_text',
		'priority'    => 14,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_hh_vbtn_url',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	]
);
$wp_customize->add_control(
	'conversions_hh_vbtn_url_control',
	[
		'label'       => __( 'Video URL', 'conversions' ),
		'description' => __( 'Youtube or Vimeo video URL.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_vbtn_url',
		'priority'    => 15,
		'type'        => 'url',
	]
);
