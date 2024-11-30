<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "koko";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!empty($email) && !empty($password)) {

            $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE email = :email LIMIT 1");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];


                header("Location: /");
                exit();
            } else {
                echo json_encode(["error" => "Invalid email or password"]);
            }
        } else {
            echo json_encode(["error" => "Please fill in all fields"]);
        }
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Database connection failed: " . $e->getMessage()]);
}