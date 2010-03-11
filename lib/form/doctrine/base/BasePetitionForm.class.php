<?php

/**
 * Petition form base class.
 *
 * @method Petition getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BasePetitionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'title'               => new sfWidgetFormInputText(),
      'text'                => new sfWidgetFormTextarea(),
      'slogan'              => new sfWidgetFormTextarea(),
      'is_active'           => new sfWidgetFormInputCheckbox(),
      'url_feed_actu'       => new sfWidgetFormInputText(),
      'url_feed_communique' => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'version'             => new sfWidgetFormInputText(),
        'signatories_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmUser', 'expanded' => true)),
        'partenaires_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Partenaire', 'expanded' => true)),
        'produits_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Produit', 'expanded' => true)),
        'tags_list'           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmTag', 'expanded' => true)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'title'               => new sfValidatorString(array('max_length' => 255)),
      'text'                => new sfValidatorString(array('required' => false)),
      'slogan'              => new sfValidatorString(array('max_length' => 500)),
      'is_active'           => new sfValidatorBoolean(array('required' => false)),
      'url_feed_actu'       => new dmValidatorLinkUrl(array('max_length' => 255)),
      'url_feed_communique' => new dmValidatorLinkUrl(array('max_length' => 255)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'version'             => new sfValidatorInteger(array('required' => false)),
        'signatories_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmUser', 'required' => false)),
        'partenaires_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Partenaire', 'required' => false)),
        'produits_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Produit', 'required' => false)),
        'tags_list'           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmTag', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Petition', 'column' => array('title')))
    );

    $this->widgetSchema->setNameFormat('petition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'position'
    // override this method in your form to keep them
    parent::unsetAutoFields();
  }


  protected function doBind(array $values)
  {
    parent::doBind($values);
  }
  
  public function processValues($values)
  {
    $values = parent::processValues($values);
    return $values;
  }
  
  protected function doUpdateObject($values)
  {
    parent::doUpdateObject($values);
  }

  public function getModelName()
  {
    return 'Petition';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['signatories_list']))
    {
      $this->setDefault('signatories_list', $this->object->Signatories->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['partenaires_list']))
    {
      $this->setDefault('partenaires_list', $this->object->Partenaires->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['produits_list']))
    {
      $this->setDefault('produits_list', $this->object->Produits->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['tags_list']))
    {
      $this->setDefault('tags_list', $this->object->Tags->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveSignatoriesList($con);
    $this->savePartenairesList($con);
    $this->saveProduitsList($con);
    $this->saveTagsList($con);

    parent::doSave($con);
  }

  public function saveSignatoriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['signatories_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Signatories->getPrimaryKeys();
    $values = $this->getValue('signatories_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Signatories', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Signatories', array_values($link));
    }
  }

  public function savePartenairesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['partenaires_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Partenaires->getPrimaryKeys();
    $values = $this->getValue('partenaires_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Partenaires', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Partenaires', array_values($link));
    }
  }

  public function saveProduitsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['produits_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Produits->getPrimaryKeys();
    $values = $this->getValue('produits_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Produits', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Produits', array_values($link));
    }
  }

  public function saveTagsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tags_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Tags->getPrimaryKeys();
    $values = $this->getValue('tags_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Tags', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Tags', array_values($link));
    }
  }

}