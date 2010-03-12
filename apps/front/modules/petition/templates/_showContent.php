<?php // Vars: $petition

if($action)
{
  echo _tag('div.objectif',
    _tag('strong', 'OBJECTIF').'<br />'.
    'Rassembler '.$action->goal.' signataires avant la prochaine action'
  );

  echo _tag('div.action',
    _tag('strong', 'ATTENTION').'<br />'.
    'Diffusion de notre prochain action dans seulement'.'<br />'.
    _tag('div.jquery_countdown', $action->counter)
  );
}

echo _tag('div.content',
  _tag('h1', $petition->title).
  markdown($petition->text)
);

echo _tag('div.form',
  $signupForm->open().
  $signupForm['email']->field()->error().
  $signupForm->renderHiddenFields().
  $signupForm->submit('Devenir signataire').
  $signupForm->close()
);