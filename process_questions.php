<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["questionnaireTitle"]) && isset($_POST["questionType"]) && isset($_POST["questionContent"])) {
    $questionnaireTitle = $_POST["questionnaireTitle"];
    $questionType = ($_POST["questionType"] == "true_false") ? "true_false" : "single_choice";
    $questionContent = $_POST["questionContent"];

    require_once 'db_connect.php';

    try {
      $stmt = $pdo->prepare("SELECT questionnaire_id FROM questionnaires WHERE title = :title");
      $stmt->execute(['title' => $questionnaireTitle]);
      $questionnaireId = $stmt->fetchColumn();

      $stmt = $pdo->prepare("INSERT INTO questions (questionnaire_id, type, content) VALUES (:questionnaireId, :questionType, :questionContent)");
      $stmt->execute(['questionnaireId' => $questionnaireId, 'questionType' => $questionType, 'questionContent' => $questionContent]);

      if ($questionType == "single_choice") {
        $option1 = $_POST["option1"];
        $option2 = $_POST["option2"];

        $stmt = $pdo->prepare("UPDATE questions SET option1 = :option1, option2 = :option2 WHERE question_id = :questionId");
        $stmt->execute(['option1' => $option1, 'option2' => $option2, 'questionId' => $pdo->lastInsertId()]);
      }

      header("Location: buildsurvey.php");
      exit();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  } else {
    header("Location: index.php");
    exit();
  }
} else {
  header("Location: index.php");
  exit();
}
