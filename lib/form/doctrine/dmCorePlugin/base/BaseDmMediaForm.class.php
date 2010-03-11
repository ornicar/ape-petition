<?php

/**
 * DmMedia form base class.
 *
 * @method DmMedia getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDmMediaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'dm_media_folder_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Folder'), 'add_empty' => false)),
      'file'               => new sfWidgetFormInputText(),
      'legend'             => new sfWidgetFormInputText(),
      'author'             => new sfWidgetFormInputText(),
      'license'            => new sfWidgetFormInputText(),
      'mime'               => new sfWidgetFormInputText(),
      'size'               => new sfWidgetFormInputText(),
      'dimensions'         => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'dm_media_folder_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Folder'))),
      'file'               => new sfValidatorString(array('max_length' => 255)),
      'legend'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'author'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'license'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mime'               => new sfValidatorString(array('max_length' => 63)),
      'size'               => new sfValidatorInteger(array('required' => false)),
      'dimensions'         => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'DmMedia', 'column' => array('dm_media_folder_id', 'file')))
    );

    $this->widgetSchema->setNameFormat('dm_media[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DmMedia';
  }

}
