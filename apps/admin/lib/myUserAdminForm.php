<?php

/**
 * DmUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: DmUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class myUserAdminForm extends BaseDmUserAdminForm
{

  public function configure()
  {
    parent::configure();

    $this->widgetSchema['user_type'] = new sfWidgetFormChoice( array(
      'choices' => array( 0 => '&mdash;' ) + DmUser::$userTypeChoices,
    ) );
    $this->validatorSchema['user_type'] = new sfValidatorChoice( array(
      'choices' => array_keys( DmUser::$userTypeChoices ),
      'required' => true,
    ) );
  }

}
