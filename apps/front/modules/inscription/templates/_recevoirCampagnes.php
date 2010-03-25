<?php

include_partial('inscription/steps', array('step' => 3));

echo _tag('h2', 'Abonnement annuel');

echo _tag('p', "Abonnez vous pour soutenir l'association et recevez pendant une année :

- les 4 ou 5 campagnes cartes pétition,

- La lettre bilan de l'association.");

echo _link('http://diem-project.org')->param('email', $email)->text('Abonnez-vous');

echo _tag('h2', 'Exemplaire gratuit');

echo _tag('p', "Recevez gratuitement un exemplaire de nos campagnes cartes pétitions.

L'idée : Nous envoyons aussi la campagne suivante gratuitement, si :
- Vous participez à la campagne précédente,
- Vous faites un don,
- Vous achetez du matériel militant.");

echo _link('http://diem-project.org')->param('email', $email)->text('Recevoir une campagne papier');


echo '<br />';

echo _link('inscription/soutenir')->text('Etape suivante');