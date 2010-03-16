<?php

require_once sfConfig::get('sf_lib_dir').'/vendor/OpenInviter/openinviter.php';

/**
 * Wrapper for openinviter http://openinviter.com/
 *
 * Offers a clean API
 * and exceptions
 */
class dmOpenInviter extends openinviter
{
  protected
  $providers;
  
  public function __construct(array $options = array())
  {
    parent::__construct();

    $this->providers = $this->getPlugins();
  }

  /**
   * Get a list of contacts for a given account
   *
   * @param string $user      account username
   * @param string $password  account password
   * @param string $plugin    plugin used to handle the provider (like "gmail")
   * @return array $contacts  list of contacts fetched
   */
  public function getContacts($user, $password, $plugin)
  {
    $this->startPlugin($plugin);

    if($error = $this->getInternalError())
    {
      throw new dmOpenInviterException($error);
    }

    if(!$this->login($user, $password))
    {
      if($error = $this->getInternalError())
      {
        throw new dmOpenInviterException($error);
      }

      throw new dmOpenInviterException('Unknown error occured when login '.$user);
    }

    if(!$contacts = $this->getMyContacts())
    {
      if($error = $this->getInternalError())
      {
        throw new dmOpenInviterException($error);
      }
      
      throw new dmOpenInviterException('Unable to fetch contacts for '.$user);
    }

    return $contacts;
  }
}