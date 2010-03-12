<?php

/**
 * CollectionVersion filter form base class.
 *
 * @package    ape-petition
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCollectionVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dm_user_id'  => new sfWidgetFormFilterInput(),
      'petition_id' => new sfWidgetFormFilterInput(),
      'title'       => new sfWidgetFormFilterInput(),
      'text'        => new sfWidgetFormFilterInput(),
      'goal'        => new sfWidgetFormFilterInput(),
      'hash_code'   => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'to_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'to_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'dm_user_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'petition_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'title'       => new sfValidatorPass(array('required' => false)),
      'text'        => new sfValidatorPass(array('required' => false)),
      'goal'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hash_code'   => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('collection_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CollectionVersion';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'dm_user_id'  => 'Number',
      'petition_id' => 'Number',
      'title'       => 'Text',
      'text'        => 'Text',
      'goal'        => 'Number',
      'hash_code'   => 'Text',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'version'     => 'Number',
    );
  }
}
