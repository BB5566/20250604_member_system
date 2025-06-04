<?php
require_once 'db_connect.php';
$id = $_GET['id'] ?? '';
if (!$id || !is_numeric($id)) {
  echo '<h2>無效的文章編號</h2>';
  exit;
}
// 取得文章內容
$sql = "SELECT posts.*, members.nickname FROM posts JOIN members ON posts.author_id = members.id WHERE posts.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
if (!$post) {
  echo '<h2>找不到此文章</h2>';
  exit;
}
// 取得留言
$comments = [];
$sql_c = "SELECT comments.*, members.nickname FROM comments JOIN members ON comments.member_id = members.id WHERE comments.post_id = ? ORDER BY comments.created_at ASC";
$stmt_c = $conn->prepare($sql_c);
$stmt_c->bind_param('i', $id);
$stmt_c->execute();
$result_c = $stmt_c->get_result();
while ($row = $result_c->fetch_assoc()) {
  $comments[] = $row;
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($post['title']) ?> - 美食論壇</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>
<main class="container">
  <div class="post-detail">
    <h2><?= htmlspecialchars($post['title']) ?></h2>
    <div style="color:#ffd54f;font-size:0.98rem;margin-bottom:6px;">[<?= htmlspecialchars($post['category']) ?>]</div>
    <div class="post-meta">by <?= htmlspecialchars($post['nickname']) ?> | <?= htmlspecialchars(date('Y-m-d', strtotime($post['created_at']))) ?></div>
    <p><?= $post['content'] ?></p>
  </div>
  <hr>
  <section class="comments">
    <h3>討論區</h3>
    <?php if (count($comments) > 0): ?>
      <?php foreach ($comments as $c): ?>
        <div class="comment">
          <div class="comment-meta"><?= htmlspecialchars($c['nickname']) ?> | <?= htmlspecialchars($c['created_at']) ?></div>
          <div class="comment-content"><?= $c['content'] ?></div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div>目前尚無留言，歡迎搶頭香！</div>
    <?php endif; ?>
    <hr>
    <h4>發表回覆</h4>
    <form action="api/add_comment.php" method="post">
      <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
      <textarea name="content" rows="3" required placeholder="輸入留言內容..."></textarea><br>
      <button type="submit">送出留言</button>
    </form>
  </section>
</main>
<?php $conn->close(); ?>
<?php include 'footer.php'; ?>
</body>
</html>
