<?php
header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host = "database";
$user = "koko";
$password = "123";
$dbname = "koko";

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $query = "SELECT * FROM items WHERE category='cameras'";
    $stmt = $pdo->query($query);

    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($items);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}


