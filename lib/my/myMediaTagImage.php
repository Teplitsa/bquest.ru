<?php

class myMediaTagImage extends dmMediaTagImage
{

  public function getDefaultOptions()
  {
    // если alt не установлен - хелпер лезет в базу искать что-нибудь подходящее
    // облегчим ему работу, установив пустой альт
    return array_merge( parent::getDefaultOptions(), array(
      'absolute' => false,
      'alt' => dmConfig::get('site_name', ''),
    ) );
  }

}