<?php

/**
 * Quest filter form base class.
 *
 * @package    bquest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseQuestFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deadline'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'agency_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agency'), 'add_empty' => true)),
      'team_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Team'), 'add_empty' => true)),
      'dm_media_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DmMedia'), 'add_empty' => true)),
      'theme'           => new sfWidgetFormFilterInput(),
      'help_type'       => new sfWidgetFormFilterInput(),
      'hours'           => new sfWidgetFormFilterInput(),
      'rating'          => new sfWidgetFormFilterInput(),
      'report_text'     => new sfWidgetFormFilterInput(),
      'report_image_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ReportImage'), 'add_empty' => true)),
      'status'          => new sfWidgetFormFilterInput(),
      'address'         => new sfWidgetFormFilterInput(),
      'latlng'          => new sfWidgetFormFilterInput(),
      'video_url'       => new sfWidgetFormFilterInput(),
      'photo_url'       => new sfWidgetFormFilterInput(),
      'is_active'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'            => new sfValidatorPass(array('required' => false)),
      'description'     => new sfValidatorPass(array('required' => false)),
      'deadline'        => new sfValidatorPass(array('required' => false)),
      'agency_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agency'), 'column' => 'id')),
      'team_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Team'), 'column' => 'id')),
      'dm_media_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DmMedia'), 'column' => 'id')),
      'theme'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'help_type'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hours'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rating'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'report_text'     => new sfValidatorPass(array('required' => false)),
      'report_image_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ReportImage'), 'column' => 'id')),
      'status'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'address'         => new sfValidatorPass(array('required' => false)),
      'latlng'          => new sfValidatorPass(array('required' => false)),
      'video_url'       => new sfValidatorPass(array('required' => false)),
      'photo_url'       => new sfValidatorPass(array('required' => false)),
      'is_active'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('quest_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Quest';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'name'            => 'Text',
      'description'     => 'Text',
      'deadline'        => 'Text',
      'agency_id'       => 'ForeignKey',
      'team_id'         => 'ForeignKey',
      'dm_media_id'     => 'ForeignKey',
      'theme'           => 'Number',
      'help_type'       => 'Number',
      'hours'           => 'Number',
      'rating'          => 'Number',
      'report_text'     => 'Text',
      'report_image_id' => 'ForeignKey',
      'status'          => 'Number',
      'address'         => 'Text',
      'latlng'          => 'Text',
      'video_url'       => 'Text',
      'photo_url'       => 'Text',
      'is_active'       => 'Boolean',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
