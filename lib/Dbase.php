<?php

//namespace library\Dbase;
/**
 * Class for database handling;
 * @property Dbase $instance
 * @version 2.02
 */

class Dbase extends PDO
{
    //    private $db = DB_DATABASE;
    //    private $host = DB_HOST;
    //    private $user = DB_USER;
    //    private $password = DB_PASSWORD;
    public $query = null;
    private $exc = null;
    private static $instance = null;
    /**
     * 
     * DB class constructor for PDO operations.
     * containing functions for database, based on PDO
     */
    function __construct($charSet = null)
    {
        $this->connect();
    }
    function connect($charSet = null)
    {
        $options = [];
        if (!empty($charSet) && $charSet == "utf-8") {
            $options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
        }
        try {
            parent::__construct("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD, $options);
        } catch (PDOException $pdoEx) {
            print_r($pdoEx->getMessage());
        }
    }
    /**
     * 
     * @param String $tableName
     * @param Associative Array ($key=>$val)  $data
     * @return bool
     */
    public static function getInstance()
    {
        if (!is_object(self::$instance)) {
            self::$instance = new Dbase();
        }
        return self::$instance;
    }
    /**
     * Insert data to tables
     * @param string $tableName
     * @param array $data array of array for multiple rows [[],[]]
     * @return $this
     */
    function insert($tableName, $data)
    {
        if (!empty($data[0]) && is_array($data[0])) {
            $fields = implode('`,`', array_keys($data[0]));
            $values = [];
            foreach ($data as $d) {
                array_push($values, "('" . implode("','", array_values($d)) . "')");
            }
            $values = implode(",", $values);
            $this->query = "INSERT INTO `$tableName` (`$fields`) values $values";
        } else {
            $fields = implode('`,`', array_keys($data));
            $values = implode("','", array_values($data));
            $this->query = "INSERT INTO `$tableName` (`$fields`) values ('$values')";
        }

        return $this;
    }
    /**
     * 
     * Insert multiple rows
     * 
     * @param type $dataArray
     */
    function insertRows($tableName, $dataArray)
    {
        if (is_array($dataArray[0])) {
            $fields = implode('`,`', array_keys($dataArray[0]));

            $values = [];
            foreach ($dataArray as $data) {
                array_push($values, "('" . implode("','", array_values($data)) . "')");
            }
        }
        $values = implode(",", $values);
        $this->query = "INSERT INTO `$tableName` (`$fields`) values $values";
        return $this;
    }
    /**
     * 
     * @param String $tableName
     * @return Boolean
     */
    function update($tableName)
    {
        $this->query = "UPDATE $tableName";
        return $this;
    }
    /**
     * 
     * @return Object
     */
    function run()
    {
        $sql = $this->prepare($this->query);
        if (is_object($sql)) {
            $sql->execute();
            return $this->exc = $sql;
        } else {
            $debug = debug_backtrace();
            print("Error in Query {$debug[0]['file']} Line:{$debug[0]['line']}");
            return false;
        }
    }
    /**
     * 
     * @param Array $data
     * @return Object Db
     */
    function set($data)
    {
        $set = implode(',', $data);
        $this->query .= ' SET ' . $set;
        return $this;
    }
    /**
     * Print Dump of sql Query
     */
    function dump_query()
    {
        var_dump($this->query);
    }
    /**
     * 
     * @param Array $tableName
     * @return object
     */
    function select($tableName)
    {
        $tabels = implode(',', $tableName);
        $this->query = "select * from $tabels";
        return $this;
    }
    /**
     * 
     * @param String column name
     * @return Object
     */
    function count($column)
    {
        $this->query = str_replace('*', "COUNT($column) AS count", $this->query);
        return $this;
    }
    /**
     * 
     * @param Array $fieldNames
     * @return Object
     */
    function fields($fieldNames)
    {
        $fields = implode(',', $fieldNames);
        $this->query = str_replace('*', $fields, $this->query);
        return $this;
    }
    /**
     * 
     * @param  Array $conditions
     * @return Object
     */
    function where($conditions)
    {
        if (is_array($conditions) && count($conditions)) {
            $condition = implode(' AND ', $conditions);
            $this->query .= " where $condition";
        }
        return $this;
    }
    /**
     * 
     * @param String $orderBy Field name by which should be order by.
     * @param String $order Data Order as ASC / DESC;
     * @return Object
     */
    function orderBy($orderBy, $order = 'ASC')
    {
        $this->query .= " ORDER BY $orderBy $order";
        return $this;
    }
    /**
     * 
     * @param String $groupBy
     * @return object
     */
    function groupBy($groupBy)
    {
        $this->query .= " GROUP BY $groupBy ";
        return $this;
    }
    /**
     * 
     * @return Data as object
     */
    function fetchAll()
    {
        $sql = parent::query($this->query);
        if (is_object($sql)) {
            $sql->execute();
            $this->exc = $sql;
            return $sql->fetchAll(PDO::FETCH_CLASS);
        } else {
            $debug = debug_backtrace();
            exit("Error in Query {$debug[0]['file']} Line:{$debug[0]['line']}");
        }
    }
    /**
     * 
     * @return Array All rows as associative Array
     */
    function fetchAssocAll()
    {
        $sql = parent::query($this->query);
        if (is_object($sql)) {
            $sql->execute();
            $this->exc = $sql;
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $debug = debug_backtrace();
            exit("Error in Query {$debug[0]['file']} Line:{$debug[0]['line']}");
        }
    }
    /**
     * 
     * @return type
     */
    function fetchArray()
    {
        $sql = parent::query($this->query);
        if (is_object($sql)) {
            $sql->execute();
            $this->exc = $sql;
            return $sql->fetchAll(PDO::FETCH_NUM);
        } else {
            $debug = debug_backtrace();
            exit("Error in Query {$debug[0]['file']} Line:{$debug[0]['line']}");
        }
    }
    /**
     * Apply limit
     */
    function limit($start, $end)
    {
        if (isset($start) && isset($end))
            $this->query .= " LIMIT $start,$end";
        return $this;
    }
    /**
     * Fetch the first row from table
     * @return Data as Assoc Array
     */
    function fetchAssocFirst()
    {
        $this->query .= " LIMIT 0,1";
        $sql = parent::query($this->query);
        if (is_object($sql)) {
            $sql->execute();
            $this->exc = $sql;
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            if (isset($data[0])) {
                return $data[0];
            }
        } else {
            $debug = debug_backtrace();
            exit("Error in Query {$debug[0]['file']} Line:{$debug[0]['line']}");
        }
    }
    /**
     * Fetch the first row from table
     * @return Data as object
     */
    function fetchFirst()
    {
        $this->query .= " LIMIT 0,1";
        $sql = parent::query($this->query);
        if (is_object($sql)) {
            $sql->execute();
            $this->exc = $sql;
            $data = $sql->fetchAll(PDO::FETCH_CLASS);
            if (!empty($data))
                return $data[0];
            else
                return $data;
        } else {
            $debug = debug_backtrace();
            exit("Error in Query {$debug[0]['file']} Line:{$debug[0]['line']}");
        }
    }
    /**
     * 
     * @param String $query
     * @return Object \Db
     */
    public function query(string $query, ?int $fetchMode = null, ...$fetchModeArgs)
    {
        $this->query = $query;
        return $this;
    }
    /**
     * 
     * @return Int
     */
    function affectedRows()
    {
        if ($this->exc) {
            return $this->exc->rowCount();
        } else {
            return 0;
        }
    }
}
