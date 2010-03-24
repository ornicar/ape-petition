<?php

class sfValidatorPostalCode extends sfValidatorRegex
{

  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);

    $this->setMessage('invalid', 'Ce n\'est pas un code postal valide');

    $this->setOption('pattern', '|^\d{5}$|i');
  }
}