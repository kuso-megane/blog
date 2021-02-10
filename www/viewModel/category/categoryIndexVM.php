<?php

namespace myapp\viewModel\category;

use myapp\viewModel\viewModelInterface;

class CategoryIndexVM implements viewModelInterface
{
    const TEMPLATE_FILE = 'templates/categoryTemplate.php';
    const CLASSNAME = 'category';
    const ACTION = 'index';
    
    /*
        $recentArtclInfos = [$artclInfo, ...], 
    $artclInfo = ['artclId' => int, 'title' => string, 'updateDate' => date, 'thumbnailImg' => ?]
    */
    private $recentArtclInfos; 

    //for main--sidebar component
    /*
        $categoryArtclCount = ['programming' => int, 'books' => int, ...] (e.g.)
    */
    private $categoryArtclCount; 

    /*
        $subCategoryArtclCount = ['programming' => ['web' => int, 'game' => int,...] ,
                                'books' => ['manga' => int ,'novel' => int]] (e.g.)
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
