<?php

namespace domain\category\index\data;

use domain\BaseViewModel;
use domain\components\mainSidebar\data\OutputTrait as MainSidebar;

class OutputData extends BaseViewModel
{

    /*
        $recentArtclInfos = [$artclInfo, ...], 
        $artclInfo = ['artclId' => int, 'title' => string, 'updateDate' => date, 'thumbnailImg' => string]
    */
    private $recentArtclInfos; 

    use MainSidebar {
        MainSidebar::__construct as mainSidebar__construct;
    }
    


    public function __construct(array $recentArtclInfos, array $categoryArtclCount, array $subCategoryArtclCount)
    {
        $this->recentArtclInfos = $recentArtclInfos;
        $this->mainSidebar__construct($categoryArtclCount, $subCategoryArtclCount);
    }


    public function getRecentArtclInfos():array
    {
        return $this->recentArtclInfos;
    }

}