<?php

require_once __DIR__ . '/../../bootstrap.php';

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $host = $_SERVER['DB_HOST'];
        $dbname = $_SERVER['DB_DATABASE'];
        $username = $_SERVER['DB_USER'];
        $password = $_SERVER['DB_PASS'];

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}