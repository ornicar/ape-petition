<?php

if(!count($petition->activeProducts))
{
  return;
}

echo _open('div.products');

  echo _tag('h2', 'Boutique');

  echo _open('ul');

  foreach($petition->activeProducts as $product)
  {
    echo _open('li.clearfix');

      echo _media($product->Image)->size(120, 120)->alt($product->title);
      echo _link($product->url)->text($product->title);
      echo $product->text;

    echo _close('li');
  }

  echo _close('ul');

echo _close('div');