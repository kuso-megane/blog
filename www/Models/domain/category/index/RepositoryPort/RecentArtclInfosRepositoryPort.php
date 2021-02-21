<?php

namespace domain\category\index\RepositoryPort;

interface RecentArtclInfosRepositoryPort
{

    /**
     * @param int $pageId
     * @param int $artclNum  max num of articles per page
     *  
     * @return array  array of Data\ArtclInfo 
     * 
     */
    public function getRecentArtclInfos(int $pageId, int $artclNum):array;


    /**
     * @param int $pageId
     * @param int $artclNum  max num of articles per page
     * 
     * @return bool
     */
    public function getIsLastPage(int $pageId, int $artclNum):bool;
}