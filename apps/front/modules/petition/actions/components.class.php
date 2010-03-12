<?php
/**
 * Pétition components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 * 
 * 
 */
class petitionComponents extends myFrontModuleComponents
{

  public function executeList()
  {
    $query = $this->getListQuery();
    
    $this->petitionPager = $this->getPager($query);
  }

  public function executeShowContent()
  {
    $query = $this->getShowQuery('petition')
    ->leftJoin('petition.Products product')
    ->leftJoin('petition.Partners partner');
    
    $this->petition = $this->getRecord($query);
    
    $this->signupForm = $this->forms['signUpPetition'];
  }

  public function executeShowTitle()
  {
    $query = $this->getShowQuery();
    
    $this->petition = $this->getRecord($query);
  }

}
