<?php

/**
 * DmAutoSeoTranslation filter form base class.
 *
 * @package    ape-petition
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDmAutoSeoTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'slug'        => new sfWidgetFormFilterInput(),
      'name'        => new sfWidgetFormFilterInput(),
      'title'       => new sfWidgetFormFilterInput(),
      'h1'          => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'keywords'    => new sfWidgetFormFilterInput(),
      'strip_words' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'slug'        => new sfValidatorPass(array('required' => false)),
      'name'        => new sfValidatorPass(array('required' => false)),
      'title'       => new sfValidatorPass(array('required' => false)),
      'h1'          => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'keywords'    => new sfValidatorPass(array('required' => false)),
      'strip_words' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dm_auto_seo_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DmAutoSeoTranslation';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'slug'        => 'Text',
      'name'        => 'Text',
      'title'       => 'Text',
      'h1'          => 'Text',
      'description' => 'Text',
      'keywords'    => 'Text',
      'strip_words' => 'Text',
      'lang'        => 'Text',
    );
  }
}
