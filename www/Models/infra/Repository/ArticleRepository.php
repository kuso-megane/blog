<?php

namespace infra\Repository;

use domain\search\Data\ArtclInfo;
use domain\search\RepositoryPort\RecentArtclInfosRepositoryPort;
use infra\database\src\ArticleTable;

class ArticleRepository implements RecentArtclInfosRepositoryPort
{

    private $table;

    public function __construct()
    {
        $this->table = new ArticleTable();
    }
    /**
     * @inheritdoc
     */
    public function getIsLastPageAndRecentArtclInfos(array $input, int $artclNum):array
    {
        $ans = [];
        $ans[1] = [];

        $isLastPage = (bool)NULL;
        $pageId = $input['pageId'];
        $input_c_id = $input['given_c_id'];
        $input_subc_id = $input['given_subc_id'];
        $word = $input['given_word'];

        $datas = $this->table->findRecentOnesInfos($artclNum, $isLastPage, $pageId,
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
