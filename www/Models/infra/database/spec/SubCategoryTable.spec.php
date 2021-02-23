<?php


use infra\database\src\SubCategoryTable;
use infra\database\helpers\DBConnection;


describe('SubCategoryTable:', function() {
    
    given('table', function() {
        return new SubCategoryTable(TRUE);
    });

    given('tablename', function () {
        return 'SubCategory';
    });

    given('parentTablename', function() {
        return  'Category';
    });
    
    given('dbh', function () {
        return (new DBConnection(TRUE))->connect();
    });

    beforeAll(function () {
        $this->dbh->exec('set foreign_key_checks=0');
        $this->dbh->exec('TRUNCATE TABLE ' . $this->parentTablename);
        $this->dbh->exec('set foreign_key_checks=1');

        
        $command = 'INSERT INTO ' . $this->parentTablename . ' VALUES(0, :name , :num)';

        try {
            $sth = $this->dbh->prepare($command);
        } catch (PDOException $e) {
            echo "given command: {$command};\n\t {$e->getMessage()}\n";
        }

        for ($i = 1; $i < 3; ++$i) {
            $sth->execute([':name' => "category{$i}", ':num' => $i]);
        }
        
    });

    beforeEach(function () {
        $this->dbh->exec('set foreign_key_checks=0');
        $this->dbh->exec('TRUNCATE TABLE ' . $this->tablename);
        $this->dbh->exec('set foreign_key_checks=1');
    });

    describe('findAll():', function() {

        it('return all rows:', function () {
            $command = 'INSERT INTO ' . $this->tablename . ' VALUES(0, :name, :c_id, :num)';

            try {
                $sth = $this->dbh->prepare($command);
            } catch (PDOException $e) {
                echo "given command: {$command};\n\t {$e->getMessage()}\n";
            }
            
            for ($i = 1; $i < 3; ++$i) {
                $sth->execute([':name' => "subCategory{$i}", ':c_id' => $i, ':num' => $i]);
            }


            expect($this->table->findAll())->toBe([
                ['id' => 1, 'name' => 'subCategory1', 'c_id' => 1, 'num' => 1],
                ['id' => 2, 'name' => 'subCategory2', 'c_id' => 2, 'num' => 2]
            ]);
        });
    });
});

