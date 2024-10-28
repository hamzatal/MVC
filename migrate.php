<?php

require_once 'database.php';

$db = new Database();

$pdo = $db->getConnection();

// $host = 'localhost';
// $user = 'root';
// $password = '';
// $db = 'php-mvc';

// $dsn = "mysql:host=$host;dbname=$db";

// try {
//     $pdo = new PDO($dsn, $user, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die('Connection failed: ' . $e->getMessage());
// }

$executedMigration = $pdo->query("SELECT * FROM migrations")->fetchAll(PDO::FETCH_ASSOC);

$migrationsFiles = scandir(__DIR__.'/migrations');

//var_dump($migrationsFiles);

$batch = (int) $pdo->query("SELECT MAX(batch) FROM migrations")->fetchColumn() +1;

foreach ($migrationsFiles as $file) {
    if ($file === '.' || $file === '..') {
        continue;
    }

    $className = convertToClassName(pathinfo($file,PATHINFO_FILENAME));

    if (!in_array($className, $executedMigration)) {
        require __DIR__.'/migrations/'.$file;

        $migration = new $className;
        $pdo->exec($migration->up());
        $pdo->exec("INSERT INTO migrations (batch, migration) VALUES ('$className', $batch)");

        echo "Migration $className run successfully \n";
    }
}

function convertToClassName($file) {
    $fileNameWithoutDate = preg_replace('/^(\d{4}_\d{2}_\d{2})_/', '', $file);
    //var_dump($fileNameWithoutDate);
    $parts = explode('_', $fileNameWithoutDate);
    $className = '';
    foreach ($parts as $part) {
        $className .= ucfirst($part);
    }
    //var_dump($className);
    return $className;
}