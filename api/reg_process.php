<?php
$dsn = "mysql:host=localhost;dbname=food_forum;charset=utf8";
$username = "root";
$password = "";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$sql = "INSERT INTO `members` (`username`, `password`, `nickname`, `email`, `birthday`) VALUES (:username, :password, :nickname, :email, :birthday)";
try {
  $pdo = new PDO($dsn, $username, $password, $options);
  $stmt = $pdo->prepare($sql);

  // Prepare the data
  $post = [];
  $post['username'] = $_POST['username'] ?? '';
  // Hash the password
  $post['password'] = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
  $post['nickname'] = $_POST['nickname'] ?? '';
  $post['email'] = $_POST['email'] ?? '';
  $post['birthday'] = $_POST['birthday'] ?? '';

  // Execute the statement
  if ($stmt->execute($post)) {
    echo "<script>alert('註冊成功！');window.location.href='../login.php';</script>";
  } else {
    echo "<script>alert('註冊失敗，請稍後再試。');history.back();</script>";
  }
} catch (PDOException $e) {
  if ($e->getCode() == 23000) {
    // Duplicate entry
    echo "<script>alert('此帳號已被註冊，請換一個帳號。');history.back();</script>";
  } else {
    echo "<script>alert('錯誤: ".addslashes($e->getMessage())."');history.back();</script>";
  }
}
$post['username'] = $_POST['username'] ?? '';
$post['password'] = $_POST['password'] ?? '';
$post['nickname'] = $_POST['nickname'] ?? '';
$post['email'] = $_POST['email'] ?? '';
$post['birthday'] = $_POST['birthday'] ?? '';
