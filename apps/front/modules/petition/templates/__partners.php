<?php

if(!count($petition->activePartners))
{
  return;
}

echo _open('div.partners');

  echo _tag('h2', 'Partenaires de la pétition');

  echo _open('ul');

  foreach($petition->activePartners as $partner)
  {
    echo _open('li.clearfix');

      echo _link($partner->url)->text(
        _media($partner->Image)->size(120, 120)->alt($partner->title)
      );

    echo _close('li');
  }

  echo _close('ul');

echo _close('div');