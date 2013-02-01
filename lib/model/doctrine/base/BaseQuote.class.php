<?php

/**
 * BaseQuote
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $author
 * @property string $text
 * @property boolean $is_active
 * 
 * @method string  getAuthor()    Returns the current record's "author" value
 * @method string  getText()      Returns the current record's "text" value
 * @method boolean getIsActive()  Returns the current record's "is_active" value
 * @method Quote   setAuthor()    Sets the current record's "author" value
 * @method Quote   setText()      Sets the current record's "text" value
 * @method Quote   setIsActive()  Sets the current record's "is_active" value
 * 
 * @package    bquest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseQuote extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('quote');
        $this->hasColumn('author', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('text', 'string', 2048, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 2048,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'default' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}