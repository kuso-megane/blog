<?php

namespace infra\database\helpers;

use PDO;
use PDOException;

class DBConnection
{
    const HOST_NAME = '62d9acf367e6';
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
    public function __construct(bool $is_test=false, string $username='root')
    {
        if ($is_test == 1) {
            $this->dbname = $this::TEST_DB;
        }
        else {
            $this->dbname = $this::MAIN_DB;
        }
        $this->username = $username;
    }

    /**
     * @return PDO
     */
    public function connect():PDO
    {
        $dsn = 'mysql:host=' . $this::HOST_NAME . ';dbname=' . $this->dbname;
        $pw = $this::DB_PASS[$this->username];

        try {
            $dbh = new PDO($dsn, $this->username, $pw);
        }
        catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        return $dbh;
    }
}