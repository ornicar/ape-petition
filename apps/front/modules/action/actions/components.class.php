<?php
/**
 * Action components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 * 
 */
class actionComponents extends myFrontModuleComponents
{

  public function executeList()
  {
    $query = $this->getListQuery();
    
    $this->actionPager = $this->getPager($query);
  }


}
