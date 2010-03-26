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

  public function executeShowContent()
  {
    $query = $this->getShowQuery('petition')
    ->leftJoin('petition.Products product')
    ->withDmMedia('Image', 'product')
    ->leftJoin('petition.Partners partner')
    ->withDmMedia('Image', 'partner');
    
    $this->petition = $this->getRecord($query);
    $this->preloadPages($this->petition->activeCollections);
    
    $this->signupForm = $this->forms['signUpPetition'];
  }

}
