<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>食話實說</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <?php include 'header.php'; ?>
  <main class="forum-main container">
    <h2 class="form-title">會員註冊</h2>
    <form action="api/reg_process.php" method="post" class="register-form">
      <div>
        <label for="username">帳號：</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div>
        <label for="password">密碼：</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div>
        <label for="nickname">暱稱：</label>
        <input type="text" id="nickname" name="nickname" required>
      </div>
      <div>
        <label for="email">電子郵件：</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div>
        <label for="birthday">生日：</label>
        <input type="date" id="birthday" name="birthday" required>
      </div>
      <div>
        <button type="submit">註冊</button>
        <button type="reset">重置</button>
      </div>
    </form>
  </main>
  <?php include 'footer.php'; ?>
</body>

</html>