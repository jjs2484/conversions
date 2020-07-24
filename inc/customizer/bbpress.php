<?php
/**
 * bbPress customizer section
 *
 * @package conversions
 */

if ( class_exists( 'bbPress' ) ) {

$wp_customize->add_section(
	'conversions_bbpress',
	[
		'title'          => __( 'bbPress', 'conversions' ),
		'description'    => __( 'bbpress options for Conversions theme.', 'conversions' ),
		'capability'     => 'edit_theme_options',
		'priority'       => 100,
	]
);
// Create our settings.
$wp_customize->add_setting(
	'conversions_bbp_account',
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
		'conversions_bbp_account',
		[
			'label'       => __( 'Account icon in navbar', 'conversions' ),
			'description' => __( 'Enable Account icon in the navbar.', 'conversions' ),
			'section'     => 'conversions_bbpress',
			'settings'    => 'conversions_bbp_account',
			'type'        => 'checkbox',
			'priority'    => '20',
		]
	)
);
$wp_customize->add_setting(
	'conversions_bbp_primary_btn',
	[
		'default'           => 'btn-primary',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_bbp_primary_btn',
		[
			'label'       => __( 'Primary button type', 'conversions' ),
			'description' => __( 'Select the primary button type. Applies to: add to cart, apply coupon, update cart, login, register, etc.', 'conversions' ),
			'section'     => 'conversions_bbpress',
			'settings'    => 'conversions_bbp_primary_btn',
			'type'        => 'select',
			'choices'     => $this->button_choices,
			'priority'    => '40',
		]
	)
);
$wp_customize->add_setting(
	'conversions_bbp_secondary_btn',
	[
		'default'           => 'btn-secondary',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_bbp_secondary_btn',
		[
			'label'       => __( 'Secondary button type', 'conversions' ),
			'description' => __( 'Select the secondary button type. Applies to: view cart, proceed to checkout, place order, etc.', 'conversions' ),
			'section'     => 'conversions_bbpress',
			'settings'    => 'conversions_bbp_secondary_btn',
			'type'        => 'select',
			'choices'     => $this->button_choices,
			'priority'    => '45',
		]
	)
);

}