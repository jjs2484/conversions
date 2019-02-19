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
    
            // apply height to page as margin-top
            jQuery('#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper').css({'margin-top' : fixedHeight + 'px'});
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
     	
     	// get height of header and adminbar
     	var offcanvasHeight = jQuery('#wrapper-navbar').innerHeight();
     	var adminBarHeight = jQuery('#wpadminbar').innerHeight();
     	
     	// if adminbar is null lets not include it
     	if (adminBarHeight == null) { var OAsum = offcanvasHeight - 2; }
     	else { var OAsum = offcanvasHeight + adminBarHeight - 2; }

     	// set offcanvas top position
    	jQuery('.offcanvas-collapse.open').css({'top' : OAsum + 'px'});
    	
    	// Check if we are using a non-fixed header
    	var offcanvasRHeader = document.getElementById("wrapper-navbar").classList;
    	// If so lets toggle fixed while offcanvas is open
		if (offcanvasRHeader.contains("header-p-n")) {
    		offcanvasRHeader.toggle("fixed-top");
    		if (jQuery('#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper')[0].hasAttribute('style')) {
    			jQuery("#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper").removeAttr("style");
    		}
    		else {
    			jQuery('#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper').css({'margin-top' : offcanvasHeight + 'px'});
    		}
    	}
	})
});