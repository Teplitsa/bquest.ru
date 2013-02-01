<?php
/**
 * @var Quest[] $quests
 * @var Team[] $teams
 */

echo _open( 'div.col' );
echo _tag( 'h2', 'Карта квеста' );
echo _tag( 'div#questMap.map' );
echo _close( 'div.col' );

echo _open( 'div.col' );
echo _tag( 'h2', 'Рейтинг команд' );
echo _open( 'ul.list' );
foreach ( $teams as $team )
{
  $img = $team->dm_media_id ? _media( $team->DmMedia )->size( 66, 66 )->method( 'center' ) : '';

  $tplReady     = 'Выполнено заданий %s<br>';
  $tplAssigned  = 'Заданий в процессе: %s<br>';

  $numReady    = $team->getReadyQuestsQuery()->count();
  $numAssigned = $team->getAssignedQuestsQuery()->count();

  $txt = '';
  if ( $numAssigned )
  {
    $txt .= sprintf( $tplAssigned, $numAssigned );
  }
  if ( $numReady )
  {
    $txt .= sprintf( $tplReady, $numReady );
  }

  echo _tag( 'li'
    , _tag( 'div.image.square.shady', _link( $team )->text( $img ) )
      . _tag( 'div.rating', 'Рейтинг:<br>' . _tag( 'span', $team->getRating() ) )
      . _tag( 'div.name', _link( $team ) )
      . _tag( 'div.text', $txt )
  );
}
echo _close( 'ul' );
echo _close( 'div.col' );

echo _tag( 'div.clear' );

?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.1&sensor=false"></script>

<script type="text/javascript">
  (function ()
  {

    var geocoder;
    var map;

    var zoom = 10;
    var allBounds = new google.maps.LatLngBounds();
    var allLatLng = [];
    var allMarkers = [];
    var allLabels = [];

    <?php foreach ( $quests as $quest ) : ?>
    allLatLng[allLatLng.length] = new google.maps.LatLng(<?php echo $quest->latlng ?>);
    allBounds.extend(new google.maps.LatLng(<?php echo $quest->latlng ?>));
    allLabels[allLabels.length] = '<?php echo $quest->name; ?>';
    <?php endforeach; ?>

    var mapOptions = {
      zoom                    :zoom,
      //center                  :new google.maps.LatLng( 55.753395,37.620569 ),
      center                  :allBounds.getCenter(),
      mapTypeId               :google.maps.MapTypeId.ROADMAP,
      scrollwheel             :false,
      navigationControlOptions:{
        position:google.maps.ControlPosition.TOP_LEFT,
        style   :google.maps.NavigationControlStyle.ANDROID
      },
      mapTypeControlOptions   :{
        position:google.maps.ControlPosition.TOP_RIGHT,
        style   :google.maps.MapTypeControlStyle.DROPDOWN_MENU
      }
    };

    function initialize()
    {
      map = new google.maps.Map(document.getElementById('questMap'), mapOptions);

      for( var i in allLatLng )
      {
        new google.maps.Marker( {
          map       : map,
          animation : google.maps.Animation.DROP,
          position  : allLatLng[ i ],
          title     : allLabels[ i ]
        } );
      }

      if ( allLatLng.length == 1 )
      {
        map.setZoom( 15 );
      }
      else
      {
        map.fitBounds( allBounds );
      }
    }

    $(function()
    {
      initialize();
    });

  })();
</script>