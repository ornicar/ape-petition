<?php

/*
 * Objectif de la collecte
 */
echo _tag('div.objectif',
  _tag('strong', 'Objectif de '.$collection->User->fullName).'<br />'.
  'Rassembler '.$collection->goal.' signataires'.
  _tag('p', 'Contacts : '.$collection->nbSignatures.' / '.$collection->goal)
);