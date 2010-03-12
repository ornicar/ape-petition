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

  public function executeHeader()
  {
    // Your code here
  }

  public function executeFooter()
  {
    // Your code here
  }

  public function executeNextAction()
  {
    $this->nbContacts = dmDb::table('DmUser')->getNbContacts();
    $this->objectif = dmConfig::get('objectif_principal');
    $this->action = dmDb::table('Action')->getNext();
  }

  public function executeSitemap()
  {
    $this->sitemap = $this->getService('menu', 'dmSitemapMenu')->build();
  }


}
