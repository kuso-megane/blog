<?php

namespace domain\category\index;

use domain\ViewModelInterface;
use domain\components\mainSidebar\data\OutputTrait as MainSidebar;

class OutputData implements viewModelInterface
{

    /*
        $recentArtclInfos = [$artclInfo, ...], 
        $artclInfo = ['artclId' => int, 'title' => string, 'updateDate' => date, 'thumbnailImg' => string]
    */
    private $recentArtclInfos; 

    use MainSidebar {
        MainSidebar::__construct as mainSidebar__construct;
    }
    


    public function __construct(array $data)
    {
        $this->recentArtclInfos = $data['recentArtclInfos'];
        $categoryArtclCount = $data['categoryArtclCount'];
        $subCategoryArtclCount = $data['subCategoryArtclCount'];

        $this->mainSidebar__construct($categoryArtclCount, $subCategoryArtclCount);
    }


    public function getRecentArtclInfos():array
    {
        return $this->recentArtclInfos;
    }

}