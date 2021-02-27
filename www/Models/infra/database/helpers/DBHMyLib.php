<?php

namespace infra\database\helpers;
use PDO;
use PDOException;
use PDOStatement;

class DBHMyLib
{
    private $dbh;

    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    /**
     * truncate table by ignoring foreign key constrict
     * @param string $tablename
     * 
     * @return void
     */
    public function truncate(string $tablename):void
    {
        $this->dbh->exec('SET foreign_key_checks=0');
        $this->dbh->exec('TRUNCATE TABLE ' . $tablename);
        $this->dbh->exec('SET foreign_key_checks=1');     
    }


    /**
     * prepare sql statement. If preparing fails, echo error message.
     * @param string $command
     * 
     * @return PDOStatement
     */
    public function prepare(string $command):PDOStatement
    {
        try {
            $sth = $this->dbh->prepare($command);
        } catch (PDOException $e) {
            echo "\nPDO::prepare() failed!\n given command: {$command};\n {$e->getMessage()}\n";
        }

        return $sth;
    }
}