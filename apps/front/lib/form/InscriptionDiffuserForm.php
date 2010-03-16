<?php

class InscriptionDiffuserForm extends dmForm
{
  protected
  $user;

  public function __construct(DmUser $user)
  {
    $this->user = $user;

    parent::__construct();
  }
  
  public function configure()
  {
    $this->widgetSchema['message'] = new sfWidgetFormTextarea();
    $this->validatorSchema['message'] = new sfValidatorString();

    $this->widgetSchema['contacts'] = new sfWidgetFormTextarea();
    $this->validatorSchema['contacts'] = new sfValidatorString();
  }
}