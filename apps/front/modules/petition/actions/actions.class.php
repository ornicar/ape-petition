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
     * Remember the last petition viewed
     */
    $this->getUser()->setLastPetition($petition);

    /*
     * Create and handle the signup form
     */
    $form = new SignupPetitionForm($petition);
    
    if($request->isMethod('post') && $request->hasParameter($form->getName()))
    {
      if($form->bindAndValid($request))
      {
        $form->save();
        #TODO redirect to next step
        $this->redirectBack();
      }
    }
    
    $this->forms['signUpPetition'] = $form;
  }
}
