<?php
/**
 * User: makz
 * Date: 19.11.12
 * Time: 1:17
 */

class UserTeamForm extends DmUserForm
{

  protected static $useFields = array(
    'username',
    'email',
    'password',
    'password_again',
  );

  public function configure()
  {
    parent::configure();

    $this->useFields( self::$useFields );
    $this->widgetSchema->setLabels( self::$labels );

    $team         = $this->getObject()->getTeam();
    $team->DmUser = $this->getObject();
    $teamForm     = new TeamForm( $team );
    $this->embedForm( 'team', $teamForm );
  }

  protected function doSave( $con = null )
  {
    if
    (
      $this->values[ 'team' ][ 'dm_media_id_form' ][ 'id' ] === null
      &&
      $this->values[ 'team' ][ 'dm_media_id_form' ][ 'file' ] === null
    )
    {
      unset( $this->embeddedForms[ 'team' ][ 'dm_media_id_form' ] );
    }

    $this->getObject()->setUserType( DmUser::TYPE_TEAM );

    parent::doSave( $con );
  }

}
