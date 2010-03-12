<?php

/**
 * ProductPetition form base class.
 *
 * @method ProductPetition getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseProductPetitionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'petition_id' => new sfWidgetFormInputHidden(),
      'product_id'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'petition_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'petition_id', 'required' => false)),
      'product_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'product_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('product_petition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductPetition';
  }

}
