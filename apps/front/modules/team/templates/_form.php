<?php
/**
 * @var UserTeamForm $form
 */

echo _tag( 'h1', $form->isNew() ? 'Регистрация команды' : 'Редактировать профиль команды' );

echo $form->open( array( 'class' => 'myform' ) );

echo _open( 'ul' );

echo $form['username']->renderRow();
echo $form['email']->renderRow();
echo $form['password']->renderRow();
echo $form['password_again']->renderRow();
echo $form['team']['name']->renderRow();
echo $form['team']['email1']->renderRow();
echo $form['team']['email2']->renderRow();
echo $form['team']['email3']->renderRow();
echo $form['team']['email4']->renderRow();
echo $form['team']['email5']->renderRow();
echo $form['team']['dm_media_id_form']['file']->renderRow( array(), 'Фото' );
echo _tag( 'li.center', _tag( 'button', 'Отправить' ) );
echo _close( 'ul' );

echo $form->renderHiddenFields();

echo $form->close();

if ( $dmUser = $form->getObject() )
{
  if ( $team = $dmUser->getTeam() )
  {
    if ( $team->dm_media_id )
    {
      echo _tag( 'p', _media( $team->DmMedia )->height( 100 )->method( 'scale' ) );
    }
  }
}
