<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $current_username = $_POST['current-username'];
  $current_password = $_POST['current-password'];
  $new_email = $_POST['new-email'];
  $confirm_new_email = $_POST['confirm-new-email'];

  if ($new_email !== $confirm_new_email) {
    header("Location: admin_change_email.php?error=Emails do not match.");
    exit();
  }

  $stmt = $pdo->prepare("SELECT user_id, password, email FROM Users WHERE username = ?");
  $stmt->execute([$current_username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && $current_password === $user['password']) {

    $stmt = $pdo->prepare("UPDATE Users SET email = ? WHERE user_id = ?");
    $stmt->execute([$new_email, $user['user_id']]);

    header("Location: admin_login.php");
    exit();
  } else {
    header("Location: admin_change_email.php?error=Incorrect username and/or current password.");
    exit();
  }
} else {
  header("Location: error_page.php");
  exit();
}
