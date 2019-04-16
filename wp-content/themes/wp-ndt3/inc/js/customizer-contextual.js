( function( api ) {
  'use strict';

  api.bind( 'ready', function() {

    api( 'header_image', function(setting) {
      var linkSettingValueToControlActiveState;

      /**
       * Update a control's active state according to the boxed_body setting's value.
       *
       * @param {api.Control} control Boxed body control.
       */
      linkSettingValueToControlActiveState = function( control ) {
        var set_active = function() {
          var $container = control.container;
          $container.find('.header_image-image').removeClass('active');
          $container.find('#header_image-image-' + setting.get()).addClass('active');
        };

        // Set initial active state.
        set_active();

        //Update activate state whenever the setting is changed.
        setting.bind( set_active );
      };

      // Call linkSettingValueToControlActiveState on the border controls when they exist.
      api.control( 'header_image', linkSettingValueToControlActiveState );
    });

  });

}( wp.customize ) );
