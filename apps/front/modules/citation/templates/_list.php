<?php // Vars: $citationPager

echo _tag('h2', 'Citations');

echo _open('ul');

foreach ($citationPager as $citation)
{
  echo _open('li');

    echo _tag('p.text', markdown($citation->text));
    echo _tag('p.source', markdown($citation->source));

  echo _close('li');
}

echo _close('ul');

echo _tag('span#citation_previous', '&lt;');
echo _tag('span#citation_next', '&gt;');