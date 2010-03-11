<?php

require_once '/home/thib/data/workspace/diem/dmCorePlugin/lib/core/dm.php';
dm::start();

class ProjectConfiguration extends dmProjectConfiguration
{

  public function setup()
  {
    parent::setup();
    
    $this->enablePlugins(array(
      'dmTagPlugin'
    ));

    $this->setWebDir(sfConfig::get('sf_root_dir').'/public_html');
  }
  
}