<?php

class exportActions extends dmAdminBaseActions
{

  public function executeIndex(dmWebRequest $request)
  {
    $this->signataireFilter = new SignataireFilter();

    if($request->hasParameter($this->signataireFilter->getName()) && $this->signataireFilter->bindAndValid($request))
    {
      $export = new SignataireExport(dmDb::table('Signature'), array(
        'query' => $this->signataireFilter->getQuery()
      ));

      $csv = new dmCsvWriter(',', '"');

      $this->download($csv->convert($export->generate()), array(
        'file_name' => 'Signataires de la pétition '.$this->signataireFilter->getPetition().' au '.date('Y-m-d').'.csv',
        'mime_type' => 'text/csv; charset=utf-8'
      ));
    }
    
    $this->emailFilter = new EmailFilter();

    if($request->hasParameter($this->emailFilter->getName()) && $this->emailFilter->bindAndValid($request))
    {
      $export = new EmailExport(dmDb::table('DmUser'), array(
        'query' => $this->emailFilter->getQuery()
      ));

      $csv = new dmCsvWriter(',', '"');

//      $this->emailDebug =
//      $this->emailFilter->getQuery()->getSqlQuery().
//      "\n".
//      var_export($this->emailFilter->getQuery()->getFlattenedParams(), true).
//      "\n".
      $csv->convert($export->generate());

      $this->download($csv->convert($export->generate()), array(
        'file_name' => 'Emails au '.date('Y-m-d').'.csv',
        'mime_type' => 'text/csv; charset=utf-8'
      ));
    }
  }
  

}