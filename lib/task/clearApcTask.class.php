<?php
/**
 * User: makz
 * Date: 11.10.12
 * Time: 20:57
 */

class clearApcTask extends sfBaseTask
{

  protected function configure()
  {
    parent::configure();
    $this->addArgument( 'URL', sfCommandArgument::REQUIRED );

    $this->namespace = 'clear';
    $this->name      = 'apc';
  }

  protected function execute( $arguments = array(), $options = array() )
  {
    $this->log( "Start" );

    $apcPaths[ 'stuff' ] = sfConfig::get( 'sf_root_dir' ) . '/stuff/apc_clear.php';
    $apcPaths[ 'web' ]   = sfConfig::get( 'sf_root_dir' ) . '/web/apc_clear.php';

    copy( $apcPaths[ 'stuff' ], $apcPaths[ 'web' ] ); //'data' is a non web accessable directory
    $this->log( "Script copied" );

    $url = 'http://' . $arguments[ 'URL' ] . '/apc_clear.php'; //use domain name as necessary

    if ( @file_get_contents( $url ) )
    {
      $result = json_decode( file_get_contents( $url ), true );

      if ( isset( $result[ 'success' ] ) && $result[ 'success' ] )
      {
        $this->log( "Clear - DONE" );
      }
      else
      {
        $this->log( "Clear - FAILED" );
      }
    }
    else
    {
      $this->log( "URL - error" );
    }

    unlink( $apcPaths[ 'web' ] );
    $this->log( "Script deleted" );
    $this->log( "Finish" );
  }

}

