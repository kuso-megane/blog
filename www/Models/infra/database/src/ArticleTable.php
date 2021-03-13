<?php

namespace infra\database\src;

use myapp\myFrameWork\DB\Connection;


class ArticleTable
{
    const TABLENAME = 'Article';
    const PARENT1_TABLENAME = 'Category';
    const PARENT2_TABLENAME = 'SubCategory';
    private $dbh;

    /**
     * @param bool $is_test
     */
    public function __construct(bool $is_test=false)
    {
        $this->dbh = (new Connection($is_test))->connect(); //PDO
    }


    // TODO: カテゴリ指定があったときの処理
    // TODO: 検索ワードがあったときの処理
    /**
     * return recent article infos and decide $isLastPage on TRUE or FALSE
     * @param int $maxNum  max num of articles you wanna fetch at a time
     * @param bool &$isLastPage
     * 
     * @param int $pageId
     * @param int|NULL $c_id
     * @param int|NULL $subc_id
     * @param string $word the search word
     * 
     * @return array [
     *      ['id' => int, 'c_id' => int, 'subc_id' => int, 'title' => string, 'thumbnailName' => string, 'updataDate' => string],
     *      []
     * ]
     * 
     * If no record is found, this returns empty array.
     */
    public function findRecentOnesInfos(int $maxNum, bool &$isLastPage, int $pageId, ?int $c_id = NULL, ?int $subc_id = NULL, ?string $word = NULL):array
    {
        $rangeStart = $maxNum * ($pageId - 1);
        $options = ['orderby' => 'updateDate', 'sort' => 'DESC', 'limitStart' => ':limitStart', 'limitNum' => ':limitNum'];
        $boundValues = [':limitStart' => $rangeStart, ':limitNum' => $maxNum];

        if ($word == NULL) {
            if ($c_id == NULL && $subc_id == NULL) {

                $articleInfos = $this->dbh->select(
                    'id, c_id, subc_id, title, thumbnailName, updateDate',
                    $this::TABLENAME,
                    '',
                    $options,
                    $boundValues
                );

                $total = $this->dbh->count('*', $this::TABLENAME);
                if ($total <= $maxNum * $pageId) {
                    $isLastPage = TRUE;
                }else {
                    $isLastPage = FALSE;
                }

                return $articleInfos;

            }
            elseif ($c_id != NULL && $subc_id == NULL) {

                $articleInfos = $this->dbh->select(
                    'id, c_id, subc_id, title, thumbnailName, updateDate',
                    $this::TABLENAME,
                    'c_id = :c_id',
                    $options,
                    $boundValues + [':c_id' => $c_id]
                );

                $total = $this->dbh->select('num', $this::PARENT1_TABLENAME, 'id = :c_id', [], [':c_id' => $c_id])[0]['num'];
                if ($total <= $maxNum * $pageId) {
                    $isLastPage = TRUE;
                }else {
                    $isLastPage = FALSE;
                }

                return $articleInfos;
            }
            elseif ($c_id != NULL && $subc_id != NULL) {

                $articleInfos = $this->dbh->select(
                    'id, c_id, subc_id, title, thumbnailName, updateDate',
                    $this::TABLENAME,
                    'subc_id = :subc_id',
                    $options,
                    $boundValues + [':subc_id' => $subc_id]
                );

                $total = $this->dbh->select('num', $this::PARENT2_TABLENAME, 'id = :subc_id', [], [':subc_id' => $subc_id])[0]['num'];


                if ($total <= $maxNum * $pageId) {
                    $isLastPage = TRUE;
                }else {
                    $isLastPage = FALSE;
                }

                return $articleInfos;
            }
        }
        elseif ($word != NULL) {
            if ($c_id == NULL && $subc_id == NULL) {

                $articleInfos = $this->dbh->select(
                    'id, c_id, subc_id, title, thumbnailName, updateDate',
                    $this::TABLENAME,
                    'title LIKE :word',
                    $options,
                    $boundValues + [':word' => "%{$word}%"]
                );
                
                $total = $this->dbh->count('*', $this::TABLENAME, 'title LIKE :word', [':word' => "%{$word}%"]);

                if ($total <= $maxNum * $pageId) {
                    $isLastPage = TRUE;
                }else {
                    $isLastPage = FALSE;
                }

                return $articleInfos;
            }
            //未テスト
            elseif($c_id != NULL && $subc_id == NULL) {

                $articleInfos = $sth = $this->dbh->select(
                    'id, c_id, subc_id, title, thumbnailName, updateDate',
                    $this::TABLENAME,
                    'c_id = :c_id AND title LIKE :word',
                    $options,
                    $boundValues + [':word' => "%{$word}%", ':c_id' => $c_id]
                );
                
                $total = $this->dbh->count('*', $this::TABLENAME, 'c_id = :c_id AND title LIKE :word',
                [':word' => "%{$word}%", ':c_id' => $c_id]);

                if ($total <= $maxNum * $pageId) {
                    $isLastPage = TRUE;
                }else {
                    $isLastPage = FALSE;
                }

                return $articleInfos;

            }
            //未テスト
            elseif ($c_id != NULL && $subc_id != NULL) {

                $articleInfos = $sth = $this->dbh->select(
                    'id, c_id, subc_id, title, thumbnailName, updateDate',
                    $this::TABLENAME,
                    'subc_id = :subc_id AND title LIKE :word',
                    $options,
                    $boundValues + [':word' => "%{$word}%", ':subc_id' => $subc_id]
                );
                
                $total = $this->dbh->count('*', $this::TABLENAME, 'subc_id = :subc_id AND title LIKE :word',
                [':word' => "%{$word}%", ':subc_id' => $subc_id]);

                if ($total <= $maxNum * $pageId) {
                    $isLastPage = TRUE;
                }else {
                    $isLastPage = FALSE;
                }

                return $articleInfos;
                
            }
        }
    }


