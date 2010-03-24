<?php

class SignataireFilter extends BaseSignatureFormFilter
{

  public function configure()
  {
    $this->validatorSchema['petition_id']->setOption('required', true);

    $this->widgetSchema['petition_id']->setLabel('A signé la pétition');

    $this->widgetSchema['encoding'] = new sfWidgetFormChoice(array(
      'label' => 'Encodage',
      'expanded' => true,
      'choices' => dmArray::valueToKey($this->getEncodingChoices())
    ));
    $this->validatorSchema['encoding'] = new sfValidatorChoice(array(
      'choices' => $this->getEncodingChoices()
    ));
    $this->setDefault('encoding', dmArray::first($this->getEncodingChoices()));

    $this->useFields(array('petition_id', 'encoding'));
  }

  protected function getEncodingChoices()
  {
    return array('ISO-8859-1', 'UTF-8');
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