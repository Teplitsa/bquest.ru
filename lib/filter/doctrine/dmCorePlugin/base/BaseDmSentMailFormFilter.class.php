<?php

/**
 * DmSentMail filter form base class.
 *
 * @package    bquest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDmSentMailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dm_mail_template_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Template'), 'add_empty' => true)),
      'subject'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'body'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'from_email'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'to_email'            => new sfWidgetFormFilterInput(),
      'cc_email'            => new sfWidgetFormFilterInput(),
      'bcc_email'           => new sfWidgetFormFilterInput(),
      'reply_to_email'      => new sfWidgetFormFilterInput(),
      'sender_email'        => new sfWidgetFormFilterInput(),
      'strategy'            => new sfWidgetFormFilterInput(),
      'transport'           => new sfWidgetFormFilterInput(),
      'culture'             => new sfWidgetFormFilterInput(),
      'debug_string'        => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'dm_mail_template_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Template'), 'column' => 'id')),
      'subject'             => new sfValidatorPass(array('required' => false)),
      'body'                => new sfValidatorPass(array('required' => false)),
      'from_email'          => new sfValidatorPass(array('required' => false)),
      'to_email'            => new sfValidatorPass(array('required' => false)),
      'cc_email'            => new sfValidatorPass(array('required' => false)),
      'bcc_email'           => new sfValidatorPass(array('required' => false)),
      'reply_to_email'      => new sfValidatorPass(array('required' => false)),
      'sender_email'        => new sfValidatorPass(array('required' => false)),
      'strategy'            => new sfValidatorPass(array('required' => false)),
      'transport'           => new sfValidatorPass(array('required' => false)),
      'culture'             => new sfValidatorPass(array('required' => false)),
      'debug_string'        => new sfValidatorPass(array('required' => false)),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('dm_sent_mail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DmSentMail';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'dm_mail_template_id' => 'ForeignKey',
      'subject'             => 'Text',
      'body'                => 'Text',
      'from_email'          => 'Text',
      'to_email'            => 'Text',
      'cc_email'            => 'Text',
      'bcc_email'           => 'Text',
      'reply_to_email'      => 'Text',
      'sender_email'        => 'Text',
      'strategy'            => 'Text',
      'transport'           => 'Text',
      'culture'             => 'Text',
      'debug_string'        => 'Text',
      'created_at'          => 'Date',
    );
  }
}
