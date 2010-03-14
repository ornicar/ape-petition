<?php

use_stylesheet('petition/other');

/*
 * Prochaine action
 */
include_petition_partial($petition, 'nextAction');

/*
 * Titre et description de la pétition
 */
include_petition_partial($petition, 'description');

/*
 * Formulaire de signature de la pétition
 */
include_petition_partial($petition, 'signupForm', array('form' => $signupForm));

/*
 * Partager la page
 */
include_petition_partial($petition, 'share');

/*
 * Actualités
 */
include_petition_partial($petition, 'actualites');

/*
 * Communiqués
 */
include_petition_partial($petition, 'communiques');

/*
 * Boutique
 */
include_petition_partial($petition, 'products');

/*
 * Partenaires
 */
include_petition_partial($petition, 'partners');

/*
 * Collectes
 */
include_petition_partial($petition, 'collections');