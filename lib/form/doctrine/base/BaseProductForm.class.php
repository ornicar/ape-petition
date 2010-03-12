<?php

/**
 * Product form base class.
 *
 * @method Product getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseProductForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'title'          => new sfWidgetFormInputText(),
      'url'            => new sfWidgetFormInputText(),
      'image_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Image'), 'add_empty' => true)),
      'text'           => new sfWidgetFormTextarea(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'version'        => new sfWidgetFormInputText(),
      'petitions_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Petition')),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'title'          => new sfValidatorString(array('max_length' => 255)),
      'url'            => new dmValidatorLinkUrl(array('max_length' => 255)),
      'image_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Image'), 'required' => false)),
      'text'           => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'version'        => new sfValidatorInteger(array('required' => false)),
      'petitions_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Petition', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Product', 'column' => array('title')))
    );

    $this->widgetSchema->setNameFormat('product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product';
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
