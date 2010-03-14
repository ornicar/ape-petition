<?php

function get_petition_partial(Petition $petition, $name, array $params = array())
{
  $style = $petition->style;

  $params += array(
    'petition' => $petition
  );

  if(file_exists(sfConfig::get('sf_apps_dir').'/front/modules/petition/templates/_'.$style.'/'.$name.'.php'))
  {
    return get_partial('petition/'.$style.'/'.$name, $params);
  }

  return get_partial('petition/default/'.$name, $params);
}

function include_petition_partial(Petition $petition, $name, array $params = array())
{
  echo get_petition_partial($petition, $name, $params);
}

function get_collection_partial(Collection $collection, $name, array $params = array())
{
  $style = $collection->style;

  $params += array(
    'collection' => $collection
  );

  if(file_exists(sfConfig::get('sf_apps_dir').'/front/modules/collection/templates/_'.$style.'/'.$name.'.php'))
  {
    return get_partial('collection/'.$style.'/'.$name, $params);
  }

  return get_partial('collection/default/'.$name, $params);
}

function include_collection_partial(Collection $collection, $name, array $params = array())
{
  echo get_collection_partial($collection, $name, $params);
}