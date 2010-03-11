<?php

/**
 * ProduitPetition form base class.
 *
 * @method ProduitPetition getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseProduitPetitionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'petition_id' => new sfWidgetFormInputHidden(),
      'produit_id'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'petition_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'petition_id', 'required' => false)),
      'produit_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'produit_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('produit_petition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProduitPetition';
  }

}
