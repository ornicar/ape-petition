<?php
use_stylesheet('export');

echo _open('div.export.clearfix.mt10');

echo _open('div.dm_box.fleft style="width:48%;margin-right:1%;"');

  echo _tag('h2.title', 'Exporter les signataires d\'une pétition');

  echo _open('div.dm_box_inner');

    echo $signataireFilter->render('.dm_form.list.little');

  echo _close('div');

echo _close('div');

echo _open('div.dm_box.fleft style="width:48%;margin-left:1%;"');

  echo _tag('h2.title', 'Exporter des emails');

  echo _open('div.dm_box_inner');

    echo $emailFilter->render('.dm_form.list.little');

    if(isset($emailDebug))
    {
      echo nl2br($emailDebug);
    }

  echo _close('div');

echo _close('div');

echo _close('div');