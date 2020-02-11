<?php
/**
 * Homepage WooCommerce customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_homepage_woo',
	[
		'title'          => __( 'WooCommerce', 'conversions' ),
		'capability'     => 'edit_theme_options',
		'panel'          => 'conversions_homepage',
		'priority'       => 31,
		'theme_supports' => [ 'woocommerce' ],
	]
);
$wp_customize->add_setting(
	'conversions_woo_bg_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_woo_bg_color_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'WooCommerce section background color.', 'conversions' ),
		'section'     => 'conversions_homepage_woo',
		'settings'    => 'conversions_woo_bg_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_woo_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	]
);
$wp_customize->add_control(
	'conversions_woo_title_control',
	[
		'label'       => __( 'Title', 'conversions' ),
		'description' => __( 'Add your title.', 'conversions' ),
		'section'     => 'conversions_homepage_woo',
		'settings'    => 'conversions_woo_title',
		'priority'    => 20,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_woo_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_woo_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title.', 'conversions' ),
		'section'     => 'conversions_homepage_woo',
		'settings'    => 'conversions_woo_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_woo_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_woo_desc',
	[
		'label'       => __( 'Description', 'conversions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_woo',
		'settings'    => 'conversions_woo_desc',
		'priority'    => 40,
		'type'        => 'textarea',
		'capability'  => 'edit_theme_options',
	]
);
$wp_customize->add_setting(
	'conversions_woo_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_woo_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions' ),
		'description' => __( 'Select a color for the description text.', 'conversions' ),
		'section'     => 'conversions_homepage_woo',
		'settings'    => 'conversions_woo_desc_color',
		'priority'    => 50,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_woo_products',
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
		'conversions_woo_products',
		[
			'label'       => __( 'Product type', 'conversions' ),
			'description' => __( 'Select the type of WooCommerce products to show.', 'conversions' ),
			'section'     => 'conversions_homepage_woo',
			'settings'    => 'conversions_woo_products',
			'type'        => 'select',
			'choices'     => [
				'no'      => __( 'None', 'conversions' ),
				'all'     => __( 'All', 'conversions' ),
				'on_sale' => __( 'On sale', 'conversions' ),
			],
			'priority'    => '60',
		]
	)
);
$wp_customize->add_setting(
	'conversions_woo_product_limit',
	[
		'default'           => '8',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_woo_product_limit',
	[
		'label'       => __( 'Products limit', 'conversions' ),
		'description' => __( 'The number of products to display. Choose 1-12.', 'conversions' ),
		'section'     => 'conversions_homepage_woo',
		'settings'    => 'conversions_woo_product_limit',
		'priority'    => 70,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 12,
		],
	]
);
$wp_customize->add_setting(
	'conversions_woo_product_columns',
	[
		'default'           => '4',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_woo_product_columns',
	[
		'label'       => __( 'Product columns', 'conversions' ),
		'description' => __( 'The number of columns to display. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_woo',
		'settings'    => 'conversions_woo_product_columns',
		'priority'    => 80,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_woo_products_order',
	[
		'default'           => 'popularity',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_woo_products_order',
		[
			'label'       => __( 'Products orderby', 'conversions' ),
			'description' => __( 'Sorts the products displayed by the entered option.', 'conversions' ),
			'section'     => 'conversions_homepage_woo',
			'settings'    => 'conversions_woo_products_order',
			'type'        => 'select',
			'choices'     => [
				'date'       => __( 'Date', 'conversions' ),
				'popularity' => __( 'Popularity', 'conversions' ),
				'rand'       => __( 'Random', 'conversions' ),
				'rating'     => __( 'Rating', 'conversions' ),
				'title'      => __( 'title', 'conversions' ),
			],
			'priority'    => '90',
		]
	)
);
