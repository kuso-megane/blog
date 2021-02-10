<?php

namespace myapp\viewModel\category;

use myapp\viewModel\viewModelInterface;

class CategoryIndexVM implements viewModelInterface
{
    const TEMPLATE_FILENAME = 'templates/categoryTemplate.php';
    const MAIN_FILENAME = 'category/index.php';
    
    /*
        $recentArtclInfos = [$artclInfo, ...], 
    $artclInfo = ['artclId' => int, 'title' => string, 'updateDate' => date, 'thumbnailImg' => ?]
    */
    private $recentArtclInfos; 

    //for main--sidebar component
    /*
        $categoryArtclCount = ['プログラミング' => int, '読書' => int, ...] (e.g.)
    */
    private $categoryArtclCount; 

    /*
        $subCategoryArtclCount = ['プログラミング' => ['web' => int, 'game' => int,...] ,
                                '読書' => ['マンガ' => int ,'小説' => int]] (e.g.)
    */
    private $subCategoryArtclCount;


    public function __construct(array $data)
    {
        $this->recentArtclInfos = $data['recentArtclInfos'];
        $this->categoryArtclCount = $data['categoryArtclCount'];
        $this->subCategoryArtclCount = $data['subCategoryArtclCount'];
    }


    public function getRecentArtclInfos():array
    {
        return $this->recentArtclInfos;
    }

    public function getCategoryArtclCount():array
    {
        return $this->categoryArtclCount;
    }


    public function getSubCategoryArtclCount():array
    {
        return $this->subCategoryArtclCount;
    }
}
