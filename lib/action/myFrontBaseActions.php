<?php

class myFrontBaseActions extends dmFrontBaseActions
{

  protected function getCurrentUserByEmail()
  {
    return dmDb::table('DmUser')->findOneByEmail($this->getUser()->getCurrentEmail());
  }
  
}