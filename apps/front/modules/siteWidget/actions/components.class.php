<?php
/**
 * Site widget components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 */
class siteWidgetComponents extends myFrontModuleComponents
{

  public function executeList(dmWebRequest $request)
  {
    $query = $this->getListQuery();
    
    $this->siteWidgetPager = $this->getPager($query);

    $this->replacements = array(
      '%url%' => $request->getParameter('url', $this->getHelper()->link()->getAbsoluteHref())
    );
  }


}
