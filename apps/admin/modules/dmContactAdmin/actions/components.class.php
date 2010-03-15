<?php

class dmContactAdminComponents extends myAdminBaseComponents
{
  
  public function executeRecent(dmWebRequest $request)
  {
    $this->contacts = dmDb::query('DmContact c')
    ->where('c.is_active = ?', false)
    ->orderBy('c.created_at desc')
    ->fetchRecords();
  }
  
}