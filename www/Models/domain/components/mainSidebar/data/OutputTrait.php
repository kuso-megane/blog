<?php

namespace domain\components\mainSideBar\data;

trait OutputTrait
{
    /*
        (e.g.)
        $categoryArtclCount = ['プログラミング' => int, '読書' => int, ...] 
    */
    private $categoryArtclCount; 

    /*
        (e.g.)
        $subCategoryArtclCount = ['プログラミング' => ['web' => int, 'game' => int,...] ,
                                '読書' => ['マンガ' => int ,'小説' => int]] 
    */
    private $subCategoryArtclCount;


    public function __construct(array $categoryArtclCount, array $subCategoryArtclCount)
    {
        $this->categoryArtclCount = $categoryArtclCount;
        $this->subCategoryArtclCount = $subCategoryArtclCount;
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