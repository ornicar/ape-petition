<?php

class InscriptionPresentationForm extends DmUserForm
{

  public function configure()
  {
    parent::configure();

    foreach(array('first_name', 'last_name', 'country_id') as $requiredField)
    {
      $this->validatorSchema[$requiredField]->setOption('required', true);
    }

    $this->validatorSchema['postal_code'] = new sfValidatorPostalCode(array(
      'required' => true
    ));

    $this->useFields($this->getUsedFields());
  }

  protected function getUsedFields()
  {
    $fields = array(
      'first_name',
      'last_name',
      'profession',
      'country_id',
      'postal_code'
    );

    /*
     * Si l'internautes n'est pas inscrit à la newletter_actu :
     * Proposer une case à cocher.
     * Si oui :
     * Supprimer cette étape.
     */
    if(!$this->object->isLetterActu)
    {
     $fields[] = 'is_letter_actu';
    }

    return $fields;
  }

  public function isValidByDefault()
  {
    $form = clone $this;
    unset($form['_csrf_token']);

    $values = array();
    foreach($form->getUsedFields() as $field)
    {
      $values[$field] = $form->getDefault($field);
    }
    
    $form->bind($values);

    return $form->isValid();
  }

}