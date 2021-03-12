<?php

namespace domain\search;

use myapp\config\AppConfig;

class Presenter
{

    /**
     * @param array $input
     * @param string $currentUrl
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
     *      'recentArtclInfos' => return of $this->formatForRAI() or empty array
     *      'isLastPage' => int
     * ]
     * +components\breadCrumb\Interactor->interact()
     * +components\mainSidebar\Interactor->interact()
     */
    public function present(array $input, string $currentUrl, ?array $recentArtclInfos, bool $isLastPage,
    array $breadCrumbData, array $mainSidebarData)
    {
        
        $pageId = $input['pageId'];
        $searched_word = $input['searched_word'];

        $recentArtclInfos = ($recentArtclInfos != NULL) ? $this->formatForRAI($recentArtclInfos) : [];

        $data = [
            'currentUrl' => $currentUrl,
            'pageId' => $pageId,
            'searched_word' => $searched_word,
            'recentArtclInfos' => $recentArtclInfos,
            'isLastPage' => $isLastPage
        ];

        return $data + $breadCrumbData + $mainSidebarData;
    }


    /**
     * Call when validation failed.
     * @param string|NULL $message
     * 
     * @return int AppConfig::INVALID_PARAMS
     */
    public function reportInValidParams(?string $message):int
    {
        http_response_code(400);
        echo $message;

        return AppConfig::INVALID_PARAMS;
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


