<?php

class SignupPetitionForm extends dmForm
{
  protected
  $petition;

  public function __construct(Petition $petition)
  {
    $this->petition = $petition;

    parent::__construct();
  }

  public function configure()
  {
    $this->widgetSchema['email'] = new sfWidgetFormInputText();
    $this->widgetValidator['email'] = new sfValidatorEmail();

    $this->widgetSchema['petition_id'] = new sfWidgetFormInputHidden();
    $this->widgetValidator['petition_id'] = new sfValidatorDoctrineChoice(array(
      'model'     => 'Petition',
      'column'    => 'id',
      'required'  => false
    ));

    $this->setDefault('petition_id', $this->petition->id);
  }
}