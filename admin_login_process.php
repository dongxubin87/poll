<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once 'db_connect.php';

  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM Users WHERE username = ?");
  $stmt->execute([$username]);
  $admin = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($admin && $password === $admin['password'] && $admin['is_admin'] == 1) {
    $_SESSION['user_id'] = $admin['user_id'];
    $_SESSION['username'] = $admin['username'];
    $_SESSION['is_admin'] = 1;
    header("Location: admin_dashboard.php");
    exit();
  } else {
    $error_msg = "Incorrect admin username or password.";
    header("Location: admin_login.php?error=1&msg=" . urlencode($error_msg));
    exit();
  }
}
