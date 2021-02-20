<?php

namespace myapp\viewModel\category;

use myapp\viewModel\viewModelInterface;
use myapp\ViewModel\components\mainSidebarVM;

class CategoryIndexVM implements viewModelInterface
{

    /*
        $recentArtclInfos = [$artclInfo, ...], 
        $artclInfo = ['artclId' => int, 'title' => string, 'updateDate' => date, 'thumbnailImg' => ?]
    */
    private $recentArtclInfos; 

    use mainSidebarVM {
        mainSidebarVM::__construct as mainSidebarVM__construct;
    }
    


    public function __construct(array $data)
    {
        $this->recentArtclInfos = $data['recentArtclInfos'];
        $categoryArtclCount = $data['categoryArtclCount'];
        $subCategoryArtclCount = $data['subCategoryArtclCount'];

        $this->mainSidebarVM__construct($categoryArtclCount, $subCategoryArtclCount);
    }


    public function getRecentArtclInfos():array
    {
        return $this->recentArtclInfos;
    }

}