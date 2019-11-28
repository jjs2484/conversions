/* global jQuery */
function media_upload(button_class) {
    'use strict';
    jQuery('body').on('click', button_class, function () {
        var button_id = '#' + jQuery(this).attr('id');
        var display_field = jQuery(this).parent().children('input:text');
        var _custom_media = true;

        wp.media.editor.send.attachment = function (props, attachment) {

            if (_custom_media) {
                if (typeof display_field !== 'undefined') {
                    switch (props.size) {
                        case 'full':
                            display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
                            break;
                        case 'medium':
                            display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
                            break;
                        case 'thumbnail':
                            display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
                            break;
                        default:
                            display_field.val(attachment.url);
                            display_field.trigger('change');
                    }
                }
                _custom_media = false;
            } else {
                return wp.media.editor.send.attachment(button_id, [props, attachment]);
            }
        };
        wp.media.editor.open(button_class);
        window.send_to_editor = function (html) {

        };
        return false;
    });
}

/********************************************
 *** Generate unique id ***
 *********************************************/
function customizer_repeater_uniqid(prefix, more_entropy) {
    'use strict';
    if (typeof prefix === 'undefined') {
        prefix = '';
    }

    var retId;
    var php_js;
    var formatSeed = function (seed, reqWidth) {
        seed = parseInt(seed, 10)
            .toString(16); // to hex str
        if (reqWidth < seed.length) { // so long we split
            return seed.slice(seed.length - reqWidth);
        }
        if (reqWidth > seed.length) { // so short we pad
            return new Array(1 + (reqWidth - seed.length))
                .join('0') + seed;
        }
        return seed;
    };

    // BEGIN REDUNDANT
    if (!php_js) {
        php_js = {};
    }
    // END REDUNDANT
    if (!php_js.uniqidSeed) { // init seed with big random int
        php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
    }
    php_js.uniqidSeed++;

    retId = prefix; // start with prefix, add current milliseconds hex string
    retId += formatSeed(parseInt(new Date()
        .getTime() / 1000, 10), 8);
    retId += formatSeed(php_js.uniqidSeed, 5); // add seed hex string
    if (more_entropy) {
        // for more entropy we add a float lower to 10
        retId += (Math.random() * 10)
            .toFixed(8)
            .toString();
    }

    return retId;
}


/********************************************
 *** General Repeater Stuff ***
 *********************************************/
function customizer_repeater_refresh_features(th) {
    'use strict';
    var features_repeater_values = [];
    th.find('.customizer-repeater-feature-repeater-container').each(function () {
        var feature = jQuery(this).find('.customizer-repeater-feature-repeater-text').val();
        var id = jQuery(this).find('.customizer-repeater-feature-repeater-id').val();

        if (!id) {
            id = 'customizer-repeater-feature-repeater-' + customizer_repeater_uniqid();
            jQuery(this).find('.customizer-repeater-feature-repeater-id').val(id);
        }

        if (feature !== '') {
            features_repeater_values.push({
                'feature': feature,
                'id': id
            });
        }
    });

    th.find('.feature-repeater-features-repeater-collector').val(JSON.stringify(features_repeater_values));
    customizer_repeater_refresh_general_control_values();
}


function customizer_repeater_refresh_general_control_values() {
    'use strict';
    jQuery('.customizer-repeater-general-control-repeater').each(function () {
        var values = [];
        var th = jQuery(this);
        th.find('.customizer-repeater-general-control-repeater-container').each(function () {

            var icon_value = jQuery(this).find('.icp').val();
            var text = jQuery(this).find('.customizer-repeater-text-control').val();
            var linktext = jQuery(this).find('.customizer-repeater-linktext-control').val();
            var link = jQuery(this).find('.customizer-repeater-link-control').val();
            var color = jQuery(this).find('input.customizer-repeater-color-control').val();
            var image_url = jQuery(this).find('.custom-media-url').val();
            var choice = jQuery(this).find('.customizer-repeater-image-choice').val();
            var title = jQuery(this).find('.customizer-repeater-title-control').val();
            var subtitle = jQuery(this).find('.customizer-repeater-subtitle-control').val();
            var subtitle2 = jQuery(this).find('.customizer-repeater-subtitle2-control').val();
            var id = jQuery(this).find('.social-repeater-box-id').val();
            if (!id) {
                id = 'social-repeater-' + customizer_repeater_uniqid();
                jQuery(this).find('.social-repeater-box-id').val(id);
            }
            var feature_repeater = jQuery(this).find('.feature-repeater-features-repeater-collector').val();

            if (text !== '' || image_url !== '' || title !== '' || subtitle !== '' || subtitle2 !== '' || icon_value !== '' || linktext !== '' || link !== '' || choice !== '' || feature_repeater !== '' || color !== '') {
                values.push({
                    'icon_value': (choice === 'customizer_repeater_none' ? '' : icon_value),
                    'color': color,
                    'text': escapeHtml(text),
                    'linktext': escapeHtml(linktext),
                    'link': link,
                    'image_url': (choice === 'customizer_repeater_none' ? '' : image_url),
                    'choice': choice,
                    'title': escapeHtml(title),
                    'subtitle': escapeHtml(subtitle),
                    'subtitle2': escapeHtml(subtitle2),
                    'feature_repeater': escapeHtml(feature_repeater),
                    'id': id
                });
            }

        });
        th.find('.customizer-repeater-collector').val(JSON.stringify(values));
        th.find('.customizer-repeater-collector').trigger('change');
    });
}


