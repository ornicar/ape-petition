<?php

class HomeMenu extends dmMenu
{
  public function build()
  {
    return $this
    ->addChild('Accueil', 'main/root')->end()
    ->addChild('Qui sommes nous ?', 'main/quiSommesNous')->end()
    ->addChild('Actions', 'action/list')->end()
    ->addChild('Contact', 'main/contact')->end();
  }
}