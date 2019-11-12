/**
 * Customizer conditionals
 */

/* CTA background options */
jQuery(document).ready(function ($) {

    /* background option selectors */
    var $ctaBgGradient = $( '#customize-control-conversions_hcta_bg_gradient' );
    var $ctaBgBootstrap = $( '#customize-control-conversions_hcta_bg_bootstrap' );
    var $ctaBgCustom = $( '#customize-control-conversions_hcta_bg_color_control' );
    var $ctaBgChoice = $( '#customize-control-conversions_hcta_bg_choice select' );

    /* on page load hide or show options */
    if( $( $ctaBgChoice ).val() == 'gradient' ){
        $($ctaBgGradient).show();
        $($ctaBgBootstrap).hide();
        $($ctaBgCustom).hide();
    }
    else if ( $( $ctaBgChoice ).val() == 'bootstrap' ){
        $($ctaBgGradient).hide();
        $($ctaBgBootstrap).show();
        $($ctaBgCustom).hide();
    }
    else if ( $( $ctaBgChoice ).val() == 'custom' ){
        $($ctaBgGradient).hide();
        $($ctaBgBootstrap).hide();
        $($ctaBgCustom).show();
    }

    /* on change hide or show options */
    $( $ctaBgChoice ).change(function(){
        if($(this).val() == 'gradient') {
            $($ctaBgGradient).show();
            $($ctaBgBootstrap).hide();
            $($ctaBgCustom).hide();
        } 
        else if ($(this).val() == 'bootstrap') {
            $($ctaBgGradient).hide();
            $($ctaBgBootstrap).show();
            $($ctaBgCustom).hide();
        }
        else if ($(this).val() == 'custom') {
            $($ctaBgGradient).hide();
            $($ctaBgBootstrap).hide();
            $($ctaBgCustom).show();
        }
    });
});

/* Buttons and other options */
jQuery(document).ready(function ($) {

    var conditionalOptions = [
        [ "#customize-control-conversions_hh_button_text_control, #customize-control-conversions_hh_button_url_control", "#customize-control-conversions_hh_button", "no"],
        [ "#customize-control-conversions_hh_vbtn_text_control, #customize-control-conversions_hh_vbtn_url_control", "#customize-control-conversions_hh_vbtn", "no"],
        [ "#customize-control-conversions_hcta_btn_text_control, #customize-control-conversions_cta_btn_url_control", "#customize-control-conversions_hcta_btn", "no"],
        [ "#customize-control-conversions_nav_button_text_control, #customize-control-conversions_nav_button_url_control", "#customize-control-conversions_nav_button", "no"],
        [ "#customize-control-conversions_hc_sm_control, #customize-control-conversions_hc_md_control, #customize-control-conversions_hc_lg_control", "#customize-control-conversions_hc_respond", "auto"],
    ];
    
    conditionalOptions.forEach( function( conditionalOptionsArray )
    {
        var $conditionalSelectors = conditionalOptionsArray[ 0 ];
        var $mainOption = ( conditionalOptionsArray[ 1 ] + ' select' );
        var $selectOption = conditionalOptionsArray[ 2 ];

        /* on page load hide or show options */
        if( $($mainOption).val() == $selectOption ){
            $($conditionalSelectors).hide();
        }
        else {
            $($conditionalSelectors).show();
        }

        /* on change hide or show options */
        $($mainOption).change(function(){
            if( $(this).val() == $selectOption ) {
                $($conditionalSelectors).hide();
            } else {
                $($conditionalSelectors).show();
            }
        });

    });
    
});
