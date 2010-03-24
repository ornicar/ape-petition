<?php

class OpenInviterContactImportForm extends dmForm
{
  protected
  $openInviter,
  $user;

  public function __construct(dmOpenInviter $openInviter, DmUser $user = null)
  {
    $this->openInviter  = $openInviter;
    $this->user         = $user;

    parent::__construct();
  }

  public function configure()
  {
    $this->setName('open_inviter');
    
    $this->widgetSchema['email'] = new sfWidgetFormInputText();
    $this->validatorSchema['email'] = new sfValidatorEmail();

    $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password'] = new sfValidatorString();

    $this->widgetSchema['provider'] = new sfWidgetFormSelect(array(
      'choices' => $this->getFormattedProviderList()
    ));
    
    $this->validatorSchema['provider'] = new sfValidatorChoice(array(
      'choices' => $this->getProviderList()
    ));

    $this->removeCsrfProtection();

    if($this->user)
    {
      $this->setDefault('email', $this->user->email);

      if(in_array($this->user->emailProvider, $this->getProviderList()))
      {
        $this->setDefault('provider', $this->user->emailProvider);
      }
    }

    $this->mergePostValidator(new sfValidatorCallback(array(
      'callback' => array($this, 'importContacts')
    )));
  }

  public function importContacts($validator, $values)
  {
    if($values['email'] && $values['password'] && $values['provider'])
    {
      try
      {
        $values['contacts'] = $this->openInviter->getContacts($values['email'], $values['password'], $values['provider']);
      }
      catch(Exception $e)
      {
        // probably bad email/password
        // throw an error bound to the email field
        throw new sfValidatorErrorSchema($validator, array('email' => new sfValidatorError($validator, "Impossible d'importer les contacts")));
      }
    }

    return $values;
  }

  public function save()
  {
  }

  protected function getFormattedProviderList()
  {
    $providers = array(0 => '- Choisir -');
    
    foreach($this->getProviderList() as $provider)
    {
      $providers[$provider] = ucfirst($provider);
    }

    return $providers;
  }

  protected function getProviderList()
  {
    return sfConfig::get('app_openinviter_providers', array(
      'gmail', 'yahoo'
    ));
  }
}