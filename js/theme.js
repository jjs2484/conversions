/**
 * If fixed header calculate the height add margin to content below 
 */
jQuery(document).ready(function () {
    jQuery('#page-wrapper').css('marginTop', $('#wrapper-navbar.fixed-top').outerHeight(true) );
}); 