jQuery(document).ready(function () {
    'use strict';
    var theme_controls = jQuery('#customize-theme-controls');
    theme_controls.on('click', '.customizer-repeater-customize-control-title', function () {
        jQuery(this).next().slideToggle('medium', function () {
            if (jQuery(this).is(':visible')){
                jQuery(this).prev().addClass('repeater-expanded');
                jQuery(this).css('display', 'block');
            } else {
                jQuery(this).prev().removeClass('repeater-expanded');
            }
        });
    });

    theme_controls.on('change', '.icp',function(){
        customizer_repeater_refresh_general_control_values();
        return false;
    });

    theme_controls.on('change', '.customizer-repeater-image-choice', function () {
        if (jQuery(this).val() === 'customizer_repeater_image') {
            jQuery(this).parent().parent().find('.social-repeater-general-control-icon').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-image-control').show();
        }
        if (jQuery(this).val() === 'customizer_repeater_icon') {
            jQuery(this).parent().parent().find('.social-repeater-general-control-icon').show();
            jQuery(this).parent().parent().find('.customizer-repeater-image-control').hide();
        }
        if (jQuery(this).val() === 'customizer_repeater_none') {
            jQuery(this).parent().parent().find('.social-repeater-general-control-icon').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-image-control').hide();
        }

        customizer_repeater_refresh_general_control_values();
        return false;
    });
    media_upload('.customizer-repeater-custom-media-button');
    jQuery('.custom-media-url').on('change', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });

    var color_options = {
        change: function(event, ui){
            customizer_repeater_refresh_general_control_values();
        }
    };

    /**
     * This adds a new box to repeater
     *
     */
    theme_controls.on('click', '.customizer-repeater-new-field', function () {
        var th = jQuery(this).parent();
        var id = 'customizer-repeater-' + customizer_repeater_uniqid();
        if (typeof th !== 'undefined') {
            /* Clone the first box*/
            var field = th.find('.customizer-repeater-general-control-repeater-container:first').clone( true, true );

            if (typeof field !== 'undefined') {
                /*Set the default value for choice between image and icon to icon*/
                field.find('.customizer-repeater-image-choice').val('customizer_repeater_icon');

                /*Show icon selector*/
                field.find('.social-repeater-general-control-icon').show();

                /*Hide image selector*/
                if (field.find('.social-repeater-general-control-icon').length > 0) {
                    field.find('.customizer-repeater-image-control').hide();
                }

                /*Show delete box button because it's not the first box*/
                field.find('.social-repeater-general-control-remove-field').show();

                /* Empty control for icon */
                field.find('.input-group-addon').find('.cr__icon').attr('class', 'cr__icon');


                /*Remove all repeater fields except first one*/

                field.find('.customizer-repeater-feature-repeater').find('.customizer-repeater-feature-repeater-container').not(':first').remove();
                field.find('.customizer-repeater-feature-repeater-text').val('');
                field.find('.feature-repeater-features-repeater-collector').val('');

                /*Remove value from icon field*/
                field.find('.icp').val('');

                /*Remove value from text field*/
                field.find('.customizer-repeater-text-control').val('');

                /*Remove value from linktext field*/
                field.find('.customizer-repeater-linktext-control').val('');

                /*Remove value from link field*/
                field.find('.customizer-repeater-link-control').val('');

                /*Set box id*/
                field.find('.social-repeater-box-id').val(id);

                /*Remove value from media field*/
                field.find('.custom-media-url').val('');

                /*Remove value from title field*/
                field.find('.customizer-repeater-title-control').val('');

                /*Remove value from color field*/
                field.find('div.customizer-repeater-color-control .wp-picker-container').replaceWith('<input type="text" class="customizer-repeater-color-control ' + id + '">');
                field.find('input.customizer-repeater-color-control').wpColorPicker(color_options);

                /*Remove value from subtitle field*/
                field.find('.customizer-repeater-subtitle-control').val('');

                /*Remove value from subtitle2 field*/
                field.find('.customizer-repeater-subtitle2-control').val('');

                /*Append new box*/
                th.find('.customizer-repeater-general-control-repeater-container:first').parent().append(field);

                /*Refresh values*/
                customizer_repeater_refresh_general_control_values();
            }

        }
        return false;
    });


    theme_controls.on('click', '.social-repeater-general-control-remove-field', function () {
        if (typeof    jQuery(this).parent() !== 'undefined') {
            jQuery(this).parent().hide(500, function(){
                jQuery(this).parent().remove();
                customizer_repeater_refresh_general_control_values();

            });
        }
        return false;
    });


    theme_controls.on('keyup input paste', '.customizer-repeater-title-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    jQuery('input.customizer-repeater-color-control').wpColorPicker(color_options);

    theme_controls.on('keyup input paste', '.customizer-repeater-subtitle-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_controls.on('keyup input paste', '.customizer-repeater-subtitle2-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_controls.on('keyup input paste', '.customizer-repeater-text-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_controls.on('keyup input paste', '.customizer-repeater-linktext-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_controls.on('keyup input paste', '.customizer-repeater-link-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    /*Drag and drop to change icons order*/

    jQuery('.customizer-repeater-general-control-droppable').sortable({
        axis: 'y',
        update: function () {
            customizer_repeater_refresh_general_control_values();
        }
    });


    /*----------------- Feature Repeater ---------------------*/
    theme_controls.on('click', '.feature-repeater-add-feature-item', function (event) {
        event.preventDefault();
        var th = jQuery(this).parent();
        var id = 'customizer-repeater-feature-repeater-' + customizer_repeater_uniqid();
        if (typeof th !== 'undefined') {
            var field = th.find('.customizer-repeater-feature-repeater-container:first').clone( true, true );
            if (typeof field !== 'undefined') {
                field.find('.feature-repeater-remove-feature-item').show();
                field.find('.customizer-repeater-feature-repeater-text').val('');
                field.find('.customizer-repeater-feature-repeater-id').val(id);
                th.find('.customizer-repeater-feature-repeater-container:first').parent().append(field);
            }
        }
        return false;
    });

    theme_controls.on('click', '.feature-repeater-remove-feature-item', function (event) {
        event.preventDefault();
        var th = jQuery(this).parent();
        var repeater = jQuery(this).parent().parent();
        th.remove();
        customizer_repeater_refresh_features(repeater);
        return false;
    });

    theme_controls.on('keyup', '.customizer-repeater-feature-repeater-text', function (event) {
        event.preventDefault();
        var repeater = jQuery(this).parent().parent();
        customizer_repeater_refresh_features(repeater);
        return false;
    });

});

var entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    '\'': '&#39;',
    '/': '&#x2F;'
};

function escapeHtml(string) {
    'use strict';
    //noinspection JSUnresolvedFunction
    string = String(string).replace(new RegExp('\r?\n', 'g'), '<br />');
    string = String(string).replace(/\\/g, '&#92;');
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });

}
/**
 * Fontawesome iconpicker control for the repeater
 *
 * @package conversions
 */
