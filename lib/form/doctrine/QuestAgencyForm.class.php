<?php
/**
 * Created by JetBrains PhpStorm.
 * User: makz
 * Date: 19.11.12
 * Time: 14:38
 * To change this template use File | Settings | File Templates.
 */
class QuestAgencyForm extends QuestForm
{

  protected static $useFields = array(
    'name',
    'theme',
    'deadline',
    'help_type',
    'description',
    'address',
    'dm_media_id_form',
  );

  public function configure()
  {
    parent::configure();

    $this->useFields( self::$useFields );
  }

  protected function doSave( $con = null )
  {
    if ( ! $this->getObject()->agency_id )
    {
      $this->getObject()->agency_id = dm::getUser()->getDmUser()->getAgency();
    }

    parent::doSave( $con );
  }

}
