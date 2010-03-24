<?php // Vars: $actionPager

echo $actionPager->renderNavigationTop();

echo _open('ul.elements');

foreach ($actionPager as $action)
{
  echo _open('li.element');

    echo $action;

  echo _close('li');
}

echo _close('ul');

echo $actionPager->renderNavigationBottom();