/**
 * If fixed header calc height and add margin to content 
*/
jQuery(function() {

	var resizeTimer; // Set resizeTimer to empty so it resets on page load.

	function resizeFunction() {
		// Are we using a fixed header?
		var fixedHeader = document.getElementById('wrapper-navbar').classList;
		if (fixedHeader.contains('header-p-n')) {
			return;
		}
		else if (fixedHeader.contains('fixed-top')) {
	
			// get height of header and adminbar.
			var fixedHeight = jQuery('#wrapper-navbar.fixed-top').innerHeight();
			var adjustedFixedHeight = fixedHeight - 2;
	
			// apply height to page as margin-top.
			jQuery('.content-wrapper').css({'margin-top' : adjustedFixedHeight + 'px'});
		}
	}

	// On resize, run the function and reset the timeout.
	// 150 is the delay in milliseconds. Change as you see fit.
	jQuery(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(resizeFunction, 150);
	});

});

/**
 * Toggle offcanvas mobile menu
*/
jQuery(function() {
	
	jQuery('[data-toggle="offcanvas"]').on('click', function () {
		// add open class to nav.
		jQuery('.offcanvas-collapse').toggleClass('open');
		// set html and body overflow-x: hidden to prevent horizontal scrollbar.
		jQuery('html').toggleClass('offcanvas-overflowx');
		jQuery('body').toggleClass('offcanvas-overflowx');
		// run size function.
		OffresizeFunction();
	});

	function OffresizeFunction() {
		// get height of header and adminbar.
		var offcanvasHeight = jQuery('#wrapper-navbar').innerHeight();
		var adminBarHeight = jQuery('#wpadminbar').innerHeight();
		
		// if adminbar is null lets not include it.
		if (adminBarHeight == null) { var totalHeight = offcanvasHeight - 3; }
		// eslint-disable-next-line no-redeclare
		else { var totalHeight = offcanvasHeight + adminBarHeight - 3; }

		// set offcanvas top position.
		jQuery('.offcanvas-collapse.open').css({'top' : totalHeight + 'px'});
		
		// Check if we are using a non-fixed header.
		var offcanvasRHeader = document.getElementById('wrapper-navbar').classList;
		// If so lets toggle fixed while offcanvas is open.
		if (offcanvasRHeader.contains('header-p-n')) {
			offcanvasRHeader.toggle('fixed-top');
			if (jQuery('.content-wrapper')[0].hasAttribute('style')) {
				jQuery('.content-wrapper').removeAttr('style');
			}
			else {
				jQuery('.content-wrapper').css({'margin-top' : offcanvasHeight + 'px'});
			}
		}

	}

	var resizeTime;
	// On resize run the function and reset the timeout.
	// 150 is the delay in milliseconds.
	jQuery(window).resize(function() {
		if (jQuery('.offcanvas-collapse.open').length > 0) {
			clearTimeout(resizeTime);
			resizeTime = setTimeout(OffresizeFunction, 150);
		}
	});
   
});

/**
 * Initialize Slick client section
*/
jQuery(document).ready(function() {
	jQuery('.c-clients__carousel').slick();
});

/**
 * Initialize Slick client section
*/
jQuery(document).ready(function() {
	jQuery('.c-testimonials__carousel').slick({
		arrows: true,
		prevArrow: jQuery('.fa-chevron-left'),
		nextArrow: jQuery('.fa-chevron-right'),
		infinite: true,
		fade: true,
		adaptiveHeight: true,
		touchThreshold: 14
	});
});

/**
 * Initialize fancybox options
*/
jQuery('[data-fancybox="c-hero__fb-video1"]').fancybox({
	// Options go here.
	youtube : {
		showinfo : 0,
		autoplay : 1,
		rel : 0
	},
	onInit : function() {
		jQuery('#wrapper-navbar').addClass('compensate-for-scrollbar');
		jQuery('#wpadminbar').addClass('compensate-for-scrollbar');
	},
	afterClose : function() {
		jQuery('#wrapper-navbar').removeClass('compensate-for-scrollbar');
		jQuery('#wpadminbar').removeClass('compensate-for-scrollbar');
	}
});