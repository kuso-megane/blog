<?php

use infra\database\CategoryTable;
use infra\database\helpers\DBConnection;

const TABLENAME = 'Category';


describe('categoryTable', function() {
    
    given('table', function(){
        return new CategoryTable(TRUE);
    });
    
    given('dbh', function () {
        return (new DBConnection(TRUE))->connect();
    });

    describe('findAll():', function() {

        beforeEach(function () {
            $this->dbh->exec('set foreign_key_checks=0');
            $this->dbh->exec('TRUNCATE TABLE ' . TABLENAME);
            $this->dbh->exec('set foreign_key_checks=1');
        });

        it('return all rows:', function () {
            $command = 'INSERT INTO Category VALUES(0, :name, :num)';
            $sth = $this->dbh->prepare($command);
            for ($i = 0; $i < 2; ++$i) {
                $sth->execute([':name' => "category{$i}", ':num' => ($i + 1)]);
            }

            expect($this->table->findAll())->toBe([
                ['id' => 1, 'name' => 'category0', 'num' => 1],
                ['id' => 2, 'name' => 'category1', 'num' => 2]
            ]);
        });
    });
});
