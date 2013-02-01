<?php

/**
 * DmRecordPermission filter form base class.
 *
 * @package    bquest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDmRecordPermissionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'secure_module' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'secure_action' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'secure_model'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'secure_record' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'   => new sfWidgetFormFilterInput(),
      'users_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmUser')),
      'groups_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmGroup')),
    ));

    $this->setValidators(array(
      'secure_module' => new sfValidatorPass(array('required' => false)),
      'secure_action' => new sfValidatorPass(array('required' => false)),
      'secure_model'  => new sfValidatorPass(array('required' => false)),
      'secure_record' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'   => new sfValidatorPass(array('required' => false)),
      'users_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmUser', 'required' => false)),
      'groups_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmGroup', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dm_record_permission_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addUsersListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.DmRecordPermissionUser DmRecordPermissionUser')
      ->andWhereIn('DmRecordPermissionUser.dm_user_id', $values)
    ;
  }

  public function addGroupsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.DmRecordPermissionGroup DmRecordPermissionGroup')
      ->andWhereIn('DmRecordPermissionGroup.dm_group_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'DmRecordPermission';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'secure_module' => 'Text',
      'secure_action' => 'Text',
      'secure_model'  => 'Text',
      'secure_record' => 'Number',
      'description'   => 'Text',
      'users_list'    => 'ManyKey',
      'groups_list'   => 'ManyKey',
    );
  }
}
