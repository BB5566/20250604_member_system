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

// 圖片處理
$image_name = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allow_ext = ['jpg','jpeg','png','gif','webp'];
    if (in_array($ext, $allow_ext)) {
        $image_name = uniqid('img_', true) . '.' . $ext;
        $target = '../uploads/' . $image_name;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_name = '';
        }
    }
}

if ($title === '' || $content === '' || $category === '') {
    echo '請填寫所有欄位。';
    exit();
}

// 寫入資料庫
$sql = "INSERT INTO posts (title, content, category, author_id, image) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssis', $title, $content, $category, $author_id, $image_name);
if ($stmt->execute()) {
    header('Location: ../index.php');
    exit();
} else {
    echo '發文失敗，請稍後再試。';
}
$stmt->close();
$conn->close();
