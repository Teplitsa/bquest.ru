<?php

/**
 * DmMailTemplateTranslation filter form base class.
 *
 * @package    bquest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDmMailTemplateTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'     => new sfWidgetFormFilterInput(),
      'subject'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'body'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'from_email'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'to_email'        => new sfWidgetFormFilterInput(),
      'cc_email'        => new sfWidgetFormFilterInput(),
      'bcc_email'       => new sfWidgetFormFilterInput(),
      'reply_to_email'  => new sfWidgetFormFilterInput(),
      'sender_email'    => new sfWidgetFormFilterInput(),
      'list_unsuscribe' => new sfWidgetFormFilterInput(),
      'is_html'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_active'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'description'     => new sfValidatorPass(array('required' => false)),
      'subject'         => new sfValidatorPass(array('required' => false)),
      'body'            => new sfValidatorPass(array('required' => false)),
      'from_email'      => new sfValidatorPass(array('required' => false)),
      'to_email'        => new sfValidatorPass(array('required' => false)),
      'cc_email'        => new sfValidatorPass(array('required' => false)),
      'bcc_email'       => new sfValidatorPass(array('required' => false)),
      'reply_to_email'  => new sfValidatorPass(array('required' => false)),
      'sender_email'    => new sfValidatorPass(array('required' => false)),
      'list_unsuscribe' => new sfValidatorPass(array('required' => false)),
      'is_html'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_active'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('dm_mail_template_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DmMailTemplateTranslation';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'description'     => 'Text',
      'subject'         => 'Text',
      'body'            => 'Text',
      'from_email'      => 'Text',
      'to_email'        => 'Text',
      'cc_email'        => 'Text',
      'bcc_email'       => 'Text',
      'reply_to_email'  => 'Text',
      'sender_email'    => 'Text',
      'list_unsuscribe' => 'Text',
      'is_html'         => 'Boolean',
      'is_active'       => 'Boolean',
      'lang'            => 'Text',
    );
  }
}
