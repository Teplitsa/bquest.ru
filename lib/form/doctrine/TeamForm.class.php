<?php

/**
 * Team form.
 *
 * @package    bquest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 * @generator  Diem 5.4.0-DEV
 * @gen-file   /www/bquest/lib/vendor/diem/dmCorePlugin/data/generator/dmDoctrineForm/default/template/sfDoctrineFormTemplate.php */
class TeamForm extends BaseTeamForm
{

  public static $useFields = array(
    'name',
    'email1',
    'email2',
    'email3',
    'email4',
    'email5',
    'dm_media_id_form',
  );

  public static $labels = array(
    'name' => 'Название',
    'email1' => 'Email участника №1',
    'email2' => 'Email участника №2',
    'email3' => 'Email участника №3',
    'email4' => 'Email участника №4',
    'email5' => 'Email участника №5',
  );

  public function configure()
  {
    parent::configure();

    $this->useFields( self::$useFields );
    $this->widgetSchema->setLabels( self::$labels );
  }

}