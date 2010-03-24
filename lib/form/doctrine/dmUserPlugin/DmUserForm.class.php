<?php

/**
 * DmUser form.
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class DmUserForm extends PluginDmUserForm
{
  public function configure()
  {
    unset($this['username']);

    $this->widgetSchema['profession'] = new sfWidgetFormInputText();

    $this->widgetSchema['country_id']->setOption('add_empty', false);

    $this->setDefault('country_id', $this->getDefaultCountryId());

    foreach($this->validatorSchema->getFields() as $field => $validator)
    {
      if($validator instanceof sfValidatorString)
      {
        $this->validatorSchema[$field] = new dmValidatorStringEscape($validator->getOptions(), $validator->getMessages());
      }
    }
  }

  protected function getDefaultCountryId()
  {
    return dmArray::first(dmDb::query('Country c')
    ->select('c.id')
    ->where('c.name = ?', 'France')
    ->fetchFlat());
  }
}