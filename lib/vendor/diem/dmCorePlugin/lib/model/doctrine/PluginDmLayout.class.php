<?php

/**
 * PluginDmLayout
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
abstract class PluginDmLayout extends BaseDmLayout
{
  /**
   * How many pages use this layout?
   */
  public function getNbPages()
  {
    $nb = 0;
    
    foreach($this->get('PageViews') as $pageView)
    {
      $nb += dmDb::query('DmPage p')
      ->where('p.module = ?', $pageView->module)
      ->andWhere('p.action = ?', $pageView->action)
      ->count();
    }

    return $nb;
  }

  public function duplicate()
  {
    $newLayout = $this->getTable()->create(array(
      'css_class' => $this->cssClass,
      'name' => $this->name
    ));
    
    do
    {
      $newLayout->set('name', $newLayout->get('name').' copy');
    }
    while($this->getTable()->createQuery('l')->where('l.name = ?', $newLayout->get('name'))->exists());
    
    foreach($this->get('Areas') as $area)
    {
      $newArea = $area->copy(false);
      
      foreach($area->get('Zones') as $zone)
      {
        $newZone = $zone->copy(false);
        
        foreach($zone->get('Widgets') as $widget)
        {
          $widget->get('Translation');
          $newZone->get('Widgets')->add($widget->copy(true));
        }
        
        $newArea->get('Zones')->add($newZone);
      }
      
      $newLayout->get('Areas')->add($newArea);
    }
    
    return $newLayout;
  }

  public function getArea($type)
  {
    foreach($this->get('Areas') as $area)
    {
      if($area->get('type') == $type)
      {
        return $area;
      }
    }

    $area = dmDb::create('DmArea', array(
      'dm_layout_id' => $this->get('id'),
      'type' => $type
    ))->saveGet();

    $this->get('Areas')->add($area);

    return $area;
  }

  public function postDelete($event)
  {
    parent::postDelete($event);

    $this->get('Areas')->delete();
  }

}