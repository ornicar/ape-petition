<?php
/**
 * API actions
 */
class apiActions extends myFrontModuleActions
{

  public function executeNbContacts(dmWebRequest $request)
  {
    return $this->renderText(sprintf('%d/%d',
      dmDb::table('DmUser')->getNbContacts(),
      dmConfig::get('objectif_principal')
    ));
  }

}
