<?php
/**
 * User: makz
 * Date: 22.11.12
 * Time: 6:33
 */
class QuestCloseForm extends QuestForm
{

  protected static $useFields = array(
    'rating',
  );

  public static $labels = array(
    'rating' => 'Оценить отчет',
  );

  public function configure()
  {
    parent::configure();

    $this->useFields( self::$useFields );

    $this->widgetSchema->setLabels( self::$labels );
  }

  protected function doSave( $con = null )
  {
    $this->getObject()->status = Quest::STATUS_CLOSED;

    parent::doSave( $con );
  }

}
