<?php

namespace infra\Repository;

use domain\article\show\Data\ArticleContent;
use domain\article\show\RepositoryPort\ArticleContentRepositoryPort;
use domain\backyardArticle\edit\Data\OldArticleContent;
use domain\backyardArticle\edit\RepositoryPort\OldArticleContentRepositoryPort;
use domain\backyardArticle\index\Data\ArticleLink;
use domain\backyardArticle\index\RepositoryPort\ArticleLinksRepositoryPort;
use domain\backyardArticle\post\RepositoryPort\ArticlePostRepositoryPort;
use domain\search\Data\ArtclInfo;
use domain\search\RepositoryPort\RecentArtclInfosRepositoryPort;
use infra\database\src\ArticleTable;
use myapp\config\AppConfig;
use PDOException;

class ArticleRepository
implements
RecentArtclInfosRepositoryPort,
ArticleContentRepositoryPort,
ArticleLinksRepositoryPort,
OldArticleContentRepositoryPort,
ArticlePostRepositoryPort
{

    private $table;

    public function __construct()
    {
        $this->table = new ArticleTable();
    }
    /**
     * @inheritdoc
     */
    public function getIsLastPageAndRecentArtclInfos(int $artclNum, int $pageId, ?int $searched_c_id,
    ?int $searched_subc_id, ?string $searched_word):array
    {
        $ans = [];
        $ans[1] = [];

        $isLastPage = (bool)NULL;

        $datas = $this->table->findRecentOnesInfos($artclNum, $isLastPage, $pageId,
        $searched_c_id, $searched_subc_id, $searched_word);

        $ans[0] = $isLastPage;

        if (!empty($datas)) {
            foreach($datas as $data) {
                $id = $data['id'];
                $title = $data['title'];
                $updateDate = $data['updateDate'];
                $thumbnailName = $data['thumbnailName'];
                $c_id = $data['c_id'];
                $subc_id = $data['subc_id'];

                array_push($ans[1], new ArtclInfo($id, $title, $updateDate, $thumbnailName, $c_id, $subc_id));
            }
        }
        else {
            $ans[1] = NULL;
        }
        
        
        return $ans;
    }


    /**
     * @inheritdoc
     */
    public function getArticleContent(int $id): ?ArticleContent
    {
        $data = $this->table->findById($id);

        if ($data == NULL) {
            return NULL;
        }
        else {
            return new ArticleContent(
                $data['c_id'],
                $data['subc_id'],
                $data['title'],
                $data['content'],
                $data['updateDate']
            );
        }
    }


    /**
     * @inheritDoc
     */
    public function getArticleLinks(?string $searched_word): ?array
    {
        $maxNum = AppConfig::BY_ARTCL_NUM;
        $isLastPage = (bool)NULL; //不要だが、引数として必要
        $articles = $this->table->findRecentOnesInfos($maxNum, $isLastPage, 1, NULL, NULL, $searched_word);

        if (!empty($articles)) {
            foreach($articles as &$article) {
                $article = new ArticleLink($article['id'], $article['title']);
            }

            return $articles;
        }
        else {
            return NULL;
        }
    }


    /**
     * @inheritDoc
     */
    public function getOldArticleContent(int $artcl_id): ?OldArticleContent
    {
        $article = $this->table->findById($artcl_id);
         
        return new OldArticleContent(
            $article['id'],
            $article['c_id'],
            $article['subc_id'],
            $article['title'],
            $article['thumbnailName'],
            $article['content']
        );
    }


    /**
     * @inheritDoc
     */
    public function postArticle(?int $artcl_id, int $c_id, int $subc_id, string $title, ?string $thumbnailName,
    string $content): bool
    {
        $thumbnailName = ($thumbnailName === NULL) ? AppConfig::DEFAULT_IMG : $thumbnailName;

        try {
            if ($artcl_id === NULL) {
                $this->table->create($c_id, $subc_id, $title, $thumbnailName, $content);
            }
            else {
                $this->table->update($artcl_id, $c_id, $subc_id, $title, $thumbnailName, $content);
            }
        }
        catch (PDOException $e) {
            return FALSE;
        }
        
        return TRUE;
    }
}
