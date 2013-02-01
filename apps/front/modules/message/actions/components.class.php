<?php
/**
 * Сообщение components
 *
 * No redirection nor database manipulation ( insert, update, delete ) here
 */
class messageComponents extends myFrontModuleComponents
{

  public function executeSide(dmWebRequest $request)
  {
    $this->messages = Message::getLatests( 4 );
  }

  public function executeList(dmWebRequest $request)
  {
    $query = $this->getListQuery();

    $this->messagePager = $this->getPager($query);
  }

  public function executeShow(dmWebRequest $request)
  {
    $query = $this->getShowQuery();

    $this->message = $this->getRecord($query);
  }


}
