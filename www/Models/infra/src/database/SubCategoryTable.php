<?php

namespace infra\database;

use infra\database\helpers\DBConnection;
use PDO;

class SubCategoryTable
{

    const TABLENAME = 'SubCategory';
    private $dbh;


    /**
     * @param bool $is_test
     */
    public function __construct(bool $is_test=false)
    {
        $this->dbh = (new DBConnection($is_test))->connect(); //PDO
    }

    /**
     * @return array [ ['id' => int, 'name' => string, 'c_id' => int, 'num' => int], [] ]
     */
    public function findAll():array
    {
        $records = $this->dbh->query('SELECT * FROM ' . $this::TABLENAME);
        return $records->fetchAll(PDO::FETCH_ASSOC);
    }
}