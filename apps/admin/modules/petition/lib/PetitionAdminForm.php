<?php

/**
 * petition admin form
 *
 * @package    ape-petition
 * @subpackage petition
 * @author     Your name here
 */
class PetitionAdminForm extends BasePetitionForm
{
  public function configure()
  {
    parent::configure();

    $this->widgetSchema['slogan'] = new sfWidgetFormInputText();

    $this->widgetSchema['style'] = new sfWidgetFormSelect(array(
      'choices' => dmArray::valueToKey($this->getStyles())
    ));

    $this->validatorSchema['style'] = new sfValidatorChoice(array(
      'choices' => $this->getStyles()
    ));
  }

  protected function getStyles()
  {
    $templates = sfFinder::type('file')
    ->name('petition.php')
    ->in(sfConfig::get('sf_root_dir').'/apps/front/modules/petition/templates');

    $styles = array();
    foreach($templates as $template)
    {
      $styles[] = trim(basename(dirname($template)), '_');
    }

    return $styles;
  }
}