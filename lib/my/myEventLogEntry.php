<?php

class myEventLogEntry extends dmEventLogEntry
{

  public function getCurrentRequestIp()
  {
    if ( $ip = Util::getRealIp() )
    {
      return $ip;
    }

    return parent::getCurrentRequestIp();
  }

}
