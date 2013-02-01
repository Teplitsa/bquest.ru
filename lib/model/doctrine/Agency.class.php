<?php

/**
 * Agency
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    bquest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Agency extends BaseAgency
{

  public function getCode()
  {
    return sha1( base64_encode( $this->getId() ) );
  }

  public function getQuestsQuery( $status = false )
  {
    $query = myDoctrineQuery::create()
      ->from( 'Quest q' )
      ->where( 'q.agency_id = ?', $this->id );

    if ( $status && in_array( $status, array_keys( Quest::$statusChoices ) ) )
    {
      $query->addWhere( 'q.status = ?', $status );
    }

    return $query;
  }

  /**
   * @return Quest[]|Doctrine_Collection
   */
  public function getReadyQuests()
  {
    return $this->getQuestsQuery( Quest::STATUS_READY )->execute();
  }

  /**
   * @return Quest[]|Doctrine_Collection
   */
  public function getClosedQuests()
  {
    return $this->getQuestsQuery( Quest::STATUS_CLOSED )->execute();
  }

  /**
   * @return Quest[]|Doctrine_Collection
   */
  public function getNewQuests()
  {
    return $this->getQuestsQuery( Quest::STATUS_NEW )->execute();
  }

  /**
   * @return Quest[]|Doctrine_Collection
   */
  public function getAssignedQuests()
  {
    return $this->getQuestsQuery( Quest::STATUS_ASSIGNED )->execute();
  }

  public function getWebsiteSmart()
  {
    $str = Util::trim( $this->getWebsite(), 255 );

    if ( $str && strpos( $str, 'http://' ) === false )
    {
      $str = 'http://' . $str;
    }

    return $str;
  }

}
