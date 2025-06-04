<?php
session_start();
$dsn = "mysql:host=localhost;dbname=food_forum;charset=utf8";
$db_user = "root";
$db_pass = "";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    try {
        $pdo = new PDO($dsn, $db_user, $db_pass, $options);
        $stmt = $pdo->prepare("SELECT * FROM members WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nickname'] = $user['nickname'];
            header('Location: ../member_center.php');
            exit();
        } else {
            header('Location: ../login.php?error=帳號或密碼錯誤');
            exit();
        }
    } catch (PDOException $e) {
        header('Location: ../login.php?error=資料庫連線失敗');
        exit();
    }
} else {
    header('Location: ../login.php');
    exit();
}
?>