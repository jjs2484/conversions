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
jQuery(function() {
	
	function scrollToAnchor(hash) {
		// Get the navbar classes.
		var navbarClasses = document.getElementById('wrapper-navbar').classList;

		// Are we using a fixed header? If not return.
		if (navbarClasses.contains('header-p-n')) {
			return;
		}
		else if (navbarClasses.contains('fixed-top')) {
		
			var target = jQuery(hash);

			// Get height of the navbar and adminbar.
			var navbarHeight = jQuery('#wrapper-navbar').innerHeight();
			var adminBarHeight = jQuery('#wpadminbar').innerHeight();
		
			// Total height calculation.
			var offsetHeight = navbarHeight + adminBarHeight + 50;

			target = target.length ? target : jQuery('[name=' + hash.slice(1) +']');

			if (target.length) {
				jQuery('html,body').animate({
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
	jQuery('a[href*=\\#]:not([href=\\#],[data-toggle]])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
			scrollToAnchor(this.hash);
		}
	});
	jQuery('[href="#homepage-wrapper"],[href="#content"').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			scrollToAnchor(this.hash);
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
 * Hero youtube modal 
*/
jQuery(document).ready(function() {

	// Gets the video src from the data-src on each button
	var $videoSrc;  
	jQuery( '.c-hero__fb-video' ).click(function() {
		$videoSrc = jQuery(this).data( 'src' );
	});

	// when the modal is opened autoplay it  
	jQuery( '#c-hero-modal' ).on( 'shown.bs.modal', function () {
		// set the video src to autoplay and not to show related video.
		jQuery( '#video' ).attr( 'src', $videoSrc + '?autoplay=1&amp;modestbranding=1&amp;showinfo=0&amp;rel=0' ); 
	});

	// stop playing the youtube video when I close the modal
	jQuery( '#c-hero-modal' ).on( 'hide.bs.modal', function () {
		jQuery( '#video' ).attr( 'src', $videoSrc ); 
	});
});