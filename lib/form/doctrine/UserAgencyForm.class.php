<?php
/**
 * User: makz
 * Date: 19.11.12
 * Time: 1:17
 */

class UserAgencyForm extends DmUserForm
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

    $agency         = $this->getObject()->getAgency();
    $agency->DmUser = $this->getObject();
    $agencyForm     = new AgencyForm( $agency );
    $this->embedForm( 'agency', $agencyForm );
  }

  protected function doSave( $con = null )
  {
    if
    (
      $this->values[ 'agency' ][ 'dm_media_id_form' ][ 'id' ] === null
      &&
      $this->values[ 'agency' ][ 'dm_media_id_form' ][ 'file' ] === null
    )
    {
      unset( $this->embeddedForms[ 'agency' ][ 'dm_media_id_form' ] );
    }

    $this->getObject()->setUserType( DmUser::TYPE_AGENCY );

    parent::doSave( $con );
  }

}