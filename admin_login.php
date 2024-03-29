<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="admin-login-container">
    <h1>Admin Login</h1>
    <form action="admin_login_process.php" method="post">
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="admin" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="admin" required>
      </div>
      <button type="submit" class="btn">Login</button>
    </form>
    <div class="footer">
      <p>Not an admin? <a href="index.php">User Login</a></p>
      <p>Change password? <a href="admin_change_password.php">Change Password</a></p>
      <p>Change email? <a href="admin_change_email.php">Change Email</a></p>
    </div>
  </div>
</body>

</html>