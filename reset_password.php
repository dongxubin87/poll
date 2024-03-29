<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];

  $new_password = generateRandomPassword();

  $sql = "UPDATE Users SET password = :password WHERE email = :email";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':password', $new_password);
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  $subject = "Password Reset";
  $message = "Your new password is: " . $new_password;
  mail($email, $subject, $message, $headers);

  header("Location: index.php");
  exit();
}

function generateRandomPassword($length = 10)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $password = '';
  for ($i = 0; $i < $length; $i++) {
    $password .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $password;
}
