/**
 * Customizer conditionals
 */
jQuery(document).ready(function ($) {

    /* Clients section responsive breakpoint items */
    var manual_sizes = $( '#customize-control-conversions_hc_sm_control, #customize-control-conversions_hc_md_control, #customize-control-conversions_hc_lg_control' );

    /* on page load, hide or show options */
    if( $( '#customize-control-conversions_hc_respond select' ).val() == 'auto' ){
        manual_sizes.hide();
    }
    else {
        manual_sizes.show();
    }

    /* on change, hide or show options */
    $( '#customize-control-conversions_hc_respond select' ).change(function(){
        if($(this).val() == 'auto') {
            manual_sizes.hide();
        } else {
            manual_sizes.show();
        }
    });
});