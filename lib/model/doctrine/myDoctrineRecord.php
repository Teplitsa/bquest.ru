<?php

abstract class myDoctrineRecord extends dmDoctrineRecord
{

  /**
   * @static
   * @param $id
   * @return myDoctrineRecord
   * @throws dmException
   */
  public static function getById( $id )
  {
    $id = (int) $id;

    if ( ! $id )
    {
      throw new dmException( 'No valid ID' );
    }

    $query = myDoctrineQuery::create()
      ->from( get_called_class().' o' )
      ->where( 'o.id = ? ', $id )
      ->limit(1);

    $object = $query->fetchOne();

    return $object;
  }

}
