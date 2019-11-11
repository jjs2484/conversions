/**
 * Customizer conditionals
 */

/* CTA background options */
jQuery(document).ready(function ($) {

    /* background option selectors */
    var $cta_bg_gradient = $( '#customize-control-conversions_hcta_bg_gradient' );
    var $cta_bg_bootstrap = $( '#customize-control-conversions_hcta_bg_bootstrap' );
    var $cta_bg_custom = $( '#customize-control-conversions_hcta_bg_color_control' );
    var $cta_bg_choice = $( '#customize-control-conversions_hcta_bg_choice select' );

    /* on page load hide or show options */
    if( $( $cta_bg_choice ).val() == 'gradient' ){
        $($cta_bg_gradient).show();
        $($cta_bg_bootstrap).hide();
        $($cta_bg_custom).hide();
    }
    else if ( $( $cta_bg_choice ).val() == 'bootstrap' ){
        $($cta_bg_gradient).hide();
        $($cta_bg_bootstrap).show();
        $($cta_bg_custom).hide();
    }
    else if ( $( $cta_bg_choice ).val() == 'custom' ){
        $($cta_bg_gradient).hide();
        $($cta_bg_bootstrap).hide();
        $($cta_bg_custom).show();
    }

    /* on change hide or show options */
    $( $cta_bg_choice ).change(function(){
        if($(this).val() == 'gradient') {
            $($cta_bg_gradient).show();
            $($cta_bg_bootstrap).hide();
            $($cta_bg_custom).hide();
        } 
        else if ($(this).val() == 'bootstrap') {
            $($cta_bg_gradient).hide();
            $($cta_bg_bootstrap).show();
            $($cta_bg_custom).hide();
        }
        else if ($(this).val() == 'custom') {
            $($cta_bg_gradient).hide();
            $($cta_bg_bootstrap).hide();
            $($cta_bg_custom).show();
        }
    });
});

/* Buttons and other options */
jQuery(document).ready(function ($) {

    var conditional_option_selectors = [
        [ "#customize-control-conversions_hh_button_text_control, #customize-control-conversions_hh_button_url_control", "#customize-control-conversions_hh_button", "no"],
        [ "#customize-control-conversions_hh_vbtn_text_control, #customize-control-conversions_hh_vbtn_url_control", "#customize-control-conversions_hh_vbtn", "no"],
        [ "#customize-control-conversions_hcta_btn_text_control, #customize-control-conversions_cta_btn_url_control", "#customize-control-conversions_hcta_btn", "no"],
        [ "#customize-control-conversions_nav_button_text_control, #customize-control-conversions_nav_button_url_control", "#customize-control-conversions_nav_button", "no"],
        [ "#customize-control-conversions_hc_sm_control, #customize-control-conversions_hc_md_control, #customize-control-conversions_hc_lg_control", "#customize-control-conversions_hc_respond", "auto"],
    ];
    
    conditional_option_selectors.forEach( function( conditional_selectors_array )
    {
        var $conditional_selectors = conditional_selectors_array[ 0 ];
        var $main_option = ( conditional_selectors_array[ 1 ] + ' select' );
        var $select_option = conditional_selectors_array[ 2 ];

        /* on page load hide or show options */
        if( $($main_option).val() == $select_option ){
            $($conditional_selectors).hide();
        }
        else {
            $($conditional_selectors).show();
        }

        /* on change hide or show options */
        $($main_option).change(function(){
            if( $(this).val() == $select_option ) {
                $($conditional_selectors).hide();
            } else {
                $($conditional_selectors).show();
            }
        });

    });
    
});
