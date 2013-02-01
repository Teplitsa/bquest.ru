<?php
/**
 * User: makz
 * Date: 19.11.12
 * Time: 13:50
 */

$user = dm::getUser();

foreach ( array( 'error', 'notice', 'message' ) as $type )
{
  if ( $user->hasFlash( $type ) )
  {
    echo _tag( "p.$type", $user->getFlash( $type ) );
  }
}
