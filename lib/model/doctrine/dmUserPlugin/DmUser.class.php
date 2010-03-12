<?php

/**
 * DmUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ape-petition
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7294 2010-03-02 17:59:20Z jwage $
 */
class DmUser extends PluginDmUser
{

  public function preSave($event)
  {
    if(!$this->username)
    {
      $this->username = $this->email;
    }

    return parent::preSave($event);
  }

}
