<?php
require_once 'db_connect.php';
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
  header("Location: admin_login.php");
  exit();
}
try {
  $stmt = $pdo->query("SELECT title FROM questionnaires");
  $questionnaireTitles = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Survey</title>
  <link rel="stylesheet" href="addsurvey.css">
  <link rel="stylesheet" href="addquestions.css">

</head>

<body>

  <h2>Create New Survey</h2>
  <span class="gotoadmin"><a href="admin_dashboard.php">Back To Dashboard</a></span>
  <form id="newSurveyForm" action="process_survey.php" method="post">
    <label for="surveyTitle">Survey Title:</label>
    <input type="text" name="surveyTitle" id="surveyTitle" required>
    <br>
    <label for="surveyDescription">Survey Description:</label>
    <textarea name="surveyDescription" id="surveyDescription" rows="4" required></textarea>
    <br>
    <button type="submit">Submit Survey</button>
  </form>

  <form id="surveyForm" action="process_questions.php" method="post">
    <label for="questionType">Question Type:</label>
    <select name="questionType" id="questionType" onchange="toggleOptionsField()">
      <option value="0">True/False</option>
      <option value="1">Single Choice</option>
    </select>
    <br>
    <label for="questionContent">Question Content:</label>
    <input type="text" name="questionContent" id="questionContent">
    <br>
    <div id="optionsField">
      <label for="option1">Option 1:</label>
      <input type="text" name="option1" id="option1">
      <br>
      <label for="option2">Option 2:</label>
      <input type="text" name="option2" id="option2">
      <br>
    </div>
    <br>
    <label for="questionnaireTitle">Select Questionnaire:</label>
    <select name="questionnaireTitle" id="questionnaireTitle">
      <?php
      foreach ($questionnaireTitles as $title) {
        echo "<option value=\"$title\">$title</option>";
      }
      ?>
    </select>
    <br>
    <button type="submit">Submit</button>
  </form>

  <script>
    function toggleOptionsField() {
      var questionType = document.getElementById("questionType").value;
      var optionsField = document.getElementById("optionsField");
      if (questionType === "1") {
        optionsField.style.display = "block";
      } else {
        optionsField.style.display = "none";
      }
    }
  </script>

</body>

</html>