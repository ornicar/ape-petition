<?php

class EmailFilter extends BaseDmUserFormFilter
{

  public function configure()
  {
    $this->widgetSchema['is_letter_actu']->setLabel('Inscrit à la newsletter actus');
    $this->widgetSchema['is_letter_action']->setLabel('Inscrit à la newsletter action');
    $this->widgetSchema['tags_list'] = new sfWidgetFormDoctrineChoice(array(
      'multiple' => true,
      'model' => 'DmTag',
      'expanded' => true
    ));
    $this->validatorSchema['tags_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmTag', 'required' => false));

    $this->widgetSchema['tags_list']->setLabel('A signé une pétition correspondant à un de ces thèmes');

    $this->widgetSchema['is_french'] = new sfWidgetFormChoice(array(
      'label' => 'Est français',
      'choices' => array('' => $this->__('yes or no'), 1 => $this->__('yes'), 0 => $this->__('no'))
    ));
    $this->validatorSchema['is_french'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));

    $this->widgetSchema['departements'] = new sfWidgetFormTextarea(array(
      'label' => 'Est dans un des départements ( exemple : 49, 44, 17 )'
    ), array(
      'rows' => 2
    ));
    $this->validatorSchema['departements'] = new sfValidatorString(array('required' => false));

    $this->widgetSchema['encoding'] = new sfWidgetFormChoice(array(
      'label' => 'Encodage',
      'expanded' => true,
      'choices' => dmArray::valueToKey($this->getEncodingChoices())
    ));
    $this->validatorSchema['encoding'] = new sfValidatorChoice(array(
      'choices' => $this->getEncodingChoices()
    ));
    $this->setDefault('encoding', dmArray::first($this->getEncodingChoices()));

    $this->useFields(array('is_letter_actu', 'is_letter_action', 'tags_list', 'is_french', 'departements', 'encoding'));
  }

  protected function getEncodingChoices()
  {
    return array('ISO-8859-1', 'UTF-8');
  }

  public function addTagsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
    ->leftJoin('r.SignedPetitions petition')
    ->leftJoin('petition.PetitionDmTag petitionDmTag')
    ->andWhereIn('petitionDmTag.dm_tag_id', $values);
  }

  public function addIsFrenchColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if('' === $value)
    {
      return;
    }

    $query
    ->leftJoin('r.Country c')
    ->andWhere('c.name '.($value ? '' : '!').'= ?', 'France');
  }

  public function addDepartementsColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if(empty($value))
    {
      return;
    }

    $deps = array_unique(array_filter(array_map('trim', explode(',', $value))));

    $ors = $params = array();

    foreach($deps as $dep)
    {
      $ors[] = 'r.postal_code LIKE ?';
      $params[] = $dep.'%';
    }

    if(count($ors))
    {
      $query->addWhere(implode(' OR ', $ors), $params);
    }
  }

  public function renderSubmitTag($value = 'submit', $attributes = array())
  {
    return parent::renderSubmitTag('Télécharger', $attributes);
  }
}