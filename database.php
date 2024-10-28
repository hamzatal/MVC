<?php

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Database
{
    private $server_name;
    private $db_name;
    private $username;
    private $password;
    private $pdo;

    public function __construct()
    {
        // Set the properties using environment variables inside the constructor
        $this->server_name = $_ENV['DB_SERVER'];
        $this->db_name = $_ENV['DB_DATABASE'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->connect(); // Initialize the connection when the object is created
    }

    // Establish the database connection
    private function connect()
    {
        $dsn = "mysql:host={$this->server_name};dbname={$this->db_name}";

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'Connection successful'; // You can remove this if not needed
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }


    // Optionally, you can create a method to return the PDO instance
    public function getConnection()
    {
        return $this->pdo;
    }
}

// Example of usage:
$db = new Database(); // Establishes a connection automatically
$connection = $db->getConnection(); // Gets the PDO connection instance if needed
