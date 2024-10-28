<?php

class Model
{
    protected $pdo;
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
        $server_name = $_ENV['DB_SERVER'];
        $db_name = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        $dsn = "mysql:host={$server_name};dbname={$db_name}";

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}"); // Use double quotes
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id"); // Use double quotes
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        // Prepare column names and placeholders
        $keys = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data)); // Adds `:` before each placeholder

        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO {$this->table} ($keys) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);

        // Execute the statement with the data
        $stmt->execute($data);
    }
    
}
