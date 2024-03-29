<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version1 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('agency', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'name' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '255',
             ),
             'coordinator_name' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'coordinator_telephone' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'website' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'dm_media_id' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'dm_user_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_unicode_ci',
             'charset' => 'utf8',
             ));
        $this->createTable('quest', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'name' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '255',
             ),
             'description' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '2048',
             ),
             'deadline' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '255',
             ),
             'agency_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             'team_id' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'dm_media_id' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'theme' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'help_type' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'hours' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'rating' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'report_text' => 
             array(
              'type' => 'string',
              'length' => '2048',
             ),
             'report_image_id' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'status' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_unicode_ci',
             'charset' => 'utf8',
             ));
        $this->createTable('team', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'name' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '255',
             ),
             'email1' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'email2' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'email3' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'email4' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'email5' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'dm_media_id' => 
             array(
              'type' => 'integer',
              'length' => '8',
             ),
             'dm_user_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_unicode_ci',
             'charset' => 'utf8',
             ));
        $this->addColumn('dm_user', 'user_type', 'integer', '8', array(
             ));
    }

    public function down()
    {
        $this->dropTable('agency');
        $this->dropTable('quest');
        $this->dropTable('team');
        $this->removeColumn('dm_user', 'user_type');
    }
}