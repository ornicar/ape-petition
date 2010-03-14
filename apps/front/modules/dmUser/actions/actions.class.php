<?php

require_once sfConfig::get('dm_core_dir').'/plugins/dmUserPlugin/modules/dmUser/lib/BasedmUserActions.class.php';

class dmUserActions extends BasedmUserActions
{

  public function executeSignupActionWidget(dmWebRequest $request)
  {
    $form = new SignupActionForm();

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

    $this->forms['SignupAction'] = $form;
  }

  public function executeUnsuscribeLetterWidget(dmWebRequest $request)
  {
    $form = new UnsuscribeLetterForm();

    if($request->isMethod('post') && $request->hasParameter($form->getName()))
    {
      if($form->bindAndValid($request))
      {
        $form->save();

        $this->getUser()->setFlash('unsuscribe_letter_form', true);

        $this->redirectBack();
      }
    }

    $this->forms['UnsuscribeLetter'] = $form;
  }

}