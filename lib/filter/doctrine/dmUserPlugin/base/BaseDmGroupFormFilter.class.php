<?php

/**
 * DmGroup filter form base class.
 *
 * @package    bquest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDmGroupFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                                  => new sfWidgetFormFilterInput(),
      'description'                           => new sfWidgetFormFilterInput(),
      'created_at'                            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'users_list'                            => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmUser')),
      'permissions_list'                      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmPermission')),
      'records_list'                          => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmRecordPermission')),
      'records_permissions_associations_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmRecordPermissionAssociation')),
    ));

    $this->setValidators(array(
      'name'                                  => new sfValidatorPass(array('required' => false)),
      'description'                           => new sfValidatorPass(array('required' => false)),
      'created_at'                            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'users_list'                            => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmUser', 'required' => false)),
      'permissions_list'                      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmPermission', 'required' => false)),
      'records_list'                          => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmRecordPermission', 'required' => false)),
      'records_permissions_associations_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmRecordPermissionAssociation', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dm_group_filters[%s]');

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
      ->leftJoin($query->getRootAlias().'.DmUserGroup DmUserGroup')
      ->andWhereIn('DmUserGroup.dm_user_id', $values)
    ;
  }

  public function addPermissionsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.DmGroupPermission DmGroupPermission')
      ->andWhereIn('DmGroupPermission.dm_permission_id', $values)
    ;
  }

  public function addRecordsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('DmRecordPermissionGroup.dm_record_permission_id', $values)
    ;
  }

  public function addRecordsPermissionsAssociationsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.DmRecordPermissionAssociationGroup DmRecordPermissionAssociationGroup')
      ->andWhereIn('DmRecordPermissionAssociationGroup.dm_record_permission_association_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'DmGroup';
  }

  public function getFields()
  {
    return array(
      'id'                                    => 'Number',
      'name'                                  => 'Text',
      'description'                           => 'Text',
      'created_at'                            => 'Date',
      'updated_at'                            => 'Date',
      'users_list'                            => 'ManyKey',
      'permissions_list'                      => 'ManyKey',
      'records_list'                          => 'ManyKey',
      'records_permissions_associations_list' => 'ManyKey',
    );
  }
}
