<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["surveyTitle"]) && isset($_POST["surveyDescription"])) {
    $surveyTitle = $_POST["surveyTitle"];
    $surveyDescription = $_POST["surveyDescription"];

    try {
      $stmt = $pdo->prepare("INSERT INTO questionnaires (title, description) VALUES (:title, :description)");
      $stmt->bindParam(':title', $surveyTitle);
      $stmt->bindParam(':description', $surveyDescription);

      $stmt->execute();

      header("Location: buildsurvey.php");
      exit();
    } catch (PDOException $e) {
      header("Location: index.html");
      exit();
    }
  } else {
    header("Location: index.html");
    exit();
  }
}
