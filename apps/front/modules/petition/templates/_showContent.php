<?php

/*
 * Prochaine action
 */
include_partial('petition/_nextAction', array('petition' => $petition));

/*
 * Titre et description de la pétition
 */
include_partial('petition/_description', array('petition' => $petition));

/*
 * Formulaire de signature de la pétition
 */
include_partial('petition/_signupForm', array('form' => $signupForm));

/*
 * Actualités
 */
include_partial('petition/_actualites', array('petition' => $petition));

/*
 * Communiqués
 */
include_partial('petition/_communiques', array('petition' => $petition));

/*
 * Boutique
 */
include_partial('petition/_products', array('petition' => $petition));

/*
 * Partenaires
 */
include_partial('petition/_partners', array('petition' => $petition));