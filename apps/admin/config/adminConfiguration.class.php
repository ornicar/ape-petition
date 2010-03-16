<?php

require_once(dm::getDir().'/dmAdminPlugin/lib/config/dmAdminApplicationConfiguration.php');

class adminConfiguration extends dmAdminApplicationConfiguration
{
  public function configure()
  {
    $this->dispatcher->connect('dm.admin_homepage.filter_windows', array($this, 'listenToFilterWindowsEvent'));
  }

  public function listenToFilterWindowsEvent(sfEvent $event, array $windows)
  {
    $windows[1] = array(
      'visitChart' => $windows[1]['visitChart'],
      'contacts' => array($this, 'renderContacts'),
      'logChart' => $windows[1]['logChart'],
    );

    return $windows;
  }

  public function renderContacts(dmHelper $helper)
  {
    return $helper->renderComponent('dmContactAdmin', 'recent');
  }
}