<?php

/**
 * Quest
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    bquest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Quest extends BaseQuest
{

  const RATING_QUALITY = 4;

  const STATUS_NEW      = 1;
  const STATUS_ASSIGNED = 2;
  const STATUS_READY    = 3;
  const STATUS_CLOSED   = 4;

  public static $statusChoices = array(
    self::STATUS_NEW      => 'Новое',
    self::STATUS_ASSIGNED => 'В работе',
    self::STATUS_READY    => 'Ждет оценки',
    self::STATUS_CLOSED   => 'Проверено',
  );

  public static $ratingChoices = array(
    1 => 1,
    2 => 2,
    3 => 3,
    4 => 4,
    5 => 5,
  );

  public function save( Doctrine_Connection $conn = null )
  {
    if ( ! $this->status )
    {
      $this->status = self::STATUS_NEW;
    }

    parent::save( $conn );
  }

  public static function getThemeChoices()
  {
    $choices = array();

    $res = explode( ';', dmConfig::get( 'quest_themes' ) );

    foreach ( $res as $str )
    {
      $choice = explode( '=', $str );
      $choices[ $choice[ 0 ] ] = $choice[ 1 ];
    }

    return array( 0 => '&mdash;' ) + $choices;
  }

  public static function getHelpTypeChoices()
  {
    $choices = array();

    $res = explode( ';', dmConfig::get( 'quest_help_types' ) );

    foreach ( $res as $str )
    {
      $choice = explode( '=', $str );

      if ( sizeof( $choice ) != 2 )
      {
        continue;
      }

      $choices[ $choice[ 0 ] ] = $choice[ 1 ];
    }

    return array( 0 => '&mdash;' ) + $choices;
  }

  /**
   * @param int $limit
   * @return Quest[]|Doctrine_Collection
   */
  public static function getAvailable( $limit = 10 )
  {
    return self::getAvailableQuery()
      ->limit( $limit )
      ->execute();
  }

  public function getThemeStr()
  {
    $choices = $this->getThemeChoices();

    return isset( $choices[ $this->theme ] ) ? $choices[ $this->theme ] : '&mdash;';
  }

  public function getHelpTypeStr()
  {
    $choices = $this->getHelpTypeChoices();

    return isset( $choices[ $this->help_type ] ) ? $choices[ $this->help_type ] : '&mdash;';
  }

  public function isStatusNew()
  {
    return $this->status == null || $this->status == self::STATUS_NEW;
  }

  public function isStatusAssigned()
  {
    return $this->status == self::STATUS_ASSIGNED;
  }

  public function isStatusReady()
  {
    return $this->status == self::STATUS_READY;
  }

  public function getStatusString()
  {
    if ( ! $this->status )
    {
      $this->status = self::STATUS_NEW;
    }

    return self::$statusChoices[ $this->status ];
  }

  /**
   * @param int $limit
   * @return Quest[]|Doctrine_Collection
   */
  public static function getClosedQuality( $limit = 10 )
  {
    return myDoctrineQuery::create()
      ->from( 'Quest q' )
      ->where( 'q.status = ? AND q.rating >= ? AND is_active = ?', array( self::STATUS_CLOSED, self::RATING_QUALITY, true ) )
      ->orderBy( 'q.updated_at DESC' )
      ->limit( $limit )
      ->execute();
  }

  /**
   * @return bool
   */
  public function hasReadyImage()
  {
    return $this->dm_media_id || $this->report_image_id;
  }

  /**
   * @return DmMedia
   */
  public function getReadyImage()
  {
    if ( $this->report_image_id )
    {
      return $this->ReportImage;
    }

    return $this->DmMedia;
  }

  public function getCreatedString()
  {
    return Util::getShortDate( $this->created_at );
  }

  public function getUpdatedString()
  {
    return Util::getShortDate( $this->updated_at );
  }

  public static function getReadyClosedQuery()
  {
    return myDoctrineQuery::create()
      ->from( 'Quest q' )
      ->whereIn( 'q.status', array( self::STATUS_READY, self::STATUS_CLOSED ) )
      ->addWhere( 'q.is_active = ?', true );
  }

  public static function getAvailableQuery()
  {
    return myDoctrineQuery::create()
      ->from( 'Quest q' )
      ->where( '( q.status = ? OR q.status IS NULL ) AND is_active = ?', array( self::STATUS_NEW, true ) )
      ->orderBy( 'q.created_at DESC' );
  }

  public static function getAssignedQuery()
  {
    return myDoctrineQuery::create()
      ->from( 'Quest q' )
      ->where( 'q.status = ? AND is_active = ?', array( self::STATUS_ASSIGNED, true ) )
      ->orderBy( 'q.updated_at DESC' );
  }

  public static function getInfoLine()
  {
    $ready     = self::getReadyClosedQuery()->count();
    $assigned  = self::getAssignedQuery()->count();
    $available = self::getAvailableQuery()->count();

    $words = array( 'доброе дело', 'добрых дела', 'добрых дел' );
    $verbs = array( 'ждет', 'ждут', 'ждут' );

    $tpl = '%s %s сделано, %s в процессе и еще %s %s своих героев!';

    return sprintf(
      $tpl,
      $ready,
      Util::getCorrectWord( $ready, $words ),
      $assigned,
      $available,
      Util::getCorrectWord( $available, $verbs )
    );
  }

  /**
   * @param int $limit
   * @return Doctrine_Collection|Quest[]
   */
  public static function getMapped( $limit = 10 )
  {
    return myDoctrineQuery::create()
      ->from( 'Quest q' )
      ->where( 'q.latlng IS NOT NULL AND q.latlng <> ? AND q.is_active = ?', array( '', true ) )
      ->orderBy( 'q.created_at DESC' )
      ->limit( $limit )
      ->execute()
      ;
  }

}
