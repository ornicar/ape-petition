<?php

if(!$action)
{
  return;
}

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
echo _tag('div.action.clearfix',
  _tag('strong', 'ATTENTION').'<br />'.
  'Diffusion de notre prochain action dans seulement'.'<br />'.
  _tag('div.jquery_countdown', $action->counter)
);