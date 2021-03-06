<?php

use PHPUnit\Framework\TestCase;
use infra\database\src\CategoryTable;
use myapp\myFrameWork\DB\Connection;
use myapp\myFrameWork\DB\MyDbh;

class CategoryTableTest extends TestCase
{
    const TABLENAME = 'Category';
    private $dbh;
    private $table;


    protected function setUp():void
    {
        $this->dbh = (new Connection(TRUE))->connect();
        $this->table = new CategoryTable(TRUE);

        $this->dbh->truncate($this::TABLENAME);
   
        $sth = $this->dbh->insertPrepare($this::TABLENAME, ':id, :name, :num', [':id' => 0, ':num' => 0]);

        for ($i = 1; $i < 3; ++$i) {
            $sth->bindValue(':name', "category{$i}");
            $sth->execute();
        }
    }


    public function testFindAll()
    {
        $this->assertSame([
            ['id' => 1, 'name' => 'category1', 'num' => 0],
            ['id' => 2, 'name' => 'category2', 'num' => 0]
        ], $this->table->findAll());
    }


    public function testFindById()
    {
        $c_id = 1;

        $this->assertSame([
            'id' => 1, 'name' => 'category1', 'num' => 0
        ], $this->table->findById($c_id));
    }
}