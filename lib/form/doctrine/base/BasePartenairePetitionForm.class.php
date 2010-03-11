<?php

/**
 * PartenairePetition form base class.
 *
 * @method PartenairePetition getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePartenairePetitionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'petition_id'   => new sfWidgetFormInputHidden(),
      'partenaire_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'petition_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'petition_id', 'required' => false)),
      'partenaire_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'partenaire_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('partenaire_petition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PartenairePetition';
  }

}
