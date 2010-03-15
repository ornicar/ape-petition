<?php

class SignatureTable extends myDoctrineTable
{

  public function countForCollection(Collection $collection)
  {
    return $this->createQuery('s')
    ->where('s.collection_id = ?', $collection->id)
    ->count();
  }

  public function countForCollectionAndPetition(Collection $collection, Petition $petition)
  {
    return $this->createQuery('s')
    ->where('s.collection_id = ?', $collection->id)
    ->andWhere('s.petition_id = ?', $petition->id)
    ->count();
  }

  public function createForUserAndPetition(DmUser $user, Petition $petition, Collection $collection = null)
  {
    $signature = $this->create(array(
      'dm_user_id' => $user->id,
      'petition_id' => $petition->id
    ));

    if($collection)
    {
      $signature->collection_id = $collection->id;
    }

    return $signature;
  }

  public function existsByUserAndPetition(DmUser $user, Petition $petition)
  {
    return $this->createQuery('s')
    ->where('s.dm_user_id = ?', $user->id)
    ->andWhere('s.petition_id = ?', $petition->id)
    ->exists();
  }

  public function findOneByUserAndPetition(DmUser $user, Petition $petition)
  {
    return $this->createQuery('s')
    ->where('s.dm_user_id = ?', $user->id)
    ->andWhere('s.petition_id = ?', $petition->id)
    ->fetchRecord();
  }

}
