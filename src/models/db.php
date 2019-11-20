<?php
namespace models;

use mysqli;

class Db {

    /**
     * @var string
     */
    public $db;

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
     * @return mysqli
     */
    public function dbConnect() {
        $this->db = new mysqli($this->server_name, $this->user_name, $this->pass_code, $this->db_name);

        if ($this->db->connect_error) {
            die(
                'Db connection failed: ' . $this->db->connect_error .
                ' No.:' . $this->db->errno
            );
        }

        return $this->db;
    }

    /**
     *
     */
    public function dbDisconnect() {
        $this->db = NULL;
        $this->db_name = NULL;
        $this->server_name = NULL;
        $this->user_name = NULL;
        $this->pass_code = NULL;
    }
}
