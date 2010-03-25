<?php

/*
 * Affichage des messages de confirmation
 */
if($sf_user->hasFlash('presentation_form'))
{
  echo _tag('p', 'Merci pour votre inscription. Vous recevrez très prochainement nos appels à Action.');
}

if($sf_user->hasFlash('creer_collecte_form'))
{
  echo _tag('p', 'Votre collecte a été créée.');
}

/*
 * Affichage du titre et de l'accroche
 * Différent si l'utilisateur vient de créer une collecte
 */
if($sf_user->hasFlash('creer_collecte_form'))
{
  echo _tag('h1', 'Diffusez votre pétition');
  echo _tag('p', 'Aidez nous à diffuser nos actions plus largement. Plus nous serons nombreux à les recevoir, plus nous serons efficaces.');
}
else
{
  echo _tag('h1', 'Diffusez cette pétition');
  echo _tag('p', 'Aidez nous à diffuser nos actions plus largement. Plus nous serons nombreux à les recevoir, plus nous serons efficaces.');
}

include_partial('inscription/steps', array('step' => 2));

/*
 * Affichage du formulaire
 */
echo $form->open();

echo _open('ul');

  echo _tag('li', $form['message']->label('Message *')->field()->error());

  echo _tag('li.open_inviter_form', array('json' => array(
    'url' => _link('+/email/contactImport')->getHref()
  )));

  echo _tag('li', $form['contacts']->label('Contacts')->field('.contacts_receiver')->error());

echo _close('ul');

echo _tag('p', 'Les champs marqué par * sont obligatoires.');

echo $form->renderHiddenFields();

echo $form->submit('Envoyer les invitations');

echo $form->close();

echo mailto('Diffuser par email', $form->getDefault('subject'), $form->getDefault('message'));
echo '<br />';
echo _link('http://facebook.com/')
->text('Partager sur Facebook');
echo '<br />';
echo _link('http://twitter.com/home')
->param('status', 'Le texte à faire twitter')
->text('Partager sur Twitter');
echo '<br />';
echo _link('inscription/recevoirCampagnes')->text('Etape suivante');