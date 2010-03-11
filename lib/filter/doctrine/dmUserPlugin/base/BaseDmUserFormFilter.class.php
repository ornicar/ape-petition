<?php

/**
 * DmUser filter form base class.
 *
 * @package    ape-petition
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDmUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'              => new sfWidgetFormFilterInput(),
      'email'                 => new sfWidgetFormFilterInput(),
      'algorithm'             => new sfWidgetFormFilterInput(),
      'salt'                  => new sfWidgetFormFilterInput(),
      'password'              => new sfWidgetFormFilterInput(),
      'is_active'             => new sfWidgetFormChoice(array('choices' => array('' => dm::getI18n()->__('yes or no', array(), 'dm'), 1 => dm::getI18n()->__('yes', array(), 'dm'), 0 => dm::getI18n()->__('no', array(), 'dm')))),
      'is_super_admin'        => new sfWidgetFormChoice(array('choices' => array('' => dm::getI18n()->__('yes or no', array(), 'dm'), 1 => dm::getI18n()->__('yes', array(), 'dm'), 0 => dm::getI18n()->__('no', array(), 'dm')))),
      'last_login'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'to_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'with_empty' => true)),
      'country_id'            => new sfWidgetFormDoctrineChoice(array('model' => 'Country', 'add_empty' => true)),
      'first_name'            => new sfWidgetFormFilterInput(),
      'last_name'             => new sfWidgetFormFilterInput(),
      'profession'            => new sfWidgetFormFilterInput(),
      'postal_code'           => new sfWidgetFormFilterInput(),
      'street'                => new sfWidgetFormFilterInput(),
      'city'                  => new sfWidgetFormFilterInput(),
      'is_letter_actu'        => new sfWidgetFormChoice(array('choices' => array('' => dm::getI18n()->__('yes or no', array(), 'dm'), 1 => dm::getI18n()->__('yes', array(), 'dm'), 0 => dm::getI18n()->__('no', array(), 'dm')))),
      'is_letter_action'      => new sfWidgetFormChoice(array('choices' => array('' => dm::getI18n()->__('yes or no', array(), 'dm'), 1 => dm::getI18n()->__('yes', array(), 'dm'), 0 => dm::getI18n()->__('no', array(), 'dm')))),
      'photo_id'              => new sfWidgetFormDoctrineChoice(array('model' => 'DmMedia', 'add_empty' => true)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'to_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'to_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'with_empty' => false)),
      'groups_list'           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmGroup')),
      'permissions_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmPermission')),
      'signed_petitions_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Petition')),
    ));

    $this->setValidators(array(
      'username'              => new sfValidatorPass(array('required' => false)),
      'email'                 => new sfValidatorPass(array('required' => false)),
      'algorithm'             => new sfValidatorPass(array('required' => false)),
      'salt'                  => new sfValidatorPass(array('required' => false)),
      'password'              => new sfValidatorPass(array('required' => false)),
      'is_active'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_super_admin'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'last_login'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'country_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Country'), 'column' => 'id')),
      'first_name'            => new sfValidatorPass(array('required' => false)),
      'last_name'             => new sfValidatorPass(array('required' => false)),
      'profession'            => new sfValidatorPass(array('required' => false)),
      'postal_code'           => new sfValidatorPass(array('required' => false)),
      'street'                => new sfValidatorPass(array('required' => false)),
      'city'                  => new sfValidatorPass(array('required' => false)),
      'is_letter_actu'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_letter_action'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'photo_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Photo'), 'column' => 'id')),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'groups_list'           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmGroup', 'required' => false)),
      'permissions_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmPermission', 'required' => false)),
      'signed_petitions_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Petition', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dm_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addGroupsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.DmUserGroup DmUserGroup')
          ->andWhereIn('DmUserGroup.dm_group_id', $values);
  }

  public function addPermissionsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.DmUserPermission DmUserPermission')
          ->andWhereIn('DmUserPermission.dm_permission_id', $values);
  }

  public function addSignedPetitionsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.Signature Signature')
          ->andWhereIn('Signature.petition_id', $values);
  }

  public function getModelName()
  {
    return 'DmUser';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'username'              => 'Text',
      'email'                 => 'Text',
      'algorithm'             => 'Text',
      'salt'                  => 'Text',
      'password'              => 'Text',
      'is_active'             => 'Boolean',
      'is_super_admin'        => 'Boolean',
      'last_login'            => 'Date',
      'country_id'            => 'ForeignKey',
      'first_name'            => 'Text',
      'last_name'             => 'Text',
      'profession'            => 'Text',
      'postal_code'           => 'Text',
      'street'                => 'Text',
      'city'                  => 'Text',
      'is_letter_actu'        => 'Boolean',
      'is_letter_action'      => 'Boolean',
      'photo_id'              => 'ForeignKey',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'groups_list'           => 'ManyKey',
      'permissions_list'      => 'ManyKey',
      'signed_petitions_list' => 'ManyKey',
    );
  }
}
