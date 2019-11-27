<?php

class Model {
    /**
     * @var mysqli
     */
    static protected $db;

    /**
     * @var string
     */
    static protected $table;

    /**
     * @var array
     */
    protected $fields = array();

    /**
     * @var array
     */
    static public $errors = [];

    /**
     * @param $db
     */
    static public function setDb($db) {
        self::$db = $db;
    }

    /**
     * Model constructor.
     */
    public function __construct(){
        $dbconfig['host'] = $GLOBALS['config']['host'];
        $dbconfig['user'] = $GLOBALS['config']['user'];
        $dbconfig['password'] = $GLOBALS['config']['password'];
        $dbconfig['dbname'] = $GLOBALS['config']['dbname'];
        $dbconfig['port'] = $GLOBALS['config']['port'];
        $dbconfig['charset'] = $GLOBALS['config']['charset'];

        self::$db = new Mysql($dbconfig);
    }

    /**
     * @param $data
     * @return bool|resource
     */
    function insert($data) {
        $fields = array_keys($data);

        $sql = 'INSERT INTO ' . static::$table .
            ' (' . implode(', ', $fields) . ') ' .
            ' VALUES(\'' . implode('\',\'', $data) . '\')';

        return mysqli_query(self::$db, $sql);
    }

    /**
     * Update records
     * @access public
     * @param $list array associative array needs to be updated
     * @return mixed If succeed return the count of affected rows, else return false
     */
    public function update($list){
        $uplist = '';
        $where = 0;

        foreach ($list as $k => $v) {
            if (in_array($k, $this->fields)) {
                if ($k == $this->fields['pk']) {
                    $where = "`$k`=$v";
                } else {
                    $uplist .= "`$k`='$v'".",";
                }
            }
        }

        $uplist = rtrim($uplist,',');
        $sql = "UPDATE " . static::$table . " SET {$uplist} WHERE {$where}";

        if (self::$db->query($sql)) {
            if ($rows = mysqli_affected_rows(self::$db)) {
                return $rows;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Delete records
     * @access public
     * @param $pk mixed could be an int or an array
     * @return mixed If succeed, return the count of deleted records, if fail, return false
     */
    public function delete($pk){
        $where = 0;

        if (is_array($pk)) {
            $where = "`{$this->fields['pk']}` in (".implode(',', $pk).")";
        } else {
            $where = "`{$this->fields['pk']}`=$pk";
        }

        $sql = "DELETE FROM " . static::$table . " WHERE $where";

        if (self::$db->query($sql)) {
            if ($rows = mysqli_affected_rows(self::$db)) {
                return $rows;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Get info based on PK
     * @param $pk int Primary Key
     * @return array an array of single record
     */
    public function selectByPrimaryKey($pk){
        $sql = "SELECT * FROM " . static::$table . " WHERE " . $this->fields['pk'] . "=$pk";

        return self::$db->getRow($sql);
    }

    /**
     * Get the count of all records
     *
     */
    public function total(){
        $sql = "SELECT count(*) FROM " . static::$table;

        return self::$db->getOne($sql);
    }

    /**
     * Get info of pagination
     * @param $offset int offset value
     * @param $limit int number of records of each fetch
     * @param $where string where condition,default is empty
     * @return string
     */
    public function pageRows($offset, $limit,$where = ''){
        if (empty($where)){
            $sql = "SELECT * FROM " . static::$table . " LIMIT $offset, $limit";
        } else {
            $sql = "SELECT * FROM " . static::$table . " WHERE $where LIMIT $offset, $limit";
        }

        return self::$db->getAll($sql);
    }
}
