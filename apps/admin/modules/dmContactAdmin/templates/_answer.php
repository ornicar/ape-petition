<?php

$dmContact = isset($dm_contact) ? $dm_contact : $dmContact;

echo _link('mailto:'.$dmContact->email.'?body='.$dmContact->body)->text('Répondre');