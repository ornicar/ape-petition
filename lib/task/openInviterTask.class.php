<?php

class openInviterTask extends dmBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    parent::configure();
    
    $this->addOptions(array(
      new sfCommandOption('user', null, sfCommandOption::PARAMETER_REQUIRED, 'The user name'),
      new sfCommandOption('password', null, sfCommandOption::PARAMETER_REQUIRED, 'The password'),
      new sfCommandOption('provider', null, sfCommandOption::PARAMETER_REQUIRED, 'The provider')
    ));

    $this->namespace = 'my';
    $this->name = 'open-inviter';
    $this->briefDescription = 'Try Open Inviter';

    $this->detailedDescription = $this->briefDescription;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $oi = new dmOpenInviter();
  }
}