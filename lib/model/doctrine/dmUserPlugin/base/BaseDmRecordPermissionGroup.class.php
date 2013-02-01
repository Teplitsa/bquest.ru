<?php

/**
 * BaseDmRecordPermissionGroup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $dm_group_id
 * @property integer $dm_record_permission_id
 * @property DmGroup $Group
 * @property DmRecordPermission $Record
 * 
 * @method integer                 getDmGroupId()               Returns the current record's "dm_group_id" value
 * @method integer                 getDmRecordPermissionId()    Returns the current record's "dm_record_permission_id" value
 * @method DmGroup                 getGroup()                   Returns the current record's "Group" value
 * @method DmRecordPermission      getRecord()                  Returns the current record's "Record" value
 * @method DmRecordPermissionGroup setDmGroupId()               Sets the current record's "dm_group_id" value
 * @method DmRecordPermissionGroup setDmRecordPermissionId()    Sets the current record's "dm_record_permission_id" value
 * @method DmRecordPermissionGroup setGroup()                   Sets the current record's "Group" value
 * @method DmRecordPermissionGroup setRecord()                  Sets the current record's "Record" value
 * 
 * @package    bquest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDmRecordPermissionGroup extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('dm_record_permission_group');
        $this->hasColumn('dm_group_id', 'integer', 11, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 11,
             ));
        $this->hasColumn('dm_record_permission_id', 'integer', 11, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 11,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('DmGroup as Group', array(
             'local' => 'dm_group_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('DmRecordPermission as Record', array(
             'local' => 'dm_record_permission_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}