    /**
     * @param int $id
     * 
     * @return array|NULL
     * ['id' => int, 'c_id' => int, 'subc_id' => int, 'title' => string, 'thumbnailName' => string, 
     * 'content' => string, updataDate' => string]
     * 
     * If no record is found, this returns NULL.
     */
    public function findById(int $id):?array
    {
        $record = $this->dbh->select('*', $this::TABLENAME, 'id = :id', [], [':id' => $id])[0]; //見つからなかった場合はNULL

        return $record;
    }


    /**
     * create new Article and increment the num of Category and SubCategory
     * @param int $c_id
     * @param int $subc_id
     * @param string $title
     * @param string $thumbnailName
     * @param string $content
     * 
     * @return void
     * 
     * if command fails, this returns PDOException
     */
    public function create(int $c_id, int $subc_id, string $title, string $thumbnailName, string $content)
    {
        $boundValues = [
            ':c_id' => $c_id, ':subc_id' => $subc_id, ':title' => $title, ':content' => $content, ':thumbnailName' => $thumbnailName
        ];

        $columns = '0, :c_id, :subc_id, :title, :thumbnailName, :content, default';

        $this->dbh->beginTransaction();
        $this->dbh->insert($this::TABLENAME, $columns, $boundValues);
        $this->dbh->update($this::PARENT1_TABLENAME, 'num = num + 1', 'id = :c_id', [':c_id' => $c_id]);
        $this->dbh->update($this::PARENT2_TABLENAME, 'num = num + 1', 'id = :subc_id', [':subc_id' => $subc_id]);
        $this->dbh->commit();
    }


    /**
     * update Article and modify the num of Category and SubCategory
     * @param int $artcl_id
     * @param int $c_id
     * @param int $subc_id
     * @param string $title
     * @param string $thumbnailName
     * @param string $content
     */
    public function update(int $artcl_id, int $newC_id, int $newSubc_id, string $newTitle, string $newThumbnailName, string $newContent)
    {
        $oldArticle = $this->dbh->select('c_id, subc_id', $this::TABLENAME, 'id = :id', [], [':id' => $artcl_id])[0];
        $oldC_id = $oldArticle['c_id'];
        $oldSubc_id = $oldArticle['subc_id'];

        $boundValues = [
            ':id' => $artcl_id, ':newC_id' => $newC_id, ':newSubc_id' => $newSubc_id, ':newTitle' => $newTitle,
            ':newThumbnailName' => $newThumbnailName, ':newContent' => $newContent
        ];

        $columns = 'c_id = :newC_id, subc_id = :newSubc_id, title = :newTitle,
        thumbnailName = :newThumbnailName, content = :newContent';

        $this->dbh->beginTransaction();
        // 旧カテゴリのnumを1つ減らす
        $this->dbh->update($this::PARENT1_TABLENAME, 'num = num - 1', 'id = :c_id', [':c_id' => $oldC_id]);
        $this->dbh->update($this::PARENT2_TABLENAME, 'num = num - 1', 'id = :subc_id', [':subc_id' => $oldSubc_id]);

        $this->dbh->update($this::TABLENAME, $columns, 'id = :id', $boundValues);
        
        //新カテゴリのnumを1つ増やす
        $this->dbh->update($this::PARENT1_TABLENAME, 'num = num + 1', 'id = :c_id', [':c_id' => $newC_id]);
        $this->dbh->update($this::PARENT2_TABLENAME, 'num = num + 1', 'id = :subc_id', [':subc_id' => $newSubc_id]);
        $this->dbh->commit();
    }

}
