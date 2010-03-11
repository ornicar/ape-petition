<?php

/**
 * Produit form base class.
 *
 * @method Produit getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseProduitForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'title'          => new sfWidgetFormInputText(),
      'url'            => new sfWidgetFormInputText(),
      'image_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Image'), 'add_empty' => true)),
      'texte'          => new sfWidgetFormTextarea(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'version'        => new sfWidgetFormInputText(),
        'petitions_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Petition', 'expanded' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'title'          => new sfValidatorString(array('max_length' => 255)),
      'url'            => new dmValidatorLinkUrl(array('max_length' => 255)),
      'image_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Image'), 'required' => false)),
      'texte'          => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'version'        => new sfValidatorInteger(array('required' => false)),
        'petitions_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Petition', 'required' => false)),
    ));

    /*
     * Embed Media form for image_id
     */
    $this->embedForm('image_id_form', $this->createMediaFormForImageId());
    unset($this['image_id']);

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Produit', 'column' => array('title')))
    );

    $this->widgetSchema->setNameFormat('produit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'position'
    // override this method in your form to keep them
    parent::unsetAutoFields();
  }

  /**
   * Creates a DmMediaForm instance for image_id
   *
   * @return DmMediaForm a form instance for the related media
   */
  protected function createMediaFormForImageId()
  {
    return DmMediaForRecordForm::factory($this->object, 'image_id', 'Image', $this->validatorSchema['image_id']->getOption('required'));
  }

  protected function doBind(array $values)
  {
    $values = $this->filterValuesByEmbeddedMediaForm($values, 'image_id');
    parent::doBind($values);
  }
  
  public function processValues($values)
  {
    $values = parent::processValues($values);
    $values = $this->processValuesForEmbeddedMediaForm($values, 'image_id');
    return $values;
  }
  
  protected function doUpdateObject($values)
  {
    parent::doUpdateObject($values);
    $this->doUpdateObjectForEmbeddedMediaForm($values, 'image_id', 'Image');
  }

  public function getModelName()
  {
    return 'Produit';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['petitions_list']))
    {
      $this->setDefault('petitions_list', $this->object->Petitions->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savePetitionsList($con);

    parent::doSave($con);
  }

  public function savePetitionsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['petitions_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Petitions->getPrimaryKeys();
    $values = $this->getValue('petitions_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Petitions', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Petitions', array_values($link));
    }
  }

}