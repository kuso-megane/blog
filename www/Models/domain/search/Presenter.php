<?php

namespace domain\search;

use domain\components\mainSidebar\PresenterTrait as MainSidebarPresenter;
use myapp\myFrameWork\superGlobalVars as Gvars;

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
     *      'currentUri' => string
     *      'pageId' => int
     *      'given_category' =>  NULL|array ['id' => int, 'name' -> string],
     *      'given_subCategory' => NULL|array ['id' => int, 'name' -> string],
     *      'given_word' => string | NULL,
     *      'recentArtclInfos' => return of $this->formatForRAI(),
     *      'isLastPage' => int,
     *      'categoryArtclCount' => return of $this->formatForCAC(),
     *      'subCategoryArtclCount' => return of $this->formatForSCAC()   
     * ]
     */
    public function present(array $input, array $recentArtclInfos, bool $isLastPage,array $categoryArtclCount,
    array $subCategoryArtclCount, ?array $given_category, ?array $given_subCategory)
    {
        $server = (new Gvars)->getServer();

        $uri = $server['REQUEST_URI'];
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $currentUrl = rawurldecode($uri);

        $pageId = $input['pageId'];
        $given_word = $input['given_word'];

        return [
            'currentUrl' => $currentUrl,
            'pageId' => $pageId,
            'given_category' => $given_category,
            'given_subCategory' => $given_subCategory,
            'given_word' => $given_word,
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


