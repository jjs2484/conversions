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