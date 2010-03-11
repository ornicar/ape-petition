<?php

/**
 * ActionVersion filter form base class.
 *
 * @package    ape-petition
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseActionVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'petition_id' => new sfWidgetFormFilterInput(),
      'title'       => new sfWidgetFormFilterInput(),
      'text'        => new sfWidgetFormFilterInput(),
      'begin_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'to_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'with_empty' => true)),
      'goal'        => new sfWidgetFormFilterInput(),
      'is_active'   => new sfWidgetFormChoice(array('choices' => array('' => dm::getI18n()->__('yes or no', array(), 'dm'), 1 => dm::getI18n()->__('yes', array(), 'dm'), 0 => dm::getI18n()->__('no', array(), 'dm')))),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'to_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'to_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'petition_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'title'       => new sfValidatorPass(array('required' => false)),
      'text'        => new sfValidatorPass(array('required' => false)),
      'begin_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'goal'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_active'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('action_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ActionVersion';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'petition_id' => 'Number',
      'title'       => 'Text',
      'text'        => 'Text',
      'begin_at'    => 'Date',
      'goal'        => 'Number',
      'is_active'   => 'Boolean',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'version'     => 'Number',
    );
  }
}
