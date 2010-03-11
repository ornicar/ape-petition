<?php

/**
 * PetitionVersion form base class.
 *
 * @method PetitionVersion getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePetitionVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'title'               => new sfWidgetFormInputText(),
      'text'                => new sfWidgetFormTextarea(),
      'slogan'              => new sfWidgetFormTextarea(),
      'is_active'           => new sfWidgetFormInputCheckbox(),
      'url_feed_actu'       => new sfWidgetFormInputText(),
      'url_feed_communique' => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'version'             => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'title'               => new sfValidatorString(array('max_length' => 255)),
      'text'                => new sfValidatorString(array('required' => false)),
      'slogan'              => new sfValidatorString(array('max_length' => 500)),
      'is_active'           => new sfValidatorBoolean(array('required' => false)),
      'url_feed_actu'       => new dmValidatorLinkUrl(array('max_length' => 255)),
      'url_feed_communique' => new dmValidatorLinkUrl(array('max_length' => 255)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'version'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'version', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('petition_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PetitionVersion';
  }

}
