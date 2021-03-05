<?php

namespace myapp\myFrameWork\DB;

use PDO;
use PDOException;
use PDOStatement;

class MyDbh extends PDO
{

    /**
     * truncate table by ignoring foreign key constrict
     * @param string $tablename
     * 
     * @return void
     */
    public function truncate(string $tablename):void
    {
        $this->exec('SET foreign_key_checks=0');
        $this->exec('TRUNCATE TABLE ' . $tablename);
        $this->exec('SET foreign_key_checks=1');     
    }


    /**
     * prepare sql statement. If preparing fails, echo error message.
     * @param string $command
     * @param array $options
     * 
     * @return PDOStatement
     */
    public function myPrepare(string $command, array $options = []):PDOStatement
    {
        try {

            $sth = $this->prepare($command, $options);

        } catch (PDOException $e) {

            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
            $class = $trace[1]['class'];
            $type = $trace[1]['type'];
            $function = $trace[1]['function'];
            $line = $trace[1]['line'];
            echo "\nPDO::prepare() failed in {$class}{$type}{$function}() line:{$line}\n given command: {$command};\n {$e->getMessage()}\n";

        }

        return $sth;
    }


    /**
     * This execute SELECT query with prepared statement by binding value and executing. You only have to fetch after this.
     * 
     * @param string $select
     * @param string $tableName
     * @param string $condition
     * @param array $boundCondition
     * @param array $options
     * 
     * @return PDOStatement
     */
    private function rawSelect(string $select, string $tableName, string $condition = '', array $boundCondition = [], array $options = []):PDOStatement
    {
        foreach($options as $key => $value) {
            $$key = $value;
        }

        if ($condition != NULL) {
            $where = " WHERE {$condition} ";
        }
        else {
            $where = '';
        }

        if ($orderby != NULL) {
            $order = " ORDER BY :orderby :sort ";
        }
        else {
            $order = '';
        }

        if ($limitNum != NULL) {
            if ($limitStart != NULL) {
                $limit = " LIMIT :limitStart,:limitNum ";
            }
            else {
                $limit = " LIMIT :limitNum ";
            }
        }
        else {
            $limit = '';
        }


        $query = 'SELECT ' . $select . ' FROM ' . $tableName . $where . $order . $limit;
        $sth = $this->myPrepare($query);
        $boundValues = $boundCondition + $options;
        $sth->execute($boundValues);

        return $sth;
    }

    


    /**
     * This returns the records you want.
     * 
     * @param string $columns the columns you want (e.g.) 'id, num'
     * @param string $tableName
     * @param string $condition For prepared statement, this must be like 'id = :id AND num > :num' 
     * @param array $boundCondition (e.g.) [':id' => int, ':num' => int]
     * @param array $options
     * [
     *      ':orderby' = string,
     *      ':sort' = 'ASC'|'DESC',
     *      ':limitStart' = int,
     *      ':limitNum' => int
     * ]
     * 
     * @return array (e.g.)[ ['id' => int, 'name' => string], [] ] 
     * 
     * $options[':limitStart']    the start index of the records you want, 
     * 
     * $options[':limitNum']      the num of the records you want
     * 
     * Note that $boundCondition is only for $condition.
     * Others like $options[':orderby'] will be automatically formatted for prepared statement and bound.
     * 
     */
    public function select(string $columns, string $tableName, string $condition = '', array $boundCondition = [], array $options = []):array
    {  
        $sth = $this->rawSelect($columns, $tableName, $condition, $boundCondition, $options);

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * return count of $column of records
     * @param string $column
     * @param string $tableName
     * @param string $condition For prepared statement, this must be like 'id = :id AND num > :num' 
     * @param array $boundCondition (e.g.) [':id' => int, ':num' => int]
     * 
     * @return int
     * 
     */
    public function count(string $column = '*', string $tableName, string $condition = '', array $boundCondition = []):int
    {
        $select = "count($column) as total";
        $sth = $this->rawSelect($select, $tableName, $condition, $boundCondition);

        return $sth->fetch(PDO::FETCH_ASSOC)['total'];
    }


    /**
     * insert record with $boundValues into the table you want
     * 
     * @param string $tableName
     * @param array $boundColumns
     * (e.g.) [ ':id' => int, ':name' => string]
     * 
     * @return void
     * 
     * Note that this automatically bind $boundValues to query.
     */
    public function insert(string $tableName, array $boundColumns):void
    {
        $values = ' VALUES(';
        $len = count($boundColumns);
        $c = 0;
        foreach($boundColumns as $column => $boundValue) {
            ++$c;
            if ($c == $len) {
                $values += "{$column}";
            }
            $values += ":{$column}, ";
        }
        $values += ') ';

        $command = 'INSERT INTO ' . $tableName . $values;
        $sth = $this->myPrepare($command);
        $boundValues = $boundColumns;
        $sth->execute($boundValues);
    }


    /**
     * update $column into $value
     * @param string $columns
     * @param string $tableName
     * @param array $boundColumns
     * [':columnname' => newValue]
     * @param string $condition For prepared statement, this must be like 'id = :id AND num > :num' 
     * @param array $boundCondition (e.g.) [':id' => int, ':num' => int]
     * 
     * @return void
     * 
     * if you wanna increment $column, set $value like 'num + 1'
     * 
     */
    public function update(string $column, string $tableName, array $boundColumns, string $condition = '', array $boundCondition = []):void
    {
        $where = " WHERE {$condition} ";
        $command = 'UPDATE ' . $tableName . ' SET ' . $column . ' = ' . key($boundColumns) . $where;
        $sth = $this->myPrepare($command);
        $boundValues = $boundColumns + $boundCondition;
        $sth->execute($boundValues);
    }
}
