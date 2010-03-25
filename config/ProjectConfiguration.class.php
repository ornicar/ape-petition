<?php

require_once dirname(__FILE__).'/require_diem.php';
dm::start();

class ProjectConfiguration extends dmProjectConfiguration
{
  public function setup()
  {
    parent::setup();
    
    $this->enablePlugins(array(
      'dmTagPlugin',
      'dmFlowPlayerPlugin',
      'dmContactPlugin',
      'dmBitLyPlugin'
    ));

    $this->setWebDir(sfConfig::get('sf_root_dir').'/public_html');
    
    $this->dispatcher->connect('form.post_configure', array($this, 'listenToFormPostConfigureEvent'));
  }

  public function listenToFormPostConfigureEvent(sfEvent $event)
  {
    foreach($event->getSubject()->getWidgetSchema()->getFields() as $key => $widget)
    {
      if($widget instanceof sfWidgetFormDateTime)
      {
        $widget->setOption('date', array(
          'format' => '%day%/%month%/%year%'
        ));
      }
    }
  }
}