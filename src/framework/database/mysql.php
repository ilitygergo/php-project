<?php

class Mysql {

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
     * @param $config array
     */
    public function __construct($config = array()){
        $host = $config['host'] ?? getenv("DB_HOST");
        $user = $config['user'] ?? getenv("DB_USERNAME");
        $password = $config['password'] ?? getenv("DB_PASSWORD");
        $dbname = $config['dbname'] ?? getenv("DB_NAME");
        $port = $config['port'] ?? getenv("PORT");

        $this->conn = mysqli_connect($host, $user, $password, $dbname, $port) or die('Database connection error');

        $this->conn->set_charset('utf8');
        $this->conn->query('SET collation_connection = \'latin2_hungarian_ci\';');
    }
}
