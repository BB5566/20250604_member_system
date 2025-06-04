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
        <div class="member-center-section">
          <h2>會員中心</h2>
          <?php if ($member): ?>
            <ul class="member-info">
              <li><strong>會員ID：</strong> <?= htmlspecialchars($member['id']) ?></li>
              <li><strong>帳號：</strong> <?= htmlspecialchars($member['username']) ?></li>
              <li><strong>暱稱：</strong> <?= htmlspecialchars($member['nickname']) ?></li>
              <li><strong>電子郵件：</strong> <?= htmlspecialchars($member['email']) ?></li>
              <li><strong>生日：</strong> <?= htmlspecialchars($member['birthday']) ?></li>
            </ul>
            <hr>
            <h3>我發表的文章</h3>
            <?php
              $stmt2 = $pdo->prepare("SELECT id, title, created_at FROM posts WHERE author_id = :uid ORDER BY created_at DESC");
              $stmt2->execute(['uid' => $member['id']]);
              $my_posts = $stmt2->fetchAll();
            ?>
            <?php if ($my_posts): ?>
              <ul class="article-list">
                <?php foreach ($my_posts as $p): ?>
                  <li><a href="post_detail.php?id=<?= $p['id'] ?>">[<?= htmlspecialchars(date('Y-m-d', strtotime($p['created_at']))) ?>] <?= htmlspecialchars($p['title']) ?></a></li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <div class="empty-tip">尚未發表任何文章</div>
            <?php endif; ?>
            <hr>
            <h3>我留言過的文章</h3>
            <?php
              $stmt3 = $pdo->prepare("SELECT DISTINCT posts.id, posts.title, posts.created_at FROM comments JOIN posts ON comments.post_id = posts.id WHERE comments.member_id = :uid ORDER BY posts.created_at DESC");
              $stmt3->execute(['uid' => $member['id']]);
              $commented_posts = $stmt3->fetchAll();
            ?>
            <?php if ($commented_posts): ?>
              <ul class="article-list">
                <?php foreach ($commented_posts as $p): ?>
                  <li><a href="post_detail.php?id=<?= $p['id'] ?>">[<?= htmlspecialchars(date('Y-m-d', strtotime($p['created_at']))) ?>] <?= htmlspecialchars($p['title']) ?></a></li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <div class="empty-tip">尚未留言過任何文章</div>
            <?php endif; ?>
          <?php else: ?>
            <div style="color:#d32f2f;">無法取得會員資料，請稍後再試。</div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>
<?php
  // Include footer
  include 'footer.php';?>
</body>
</html>