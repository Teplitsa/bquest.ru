<?php

/**
 * DmZone filter form base class.
 *
 * @package    bquest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDmZoneFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dm_area_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Area'), 'add_empty' => true)),
      'css_class'  => new sfWidgetFormFilterInput(),
      'width'      => new sfWidgetFormFilterInput(),
      'position'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'dm_area_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Area'), 'column' => 'id')),
      'css_class'  => new sfValidatorPass(array('required' => false)),
      'width'      => new sfValidatorPass(array('required' => false)),
      'position'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('dm_zone_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DmZone';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'dm_area_id' => 'ForeignKey',
      'css_class'  => 'Text',
      'width'      => 'Text',
      'position'   => 'Number',
    );
  }
}
