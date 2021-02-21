<?php

namespace domain\category\index;

class Presenter
{
    /*
        $recentArtclInfos = [$artclInfo, ...], 
        $artclInfo = ['artclId' => int, 'title' => string, 'updateDate' => date, 'thumbnailImg' => string]
    */

    /**
     * @param array $recentArtclInfos = [$artclInfo, ...], 
     *      $artclInfo = ['artclId' => int, 'title' => string, 'updateDate' => date, 'thumbnailImg' => string]
     * 
     * refer to components/mainSidebar
     * @param array $categoryArtclCount 
     * @param array $subCategoryArtclCount 
     * 
     * @return array [
     *      'recentArtclInfos' => $recentArtclInfos,
     *      'categoryArtclCount' => $categoryArtclCount,
     *       'subCategoryArtclCount' => $subCategoryArtclCount
      *  ]
     */
    public function present(array $recentArtclInfos, array $categoryArtclCount, array $subCategoryArtclCount)
    {
        return [
            'recentArtclInfos' => $recentArtclInfos,
            'categoryArtclCount' => $categoryArtclCount,
            'subCategoryArtclCount' => $subCategoryArtclCount
        ];
    }
}