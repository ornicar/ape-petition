<?php

class DmUserTable extends PluginDmUserTable
{

  public function findOneByEmail($email)
  {
    return $this->createQuery('u')
    ->where('u.email = ?', $email)
    ->fetchRecord();
  }
  
  public function getNbContacts()
  {
    return $this->createQuery('u')
    ->where('u.is_letter_action = ?', true)
    ->count();
  }
}
