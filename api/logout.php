<?php
session_start();
// 清除所有 session 變數
$_SESSION = array();
// 如果有 session cookie，則刪除它
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// 銷毀 session
session_destroy();
// 跳轉回首頁或登入頁
header("Location: ../login.php");
exit();
?>
