( function( $ ){
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#site-title a' ).html( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '#site-description' ).html( to );
		} );
	} );
	wp.customize( 'path_theme_settings[path_global_layout]', function( value ) {
		value.bind( function( to ) {
			var classes = $( 'body' ).attr( 'class' ).replace( /layout-[a-zA-Z0-9_-]*/g, '' ); // replace class with prefix layout- to ''
			$( 'body' ).attr( 'class', classes ).addClass( to ); // add new class
		} );
	} );

} )( jQuery );
