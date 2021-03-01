<?php

namespace domain\search\index\RepositoryPort;

interface RecentArtclInfosRepositoryPort
{

    /**
     * @param int $pageId
     * @param int $artclNum  max num of articles per page
     *  
     * @return array  [ bool $isLastPage, [array of Data\ArtclInfo] ] 
     * 
     */
    public function getIsLastPageAndRecentArtclInfos(int $pageId, int $artclNum):array;

}