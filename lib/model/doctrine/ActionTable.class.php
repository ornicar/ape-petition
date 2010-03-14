<?php

class ActionTable extends myDoctrineTable
{

  public function getNext(Petition $petition = null)
  {
    $query = $this->createQuery('a')
    ->whereIsActive()
    ->andWhere('a.begin_at IS NOT NULL')
    ->andWhere('a.begin_at > ?', date('Y-m-d H:i:s', time()))
    ->orderBy('a.begin_at ASC');

    if($petition)
    {
      $query->andWhere('a.petition_id = ?', $petition->id);
    }

    return $query->fetchOne();
  }

}
