<?php

if($sf_user->hasFlash('presentation_form'))
{
  echo _tag('p', 'Merci pour votre inscription. Vous recevrez très prochainement nos appels à Action.');
}

echo $form->open();

echo _open('ul');

  if(isset($form['gender']))
  {
    echo _tag('li', $form['gender']->label('Genre *')->field()->error());
  }

  if(isset($form['photo']))
  {
    echo _tag('li', $form['photo']->label('Ajoutez votre photo *')->field()->error());
  }

  echo _tag('li', $form['goal']->label('Mon objectif *')->field()->error());

  echo _tag('li', $form['text']->label('Pourquoi participer à cette pétition *')->field()->error());

  echo _tag('li', $form['accept_conditions']->label("J'accepte les conditions d'utilisation")->field()->error());

echo _close('ul');

echo _tag('p', 'Les champs marqué par * sont obligatoires.');

echo $form->renderHiddenFields();

echo $form->submit('Créer sa page de collecte personnalisée');

echo $form->close();

echo _link('inscription/diffuser')->text('Ignorer cette étape');