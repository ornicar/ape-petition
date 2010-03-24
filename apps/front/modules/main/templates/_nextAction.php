<?php

/*
 * Objectif de la prochaine action
 */
echo _tag('div.objectif',
  _tag('strong', 'OBJECTIF').'<br />'.
  'Rassembler '.$objectif.' signataires avant la prochaine action'.
  _tag('p', 'Contacts : '.$nbContacts.' / '.$objectif)
);

/*
 * Compteur de la prochaine action
 */
if($timer > 0)
{
  echo _tag('div.action.clearfix',
    _tag('strong', 'ATTENTION').'<br />'.
    'Diffusion de notre prochain action dans seulement'.'<br />'.
    _tag('div.jquery_countdown', $timer)
  );
}
else
{
  echo _tag('div', 'Message d\'attente');
}