<?php
session_start();

if (isset($_POST['logout'])) {
  $_SESSION = array();

  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
  }

  session_destroy();

  header("Location: admin_login.php");
  exit();
}
