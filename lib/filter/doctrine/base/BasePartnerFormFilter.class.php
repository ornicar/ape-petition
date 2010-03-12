<?php

/**
 * Partner filter form base class.
 *
 * @package    ape-petition
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePartnerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'          => new sfWidgetFormFilterInput(),
      'url'            => new sfWidgetFormFilterInput(),
      'image_id'       => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'to_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'to_date' => new sfWidgetFormInputText(array(), array("class" => "datepicker_me")), 'with_empty' => false)),
      'version'        => new sfWidgetFormFilterInput(),
      'petitions_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Petition')),
    ));

    $this->setValidators(array(
      'title'          => new sfValidatorPass(array('required' => false)),
      'url'            => new sfValidatorPass(array('required' => false)),
      'image_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'version'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'petitions_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Petition', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('partner_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addPetitionsListColumnQuery(Doctrine_Query $query, $field, $values)
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
          ->andWhereIn('PartnerPetition.petition_id', $values);
  }

  public function getModelName()
  {
    return 'Partner';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'title'          => 'Text',
      'url'            => 'Text',
      'image_id'       => 'Number',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'version'        => 'Number',
      'petitions_list' => 'ManyKey',
    );
  }
}
