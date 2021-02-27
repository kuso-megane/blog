<?php

namespace infra\database\helpers;
use PDO;
use PDOException;
use PDOStatement;

class DBMyLib
{

    /**
     * @param PDO $dbh
     * @param string $tablename
     * 
     * @return void
     */
    public function truncate(PDO $dbh, string $tablename):void
    {
        $dbh->exec('SET foreign_key_checks=0');
        $dbh->exec('TRUNCATE TABLE ' . $tablename);
        $dbh->exec('SET foreign_key_checks=1');     
    }


    /**
     * @param PDO $dbh
     * @param string $command
     * 
     * @return PDOStatement
     */
    public function prepare(PDO $dbh, string $command):PDOStatement
    {
        try {
            $sth = $dbh->prepare($command);
        } catch (PDOException $e) {
            echo "given command: {$command};\n\t {$e->getMessage()}\n";
        }

        return $sth;
    }
}