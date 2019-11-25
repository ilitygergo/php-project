<?php
namespace models;

use \mysqli;

class Db {

    /**
     * @var string
     */
    public $mysqli;

    /**
     * @var string
     */
    protected $db_name;

    /**
     * @var string
     */
    protected $server_name;

    /**
     * @var string
     */
    protected $user_name;

    /**
     * @var string
     */
    protected $pass_code;

    /**
     *
     */
    public function __construct() {
        $this->db_name = Dbconfig::$db_name;
        $this->server_name =  Dbconfig::$server_name;
        $this->user_name =  Dbconfig::$user_name;
        $this->pass_code =  Dbconfig::$pass_code;
    }

    /**
     * @return mysqli/string
     */
    public function dbConnect() {
        $this->mysqli = new mysqli($this->server_name, $this->user_name, $this->pass_code, $this->db_name, 3308);

        if ($this->mysqli->connect_error) {
            die('Connect Error (' . $this->mysqli->connect_errno . ') '
                . $this->mysqli->connect_error);
        }

        return $this->mysqli;
    }

    /**
     *
     */
    public function dbDisconnect() {
        $this->mysqli = NULL;
        $this->db_name = NULL;
        $this->server_name = NULL;
        $this->user_name = NULL;
        $this->pass_code = NULL;
    }
}
