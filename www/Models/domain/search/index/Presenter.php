<?php

namespace domain\search\index;

use domain\components\mainSidebar\PresenterTrait as MainSidebarPresenter;

class Presenter
{

    use MainSidebarPresenter;

    /**
     * @param int $pageId
     * @param array $recentArtclInfos array of Data\ArtclInfo
     * @param bool $isLastPage
     * 
     * @param array $categoryArtclCount of Data\CategoryArtclCount
     * @param array $subCategoryArtclCount of Data\SubCategoryArtclCount
     * 
     * @return array [
     *      'pageId' => int,
     *      'recentArtclInfos' => return of $this->formatForRAI(),
     *      'isLastPage' => int,
     *      'categoryArtclCount' => return of $this->formatForCAC(),
     *      'subCategoryArtclCount' => return of $this->formatForSCAC()
     * ]
     */
    public function present(int $pageId, array $recentArtclInfos, bool $isLastPage, array $categoryArtclCount, array $subCategoryArtclCount)
    {
        return [
            'pageId' => $pageId,
            'recentArtclInfos' => $this->formatForRAI($recentArtclInfos),
            'isLastPage' => $isLastPage,
            'categoryArtclCount' => $this->formatForCAC($categoryArtclCount),
            'subCategoryArtclCount' => $this->formatForSCAC($subCategoryArtclCount)
        ];
    }


    /**
     * formatter for recentArtclInfo
     * @param array of Data\ArtclInfo $recentArtclInfos
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


