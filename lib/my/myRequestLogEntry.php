<?php

class myRequestLogEntry extends dmRequestLogEntry
{

  // FIX uri retrieving for NGINX
  public function configure(array $data)
  {
    $data['server']['PATH_INFO'] = $_SERVER[ 'REQUEST_URI' ];

    parent::configure( $data );
  }

  public function getCurrentRequestIp()
  {
    if ( $ip = Util::getRealIp() )
    {
      return $ip;
    }

    return parent::getCurrentRequestIp();
  }

}
