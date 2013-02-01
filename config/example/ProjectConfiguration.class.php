<?php
date_default_timezone_set( 'Europe/London' );

require_once '/www/bquest/lib/vendor/diem/dmCorePlugin/lib/core/dm.php';
dm::start();

class ProjectConfiguration extends dmProjectConfiguration
{

  public function setup()
  {
    parent::setup();

    $this->enablePlugins( array(
      'dmCkEditorPlugin',
    ) );

    $this->setWebDir( sfConfig::get( 'sf_root_dir' ) . '/web' );
  }

}
