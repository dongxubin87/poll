<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="change-password-container">
    <h1>Change Password</h1>
    <form action="admin_change_password_process.php" method="post">
      <div class="input-group">
        <label for="current-username">Username</label>
        <input type="text" id="current-username" name="current-username" required>
      </div>
      <div class="input-group">
        <label for="current-password">Current Password</label>
        <input type="password" id="current-password" name="current-password" required>
      </div>
      <div class="input-group">
        <label for="new-password">New Password</label>
        <input type="password" id="new-password" name="new-password" required>
      </div>
      <div class="input-group">
        <label for="confirm-new-password">Confirm New Password</label>
        <input type="password" id="confirm-new-password" name="confirm-new-password" required>
      </div>
      <button type="submit" class="btn">Change Password</button>
    </form>
    <div class="footer">
      <p>Remembered your password? <a href="admin_login.php">Login</a></p>
    </div>
  </div>
</body>

</html>