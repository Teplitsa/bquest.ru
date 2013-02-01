<?php
/**
 * @var QuestForm $form
 */

use_javascripts_for_form( $form );
use_stylesheets_for_form( $form );

echo _tag( 'h1', $form->isNew() ? 'Создать задание' : 'Редактировать задание' );

echo $form->open( array( 'class' => 'myform' ) );
echo _open( 'ul' );
echo $form['name']->renderRow();
echo $form['theme']->renderRow();
echo $form['deadline']->renderRow();
echo $form['address']->renderRow();
echo $form['help_type']->renderRow();
echo $form['description']->renderRow();
echo $form['dm_media_id_form']['file']->renderRow( array(), 'Фото' );
echo _tag( 'li.center', _tag( 'button', 'Сохранить' ) );
echo _close( 'ul' );
echo $form->renderHiddenFields();
echo $form->close();

?>

<div id="googleMap"  class="google_map hidden"></div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">

  (function ()
  {
    var geocoder;
    var map;
    var geocoderTimeout;

    var $name   = $( '#quest_agency_form_address' );
    var $quest  = $( '#quest_agency_form_name' );
    var $latlng = $( '#quest_agency_form_latlng' );
    var $map    = $( '#googleMap' );

    function initialize()
    {
      geocoder = new google.maps.Geocoder();
    }

    function codeAddress()
    {
      var address = 'Москва, ' + $name.val();
      geocoder.geocode( { 'address':address}, function ( results, status )
      {
        if ( status == google.maps.GeocoderStatus.OK && results[0].geometry.location_type == "ROOFTOP" )
        {
          $map.show();

          var location = results[0].geometry.location;

          $latlng.val( location.toUrlValue() );

          var latlng = new google.maps.LatLng( location.lat(), location.lng() );

          var mapOptions = {
            zoom     : 16,
            center   : latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };

          var map = new google.maps.Map( document.getElementById( 'googleMap' ), mapOptions );

          var marker = new google.maps.Marker( {
            position:latlng,
            map     :map,
            title   :$quest.val()
          } );
        }
        else
        {
          $latlng.val( '' );
          $map.hide();
        }
      } );
    }

    $( document ).ready( function ()
    {
      initialize();

      $name.change( function ()
      {
        clearTimeout( geocoderTimeout );
        geocoderTimeout = setTimeout( function ()
        {
          codeAddress();
        }, 500 );
      } )
    } );

    var initializeCkeditor = function()
    {
      var $textarea = $( '.quest_form textarea.dm_ckeditor' );

      //Kill all existing instances before loading
      //ckeditor again or it will not work with ajax request
      if ( $textarea.attr( 'id' ) in CKEDITOR.instances )
      {
        CKEDITOR.remove( CKEDITOR.instances[$textarea.attr( 'id' )] );
      }

      $textarea.ckeditor( function (){}, $textarea.metadata() );
    };

    $( function ()
    {
      window.CKEDITOR_BASEPATH = dm_configuration.relative_url_root+'/dmCkEditorPlugin/js/ckeditor/';
      initializeCkeditor();
    });

  })();

</script>