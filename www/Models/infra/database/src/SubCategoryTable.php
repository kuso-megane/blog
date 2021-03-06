<?php

namespace infra\database\src;

use myapp\myFrameWork\DB\Connection;


class SubCategoryTable
{

    const TABLENAME = 'SubCategory';
    private $dbh;


    /**
     * @param bool $is_test
     */
    public function __construct(bool $is_test=false)
    {
        $this->dbh = (new Connection($is_test))->connect(); //PDO
    }

    /**
     * @return array [ ['id' => int, 'name' => string, 'c_id' => int, 'num' => int], [] ]
     */
    public function findAll():array
    {
        return $this->dbh->select('*', $this::TABLENAME);
    }


    /**
     * @return array ['id' => int, 'name' => string, 'c_id' => int, 'num' => int]
     */
    public function findById(int $subc_id):array
    {
        return $this->dbh->select('*', $this::TABLENAME, 'id = :subc_id', [], [':subc_id' => $subc_id])[0];
    }
}
