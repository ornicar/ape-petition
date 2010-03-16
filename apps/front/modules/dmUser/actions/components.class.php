<?php

require_once sfConfig::get('dm_core_dir').'/plugins/dmUserPlugin/modules/dmUser/lib/BasedmUserComponents.class.php';

class dmUserComponents extends BasedmUserComponents
{

  public function executeSignupAction()
  {
    $this->form = $this->forms['SignupAction'];
  }

  public function executeUnsuscribeLetter()
  {
    $this->form = $this->forms['UnsuscribeLetter'];
  }

}