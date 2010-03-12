<?php

class DmUserTable extends PluginDmUserTable
{
  
  public function getNbContacts()
  {
    return $this->createQuery('u')
    ->where('u.is_letter_action = ?', true)
    ->count();
  }
}
