<?php

/**
 * Team form base class.
 *
 * @method Team getObject() Returns the current form's model object
 *
 * @package    bquest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 * @generator  Diem 5.4.0-DEV
 * @gen-file   /www/bquest/lib/vendor/diem/dmCorePlugin/data/generator/dmDoctrineForm/default/template/sfDoctrineFormGeneratedTemplate.php */
abstract class BaseTeamForm extends BaseFormDoctrine
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
		if($this->needsWidget('email1')){
			$this->setWidget('email1', new sfWidgetFormInputText());
			$this->setValidator('email1', new sfValidatorString(array('max_length' => 255, 'required' => false)));
		}
		//column
		if($this->needsWidget('email2')){
			$this->setWidget('email2', new sfWidgetFormInputText());
			$this->setValidator('email2', new sfValidatorString(array('max_length' => 255, 'required' => false)));
		}
		//column
		if($this->needsWidget('email3')){
			$this->setWidget('email3', new sfWidgetFormInputText());
			$this->setValidator('email3', new sfValidatorString(array('max_length' => 255, 'required' => false)));
		}
		//column
		if($this->needsWidget('email4')){
			$this->setWidget('email4', new sfWidgetFormInputText());
			$this->setValidator('email4', new sfValidatorString(array('max_length' => 255, 'required' => false)));
		}
		//column
		if($this->needsWidget('email5')){
			$this->setWidget('email5', new sfWidgetFormInputText());
			$this->setValidator('email5', new sfValidatorString(array('max_length' => 255, 'required' => false)));
		}
		//column
		if($this->needsWidget('is_active')){
			$this->setWidget('is_active', new sfWidgetFormInputCheckbox());
			$this->setValidator('is_active', new sfValidatorBoolean(array('required' => false)));
		}


		//one to many
		if($this->needsWidget('quests_list')){
			$this->setWidget('quests_list', new sfWidgetFormDmPaginatedDoctrineChoice(array('multiple' => true, 'model' => 'Quest', 'expanded' => true)));
			$this->setValidator('quests_list', new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Quest', 'required' => false)));
		}

		//one to one
		if($this->needsWidget('dm_user_id')){
			$this->setWidget('dm_user_id', new sfWidgetFormDmDoctrineChoice(array('multiple' => false, 'model' => 'DmUser', 'expanded' => false)));
			$this->setValidator('dm_user_id', new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'DmUser', 'required' => true)));
		}
		//one to one
		if($this->needsWidget('dm_media_id')){
			$this->setWidget('dm_media_id', new sfWidgetFormDmDoctrineChoice(array('multiple' => false, 'model' => 'DmMedia', 'expanded' => false)));
			$this->setValidator('dm_media_id', new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'DmMedia', 'required' => false)));
		}



    /*
     * Embed Media form for dm_media_id
     */
    if($this->needsWidget('dm_media_id')){
      $this->embedForm('dm_media_id_form', $this->createMediaFormForDmMediaId());
      unset($this['dm_media_id']);
    }

    $this->widgetSchema->setNameFormat('team[%s]');

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

  protected function doBind(array $values)
  {
    $values = $this->filterValuesByEmbeddedMediaForm($values, 'dm_media_id');
    parent::doBind($values);
  }
  
  public function processValues($values)
  {
    $values = parent::processValues($values);
    $values = $this->processValuesForEmbeddedMediaForm($values, 'dm_media_id');
    return $values;
  }
  
  protected function doUpdateObject($values)
  {
    parent::doUpdateObject($values);
    $this->doUpdateObjectForEmbeddedMediaForm($values, 'dm_media_id', 'DmMedia');
  }

  public function getModelName()
  {
    return 'Team';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['quests_list']))
    {
        $this->setDefault('quests_list', array_merge((array)$this->getDefault('quests_list'),$this->object->Quests->getPrimaryKeys()));
    }

  }

  protected function doSave($con = null)
  {
    $this->saveQuestsList($con);

    parent::doSave($con);
  }

  public function saveQuestsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['quests_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Quests->getPrimaryKeys();
    $values = $this->getValue('quests_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Quests', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Quests', array_values($link));
    }
  }

}
