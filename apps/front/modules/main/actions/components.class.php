<?php
/**
 * Main components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 * 
 * 
 */
class mainComponents extends myFrontModuleComponents
{

  public function executeNextAction()
  {
    $this->nbContacts = dmDb::table('DmUser')->getNbContacts();
    $this->objectif = dmConfig::get('objectif_principal');
    $this->timer = strtotime(dmConfig::get('timer_principal')) - time();
  }

  public function executeSitemap()
  {
    $this->sitemap = $this->getService('menu', 'SitemapMenu')->build();
  }

  public function executeSharePage()
  {
    $this->url = $this->getHelper()->link($this->getPage())->getAbsoluteHref();
    $this->shortUrl = $this->getService('bit_ly_api')->shorten($this->url);
  }

  public function executeCurrentTitle()
  {
    if($petition = $this->getUser()->getLastPetition())
    {
      $this->text = $petition->title;
      $this->link = $petition;
    }
    else
    {
      $this->text = 'Un clic pour la Terre';
      $this->link = 'main/root';
    }
  }

  public function executeCurrentMenu()
  {
    if($petition = $this->getUser()->getLastPetition())
    {
      $this->menu = $this->getService('menu', 'PetitionMenu')
      ->setPetition($petition)
      ->build();
    }
    else
    {
      $this->menu = $this->getService('menu', 'HomeMenu')
      ->build();
    }
  }


}
