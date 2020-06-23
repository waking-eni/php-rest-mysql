<?php

/* Database handler */

define('host', 'localhost');
define('user', 'root');
define('pass', '');
define('database', 'php-rest-mysql');
define('port', '3308');

class Database {

    public $con = null;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->con = new mysqli(host, user, pass, database, port);
        } catch (Exception $e) {
            echo "Database could not be connected: " . $e->getMessage();
        }
        return $this->conn;
    }

}