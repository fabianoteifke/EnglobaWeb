<?php
include_once dirname(__FILE__) . "/../config/config.php";

class Banco1 {
    public $conn;
    public $stmt;

    function getConn() {
        return $this->conn;
    }
    function getStmt() {
        return $this->stmt;
    }
    function setConn($conn) {
        $this->conn = $conn;
    }
    function setStmt($stmt) {
        $this->stmt = $stmt;
    }
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=" . HOST_NAME . ";dbname=" . DATABASE_NAME . "", DATABASE_USER_NAME, DATABASE_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Não foi possível se conectar ao banco!' . '<br/>';
            die($e->getMessage());
        }
    }

}