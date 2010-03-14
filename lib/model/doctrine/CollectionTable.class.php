<?php

class CollectionTable extends myDoctrineTable
{

  public function existsByUserAndPetition(DmUser $user, Petition $petition)
  {
    return $this->createQuery('c')
    ->where('c.dm_user_id = ?', $user->id)
    ->andWhere('c.petition_id = ?', $petition->id)
    ->exists();
  }
  
}
