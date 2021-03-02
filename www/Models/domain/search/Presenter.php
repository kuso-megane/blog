<?php

namespace domain\search;

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
     *      'searched_category' =>  NULL|array ['id' => int, 'name' -> string],
     *      'searched_subCategory' => NULL|array ['id' => int, 'name' -> string],
     *      'searched_word' => string | NULL,
     *      'recentArtclInfos' => return of $this->formatForRAI(),
     *      'isLastPage' => int,
     *      'categoryArtclCount' => return of $this->formatForCAC(),
     *      'subCategoryArtclCount' => return of $this->formatForSCAC()   
     * ]
     */
    public function present(array $input, array $recentArtclInfos, bool $isLastPage,array $categoryArtclCount,
    array $subCategoryArtclCount, ?array $searched_category, ?array $searched_subCategory)
    {
        $pageId = ['pageId'];
        $searched_word = $input['searched_word'];

        return [
            'pageId' => $pageId,
            'searched_category' => $searched_category,
            'searched_subCategory' => $searched_subCategory,
            'searched_word' => $searched_word,
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


