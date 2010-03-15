<?php
use_helper('Date');

$table = _table();

foreach($contacts as $contact)
{
  $table->body(
    format_date($contact->createdAt, 'D').'<br />'.$contact->email,
    dmString::truncate($contact->body, 80),
    _link($contact)->text('Voir')
  );
}

echo _tag('div.dm_box',
  _tag('div.title',
    £link('@dm_contact')->set('.s16block.s16_arrow_up_right')->title(__('Voir les contacts non traités')).
    _tag('h2', 'Contacts non traités ( '.count($contacts).' )')
  ).
  _tag('div.dm_box_inner.dm_data', $table)
);