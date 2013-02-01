<?php

/**
 * DmPageView filter form base class.
 *
 * @package    bquest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDmPageViewFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'module'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'action'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dm_layout_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Layout'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'module'       => new sfValidatorPass(array('required' => false)),
      'action'       => new sfValidatorPass(array('required' => false)),
      'dm_layout_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Layout'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('dm_page_view_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DmPageView';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'module'       => 'Text',
      'action'       => 'Text',
      'dm_layout_id' => 'ForeignKey',
    );
  }
}
