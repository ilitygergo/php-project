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
     * The first element is the primary key
     * @var array
     */
    static protected $fields = [];

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
     * @return string
     */
    public function error() {
        return self::$db->errno . ': ' . self::$db->error;
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

        if (self::$db->query($sql)) {
            return self::$db->insert_id;
        } else {
            return $this->error();
        }
    }

    /**
     * Update records
     * @access public
     * @param $list array associative array needs to be updated
     * @return mixed If succeed return the count of affected rows, else return false
     */
    public function update($list){
        $uplist = [];
        $where = 0;

        foreach ($list as $k => $v) {
            if (in_array($k, static::$fields)) {
                if ($k == static::$fields[0]) {
                    $where = "$k=$v;";
                } else {
                    $uplist[] = "$k='$v' ";
                }
            }
        }

        $sql = "UPDATE " . static::$table . " SET " . implode($uplist, ', ') . " WHERE {$where}";

        if (self::$db->query($sql)) {
            if ($rows = self::$db->affected_rows) {
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
     * @param $key int
     * @return mixed If succeed, return the count of deleted record, if fail, return false
     */
    public function delete($key){
        $where = 0;

        $where = static::$fields[0] . "='$key'";

        $sql = "DELETE FROM " . static::$table . " WHERE $where";

        if (self::$db->query($sql)) {
            if ($rows = self::$db->affected_rows) {
                return $rows;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Find the count of all records
     *
     */
    public function total(){
        $sql = "SELECT count(*) FROM " . static::$table;

        return $this->findFisrt($sql);
    }

    /**
     * Get info of pagination
     * @param $offset int offset value
     * @param $limit int number of records of each fetch
     * @param $where string where condition,default is empty
     * @return array
     */
    public function pageRows($offset, $limit,$where = ''){
        if (empty($where)){
            $sql = "SELECT * FROM " . static::$table . " LIMIT $offset, $limit";
        } else {
            $sql = "SELECT * FROM " . static::$table . " WHERE $where LIMIT $offset, $limit";
        }

        return $this->findAll($sql);
    }

    /**
     * Checks if the field has a unique value
     * @param $field
     * @param $value
     * @return bool
     */
    public function isUnique($field, $value) {
        $sql = "SELECT * FROM " . static::$table . " WHERE " . $field . "='$value'";

        return $this->findFirst($sql);
    }

    /**
     * Get info based on id
     * @param $email string
     * @return bool|mysqli_result
     */
    public function findByEmail($email){
        $sql = "SELECT * FROM " . static::$table . " WHERE email='$email';";

        return $this->findFirst($sql);
    }

    /**
     * Get info based on id
     * @param $id int Primary Key
     * @return bool|mysqli_result
     */
    public function findById($id){
        $sql = "SELECT * FROM " . static::$table . " WHERE " . static::$fields[0] . "=$id";

        return $this->findFirst($sql);
    }

    /**
     * Get the first record
     * @param $sql
     * @return mixed
     */
    public function findFirst($sql){
        $result = self::$db->query($sql);
        $row = $result->fetch_row();

        if ($row) {
            return $row;
        } else {
            return false;
        }
    }

    /**
     * Find all records
     * @param $sql
     * @return array
     */
    public static function findAll($sql){
        $result = self::$db->query($sql);
        $list = [];

        while ($row = $result->fetch_assoc()){
            $list[] = $row;
        }

        return $list;
    }
}
