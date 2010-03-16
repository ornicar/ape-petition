<?php
/**
 * Citation components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 * 
 */
class citationComponents extends myFrontModuleComponents
{

  public function executeList()
  {
    $query = $this->getListQuery();
    
    $this->citationPager = $this->getPager($query);

    $this->citationPager->setOption('ajax', true);
  }


}
