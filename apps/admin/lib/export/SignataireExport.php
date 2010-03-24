<?php

class SignataireExport extends dmDoctrineTableExport
{

  protected function postConfigure()
  {
    $this->options['query']
    ->leftJoin('r.User u')
    ->leftJoin('u.Country c')
    ->select('r.id, u.email, u.first_name, u.last_name, u.profession, u.postal_code, c.name')
    ->groupBy('u.email');
  }

  protected function getFields()
  {
    return array(
      'email' => 'Email',
      'prenom' => 'Prénom',
      'nom' => 'Nom',
      'fonction' => 'Fonction',
      'code_postal' => 'Code postal',
      'pays' => 'Pays'
    );
  }

  public function getEmail(Signature $signature)
  {
    return $signature->get('User')->get('email');
  }

  public function getPrenom(Signature $signature)
  {
    return $signature->get('User')->get('first_name');
  }

  public function getNom(Signature $signature)
  {
    return $signature->get('User')->get('last_name');
  }

  public function getFonction(Signature $signature)
  {
    return $signature->get('User')->get('profession');
  }

  public function getCodePostal(Signature $signature)
  {
    return $signature->get('User')->get('postal_code');
  }

  public function getPays(Signature $signature)
  {
    return ($country = $signature->get('User')->get('Country')) ? $country->get('name') : null;
  }
}