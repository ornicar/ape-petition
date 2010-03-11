<?php
/**
 * Pétition components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 * 
 */
class petitionComponents extends myFrontModuleComponents
{

  public function executeList()
  {
    $query = $this->getListQuery();
    
    $this->petitionPager = $this->getPager($query);
  }

  public function executeShow()
  {
    $query = $this->getShowQuery();
    
    $this->petition = $this->getRecord($query);
  }


}
