<?php
/**
 * Agency[] $agencyPager
 */

echo $agencyPager->renderNavigationTop();

echo _open( 'ul.list' );

foreach ( $agencyPager as $agency )
{
  /** @var Agency $agency */

  $img = $agency->dm_media_id ? _media( $agency->DmMedia )->size( 66, 66 )->method( 'center' ) : '';

  echo _tag( 'li'
    , _tag( 'div.image.square.shady', _link( $agency )->text( $img ) )
    . _tag( 'div.name', _link( $agency ) )
    . _tag( 'div.text', Util::trim( $agency->description, 500 ) )
  );

}

echo _close( 'ul' );

echo $agencyPager->renderNavigationBottom();