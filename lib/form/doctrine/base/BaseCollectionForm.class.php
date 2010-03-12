<?php

/**
 * Collection form base class.
 *
 * @method Collection getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseCollectionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'dm_user_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'petition_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Petition'), 'add_empty' => false)),
      'title'       => new sfWidgetFormInputText(),
      'text'        => new sfWidgetFormTextarea(),
      'goal'        => new sfWidgetFormInputText(),
      'hash_code'   => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'version'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'dm_user_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'petition_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Petition'))),
      'title'       => new sfValidatorString(array('max_length' => 255)),
      'text'        => new sfValidatorString(array('required' => false)),
      'goal'        => new sfValidatorInteger(array('required' => false)),
      'hash_code'   => new sfValidatorString(array('max_length' => 8)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'version'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Collection', 'column' => array('hash_code')))
    );

    $this->widgetSchema->setNameFormat('collection[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'position'
    // override this method in your form to keep them
    parent::unsetAutoFields();
  }


  protected function doBind(array $values)
  {
    parent::doBind($values);
  }
  
  public function processValues($values)
  {
    $values = parent::processValues($values);
    return $values;
  }
  
  protected function doUpdateObject($values)
  {
    parent::doUpdateObject($values);
  }

  public function getModelName()
  {
    return 'Collection';
  }

}