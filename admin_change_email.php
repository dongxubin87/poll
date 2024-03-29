<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Email</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="change-password-container">
    <h1>Change Email</h1>
    <form action="admin_change_email_process.php" method="post">
      <div class="input-group">
        <label for="current-username">Username</label>
        <input type="text" id="current-username" name="current-username" required>
      </div>
      <div class="input-group">
        <label for="current-password">Password</label>
        <input type="password" id="current-password" name="current-password" required>
      </div>
      <div class="input-group">
        <label for="new-email">New Email</label>
        <input type="email" id="new-email" name="new-email" required>
      </div>
      <div class="input-group">
        <label for="confirm-new-email">Confirm New Email</label>
        <input type="email" id="confirm-new-email" name="confirm-new-email" required>
      </div>
      <button type="submit" class="btn">Change Email</button>
    </form>
    <div class="footer">
      <p> <a href="admin_login.php"> Admin Login</a></p>
    </div>
  </div>
</body>

</html>