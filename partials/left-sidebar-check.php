<?php
/**
 * Left sidebar check
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$conversions_sidebar_pos = get_theme_mod( 'conversions_sidebar_position', 'right' );
if ( get_theme_mod( 'conversions_content_cards', false ) === true ) {
	$conversions_sidebar_padding = '4';
} else {
	$conversions_sidebar_padding = '5';
}

if ( 'left' === $conversions_sidebar_pos ) :
	get_template_part( 'partials/sidebar', 'left' );
endif;

// primary content area columns based on selected and active sidebars.
// if left sidebar is selected.
if ( 'left' === $conversions_sidebar_pos ) {
	if ( is_active_sidebar( 'sidebar-2' ) ) {
		echo sprintf(
			'<div class="col-lg-9 ps-lg-%s content-area" id="primary">',
			esc_attr( $conversions_sidebar_padding )
		);
	} else {
		echo '<div class="col-md-12 content-area" id="primary">';
	}
} elseif ( 'right' === $conversions_sidebar_pos ) { // if right sidebar is selected.
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		echo sprintf(
			'<div class="col-lg-9 pe-lg-%s content-area" id="primary">',
			esc_attr( $conversions_sidebar_padding )
		);
	} else {
		echo '<div class="col-md-12 content-area" id="primary">';
	}
} elseif ( 'none' === $conversions_sidebar_pos ) { // if no sidebar is selected.
	echo '<div class="col-md-12 content-area" id="primary">';
}
