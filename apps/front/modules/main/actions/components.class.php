<?php
/**
 * Main components
 *
 * No redirection nor database manipulation ( insert, update, delete ) here
 *
 */
class mainComponents extends myFrontModuleComponents
{

  public function executeHeader(dmWebRequest $request)
  {
    // Your code here
  }

  public function executeFooter(dmWebRequest $request)
  {
    // Your code here
  }

  public function executeMenu()
  {
    $this->menu = $this->getService( 'menu' );
    $this->menu
      ->addChild('О квесте',  'main/about')->end()
      ->addChild('Правила',   'main/rules')->end()
      ->addChild('Участники', 'agency/list')->end()
      ->addChild('Партнеры',  'main/partners')->end()
      ->addChild('Контакты',  'main/contacts')->end()
      ->end();
  }

  public function executeQuests(dmWebRequest $request)
  {
    $this->closed    = Quest::getClosedQuality( 10 );
    $this->available = Quest::getAvailable( 10 );
  }

  public function executeMapnteam( dmWebRequest $request )
  {
    $this->teams  = Team::getBest( 10 );
    $this->quests = Quest::getMapped( 30 );
  }

}
