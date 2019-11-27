<?php

class Mysql{

    /**
     * @var bool|false|resource
     */
    protected $conn = false;

    /**
     * @var string
     */
    protected $sql;

    /**
     * @return bool|false|mysqli|resource
     */
    public function getConnection() {
        return $this->conn;
    }

    /**
     * Constructor, to connect to database, select database and set charset
     * @param $config string configuration array
     */
    public function __construct($config = array()){
        $host = $config['host'] ?? 'db';
        $user = $config['user'] ?? 'docker';
        $password = $config['password'] ?? 'docker';
        $dbname = $config['dbname'] ?? 'docker';
        $port = $config['port'] ?? '3306';

        $this->conn = mysqli_connect($host, $user, $password, $dbname, $port) or die('Database connection error');

        $this->setChar();
    }

    /**
     * @access private
     * @param $charset string charset
     */
    private function setChar(){
        $this->conn->set_charset('utf8');
        $this->query('SET collation_connection = \'latin2_hungarian_ci\';');
    }

    /**
     * @access public
     * @param $sql string SQL query statement
     * @return $result，if succeed, return resrouces; if fail return error message and exit
     */
    public function query($sql){
        $this->sql = $sql;
        $result = mysqli_query($this->conn, $this->sql);

        if (! $result) {
            die($this->errno().':'.$this->error().'<br />Error SQL statement is '.$this->sql.'<br />');
        }

        return $result;
    }

    /**
     * Get the first column of the first record
     * @access public
     * @param $sql string SQL query statement
     * @return  bool|resource the value of this column
     */
    public function getOne($sql){
        $result = $this->query($sql);
        $row = mysqli_fetch_row($result);

        if ($row) {
            return $row[0];
        } else {
            return false;
        }
    }

    /**
     * Get one record
     * @access public
     * @param $sql SQL query statement
     * @return array|bool associative array
     */
    public function getRow($sql){
        if ($result = $this->query($sql)) {
            $row = mysqli_fetch_assoc($result);

            return $row;
        } else {
            return false;
        }
    }

    /**
     * Get all records
     * @access public
     * @param $sql SQL query statement
     * @return $list an 2D array containing all result records
     */
    public function getAll($sql){
        $result = $this->query($sql);
        $list = array();

        while ($row = mysqli_fetch_assoc($result)){
            $list[] = $row;
        }

        return $list;
    }

    /**
     * Get the value of a column
     * @access public
     * @param $sql string SQL query statement
     * @return $list array an array of the value of this column
     */
    public function getCol($sql){
        $result = $this->query($sql);
        $list = array();

        while ($row = mysqli_fetch_row($result)) {
            $list[] = $row[0];
        }

        return $list;
    }

    /**
     * Get last insert id
     */
    public function getInsertId(){
        return mysqli_insert_id($this->conn);
    }

    /**
     * Get error number
     * @access private
     * @return string number
     */
    public function errno(){
        return mysqli_errno($this->conn);
    }

    /**
     * Get error message
     * @access private
     * @return string message
     */
    public function error(){
        return mysqli_error($this->conn);
    }
}
