<?php

class PetitionTable extends myDoctrineTable
{

  public function getAdminListQuery(dmDoctrineQuery $query)
  {
    $rootAlias = $query->getRootAlias();
    
    return $query
    ->leftJoin($rootAlias.'.Collections collections')
    ->leftJoin($rootAlias.'.Actions actions');
  }

}
