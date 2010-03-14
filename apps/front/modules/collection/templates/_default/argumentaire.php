<?php

echo _tag('h2', "Pourquoi ".$collection->User->fullName." a-t-il participé à cette action ?");

echo _tag('div', simple_format_text($collection->text));