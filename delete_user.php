<?php
require_once 'db_connect.php';

if (isset($_POST['user_id'])) {
  $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);

  try {
    $stmt = $pdo->prepare("DELETE FROM Users WHERE user_id = :user_id");
    $stmt->execute(array(':user_id' => $user_id));

    if ($stmt->rowCount() > 0) {
      echo "User deleted successfully!";

      echo "<script>window.location.href = 'admin_dashboard.php';</script>";
    } else {
      echo "User not found or already deleted!";
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
} else {
  echo "User ID parameter is missing!";
}
