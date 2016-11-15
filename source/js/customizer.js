/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( 'header .site-title' ).text( to );
		} );
	} );

	// Site description.
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( 'header .site-description' ).text( to );
		} );
	} );

	// Site copyright
	wp.customize( 'karta_sitecopyright', function( value ) {
		value.bind( function( to ) {
			$( '.site-info__copyright' ).text( to );
		} );
	} );
} )( jQuery );
