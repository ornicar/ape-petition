<?php
/**
 * Collecte actions
 */
class collectionActions extends myFrontModuleActions
{

  public function executeShowPage(dmWebRequest $request)
  {
    if(!$code = $request->getParameter('edit'))
    {
      return;
    }

    $collection = $this->getPage()->getRecord();

    $this->forward404Unless($code == $collection->hashCode);

    $form = new EditCollectionForm($collection);

    if($request->isMethod('post') && $request->hasParameter($form->getName()))
    {
      if($form->bindAndValid($request))
      {
        $form->save();

        $this->getUser()->setFlash('edit_collection_form', true);

        $this->redirectBack();
      }
    }

    $this->forms['EditCollection'] = $form;
  }
}
