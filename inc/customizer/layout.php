<?php
/**
 * Layout customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_layout_options',
	[
		'title'      => __( 'Layout', 'conversions' ),
		'capability' => 'edit_theme_options',
		'priority'   => 42,
	]
);
$wp_customize->add_setting(
	'conversions_sidebar_position',
	[
		'default'           => 'right',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_sidebar_position',
		[
			'label'       => __( 'Sidebar Positioning', 'conversions' ),
			'description' => __( 'Set the sidebar position: right, left, or none. Note: this can be overridden on individual pages.', 'conversions' ),
			'section'     => 'conversions_layout_options',
			'settings'    => 'conversions_sidebar_position',
			'type'        => 'select',
			'choices'     => [
				'right' => __( 'Right', 'conversions' ),
				'left'  => __( 'Left', 'conversions' ),
				'none'  => __( 'None', 'conversions' ),
			],
			'priority'    => '20',
		]
	)
);
$wp_customize->add_setting(
	'conversions_sidebar_mv',
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
		'conversions_sidebar_mv',
		[
			'label'       => __( 'Show sidebar on mobile?', 'conversions' ),
			'description' => __( 'Check to show the sidebar on mobile.', 'conversions' ),
			'section'     => 'conversions_layout_options',
			'settings'    => 'conversions_sidebar_mv',
			'type'        => 'checkbox',
			'priority'    => '30',
		]
	)
);
$wp_customize->add_setting(
	'conversions_content_cards',
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
		'conversions_content_cards',
		[
			'label'       => __( 'Content container card?', 'conversions' ),
			'description' => __( 'Check to turn content container in a card.', 'conversions' ),
			'section'     => 'conversions_layout_options',
			'settings'    => 'conversions_content_cards',
			'type'        => 'checkbox',
			'priority'    => '40',
		]
	)
);