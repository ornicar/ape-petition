<?php

echo _tag('div.content',
  _tag('h1', $petition->title).
  markdown($petition->text)
);