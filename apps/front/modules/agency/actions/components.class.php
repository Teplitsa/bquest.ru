<?php
/**
 * Организация components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 * 
 * 
 */
class agencyComponents extends myFrontModuleComponents
{

  public function executeForm(dmWebRequest $request)
  {
    $this->form = $this->forms['UserAgency'];
  }

  public function executeProfile()
  {
    $this->object = $this->getUser()->getDmUser()->getAgency();
  }

  public function executeShow(dmWebRequest $request)
  {
    $query = $this->getShowQuery();
    
    $this->agency = $this->getRecord($query);
  }

  public function executeList(dmWebRequest $request)
  {
    $query = $this->getListQuery();
    
    $this->agencyPager = $this->getPager($query);
  }


}
