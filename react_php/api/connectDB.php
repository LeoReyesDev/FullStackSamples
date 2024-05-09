<?php
// Database configuration
$host = 'localhost';
$dbname = 'ne89cb5_dbTesting';
$username = 'ne89cb5_usertest';
$password = 'h6_BTgF.HA&L@}P';
$dsn = "mysql:host=$host;dbname=$dbname";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    die('Could not connect to the database: ' . $e->getMessage());
}
