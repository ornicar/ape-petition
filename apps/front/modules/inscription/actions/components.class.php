<?php
/**
 * Inscription components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 */
class inscriptionComponents extends myFrontModuleComponents
{

  public function executePresentation()
  {
    $this->form = $this->forms['InscriptionPresentation'];
    $this->user = $this->form->getObject();
  }

  public function executeDiffuser()
  {
    $this->form = $this->forms['InscriptionDiffuser'];
  }

  public function executeRecevoirCampagnes()
  {
    $this->email = $this->getUser()->getCurrentEmail();
  }

  public function executeSoutenir()
  {
    $this->email = $this->getUser()->getCurrentEmail();
  }

  public function executeSuivreActu()
  {
    // Your code here
  }

  public function executeCreerCollecte()
  {
    $this->form = $this->forms['InscriptionCreerCollecte'];
  }


}
