jQuery(document).ready(function($) {
	$( '.conversions_homepage_sorting' ).sortable();
	$( '.conversions_homepage_sorting' ).disableSelection();

	$( '.conversions_homepage_sorting' ).bind( 'sortstop', function ( e, ui )
	{
		var components = new Array();
		var disabled = '[disabled]';

		$( e.target ).find( 'li' ).each( function ( i, e )
		{
			if ( $( this ).hasClass( 'disabled' ) )
				return;
			// Only push non-disabled components.
			components.push( $( this ).attr( 'id' ) );
		} );

		components = components.join( ',' );

		console.log( 'new components', components );

		$r = $( 'input[data-customize-setting-link="conversions_homepage_sorting"]' ).attr( 'value', components ).trigger( 'change' );
		console.log( 'sortstop', $r.attr( 'value' ) );
	});

	$( '.conversions_homepage_sorting .visibility' ).bind( 'click', function ( e ) {
		var components = new Array();
		var disabled = '[disabled]';

		$( this ).parent( 'li' ).toggleClass( 'disabled' );

		$( this ).parents( '.conversions_homepage_sorting' ).find( 'li' ).each( function ( i, e )
		{
			if ( $( this ).hasClass( 'disabled' ) )
				return;
			// Only push non-disabled components.
			components.push( $( this ).attr( 'id' ) );
		} );

		components = components.join( ',' );

		console.log( 'new components', components );

		$r = $( 'input[data-customize-setting-link="conversions_homepage_sorting"]' ).attr( 'value', components ).trigger( 'change' );
		console.log( 'click', $r.attr( 'value' ) );
	});
});
