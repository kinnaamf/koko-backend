<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Accept: *');

require_once 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
const JWT_SECRET_KEY = 'your_secret_key';
const JWT_ALGORITHM = 'HS256';
const JWT_EXPIRATION_TIME = 0;

// Подключение к базе данных
$host = 'localhost';
$db = 'koko';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        http_response_code(400);
        echo json_encode(["error" => "Username and password are required."]);
        exit;
    }

    $stmt = $pdo->prepare("SELECT id, username, password, role FROM user_accounts WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['password']) {
        // Генерация JWT токена
        $payload = [
            'iss' => 'http://localhost',
            'aud' => 'http://localhost',
            'iat' => time(),
            'exp' => time() + JWT_EXPIRATION_TIME,
            'data' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ]
        ];

        $token = JWT::encode($payload, JWT_SECRET_KEY, JWT_ALGORITHM);
        $response = [
                    'status' => 'success',
                    'token' => $token,
                    'message' => 'Token created successfully'
        ];
        echo json_encode($response);
        exit;
    } else {
        http_response_code(401);
        echo json_encode(["error" => "Invalid username or password."]);
        exit;
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed."]);
    exit;
}