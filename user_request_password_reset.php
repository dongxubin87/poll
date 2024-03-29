<?php
session_start();

if (isset($_SESSION['user_id'])) {
  header("Location: user_dashboard.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];

  header("Location: password_reset_sent.php");
  exit;
}
