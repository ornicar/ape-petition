<?php

class EmailExport extends dmDoctrineTableExport
{

  protected function getFields()
  {
    return array(
      'email' => 'Email'
    );
  }
}