<?php
/**
 * Main components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
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
  }

  public function executeTopMenu()
  {
    $this->menu = $this->getService('menu', 'HomeMenu')->build();
  }


}
