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
     *      ['id' => int, 'c_id' => int, 'subc_id' => int, 'title' => string, 'thumbnainName' => string, 'updataDate' => string],
     *      []
     * ]
     */
    public function findRecentOnesInfos(int $maxNum, bool &$isLastPage, int $pageId, ?int $c_id = NULL, ?int $subc_id = NULL, ?string $word = NULL):array
    {
        $rangeStart = $maxNum * ($pageId - 1);
        if ($word == NULL) {
            if ($c_id == NULL && $subc_id == NULL) {

                $command = 'SELECT id, c_id, subc_id, title, thumbnailName, updateDate FROM ' . $this::TABLENAME .
                ' ORDER BY updateDate DESC' . " LIMIT :start,:num";
                $sth = $this->dbhHelper->prepare($command);
                $sth->execute([':start' => $rangeStart, ':num' => $maxNum]);
                $articleInfos = $sth->fetchAll(PDO::FETCH_ASSOC);

                $total = $this->dbh->query('SELECT SUM(num) as total FROM Category')->fetch(PDO::FETCH_ASSOC)['total'];
                if ($total <= $maxNum * $pageId) {
                    $isLastPage = TRUE;
                }else {
                    $isLastPage = FALSE;
                }

                return $articleInfos;

            }
            elseif ($c_id != NULL && $subc_id == NULL) {

                $command = 'SELECT id, c_id, subc_id, title, thumbnailName, updateDate FROM ' . $this::TABLENAME .
                ' WHERE c_id = :c_id' . ' ORDER BY updateDate DESC' . " LIMIT :start,:num";
                $sth = $this->dbhHelper->prepare($command);
                $sth->execute([':start' => $rangeStart, ':num' => $maxNum, ':c_id' => $c_id]);
                $articleInfos = $sth->fetchAll(PDO::FETCH_ASSOC);

                $sth2 = $this->dbhHelper->prepare('SELECT num FROM Category WHERE id = :c_id');
                $sth2->execute([':c_id' => $c_id]);
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
        
    }
}
