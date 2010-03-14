<?php

echo _tag('h2', "Pour soutenir l'association");

echo _link('http://diem-project.org')->param('email', $email)->text('Faire un don');
echo '<br />';
echo _link('http://diem-project.org')->param('email', $email)->text('Acheter du matériel militant');
echo '<br />';
echo _link('inscription/suivreActu')->text('Terminer');