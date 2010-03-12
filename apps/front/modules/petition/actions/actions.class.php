<?php
/**
 * Pétition actions
 * 
 */
class petitionActions extends myFrontModuleActions
{

  public function executeShowContentWidget(dmWebRequest $request)
  {
    $form = new SignupPetitionForm($this->getPage()->getRecord());
    
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
