<?php
/**
 * Pétition actions
 * 
 */
class petitionActions extends myFrontModuleActions
{

  public function executeShowPage(dmWebRequest $request)
  {
    $petition = $this->getPage()->getRecord();

    /*
     * Create and handle the signup form
     */
    $form = new SignupPetitionForm($petition);
    
    if($request->isMethod('post') && $request->hasParameter($form->getName()))
    {
      if($form->bindAndValid($request))
      {
        $user = $form->save();

        $this->getUser()->setCurrentEmail($user->email);

        $this->getUser()->setFlash('suscribe_action_form', true);

        $this->redirect($this->getHelper()->link('inscription/presentation')->getHref());
      }
    }
    
    $this->forms['signUpPetition'] = $form;
  }
}
