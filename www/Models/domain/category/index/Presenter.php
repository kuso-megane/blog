<?php

namespace domain\category\index;

use domain\helpers\Formatter;

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
            'recentArtclInfos' => $f->objectsArrTo2DArr($recentArtclInfos),
            'isLastPage' => $isLastPage,
            'categoryArtclCount' => $f->objectsArrTo2DArr($categoryArtclCount),
            'subCategoryArtclCount' => $f->objectsArrTo2DArr($subCategoryArtclCount)
        ];
    }
}


