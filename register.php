<?php
// Настройки подключения к базе данных
$host = "database";      // Адрес сервера базы данных
$user = "koko";          // Логин пользователя
$password = "123";       // Пароль пользователя
$dbname = "koko";        // Название базы данных

try {
    // Создание PDO подключения
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    // Устанавливаем режим обработки ошибок
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем данные из запроса
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];

    // Проверка на существование пользователя с таким email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Если такой пользователь уже существует
        echo json_encode([
            'success' => false,
            'message' => 'User with this email already exists.'
        ]);
    } else {
        // Вставка нового пользователя в базу данных
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            // Если регистрация успешна
            echo json_encode([
                'success' => true,
                'message' => 'User registered successfully.'
            ]);
        } else {
            // Ошибка при регистрации
            echo json_encode([
                'success' => false,
                'message' => 'Error: ' . $stmt->errorInfo()[2]
            ]);
        }
    }
} catch (PDOException $e) {
    // Ошибка подключения к базе данных
    echo json_encode([
        'success' => false,
        'message' => 'Connection failed: ' . $e->getMessage()
    ]);
}
?>
