<?php

namespace infra\Repository;

use domain\category\index\Data\ArtclInfo;
use domain\category\index\RepositoryPort\RecentArtclInfosRepositoryPort;
use infra\database\src\ArticleTable;

class RecentArtclInfosRepository implements RecentArtclInfosRepositoryPort
{

    /**
     * @inheritdoc
     */
    public function getIsLastPageAndRecentArtclInfos(int $pageId, int $artclNum):array
    {
        $ans = [];
        $ans[1] = [];

        $isLastPage = (bool)NULL;
        $datas = (new ArticleTable())->findRecentOnesInfos($artclNum, $isLastPage, $pageId);

        $ans[0] = $isLastPage;

        foreach($datas as $data) {
            $id = $data['id'];
            $title = $data['title'];
            $updateDate = $data['updateDate'];
            $thumbnailName = $data['thumbnailName'];
            $c_id = $data['c_id'];
            $subc_id = $data['subc_id'];

            array_push($ans[1], new ArtclInfo($id, $title, $updateDate, $thumbnailName, $c_id, $subc_id));
        }
        
        return $ans;
    }
}
