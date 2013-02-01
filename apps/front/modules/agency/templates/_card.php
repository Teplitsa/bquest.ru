<?php
/**
 * User: makz
 * Date: 24.11.12
 * Time: 15:23
 *
 * @var Agency $agency
 */

$img = $agency->dm_media_id ? _media( $agency->DmMedia )->width( 150 )->set( '.round' ) : '';

inline_stylesheet( 'team/profile_card' );

echo _tag( 'table.p10', _tag( 'tr'
  , _tag( 'td', $img )
  . _tag( 'td', markdown( $agency->description ) )
) );


echo _open( 'div.team_profile_card' );
//echo _tag( 'div.image.shady.round', $img );
echo _tag( 'div.clear' );
echo _close( 'div' );
