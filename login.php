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
    <section class="login-section post-card" style="max-width:400px;margin:0 auto;">
      <h2 class="form-title" style="color:#ffd54f;">會員登入</h2>
      <?php
      if (isset($_GET['error'])) {
        echo '<div class="error-message" style="color:#d32f2f;background:rgba(255,255,255,0.10);padding:10px 0;border-radius:6px;text-align:center;margin-bottom:18px;font-weight:600;">' . htmlspecialchars($_GET['error']) . '</div>';
      }
      ?>
      <form action="api/login_process.php" method="post" class="login-form" style="display:flex;flex-direction:column;gap:18px;">
        <div style="display:flex;flex-direction:column;gap:7px;">
          <label for="username">帳號：</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div style="display:flex;flex-direction:column;gap:7px;">
          <label for="password">密碼：</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">登入</button>
      </form>
    </section>
  </main>
<?php include 'footer.php';?>
</body>
</html>