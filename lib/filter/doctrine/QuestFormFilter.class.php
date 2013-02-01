<?php

/**
 * Quest filter form.
 *
 * @package    bquest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class QuestFormFilter extends BaseQuestFormFilter
{

  protected static $useFields = array(
    'theme',
    'help_type',
  );

  protected  static $labels = array(
    'theme' => 'Тематика',
    'help_type' => 'Вид помощи',
  );

  public function configure()
  {
    $this->disableLocalCSRFProtection();

    $this->widgetSchema[ 'help_type' ]    = new sfWidgetFormChoice( array(
      'choices' => Quest::getHelpTypeChoices(),
    ) );
    $this->validatorSchema[ 'help_type' ] = new sfValidatorChoice( array(
      'choices' => array_keys( Quest::getHelpTypeChoices() ),
      'required' => false,
    ) );

    $this->widgetSchema[ 'theme' ]    = new sfWidgetFormChoice( array(
      'choices' => Quest::getThemeChoices(),
    ) );
    $this->validatorSchema[ 'theme' ] = new sfValidatorChoice( array(
      'choices' => array_keys( Quest::getThemeChoices() ),
      'required' => false,
    ) );

    $this->useFields( self::$useFields );
    $this->widgetSchema->setLabels( self::$labels );
  }

  /**
   * Renders the widget schema associated with this form.
   *
   * @param array $attributes An array of HTML attributes
   *
   * @return string The rendered widget schema
   */
  public function render($attributes = array())
  {
    $attributes = dmString::toArray($attributes, true);

    return
      $this->open($attributes).
      '<ul class="dm_form_elements">'.
      '<li><h3>Фильтр</h3></li>'.
      $this->getFormFieldSchema()->render($attributes).
      '<li><button class="">Фильтровать</button></li>'.
      '</ul>'.
      $this->close();
  }

  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    if ( $taintedValues['theme'] == 0 )
    {
      unset( $taintedValues['theme'] );
    }

    if ( $taintedValues['help_type'] == 0 )
    {
      unset( $taintedValues['help_type'] );
    }

    parent::bind( $taintedValues, $taintedFiles );
  }

}
