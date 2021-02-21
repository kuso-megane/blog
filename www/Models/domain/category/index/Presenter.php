<?php

namespace domain\category\index;

use myapp\myFrameWork\Formatter;

class Presenter
{

    /**
     * @param array $recentArtclInfos array of Data\ArtclInfo
     * @param bool $isLastPage
     * 
     * refer to components/mainSidebar
     * @param array $categoryArtclCount 
     * @param array $subCategoryArtclCount 
     * 
     * @return array 
     *
     */
    public function present(array $recentArtclInfos, bool $isLastPage, array $categoryArtclCount, array $subCategoryArtclCount)
    {
        $f = new Formatter;
        return [
            'recentArtclInfos' => $f->objectsToArray($recentArtclInfos),
            'isLastPage' => $isLastPage,
            'categoryArtclCount' => $f->objectsToArray($categoryArtclCount),
            'subCategoryArtclCount' => $f->objectsToArray($subCategoryArtclCount)
        ];
    }
}


