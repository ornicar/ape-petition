<?php

echo _tag('h2', "Pourquoi ".$collection->User->fullName." participe à cette action ?");

echo _tag('div', simple_format_text($collection->text));