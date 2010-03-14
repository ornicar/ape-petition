<?php

echo _tag('div.form',
  $form->open('action='._link($collection->Petition)->getHref()).
  $form['email']->label('Votre email')->field()->error().
  $form->renderHiddenFields().
  $form->submit('Devenir signataire').
  $form->close()
);