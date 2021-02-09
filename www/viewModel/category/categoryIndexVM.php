<?php

namespace myapp\viewModel\category;

use myapp\viewModel\viewModelInterface;

class CategoryIndexVM implements viewModelInterface
{
    const MAIN_VIEW = 'category/index.php';
    
    /*
    array $recentArtclInfos = [$artclInfo, ...], 
    $artclInfo = ['artclId' => int, 'title' => string, 'updateDate' => date, 'thumbnailImg' => ?]
    */
    private $recentArtclInfos; 


    // for main--side
    

    public function __construct(array $recentArtclInfos)
    {
        $this->recentArtclInfos = $recentArtclInfos;
    }


    /**
     * @inheritDoc
     */
    public function getDataFromModel(?array $vars): viewModelInterface
    {
        
        //modelからdataを取得
        $recentArtclInfos = ['sampleK' => 'sampleV'];

        $this->recentArtclInfos = $recentArtclInfos;

        return $this;
    }


    public function getRecentArtclInfos():array
    {
        return $this->recentArtclInfos;
    }
}
