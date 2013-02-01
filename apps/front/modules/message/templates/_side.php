<?php

/**
 * @var Message[] $messages
 */

inline_stylesheet( 'message/side' );

echo _open( 'div.shady.round.wrapper' );
echo _tag( 'h2', 'Сообщество' );
echo _open( 'ul' );
foreach ( $messages as $message )
{
  echo _tag( 'li'
    , _tag( 'span.date', $message->getCreatedString() )
    . _tag( 'span.arr', ' → ' )
    . Util::trim( $message->getText(), 150 )
    . ' '
    . _link( $message )->text( 'подробнее' )
  );
}
echo _close( 'ul' );
echo _close( 'div' );
