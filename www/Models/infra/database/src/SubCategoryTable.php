<?php

namespace infra\database\src;

use infra\database\helpers\DBConnection;
use infra\database\helpers\DBHMyLib;
use PDO;

class SubCategoryTable
{

    const TABLENAME = 'SubCategory';
    private $dbh;
    private $dbhHelper;


    /**
     * @param bool $is_test
     */
    public function __construct(bool $is_test=false)
    {
        $this->dbh = (new DBConnection($is_test))->connect(); //PDO
        $this->dbhHelper = new DBHMyLib($this->dbh);
    }

    /**
     * @return array [ ['id' => int, 'name' => string, 'c_id' => int, 'num' => int], [] ]
     */
    public function findAll():array
    {
        $records = $this->dbh->query('SELECT * FROM ' . $this::TABLENAME);
        return $records->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * @return array ['id' => int, 'name' => string, 'c_id' => int, 'num' => int]
     */
    public function findById(int $subc_id):array
    {
        $command = 'SELECT * FROM ' . $this::TABLENAME . ' WHERE id = :subc_id';
        $sth = $this->dbhHelper->prepare($command);
        $sth->execute([':subc_id' => $subc_id]);

        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}