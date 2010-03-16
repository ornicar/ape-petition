<?php
/**
 * Signature actions
 */
class signatureActions extends myFrontModuleActions
{

  public function executeUnsuscribe()
  {
    $this->forward404Unless(
      $signature = dmDb::table('Signature')->findOneByHash($request->getParameter('code'))
    );

    $signature->delete();

    $this->getUser()->setFlash('signature_deleted', true);

    $this->redirect($signature->Petition);
  }

}
