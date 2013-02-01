<?php

class myFrontModuleActions extends dmFrontModuleActions
{

  protected function redirectPage( $page, $params = false )
  {
    /** @var dmFrontLinkTag $link  */
    $link = $this->getHelper()->link( $page );

    if ( $params )
    {
      $link->params( $params );
    }

    if ( ! $link )
    {
      $this->redirect404();
    }

    $this->redirect( $link->getHref() );
  }

  protected function redirect403( $msg = false )
  {
    /** @var dmFrontUser $sfUser */
    $sfUser = $this->getUser();

    if ( ! $sfUser->can( 'widget_edit' ) )
    {
      if ( $msg )
      {
        $this->getUser()->setFlash( 'notice', $msg );
      }

      $this->redirect( '@homepage', 403 );
    }
    else
    {
      $this->getUser()->setFlash( 'notice', 'Edit page access' );
    }

  }

}
