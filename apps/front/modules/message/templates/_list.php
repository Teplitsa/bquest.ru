<?php // Vars: $messagePager

echo $messagePager->renderNavigationTop();

echo _open('ul.elements');

foreach ($messagePager as $message)
{
  echo _open('li.element');

  echo _tag( 'span.date', $message->getCreatedString() );
  echo _tag( 'span.arr', ' → ' );

  echo _link( $message );

  echo _close('li');
}

echo _close('ul');

echo $messagePager->renderNavigationBottom();