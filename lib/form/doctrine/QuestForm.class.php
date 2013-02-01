<?php

/**
 * Quest form.
 *
 * @package    bquest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 * @generator  Diem 5.4.0-DEV
 * @gen-file   /www/bquest/lib/vendor/diem/dmCorePlugin/data/generator/dmDoctrineForm/default/template/sfDoctrineFormTemplate.php
 */
class QuestForm extends BaseQuestForm
{

  public static $labels = array(
    'name'      => 'Название',
    'theme'     => 'Тематика',
    'deadline'  => 'Дедлайн',
    'help_type' => 'Вид помощи',
    'address'   => 'Адрес',
  );

  public function configure()
  {
    parent::configure();

    $this->widgetSchema[ 'deadline' ]    = new sfWidgetFormDate( array(
      'format' => '%day%. %month%. %year%',
      'can_be_empty' => false,
    ) );
    $this->validatorSchema[ 'deadline' ] = new sfValidatorDate();

    $this->widgetSchema[ 'help_type' ]    = new sfWidgetFormChoice( array(
      'choices' => Quest::getHelpTypeChoices(),
    ) );
    $this->validatorSchema[ 'help_type' ] = new sfValidatorChoice( array(
      'choices' => array_keys( Quest::getHelpTypeChoices() ),
    ) );

    $this->widgetSchema[ 'theme' ]    = new sfWidgetFormChoice( array(
      'choices' => Quest::getThemeChoices(),
    ) );
    $this->validatorSchema[ 'theme' ] = new sfValidatorChoice( array(
      'choices' => array_keys( Quest::getThemeChoices() ),
    ) );

    $this->widgetSchema[ 'rating' ] = new sfWidgetFormSelectRadio( array(
      'choices' => Quest::$ratingChoices,
    ) );

    $this->widgetSchema[ 'latlng' ] = new sfWidgetFormInputHidden();

    $this->setWidget( 'description', new sfWidgetFormTextareaDmCkEditor() );

    $this->setDefault( 'deadline', date( 'd.m.Y', time() + 60*60*24*7 ) );

    $this->getWidget( 'team_id' )->addOption( 'add_empty', true );
    $this->getWidget( 'agency_id' )->addOption( 'add_empty', true );

    $this->widgetSchema->setLabels( self::$labels );

    $this->widgetSchema['status'] = new sfWidgetFormChoice( array(
      'choices' => array( 0 => '&mdash;' ) + Quest::$statusChoices,
    ) );
  }

}