<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $current_username = $_POST['current-username'];
  $current_password = $_POST['current-password'];
  $new_password = $_POST['new-password'];
  $confirm_new_password = $_POST['confirm-new-password'];

  if ($new_password !== $confirm_new_password) {
    header("Location: change_password.php?error=Passwords do not match.");
    exit();
  }

  if ($current_username === 'admin') {

    $stmt = $pdo->prepare("UPDATE Users SET password = ? WHERE username = 'admin'");
    $stmt->execute([$new_password]);

    echo 'Change password successfully!';
    header("Location: admin_login.php");
    exit();
  } else {
    header("Location: change_password.php?error=Incorrect username and/or current password.");
    exit();
  }
} else {
  header("Location: error_page.php");
  exit();
}
