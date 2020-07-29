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
