<?php

/**
 * Quest form base class.
 *
 * @method Quest getObject() Returns the current form's model object
 *
 * @package    bquest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 * @generator  Diem 5.4.0-DEV
 * @gen-file   /www/bquest/lib/vendor/diem/dmCorePlugin/data/generator/dmDoctrineForm/default/template/sfDoctrineFormGeneratedTemplate.php */
abstract class BaseQuestForm extends BaseFormDoctrine
{
  public function setup()
  {
    parent::setup();

		//column
		if($this->needsWidget('id')){
			$this->setWidget('id', new sfWidgetFormInputHidden());
			$this->setValidator('id', new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)));
		}
		//column
		if($this->needsWidget('name')){
			$this->setWidget('name', new sfWidgetFormInputText());
			$this->setValidator('name', new sfValidatorString(array('max_length' => 255)));
		}
		//column
		if($this->needsWidget('description')){
			$this->setWidget('description', new sfWidgetFormTextareaDmCkEditor());
			$this->setValidator('description', new sfValidatorString());
		}
		//column
		if($this->needsWidget('deadline')){
			$this->setWidget('deadline', new sfWidgetFormInputText());
			$this->setValidator('deadline', new sfValidatorString(array('max_length' => 255)));
		}
		//column
		if($this->needsWidget('theme')){
			$this->setWidget('theme', new sfWidgetFormInputText());
			$this->setValidator('theme', new sfValidatorInteger(array('required' => false)));
		}
		//column
		if($this->needsWidget('help_type')){
			$this->setWidget('help_type', new sfWidgetFormInputText());
			$this->setValidator('help_type', new sfValidatorInteger(array('required' => false)));
		}
		//column
		if($this->needsWidget('hours')){
			$this->setWidget('hours', new sfWidgetFormInputText());
			$this->setValidator('hours', new sfValidatorInteger(array('required' => false)));
		}
		//column
		if($this->needsWidget('rating')){
			$this->setWidget('rating', new sfWidgetFormInputText());
			$this->setValidator('rating', new sfValidatorInteger(array('required' => false)));
		}
		//column
		if($this->needsWidget('report_text')){
			$this->setWidget('report_text', new sfWidgetFormTextareaDmCkEditor());
			$this->setValidator('report_text', new sfValidatorString(array('required' => false)));
		}
		//column
		if($this->needsWidget('status')){
			$this->setWidget('status', new sfWidgetFormInputText());
			$this->setValidator('status', new sfValidatorInteger(array('required' => false)));
		}
		//column
		if($this->needsWidget('address')){
			$this->setWidget('address', new sfWidgetFormInputText());
			$this->setValidator('address', new sfValidatorString(array('max_length' => 255, 'required' => false)));
		}
		//column
		if($this->needsWidget('latlng')){
			$this->setWidget('latlng', new sfWidgetFormInputText());
			$this->setValidator('latlng', new sfValidatorString(array('max_length' => 255, 'required' => false)));
		}
		//column
		if($this->needsWidget('video_url')){
			$this->setWidget('video_url', new sfWidgetFormInputText());
			$this->setValidator('video_url', new sfValidatorString(array('max_length' => 255, 'required' => false)));
		}
		//column
		if($this->needsWidget('photo_url')){
			$this->setWidget('photo_url', new sfWidgetFormInputText());
			$this->setValidator('photo_url', new sfValidatorString(array('max_length' => 255, 'required' => false)));
		}
		//column
		if($this->needsWidget('is_active')){
			$this->setWidget('is_active', new sfWidgetFormInputCheckbox());
			$this->setValidator('is_active', new sfValidatorBoolean(array('required' => false)));
		}
		//column
		if($this->needsWidget('created_at')){
			$this->setWidget('created_at', new sfWidgetFormDateTime());
			$this->setValidator('created_at', new sfValidatorDateTime());
		}
		//column
		if($this->needsWidget('updated_at')){
			$this->setWidget('updated_at', new sfWidgetFormDateTime());
			$this->setValidator('updated_at', new sfValidatorDateTime());
		}



		//one to one
		if($this->needsWidget('agency_id')){
			$this->setWidget('agency_id', new sfWidgetFormDmDoctrineChoice(array('multiple' => false, 'model' => 'Agency', 'expanded' => false)));
			$this->setValidator('agency_id', new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'Agency', 'required' => true)));
		}
		//one to one
		if($this->needsWidget('team_id')){
			$this->setWidget('team_id', new sfWidgetFormDmDoctrineChoice(array('multiple' => false, 'model' => 'Team', 'expanded' => false)));
			$this->setValidator('team_id', new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'Team', 'required' => false)));
		}
		//one to one
		if($this->needsWidget('dm_media_id')){
			$this->setWidget('dm_media_id', new sfWidgetFormDmDoctrineChoice(array('multiple' => false, 'model' => 'DmMedia', 'expanded' => false)));
			$this->setValidator('dm_media_id', new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'DmMedia', 'required' => false)));
		}
		//one to one
		if($this->needsWidget('report_image_id')){
			$this->setWidget('report_image_id', new sfWidgetFormDmDoctrineChoice(array('multiple' => false, 'model' => 'DmMedia', 'expanded' => false)));
			$this->setValidator('report_image_id', new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'DmMedia', 'required' => false)));
		}



    /*
     * Embed Media form for dm_media_id
     */
    if($this->needsWidget('dm_media_id')){
      $this->embedForm('dm_media_id_form', $this->createMediaFormForDmMediaId());
      unset($this['dm_media_id']);
    }
    /*
     * Embed Media form for report_image_id
     */
    if($this->needsWidget('report_image_id')){
      $this->embedForm('report_image_id_form', $this->createMediaFormForReportImageId());
      unset($this['report_image_id']);
    }

    $this->widgetSchema->setNameFormat('quest[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'position'
    // override this method in your form to keep them
    parent::unsetAutoFields();
  }

  /**
   * Creates a DmMediaForm instance for dm_media_id
   *
   * @return DmMediaForm a form instance for the related media
   */
  protected function createMediaFormForDmMediaId()
  {
    return DmMediaForRecordForm::factory($this->object, 'dm_media_id', 'DmMedia', $this->validatorSchema['dm_media_id']->getOption('required'), $this);
  }
  /**
   * Creates a DmMediaForm instance for report_image_id
   *
   * @return DmMediaForm a form instance for the related media
   */
  protected function createMediaFormForReportImageId()
  {
    return DmMediaForRecordForm::factory($this->object, 'report_image_id', 'ReportImage', $this->validatorSchema['report_image_id']->getOption('required'), $this);
  }

  protected function doBind(array $values)
  {
    $values = $this->filterValuesByEmbeddedMediaForm($values, 'dm_media_id');
    $values = $this->filterValuesByEmbeddedMediaForm($values, 'report_image_id');
    parent::doBind($values);
  }
  
  public function processValues($values)
  {
    $values = parent::processValues($values);
    $values = $this->processValuesForEmbeddedMediaForm($values, 'dm_media_id');
    $values = $this->processValuesForEmbeddedMediaForm($values, 'report_image_id');
    return $values;
  }
  
  protected function doUpdateObject($values)
  {
    parent::doUpdateObject($values);
    $this->doUpdateObjectForEmbeddedMediaForm($values, 'dm_media_id', 'DmMedia');
    $this->doUpdateObjectForEmbeddedMediaForm($values, 'report_image_id', 'ReportImage');
  }

  public function getModelName()
  {
    return 'Quest';
  }

}
