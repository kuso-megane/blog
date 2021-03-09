<?php

namespace infra\database\src;

use myapp\myFrameWork\DB\Connection;

use PDO;
use PDOException;

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
     * @return array 
     * ['id' => int, 'c_id' => int, 'subc_id' => int, 'title' => string, 'thumbnailName' => string, 
     * 'content' => string, updataDate' => string]
     * 
     * If no record is found, this returns empty array.
     */
    public function findById(int $id):array
    {
        $record = $this->dbh->select('*', $this::TABLENAME, 'id = :id', [], [':id' => $id])[0];

        //select()が空配列を返した場合、その0番目の要素($record)はNULLとなってしまうので、配列に変換
        if ($record == NULL) {
            $record = [];
        }

        return $record;
    }
}
