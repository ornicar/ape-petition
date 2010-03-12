<?php

require_once dirname(__FILE__).'/require_diem.php';
dm::start();

class ProjectConfiguration extends dmProjectConfiguration
{
  protected
  $user;

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

  public function listenToContextLoadedEvent(sfEvent $event)
  {
    $this->user = $event->getSubject()->getUser();
    
    $event->getSubject()->get('email_sender')->connect();

    $this->dispatcher->connect('form.post_configure', array($this, 'listenToFormPostConfigureEvent'));
  }

  public function listenToFormPostConfigureEvent(sfEvent $event)
  {
    $form = $event->getSubject();

    if($form instanceof DmContactForm)
    {
      $form->changeToHidden('petition_id');
      
      if($petition = $this->user->getLastPetition())
      {
        $form->setDefault('petition_id', $petition->id);
      }
    }
  }
}