<?php

use PHPUnit\Framework\TestCase;
use infra\database\src\CategoryTable;
use infra\database\helpers\DBConnection;
use infra\database\helpers\DBHMyLib;

class CategoryTableTest extends TestCase
{
    const TABLENAME = 'Category';
    private $dbh;
    private $table;
    private $dbhHelper;


    protected function setUp():void
    {
        $this->dbh = (new DBConnection(TRUE))->connect();
        $this->table = new CategoryTable(TRUE);
        $this->dbhHelper = new DBHMyLib($this->dbh);

        $this->dbhHelper->truncate($this::TABLENAME);
    }


    public function testFindAll()
    {
        $command = 'INSERT INTO ' . $this::TABLENAME . ' VALUES(0, :name, :num)';
            
        $sth = $this->dbhHelper->prepare($command);

        for ($i = 1; $i < 3; ++$i) {
            $sth->execute([':name' => "category{$i}", ':num' => 0]);
        }

        $this->assertSame([
            ['id' => 1, 'name' => 'category1', 'num' => 0],
            ['id' => 2, 'name' => 'category2', 'num' => 0]
        ], $this->table->findAll());
    }
}