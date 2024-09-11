<?php

class Database {
    private static $instance = null;
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "student_management_system";
    public $connection;

    private function __construct() {
        $this->connect();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect() {
        $this->connection = new mysqli($this->server, $this->username, $this->password, $this->db_name);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
}
?>
