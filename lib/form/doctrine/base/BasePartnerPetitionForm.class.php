<?php

/**
 * PartnerPetition form base class.
 *
 * @method PartnerPetition getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePartnerPetitionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'partner_id'  => new sfWidgetFormInputHidden(),
      'petition_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'partner_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'partner_id', 'required' => false)),
      'petition_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'petition_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('partner_petition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PartnerPetition';
  }

}
