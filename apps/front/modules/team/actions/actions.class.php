<?php
/**
 * Команда actions
 *
 *
 */
class teamActions extends myFrontModuleActions
{

  public function executeFormWidget(dmWebRequest $request)
  {
    $form = new UserTeamForm();

    /** @var dmFrontUser $sfUser  */
    $sfUser = $this->getUser();
    $dmUser = $sfUser->getDmUser();

    if ( $sfUser->isAuthenticated() && $dmUser->getUserType() != DmUser::TYPE_TEAM )
    {
      $this->redirect403();
    }
    else if ( $sfUser->isAuthenticated() && $dmUser->getUserType() == DmUser::TYPE_TEAM )
    {
      $form = new UserTeamForm( $dmUser );
    }

    if ( $request->hasParameter( $form->getName() ) && $form->bindAndValid( $request ) )
    {
      $form->save();

      if ( $form->isNew() )
      {
        $this->sendActivationMail( $form );
        $this->sendMemberMail( $form );

        $this->getUser()->setFlash( 'notice', 'Для активации профиля перейдите по ссылке, отправленной на указанный при регистрации Email' );
        $this->getUser()->setFlash( 'message', 'Ура, мы рады, что вы с нами! Не забудьте проверить свой спам-бокс - ваше приглашение может быть и там' );
      }

      $this->getUser()->setFlash( 'message', 'Профиль сохранен' );
      $this->getUser()->signin( $form->getObject() );

      $this->redirectBack();
    }

    $this->forms['UserTeam'] = $form;
  }

  public function executeProfileWidget( dmWebRequest $request )
  {
    /** @var dmFrontUser $sfUser  */
    $sfUser = $this->getUser();
    $dmUser = $sfUser->getDmUser();

    if ( ! $sfUser->isAuthenticated() || $dmUser->getUserType() != DmUser::TYPE_TEAM )
    {
      $this->redirect403();
    }
  }

  protected function sendActivationMail( UserTeamForm $form )
  {
    $user = $form->getObject();
    $team = $user->Team;

    $url = sprintf( 'team/activate?id=%s&code=%s', $team->getId(), $team->getCode() );

    $this->getService( 'mail' )
      ->setTemplate( 'team_activate' )
      ->addValues( array(
        'name'  => $user->getUsername(),
        'pass'  => $form->getValue( 'password' ),
        'email' => $user->getEmail(),
        'link'  => $this->getController()->genUrl( $url, true ),
    ) )->send();
  }

  protected function sendMemberMail( UserTeamForm $form )
  {
    $user = $form->getObject();
    $team = $user->Team;

    $members = array(
      $team->email1,
      $team->email2,
      $team->email3,
      $team->email4,
      $team->email5,
    );

    foreach ( $members as $email )
    {
      if ( ! $email )
      {
        continue;
      }

      $this->getService( 'mail' )
        ->setTemplate( 'team_member_notice' )
        ->addValues( array(
        'name'  => $user->getUsername(),
        'pass'  => $form->getValue( 'password' ),
        'email' => $email,
      ) )->send();
    }
  }

  public function executeActivate( dmWebRequest $request )
  {
    $id   = $request->getParameter( 'id' );
    $code = $request->getParameter( 'code' );

    if ( ! $id && ! $code )
    {
      $this->redirect403();
    }

    /** @var Team $team  */
    $team = Team::getById( $id );

    if ( $team->getIsActive() || $team->getCode() != $code )
    {
      $this->redirect403();
    }

    $team->is_active = true;
    $team->save();

    /** @var dmFrontUser $user */
    $user = $this->getUser();
    $user->signIn( $team->getDmUser() );
    $user->setFlash( 'message', 'Ваша учетная запись успешно активирована', true );

    $this->redirect( '@homepage' );
  }

  public function executeAcceptQuest( dmWebRequest $request )
  {
    /** @var dmFrontUser $sfUser  */
    $sfUser = $this->getUser();
    $dmUser = $sfUser->getDmUser();

    if ( ! $sfUser->isAuthenticated() || $dmUser->getUserType() != DmUser::TYPE_TEAM )
    {
      $this->redirect403( 'Только команды могут принимать задания. Зарегистрируйтесь или авторизуйтесь.' );
    }

    $id   = $request->getParameter( 'id' );
    $code = $request->getParameter( 'code' );

    if ( ! $id && ! $code )
    {
      $this->redirect403( 'Команды не существует' );
    }

    /** @var Quest $quest  */
    $quest = Quest::getById( $id );

    if ( ! $dmUser->Team->getIsActive() )
    {
      $this->redirect403( 'Ваш аккаунт не активен. Вы не подтвердили свой email' );
    }

    if ( $dmUser->Team->getCode() != $code )
    {
      $this->redirect403( 'Ошибка доступа' );
    }

    $quest->team_id = $dmUser->Team;
    $quest->status  = Quest::STATUS_ASSIGNED;
    $quest->save();

    $this->getUser()->setFlash( 'message', 'Задание принято к исполнению Вашей командой' );

    $this->redirectBack();
  }

  public function executeDeclineQuest( dmWebRequest $request )
  {
    /** @var dmFrontUser $sfUser  */
    $sfUser = $this->getUser();
    $dmUser = $sfUser->getDmUser();

    if ( ! $sfUser->isAuthenticated() || $dmUser->getUserType() != DmUser::TYPE_TEAM )
    {
      $this->redirect403( 'Только команды могут отклонять свои задания. Зарегистрируйтесь или авторизуйтесь.' );
    }

    $id   = $request->getParameter( 'id' );
    $code = $request->getParameter( 'code' );

    if ( ! $id && ! $code )
    {
      $this->redirect403( 'Команды не существует' );
    }

    /** @var Quest $quest  */
    $quest = Quest::getById( $id );

    if ( ! $dmUser->Team->getIsActive() || $dmUser->Team->getCode() != $code )
    {
      $this->redirect403( 'Ошибка доступа' );
    }

    $quest->team_id = null;
    $quest->status  = Quest::STATUS_NEW;
    $quest->save();

    $this->getUser()->setFlash( 'message', 'Задание снято с исполнения Вашей командой' );

    $this->redirectBack();
  }

}
