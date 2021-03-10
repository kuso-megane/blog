<?php

namespace domain\search\RepositoryPort;

interface RecentArtclInfosRepositoryPort
{

    /**
     * @param int $artclNum  max num of articles per page
     * @param int $pageId
     * @param int|NULL $searched_c_id
     * @param int|NULL $searched_subc_id
     * @param string|NULL $searched_word
     *  
     * @return array  [ bool $isLastPage, ArtclInfo[]|NULL ] 
     */
    public function getIsLastPageAndRecentArtclInfos(int $artclNum, int $pageId, ?int $searched_c_id,
    ?int $searched_subc_id, ?string $searched_word):array;

}