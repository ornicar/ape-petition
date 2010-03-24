<?php

class SignupActionForm extends dmForm
{

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

      $this->getEventDispatcher()->notify(new sfEvent($user, 'signup.action'));
    }
    
    $user->isLetterAction = true; // inscription à la newsletter action
    $user->save();

    return $user;
  }
}