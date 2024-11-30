<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "koko";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connection successful";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $username = isset($input['username']) ? $input['username'] : '';
    $email = isset($input['email']) ? $input['email'] : '';
    $password = isset($input['password']) ? $input['password'] : '';

    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Username, email, and password are required']);
        exit;
    }

    // Проверка на существование пользователя с таким же email
    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Если пользователь с таким email уже существует
        echo json_encode(['success' => false, 'message' => 'User with this email already exists']);
        exit;
    }

    // Хэшируем пароль для безопасности
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Подготовленный запрос для добавления нового пользователя
    $stmt = $conn->prepare("INSERT INTO user_accounts (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        // Успешная регистрация
        echo json_encode(['success' => true, 'message' => 'User registered successfully']);
    } else {
        // Ошибка при регистрации
        echo json_encode(['success' => false, 'message' => 'Registration failed']);
    }

    // Закрываем соединение
    $stmt->close();
} else {
    // Метод запроса не POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();