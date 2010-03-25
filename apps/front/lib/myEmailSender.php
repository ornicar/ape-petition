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

    $this->dispatcher->connect('signup.action', array($this, 'listenToSignupActionEvent'));

    $this->dispatcher->connect('signup.petition', array($this, 'listenToSignupPetitionEvent'));

    $this->dispatcher->connect('user.updated', array($this, 'listenToUserUpdatedEvent'));

    $this->dispatcher->connect('collection.created', array($this, 'listenToCollectionCreatedEvent'));
  }

  public function listenToCollectionCreatedEvent(sfEvent $event)
  {
    $collection = $event->getSubject();

    try
    {
      $this->createMail()
      ->setTemplate('creation_collecte')
      ->addValues($collection, 'collecte_')
      ->addValues($collection->User, 'utilisateur_')
      ->addValues($collection->Petition, 'petition_')
      ->addValues(array(
        'collecte_url' => $this->getLink($collection)->getAbsoluteHref(),
        'collecte_edit_url' => $this->getLink($collection)->param('edit', $collection->hashCode)->getAbsoluteHref()
      ))
      ->send();
    }
    catch(Exception $e)
    {
      if(sfConfig::get('sf_debug'))
      {
        throw $e;
      }
    }
  }

  public function listenToSignupActionEvent(sfEvent $event)
  {
    try
    {
      $user = $event->getSubject();

      $this->createMail()
      ->setTemplate('inscription_confirmation_global')
      ->addValues(array(
        'number'  => dmDb::table('DmUser')->count(),
        'email'   => $user->email,
        'diffusion_message' => dmConfig::get('diffusion_message')
      ))
      ->send();
    }
    catch(Exception $e)
    {
      if(sfConfig::get('sf_debug'))
      {
        throw $e;
      }
    }
  }

  public function listenToSignupPetitionEvent(sfEvent $event)
  {
    try
    {
      $user = $event->getSubject();
      $petition = $event['petition'];

      $petitionDiffusionMessage = str_replace(
        '%url%',
        $this->getLink($petition)->getAbsoluteHref(),
        $petition->diffusionMessage
      );

      $this->createMail()
      ->setTemplate('inscription_confirmation_petition')
      ->addValues(array(
        'nb_signatures' => $petition->nbSignatures,
        'email'   => $user->email
      ))
      ->addValues($petition, 'petition_')
      // replace the petition diffusion message
      // with the one with %url% replaced
      ->addValues(array(
        'petition_diffusion_message' => $petitionDiffusionMessage
      ))
      ->send();
    }
    catch(Exception $e)
    {
      if(sfConfig::get('sf_debug'))
      {
        throw $e;
      }
    }
  }

  public function listenToUserUpdatedEvent(sfEvent $event)
  {
    try
    {
      $objectif   = dmConfig::get('objectif_principal');
      $nbContacts = dmDb::table('DmUser')->getNbContacts();

      if($nbContacts == ($objectif-50))
      {
        $this->createMail()
        ->setTemplate('objectif_principal_proche')
        ->addValues(array(
          'objectif'    => $objectif,
          'nb_contacts' => $nbContacts
        ))
        ->send();
      }
    }
    catch(Exception $e)
    {
      if(sfConfig::get('sf_debug'))
      {
        throw $e;
      }
    }
  }

  public function listenToSignatureCreatedEvent(sfEvent $event)
  {
    try
    {
      $signature  = $event->getSubject();
      $petition   = $signature->Petition;

      if($action = $petition->nextAction)
      {
        $objectif     = $action->goal;
        $nbSignatures = $petition->nbSignatures;

        if($nbSignatures == ($objectif - 50))
        {
          $this->createMail()
          ->setTemplate('objectif_action_proche')
          ->addValues(array(
            'petition'      => $petition->title,
            'action'        => $action->title,
            'objectif'      => $objectif,
            'nb_signatures' => $nbSignatures
          ))
          ->send();
        }
      }

      if($collection = $signature->Collection)
      {
        $objectif     = $collection->goal;
        $nbSignatures = $collection->nbSignatures;

        if($nbSignatures == $objectif)
        {
          $this->createMail()
          ->setTemplate('objectif_collecte_atteint')
          ->addValues($collection->User, 'utilisateur_')
          ->addValues(array(
            'petition_nb_signatures' => $petition->nbSignatures,
            'petition_title' => $petition->title,
            'objectif_principal' => dmConfig::get('objectif_principal'),
            'collecte_edit_url' => $this->getLink($collection)->param('edit', $collection->hashCode)->getAbsoluteHref()
          ))
          ->send();
        }
      }
    }
    catch(Exception $e)
    {
      if(sfConfig::get('sf_debug'))
      {
        throw $e;
      }
    }
  }

  /**
   *
   * @return dmMail a new mail
   */
  protected function createMail()
  {
    return $this->container
    ->getService('mail')
    ->addValues(array(
      'unsuscribe_url' => $this->container->getService('helper')->link('+/dmUser/unsuscribe')->getAbsoluteHref()
    ));
  }

  protected function getLink($something)
  {
    return $this->container->getService('helper')->link($something);
  }
}