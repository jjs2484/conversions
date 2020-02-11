<?php
/**
 * Homepage customizer section
 *
 * @package conversions
 */

$wp_customize->add_panel(
	'conversions_homepage',
	[
		'priority'    => 119,
		'title'       => __( 'Homepage Design', 'conversions' ),
		'description' => __( 'Settings for the Homepage template', 'conversions' ),
		'capability'  => 'edit_theme_options',
	]
);
