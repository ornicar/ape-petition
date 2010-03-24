<?php

if(!$petition->communiqueFeedUrl)
{
  return;
}

echo _open('div.communiques');

  echo _tag('h2', 'Communiqués');

  echo _tag('ul.links',
    _tag('li', _link('http://diem-project.org')->text('Email')).
    _tag('li', _link('http://diem-project.org/blog/rss')->text('RSS'))
  );

  $items = $petition->communiqueFeedItems;
  // utiliser uniquement les 3 premiers communiqués
  $items = array_slice($items, 0, 3);

  echo _open('ul');
  
  foreach($items as $item)
  {
    echo _open('li.communique');
    
      echo _tag('h3', _link($item->getLink())->text(escape($item->getTitle())));

      echo _tag('p.date', format_date($item->getPubDate(), 'd'));
      echo _tag('p.author', strip_tags($item->getAuthorName()));

    echo _close('li');
  }

  echo _close('ul');

  echo _link($petition->communiquePageUrl)->text('Tous les communiqués');

echo _close('div');