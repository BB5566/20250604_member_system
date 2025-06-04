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

  <main class="forum-main container">
    <aside class="forum-sidebar">
      <h2>分類</h2>
      <ul>
        <li><a href="#">台灣小吃</a></li>
        <li><a href="#">異國料理</a></li>
        <li><a href="#">甜點飲品</a></li>
        <li><a href="#">素食專區</a></li>
        <li><a href="#">其他</a></li>
      </ul>
    </aside>
    <section class="forum-content">
      <div class="post-card">
        <h3>【台北】必吃牛肉麵推薦</h3>
        <p>分享台北幾家超好吃的牛肉麵店，歡迎大家補充！</p>
        <div class="post-meta">by 小明 | 2025-06-04</div>
      </div>
      <div class="post-card">
        <h3>【高雄】鹽酥雞哪家最強？</h3>
        <p>高雄的鹽酥雞攤超多，大家有推薦的嗎？</p>
        <div class="post-meta">by 小美 | 2025-06-03</div>
      </div>
      <div class="post-card">
        <h3>【新竹】米粉湯大評比</h3>
        <p>新竹米粉湯哪家最好喝？來投票吧！</p>
        <div class="post-meta">by 阿志 | 2025-06-02</div>
      </div>
    </section>
  </main>
  <?php include 'footer.php'; ?>
</body>

</html>