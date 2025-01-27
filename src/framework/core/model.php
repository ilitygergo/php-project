<?php
namespace App\Framework\Core;

abstract class Model {
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
    static protected $fields = [];

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
     * @return bool
     */
    public function isNewInstance() {
        return !$this->getId() != '';
    }

    /**
     * @param $data
     *
     * @return mixed|string
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
     * @param $list
     *
     * @return bool|int
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
     * @return bool|int
     */
    public function delete(){
        $where = 0;
        $key = $this->getId();

        $where = static::$fields[static::PRIMARY_KEY] . "='$key'";

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
     * @return mixed
     */
    public function total(){
        $sql = "SELECT count(*) FROM " . static::$table;

        return $this->findFisrt($sql);
    }

    /**
     * @param $offset
     *
     * @param $limit
     *
     * @param string $where
     *
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
     * @param $field
     *
     * @param $value
     *
     * @return mixed
     */
    public function isUnique($field, $value) {
        $sql = "SELECT * FROM " . static::$table . " WHERE " . $field . "='$value'";

        return $this->findFirst($sql);
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function findByEmail($email){
        $sql = "SELECT * FROM " . static::$table . " WHERE email='$email';";

        return $this->findFirst($sql);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function findById($id){
        $sql = "SELECT * FROM " . static::$table . " WHERE " . static::$fields[static::PRIMARY_KEY] . "=$id";

        return $this->findFirst($sql);
    }

    /**
     * @param $sql
     *
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
     * @param $sql
     *
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

    /**
     * @param $result
     *
     * @return array
     */
    public function mysqlResultToArray($result) {
        $array = [];

        foreach ($result as $key => $value) {
            $array[static::$fields[$key]] = $value;
        }

        return $array;
    }
}
