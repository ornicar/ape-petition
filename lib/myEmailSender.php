<?php

class myEmailSender
{
  protected
  $container,
  $dispatcher;

  public function __construct(dmBaseServiceContainer $container, sfEventDispatcher $dispatcher)
  {
    $this->container  = $container;
    $this->dispatcher = $dispatcher;
  }

  public function connect()
  {
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