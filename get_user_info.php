<?php
require_once 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email, signature FROM users WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<p id=\"username\">" . $user['username'] . "</p>";
echo "<p id=\"email\">" . $user['email'] . "</p>";

if (!empty($user['signature'])) {
  echo "<p id=\"signature\">" . $user['signature'] . "</p>";
} else {
  echo "<p id=\"signature\">(No signature)</p>";
}
