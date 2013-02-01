<?php
/**
 * User: makz
 * Date: 19.11.12
 * Time: 14:09
 *
 * @var Agency $object
 */

echo _tag( 'h1', $object->name );

include_partial( 'agency/card', array( 'agency' => $object ) );

echo _tag( 'div.separator' );

echo _tag( 'p'
  , _link( 'quest/form' )->text( 'Создать задание' )->set( '.small_button' )
  . ' &nbsp; &nbsp; &nbsp;'
  . _link( 'agency/form' )->text( 'Редактировать профиль' )->set( '.small_button' )
);

include_partial( 'agency/quests', array( 'agency' => $object ) );
