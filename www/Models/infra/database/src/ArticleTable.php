<?php

namespace infra\database\src;

use infra\database\helpers\DBConnection;
use infra\database\helpers\DBHMyLib;
use PDO;
use PDOException;

class ArticleTable
{
    const TABLENAME = 'Article';
    private $dbh;
    private $dbhHelper;

    /**
     * @param bool $is_test
     */
    public function __construct(bool $is_test=false)
    {
        $this->dbh = (new DBConnection($is_test))->connect(); //PDO
        $this->dbhHelper = new DBHMyLib($this->dbh);
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
     */
    public function findRecentOnesInfos(int $maxNum, bool &$isLastPage, int $pageId, ?int $c_id = NULL, ?int $subc_id = NULL, ?string $word = NULL):array
    {
        $rangeStart = $maxNum * ($pageId - 1);
        $order = ' ORDER BY updateDate DESC';
        $limit = ' LIMIT :start,:num';

        if ($word == NULL) {
            if ($c_id == NULL && $subc_id == NULL) {

                $command = 'SELECT id, c_id, subc_id, title, thumbnailName, updateDate FROM ' . $this::TABLENAME .
                $order . $limit;
                $sth = $this->dbhHelper->prepare($command);
                $sth->execute([':start' => $rangeStart, ':num' => $maxNum]);
                $articleInfos = $sth->fetchAll(PDO::FETCH_ASSOC);

                $total = $this->dbh->query('SELECT COUNT(*) as total FROM Article')->fetch(PDO::FETCH_ASSOC)['total'];
                if ($total <= $maxNum * $pageId) {
                    $isLastPage = TRUE;
                }else {
                    $isLastPage = FALSE;
                }

                return $articleInfos;

            }
            elseif ($c_id != NULL && $subc_id == NULL) {

                $where = ' WHERE c_id = :c_id';
                $command = 'SELECT id, c_id, subc_id, title, thumbnailName, updateDate FROM ' . $this::TABLENAME .
                $where . $order . $limit;
                $sth = $this->dbhHelper->prepare($command);
                $sth->execute([':start' => $rangeStart, ':num' => $maxNum, ':c_id' => $c_id]);
                $articleInfos = $sth->fetchAll(PDO::FETCH_ASSOC);

                $sth2 = $this->dbhHelper->prepare('SELECT num AS total FROM Category WHERE id = :c_id');
                $sth2->execute([':c_id' => $c_id]);
                $total = $sth2->fetch(PDO::FETCH_ASSOC)['total'];

                if ($total <= $maxNum * $pageId) {
                    $isLastPage = TRUE;
                }else {
                    $isLastPage = FALSE;
                }

                return $articleInfos;
            }
            elseif ($c_id != NULL && $subc_id != NULL) {

                $where = ' WHERE subc_id = :subc_id';
                $command = 'SELECT id, c_id, subc_id, title, thumbnailName, updateDate FROM ' . $this::TABLENAME .
                $where . $order . $limit;
                $sth = $this->dbhHelper->prepare($command);
                $sth->execute([':start' => $rangeStart, ':num' => $maxNum, ':subc_id' => $subc_id]);
                $articleInfos = $sth->fetchAll(PDO::FETCH_ASSOC);

                $sth2 = $this->dbhHelper->prepare('SELECT num AS total FROM SubCategory WHERE id = :subc_id');
                $sth2->execute([':subc_id' => $subc_id]);
                $total = $sth2->fetch(PDO::FETCH_ASSOC)['total'];

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

                $where = ' WHERE title LIKE :word';
                $command = 'SELECT id, c_id, subc_id, title, thumbnailName, updateDate FROM ' . $this::TABLENAME .
                $where . $order . $limit;
                $sth = $this->dbhHelper->prepare($command);
                $sth->execute([':start' => $rangeStart, ':num' => $maxNum, ':word' => "%{$word}%"]);
                $articleInfos = $sth->fetchAll(PDO::FETCH_ASSOC);

                $sth2 = $this->dbhHelper->prepare('SELECT COUNT(*) AS total FROM Article' . $where);
                $sth2->execute([':word' => "%{$word}%"]);
                $total = $sth2->fetch(PDO::FETCH_ASSOC)['total'];

                if ($total <= $maxNum * $pageId) {
                    $isLastPage = TRUE;
                }else {
                    $isLastPage = FALSE;
                }

                return $articleInfos;
            }
            elseif($c_id != NULL && $subc_id == NULL) {

                $where = ' WHERE c_id = :c_id AND title LIKE :word';
                $command = 'SELECT id, c_id, subc_id, title, thumbnailName, updateDate FROM ' . $this::TABLENAME .
                $where . $order . $limit;
                $sth = $this->dbhHelper->prepare($command);
                $sth->execute([':start' => $rangeStart, ':num' => $maxNum, ':word' => "%{$word}%", ':c_id' => $c_id]);
                $articleInfos = $sth->fetchAll(PDO::FETCH_ASSOC);

                $sth2 = $this->dbhHelper->prepare('SELECT COUNT(*) AS total FROM Article' . $where);
                $sth2->execute([':word' => "%{$word}%", ':c_id' => $c_id]);
                $total = $sth2->fetch(PDO::FETCH_ASSOC)['total'];

                if ($total <= $maxNum * $pageId) {
                    $isLastPage = TRUE;
                }else {
                    $isLastPage = FALSE;
                }

                return $articleInfos;
            }
            elseif ($c_id != NULL && $subc_id != NULL) {

                $where = ' WHERE subc_id = :subc_id AND title LIKE :word';
                $command = 'SELECT id, c_id, subc_id, title, thumbnailName, updateDate FROM ' . $this::TABLENAME .
                $where . $order . $limit;
                $sth = $this->dbhHelper->prepare($command);
                $sth->execute([':start' => $rangeStart, ':num' => $maxNum, ':word' => "%{$word}%", ':subc_id' => $subc_id]);
                $articleInfos = $sth->fetchAll(PDO::FETCH_ASSOC);

                $sth2 = $this->dbhHelper->prepare('SELECT COUNT(*) AS total FROM Article' . $where);
                $sth2->execute([':word' => "%{$word}%", ':subc_id' => $subc_id]);
                $total = $sth2->fetch(PDO::FETCH_ASSOC)['total'];

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
     * ['id' => int, 'c_id' => int, 'subc_id' => int, 'title' => string, 'thumbnainName' => string, 
     * 'content' => string, updataDate' => string]
     */
    public function findById(int $id):array
    {
        return [];
    }
}
