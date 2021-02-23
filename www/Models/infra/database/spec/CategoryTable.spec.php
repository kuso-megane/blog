<?php

use infra\database\src\CategoryTable;
use infra\database\helpers\DBConnection;


describe('CategoryTable:', function() {
    
    given('table', function(){
        return new CategoryTable(TRUE);
    });

    given('tablename', function () {
        return 'Category';
    });
    
    given('dbh', function () {
        return (new DBConnection(TRUE))->connect();
    });

    // TODO: なぜか、beforeEachだと外部キー制約に引っかかるので、暫定的にbeforeAll
    beforeAll(function () {
        $this->dbh->exec('set foreign_key_checks=0');
        $this->dbh->exec('TRUNCATE TABLE ' . $this->tablename);
        $this->dbh->exec('set foreign_key_checks=1');
    });

    describe('findAll():', function() {

        it('return all rows:', function () {

            $command = 'INSERT INTO ' . $this->tablename . ' VALUES(0, :name, :num)';
            
            try {
                $sth = $this->dbh->prepare($command);
            } catch (PDOException $e) {
                echo "given command: {$command};\n\t {$e->getMessage()}\n";
            }

            for ($i = 1; $i < 3; ++$i) {
                $sth->execute([':name' => "category{$i}", ':num' => $i]);
            }


            expect($this->table->findAll())->toBe([
                ['id' => 1, 'name' => 'category1', 'num' => 1],
                ['id' => 2, 'name' => 'category2', 'num' => 2]
            ]);
        });
    });

});

