<?php

/**
 * Team filter form base class.
 *
 * @package    bquest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTeamFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email1'      => new sfWidgetFormFilterInput(),
      'email2'      => new sfWidgetFormFilterInput(),
      'email3'      => new sfWidgetFormFilterInput(),
      'email4'      => new sfWidgetFormFilterInput(),
      'email5'      => new sfWidgetFormFilterInput(),
      'dm_media_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DmMedia'), 'add_empty' => true)),
      'dm_user_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DmUser'), 'add_empty' => true)),
      'is_active'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'email1'      => new sfValidatorPass(array('required' => false)),
      'email2'      => new sfValidatorPass(array('required' => false)),
      'email3'      => new sfValidatorPass(array('required' => false)),
      'email4'      => new sfValidatorPass(array('required' => false)),
      'email5'      => new sfValidatorPass(array('required' => false)),
      'dm_media_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DmMedia'), 'column' => 'id')),
      'dm_user_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DmUser'), 'column' => 'id')),
      'is_active'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('team_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Team';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'name'        => 'Text',
      'email1'      => 'Text',
      'email2'      => 'Text',
      'email3'      => 'Text',
      'email4'      => 'Text',
      'email5'      => 'Text',
      'dm_media_id' => 'ForeignKey',
      'dm_user_id'  => 'ForeignKey',
      'is_active'   => 'Boolean',
    );
  }
}
