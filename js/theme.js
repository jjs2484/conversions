/**
 * If fixed header calculate the height add margin to content below 
*/
jQuery(document).ready(function () {
	// get height of header
	var fixedHHeight = jQuery('#wrapper-navbar.fixed-top').height();
	// apply height to page as margin-top
	jQuery('#page-wrapper').css({'margin-top' : fixedHHeight + 'px'});
});
/**
 * Toggle offcanvas mobile menu
*/
jQuery(function () {
	jQuery('[data-toggle="offcanvas"]').on('click', function () {
		// add open class to nav
    	jQuery('.offcanvas-collapse').toggleClass('open');
     	// get height of header
     	var offcanvasHHeight = jQuery('#wrapper-navbar').height();
     	// set offcanvas top position
    	jQuery('.offcanvas-collapse.open').css({'top' : offcanvasHHeight + 'px'});
    	// Are we using a non-fixed or sticky header?
    	var offcanvasRHeader = document.getElementById("wrapper-navbar").classList;
    	// If so lets toggle fixed while offcanvas is open
		if (offcanvasRHeader.contains("header-p-n")) {
    		offcanvasRHeader.toggle("fixed-top");
    	}
	})
});