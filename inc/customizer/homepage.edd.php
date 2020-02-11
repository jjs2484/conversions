<?php
/**
 * Homepage Easy Digital Downloads customizer section
 *
 * @package conversions
 */

if ( class_exists( 'Easy_Digital_Downloads' ) ) {

	$wp_customize->add_section(
		'conversions_homepage_edd',
		[
			'title'      => __( 'Easy Digital Downloads', 'conversions' ),
			'capability' => 'edit_theme_options',
			'panel'      => 'conversions_homepage',
			'priority'   => 32,
		]
	);
	$wp_customize->add_setting(
		'conversions_edd_bg_color',
		[
			'default'           => '',
			'type'              => 'theme_mod',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);
	$wp_customize->add_control(
		'conversions_edd_bg_color_control',
		[
			'label'       => __( 'Background color', 'conversions' ),
			'description' => __( 'Easy Digital Downloads section background color.', 'conversions' ),
			'section'     => 'conversions_homepage_edd',
			'settings'    => 'conversions_edd_bg_color',
			'priority'    => 10,
			'type'        => 'color',
		]
	);
	$wp_customize->add_setting(
		'conversions_edd_title',
		[
			'default'           => '',
			'type'              => 'theme_mod',
			'transport'         => 'refresh',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		]
	);
	$wp_customize->add_control(
		'conversions_edd_title_control',
		[
			'label'       => __( 'Title', 'conversions' ),
			'description' => __( 'Add your title.', 'conversions' ),
			'section'     => 'conversions_homepage_edd',
			'settings'    => 'conversions_edd_title',
			'priority'    => 20,
			'type'        => 'text',
		]
	);
	$wp_customize->add_setting(
		'conversions_edd_title_color',
		[
			'default'           => '',
			'type'              => 'theme_mod',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);
	$wp_customize->add_control(
		'conversions_edd_title_color_control',
		[
			'label'       => __( 'Title color', 'conversions' ),
			'description' => __( 'Select a color for the title.', 'conversions' ),
			'section'     => 'conversions_homepage_edd',
			'settings'    => 'conversions_edd_title_color',
			'priority'    => 30,
			'type'        => 'color',
		]
	);
	$wp_customize->add_setting(
		'conversions_edd_desc',
		[
			'default'           => '',
			'type'              => 'theme_mod',
			'transport'         => 'refresh',
			'sanitize_callback' => 'wp_kses_post',
		]
	);
	$wp_customize->add_control(
		'conversions_edd_desc',
		[
			'label'       => __( 'Description', 'conversions' ),
			'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
			'section'     => 'conversions_homepage_edd',
			'settings'    => 'conversions_edd_desc',
			'priority'    => 40,
			'type'        => 'textarea',
			'capability'  => 'edit_theme_options',
		]
	);
	$wp_customize->add_setting(
		'conversions_edd_desc_color',
		[
			'default'           => '',
			'type'              => 'theme_mod',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);
	$wp_customize->add_control(
		'conversions_edd_desc_color_control',
		[
			'label'       => __( 'Description color', 'conversions' ),
			'description' => __( 'Select a color for the description text.', 'conversions' ),
			'section'     => 'conversions_homepage_edd',
			'settings'    => 'conversions_edd_desc_color',
			'priority'    => 50,
			'type'        => 'color',
		]
	);
	$wp_customize->add_setting(
		'conversions_edd_products',
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
			'conversions_edd_products',
			[
				'label'       => __( 'Product type', 'conversions' ),
				'description' => __( 'Select the type of products to show.', 'conversions' ),
				'section'     => 'conversions_homepage_edd',
				'settings'    => 'conversions_edd_products',
				'type'        => 'select',
				'choices'     => [
					'no'       => __( 'None', 'conversions' ),
					'all'      => __( 'All', 'conversions' ),
					'category' => __( 'Category', 'conversions' ),
					'tags'     => __( 'Tags', 'conversions' ),
				],
				'priority'    => '60',
			]
		)
	);
	$wp_customize->add_setting(
		'conversions_edd_product_tax',
		[
			'default'           => '',
			'type'              => 'theme_mod',
			'transport'         => 'refresh',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		]
	);
	$wp_customize->add_control(
		'conversions_edd_product_tax_control',
		[
			'label'       => __( 'Category or tags IDs', 'conversions' ),
			'description' => __( 'Both the category and tags parameters accept a comma separated list IDs.', 'conversions' ),
			'section'     => 'conversions_homepage_edd',
			'settings'    => 'conversions_edd_product_tax',
			'priority'    => 61,
			'type'        => 'text',
		]
	);
	$wp_customize->add_setting(
		'conversions_edd_product_limit',
		[
			'default'           => '6',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		]
	);
	$wp_customize->add_control(
		'conversions_edd_product_limit',
		[
			'label'       => __( 'Products limit', 'conversions' ),
			'description' => __( 'The number of products to display. Choose 1-12.', 'conversions' ),
			'section'     => 'conversions_homepage_edd',
			'settings'    => 'conversions_edd_product_limit',
			'priority'    => 70,
			'type'        => 'number',
			'input_attrs' => [
				'min' => 1,
				'max' => 12,
			],
		]
	);
	$wp_customize->add_setting(
		'conversions_edd_product_columns',
		[
			'default'           => '3',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		]
	);
	$wp_customize->add_control(
		'conversions_edd_product_columns',
		[
			'label'       => __( 'Product columns', 'conversions' ),
			'description' => __( 'The number of columns to display. Choose 1-4.', 'conversions' ),
			'section'     => 'conversions_homepage_edd',
			'settings'    => 'conversions_edd_product_columns',
			'priority'    => 80,
			'type'        => 'number',
			'input_attrs' => [
				'min' => 1,
				'max' => 4,
			],
		]
	);
	$wp_customize->add_setting(
		'conversions_edd_products_orderby',
		[
			'default'           => 'post_date',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'conversions_sanitize_select',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
		]
	);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'conversions_edd_products_orderby',
			[
				'label'       => __( 'Products orderby', 'conversions' ),
				'description' => __( 'Sorts the products displayed by the entered category.', 'conversions' ),
				'section'     => 'conversions_homepage_edd',
				'settings'    => 'conversions_edd_products_orderby',
				'type'        => 'select',
				'choices'     => [
					'post_date' => __( 'Date', 'conversions' ),
					'price'     => __( 'Price', 'conversions' ),
					'random'    => __( 'Random', 'conversions' ),
					'title'     => __( 'Title', 'conversions' ),
				],
				'priority'    => '90',
			]
		)
	);
	$wp_customize->add_setting(
		'conversions_edd_products_order',
		[
			'default'           => 'DESC',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'conversions_sanitize_select',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
		]
	);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'conversions_edd_products_order',
			[
				'label'       => __( 'Products order', 'conversions' ),
				'description' => __( 'Select ascending (small to large) or Descending (large to small) order.', 'conversions' ),
				'section'     => 'conversions_homepage_edd',
				'settings'    => 'conversions_edd_products_order',
				'type'        => 'select',
				'choices'     => [
					'ASC'  => __( 'Ascending', 'conversions' ),
					'DESC' => __( 'Descending', 'conversions' ),
				],
				'priority'    => '100',
			]
		)
	);
}
