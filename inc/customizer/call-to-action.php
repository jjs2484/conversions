<?php
/**
 * Call to action customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_cta',
	[
		'title'      => __( 'Call to Action', 'conversions' ),
		'priority'   => 44,
		'capability' => 'edit_theme_options',
	]
);
$wp_customize->add_setting(
	'conversions_hcta_state',
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
		'conversions_hcta_state',
		[
			'label'       => __( 'Call to Action section', 'conversions' ),
			'description' => __( 'Enable Call to Action section?', 'conversions' ),
			'section'     => 'conversions_cta',
			'settings'    => 'conversions_hcta_state',
			'type'        => 'checkbox',
			'priority'    => '1',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hcta_bg_choice',
	[
		'default'           => 'gradient',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_hcta_bg_choice',
		[
			'label'       => __( 'Background type', 'conversions' ),
			'description' => __( 'Select gradient, bootstrap colors, custom color, background image.', 'conversions' ),
			'section'     => 'conversions_cta',
			'settings'    => 'conversions_hcta_bg_choice',
			'type'        => 'select',
			'choices'     => [
				'bootstrap' => __( 'Bootstrap colors', 'conversions' ),
				'custom'    => __( 'Custom colors', 'conversions' ),
				'gradient'  => __( 'Gradient colors', 'conversions' ),
				'image'     => __( 'Image Background', 'conversions' ),
			],
			'priority'    => '2',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hcta_bg_gradient',
	[
		'default'           => 'crystal-clear',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_hcta_bg_gradient',
		[
			'label'       => __( 'Gradient colors', 'conversions' ),
			'description' => __( 'Call to Action section background color.', 'conversions' ),
			'section'     => 'conversions_cta',
			'settings'    => 'conversions_hcta_bg_gradient',
			'type'        => 'select',
			'choices'     => $this->gradient_choices,
			'priority'    => '3',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hcta_bg_bootstrap',
	[
		'default'           => 'bg-secondary',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_hcta_bg_bootstrap',
		[
			'label'       => __( 'Bootstrap colors', 'conversions' ),
			'description' => __( 'Call to Action section background color.', 'conversions' ),
			'section'     => 'conversions_cta',
			'settings'    => 'conversions_hcta_bg_bootstrap',
			'type'        => 'select',
			'choices'     => [
				'bg-primary'   => __( 'Primary', 'conversions' ),
				'bg-secondary' => __( 'Secondary', 'conversions' ),
				'bg-success'   => __( 'Success', 'conversions' ),
				'bg-danger'    => __( 'Danger', 'conversions' ),
				'bg-warning'   => __( 'Warning', 'conversions' ),
				'bg-info'      => __( 'Info', 'conversions' ),
				'bg-light'     => __( 'Light', 'conversions' ),
				'bg-dark'      => __( 'Dark', 'conversions' ),
				'bg-white'     => __( 'White', 'conversions' ),
			],
			'priority'    => '4',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hcta_bg_color',
	[
		'default'           => '#6c757d',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_hcta_bg_color_control',
	[
		'label'       => __( 'Custom color', 'conversions' ),
		'description' => __( 'Call to Action section background color.', 'conversions' ),
		'section'     => 'conversions_cta',
		'settings'    => 'conversions_hcta_bg_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_hcta_bg_img',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	new WP_Customize_Media_Control(
		$wp_customize,
		'conversions_hcta_bg_img',
		[
			'label'     => __( 'Upload image', 'conversions' ),
			'section'   => 'conversions_cta',
			'settings'  => 'conversions_hcta_bg_img',
			'priority'  => 11,
			'mime_type' => 'image',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hcta_img_color',
	[
		'default'           => '#000000',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_hcta_img_color_control',
	[
		'label'       => __( 'Image overlay color', 'conversions' ),
		'description' => __( 'Select a color for the image overlay.', 'conversions' ),
		'section'     => 'conversions_cta',
		'settings'    => 'conversions_hcta_img_color',
		'priority'    => 12,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_hcta_img_overlay',
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
		'conversions_hcta_img_overlay',
		[
			'label'       => __( 'Image overlay opacity', 'conversions' ),
			'description' => __( 'Lighten or darken the image overlay. Set the contrast high enough so the text is readable.', 'conversions' ),
			'section'     => 'conversions_cta',
			'settings'    => 'conversions_hcta_img_overlay',
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
			'priority'    => '15',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hcta_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_hcta_title_control',
	[
		'label'       => __( 'Title', 'conversions' ),
		'description' => __( 'Add your title.', 'conversions' ),
		'section'     => 'conversions_cta',
		'settings'    => 'conversions_hcta_title',
		'priority'    => 20,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_hcta_title_color',
	[
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_hcta_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title.', 'conversions' ),
		'section'     => 'conversions_cta',
		'settings'    => 'conversions_hcta_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_hcta_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_hcta_desc',
	[
		'label'       => __( 'Description', 'conversions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_cta',
		'settings'    => 'conversions_hcta_desc',
		'priority'    => 40,
		'type'        => 'textarea',
		'capability'  => 'edit_theme_options',
	]
);
$wp_customize->add_setting(
	'conversions_hcta_desc_color',
	[
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_hcta_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions' ),
		'description' => __( 'Select a color for the description text.', 'conversions' ),
		'section'     => 'conversions_cta',
		'settings'    => 'conversions_hcta_desc_color',
		'priority'    => 50,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_hcta_btn',
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
		'conversions_hcta_btn',
		[
			'label'       => __( 'Callout button', 'conversions' ),
			'description' => __( 'Choose the type of button.', 'conversions' ),
			'section'     => 'conversions_cta',
			'settings'    => 'conversions_hcta_btn',
			'type'        => 'select',
			'choices'     => $this->alt_button_choices,
			'priority'    => '60',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hcta_btn_text',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_hcta_btn_text_control',
	[
		'label'       => __( 'Callout button text', 'conversions' ),
		'description' => __( 'Add text for button to display.', 'conversions' ),
		'section'     => 'conversions_cta',
		'settings'    => 'conversions_hcta_btn_text',
		'priority'    => 70,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_cta_btn_url',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	]
);
$wp_customize->add_control(
	'conversions_cta_btn_url_control',
	[
		'label'       => __( 'Callout button URL', 'conversions' ),
		'description' => __( 'Where should the button link to?', 'conversions' ),
		'section'     => 'conversions_cta',
		'settings'    => 'conversions_cta_btn_url',
		'priority'    => 80,
		'type'        => 'url',
	]
);
$wp_customize->add_setting(
	'conversions_hcta_shortcode',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_hcta_shortcode_control',
	[
		'label'       => __( 'Shortcode', 'conversions' ),
		'description' => __( 'Add your shortcode.', 'conversions' ),
		'section'     => 'conversions_cta',
		'settings'    => 'conversions_hcta_shortcode',
		'priority'    => 90,
		'type'        => 'text',
	]
);
