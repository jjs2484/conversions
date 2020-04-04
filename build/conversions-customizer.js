/**
 * Customizer conditionals
 */

/*
 * CTA background options 
 */
jQuery(document).ready(function($) {

	// Background option selectors.
	var $ctaBgGradient = $( '#customize-control-conversions_hcta_bg_gradient' );
	var $ctaBgBootstrap = $( '#customize-control-conversions_hcta_bg_bootstrap' );
	var $ctaBgCustom = $( '#customize-control-conversions_hcta_bg_color_control' );
	var $ctaBgChoice = $( '#customize-control-conversions_hcta_bg_choice select' );

	// On page load hide or show options.
	if ( $( $ctaBgChoice ).val() == 'gradient' ){
		$( $ctaBgGradient ).show();
		$( $ctaBgBootstrap ).hide();
		$( $ctaBgCustom ).hide();
	}
	else if ( $( $ctaBgChoice ).val() == 'bootstrap' ){
		$( $ctaBgGradient ).hide();
		$( $ctaBgBootstrap ).show();
		$( $ctaBgCustom ).hide();
	}
	else if ( $( $ctaBgChoice ).val() == 'custom' ){
		$( $ctaBgGradient ).hide();
		$( $ctaBgBootstrap ).hide();
		$( $ctaBgCustom ).show();
	}

	/* on change hide or show options */
	$( $ctaBgChoice ).change(function(){
		if ( $(this).val() == 'gradient' ) {
			$( $ctaBgGradient ).show();
			$( $ctaBgBootstrap ).hide();
			$( $ctaBgCustom ).hide();
		} 
		else if ( $(this).val() == 'bootstrap' ) {
			$( $ctaBgGradient ).hide();
			$( $ctaBgBootstrap ).show();
			$( $ctaBgCustom ).hide();
		}
		else if ( $(this).val() == 'custom' ) {
			$( $ctaBgGradient ).hide();
			$( $ctaBgBootstrap ).hide();
			$( $ctaBgCustom ).show();
		}
	});
});

/* 
 * Buttons and other options
 */
jQuery(document).ready(function($) {

	var conditionalOptions = [
		[ '#customize-control-conversions_hh_button_text_control, #customize-control-conversions_hh_button_url_control', '#customize-control-conversions_hh_button', 'no'],
		[ '#customize-control-conversions_hh_vbtn_text_control, #customize-control-conversions_hh_vbtn_url_control', '#customize-control-conversions_hh_vbtn', 'no'],
		[ '#customize-control-conversions_hcta_btn_text_control, #customize-control-conversions_cta_btn_url_control', '#customize-control-conversions_hcta_btn', 'no'],
		[ '#customize-control-conversions_nav_button_text_control, #customize-control-conversions_nav_button_url_control', '#customize-control-conversions_nav_button', 'no'],
		[ '#customize-control-conversions_hc_sm_control, #customize-control-conversions_hc_md_control, #customize-control-conversions_hc_lg_control', '#customize-control-conversions_hc_respond', 'auto'],
		[ '#customize-control-conversions_pricing_sm_control, #customize-control-conversions_pricing_md_control, #customize-control-conversions_pricing_lg_control', '#customize-control-conversions_pricing_respond', 'auto'],
	];
	
	conditionalOptions.forEach( function( conditionalOptionsArray ) {
		var $conditionalSelectors = conditionalOptionsArray[ 0 ];
		var $mainOption = ( conditionalOptionsArray[ 1 ] + ' select' );
		var $selectOption = conditionalOptionsArray[ 2 ];

		// On page load hide or show options.
		if( $( $mainOption ).val() == $selectOption ){
			$( $conditionalSelectors ).hide();
		}
		else {
			$( $conditionalSelectors ).show();
		}

		// On change hide or show options.
		$( $mainOption ).change(function() {
			if( $(this).val() == $selectOption ) {
				$( $conditionalSelectors ).hide();
			} else {
				$( $conditionalSelectors ).show();
			}
		});
	});
});

/*
 * EDD product options
 */
jQuery(document).ready(function($) {

	// Option selectors.
	var $eddProductTypeTax = $( '#customize-control-conversions_edd_product_tax_control' );
	var $eddProductTypeChoice = $( '#customize-control-conversions_edd_products select' );

	// On page load hide or show options.
	if( $( $eddProductTypeChoice ).val() == 'no' || $( $eddProductTypeChoice ).val() == 'all' ) {
		$( $eddProductTypeTax ).hide();
	}

	// On change hide or show options.
	$( $eddProductTypeChoice ).change(function() {
		if ( $(this).val() == 'category' || $(this).val() == 'tags' ) {
			$( $eddProductTypeTax ).show();
		} 
		else if ( $(this).val() == 'no' || $(this).val() == 'all' ) {
			$( $eddProductTypeTax ).hide();
		}
	});
});
