<?php

use PHPUnit\Framework\TestCase;
use infra\database\src\CategoryTable;
use infra\database\src\SubCategoryTable;
use myapp\myFrameWork\DB\Connection;
use myapp\myFrameWork\DB\MyDbh;

class SubCategoryTableTest extends TestCase
{
    const TABLENAME = 'SubCategory';
    const PARENT_TABLENAME = 'Category';
    private $dbh;
    private $table;


    protected function setUp():void
    {
        $this->dbh = (new Connection(TRUE))->connect();
        $this->table = new SubCategoryTable(TRUE);
        $this->parentTable = new CategoryTable(TRUE);

        $this->dbh->truncate($this::TABLENAME);
        $this->dbh->truncate($this::PARENT_TABLENAME);

        $sth = $this->dbh->insert($this::PARENT_TABLENAME, ':id, :name , :num', ['id' => 0, ':num' => 0], MyDbh::ONLY_PREPARE);

        for ($i = 1; $i < 3; ++$i) {
            $sth->bindValue(':name', "category{$i}");
            $sth->execute();
        }
 
        $sth2 = $this->dbh->insert($this::TABLENAME, ':id, :name, :c_id, :num', [':id' => 0, ':num' => 0], MyDbh::ONLY_PREPARE);

        for ($i = 1; $i < 3; ++$i) {
            $sth2->bindValue(':name', "subCategory{$i}");
            $sth2->bindValue(':c_id', $i, PDO::PARAM_INT);
            $sth2->execute();
        }
    }


    public function testFindAll()
    {
        $this->assertSame([
            ['id' => 1, 'name' => 'subCategory1', 'c_id' => 1, 'num' => 0],
            ['id' => 2, 'name' => 'subCategory2', 'c_id' => 2, 'num' => 0]
        ], $this->table->findAll());
    }


    public function testFindById()
    {
        $subc_id = 1;

        $this->assertSame([
            'id' => 1, 'name' => 'subCategory1', 'c_id' => 1, 'num' => 0
        ], $this->table->findById($subc_id));
    }
}