<?php

/**
 * BaseDmSentMail
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $dm_mail_template_id
 * @property string $subject
 * @property clob $body
 * @property string $from_email
 * @property string $to_email
 * @property string $cc_email
 * @property string $bcc_email
 * @property string $reply_to_email
 * @property string $sender_email
 * @property string $strategy
 * @property string $transport
 * @property string $culture
 * @property clob $debug_string
 * @property DmMailTemplate $Template
 * 
 * @method integer        getDmMailTemplateId()    Returns the current record's "dm_mail_template_id" value
 * @method string         getSubject()             Returns the current record's "subject" value
 * @method clob           getBody()                Returns the current record's "body" value
 * @method string         getFromEmail()           Returns the current record's "from_email" value
 * @method string         getToEmail()             Returns the current record's "to_email" value
 * @method string         getCcEmail()             Returns the current record's "cc_email" value
 * @method string         getBccEmail()            Returns the current record's "bcc_email" value
 * @method string         getReplyToEmail()        Returns the current record's "reply_to_email" value
 * @method string         getSenderEmail()         Returns the current record's "sender_email" value
 * @method string         getStrategy()            Returns the current record's "strategy" value
 * @method string         getTransport()           Returns the current record's "transport" value
 * @method string         getCulture()             Returns the current record's "culture" value
 * @method clob           getDebugString()         Returns the current record's "debug_string" value
 * @method DmMailTemplate getTemplate()            Returns the current record's "Template" value
 * @method DmSentMail     setDmMailTemplateId()    Sets the current record's "dm_mail_template_id" value
 * @method DmSentMail     setSubject()             Sets the current record's "subject" value
 * @method DmSentMail     setBody()                Sets the current record's "body" value
 * @method DmSentMail     setFromEmail()           Sets the current record's "from_email" value
 * @method DmSentMail     setToEmail()             Sets the current record's "to_email" value
 * @method DmSentMail     setCcEmail()             Sets the current record's "cc_email" value
 * @method DmSentMail     setBccEmail()            Sets the current record's "bcc_email" value
 * @method DmSentMail     setReplyToEmail()        Sets the current record's "reply_to_email" value
 * @method DmSentMail     setSenderEmail()         Sets the current record's "sender_email" value
 * @method DmSentMail     setStrategy()            Sets the current record's "strategy" value
 * @method DmSentMail     setTransport()           Sets the current record's "transport" value
 * @method DmSentMail     setCulture()             Sets the current record's "culture" value
 * @method DmSentMail     setDebugString()         Sets the current record's "debug_string" value
 * @method DmSentMail     setTemplate()            Sets the current record's "Template" value
 * 
 * @package    bquest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDmSentMail extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('dm_sent_mail');
        $this->hasColumn('dm_mail_template_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('subject', 'string', 5000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 5000,
             ));
        $this->hasColumn('body', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
        $this->hasColumn('from_email', 'string', 5000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 5000,
             ));
        $this->hasColumn('to_email', 'string', 5000, array(
             'type' => 'string',
             'length' => 5000,
             ));
        $this->hasColumn('cc_email', 'string', 5000, array(
             'type' => 'string',
             'length' => 5000,
             ));
        $this->hasColumn('bcc_email', 'string', 5000, array(
             'type' => 'string',
             'length' => 5000,
             ));
        $this->hasColumn('reply_to_email', 'string', 5000, array(
             'type' => 'string',
             'length' => 5000,
             ));
        $this->hasColumn('sender_email', 'string', 5000, array(
             'type' => 'string',
             'length' => 5000,
             ));
        $this->hasColumn('strategy', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('transport', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('culture', 'string', 16, array(
             'type' => 'string',
             'length' => 16,
             ));
        $this->hasColumn('debug_string', 'clob', null, array(
             'type' => 'clob',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('DmMailTemplate as Template', array(
             'local' => 'dm_mail_template_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             'updated' => 
             array(
              'disabled' => true,
             ),
             ));
        $this->actAs($timestampable0);
    }
}