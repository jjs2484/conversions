<?php
/**
 * Blog customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_blog',
	[
		'title'      => __( 'Blog', 'conversions' ),
		'priority'   => 46,
		'capability' => 'edit_theme_options',
	]
);
// Create our settings.
$wp_customize->add_setting(
	'conversions_blog_sticky_posts',
	[
		'default'           => 'primary',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_blog_sticky_posts',
		[
			'label'       => __( 'Sticky post highlight color', 'conversions' ),
			'description' => __( 'Select the highlight color for sticky posts.', 'conversions' ),
			'section'     => 'conversions_blog',
			'settings'    => 'conversions_blog_sticky_posts',
			'type'        => 'select',
			'choices'     => [
				'no'        => __( 'None', 'conversions' ),
				'primary'   => __( 'Primary', 'conversions' ),
				'secondary' => __( 'Secondary', 'conversions' ),
				'success'   => __( 'Success', 'conversions' ),
				'danger'    => __( 'Danger', 'conversions' ),
				'warning'   => __( 'Warning', 'conversions' ),
				'info'      => __( 'Info', 'conversions' ),
			],
			'priority'    => '1',
		]
	)
);
$wp_customize->add_setting(
	'conversions_blog_more_btn',
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
		'conversions_blog_more_btn',
		[
			'label'       => __( 'Read more button type', 'conversions' ),
			'description' => __( 'Choose the read more button type shown on the blog index.', 'conversions' ),
			'section'     => 'conversions_blog',
			'settings'    => 'conversions_blog_more_btn',
			'type'        => 'select',
			'choices'     => $this->button_choices,
			'priority'    => '2',
		]
	)
);
$wp_customize->add_setting(
	'conversions_comment_btn',
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
		'conversions_comment_btn',
		[
			'label'       => __( 'Comment button type', 'conversions' ),
			'description' => __( 'Choose the comment button type.', 'conversions' ),
			'section'     => 'conversions_blog',
			'settings'    => 'conversions_comment_btn',
			'type'        => 'select',
			'choices'     => $this->button_choices,
			'priority'    => '3',
		]
	)
);
$wp_customize->add_setting(
	'conversions_blog_related',
	[
		'default'           => true,
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_sanitize_checkbox',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_blog_related',
		[
			'label'       => __( 'Show related posts', 'conversions' ),
			'description' => __( 'Enable related posts on single posts.', 'conversions' ),
			'section'     => 'conversions_blog',
			'settings'    => 'conversions_blog_related',
			'type'        => 'checkbox',
			'priority'    => '5',
		]
	)
);
$wp_customize->add_setting(
	'conversions_blog_taxonomy',
	[
		'default'           => 'categories',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_sanitize_select',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_blog_taxonomy',
		[
			'label'       => __( 'Related posts taxonomy', 'conversions' ),
			'description' => __( 'Use categories or tags to find related posts?', 'conversions' ),
			'section'     => 'conversions_blog',
			'settings'    => 'conversions_blog_taxonomy',
			'type'        => 'select',
			'choices'     => [
				'tags'       => __( 'Tags', 'conversions' ),
				'categories' => __( 'Categories', 'conversions' ),
			],
			'priority'    => '6',
		]
	)
);
$wp_customize->add_setting(
	'conversions_blog_postnav',
	[
		'default'           => true,
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_sanitize_checkbox',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_blog_postnav',
		[
			'label'       => __( 'Show post navigation', 'conversions' ),
			'description' => __( 'Enable post navigation on single posts.', 'conversions' ),
			'section'     => 'conversions_blog',
			'settings'    => 'conversions_blog_postnav',
			'type'        => 'checkbox',
			'priority'    => '7',
		]
	)
);
