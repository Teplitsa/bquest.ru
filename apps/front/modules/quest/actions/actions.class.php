<?php
/**
 * Задание actions
 *
 */
class questActions extends myFrontModuleActions
{

  public function executeFormWidget( dmWebRequest $request )
  {
    $quest = $this->getQuestFromRequest( $request );

    $form = new QuestAgencyForm( $quest );

    if ( $request->hasParameter( $form->getName() ) && $form->bindAndValid( $request ) )
    {
      $form->getObject()->is_active = false;
      $form->save();
      $this->getUser()->setFlash( 'message', 'Задание сохранено и появиться в списках сразу после проверки модератором.' );
      $this->redirectPage( 'quest/form', array( 'id' => $form->getObject()->id ) );
    }

    $this->forms[ 'Quest' ] = $form;
  }

  public function executeShowWidget( dmWebRequest $request )
  {
    /** @var dmFrontUser $sfUser  */
    $sfUser = $this->getUser();
    $dmUser = $sfUser->getDmUser();

    $quest = Quest::getById( $this->getPage()->get('record_id') );

    $formComplete = new QuestCompleteForm( $quest );
    $formClose    = new QuestCloseForm( $quest );

    if ( $request->isMethod( 'post' ) )
    {
      if ( $request->hasParameter( $formComplete->getName() ) && $formComplete->bindAndValid( $request ) && $dmUser->isTeam() )
      {
        $formComplete->save();
        $this->sendFormCompleteMail( $formComplete );
        $this->getUser()->setFlash( 'message', 'Отчет сохранен' );
      }

      if ( $request->hasParameter( $formClose->getName() ) && $formClose->bindAndValid( $request ) && $dmUser->isAgency() )
      {
        $formClose->save();
        $this->sendFormCloseMail( $formClose );
        $this->getUser()->setFlash( 'message', 'Отчет сохранен' );
      }
    }

    $this->forms[ 'QuestComplete' ] = $formComplete;
    $this->forms[ 'QuestClose' ]    = $formClose;
  }

  public function executeDelete( dmWebRequest $request )
  {
    $quest = $this->getQuestFromRequest( $request );

    $quest->delete();

    $this->getUser()->setFlash( 'notice', 'Задание удалено' );

    $this->redirectBack();
  }

  protected function sendFormCompleteMail( QuestCompleteForm $form )
  {
    $quest = $form->getObject();

    $this->getService( 'mail' )->setTemplate( 'quest_ready' )->addValues( array(
      'name'  => $quest->Agency->name,
      'quest' => $quest->name,
      'team'  => $quest->Team->name,
      'link'  => $this->getHelper()->link( $quest )->getAbsoluteHref(),
      'email' => $quest->Agency->DmUser->email,
    ) )->send();
  }

  protected function sendFormCloseMail( QuestCloseForm $form )
  {
    $quest = $form->getObject();

    $this->getService( 'mail' )->setTemplate( 'quest_closed' )->addValues( array(
      'name'   => $quest->Team->name,
      'quest'  => $quest->name,
      'agency' => $quest->Agency->name,
      'link'   => $this->getHelper()->link( $quest )->getAbsoluteHref(),
      'email'  => $quest->Team->DmUser->email,
    ) )->send();
  }

  /**
   * @param dmWebRequest $request
   * @return myDoctrineRecord|Quest
   */
  protected function getQuestFromRequest( dmWebRequest $request )
  {
    /** @var dmFrontUser $sfUser  */
    $sfUser = $this->getUser();
    $dmUser = $sfUser->getDmUser();

    if ( ! $sfUser->isAuthenticated() )
    {
      $this->redirect403();
    }

    if ( ! $dmUser->isAgency() )
    {
      $this->redirect403();
    }

    $id = $request->getParameter( 'id', false );

    $quest = $id ? Quest::getById( $id ) : new Quest();

    if ( $id && $quest->agency_id != $dmUser->Agency->id )
    {
      $this->redirect403();
    }

    return $quest;
  }

}
