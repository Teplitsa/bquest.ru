<?php
/**
 * User: makz
 * Date: 23.11.12
 * Time: 23:31
 *
 * @var string $latlng
 * @var string $label
 */

?>

<div id="googleMap" class="google_map"></div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">

  (function ()
  {
    var geocoder;
    var map;
    var geocoderTimeout;

    function initialize()
    {
      var latlng = new google.maps.LatLng( <?php echo $latlng; ?> );

      var mapOptions = {
        zoom     : 15,
        center   : latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };

      var map = new google.maps.Map( document.getElementById( 'googleMap' ), mapOptions );

      var marker = new google.maps.Marker( {
        position:latlng,
        map     :map,
        title   :'<?php echo $label; ?>'
      } );
    }

    $( document ).ready( function ()
    {
      initialize();
    } );

  })();

</script>