<?php

namespace infra\database\src;

use myapp\myFrameWork\DB\Connection;


class CategoryTable
{
    const TABLENAME = 'Category';
    private $dbh;


    /**
     * @param bool $is_test
     */
    public function __construct(bool $is_test=false)
    {
        $this->dbh = (new Connection($is_test))->connect(); //MyDBh
    }

    /**
     * @return array [ 
     *      ['id' => int, 'name' => string, 'num' => int],
     *      []
     *   ]
     */
    public function findAll():array
    {
        return $this->dbh->select('*', $this::TABLENAME);
    }


    /**
     * @param int $id
     * 
     * @return array ['id' => int, 'name' => string, 'num' => int]
     */
    public function findById(int $id):array
    {
        $records = $this->dbh->select('*', $this::TABLENAME, 'id = :id', [], [':id' => $id]);
        return $records[0];
    }
}