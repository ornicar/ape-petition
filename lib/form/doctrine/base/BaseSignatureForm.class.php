<?php

/**
 * Signature form base class.
 *
 * @method Signature getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSignatureForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'dm_user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'petition_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Petition'), 'add_empty' => false)),
      'collection_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Collection'), 'add_empty' => true)),
      'created_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'dm_user_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'petition_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Petition'))),
      'collection_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Collection'), 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('signature[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Signature';
  }

}
