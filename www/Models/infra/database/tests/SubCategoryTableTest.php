<?php

use PHPUnit\Framework\TestCase;
use infra\database\src\CategoryTable;
use infra\database\src\SubCategoryTable;
use infra\database\helpers\DBConnection;
use infra\database\helpers\DBHMyLib;

class SubCategoryTableTest extends TestCase
{
    const TABLENAME = 'SubCategory';
    const PARENT_TABLENAME = 'Category';
    private $dbh;
    private $table;
    private $dbhHelper;


    protected function setUp():void
    {
        $this->dbh = (new DBConnection(TRUE))->connect();
        $this->table = new SubCategoryTable(TRUE);
        $this->parentTable = new CategoryTable(TRUE);
        $this->dbhHelper = new DBHMyLib($this->dbh);

        $this->dbhHelper->truncate($this::TABLENAME);
        $this->dbhHelper->truncate($this::PARENT_TABLENAME);

        $command = 'INSERT INTO ' . $this::PARENT_TABLENAME . ' VALUES(0, :name , :num)';
        $sth = $this->dbhHelper->prepare($command);
        for ($i = 1; $i < 3; ++$i) {
            $sth->execute([':name' => "category{$i}", ':num' => 0]);
        }

        $command2 = 'INSERT INTO ' . $this::TABLENAME . ' VALUES(0, :name, :c_id, :num)'; 
        $sth2 = $this->dbhHelper->prepare($command2);

        for ($i = 1; $i < 3; ++$i) {
            $sth2->execute([':name' => "subCategory{$i}", ':c_id' => $i, ':num' => 0]);
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