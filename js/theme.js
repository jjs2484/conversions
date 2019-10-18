/**
 * If fixed header calculate the height add margin to content below 
*/
(function($) {

    var resizeTimer; // Set resizeTimer to empty so it resets on page load

    function resizeFunction() {
        // Are we using a fixed header?
        var fixedHeader = document.getElementById("wrapper-navbar").classList;
        if (fixedHeader.contains("header-p-n")) {
            return;
        }
        else if (fixedHeader.contains("fixed-top")) {
    
            // get height of header and adminbar
            var fixedHeight = jQuery('#wrapper-navbar.fixed-top').innerHeight();
            var AdjustedfixedHeight = fixedHeight - 1;
    
            // apply height to page as margin-top
            jQuery('#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper, #homepage-wrapper, #search-wrapper, #index-wrapper, #error-404-wrapper, #archive-wrapper, #author-wrapper').css({'margin-top' : AdjustedfixedHeight + 'px'});
        }
    };

    // On resize, run the function and reset the timeout
    // 250 is the delay in milliseconds. Change as you see fit.
    $(window).resize(function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(resizeFunction, 250);
    });

})(jQuery);

/**
 * Toggle offcanvas mobile menu
*/
jQuery(function () {
    
    jQuery('[data-toggle="offcanvas"]').on('click', function () {
        // add open class to nav
        jQuery('.offcanvas-collapse').toggleClass('open');
        // set html and body overflow-x: hidden to prevent horizontal scrollbar
        jQuery('html').toggleClass('offcanvas-overflowx');
        jQuery('body').toggleClass('offcanvas-overflowx');
        // run size function
        OffresizeFunction();
    })

    function OffresizeFunction() {
        // get height of header and adminbar
        var offcanvasHeight = jQuery('#wrapper-navbar').innerHeight();
        var adminBarHeight = jQuery('#wpadminbar').innerHeight();
        
        // if adminbar is null lets not include it
        if (adminBarHeight == null) { var OAsum = offcanvasHeight - 3; }
        else { var OAsum = offcanvasHeight + adminBarHeight - 3; }

        // set offcanvas top position
        jQuery('.offcanvas-collapse.open').css({'top' : OAsum + 'px'});
        
        // Check if we are using a non-fixed header
        var offcanvasRHeader = document.getElementById("wrapper-navbar").classList;
        // If so lets toggle fixed while offcanvas is open
        if (offcanvasRHeader.contains("header-p-n")) {
            offcanvasRHeader.toggle("fixed-top");
            if (jQuery('#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper, #homepage-wrapper, #search-wrapper, #index-wrapper, #error-404-wrapper, #archive-wrapper, #author-wrapper')[0].hasAttribute('style')) {
                jQuery("#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper, #homepage-wrapper, #search-wrapper, #index-wrapper, #error-404-wrapper, #archive-wrapper, #author-wrapper").removeAttr("style");
            }
            else {
                jQuery('#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper, #homepage-wrapper, #search-wrapper, #index-wrapper, #error-404-wrapper, #archive-wrapper, #author-wrapper').css({'margin-top' : offcanvasHeight + 'px'});
            }
        }

    }

    var resizeTimer; // Set resizeTimer to empty so it resets on page load
    // On resize, run the function and reset the timeout
    // 200 is the delay in milliseconds.
    jQuery(window).resize(function() {
        if (jQuery('.offcanvas-collapse.open').length > 0) {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(OffresizeFunction, 200);
        }
    });
   
});

/**
 * Initialize Slick client section
*/
jQuery(document).ready(function(){
    jQuery('.c-clients__carousel').slick();
});

/**
 * Initialize Slick client section
*/
jQuery(document).ready(function(){
    jQuery('.c-testimonials__carousel').slick({
        arrows: true,
        prevArrow: jQuery('.fa-chevron-left'),
        nextArrow: jQuery('.fa-chevron-right'),
        infinite: true,
        fade: true,
        adaptiveHeight: true,
        touchThreshold: 12
    });
});

/**
 * Initialize fancybox options
*/
jQuery('[data-fancybox="c-hero__fb-video1"]').fancybox({
    // Options go here
    youtube : {
        showinfo : 0,
        autoplay : 1,
        rel : 0
    },
    onInit : function() {
        jQuery("#wrapper-navbar").addClass("compensate-for-scrollbar");
        jQuery("#wpadminbar").addClass("compensate-for-scrollbar");
    },
    afterClose : function() {
        jQuery("#wrapper-navbar").removeClass("compensate-for-scrollbar");
        jQuery("#wpadminbar").removeClass("compensate-for-scrollbar");
    }
});
