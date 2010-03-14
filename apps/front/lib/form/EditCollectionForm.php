<?php

class EditCollectionForm extends CollectionForm
{
  
  public function configure()
  {
    parent::configure();
    
    $this->useFields(array('title', 'goal', 'text'));

    $this->validatorSchema['goal'] = new sfValidatorInteger(array(
      'min' => $this->getObject()->nbSignatures +1,
      'max' => 100000
    ), array(
      'min' => '"%value%" ne peut être inférieur à %min%.',
      'max' => '"%value%" ne peut dépasser %max%.'
    ));
  }
}