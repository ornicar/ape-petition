<?php

require_once(dm::getDir().'/dmFrontPlugin/lib/config/dmFrontApplicationConfiguration.php');

class frontConfiguration extends dmFrontApplicationConfiguration
{
  protected
  $user;
  
  public function configure()
  {
    $this->dispatcher->connect('dm.context.loaded', array($this, 'listenToContextLoadedEvent'));
  }

  public function listenToContextLoadedEvent(sfEvent $event)
  {
    $this->user = $event->getSubject()->getUser();

    $event->getSubject()->get('email_sender')->connect();

    $this->dispatcher->connect('dm.context.change_page', array($this, 'listenToChangePageEvent'));

    $this->dispatcher->connect('form.post_configure', array($this, 'listenToFormPostConfigureEvent'));
  }

  public function listenToChangePageEvent(sfEvent $event)
  {
    $page = $event['page'];

    switch($page->module.'/'.$page->action)
    {
      case 'main/root':
        $this->user->setLastPetition(null);
        $this->user->setLastCollection(null);
        break;
      case 'petition/show':
        $this->user->setLastPetition($page->getRecord());
        break;
      case 'collection/show':
        $this->user->setLastCollection($page->getRecord());
        break;
    }
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
    elseif($form instanceof SignupPetitionForm)
    {
      if($collection = $this->user->getLastCollection())
      {
        $form->setDefault('collection_id', $collection->id);
      }
    }
  }
}