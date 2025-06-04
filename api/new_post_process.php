<?php
// api/new_post_process.php
session_start();
require_once '../db_connect.php'; // 你需要有一個資料庫連線檔案

// debug
file_put_contents('../debug_post.txt', print_r($_POST, true));

// 檢查是否登入
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

// 取得表單資料
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$category = trim($_POST['category'] ?? '');
$author_id = $_SESSION['user_id'];

if ($title === '' || $content === '' || $category === '') {
    echo '請填寫所有欄位。';
    exit();
}

// 寫入資料庫
require_once '../db_connect.php';
$sql = "INSERT INTO posts (title, content, category, author_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssi', $title, $content, $category, $author_id);
if ($stmt->execute()) {
    header('Location: ../index.php');
    exit();
} else {
    echo '發文失敗，請稍後再試。';
}
$stmt->close();
$conn->close();
