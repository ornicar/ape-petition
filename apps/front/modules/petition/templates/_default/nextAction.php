<?php

if(!$action = $petition->nextAction)
{
  return;
}

/*
 * Objectif de la prochaine action
 */
echo _tag('div.objectif',
  _tag('strong', 'OBJECTIF').'<br />'.
  'Rassembler '.$action->goal.' signataires avant la prochaine action'.
  _tag('p', 'Contacts : '.$petition->nbSignatures.' / '.$action->goal)
);

/*
 * Compteur de la prochaine action
 */
echo _tag('div.action.clearfix',
  _tag('strong', 'ATTENTION').'<br />'.
  $action->title.', dans'.'<br />'.
  _tag('div.jquery_countdown', $action->counter)
);