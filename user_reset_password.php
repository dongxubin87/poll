<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Recovery</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="password_recovery.css">
</head>

<body>
  <div class="password-reset-container">
    <h1>Reset Password</h1>
    <form action="reset_password.php" method="post">
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <button type="submit" class="btn">Reset Password</button>
    </form>
    <div class="footer">
      <p>Remembered your password? <a href="index.php">Login</a></p>
    </div>
  </div>
</body>

</html>