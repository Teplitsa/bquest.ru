<?php
/**
 * Команда components
 *
 * No redirection nor database manipulation ( insert, update, delete ) here
 *
 * @property Team     $object
 * @property Team     $team
 * @property TeamForm $form
 */
class teamComponents extends myFrontModuleComponents
{

  public function executeForm(dmWebRequest $request)
  {
    $this->form = $this->forms['UserTeam'];
  }

  public function executeProfile(dmWebRequest $request)
  {
    $this->filter = new QuestFormFilter();
    $this->filter->bind();

    if ( $request->isMethod('POST') )
    {
      $this->filter->bind( $request->getParameter( $this->filter->getName() ) );
    }

    /** @var Doctrine_Query $query */
    $query = $this->filter->getQuery();
    $query->orderBy( 'created_at DESC' );
    $query->addWhere( 'status = ? OR status IS NULL', Quest::STATUS_NEW );
    $query->addWhere( 'is_active = ?', true );

    $this->maxPerPage = 10;
    $page = $request->isMethod( 'post' ) ? 1 : $request->getParameter( 'page', 1 );

    $this->pager = $this->getPager( $query, $page );
    $this->object = $this->getUser()->getDmUser()->getTeam();
  }

  public function executeShow(dmWebRequest $request)
  {
    $query = $this->getShowQuery();

    $this->team = $this->getRecord($query);
  }

}
