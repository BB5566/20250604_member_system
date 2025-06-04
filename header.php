<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="forum-header glassy-header">
  <div class="container header-flex">
    <div class="header-logo-title">
      <img src="./img/logo.png" alt="正方形logo" class="logo-square">
      <img src="./img/w-logo.png" alt="橫式logo" class="logo-wide">
      <h1>食話實說</h1>
    </div>
    <nav>
      <a href="index.php">首頁</a>
      <a href="#">熱門主題</a>
      <a href="./new_post.php">發表文章</a>
      <a href="member_center.php">會員中心</a>
    </nav>
    <div class="header-user">
      <?php if (isset($_SESSION['user_id'])): ?>
        <span class="user-pill"><span class="user-avatar">👤</span><?= htmlspecialchars($_SESSION['nickname']) ?>，歡迎！</span>
        <a href="./api/logout.php" class="logout-btn">登出</a>
      <?php else: ?>
        <a href="reg.php">註冊</a>
        <a href="login.php">登入</a>
      <?php endif; ?>
    </div>
  </div>
</header>