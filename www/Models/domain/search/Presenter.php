<?php

namespace domain\search;


class Presenter
{

    /**
     * @param array $input
     * @param ArtclInfo[] $recentArtclInfos
     * @param bool $isLastPage
     * 
     * @param array $breadCrumbData
     * @param array $mainSidebarData
     * 
     * @return array [
     *      'currentUri' => string
     *      'pageId' => int
     *      'searched_word' => string | NULL,
     *      'recentArtclInfos' => return of $this->formatForRAI(),
     *      'isLastPage' => int
     * ]
     * +components\breadCrumb\Interactor->interact()
     * +components\mainSidebar\Interactor->interact()
     */
    public function present(array $input, string $currentUrl, array $recentArtclInfos, bool $isLastPage,
    array $breadCrumbData, array $mainSidebarData)
    {
        
        $pageId = $input['pageId'];
        $searched_word = $input['searched_word'];

        $data = [
            'currentUrl' => $currentUrl,
            'pageId' => $pageId,
            'searched_word' => $searched_word,
            'recentArtclInfos' => $this->formatForRAI($recentArtclInfos),
            'isLastPage' => $isLastPage
        ];

        return $data + $breadCrumbData + $mainSidebarData;
    }


    /**
     * formatter for recentArtclInfo
     * @param ArtclInfo[] $recentArtclInfos
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


