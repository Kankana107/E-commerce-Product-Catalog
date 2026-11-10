<?php

$host = 'localhost';
$database = 'foodnest';
$username = 'root';
$password = '';
$charset = 'utf8mb4';

$connectionString = "mysql:host=$host;dbname=$database;charset=$charset";

try {
    $pdo = new PDO($connectionString, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    exit('Database connection failed. Check that MySQL is running in XAMPP.');
}
?>