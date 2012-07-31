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
			$( 'body' ).removeClass( 'layout-default layout-1c layout-2c-l layout-2c-r layout-3c-l layout-3c-r layout-3c-c' ).addClass( to );
		} );
	} );
} )( jQuery );