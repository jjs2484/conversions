/**
 * If fixed header calc height and add margin to content 
*/
jQuery(function() {

	function resizeFunction() {
		// Get the navbar classes.
		var navbarClasses = document.getElementById('wrapper-navbar').classList;

		// Are we using a fixed header? If not return.
		if (navbarClasses.contains('header-p-n')) {
			return;
		}
		else if (navbarClasses.contains('fixed-top')) {
	
			// get height of header.
			var fixedHeight = jQuery('#wrapper-navbar.fixed-top').innerHeight();
			var adjustedFixedHeight = fixedHeight - 2;
	
			// apply height to page as margin-top.
			jQuery('.content-wrapper').css({'margin-top' : adjustedFixedHeight + 'px'});
		}
	}

	var resizeTimer; // Set resizeTimer to empty so it resets on page load.

	// On resize, run the function and reset the timeout.
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
		
		// run resize function.
		offcanvasResize();
	});

	function offcanvasResize() {
		// Get height of header and adminbar.
		var offcanvasHeight = jQuery('#wrapper-navbar').innerHeight();
		var adminBarHeight = jQuery('#wpadminbar').innerHeight();
		
		// Total height calculation.
		var totalHeight = offcanvasHeight + adminBarHeight - 3;

		// Set offcanvas top position.
		jQuery('.offcanvas-collapse.open').css({'top' : totalHeight + 'px'});
		
		// Get the navbar classes.
		var navbarClasses = document.getElementById('wrapper-navbar').classList;

		// Check if we are using a non-fixed header.
		// If so lets toggle fixed while offcanvas is open.
		if (navbarClasses.contains('header-p-n')) {
			navbarClasses.toggle('fixed-top');
			if (jQuery('.content-wrapper')[0].hasAttribute('style')) {
				jQuery('.content-wrapper').removeAttr('style');
			}
			else {
				jQuery('.content-wrapper').css({'margin-top' : offcanvasHeight + 'px'});
			}
		}
	}

	var resizeTime; // Set resizeTime to empty so it resets on page load.

	// On resize run the function and reset the timeout.
	jQuery(window).resize(function() {
		if (jQuery('.offcanvas-collapse.open').length > 0) {
			clearTimeout(resizeTime);
			resizeTime = setTimeout(offcanvasResize, 150);
		}
	});
});

/**
 * Anchor link offset for fixed navbar
*/
jQuery(function($) {
	
	function scrollToAnchor(hash) {
		// Get the navbar classes.
		var navbarClasses = document.getElementById('wrapper-navbar').classList;

		// Are we using a fixed header? If not return.
		if (navbarClasses.contains('header-p-n')) {
			return;
		}
		else if (navbarClasses.contains('fixed-top')) {
		
			var target = $(hash);

			// Get height of the navbar and adminbar.
			var navbarHeight = jQuery('#wrapper-navbar').innerHeight();
			var adminBarHeight = jQuery('#wpadminbar').innerHeight();
		
			// Total height calculation.
			var offsetHeight = navbarHeight + adminBarHeight + 50;

			target = target.length ? target : $('[name=' + hash.slice(1) +']');

			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top - offsetHeight
				}, 100);
				event.preventDefault();
				event.stopPropagation();
			}
		}
	}

	if(window.location.hash) {
		scrollToAnchor(window.location.hash);
	}

	$('a[href*=\\#]:not([href=\\#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
			scrollToAnchor(this.hash);
		}
	});
})(jQuery);

/**
 * Initialize Slick client section
*/
jQuery(document).ready(function() {
	jQuery('.c-clients__carousel').slick();
});

/**
 * Initialize Slick testimonial section
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