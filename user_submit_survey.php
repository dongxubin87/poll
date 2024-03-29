<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $userId = $_SESSION['user_id'];
  $surveyId = $_POST['survey_id'];
  $answers = $_POST;
  header("Location: user_dashboard.php");
  exit;
}
