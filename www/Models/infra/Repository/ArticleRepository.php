<?php

namespace infra\Repository;

use domain\article\show\Data\ArticleContent;
use domain\article\show\RepositoryPort\ArticleContentRepositoryPort;
use domain\search\Data\ArtclInfo;
use domain\search\RepositoryPort\RecentArtclInfosRepositoryPort;
use infra\database\src\ArticleTable;

class ArticleRepository implements RecentArtclInfosRepositoryPort, ArticleContentRepositoryPort
{

    private $table;

    public function __construct()
    {
        $this->table = new ArticleTable();
    }
    /**
     * @inheritdoc
     */
    public function getIsLastPageAndRecentArtclInfos(int $artclNum, int $pageId, int $searched_c_id,
    int $searched_subc_id, string $searched_word):array
    {
        $ans = [];
        $ans[1] = [];

        $isLastPage = (bool)NULL;

        $datas = $this->table->findRecentOnesInfos($artclNum, $isLastPage, $pageId,
        $searched_c_id, $searched_subc_id, $searched_word);

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
    public function getArticleContent(int $id): ArticleContent
    {
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
