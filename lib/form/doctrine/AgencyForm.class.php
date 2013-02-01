<?php

/**
 * Agency form.
 *
 * @package    bquest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 * @generator  Diem 5.4.0-DEV
 * @gen-file   /www/bquest/lib/vendor/diem/dmCorePlugin/data/generator/dmDoctrineForm/default/template/sfDoctrineFormTemplate.php */
class AgencyForm extends BaseAgencyForm
{

  protected static $useFields = array(
    'name',
    'description',
    'coordinator_name',
    'coordinator_telephone',
    'website',
    'dm_media_id_form',
  );

  public static $labels = array(
    'name'                  => 'Название организации',
    'description'           => 'Описание деятельности',
    'coordinator_name'      => 'Имя координатора',
    'coordinator_telephone' => 'Телефон координатора',
    'website'               => 'Адрес сайта',
  );

  public function configure()
  {
    parent::configure();

    $this->useFields( self::$useFields );
    $this->widgetSchema->setLabels( self::$labels );
  }

}