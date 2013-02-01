<?php

/**
 * DmMedia form.
 *
 * @package    bquest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DmMediaForm extends PluginDmMediaForm
{

  public static $useFields = array(
    'file',
  );

  public function configure()
  {
    parent::configure();

    $this->useFields( self::$useFields );

    $this->setMimeTypeWhiteList( 'web_images' );
  }

}
