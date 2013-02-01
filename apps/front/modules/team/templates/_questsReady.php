<?php
/**
 * User: makz
 * Date: 24.11.12
 * Time: 15:29
 *
 * @var Quest[] $quests
 */

if ( sizeof( $quests ) > 0 )
{
  echo _tag( 'div.separator' );
  echo _tag( 'h2.gray', 'Выполненные задания' );
  echo _open( 'ul' );
  foreach ( $quests as $quest )
  {
    echo _tag( 'li', _link( $quest ) );
  }
  echo _tag( 'ul' );
}
