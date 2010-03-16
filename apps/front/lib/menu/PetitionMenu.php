<?php

class PetitionMenu extends dmMenu
{
  protected
  $petition;

  public function setPetition(Petition $petition)
  {
    $this->petition = $petition;

    return $this;
  }

  public function build()
  {
    return $this
    ->addChild('Accueil', $this->petition)->end()
    ->addChild('Qui sommes nous ?', 'main/quiSommesNous')->end()
    ->addChild('Actions', 'action/list')->end()
    ->addChild('Contact', 'main/contact')->end();
  }
}