<?php

class SignataireFilter extends BaseSignatureFormFilter
{

  public function configure()
  {
    $this->validatorSchema['petition_id']->setOption('required', true);

    $this->widgetSchema['petition_id']->setLabel('A signé la pétition');

    $this->useFields(array('petition_id'));
  }

  public function getPetition()
  {
    return dmDb::table('Petition')->find($this->getValue('petition_id'));
  }

  public function renderSubmitTag($value = 'submit', $attributes = array())
  {
    return parent::renderSubmitTag('Télécharger', $attributes);
  }
}