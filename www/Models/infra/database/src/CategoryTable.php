<?php

namespace infra\database\src;

use infra\database\helpers\DBConnection;
use PDO;

class CategoryTable
{
    const TABLENAME = 'Category';
    private $dbh;


    /**
     * @param bool $is_test
     */
    public function __construct(bool $is_test=false)
    {
        $this->dbh = (new DBConnection($is_test))->connect(); //PDO
    }

    /**
     * @return array [['id' => int, 'name' => string, 'num' => int]]
     */
    public function findAll():array
    {
        $records = $this->dbh->query('SELECT * FROM ' . $this::TABLENAME);
        return $records->fetchAll(PDO::FETCH_ASSOC);
    }
}