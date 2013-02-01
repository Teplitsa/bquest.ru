<?php

/**
 * DmUser form.
 *
 * @package    bquest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 * @generator  Diem 5.4.0-DEV
 * @gen-file   /www/bquest/lib/vendor/diem/dmCorePlugin/data/generator/dmDoctrineForm/default/template/sfDoctrinePluginFormTemplate.php */
class DmUserForm extends PluginDmUserForm
{

  protected static $labels = array(
    'username' => 'Логин (на латинице)',
    'email' => 'Emаil',
    'password' => 'Пароль',
    'password_again' => 'Повторите пароль',
  );

  public function configure()
  {
    parent::configure();
  }


}