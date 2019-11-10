/**
 * Customizer conditionals
 */

/* Navbar button options */
jQuery(document).ready(function ($) {

    /* button option selectors */
    var navbar_btn_options = $( '#customize-control-conversions_nav_button_text_control, #customize-control-conversions_nav_button_url_control' );

    /* on page load hide or show options */
    if( $( '#customize-control-conversions_nav_button select' ).val() == 'no' ){
        navbar_btn_options.hide();
    }
    else {
        navbar_btn_options.show();
    }

    /* on change hide or show options */
    $( '#customize-control-conversions_nav_button select' ).change(function(){
        if($(this).val() == 'no') {
            navbar_btn_options.hide();
        } else {
            navbar_btn_options.show();
        }
    });
});

/* CTA background options */
jQuery(document).ready(function ($) {

    /* background option selectors */
    var cta_bg_gradient = $( '#customize-control-conversions_hcta_bg_gradient' );
    var cta_bg_bootstrap = $( '#customize-control-conversions_hcta_bg_bootstrap' );
    var cta_bg_custom = $( '#customize-control-conversions_hcta_bg_color_control' );

    /* on page load hide or show options */
    if( $( '#customize-control-conversions_hcta_bg_choice select' ).val() == 'gradient' ){
        cta_bg_gradient.show();
        cta_bg_bootstrap.hide();
        cta_bg_custom.hide();
    }
    else if ( $( '#customize-control-conversions_hcta_bg_choice select' ).val() == 'bootstrap' ){
        cta_bg_gradient.hide();
        cta_bg_bootstrap.show();
        cta_bg_custom.hide();
    }
    else if ( $( '#customize-control-conversions_hcta_bg_choice select' ).val() == 'custom' ){
        cta_bg_gradient.hide();
        cta_bg_bootstrap.hide();
        cta_bg_custom.show();
    }

    /* on change hide or show options */
    $( '#customize-control-conversions_hcta_bg_choice select' ).change(function(){
        if($(this).val() == 'gradient') {
            cta_bg_gradient.show();
            cta_bg_bootstrap.hide();
            cta_bg_custom.hide();
        } 
        else if ($(this).val() == 'bootstrap') {
            cta_bg_gradient.hide();
            cta_bg_bootstrap.show();
            cta_bg_custom.hide();
        }
        else if ($(this).val() == 'custom') {
            cta_bg_gradient.hide();
            cta_bg_bootstrap.hide();
            cta_bg_custom.show();
        }
    });
});

/* CTA button options */
jQuery(document).ready(function ($) {

    /* button option selectors */
    var cta_btn_options = $( '#customize-control-conversions_hcta_btn_text_control, #customize-control-conversions_cta_btn_url_control' );

    /* on page load hide or show options */
    if( $( '#customize-control-conversions_hcta_btn select' ).val() == 'no' ){
        cta_btn_options.hide();
    }
    else {
        cta_btn_options.show();
    }

    /* on change hide or show options */
    $( '#customize-control-conversions_hcta_btn select' ).change(function(){
        if($(this).val() == 'no') {
            cta_btn_options.hide();
        } else {
            cta_btn_options.show();
        }
    });
});

/* Clients section responsive breakpoints */
jQuery(document).ready(function ($) {

    /* responsive breakpoint items selectors */
    var manual_sizes = $( '#customize-control-conversions_hc_sm_control, #customize-control-conversions_hc_md_control, #customize-control-conversions_hc_lg_control' );

    /* on page load hide or show options */
    if( $( '#customize-control-conversions_hc_respond select' ).val() == 'auto' ){
        manual_sizes.hide();
    }
    else {
        manual_sizes.show();
    }

    /* on change hide or show options */
    $( '#customize-control-conversions_hc_respond select' ).change(function(){
        if($(this).val() == 'auto') {
            manual_sizes.hide();
        } else {
            manual_sizes.show();
        }
    });
});