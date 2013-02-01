<?php

/**
 * Agency filter form base class.
 *
 * @package    bquest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAgencyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'           => new sfWidgetFormFilterInput(),
      'coordinator_name'      => new sfWidgetFormFilterInput(),
      'coordinator_telephone' => new sfWidgetFormFilterInput(),
      'website'               => new sfWidgetFormFilterInput(),
      'dm_media_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DmMedia'), 'add_empty' => true)),
      'dm_user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DmUser'), 'add_empty' => true)),
      'is_active'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'name'                  => new sfValidatorPass(array('required' => false)),
      'description'           => new sfValidatorPass(array('required' => false)),
      'coordinator_name'      => new sfValidatorPass(array('required' => false)),
      'coordinator_telephone' => new sfValidatorPass(array('required' => false)),
      'website'               => new sfValidatorPass(array('required' => false)),
      'dm_media_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DmMedia'), 'column' => 'id')),
      'dm_user_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DmUser'), 'column' => 'id')),
      'is_active'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('agency_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Agency';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'name'                  => 'Text',
      'description'           => 'Text',
      'coordinator_name'      => 'Text',
      'coordinator_telephone' => 'Text',
      'website'               => 'Text',
      'dm_media_id'           => 'ForeignKey',
      'dm_user_id'            => 'ForeignKey',
      'is_active'             => 'Boolean',
    );
  }
}
