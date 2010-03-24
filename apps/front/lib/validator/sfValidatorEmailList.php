<?php

class sfValidatorEmailList extends sfValidatorString
{

  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);

    $this->addMessage('invalid_email', '"%value%" n\'est pas un email valide');
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    $value = parent::doClean($value);

    $emails = array_unique(array_filter(array_map('trim', explode(',', str_replace("\n", ',', $value)))));

    $emailValidator = new sfValidatorEmail();

    foreach($emails as $email)
    {
      try
      {
        $emailValidator->clean($email);
      }
      catch(sfValidatorError $e)
      {
        throw new sfValidatorError($this, 'invalid_email', array('value' => $email));
      }
    }

    return $value;
  }
}