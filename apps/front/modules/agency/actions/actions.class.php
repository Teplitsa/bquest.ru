<?php
/**
 * Организация actions
 *
 */
class agencyActions extends myFrontModuleActions
{

  public function executeFormWidget(dmWebRequest $request)
  {
    $form = new UserAgencyForm();

    /** @var dmFrontUser $sfUser  */
    $sfUser = $this->getUser();
    $dmUser = $sfUser->getDmUser();

    if ( $sfUser->isAuthenticated() && $dmUser->getUserType() != DmUser::TYPE_AGENCY )
    {
      $this->redirect403();
    }
    else if ( $sfUser->isAuthenticated() && $dmUser->getUserType() == DmUser::TYPE_AGENCY )
    {
      $form = new UserAgencyForm( $dmUser );
    }

    if ( $request->hasParameter( $form->getName() ) && $form->bindAndValid( $request ) )
    {
      $form->save();

      if ( $form->isNew() )
      {
        $this->sendActivationMail( $form );

        $this->getUser()->setFlash( 'notice', 'Для активации профиля перейдите по ссылке, отправленной на указанный при регистрации Email' );
        $this->getUser()->setFlash( 'message', 'Ура, мы рады, что вы с нами! Не забудьте проверить свой спам-бокс - ваше приглашение может быть и там' );
      }

      $this->getUser()->setFlash( 'message', 'Профиль сохранен' );
      $this->getUser()->signin( $form->getObject() );

      $this->redirectBack();
    }

    $this->forms['UserAgency'] = $form;
  }

  public function executeProfileWidget( dmWebRequest $request )
  {
    /** @var dmFrontUser $sfUser  */
    $sfUser = $this->getUser();
    $dmUser = $sfUser->getDmUser();

    if ( ! $sfUser->isAuthenticated() || $dmUser->getUserType() != DmUser::TYPE_AGENCY )
    {
      $this->redirect403();
    }
  }

  protected function sendActivationMail( UserAgencyForm $form )
  {
    $user   = $form->getObject();
    $agency = $user->Agency;

    $url = sprintf( 'agency/activate?id=%s&code=%s', $agency->getId(), $agency->getCode() );

    $this->getService( 'mail' )
      ->setTemplate( 'agency_activate' )
      ->addValues( array(
      'name'  => $user->getUsername(),
      'pass'  => $form->getValue( 'password' ),
      'email' => $user->getEmail(),
      'link'  => $this->getController()->genUrl( $url, true ),
    ) )->send();
  }

  public function executeActivate( dmWebRequest $request )
  {
    $id   = $request->getParameter( 'id' );
    $code = $request->getParameter( 'code' );

    if ( ! $id && ! $code )
    {
      $this->redirect403();
    }

    /** @var Agency $agency  */
    $agency = Agency::getById( $id );

    if ( $agency->getIsActive() || $agency->getCode() != $code )
    {
      $this->redirect403();
    }

    $agency->is_active = true;
    $agency->save();

    /** @var dmFrontUser $user */
    $user = $this->getUser();
    $user->signIn( $agency->getDmUser() );
    $user->setFlash( 'message', 'Ваша учетная запись успешно активирована', true );

    $this->redirect( '@homepage' );
  }

}
