<?php
/**
 * @var dmFrontUser $sf_user
 */

if ( $sf_user->isAuthenticated() )
{
  $text = $sf_user->getUsername();

  if ( $sf_user->getDmUser()->getUserType() == DmUser::TYPE_AGENCY )
  {
    $text = _link( 'agency/profile' )->text( $text )->set( '.small_button' );
  }

  if ( $sf_user->getDmUser()->getUserType() == DmUser::TYPE_TEAM )
  {
    $text = _link( 'team/profile' )->text( $text )->set( '.small_button' );
  }

  echo _tag( 'p', __( 'Ваш профиль: %username%', array( '%username%' => $text ) ) );

  echo _tag( 'p', link_to( 'Выйти', 'dmUser/signout' ) );

  if ( $sf_user->getDmUser()->getUserType() == DmUser::TYPE_AGENCY )
  {
    echo _link( 'quest/form' )->text( 'Создать задание' )->set( '.big_button' );
  }

  return;
}

echo _tag( 'h2', 'Войти на сайт' );

echo $form->open( '.dm_signin_form.myform action=@signin' );

echo _tag( 'ul'
  , _tag( 'li', $form[ 'username' ]->label('<span class="icon_login"></span>')->field()->error() )
  . _tag( 'li', $form[ 'password' ]->label('<span class="icon_password"></span>')->field()->error() )
  . _tag( 'li.right', _tag( 'button', 'Войти <span class="icon_enter"></span>' ) )
  //_tag( 'li.dm_form_element', $form[ 'remember' ]->label()->field()->error() )
);

echo $form->renderHiddenFields();

//echo $form->submit( __( 'Signin' ) );

echo $form->close();

echo _tag( 'h2', 'Регистрация' );

echo _link( 'team/form' )->text('Зарегистрировать команду')->set('.big_button');

echo _link( 'agency/form' )->text( 'Зарегистрировать НКО' )->set('.big_button');
