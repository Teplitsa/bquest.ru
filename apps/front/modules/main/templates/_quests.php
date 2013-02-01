<?php
/**
 * @var Quest[] $closed
 * @var Quest[] $available
 */

echo _open( 'div.col' );
echo _tag( 'h2.red', 'Позитивная хроника' );
echo _open( 'ul.list' );
foreach ( $closed as $quest )
{
  $img = $quest->hasReadyImage() ? _media( $quest->getReadyImage() )->size( 66, 66 )->method( 'center' ) : '';
  $tpl = 'Создано %s «%s», выполнила %s команда «%s»';
  $txt = sprintf( $tpl, $quest->getCreatedString(), _link( $quest->Agency ), $quest->getUpdatedString(), _link( $quest->Team ) );

  echo _tag( 'li'
    , _tag( 'div.image.round.shady', _link( $quest )->text( $img ) )
    . _tag( 'div.name', _link( $quest ) )
    . _tag( 'div.text', $txt )
  );
}
echo _close( 'ul' );
echo _tag( 'div.more', _link( 'quest/list' )->param( 'type', Quest::STATUS_CLOSED ) );
echo _close( 'div.col' );

echo _open( 'div.col' );
echo _tag( 'h2.red', 'Новые задачи' );
echo _open( 'ul.list' );
foreach ( $available as $quest )
{
  $img = $quest->hasReadyImage() ? _media( $quest->getReadyImage() )->size( 66, 66 )->method( 'center' ) : '';
  $tpl = 'Создано %s «%s»';
  $txt = sprintf( $tpl, $quest->getCreatedString(), _link( $quest->Agency ) );

  echo _tag( 'li'
    , _tag( 'div.image.square.shady', _link( $quest )->text( $img ) )
    . _tag( 'div.name.oneline', _link( $quest ) )
    . _tag( 'div.text.oneline', $txt )
    . _tag( 'div.hint', Util::trim( $quest->description, 500 ) )
  );
}
echo _close( 'ul' );
echo _tag( 'div.more', _link( 'quest/list' )->param( 'type', Quest::STATUS_NEW ) );
echo _close( 'div.col' );

echo _tag( 'div.clear' );