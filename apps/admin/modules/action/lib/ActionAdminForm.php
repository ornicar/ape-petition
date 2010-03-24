<?php

/**
 * action admin form
 *
 * @package    ape-petition
 * @subpackage action
 * @author     Your name here
 */
class ActionAdminForm extends BaseActionForm
{
  public function configure()
  {
    parent::configure();

    $this->widgetSchema['begin_at']->setOption('date', array(
      'format' => '%day%/%month%/%year%'
    ));
  }
}