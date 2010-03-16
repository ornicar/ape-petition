<?php

class emailActions extends myFrontBaseActions
{

  public function executeContactImport(dmWebRequest $request)
  {
    $form = new OpenInviterContactImportForm($this->getService('open_inviter'), $this->getCurrentUserByEmail());

    if($request->hasParameter($form->getName()))
    {
      if($form->bindAndValid($request))
      {
        $form->save();
      }
    }

    return $this->renderPartial('email/contactImport', array('form' => $form));
  }
}