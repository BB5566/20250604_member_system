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
    <section class="login-section" style="max-width:400px;margin:0 auto;background:#fffde7;padding:38px 32px 28px 32px;border-radius:14px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border-left:7px solid #ffb74d;">
      <h2 style="color:#ff9800;text-align:center;font-weight:800;letter-spacing:1px;margin-bottom:18px;">會員登入</h2>
      <?php
      if (isset($_GET['error'])) {
        echo '<div class="error-message" style="color:#d32f2f;background:#fff3e0;padding:10px 0 10px 0;border-radius:6px;text-align:center;margin-bottom:18px;font-weight:600;">' . htmlspecialchars($_GET['error']) . '</div>';
      }
      ?>
      <form action="api/login_process.php" method="post" class="login-form" style="display:flex;flex-direction:column;gap:18px;">
        <div style="display:flex;flex-direction:column;gap:7px;">
          <label for="username" style="font-weight:600;color:#6d4c41;font-size:1.05rem;">帳號：</label>
          <input type="text" id="username" name="username" required style="padding:10px 12px;border:1.5px solid #ffe0b2;border-radius:6px;font-size:1.05rem;background:#fff;transition:border 0.2s, box-shadow 0.2s;outline:none;">
        </div>
        <div style="display:flex;flex-direction:column;gap:7px;">
          <label for="password" style="font-weight:600;color:#6d4c41;font-size:1.05rem;">密碼：</label>
          <input type="password" id="password" name="password" required style="padding:10px 12px;border:1.5px solid #ffe0b2;border-radius:6px;font-size:1.05rem;background:#fff;transition:border 0.2s, box-shadow 0.2s;outline:none;">
        </div>
        <button type="submit" style="padding:10px 0;font-size:1.08rem;font-weight:700;border:none;border-radius:6px;background:linear-gradient(90deg,#ffb74d 60%,#ff9800 100%);color:#fff;cursor:pointer;transition:background 0.2s,box-shadow 0.2s;box-shadow:0 2px 8px rgba(255,183,77,0.08);margin-top:10px;">登入</button>
      </form>
    </section>
  </main>
<?php
  // Include footer
  include 'footer.php';?>
</body>
</html>