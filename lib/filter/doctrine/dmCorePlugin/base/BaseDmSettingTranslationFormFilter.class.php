<?php

/**
 * DmSettingTranslation filter form base class.
 *
 * @package    bquest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDmSettingTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'   => new sfWidgetFormFilterInput(),
      'value'         => new sfWidgetFormFilterInput(),
      'default_value' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'description'   => new sfValidatorPass(array('required' => false)),
      'value'         => new sfValidatorPass(array('required' => false)),
      'default_value' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dm_setting_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DmSettingTranslation';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'description'   => 'Text',
      'value'         => 'Text',
      'default_value' => 'Text',
      'lang'          => 'Text',
    );
  }
}
