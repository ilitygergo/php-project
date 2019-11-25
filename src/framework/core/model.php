<?php

class Model {
    /**
     * @var Mysql
     */
    protected $db; //database connection object

    /**
     * @var string
     */
    protected $table; //table name

    /**
     * @var array
     */
    protected $fields = array();  //fields list

    /**
     * Model constructor.
     * @param $table
     */
    public function __construct($table){
        $dbconfig['host'] = $GLOBALS['config']['host'];
        $dbconfig['user'] = $GLOBALS['config']['user'];
        $dbconfig['password'] = $GLOBALS['config']['password'];
        $dbconfig['dbname'] = $GLOBALS['config']['dbname'];
        $dbconfig['port'] = $GLOBALS['config']['port'];
        $dbconfig['charset'] = $GLOBALS['config']['charset'];

        $this->db = new Mysql($dbconfig);
        $this->table = $GLOBALS['config']['prefix'] . $table;
//        $this->getFields();
    }

    /**
     * Get the list of table fields
     *
     */
    private function getFields(){
        $sql = "DESC ". $this->table;
        $result = $this->db->getAll($sql);

        foreach ($result as $v) {
            $this->fields[] = $v['Field'];

            if ($v['Key'] == 'PRI') {
                $pk = $v['Field'];
            }
        }

        if (isset($pk)) {
            $this->fields['pk'] = $pk;
        }
    }

    /**
     * Insert records
     * @access public
     * @param $list array associative array
     * @return mixed If succeed return inserted record id, else return false
     */
    public function insert($list){
        $field_list = '';  //field list string
        $value_list = '';  //value list string

        foreach ($list as $k => $v) {
            if (in_array($k, $this->fields)) {
                $field_list .= "`".$k."`" . ',';
                $value_list .= "'".$v."'" . ',';
            }
        }

        $field_list = rtrim($field_list,',');
        $value_list = rtrim($value_list,',');

        $sql = "INSERT INTO `{$this->table}` ({$field_list}) VALUES ($value_list)";

        if ($this->db->query($sql)) {
            return $this->db->getInsertId();
        } else {
            return false;
        }
    }

    /**
     * Update records
     * @access public
     * @param $list array associative array needs to be updated
     * @return mixed If succeed return the count of affected rows, else return false
     */
    public function update($list){
        $uplist = ''; //update fields
        $where = 0;   //update condition, default is 0

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
        $sql = "UPDATE `{$this->table}` SET {$uplist} WHERE {$where}";

        if ($this->db->query($sql)) {
            if ($rows = mysqli_affected_rows()) {
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

        $sql = "DELETE FROM `{$this->table}` WHERE $where";

        if ($this->db->query($sql)) {
            if ($rows = mysqli_affected_rows()) {
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
        $sql = "SELECT * FROM `{$this->table}` WHERE `{$this->fields['pk']}`=$pk";

        return $this->db->getRow($sql);
    }

    /**
     * Get the count of all records
     *
     */
    public function total(){
        $sql = "SELECT count(*) FROM {$this->table}";

        return $this->db->getOne($sql);
    }

    /**
     * Get info of pagination
     * @param $offset int offset value
     * @param $limit int number of records of each fetch
     * @param $where string where condition,default is empty
     * @return SQL
     */
    public function pageRows($offset, $limit,$where = ''){
        if (empty($where)){
            $sql = "SELECT * FROM {$this->table} LIMIT $offset, $limit";
        } else {
            $sql = "SELECT * FROM {$this->table} WHERE $where LIMIT $offset, $limit";
        }

        return $this->db->getAll($sql);
    }
}
