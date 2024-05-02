<?php
// database.php

// Database.php

class Database {
    private $host = 'localhost';
    private $db_name = 'tiendaonline';
    private $username = 'root';
    private $password = '';
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
        }
    }
}

