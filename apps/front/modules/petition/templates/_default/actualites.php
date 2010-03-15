<?php

echo _open('div.actualites');

  echo _tag('h2', 'Actualités');

  echo _tag('ul.links',
    _tag('li', _link('http://diem-project.org')->text('Email')).
    _tag('li', _link('http://diem-project.org/blog/rss')->text('RSS')).
    _tag('li', _link($petition->facebookPageUrl)->text('Facebook')).
    _tag('li', _link($petition->twitterPageUrl)->text('Twitter'))
  );

  // utiliser uniquement le premier item
  if(isset($petition->actuFeedItems[0]))
  {
    $item = $petition->actuFeedItems[0];
    
    echo _tag('h3', _link($item->getLink())->text(escape($item->getTitle())));

    echo _open('div.description.clearfix');

      if($item->getEnclosure())
      {
        echo _media($item->getEnclosure())->size(300, 200)->set('.fright');
      }

      echo truncate_text(strip_tags($item->getDescription()), 280);

    echo _close('div');
  }

  echo _link($petition->actuPageUrl)->text('Toutes les actualités');

echo _close('div');