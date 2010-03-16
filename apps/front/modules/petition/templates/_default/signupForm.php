<?php

echo _tag('div.form',
  $form->open().
  $form['email']->label('Votre email')->field()->error().
  $form->renderHiddenFields().
  $form->submit('Devenir signataire').
  $form->close()
);