/**
 * File customizer.js.
 * Theme Customizer enhancements for a better user experience.
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

  // Site title and description.
  wp.customize( 'blogname', function( value ) {
    value.bind( function( to ) {
      $( '.site-title a' ).text( to );
    } );
  } );
  wp.customize( 'blogdescription', function( value ) {
    value.bind( function( to ) {
      $( '.site-description' ).text( to );
    } );
  } );

  // Header Image
  wp.customize( 'header_image', function( value ) {
    value.bind( function( to ) {
      $('.page-header').removeClass().addClass('page-header ' + to);
    } );
  } );



} )( jQuery );
