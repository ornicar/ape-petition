<?php

/**
 * CollectionVersion form base class.
 *
 * @method CollectionVersion getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCollectionVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'dm_user_id'  => new sfWidgetFormInputText(),
      'petition_id' => new sfWidgetFormInputText(),
      'title'       => new sfWidgetFormInputText(),
      'text'        => new sfWidgetFormTextarea(),
      'goal'        => new sfWidgetFormInputText(),
      'hash_code'   => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'version'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'dm_user_id'  => new sfValidatorInteger(),
      'petition_id' => new sfValidatorInteger(),
      'title'       => new sfValidatorString(array('max_length' => 255)),
      'text'        => new sfValidatorString(array('required' => false)),
      'goal'        => new sfValidatorInteger(array('required' => false)),
      'hash_code'   => new sfValidatorString(array('max_length' => 8)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'version'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'version', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('collection_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CollectionVersion';
  }

}
