<?php

/**
 * Petition filter form base class.
 *
 * @package    ape-petition
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePetitionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'               => new sfWidgetFormFilterInput(),
      'text'                => new sfWidgetFormFilterInput(),
      'slogan'              => new sfWidgetFormFilterInput(),
      'is_active'           => new sfWidgetFormChoice(array('choices' => array('' => dm::getI18n()->__('yes or no', array(), 'dm'), 1 => dm::getI18n()->__('yes', array(), 'dm'), 0 => dm::getI18n()->__('no', array(), 'dm')))),
      'url_feed_actu'       => new sfWidgetFormFilterInput(),
      'url_feed_communique' => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'to_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'to_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'with_empty' => false)),
      'version'             => new sfWidgetFormFilterInput(),
      'signatories_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmUser')),
      'partners_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Partner')),
      'products_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Product')),
      'tags_list'           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DmTag')),
    ));

    $this->setValidators(array(
      'title'               => new sfValidatorPass(array('required' => false)),
      'text'                => new sfValidatorPass(array('required' => false)),
      'slogan'              => new sfValidatorPass(array('required' => false)),
      'is_active'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'url_feed_actu'       => new sfValidatorPass(array('required' => false)),
      'url_feed_communique' => new sfValidatorPass(array('required' => false)),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'version'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'signatories_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmUser', 'required' => false)),
      'partners_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Partner', 'required' => false)),
      'products_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Product', 'required' => false)),
      'tags_list'           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DmTag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('petition_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addSignatoriesListColumnQuery(Doctrine_Query $query, $field, $values)
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
          ->andWhereIn('Signature.dm_user_id', $values);
  }

  public function addPartnersListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.PartnerPetition PartnerPetition')
          ->andWhereIn('PartnerPetition.partner_id', $values);
  }

  public function addProductsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.ProductPetition ProductPetition')
          ->andWhereIn('ProductPetition.product_id', $values);
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

    $query->leftJoin('r.PetitionDmTag PetitionDmTag')
          ->andWhereIn('PetitionDmTag.dm_tag_id', $values);
  }

  public function getModelName()
  {
    return 'Petition';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'title'               => 'Text',
      'text'                => 'Text',
      'slogan'              => 'Text',
      'is_active'           => 'Boolean',
      'url_feed_actu'       => 'Text',
      'url_feed_communique' => 'Text',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'version'             => 'Number',
      'signatories_list'    => 'ManyKey',
      'partners_list'       => 'ManyKey',
      'products_list'       => 'ManyKey',
      'tags_list'           => 'ManyKey',
    );
  }
}
