<?php
/**
 * Задание components
 *
 * No redirection nor database manipulation ( insert, update, delete ) here
 *
 * @property QuestCompleteForm $formComplete
 * @property QuestCloseForm $formClose
 */
class questComponents extends myFrontModuleComponents
{

  public function executeForm(dmWebRequest $request)
  {
    $this->form = $this->forms['Quest'];
  }

  public function executeList(dmWebRequest $request)
  {
    // >>> diem generated code
    // $query = $this->getListQuery();
    // $this->pager = $this->getPager($query);
    // <<<

    $this->filter = new QuestFormFilter();
    $this->filter->bind();

    if ( $request->isMethod('POST') )
    {
      $this->filter->bind( $request->getParameter( $this->filter->getName() ) );
    }

    /** @var Doctrine_Query $query */
    $query = $this->filter->getQuery();
    $query->orderBy( 'created_at DESC' );
    $query->addWhere( 'is_active = ?', true );

    $type = $request->getParameter( 'type' );
    if ( $type && isset( Quest::$statusChoices[ $type ] ) )
    {
      $query->addWhere( 'status = ?', $type );
    }

    $page = $request->isMethod( 'post' ) ? 1 : $request->getParameter( 'page', 1 );

    $this->pager = $this->getPager( $query, $page );
  }

  public function executeShow(dmWebRequest $request)
  {
    $query = $this->getShowQuery();

    $this->quest = $this->getRecord($query);

    $this->formComplete = $this->forms['QuestComplete'];
    $this->formClose    = $this->forms['QuestClose'];
  }

}
