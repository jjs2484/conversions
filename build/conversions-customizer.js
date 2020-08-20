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
		[ '#customize-control-conversions_hcta_btn_text_control, #customize-control-conversions_cta_btn_url_control', '#customize-control-conversions_hcta_btn', 'no'],
		[ '#customize-control-conversions_nav_button_text_control, #customize-control-conversions_nav_button_url_control', '#customize-control-conversions_nav_button', 'no'],
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

!function(t){var e={};function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)n.d(r,o,function(e){return t[e]}.bind(null,o));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=0)}({"//zx":function(t,e){},0:function(t,e,n){n("H0l3"),t.exports=n("//zx")},Asnn:function(t,e){wp.customize.sectionConstructor["wptrt-button"]=wp.customize.Section.extend({attachEvents:function(){},isContextuallyActive:function(){return!0}})},H0l3:function(t,e,n){"use strict";n.r(e);n("Asnn")}});