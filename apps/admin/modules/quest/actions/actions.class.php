<?php

require_once dirname(__FILE__).'/../lib/questGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/questGeneratorHelper.class.php';

/**
 * quest actions.
 *
 * @package    bquest
 * @subpackage quest
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class questActions extends autoQuestActions
{

  protected function tryToSortWithForeignColumn( Doctrine_Query $query, array $sort )
  {
    $query->addOrderBy( 'is_active ASC' );

    parent::tryToSortWithForeignColumn( $query, $sort );
  }

}
