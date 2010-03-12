<?php

class myUser extends dmFrontUser
{

  public function setLastPetition(Petition $petition = null)
  {
    $this->setAttribute('petition_id', $petition ? $petition->id : null);
  }

  public function getLastPetition()
  {
    if($petitionId = $this->getAttribute('petition_id'))
    {
      return dmDb::table('Petition')->find($petitionId);
    }
  }
}