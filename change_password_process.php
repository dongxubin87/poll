<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $current_username = $_POST['current-username'];
  $current_password = $_POST['current-password'];
  $new_password = $_POST['new-password'];
  $confirm_new_password = $_POST['confirm-new-password'];

  if ($new_password !== $confirm_new_password) {
    header("Location: index.php");
    exit();
  }

  $stmt = $pdo->prepare("SELECT user_id, password FROM Users WHERE username = ?");
  $stmt->execute([$current_username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($current_password, $user['password'])) {

    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE Users SET password = ? WHERE user_id = ?");
    $stmt->execute([$hashed_new_password, $user['user_id']]);

    echo 'Change password successfully!';
    header("Location: index.php");
    exit();
  } else {
    header("Location: change_password.php?error=Incorrect username and/or current password.");
    exit();
  }
} else {
  header("Location: error_page.php");
  exit();
}
