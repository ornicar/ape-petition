<?php
/**
 * Inscription actions
 */
class inscriptionActions extends myFrontModuleActions
{

  public function executeSoutenirPage(dmWebRequest $request)
  {
    $this->forwardHomeUnless($this->getCurrentUserByEmail());
  }

  public function executeRecevoirCampagnesPage(dmWebRequest $request)
  {
    $this->forwardHomeUnless($this->getCurrentUserByEmail());
  }

  public function executeDiffuserPage(dmWebRequest $request)
  {
    $this->forwardHomeUnless($user = $this->getCurrentUserByEmail());

    $mail = $this->getService('mail')
    ->setTemplate('inscription_diffuser')
    ->addValues(array(
      'user_email' => $user->email,
      'user_first_name' => $user->firstName,
      'user_last_name' => $user->lastName,
      'contacts' => null
    ))
    ->render();

    $form = new InscriptionDiffuserForm($user);
    $form->setDefault('subject', $mail->getMessage()->getSubject());
    
    if($petition = $this->getUser()->getLastPetition())
    {
      if($collection = $user->getCollectionForPetition($petition))
      {
        $url = $this->getHelper()->link($collection)->getAbsoluteHref();
      }
      else
      {
        $url = $this->getHelper()->link($petition)->getAbsoluteHref();
      }
      
      $form->setDefault('message', str_replace('%url%', $url, $petition->diffusionMessage));
    }
    else
    {
      $form->setDefault('message', $mail->getMessage()->getBody());
    }

    if($request->isMethod('post') && $request->hasParameter($form->getName()))
    {
      if($form->bindAndValid($request))
      {
        $mail
        ->addValues(array('contacts' => $form->getValue('contacts')))
        ->render()
        ->getMessage()->setBody($form->getValue('message'));

        $mail->send();

        $this->redirect($this->getHelper()->link('inscription/recevoirCampagnes')->getHref());
      }
    }

    $this->forms['InscriptionDiffuser'] = $form;
  }

  public function executeCreerCollectePage(dmWebRequest $request)
  {
    $this->forwardHomeUnless($user = $this->getCurrentUserByEmail());

    $this->forwardHomeUnless($petition = $this->getUser()->getLastPetition());

    $nextStep = $this->getHelper()->link('inscription/diffuser')->getHref();

    if($user->hasCollectionForPetition($petition))
    {
      $this->redirect($nextStep);
    }

    $form = new InscriptionCreerCollecteForm($user, $petition);

    if($request->isMethod('post') && $request->hasParameter($form->getName()))
    {
      if($form->bindAndValid($request))
      {
        $form->save();

        $this->getUser()->setFlash('creer_collecte_form', true);

        $this->redirect($nextStep);
      }
    }

    $this->forms['InscriptionCreerCollecte'] = $form;
  }

  public function executePresentationPage(dmWebRequest $request)
  {
    $this->forwardHomeUnless($user = $this->getCurrentUserByEmail());

    if($petition = $this->getUser()->getLastPetition())
    {
      $nextStep = $this->getHelper()->link('inscription/creerCollecte')->getHref();
    }
    else
    {
      $nextStep = $this->getHelper()->link('inscription/diffuser')->getHref();
    }

    $form = new InscriptionPresentationForm($user);

    if($request->isMethod('post') && $request->hasParameter($form->getName()))
    {
      if($form->bindAndValid($request))
      {
        $form->save();

        $this->getUser()->setFlash('presentation_form', true);

        $this->completedPresentation($user);
        
        $this->redirect($nextStep);
      }
    }
    else
    {
      /*
       * Si l'utilisateur a déjà les informations requises
       * pour valider le formulaire, on passe à la suite
       */
      if($form->isValidByDefault())
      {
        $this->completedPresentation($user);
        
        $this->redirect($nextStep);
      }
    }

    $this->forms['InscriptionPresentation'] = $form;
  }

  protected function completedPresentation(DmUser $user)
  {
    if($petition = $this->getUser()->getLastPetition())
    {
      $user->signPetition($petition, $this->getUser()->getLastCollection());

      $this->getService('dispatcher')->notify(new sfEvent($user, 'signup.petition', array(
        'petition' => $petition
      )));
    }
  }

  protected function forwardHomeUnless($condition)
  {
    if(!$condition)
    {
      $this->getRequest()->setParameter('slug', '');
      $this->forward('dmFront', 'page');
    }
  }
}