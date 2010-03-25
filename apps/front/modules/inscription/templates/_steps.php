<?php

$steps = array(
  1 => 'Vos informations',
  2 => 'Diffusez ce site',
  3 => 'Recevez les cartes pétitions',
  4 => 'Soutenez l\'association'
);

echo _open('ol.steps');

foreach($steps as $number => $name)
{
  if($step == $number)
  {
    echo _tag('li.current', _tag('strong', $name));
  }
  else
  {
    echo _tag('li', $name);
  }
}

echo _close('ol');