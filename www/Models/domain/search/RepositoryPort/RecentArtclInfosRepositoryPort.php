<?php

namespace domain\search\RepositoryPort;

interface RecentArtclInfosRepositoryPort
{

    /**
     * @param array $input
     * @param int $artclNum  max num of articles per page
     *  
     * @return array  [ bool $isLastPage, ArtclInfo[] ] 
     */
    public function getIsLastPageAndRecentArtclInfos(array $input, int $artclNum):array;

}