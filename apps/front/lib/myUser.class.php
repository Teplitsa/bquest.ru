<?php

class myUser extends dmFrontUser
{

  /**
   * Signs in the user on the application.
   *
   * @param DmUser              $user     The DmUser id
   * @param boolean             $remember Whether or not to remember the user
   * @param Doctrine_Connection $con      A Doctrine_Connection object
   */
  public function signIn( DmUser $user, $remember = true, $con = null )
  {
    // signin
    $this->setAttribute( 'user_id', $user->get( 'id' ), 'dmSecurityUser' );
    $this->setAuthenticated( true );
    $this->clearCredentials();
    $this->addCredentials( $user->getAllPermissionNames() );
    $this->isSuperAdmin = $user->get( 'is_super_admin' );

    // save last login
    dmDb::table( 'DmUser' )
      ->createQuery()
      ->update( 'DmUser' )
      ->where( 'id = ?', $user->get( 'id' ) )
      ->set( 'last_login', "'" . date( 'Y-m-d H:i:s' ) . "'" )
      ->execute();

    $this->user = $user;

    // remember always no matter
    try
    {
      $expirationAge = $this->getRememberKeyExpirationAge();

      // remove old keys
      Doctrine_Core::getTable( 'DmRememberKey' )->createQuery()->delete()->where( 'created_at < ?', date( 'Y-m-d H:i:s', time() - $expirationAge ) )->execute();

      // generate new keys
      $key = md5( dmString::random( 20 ) );

      // save key
      $rk = new DmRememberKey();
      $rk->setRememberKey( $key );
      $rk->setUser( $user );
      $rk->setIpAddress( $_SERVER[ 'REMOTE_ADDR' ] );
      $rk->save( $con );

      $this->dispatcher->notify( new sfEvent( $this, 'user.remember_me', array(
        'remember_key'   => $key,
        'expiration_age' => $expirationAge
      ) ) );
    }
    catch ( Exception $e )
    {

    }

    $this->dispatcher->notify( new sfEvent( $this, 'user.sign_in' ) );
  }

}