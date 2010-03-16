<?php

class EmailExport extends dmDoctrineTableExport
{

  protected function postConfigure()
  {
    $this->options['query'];
  }

  protected function getFields()
  {
    return array(
      'email' => 'Email'
    );
  }
}