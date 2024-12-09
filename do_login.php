<?php
require_once __DIR__ . '/boot.php';

$stmt = pdo()->prepare('SELECT * FROM users WHERE username = :username');
$stmt->execute(['username' => $_POST['username']]);
if (!$stmt->rowCount()) {
    flash('No user found');
    header('location: login.php');
    die;
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin') {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = 'admin';
    header('Location: http://localhost:81/admin.php');
    exit;
}

if (strcmp($_POST['password'], $user['password']) === 0) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = 'user';
    header('Location: http://localhost:5173/#/');
} else {
    flash('Wrong password or username');
    header('location: login.php');
    die;
}
