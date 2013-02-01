<?php

if (!$object || !$object->id)
{
  return;
}

use_helper('Date', 'DmMedia');

echo _open('div.dm_media_file');

echo _tag('h3.title.none', $object->getFile());

echo _open('div.clearfix');

  echo _tag('div.view',
   _link($object->getFullWebPath())->text(
    $object->isImage()
    ? _media($object)->size(250, 150)
    : _media('dmCore/images/media/unknown.png')->size(64, 64)
    )
  );

  $infos = media_file_infos($object);
  unset($infos['Создано в']);
  unset($infos['Обновлено в']);
  unset($infos['Url']);

  echo _tag('div.content',

    _tag('div.infos',
      definition_list($infos, '.clearfix.dm_little_dl')
    )
  );

echo _close('div');

echo _close('div');