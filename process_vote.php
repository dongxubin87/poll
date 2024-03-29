<?php
session_start();
require_once 'db_connect.php';
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_id = $_SESSION['user_id'];
  $questionnaire_id = $_POST['questionnaire_id'];

  $stmt = $pdo->prepare("INSERT INTO user_questionnaires (user_id, questionnaire_id, question_id, answer) VALUES (?, ?, ?, ?)");
  foreach ($_POST as $key => $value) {
    if (strpos($key, 'answer_') !== false) {
      $question_id = str_replace('answer_', '', $key);
      $stmt->execute([$user_id, $questionnaire_id, $question_id, $value]);
    }
  }

  header("Location: user_dashboard.php");
  exit();
} else {
  header("Location: error_page.php");
  exit();
}
