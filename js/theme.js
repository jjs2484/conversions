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

	// Onload, run the function.
	jQuery( document ).ready( resizeFunction );
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
				location.hash = target.selector;
				event.preventDefault();
				event.stopPropagation();
			}
		}
	}

	if(window.location.hash) {
		scrollToAnchor(window.location.hash);
	}
	jQuery('a[href*=\\#]:not([href=\\#],[data-toggle],[href="#homepage-wrapper"],[href="#content"])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
			scrollToAnchor(this.hash);
		}
	});
});

/**
 * Skip link focus jumps to #content container or the first heading.
*/
jQuery(document).ready(function() {
	jQuery('.skip-link').click(function(e) {
		e.preventDefault();
		if (jQuery('#conversions-hero-content').length) {
			jQuery('#conversions-hero-content').attr('tabindex', '-1').focus();
		} else if (jQuery('#content').length) {
			jQuery('#content').attr('tabindex', '-1').focus();
		} else {
			jQuery(':header:first').attr('tabindex', '-1').focus();
		}
	});
});

/**
 * Mobile menu focus trapping 
 */
jQuery( document ).ready( function( $ ) {
	var $menu_elements = $( 'button.navbar-toggler, nav.navbar a.nav-link, nav.navbar .nav-callout-button a' );
 
	// Rewrite the elements to listen to tab and shift tab, and focus on each other.
	$menu_elements.keydown( function( e ) {
		if ( $( this ).attr( 'focus_locked' ) != 'true' )
			return;
		var code = e.keyCode || e.which;
		if ( code != 9 )
			return;

		var $current_element = $( this );

		// Let the focus go to the submenu item if this is a submenu parent.
		if ( $current_element.attr( 'aria-expanded' ) == 'true' )
			return;
 
		e.preventDefault();
		var counter;
		for( counter = 0; counter < $menu_elements.length ; counter++ ) {
			if( $current_element[0 ] == $menu_elements[ counter ] )
				break;
		}
 
		// Tab forwards
		if ( ! e.shiftKey ) {
			if ( counter == $menu_elements.length - 1 )
				// This is the last element. Select first.
				$menu_elements.first().focus();
			else
				$menu_elements[ counter + 1 ].focus();
		}
		else
		{
			// Tab backwards!
			if ( counter > 0 )
				$menu_elements[ counter - 1 ].focus();
			else
			{
				// First element. Select last.
				$menu_elements.last().focus();
			}
		}
 
	} );
 
	var $navbar_toggler = $( 'button.navbar-toggler' );
	// Lock the focus to the elements within.
	$navbar_toggler.click( function( e ) {
		if ( $navbar_toggler.attr( 'aria-expanded' ) != 'true' ) {
			$menu_elements.attr( 'focus_locked', true );
			// We need a tiny, tiny timeout to allow for the element to focus.
			setTimeout( function() {
				$menu_elements.first().focus();
			}, 10 );
		}
		else
		{
			$menu_elements.removeAttr( 'focus_locked' );
			$( this ).blur();
		}
	} );
} );