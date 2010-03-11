<?php

/**
 * DmUser form base class.
 *
 * @method DmUser getObject() Returns the current form's model object
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseDmUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'username'              => new sfWidgetFormInputText(),
      'email'                 => new sfWidgetFormInputText(),
      'algorithm'             => new sfWidgetFormInputText(),
      'salt'                  => new sfWidgetFormInputText(),
      'password'              => new sfWidgetFormInputText(),
      'is_active'             => new sfWidgetFormInputCheckbox(),
      'is_super_admin'        => new sfWidgetFormInputCheckbox(),
      'last_login'            => new sfWidgetFormDateTime(),
      'country_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => true)),
      'first_name'            => new sfWidgetFormInputText(),
      'last_name'             => new sfWidgetFormInputText(),
      'profession'            => new sfWidgetFormTextarea(),
      'postal_code'           => new sfWidgetFormInputText(),
      'street'                => new sfWidgetFormTextarea(),
      'city'                  => new sfWidgetFormInputText(),
      'is_letter_actu'        => new sfWidgetFormInputCheckbox(),
      'is_letter_action'      => new sfWidgetFormInputCheckbox(),
      'photo_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'add_empty' => true)),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
        'groups_list'           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmGroup', 'expanded' => true)),
        'permissions_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmPermission', 'expanded' => true)),
        'signed_petitions_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Petition', 'expanded' => true)),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'username'              => new sfValidatorString(array('max_length' => 255)),
      'email'                 => new sfValidatorString(array('max_length' => 255)),
      'algorithm'             => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'salt'                  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'password'              => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'             => new sfValidatorBoolean(array('required' => false)),
      'is_super_admin'        => new sfValidatorBoolean(array('required' => false)),
      'last_login'            => new sfValidatorDateTime(array('required' => false)),
      'country_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'required' => false)),
      'first_name'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'last_name'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'profession'            => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'postal_code'           => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'street'                => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'city'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_letter_actu'        => new sfValidatorBoolean(array('required' => false)),
      'is_letter_action'      => new sfValidatorBoolean(array('required' => false)),
      'photo_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
        'groups_list'           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmGroup', 'required' => false)),
        'permissions_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmPermission', 'required' => false)),
        'signed_petitions_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Petition', 'required' => false)),
    ));

    /*
     * Embed Media form for photo_id
     */
    $this->embedForm('photo_id_form', $this->createMediaFormForPhotoId());
    unset($this['photo_id']);

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'DmUser', 'column' => array('username'))),
        new sfValidatorDoctrineUnique(array('model' => 'DmUser', 'column' => array('email'))),
      ))
    );

    $this->widgetSchema->setNameFormat('dm_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'position'
    // override this method in your form to keep them
    parent::unsetAutoFields();
  }

  /**
   * Creates a DmMediaForm instance for photo_id
   *
   * @return DmMediaForm a form instance for the related media
   */
  protected function createMediaFormForPhotoId()
  {
    return DmMediaForRecordForm::factory($this->object, 'photo_id', 'Photo', $this->validatorSchema['photo_id']->getOption('required'));
  }

  protected function doBind(array $values)
  {
    $values = $this->filterValuesByEmbeddedMediaForm($values, 'photo_id');
    parent::doBind($values);
  }
  
  public function processValues($values)
  {
    $values = parent::processValues($values);
    $values = $this->processValuesForEmbeddedMediaForm($values, 'photo_id');
    return $values;
  }
  
  protected function doUpdateObject($values)
  {
    parent::doUpdateObject($values);
    $this->doUpdateObjectForEmbeddedMediaForm($values, 'photo_id', 'Photo');
  }

  public function getModelName()
  {
    return 'DmUser';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['groups_list']))
    {
      $this->setDefault('groups_list', $this->object->Groups->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['permissions_list']))
    {
      $this->setDefault('permissions_list', $this->object->Permissions->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['signed_petitions_list']))
    {
      $this->setDefault('signed_petitions_list', $this->object->SignedPetitions->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveGroupsList($con);
    $this->savePermissionsList($con);
    $this->saveSignedPetitionsList($con);

    parent::doSave($con);
  }

  public function saveGroupsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['groups_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Groups->getPrimaryKeys();
    $values = $this->getValue('groups_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Groups', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Groups', array_values($link));
    }
  }

  public function savePermissionsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['permissions_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Permissions->getPrimaryKeys();
    $values = $this->getValue('permissions_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Permissions', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Permissions', array_values($link));
    }
  }

  public function saveSignedPetitionsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['signed_petitions_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->SignedPetitions->getPrimaryKeys();
    $values = $this->getValue('signed_petitions_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('SignedPetitions', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('SignedPetitions', array_values($link));
    }
  }

}