<?php

require_once dirname(__FILE__).'/require_diem.php';
dm::start();

class ProjectConfiguration extends dmProjectConfiguration
{

  public function setup()
  {
    parent::setup();
    
    $this->enablePlugins(array(
      'dmTagPlugin'
    ));

    $this->setWebDir(sfConfig::get('sf_root_dir').'/public_html');

    $this->dispatcher->connect('signature.created', array($this, 'listenToSignatureCreatedEvent'));

    $this->dispatcher->connect('user.updated', array($this, 'listenToUserUpdatedEvent'));
  }

  public function listenToUserUpdatedEvent(sfEvent $e)
  {
    if(dmDb::table('DmUser')->getNbContacts() == (dmConfig::get('objectif_principal')-50))
    {
      // send email
    }
  }

  public function listenToSignatureCreatedEvent(sfEvent $e)
  {
    $signature  = $e->getSubject();
    $petition   = $signature->Petition;
    $action     = $petition->nextAction;

    if($action && $petition->nbSignatures == ($action->goal - 50))
    {
      // send email
    }
  }
}