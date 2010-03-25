<?php

class InscriptionCreerCollecteForm extends dmForm
{
  protected
  $user,
  $petition;

  public function __construct(DmUser $user, Petition $petition)
  {
    $this->user     = $user;
    $this->petition = $petition;

    parent::__construct();
  }

  public function configure()
  {
    if(!$this->user->gender)
    {
      $this->widgetSchema['gender'] = new sfWidgetFormSelectRadio(array(
        'choices' => dmArray::valueToKey($this->getGenderChoices())
      ));
      $this->validatorSchema['gender'] = new sfValidatorChoice(array(
        'choices' => $this->getGenderChoices()
      ));
    }

    if(!$this->user->Photo->exists())
    {
      $this->widgetSchema['photo'] = new sfWidgetFormInputFile();
      $this->validatorSchema['photo'] = new sfValidatorFile(array(
        'required' => false,
        'mime_types' => 'web_images'
      ));
    }

    $this->widgetSchema['goal'] = new sfWidgetFormInputText();
    $this->validatorSchema['goal'] = new sfValidatorInteger(array(
      'min' => 3,
      'max' => 100000
    ), array(
      'min' => '"%value%" ne peut être inférieur à %min%.',
      'max' => '"%value%" ne peut dépasser %max%.'
    ));
    $this->setDefault('goal', 50);

    $this->widgetSchema['text'] = new sfWidgetFormTextarea();
    $this->validatorSchema['text'] = new dmValidatorStringEscape();
    $this->setDefault('text', $this->petition->collecteMotivation);

    $this->widgetSchema['accept_conditions'] = new sfWidgetFormInputCheckbox();
    $this->validatorSchema['accept_conditions'] = new sfValidatorBoolean(array(
      'required' => true
    ), array(
      'required' => 'Vous devez accepter les conditions pour continuer'
    ));
  }

  protected function getGenderChoices()
  {
    $column = dmDb::table('DmUser')->getColumn('gender');

    return $column['values'];
  }

  public function save()
  {
    $values = $this->getValues();

    if(isset($values['gender']))
    {
      $this->user->gender = $values['gender'];
    }

    if(isset($values['photo']))
    {
      $media = new DmMedia();
      
      $media->Folder = $this->user->DmMediaFolder;
      $media->create($values['photo']);
      $media->save();

      $this->user->photo_id = $media->id;
    }
    
    $this->user->save();

    return dmDb::table('Collection')->create(array(
      'dm_user_id'  => $this->user->id,
      'petition_id' => $this->petition->id,
      'text'        => $values['text'],
      'goal'        => $values['goal']
    ))->saveGet();
  }
}