<?php

/*
 * Formulaire de modification de la page
 */
include_collection_partial($collection, 'form', array('form' => $form));

/*
 * Bandeau objectif et prochaine action de la pétition
 */
include_petition_partial($collection->Petition, 'nextAction');

/*
 * Photo de l'utilisateur
 */
include_collection_partial($collection, 'photo');

/*
 * Objectif de la collecte
 */
include_collection_partial($collection, 'objectif');

/*
 * Argumentaire de la collecte
 */
include_collection_partial($collection, 'argumentaire');

/*
 * Titre et description de la pétition
 */
include_petition_partial($collection->Petition, 'description');

/*
 * Formulaire de signature de la pétition
 */
include_collection_partial($collection, 'signupForm', array('form' => $signupForm));

/*
 * Partager la page
 */
include_collection_partial($collection, 'share');

/*
 * Actualités
 */
include_petition_partial($collection->Petition, 'actualites');

/*
 * Communiqués
 */
include_petition_partial($collection->Petition, 'communiques');

/*
 * Boutique
 */
include_petition_partial($collection->Petition, 'products');

/*
 * Partenaires
 */
include_petition_partial($collection->Petition, 'partners');

/*
 * Collectes
 */
include_petition_partial($collection->Petition, 'collections');