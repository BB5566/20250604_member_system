<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}
$dsn = "mysql:host=localhost;dbname=food_forum;charset=utf8";
$db_user = "root";
$db_pass = "";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
  $pdo = new PDO($dsn, $db_user, $db_pass, $options);
  $stmt = $pdo->prepare("SELECT * FROM members WHERE id = :id");
  $stmt->execute(['id' => $_SESSION['user_id']]);
  $member = $stmt->fetch();
} catch (PDOException $e) {
  $member = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>美食論壇</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
  <main class="forum-main container">
    <section class="forum-content">
      <div class="post-card" style="max-width:520px;margin:0 auto;">
        <h2 style="color:#ffd54f;font-weight:800;letter-spacing:1px;margin-bottom:18px;">會員中心</h2>
        <?php if ($member): ?>
          <ul style="list-style:none;padding:0;font-size:1.13rem;line-height:2;">
            <li><strong>會員ID：</strong> <?= htmlspecialchars($member['id']) ?></li>
            <li><strong>帳號：</strong> <?= htmlspecialchars($member['username']) ?></li>
            <li><strong>暱稱：</strong> <?= htmlspecialchars($member['nickname']) ?></li>
            <li><strong>電子郵件：</strong> <?= htmlspecialchars($member['email']) ?></li>
            <li><strong>生日：</strong> <?= htmlspecialchars($member['birthday']) ?></li>
          </ul>
        <?php else: ?>
          <div style="color:#d32f2f;">無法取得會員資料，請稍後再試。</div>
        <?php endif; ?>
      </div>
    </section>
  </main>
<?php
  // Include footer
  include 'footer.php';?>
</body>
</html>