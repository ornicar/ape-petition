<?php

if($sf_user->hasFlash('presentation_form'))
{
  echo _tag('p', 'Merci pour votre inscription. Vous recevrez très prochainement nos appels à Action.');
}

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

echo _link('mailto:')->text('Diffuser par email');
echo '<br />';
echo _link('http://facebook.com/')
->text('Partager sur Facebook');
echo '<br />';
echo _link('http://twitter.com/home')
->param('status', 'Le texte à faire twitter')
->text('Partager sur Twitter');
echo '<br />';
echo _link('inscription/recevoirCampagnes')->text('Etape suivante');