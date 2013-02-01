<?php

/**
 * quest admin form
 *
 * @package    bquest
 * @subpackage quest
 * @author     Your name here
 */
class QuestAdminForm extends QuestForm
{

  public function configure()
  {
    parent::configure();

    $this->setWidget('latlng', new sfWidgetFormInputText());
  }

}