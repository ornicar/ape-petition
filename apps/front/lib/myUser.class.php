<?php

class myUser extends dmFrontUser
{

  public function setCurrentEmail($email = null)
  {
    return $this->setAttribute('email', $email);
  }

  public function getCurrentEmail()
  {
    return $this->getAttribute('email');
  }

  public function setLastPetition(Petition $petition = null)
  {
    return $this->setAttribute('petition_id', $petition ? $petition->id : null);
  }

  public function getLastPetition()
  {
    if($petitionId = $this->getAttribute('petition_id'))
    {
      return dmDb::table('Petition')->find($petitionId);
    }
  }

  public function setLastCollection(Collection $collection = null)
  {
    return $this->setAttribute('collection_id', $collection ? $collection->id : null);
  }

  public function getLastCollection()
  {
    if($collectionId = $this->getAttribute('collection_id'))
    {
      return dmDb::table('Collection')->find($collectionId);
    }
  }
}