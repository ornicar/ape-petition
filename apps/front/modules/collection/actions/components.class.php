<?php
/**
 * Collecte components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 * 
 */
class collectionComponents extends myFrontModuleComponents
{

  public function executeShow()
  {
    $query = $this->getShowQuery('c')
    ->leftJoin('c.Petition petition')
    ->leftJoin('petition.Products product')
    ->withDmMedia('Image', 'product')
    ->leftJoin('petition.Partners partner')
    ->withDmMedia('Image', 'partner')
    ->leftJoin('petition.Collections collection')
    ->leftJoin('c.User user')
    ->withDmMedia('Photo', 'user');
    
    $this->collection = $this->getRecord($query);
    $this->petition = $this->collection->Petition;
    $this->user = $this->collection->User;
    
    $this->preloadPages($this->petition->activeCollections);

    $this->form = $this->forms['EditCollection'];
    
    $this->signupForm = new SignupPetitionForm($this->petition);
  }


}
