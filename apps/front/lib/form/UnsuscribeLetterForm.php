<?php

class UnsuscribeLetterForm extends dmForm
{

  // actions || actus + actions
  public function configure()
  {
    $this->widgetSchema['email'] = new sfWidgetFormInputText();

    $this->validatorSchema['email'] = new sfValidatorDoctrineChoice(array(
      'model'     => 'DmUser',
      'column'    => 'email',
      'required'  => true
    ));

    $this->widgetSchema['unsuscribe'] = new sfWidgetFormSelectRadio(array(
      'choices' => array(
        'Se désinscrire des actualités',
        'Se désinscrire des actualités et des actions'
      )
    ));
    $this->validatorSchema['unsuscribe'] = new sfValidatorChoice(array(
      'choices' => array(0, 1)
    ));
  }

  public function save()
  {
    $user = dmDb::table('DmUser')->findOneByEmail($this->getValue('email'));

    $user->isLetterActu = false;
    $user->isLetterAction = !$this->getValue('unsuscribe');
    
    $user->save();
  }

  protected function getUnsuscribeFields()
  {
    return array('is_letter_actu', 'is_letter_action');
  }
}