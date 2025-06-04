<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>美食論壇</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  
  <?php include 'header.php'; ?>
  <?php
  require_once 'db_connect.php';
  $category = $_GET['category'] ?? '';
  $sql = "SELECT posts.*, members.nickname FROM posts JOIN members ON posts.author_id = members.id";
  if ($category && in_array($category, ['台灣小吃','異國料理','甜點飲品','素食專區','其他'])) {
    $sql .= " WHERE posts.category = '" . $conn->real_escape_string($category) . "'";
  }
  $sql .= " ORDER BY created_at DESC";
  $result = $conn->query($sql);
  ?>
  <main class="forum-main container">
    <aside class="forum-sidebar">
      <h2>分類</h2>
      <ul>
        <li><a href="index.php">全部</a></li>
        <li><a href="?category=台灣小吃">台灣小吃</a></li>
        <li><a href="?category=異國料理">異國料理</a></li>
        <li><a href="?category=甜點飲品">甜點飲品</a></li>
        <li><a href="?category=素食專區">素食專區</a></li>
        <li><a href="?category=其他">其他</a></li>
      </ul>
    </aside>
    <section class="forum-content">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="post-card">
            <h3><?= htmlspecialchars($row['title']) ?></h3>
            <div style="color:#ffd54f;font-size:0.98rem;margin-bottom:6px;">[<?= htmlspecialchars($row['category']) ?>]</div>
            <p><?= $row['content'] ?></p>
            <div class="post-meta">by <?= htmlspecialchars($row['nickname']) ?> | <?= htmlspecialchars(date('Y-m-d', strtotime($row['created_at']))) ?></div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="post-card">目前尚無文章，歡迎發表第一篇！</div>
      <?php endif; ?>
    </section>
  </main>
  <?php $conn->close(); ?>
  <?php include 'footer.php'; ?>
</body>

</html>