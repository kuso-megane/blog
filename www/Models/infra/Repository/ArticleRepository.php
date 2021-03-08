<?php

namespace infra\Repository;

use domain\article\show\Data\ArticleContent;
use domain\article\show\RepositoryPort\ArticleRepositoryPort;
use domain\search\Data\ArtclInfo;
use domain\search\RepositoryPort\RecentArtclInfosRepositoryPort;
use infra\database\src\ArticleTable;

class ArticleRepository implements RecentArtclInfosRepositoryPort, ArticleRepositoryPort
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
        $input_c_id = $input['searched_c_id'];
        $input_subc_id = $input['searched_subc_id'];
        $word = $input['searched_word'];

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


    /**
     * @inheritdoc
     */
    public function getArticle(array $input): ArticleContent
    {
        $id = $input['id'];
        $data = $this->table->findById($id);

        return new ArticleContent(
            $data['c_id'],
            $data['subc_id'],
            $data['title'],
            $data['content'],
            $data['updateDate']
        );
    }
}
