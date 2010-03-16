<?php

echo _tag('div.content',
  _tag('h1', $petition->title).
  markdown($petition->resume, '.petition_resume').
  _tag('a.show_more', _tag('strong', '+')).
  markdown($petition->text, '.petition_text')
);