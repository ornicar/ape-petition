<?php

if($sf_user->hasFlash('unsuscribe_letter_form'))
{
  echo _tag('p', 'Vous modifications ont été appliquées');
}

echo $form->open();

echo _tag('ul',

  _tag('li', $form['email']->label('Votre email')->field()->error()).

  _tag('li', $form['unsuscribe']->field()->error())

);

echo $form->renderHiddenFields();

echo $form->submit('Valider');

echo $form->close();