<?php

/**
 * Collecte form.
 *
 * @package    ape-petition
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollecteForm extends BaseCollecteForm
{
  public function configure()
  {
    unset($this['hash_code']);
  }
}
