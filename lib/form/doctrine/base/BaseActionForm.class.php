<?php

/**
 * Action form base class.
 *
 * @method Action getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseActionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'petition_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Petition'), 'add_empty' => false)),
      'title'       => new sfWidgetFormInputText(),
      'text'        => new sfWidgetFormTextarea(),
      'begin_at'    => new sfWidgetFormDateTime(),
      'goal'        => new sfWidgetFormInputText(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'version'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'petition_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Petition'))),
      'title'       => new sfValidatorString(array('max_length' => 255)),
      'text'        => new sfValidatorString(array('required' => false)),
      'begin_at'    => new sfValidatorDateTime(array('required' => false)),
      'goal'        => new sfValidatorInteger(array('required' => false)),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'version'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Action', 'column' => array('petition_id', 'title')))
    );

    $this->widgetSchema->setNameFormat('action[%s]');

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
    return 'Action';
  }

}