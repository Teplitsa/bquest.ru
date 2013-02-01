<?php
/**
 * @var UserAgencyForm $form
 */

echo _tag( 'h1', $form->isNew() ? 'Регистрация НКО' : 'Редактировать профиль НКО' );

echo $form->open( array( 'class' => 'myform' ) );

echo _open( 'ul' );

echo $form['username']->renderRow();
echo $form['email']->renderRow();
echo $form['password']->renderRow();
echo $form['password_again']->renderRow();
echo $form['agency']['name']->renderRow();
echo $form['agency']['description']->renderRow();
echo $form['agency']['coordinator_name']->renderRow();
echo $form['agency']['coordinator_telephone']->renderRow();
echo $form['agency']['website']->renderRow();
echo $form['agency']['dm_media_id_form']['file']->renderRow( array(), 'Логотип' );
echo _tag( 'li.center', _tag( 'button', 'Отправить' ) );
echo _close( 'ul' );

echo $form->renderHiddenFields();

echo $form->close();

if ( $dmUser = $form->getObject() )
{
  if ( $agency = $dmUser->getAgency() )
  {
    if ( $agency->dm_media_id )
    {
      echo _tag( 'p', _media( $agency->DmMedia )->height( 100 )->method( 'scale' ) );
    }
  }
}
