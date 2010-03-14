<?php

if($sf_user->hasFlash('edit_collection_form'))
{
  echo _tag('p', 'Votre page de collecte a été modifiée');
}

if(!$form)
{
  return;
}

echo _tag('h2', 'Modifier ma page de collecte');

echo $form->open();

echo _tag('input type="hidden" name="code"', $collection->hashCode);

echo _open('ul');

  echo _tag('li', $form['title']->label('Titre de la collecte *')->field()->error());

  echo _tag('li', $form['goal']->label('Mon objectif *')->field()->error());

  echo _tag('li', $form['text']->label('Pourquoi participer à cette pétition *')->field()->error());

echo _close('ul');

echo $form->renderHiddenFields();

echo $form->submit('Modifier ma page de collecte');

echo $form->close();