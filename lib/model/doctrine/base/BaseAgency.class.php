<?php

/**
 * BaseAgency
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $description
 * @property string $coordinator_name
 * @property string $coordinator_telephone
 * @property string $website
 * @property integer $dm_media_id
 * @property integer $dm_user_id
 * @property boolean $is_active
 * @property DmUser $DmUser
 * @property DmMedia $DmMedia
 * @property Doctrine_Collection $Quests
 * 
 * @method string              getName()                  Returns the current record's "name" value
 * @method string              getDescription()           Returns the current record's "description" value
 * @method string              getCoordinatorName()       Returns the current record's "coordinator_name" value
 * @method string              getCoordinatorTelephone()  Returns the current record's "coordinator_telephone" value
 * @method string              getWebsite()               Returns the current record's "website" value
 * @method integer             getDmMediaId()             Returns the current record's "dm_media_id" value
 * @method integer             getDmUserId()              Returns the current record's "dm_user_id" value
 * @method boolean             getIsActive()              Returns the current record's "is_active" value
 * @method DmUser              getDmUser()                Returns the current record's "DmUser" value
 * @method DmMedia             getDmMedia()               Returns the current record's "DmMedia" value
 * @method Doctrine_Collection getQuests()                Returns the current record's "Quests" collection
 * @method Agency              setName()                  Sets the current record's "name" value
 * @method Agency              setDescription()           Sets the current record's "description" value
 * @method Agency              setCoordinatorName()       Sets the current record's "coordinator_name" value
 * @method Agency              setCoordinatorTelephone()  Sets the current record's "coordinator_telephone" value
 * @method Agency              setWebsite()               Sets the current record's "website" value
 * @method Agency              setDmMediaId()             Sets the current record's "dm_media_id" value
 * @method Agency              setDmUserId()              Sets the current record's "dm_user_id" value
 * @method Agency              setIsActive()              Sets the current record's "is_active" value
 * @method Agency              setDmUser()                Sets the current record's "DmUser" value
 * @method Agency              setDmMedia()               Sets the current record's "DmMedia" value
 * @method Agency              setQuests()                Sets the current record's "Quests" collection
 * 
 * @package    bquest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAgency extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('agency');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', 2048, array(
             'type' => 'string',
             'length' => 2048,
             ));
        $this->hasColumn('coordinator_name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('coordinator_telephone', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('website', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('dm_media_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('dm_user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('DmUser', array(
             'local' => 'dm_user_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('DmMedia', array(
             'local' => 'dm_media_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasMany('Quest as Quests', array(
             'local' => 'id',
             'foreign' => 'agency_id'));
    }
}