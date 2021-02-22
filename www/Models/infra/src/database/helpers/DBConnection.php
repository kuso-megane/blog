<?php

namespace infra\database\helpers;

use PDO;
use PDOException;

class DBConnection
{
    const DB_HOST = 'db';
    const MAIN_DB = 'app';
    const TEST_DB = 'test_db';
    const DB_PASS = ['root' => 'root'];

    private $username;
    private $dbname;


    /**
     * @param bool $is_test if you wanna use db for test, this must be TRUE.
     * @param string $username db userName
     * 
     */
    public function __construct(bool $is_test=FALSE, string $username='root')
    {
        if ($is_test == TRUE) {
            $this->dbname = $this::TEST_DB;
        }
        else {
            $this->dbname = $this::MAIN_DB;
        }
        $this->username = $username;
    }

    /**
     * return new PDO
     * @return PDO
     */
    public function connect():PDO
    {
        $dsn = "mysql:dbname={$this->dbname};" . 'host=' . $this::DB_HOST;
        $pw = $this::DB_PASS[$this->username];

        try {
            $dbh = new PDO($dsn, $this->username, $pw);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch (PDOException $e) {
            echo "Connection failed:\n\t dsn = '{$dsn}'\n\t {$e->getMessage()}\n";
        }

        return $dbh;
    }
}