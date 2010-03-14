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

    $this->widgetSchema['collection_id'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['collection_id'] = new sfValidatorDoctrineChoice(array(
      'model'     => 'Collection',
      'column'    => 'id',
      'required'  => false
    ));
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

    if($collectionId = $this->getValue('collection_id'))
    {
      $collection = dmDb::table('Collection')->find($collectionId);
    }
    else
    {
      $collection = null;
    }

    $user->signPetition($this->petition, $collection);

    return $user;
  }
}