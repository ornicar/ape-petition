<?php

require_once dirname(__FILE__).'/require_diem.php';
dm::start();

class ProjectConfiguration extends dmProjectConfiguration
{

  public function setup()
  {
    parent::setup();
    
    $this->enablePlugins(array(
      'dmTagPlugin',
      'dmFlowPlayerPlugin',
      'dmContactPlugin'
    ));

    $this->setWebDir(sfConfig::get('sf_root_dir').'/public_html');

    $this->dispatcher->connect('dm.context.loaded', array($this, 'listenToContextLoadedEvent'));
  }

  public function listenToContextLoadedEvent(sfEvent $e)
  {
    $e->getSubject()->get('email_sender')->connect();
  }
}