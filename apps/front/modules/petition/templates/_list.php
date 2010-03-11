<?php // Vars: $petitionPager

echo $petitionPager->renderNavigationTop();

echo _open('ul.elements');

foreach ($petitionPager as $petition)
{
  echo _open('li.element');

    echo $petition;

  echo _close('li');
}

echo _close('ul');

echo $petitionPager->renderNavigationBottom();