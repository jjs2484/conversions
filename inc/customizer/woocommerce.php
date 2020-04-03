<?php
/**
 * WooCommerce customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_woocommerce',
	[
		'title'          => __( 'Conversions', 'conversions' ),
		'description'    => __( 'WooCommerce options for Conversions theme.', 'conversions' ),
		'capability'     => 'edit_theme_options',
		'panel'          => 'woocommerce',
		'priority'       => 100,
		'theme_supports' => [ 'woocommerce' ],
	]
);
// Create our settings.
$wp_customize->add_setting(
	'conversions_wc_cart_nav',
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
		'conversions_wc_cart_nav',
		[
			'label'       => __( 'Cart icon in navbar', 'conversions' ),
			'description' => __( 'Enable cart icon in the navbar.', 'conversions' ),
			'section'     => 'conversions_woocommerce',
			'settings'    => 'conversions_wc_cart_nav',
			'type'        => 'checkbox',
			'priority'    => '10',
		]
	)
);
$wp_customize->add_setting(
	'conversions_wc_account',
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
		'conversions_wc_account',
		[
			'label'       => __( 'Account icon in navbar', 'conversions' ),
			'description' => __( 'Enable Account icon in the navbar.', 'conversions' ),
			'section'     => 'conversions_woocommerce',
			'settings'    => 'conversions_wc_account',
			'type'        => 'checkbox',
			'priority'    => '20',
		]
	)
);
$wp_customize->add_setting(
	'conversions_wc_checkout_columns',
	[
		'default'           => 'two-column',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_wc_checkout_columns',
		[
			'label'       => __( 'Checkout columns', 'conversions' ),
			'description' => __( 'How many columns should the checkout be?', 'conversions' ),
			'section'     => 'conversions_woocommerce',
			'settings'    => 'conversions_wc_checkout_columns',
			'type'        => 'select',
			'choices'     => [
				'two-column' => __( 'Two column', 'conversions' ),
				'one-column' => __( 'One column', 'conversions' ),
			],
			'priority'    => '30',
		]
	)
);
$wp_customize->add_setting(
	'conversions_wc_primary_btn',
	[
		'default'           => 'btn-outline-primary',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_wc_primary_btn',
		[
			'label'       => __( 'Primary button type', 'conversions' ),
			'description' => __( 'Select the primary button type. Applies to: add to cart, apply coupon, update cart, login, register, etc.', 'conversions' ),
			'section'     => 'conversions_woocommerce',
			'settings'    => 'conversions_wc_primary_btn',
			'type'        => 'select',
			'choices'     => $this->button_choices,
			'priority'    => '40',
		]
	)
);
$wp_customize->add_setting(
	'conversions_wc_secondary_btn',
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
		'conversions_wc_secondary_btn',
		[
			'label'       => __( 'Secondary button type', 'conversions' ),
			'description' => __( 'Select the secondary button type. Applies to: view cart, proceed to checkout, place order, etc.', 'conversions' ),
			'section'     => 'conversions_woocommerce',
			'settings'    => 'conversions_wc_secondary_btn',
			'type'        => 'select',
			'choices'     => $this->button_choices,
			'priority'    => '45',
		]
	)
);
