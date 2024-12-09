<?php
session_start();
function PDO() : PDO
{
    static $pdo;

    if (!$pdo) {
        $dsn = "mysql:dbname=" . 'koko' . ";host=" . 'database';
        $pdo = new PDO($dsn, 'koko', '123');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $pdo;
}

function flash(?string $message = null)
{
    if ($message) {
        $_SESSION['flash'] = $message;
    } else {
        if (!empty($_SESSION['flash'])) { ?>
            <div class="alert alert-danger mb-3">
                <?=$_SESSION['flash']?>
            </div>
        <?php }
        unset($_SESSION['flash']);
    }
}