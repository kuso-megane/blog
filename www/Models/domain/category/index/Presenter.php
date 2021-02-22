<?php

namespace domain\category\index;

use domain\components\mainSidebar\PresenterTrait as MainSidebarPresenter;

class Presenter
{

    use MainSidebarPresenter;

    /**
     * @param int $currentPage
     * @param array $recentArtclInfos array of Data\ArtclInfo
     * @param bool $isLastPage
     * 
     * refer to components/mainSidebar
     * @param array $categoryArtclCount 
     * @param array $subCategoryArtclCount 
     * 
     * @return array 
     */
    public function present(int $currentPage, array $recentArtclInfos, bool $isLastPage, array $categoryArtclCount, array $subCategoryArtclCount)
    {
        return [
            'currentPage' => $currentPage,
            'recentArtclInfos' => $this->formatForRAI($recentArtclInfos),
            'isLastPage' => $isLastPage,
            'categoryArtclCount' => $this->formatForCAC($categoryArtclCount),
            'subCategoryArtclCount' => $this->formatForSCAC($subCategoryArtclCount)
        ];
    }


    /**
     * formatter for recentArtclInfo
     * @param array $recentArtclInfos
     * 
     * @return array [
     *      ['id' => int, 'title' => string, 'updateDate' => string, 'thumbnailName' => string, 'c_id' => int, 'subc_id' => int],
     *      []
     * ]
     */ 
    private function formatForRAI(array $recentArtclInfos):array
    {
        foreach($recentArtclInfos as &$artclInfo) {
            $artclInfo = $artclInfo->toArray();
        }

        return $recentArtclInfos;
    }
}


