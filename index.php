<?php
session_start();
$errorMessage = "";
if (isset($_GET['error']) && $_GET['error'] == 1) {
  $errorMessage = isset($_GET['msg']) ? $_GET['msg'] : "An error occurred.";
  echo "<script>history.replaceState(null, null, window.location.href.split('?')[0]);</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <link rel="stylesheet" href="styles.css">

</head>

<body>
  <button id="theme-toggle">Toggle Theme</button>
  <div class="login-container">
    <h1>User Login</h1>
    <p id="error-message" class="error-message"><?php echo $errorMessage; ?></p>

    <form action="user_login_process.php" method="post">
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="user" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="user" required>
      </div>
      <button type="submit" class="btn">Login</button>
    </form>
    <div class="footer">
      <p>Don't have an account? <a href="user_register.php">Sign Up</a></p>
      <p>Forgot your password? <a href="user_reset_password.php">Reset Password</a></p>
      <p>Change password? <a href="user_change_password.php">Change Password</a></p>
      <p>Admin? <a href="admin_login.php">Admin Login</a></p>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var errorMessageElement = document.getElementById("error-message");
      if (errorMessageElement.innerHTML.trim() !== "") {
        setTimeout(function() {
          errorMessageElement.style.display = "none";
        }, 2000);
      }
    });
  </script>
  <script src="theme.js" defer></script>
</body>

</html>