( function($) {
    'use strict';
    wp.customizerRepeater = {

        init: function() {
            $( '.iconpicker-items>i' ).on(
                    'click', function() {
                        var iconClass = $( this ).attr( 'class' ).toString();
                        var classInput = $( this ).
                                parents( '.iconpicker-popover' ).
                                prev().
                                find( '.icp' );

                        classInput.val( iconClass );
                        classInput.attr( 'value', iconClass );

                        var iconPreview = classInput.next( '.input-group-addon' );
                        var iconElement = '<i class="' + iconClass + '"><\/i>';
                        iconPreview.empty();
                        iconPreview.append( iconElement );

                        classInput.trigger( 'change' );
                        return false;
                    }
            );
        },
        search: function($searchField) {
            var itemsList = $searchField.parent().next().find( '.iconpicker-items' );
            var searchTerm = $searchField.val().toLowerCase();
            if ( searchTerm.length > 0 ) {
                itemsList.children().each(
                        function() {
                            if ( $( this ).
                                            filter(
                                                    '[title*='.concat( searchTerm ).concat( ']' ) ).length >
                                    0 || searchTerm.length < 1 ) {
                                $( this ).show();
                            } else {
                                $( this ).hide();
                            }
                        }
                );
            } else {
                itemsList.children().show();
            }
        },
        iconPickerToggle: function($input) {
            var iconPicker = $input.parent().next();
            iconPicker.addClass( 'iconpicker-visible' );
        }
    };

    $( document ).ready(
            function() {
                wp.customizerRepeater.init();


                $( '.iconpicker-search' ).on(
                        'keyup', function() {
                            wp.customizerRepeater.search( $( this ) );
                        }
                );

                $( '.icp-auto' ).on(
                        'click', function() {
                            wp.customizerRepeater.iconPickerToggle( $( this ) );
                        }
                );

                $( document ).mouseup(
                        function(e) {
                            var container = $( '.iconpicker-popover' );

                            if ( !container.is( e.target ) &&
                                    container.has( e.target ).length === 0 ) {
                                container.removeClass( 'iconpicker-visible' );
                            }
                        }
                );

            }
    );

} )( jQuery );
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
        [ "#customize-control-conversions_pricing_sm_control, #customize-control-conversions_pricing_md_control, #customize-control-conversions_pricing_lg_control", "#customize-control-conversions_pricing_respond", "auto"],
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
