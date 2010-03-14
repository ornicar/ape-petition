<?php

echo $form['email']->label('Votre email')->field('.email')->error();

echo $form['password']->label('Votre mot de passe')->field('.password')->error();

echo $form['provider']->label('Fournisseur')->field('.provider')->error();

echo _tag('div.contacts.none', implode("\n", array_keys((array) $form->getValue('contacts'))));

echo _tag('a.import_contacts', 'Importer');