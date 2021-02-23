<?php

namespace infra\database\src;

use infra\database\helpers\DBConnection;
use PDO;

class ArticleTable
{
    private $dbh;


    /**
     * @param bool $is_test
     */
    public function __construct(bool $is_test=false)
    {
        $this->dbh = (new DBConnection($is_test))->connect(); //PDO
    }

    /**
     * @param int $pageId
     * @param int $maxNum  max num of articles you wanna fetch at a time
     * 
     * @return array [
     *      ['id' => int, 'c_id' => int, 'subc_id' => int, 'title' => string, 'thumbnainName' => string, 'updataDate' => string],
     *      []
     * ]
     */
    public function findRecentOnesInfo(int $pageId, int $maxNum):array
    {

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