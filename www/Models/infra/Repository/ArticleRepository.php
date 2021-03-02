<?php

namespace infra\Repository;

use domain\search\Data\ArtclInfo;
use domain\search\RepositoryPort\RecentArtclInfosRepositoryPort;
use infra\database\src\ArticleTable;

class ArticleRepository implements RecentArtclInfosRepositoryPort
{

    /**
     * @inheritdoc
     */
    public function getIsLastPageAndRecentArtclInfos(array $input, int $artclNum):array
    {
        $ans = [];
        $ans[1] = [];

        $isLastPage = (bool)NULL;
        $pageId = $input['pageId'];
        $input_c_id = $input['searched_c_id'];
        $input_subc_id = $input['searched_subc_id'];
        $word = $input['searched_word'];

        $datas = (new ArticleTable())->findRecentOnesInfos($artclNum, $isLastPage, $pageId,
        $input_c_id, $input_subc_id, $word);

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
