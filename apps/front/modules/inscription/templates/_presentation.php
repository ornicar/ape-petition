<?php

if($sf_user->hasFlash('suscribe_action_form'))
{
  echo _tag('p', 'Votre email a bien été enregistré.');
}

include_partial('inscription/steps', array('step' => 1));

echo $form->open();

echo _open('ul');

  echo _tag('li', 'Votre email : '.$user->email);

  echo _tag('li', $form['first_name']->label('Votre prénom *')->field()->error());

  echo _tag('li', $form['last_name']->label('Votre nom *')->field()->error());

  echo _tag('li', $form['profession']->label('Votre fonction')->field()->error());

  echo _tag('li', $form['country_id']->label('Pays *')->field()->error());

  echo _tag('li', $form['postal_code']->label('Code postal *')->field()->error());

  echo _tag('li', $form['city']->label('Ville')->field()->error());

  echo _tag('li', $form['street']->label('Adresse')->field()->error());

  if(isset($form['is_letter_actu']))
  {
    echo _tag('li',
      $form['is_letter_actu']->label('La newsletter')->field().
      _tag('p.help', "Je souhaite aussi recevoir la Newsletter hedomadaire d'Agir Pour l'Environnement pour suivre l'actualité des actions et de l'association.")
    );
  }

echo _close('ul');

echo _tag('p', 'Les champs marqué par * sont obligatoires.');

echo $form->renderHiddenFields();

echo $form->submit('Etape suivante');

echo $form->close();