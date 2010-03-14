<?php // Vars: $siteWidgetPager

echo $siteWidgetPager->renderNavigationTop();

echo _open('ul');

foreach ($siteWidgetPager as $siteWidget)
{
  echo _open('li');

    echo _tag('h2', $siteWidget->title);

    echo markdown($siteWidget->text);

    echo strtr($siteWidget->code, $replacements);

    echo _tag('pre', escape(strtr($siteWidget->code, $replacements)));

  echo _close('li');
}

echo _close('ul');

echo $siteWidgetPager->renderNavigationBottom();