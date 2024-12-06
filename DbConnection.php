<?php
$host = 'database';
$db = 'koko';
$user = 'koko';
$pass = '123';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
$pdo = new PDO($dsn, $user, $pass, $options);
echo "Connected to the database!";
} catch (\PDOException $e) {
echo "Database connection failed: " . $e->getMessage();
}
