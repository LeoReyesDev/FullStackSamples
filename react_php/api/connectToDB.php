<?php
$host = 'localhost'; // or your host
$dbname = 'ne89cb5_dbTesting';
$username = 'ne89cb5_usertest';
$password = 'h6_BTgF.HA&L@}P';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
