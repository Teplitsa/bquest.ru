<?php
/**
 * User: makz
 * Date: 22.11.12
 * Time: 6:33
 */
class QuestCompleteForm extends QuestForm
{

  protected static $useFields = array(
    'hours',
    'video_url',
    'photo_url',
    'report_text',
    'report_image_id_form',
  );

  public static $labels = array(
    'hours'       => 'Потрачено часов',
    'video_url'   => 'Ссылка на видео-отчет',
    'photo_url'   => 'Ссылка на фото-отчет',
    'report_text' => 'Отчет',
  );

  public function configure()
  {
    parent::configure();

    $this->useFields( self::$useFields );

    $this->widgetSchema->setLabels( self::$labels );
  }

  protected function doSave( $con = null )
  {
    $this->getObject()->status = Quest::STATUS_READY;

    parent::doSave( $con );
  }

}
