<?php

class SitemapMenu extends dmSitemapMenu
{

  protected function getPagesQuery()
  {
    return parent::getPagesQuery()->andWhere('p.module != ?', 'collection');
  }
}