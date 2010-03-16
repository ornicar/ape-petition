<?php

echo _tag('h2', "Se rassembler et recevoir les actions d'Agir Pour l'Environnement :");

echo _tag('div.form',
  $form->open().
  $form['email']->label('Votre email')->field()->error().
  $form->renderHiddenFields().
  $form->submit('Recevoir les actions').
  $form->close()
);

echo _link('main/protectionDonnees');