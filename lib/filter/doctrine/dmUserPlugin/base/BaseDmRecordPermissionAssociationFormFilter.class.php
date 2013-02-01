<?php

/**
 * DmRecordPermissionAssociation filter form base class.
 *
 * @package    bquest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDmRecordPermissionAssociationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dm_secure_action' => new sfWidgetFormFilterInput(),
      'dm_secure_module' => new sfWidgetFormFilterInput(),
      'dm_secure_model'  => new sfWidgetFormFilterInput(),
      'groups_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmGroup')),
      'users_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmUser')),
    ));

    $this->setValidators(array(
      'dm_secure_action' => new sfValidatorPass(array('required' => false)),
      'dm_secure_module' => new sfValidatorPass(array('required' => false)),
      'dm_secure_model'  => new sfValidatorPass(array('required' => false)),
      'groups_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmGroup', 'required' => false)),
      'users_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dm_record_permission_association_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
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
      ->leftJoin($query->getRootAlias().'.DmRecordPermissionAssociationGroup DmRecordPermissionAssociationGroup')
      ->andWhereIn('DmRecordPermissionAssociationGroup.dm_group_id', $values)
    ;
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
      ->leftJoin($query->getRootAlias().'.DmRecordPermissionAssociationUser DmRecordPermissionAssociationUser')
      ->andWhereIn('DmRecordPermissionAssociationUser.dm_user_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'DmRecordPermissionAssociation';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'dm_secure_action' => 'Text',
      'dm_secure_module' => 'Text',
      'dm_secure_model'  => 'Text',
      'groups_list'      => 'ManyKey',
      'users_list'       => 'ManyKey',
    );
  }
}
