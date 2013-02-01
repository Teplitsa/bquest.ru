<?php

/**
 * Project filter form base class.
 */
abstract class BaseFormFilterDoctrine extends dmFormFilterDoctrine
{

  public function bind( array $taintedValues = null, array $taintedFiles = null )
  {
    if ( $taintedValues === null )
    {
      $taintedValues = dm::getUser()->getAttribute( $this->getName() );
    }
    else
    {
      dm::getUser()->setAttribute( $this->getName(), $taintedValues );
    }

    parent::bind( $taintedValues, $taintedFiles );
  }

}
