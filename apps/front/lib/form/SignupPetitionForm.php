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
    $this->validatorSchema['email'] = new sfValidatorEmail();
  }

  public function save()
  {
    $email = $this->getValue('email');

    if(!$user = dmDb::table('DmUser')->findOneByEmail($email))
    {
      $user = new DmUser();
      $user->email = $email;
    }
    
    $user->save();

    return $user;
  }
}