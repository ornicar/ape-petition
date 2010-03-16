<?php

if(!count($petition->activeCollections))
{
  return;
}

echo _open('div.collections');

  echo _tag('h2', 'Pages de collecte');

  echo _open('ul');

  foreach($petition->bestActiveCollections as $collection)
  {
    echo _open('li.clearfix');

      echo _link($collection)->text(
        $collection->User->fullName.' ( '.$collection->nb.'/'.$collection->goal.' )'
      );

    echo _close('li');
  }

  echo _close('ul');

echo _close('div');